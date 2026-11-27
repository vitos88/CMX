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

class modCompletionsGetElements extends modProcessor {
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
        $data = array();

        if ($this->modx->hasPermission('view_snippet')) {
            $data['snippets'] = $this->fetchElements('modSnippet', true);
        }
        if ($this->modx->hasPermission('view_chunk')) {
            $data['chunks'] = $this->fetchElements('modChunk', true);
        }
        if ($this->modx->hasPermission('view_template')) {
            $data['templates'] = $this->fetchElements('modTemplate', false);
        }
        if ($this->modx->hasPermission('view_tv')) {
            $data['tvs'] = $this->fetchElements('modTemplateVar', false);
        }
        if ($this->modx->hasPermission('view')) {
            $data['resources'] = $this->fetchResources();
        }
        if ($this->modx->hasPermission('view_propertyset')) {
            $data['propertysets'] = $this->fetchPropertySets();
        }

        return $this->success('', $data);
    }

    /**
     * @param string $class
     * @param bool $withProperties attach default properties (snippets, chunks)
     * @return array
     */
    private function fetchElements($class, $withProperties) {
        $list = array();

        // modTemplate is the only element class whose name column is NOT
        // "name" — it is "templatename" (modx_site_templates), and a plain
        // `SELECT name` fails with "Unknown column 'name' in 'field list'"
        // (the 3.6.0 bug: templates never showed up in completions)
        $nameField = $class === 'modTemplate' ? 'templatename' : 'name';

        $c = $this->modx->newQuery($class);
        $c->select(array('id', $nameField . ' AS name', 'description'));
        $c->sortby($nameField, 'ASC');
        $c->limit(3000);

        /** @var xPDOObject $object */
        foreach ($this->modx->getIterator($class, $c) as $object) {
            $item = array(
                'id' => (int) $object->get('id'),
                'name' => (string) $object->get('name'),
                'description' => (string) $object->get('description'),
            );
            if ($withProperties) {
                $item['properties'] = $this->filterProperties($object->get('properties'));
            }
            $list[] = $item;
        }

        return $list;
    }

    /**
     * Keeps the completion payload compact: name, description and the
     * default value of the first 40 properties per element.
     *
     * @param array|string $properties
     * @return array
     */
    private function filterProperties($properties) {
        if (is_string($properties) && $properties !== '') {
            $properties = json_decode($properties, true);
        }
        if (!is_array($properties) || empty($properties)) {
            return array();
        }
        $list = array();
        foreach (array_slice($properties, 0, 40) as $property) {
            if (!is_array($property) || !isset($property['name'])) {
                continue;
            }
            $list[] = array(
                'name' => (string) $property['name'],
                'desc' => isset($property['desc']) ? (string) $property['desc'] : '',
                'value' => isset($property['value']) ? (string) $property['value'] : '',
            );
        }
        return $list;
    }

    /**
     * @return array
     */
    private function fetchResources() {
        $list = array();

        $c = $this->modx->newQuery('modResource');
        $c->select('id, pagetitle, uri, context_key');
        $c->sortby('id', 'ASC');
        $c->limit(3000);

        /** @var xPDOObject $object */
        foreach ($this->modx->getIterator('modResource', $c) as $object) {
            $list[] = array(
                'id' => (int) $object->get('id'),
                'pagetitle' => (string) $object->get('pagetitle'),
                'uri' => (string) $object->get('uri'),
                'context_key' => (string) $object->get('context_key'),
            );
        }

        return $list;
    }

    /**
     * @return array
     */
    private function fetchPropertySets() {
        $list = array();

        $c = $this->modx->newQuery('modPropertySet');
        $c->select('name');
        $c->sortby('name', 'ASC');
        $c->limit(500);

        /** @var xPDOObject $object */
        foreach ($this->modx->getIterator('modPropertySet', $c) as $object) {
            $list[] = array('name' => (string) $object->get('name'));
        }

        return $list;
    }
}
return 'modCompletionsGetElements';
