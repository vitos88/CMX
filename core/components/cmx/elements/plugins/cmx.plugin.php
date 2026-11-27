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

$corePath = $modx->getOption('cmx.core_path', null, $modx->getOption('core_path') . 'components/cmx/');

if ($modx->event->name === 'OnManagerPageBeforeRender') {
    $assetsUrl = $modx->getOption(
        'cmx.assets_url',
        null,
        MODX_ASSETS_URL . 'components/cmx/'
    );

    $modx->regClientStartupScript(
        $assetsUrl . 'js/settings.combos.js'
    );
}

if (!function_exists('cmxPluginElementContext')) {
    function cmxPluginElementContext($controller, $type) {
        if (!$controller || empty($controller->$type)) {
            return null;
        }
        $element = $controller->$type;
        $id = (int) $element->get('id');
        if ($id <= 0) {
            return null;
        }
        $nameField = $type === 'template' ? 'templatename' : 'name';
        return array(
            'type' => $type,
            'id' => $id,
            'name' => (string) $element->get($nameField),
        );
    }
}

if (!function_exists('cmxJson')) {
    /**
     * json_encode() that never returns false: a name with broken utf-8
     * (json_encode() === false) usedto silently kill the whole
     * Ext. onReady block with a syntax error, so the editor never started.
     *
     * @param mixed $value
     * @return string
     */
    function cmxJson($value) {
        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        return is_string($json) ? $json : 'null';
    }
}

if (!function_exists('cmxPluginTemplateTvs')) {
    /**
     * Names\ of the TVs assigned to the edited resource's template —
     * the contextual [[* completion on resource forms. Null when the
     * template is unknown (new resource without template).
     *
     * @param object $modx
     * @return array|null
     */
    function cmxPluginTemplateTvs($modx) {
        if (!$modx->controller || empty($modx->controller->resourceArray)) {
            return null;
        }
        $template = (int) (isset($modx->controller->resourceArray['template'])
            ? $modx->controller->resourceArray['template']
            : 0);
        if ($template <= 0) {
            return array();
        }

        $c = $modx->newQuery('modTemplateVarTemplate');
        $c->select('modTemplateVar.name AS tvname');
        $c->innerJoin('modTemplateVar', 'modTemplateVar', array(
            'modTemplateVarTemplate.tmplvarid = modTemplateVar.id',
        ));
        $c->where(array('templateid' => $template));
        $c->sortby('modTemplateVar.name', 'ASC');

        $names = array();
        foreach ($modx->getIterator('modTemplateVarTemplate', $c) as $row) {
            $names[] = (string) $row->get('tvname');
        }
        return $names;
    }
}

if (!function_exists('cmxPluginSaveRevision')) {
    /**
     * Saves a revision snapshot on the On FormSave events.
     *
     * @param object $modx
     * @return void
     */
    function cmxPluginSaveRevision($modx) {
        $params = $modx->event->params;
        $map = array(
            'OnSnipFormSave' => array('snippet', 'snippet'),
            'OnChunkFormSave' => array('chunk', 'snippet'),
            'OnTempFormSave' => array('template', 'content'),
            'OnPluginFormSave' => array('plugin', 'plugincode'),
            'OnDocFormSave' => array('resource', 'content'),
        );
        $eventName = $modx->event->name;
        if (!isset($map[$eventName])) {
            return;
        }
        list($type, $field) = $map[$eventName];

        $object = null;
        if (!empty($params[$type]) && is_object($params[$type])) {
            $object = $params[$type];
        } elseif (!empty($params['id'])) {
            $classes = array(
                'snippet' => 'modSnippet',
                'chunk' => 'modChunk',
                'template' => 'modTemplate',
                'plugin' => 'modPlugin',
                'resource' => 'modResource',
            );
            $object = $modx->getObject($classes[$type], (int) $params['id']);
        }
        if (!$object) {
            return;
        }

        $name = $type === 'resource'
            ? 'pagetitle'
            : ($type === 'template' ? 'templatename' : 'name');
        cmxRevisionSave(
            $modx,
            $type,
            (int) $object->get('id'),
            (string) $object->get($name),
            (string) $object->get($field)
        );
    }
}

