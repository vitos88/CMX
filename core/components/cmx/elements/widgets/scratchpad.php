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

if (!defined('MODX_CORE_PATH')) {
    return '';
}

$cmxCorePath = $modx->getOption('cmx.core_path', null, MODX_CORE_PATH . 'components/cmx/');
$cmx = $modx->getService('cmx', 'Cmx', $cmxCorePath . 'model/cmx/');
if (!$cmx) {
    return '';
}
$cmx->initialize();

$mountId = 'cmx-scratchpad-' . substr(md5(uniqid('', true)), 0, 6);

$modx->controller->addHtml(
    '<script>Ext.onReady(function(){'
    . 'MODx.ux.Cmx.mountScratchpad(' . json_encode($mountId) . ');'
    . '});</script>'
);

return '<div id="' . $mountId . '" class="cmx-scratchpad" style="width:100%"></div>';
