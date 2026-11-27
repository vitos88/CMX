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

require_once dirname(dirname(dirname(__FILE__))) . '/includes/revisions.php';

class modCompletionsExportRevisions extends modProcessor {
    public function checkPermissions() {
        return true;
    }
    public function getLanguageTopics() {
        return array();
    }

    public function initialize() {
        return true;
    }

    public function process() {
        $type = (string) $this->getProperty('type', '');
        $id = (int) $this->getProperty('id', 0);

        if (!cmxRevisionPermission($this->modx, $type) || $id <= 0) {
            return $this->success('', array('element' => null, 'revisions' => array()));
        }

        $table = cmxRevisionTableName($this->modx);
        $sql = "SELECT id, element_type, element_id, name, username, size, createdon, content
            FROM {$this->modx->escape($table)}
            WHERE element_type = ? AND element_id = ?
            ORDER BY id ASC";
        try {
            $stmt = $this->modx->prepare($sql);
            if (!$stmt) {
                return $this->success('', array('element' => null, 'revisions' => array()));
            }
            $stmt->execute(array($type, $id));
        } catch (Exception $e) {
            // the revision table is missing — an empty export, not a 500
            return $this->success('', array('element' => null, 'revisions' => array()));
        }

        $revisions = array();
        $name = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = (string) $row['name'];
            $revisions[] = array(
                'id' => (int) $row['id'],
                'user' => (string) $row['username'],
                'size' => (int) $row['size'],
                'time' => (int) $row['createdon'],
                'content' => (string) $row['content'],
            );
        }
        $stmt->closeCursor();

        return $this->success('', array(
            'element' => array(
                'type' => $type,
                'id' => $id,
                'name' => $name,
                'exported' => time(),
            ),
            'revisions' => $revisions,
        ));
    }
}
return 'modCompletionsExportRevisions';
