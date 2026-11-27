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

class modCompletionsGetSettings extends modProcessor {
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
        if (!$this->modx->hasPermission('settings')) {
            return $this->success('', array('settings' => array()));
        }

        $query = trim((string) $this->getProperty('query', ''));
        $limit = 100;

        $c = $this->modx->newQuery('modSystemSetting');
        $c->select('key, value');
        $c->sortby('key', 'ASC');
        if ($query !== '') {
            $c->where(array('key:LIKE' => '%' . str_replace(array('%', '_'), array('\\%', '\\_'), $query) . '%'));
            $limit = 200;
        }
        $c->limit($limit);

        $list = array();
        /** @var xPDOObject $object */
        foreach ($this->modx->getIterator('modSystemSetting', $c) as $object) {
            $value = (string) $object->get('value');
            $list[] = array(
                'key' => (string) $object->get('key'),
                'value' => mb_substr($value, 0, 120),
            );
        }

        return $this->success('', array('settings' => $list));
    }
}
return 'modCompletionsGetSettings';
