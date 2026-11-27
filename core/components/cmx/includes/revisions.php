<?php

/**
 * This file is part of CMX.
 *
 * Copyright (C) 2026 vitos88
 *
 * CMX is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * CMX is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CMX; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 */

if (!defined('CMX_REVISION_TABLE')) {
    define('CMX_REVISION_TABLE', 'cmx_revision');
}

if (!function_exists('cmxRevisionTableName')) {
    /**
     * Full table name with the site table_prefix.
     *
     * @param object $modx
     * @return string
     */
    function cmxRevisionTableName($modx) {
        return $modx->getOption('table_prefix') . CMX_REVISION_TABLE;
    }
}

if (!function_exists('cmxRevisionCreateTable')) {
    /**
     * Creates the revision table (called from the transport resolver).
     *
     * The expected columns live in one place ($columns) — future schema
     * changes add their column here and cmxRevisionEnsureColumns() turns
     * an existing older table into the current shape with idempotent
     * ALTERs (there is no version marker to store: the column presence
     * IS the version).
     *
     * @param object $xpdo
     * @return bool
     */
    function cmxRevisionCreateTable($xpdo) {
        $table = cmxRevisionTableName($xpdo);
        $charset = $xpdo->getOption('charset', null, 'utf8mb4');
        $sql = "CREATE TABLE IF NOT EXISTS {$xpdo->escape($table)} (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `element_type` VARCHAR(32) NOT NULL DEFAULT '',
            `element_id` INT UNSIGNED NOT NULL DEFAULT 0,
            `name` VARCHAR(191) NOT NULL DEFAULT '',
            `user_id` INT UNSIGNED NOT NULL DEFAULT 0,
            `username` VARCHAR(100) NOT NULL DEFAULT '',
            `size` INT UNSIGNED NOT NULL DEFAULT 0,
            `createdon` INT UNSIGNED NOT NULL DEFAULT 0,
            `content` MEDIUMTEXT NOT NULL,
            PRIMARY KEY (`id`),
            INDEX `element` (`element_type`, `element_id`, `id`)
        ) ENGINE=InnoDB DEFAULT CHARSET={$xpdo->escape($charset)}";
        try {
            $xpdo->exec($sql);
            return cmxRevisionEnsureColumns($xpdo);
        } catch (Exception $e) {
            $xpdo->log(xPDO::LOG_LEVEL_ERROR, '[CMX] Could not create the revision table: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('cmxRevisionEnsureColumns')) {
    /**
     * Lightweight schema migration: adds every expected column that the
     * existing table does not have yet (install from an older package,
     * manual table surgery). Runs on every install/upgrade, no-op when
     * the table already matches.
     *
     * @param object $xpdo
     * @return bool
     */
    function cmxRevisionEnsureColumns($xpdo) {
        $expected = array(
            'element_type' => "VARCHAR(32) NOT NULL DEFAULT ''",
            'element_id' => 'INT UNSIGNED NOT NULL DEFAULT 0',
            'name' => "VARCHAR(191) NOT NULL DEFAULT ''",
            'user_id' => 'INT UNSIGNED NOT NULL DEFAULT 0',
            'username' => "VARCHAR(100) NOT NULL DEFAULT ''",
            'size' => 'INT UNSIGNED NOT NULL DEFAULT 0',
            'createdon' => 'INT UNSIGNED NOT NULL DEFAULT 0',
            'content' => 'MEDIUMTEXT NOT NULL',
        );
        $table = cmxRevisionTableName($xpdo);
        try {
            $stmt = $xpdo->prepare('SHOW COLUMNS FROM ' . $xpdo->escape($table));
            if (!$stmt) {
                return false;
            }
            $stmt->execute();
            $present = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $present[] = (string) $row['Field'];
            }
            $stmt->closeCursor();
            foreach ($expected as $column => $definition) {
                if (!in_array($column, $present, true)) {
                    $xpdo->exec(
                        'ALTER TABLE ' . $xpdo->escape($table) .
                        ' ADD COLUMN ' . $xpdo->escape($column) . ' ' . $definition
                    );
                    $xpdo->log(xPDO::LOG_LEVEL_INFO, '[CMX] Revision table: added missing column ' . $column);
                }
            }
            return true;
        } catch (Exception $e) {
            $xpdo->log(xPDO::LOG_LEVEL_ERROR, '[CMX] Revision table migration failed: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('cmxRevisionSave')) {
    /**
     * Saves one snapshot (called from the On*FormSave plugin events).
     *
     * The whole write path is exception-safe: with the table missing
     * (resolver did not run, package installed from a Git checkout, the
     * table dropped manually) the history disables itself for the rest
     * of the request instead of breaking the element save with a 500 —
     * the element itself is already saved at that point.
     *
     * @param object $modx
     * @param string $type snippet|chunk|template|plugin|resource
     * @param int $id
     * @param string $name display name (element name / pagetitle)
     * @param string $content
     * @return bool
     */
    function cmxRevisionSave($modx, $type, $id, $name, $content) {
        // one switch per request: after the first storage failure the
        // history is off until the request ends (repeated calls must not
        // spam the log nor break anything)
        static $disabled = false;
        if ($disabled) {
            return false;
        }
        if ((int) $id <= 0 || $content === null || $content === '') {
            return false;
        }

        try {
            // one snapshot per element per minute — clicking "Save" twice
            // in a row does not spam the history
            if (cmxRevisionHasRecent($modx, $type, $id, $content)) {
                return true;
            }

            $user = $modx->getAuthenticatedUser('mgr');
            $table = cmxRevisionTableName($modx);
            $sql = "INSERT INTO {$modx->escape($table)}
                (element_type, element_id, name, user_id, username, size, createdon, content)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $modx->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $ok = $stmt->execute(array(
                $type,
                (int) $id,
                // VARCHAR(191) — keep the truncation in sync with the column
                mb_substr((string) $name, 0, 191),
                $user ? (int) $user->get('id') : 0,
                $user ? (string) $user->get('username') : '',
                strlen($content),
                time(),
                $content,
            ));
            $stmt->closeCursor();

            if ($ok) {
                cmxRevisionPrune($modx, $type, $id);
            }
            return $ok;
        } catch (Exception $e) {
            $disabled = true;
            $modx->log(modX::LOG_LEVEL_ERROR, '[CMX] Revision history disabled for this request: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('cmxRevisionHasRecent')) {
    /**
     * True when an identical snapshot was saved for this element within
     * the last 60 seconds (skip duplicate writes).
     *
     * The content is compared in SQL (COUNT + content = ?) — it does not
     * travel back into PHP like the former "SELECT id, content" did on
     * every save (3.6.0 pulled the whole snapshot just to compare it).
     *
     * @param object $modx
     * @param string $type
     * @param int $id
     * @param string $content
     * @return bool
     */
    function cmxRevisionHasRecent($modx, $type, $id, $content) {
        $table = cmxRevisionTableName($modx);
        $sql = "SELECT COUNT(id) AS cnt FROM {$modx->escape($table)}
            WHERE element_type = ? AND element_id = ? AND createdon > ? AND content = ?";
        try {
            $stmt = $modx->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->execute(array($type, (int) $id, time() - 60, $content));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
        } catch (Exception $e) {
            return false;
        }
        return $row !== false && (int) $row['cnt'] > 0;
    }
}

if (!function_exists('cmxRevisionDelete')) {
    /**
     * Removes every snapshot of an element — called when the element (or
     * resource) itself is deleted (On*Remove, OnEmptyTrash), so the
     * cmx_revision table does not collect orphaned rows forever.
     *
     * @param object $modx
     * @param string $type snippet|chunk|template|plugin|resource
     * @param int $id
     * @return bool
     */
    function cmxRevisionDelete($modx, $type, $id) {
        if ((int) $id <= 0) {
            return false;
        }
        $table = cmxRevisionTableName($modx);
        $sql = "DELETE FROM {$modx->escape($table)} WHERE element_type = ? AND element_id = ?";
        try {
            $stmt = $modx->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->execute(array($type, (int) $id));
            $stmt->closeCursor();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('cmxRevisionPrune')) {
    /**
     * Keeps only the last cmx.versions_max revisions of an element.
     *
     * @param object $modx
     * @param string $type
     * @param int $id
     * @return void
     */
    function cmxRevisionPrune($modx, $type, $id) {
        $max = (int) $modx->getOption('cmx.versions_max', null, 20);
        if ($max <= 0) {
            $max = 20;
        }
        $table = cmxRevisionTableName($modx);
        $sql = "DELETE FROM {$modx->escape($table)}
            WHERE element_type = ? AND element_id = ?
              AND id NOT IN (
                SELECT id FROM (
                    SELECT id FROM {$modx->escape($table)}
                    WHERE element_type = ? AND element_id = ?
                    ORDER BY id DESC LIMIT {$max}
                ) AS keep
              )";
        try {
            $stmt = $modx->prepare($sql);
            if ($stmt) {
                $stmt->execute(array($type, (int) $id, $type, (int) $id));
                $stmt->closeCursor();
            }
        } catch (Exception $e) {
            // prune is best-effort — a failure here must never bubble up
            // into the save flow
        }
    }
}

if (!function_exists('cmxRevisionPermission')) {
    /**
     * The view permission required to read revisions of an element type.
     *
     * @param object $modx
     * @param string $type
     * @return bool
     */
    function cmxRevisionPermission($modx, $type) {
        switch ($type) {
            case 'snippet':
                return $modx->hasPermission('view_snippet');
            case 'chunk':
                return $modx->hasPermission('view_chunk');
            case 'template':
                return $modx->hasPermission('view_template');
            case 'plugin':
                return $modx->hasPermission('view_plugin');
            case 'resource':
                return $modx->hasPermission('view');
        }
        return false;
    }
}
