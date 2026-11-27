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

require_once dirname(dirname(dirname(__FILE__))) . '/includes/helpers.php';

class modCompletionsGetLexicons extends modProcessor {
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
        if (!$this->modx->hasPermission('lexicons')) {
            return $this->success('', array('lexicons' => array()));
        }

        // server-side guard: the search is a LIKE over the whole lexicon
        // table, keep scripted request loops away from it
        if (!cmxRateLimit($this->modx, 'getlexicons', 60, 30)) {
            return $this->success('', array('lexicons' => array()));
        }

        $query = trim((string) $this->getProperty('query', ''));
        if ($query === '' || strlen($query) < 2) {
            return $this->success('', array('lexicons' => array()));
        }

        // LIKE search without a language filter returns every key once
        // per installed language (en + ru + de ... with foreign texts) —
        // filter to the manager language of the current user
        $language = $this->modx->lexicon->getLanguage();

        $c = $this->modx->newQuery('modLexiconEntry');
        $c->select('name, value, topic, namespace');
        $c->sortby('name', 'ASC');
        $c->where(array(
            'language' => $language,
            'name:LIKE' => '%' . str_replace(array('%', '_'), array('\\%', '\\_'), $query) . '%',
        ));
        $c->limit(100);

        $list = array();
        /** @var xPDOObject $object */
        foreach ($this->modx->getIterator('modLexiconEntry', $c) as $object) {
            $list[] = array(
                'key' => (string) $object->get('name'),
                'value' => mb_substr((string) $object->get('value'), 0, 120),
                'topic' => (string) $object->get('topic'),
                'namespace' => (string) $object->get('namespace'),
            );
        }

        return $this->success('', array('lexicons' => $list));
    }
}
return 'modCompletionsGetLexicons';
