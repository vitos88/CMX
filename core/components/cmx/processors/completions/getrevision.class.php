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

class modCompletionsGetRevision extends modProcessor {
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
        $rid = (int) $this->getProperty('rid', 0);
        if ($rid <= 0) {
            return $this->failure('Invalid revision id');
        }

        $table = cmxRevisionTableName($this->modx);
        $sql = "SELECT element_type, element_id, name, username, size, createdon, content
            FROM {$this->modx->escape($table)}
            WHERE id = ?";
        try {
            $stmt = $this->modx->prepare($sql);
            if (!$stmt) {
                return $this->failure('Revision storage unavailable');
            }
            $stmt->execute(array($rid));
        } catch (Exception $e) {
            // the revision table is missing — degrade to "not found",
            // never a 500 on the connector
            return $this->failure('Revision storage unavailable');
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if ($row === false) {
            return $this->failure('Revision not found');
        }
        if (!cmxRevisionPermission($this->modx, (string) $row['element_type'])) {
            return $this->failure('Permission denied');
        }

        return $this->success('', array(
            'revision' => array(
                'id' => $rid,
                'type' => (string) $row['element_type'],
                'element_id' => (int) $row['element_id'],
                'name' => (string) $row['name'],
                'user' => (string) $row['username'],
                'size' => (int) $row['size'],
                'time' => (int) $row['createdon'],
                'content' => (string) $row['content'],
            ),
        ));
    }
}
return 'modCompletionsGetRevision';
