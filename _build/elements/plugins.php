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

$events = [
    // Editor registration and form replacement.
    'OnRichTextEditorRegister',
    'OnChunkFormPrerender',
    'OnPluginFormPrerender',
    'OnSnipFormPrerender',
    'OnTempFormPrerender',
    'OnFileCreateFormPrerender',
    'OnFileEditFormPrerender',
    'OnDocFormPrerender',
    'OnManagerPageBeforeRender',
    // Revision snapshots.
    'OnSnipFormSave',
    'OnChunkFormSave',
    'OnTempFormSave',
    'OnPluginFormSave',
    'OnDocFormSave',
    // Revision cleanup.
    'OnSnippetRemove',
    'OnChunkRemove',
    'OnTemplateRemove',
    'OnPluginRemove',
    'OnEmptyTrash',
    // TV input type "cmx".
    'OnTVInputRenderList',
];

return [
    'CMX' => [
        'file' => 'cmx.plugin',
        'description' => 'CMX — CodeMirror 6 code editor plugin for MODX Revolution',
        'events' => array_fill_keys($events, []),
    ],
];