if (!function_exists('cmxPluginDeleteRevisions')) {
    /**
     * Drops the revision history when the element (or resource) itself is
     * deleted — before 3.7.0 the cmx_revision rows of deleted elements
     * stayed in the table forever. Fired by the On*Remove model events
     * (MODX 3 names) and OnEmptyTrash (hard resource deletion).
     *
     * @param object $modx
     * @return void
     */
    function cmxPluginDeleteRevisions($modx) {
        $params = $modx->event->params;
        $map = array(
            'OnSnippetRemove' => array('snippet', 'snippet'),
            'OnChunkRemove' => array('chunk', 'chunk'),
            'OnTemplateRemove' => array('template', 'template'),
            'OnPluginRemove' => array('plugin', 'plugin'),
        );
        $eventName = $modx->event->name;
        if (isset($map[$eventName])) {
            list($type, $param) = $map[$eventName];
            if (!empty($params[$param]) && is_object($params[$param])) {
                cmxRevisionDelete($modx, $type, (int) $params[$param]->get('id'));
            }
            return;
        }
        // OnEmptyTrash: 'ids' is the array of resource ids that were
        // (attempted to be) permanently deleted
        if ($eventName === 'OnEmptyTrash' && !empty($params['ids']) && is_array($params['ids'])) {
            foreach ($params['ids'] as $rid) {
                cmxRevisionDelete($modx, 'resource', (int) $rid);
            }
        }
    }
}

/* ----- features that work independently of the selected editor ------------- */

switch ($modx->event->name) {
    /* TV input type "cmx": a full editor inside TV fields of resources */
    case 'OnTVInputRenderList':
        if ($modx->getOption('cmx.tv', null, '1') !== '0') {
            $modx->event->output($corePath . 'tv/input/');
        }
        return;

    /* revision snapshots (CMX history) */
    case 'OnSnipFormSave':
    case 'OnChunkFormSave':
    case 'OnTempFormSave':
    case 'OnPluginFormSave':
    case 'OnDocFormSave':
        if ($modx->getOption('cmx.versions', null, '1') !== '0') {
            require_once $corePath . 'includes/revisions.php';
            cmxPluginSaveRevision($modx);
        }
        return;

    /* revision cleanup: the element itself is gone — its history
     * must not stay in the table forever */
    case 'OnSnippetRemove':
    case 'OnChunkRemove':
    case 'OnTemplateRemove':
    case 'OnPluginRemove':
    case 'OnEmptyTrash':
        if ($modx->getOption('cmx.versions', null, '1') !== '0') {
            require_once $corePath . 'includes/revisions.php';
            cmxPluginDeleteRevisions($modx);
        }
        return;
}

if ($modx->event->name == 'OnRichTextEditorRegister') {
    $modx->event->output('cmx');
    return;
}

if ($modx->getOption('which_element_editor', null, 'cmx') !== 'cmx') {
    return;
}

require_once $corePath . 'includes/helpers.php';

$extensionMap = array(
    'tpl'   => 'text/x-smarty',
    'htm'   => 'text/html',
    'html'  => 'text/html',
    'css'   => 'text/css',
    'scss'  => 'text/x-scss',
    'less'  => 'text/x-less',
    'svg'   => 'image/svg+xml',
    'xml'   => 'application/xml',
    'xsl'   => 'application/xml',
    'js'    => 'application/javascript',
    'json'  => 'application/json',
    'php'   => 'application/x-php',
    'sql'   => 'text/x-sql',
    'md'    => 'text/x-markdown',
    'txt'   => 'text/plain',
    'twig'  => 'text/x-twig'
);

// Define default mime for html elements(templates, chunks and html resources)
$html_elements_mime = $modx->getOption('cmx.html_elements_mime', null, false);
if (!$html_elements_mime) {
    // this may deprecated in future because components may set cmx.html_elements_mime option now
    switch (true) {
        case $modx->getOption('twiggy_class'):
            $html_elements_mime = 'text/x-twig';
            break;
        case $modx->getOption('pdotools_fenom_parser'):
            $html_elements_mime = 'text/x-smarty';
            break;
        default:
            $html_elements_mime = 'text/html';
    }
}

// Defines whether we should highlight modx tags
$modxTags = false;
$useEditor = null;
// revision context: which element/resource this editor edits (for the
// history panel); null when the form does not belong to an element
$context = null;
$script = '';

