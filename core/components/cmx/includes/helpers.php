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

if (!function_exists('cmxGetEffectiveUseEditor')) {
    
    function cmxGetEffectiveUseEditor($modx) {
        if ($modx->controller && !empty($modx->controller->context)) {
            return (bool) $modx->controller->context->getOption('use_editor', $modx->getOption('use_editor'));
        }
        return (bool) $modx->getOption('use_editor');
    }
}

if (!function_exists('cmxGetEffectiveWhichEditor')) {
    /**
     * @param object $modx
     * @return string
     */
    function cmxGetEffectiveWhichEditor($modx) {
        if ($modx->controller && !empty($modx->controller->context)) {
            return trim((string) $modx->controller->context->getOption('which_editor', $modx->getOption('which_editor', '')));
        }
        return trim((string) $modx->getOption('which_editor', ''));
    }
}

if (!function_exists('cmxIsNonCmxRichTextEditor')) {
    /**
     * True when some other editor (TinyMCE, etc.) is selected as the RTE.
     *
     * @param object $modx
     * @return bool
     */
    function cmxIsNonCmxRichTextEditor($modx) {
        $whichEditor = cmxGetEffectiveWhichEditor($modx);
        return $whichEditor !== '' && strcasecmp($whichEditor, 'cmx') !== 0;
    }
}

if (!function_exists('cmxMimeSupportsModxTags')) {
    /**
     * MODX tag highlighting and completion only make sense in template-ish content.
     *
     * @param string $mimeType
     * @return bool
     */
    function cmxMimeSupportsModxTags($mimeType) {
        if ($mimeType === '' || strpos($mimeType, '@FILE:') === 0) {
            return false;
        }
        static $supported = array(
            'text/html' => true,
            'text/x-smarty' => true,
            'text/x-twig' => true,
        );
        return !empty($supported[$mimeType]);
    }
}

if (!function_exists('cmxRateLimit')) {
    /**
     * Simple per-session sliding window for the CMX connector processors
     * (lint, getlexicons). The editor already throttles client-side (a
     * 900 ms lint delay, lexicon search from 2 typed characters); this
     * stops runaway or scripted request loops on the server side.
     *
     * Counts are stored in the manager session. When no session storage
     * is available the limiter degrades open — it must never break the
     * feature it guards.
     *
     * @param object $modx
     * @param string $key processor key ('lint', 'getlexicons', ...)
     * @param int $maxRequests allowed requests inside the window
     * @param int $windowSeconds window length in seconds
     * @return bool true = request allowed, false = over the limit
     */
    function cmxRateLimit($modx, $key, $maxRequests, $windowSeconds) {
        if (!isset($_SESSION) || !is_array($_SESSION)) {
            return true;
        }
        $now = time();
        $slot = 'cmx.rl.' . $key;
        $state = isset($_SESSION[$slot]) && is_array($_SESSION[$slot])
            ? $_SESSION[$slot]
            : array('count' => 0, 'reset' => $now + (int) $windowSeconds);
        if ((int) $state['reset'] <= $now) {
            $state = array('count' => 0, 'reset' => $now + (int) $windowSeconds);
        }
        $state['count'] = (int) $state['count'] + 1;
        $_SESSION[$slot] = $state;
        return $state['count'] <= (int) $maxRequests;
    }
}

if (!function_exists('cmxIsResourceDataPage')) {
    /**
     * Detects the resource "View data" page with the async cache buffer.
     *
     * @param object $modx
     * @return bool
     */
    function cmxIsResourceDataPage($modx) {
        if (!$modx->controller) {
            return false;
        }
        if (!empty($modx->controller->config['controller'])) {
            $controller = strtolower(str_replace('\\', '/', $modx->controller->config['controller']));
            if ($controller === 'resource/data') {
                return true;
            }
        }
        $action = $modx->getOption('action', $_REQUEST, '');
        if ($action === '' && !empty($_REQUEST['a'])) {
            $action = (string) $_REQUEST['a'];
        }
        return strtolower(str_replace('\\', '/', $action)) === 'resource/data';
    }
}
