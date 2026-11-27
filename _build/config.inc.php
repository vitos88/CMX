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
    $basePath = getenv('MODX_BASE_PATH');
    if ($basePath) {
        $path = rtrim($basePath, '/');
    } else {
        $path = dirname(__FILE__);
        while (!file_exists($path . '/core/config/config.inc.php') && strlen($path) > 1) {
            $path = dirname($path);
        }
    }
    define('MODX_CORE_PATH', $path . '/core/');
}

return [
    'name' => 'CMX',
    'name_lower' => 'cmx',
    'version' => '1.0.0',
    'release' => 'pl',
    // Install the package immediately after building (CLI/site build helper).
    'install' => false,
    // Plugin code, events and the widget are refreshed; user settings survive.
    'update' => [
        'plugins' => true,
        'settings' => false,
        'widgets' => true,
    ],
    'static' => [
        'plugins' => false,
    ],
    'log_level' => !empty($_REQUEST['download']) ? 0 : 3,
    'log_target' => PHP_SAPI === 'cli' ? 'ECHO' : 'HTML',
    // Send transport.zip as a download after a web build.
    'download' => !empty($_REQUEST['download']),
];