switch ($modx->event->name) {
    case 'OnSnipFormPrerender':
        $field = 'modx-snippet-snippet';
        $mimeType = 'application/x-php';
        $context = cmxPluginElementContext($modx->controller, 'snippet');
        break;
    case 'OnTempFormPrerender':
        $field = 'modx-template-content';
        $mimeType = $html_elements_mime;
        $modxTags = cmxMimeSupportsModxTags($mimeType);
        $context = cmxPluginElementContext($modx->controller, 'template');
        break;
    case 'OnChunkFormPrerender':
        $field = 'modx-chunk-snippet';
        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {
            $extension = pathinfo($modx->controller->chunk->name, PATHINFO_EXTENSION);
            if (!$extension || !isset($extensionMap[$extension])) {
                $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);
            }
            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : 'text/plain';
        } else {
            $mimeType = $html_elements_mime;
        }
        $modxTags = cmxMimeSupportsModxTags($mimeType);
        $context = cmxPluginElementContext($modx->controller, 'chunk');
        break;
    case 'OnPluginFormPrerender':
        $field = 'modx-plugin-plugincode';
        $mimeType = 'application/x-php';
        $context = cmxPluginElementContext($modx->controller, 'plugin');
        break;
    case 'OnFileCreateFormPrerender':
        $field = 'modx-file-content';
        $mimeType = 'text/plain';
        break;
    case 'OnFileEditFormPrerender':
        $field = 'modx-file-content';
        $file = isset($scriptProperties['file']) ? (string) $scriptProperties['file'] : '';
        $extension = strtolower($file !== '' ? pathinfo($file, PATHINFO_EXTENSION) : 'txt');
        if ($extension === 'html' || $extension === 'htm') {
            // site template files follow the site's template engine
            // (HTML + Fenom when the pdoTools parser is on) — the same
            // mode templates, chunks and resources get, so Fenom
            // highlighting, indentation and the format button work
            $mimeType = $html_elements_mime;
        } elseif ($extension === 'php') {
            // a file carries its own <?php tag (element code does not)
            $mimeType = 'text/x-php';
        } else {
            $mimeType = isset($extensionMap[$extension])
                ? $extensionMap[$extension]
                : ('@FILE:' . pathinfo($file, PATHINFO_BASENAME));
        }
        $modxTags = cmxMimeSupportsModxTags($mimeType);
        break;
    case 'OnDocFormPrerender':
        // Resource content: respect per-context use_editor and which_editor.
        // When another RTE is configured, do not replace #ta — MODx.loadRTE or plain textarea handles it.
        if (!$modx->controller || empty($modx->controller->resourceArray)) {
            return;
        }
        $useEditor = cmxGetEffectiveUseEditor($modx);
        $field = 'ta';
        $contentType = $modx->getObject('modContentType', $modx->controller->resourceArray['content_type']);
        $mimeType = $contentType ? $contentType->get('mime_type') : 'text/html';

        if ($mimeType == 'text/html') {
            $mimeType = $html_elements_mime;
        }

        if ($useEditor) {
            $richText = $modx->controller->resourceArray['richtext'];
            $classKey = $modx->controller->resourceArray['class_key'];
            if ($richText || in_array($classKey, array('modStaticResource', 'modSymLink', 'modWebLink', 'modXMLRPCResource'))) {
                $field = false;
            } elseif (cmxIsNonCmxRichTextEditor($modx)) {
                $field = false;
            }
        }
        $modxTags = cmxMimeSupportsModxTags($mimeType);

        // revision context + the TV list of the current template for the
        // contextual [[*field]] completion (only TVs assigned to this
        // template are suggested on a resource form)
        if (!empty($modx->controller->resourceArray['id'])) {
            $context = array(
                'type' => 'resource',
                'id' => (int) $modx->controller->resourceArray['id'],
                'name' => (string) $modx->controller->resourceArray['pagetitle'],
            );
        }
        $templateTvs = cmxPluginTemplateTvs($modx);
        if ($templateTvs !== null) {
            $script .= 'MODx.ux.Cmx.setTemplateTvs(' . cmxJson($templateTvs) . ');';
        }
        // TV fields with the "cmx" input type are replaced with editors too
        if ($modx->getOption('cmx.tv', null, '1') !== '0') {
            $script .= 'MODx.ux.Cmx.replaceTvs();';
        }
        break;
    case 'OnManagerPageBeforeRender':
        // Resource overview cache tab: buffer loads asynchronously after panel render.
        if (!cmxIsResourceDataPage($modx)) {
            return;
        }
        $field = 'modx-rdata-buffer';
        $mimeType = $html_elements_mime;
        $modxTags = cmxMimeSupportsModxTags($mimeType);
        break;
    default:
        return;
}

$modxTags = (int) $modxTags;
if (!empty($field)) {
    $script .= 'MODx.ux.Cmx.replaceComponent(' . cmxJson($field) . ', ' . cmxJson($mimeType) . ', ' . $modxTags . ', '
        . cmxJson(array('context' => $context)) . ');';
}

if ($modx->event->name == 'OnDocFormPrerender' && $useEditor === false) {
    $script .= 'MODx.ux.Cmx.replaceTextAreas(Ext.query(\'.modx-richtext\'));';
}

if ($script) {
    // Load the editor bundle only on pages that actually get the editor
    $cmx = $modx->getService('cmx', 'Cmx', $corePath . 'model/cmx/');
    if (!$cmx) {
        $modx->log(modX::LOG_LEVEL_ERROR, '[CMX] Service class Cmx not found at ' . $corePath . 'model/cmx/');
        return;
    }
    $cmx->initialize();

    $modx->controller->addHtml('<script>Ext.onReady(function() {' . $script . '});</script>');
}
