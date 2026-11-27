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

$success = true;
$log = function ($message) use ($object) {
    $object->xpdo->log(xPDO::LOG_LEVEL_INFO, $message);
};

if ($pluginid = $object->get('id')) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $log('[CMX] Running installation resolver...');

            $setting = $object->xpdo->getObject('modSystemSetting', ['key' => 'which_element_editor']);
            if ($setting) {
                $current = trim((string) $setting->get('value'));
                if ($options[xPDOTransport::PACKAGE_ACTION] === xPDOTransport::ACTION_INSTALL) {
                    // On fresh install, always set default to cmx
                    $setting->set('value', 'cmx');
                    $setting->save();
                    $log('✓ Set default element editor to cmx (which_element_editor) on install');
                } elseif ($options[xPDOTransport::PACKAGE_ACTION] === xPDOTransport::ACTION_UPGRADE && ($current === '' || $current === 'CMX')) {
                    // On upgrade, set only if the setting is empty (or a broken pre-1.0.1 value)
                    $setting->set('value', 'cmx');
                    $setting->save();
                    $log('✓ Set default element editor to cmx (which_element_editor) on upgrade');
                } else {
                    // Preserve existing custom editor choice
                    $log('✓ which_element_editor already set to "' . $current . '", not overriding');
                }
            }
            unset($setting);

            // Register the custom theme combo without resetting the selected theme.
            $themeSetting = $object->xpdo->getObject('modSystemSetting', ['key' => 'cmx.theme']);
            if ($themeSetting && $themeSetting->get('xtype') !== 'cmx-combo-theme') {
                $themeSetting->set('xtype', 'cmx-combo-theme');
                if ($themeSetting->save()) {
                    $log('✓ Updated cmx.theme xtype to cmx-combo-theme');
                }
            }
            unset($themeSetting);

            // Register the custom keymap combo without resetting the selected keymap.
            $keymapSetting = $object->xpdo->getObject('modSystemSetting', ['key' => 'cmx.keymap']);
            if ($keymapSetting && $keymapSetting->get('xtype') !== 'cmx-combo-keymap') {
                $keymapSetting->set('xtype', 'cmx-combo-keymap');
                if ($keymapSetting->save()) {
                    $log('✓ Updated cmx.keymap xtype to cmx-combo-keymap');
                }
            }
            unset($keymapSetting);

            // Drop legacy underscore settings from the pre-1.0.1 package structure
            $legacyKeys = [
                'cmx_enable',
                'cmx_theme',
                'cmx_font_size',
                'cmx_tab_size',
                'cmx_line_wrapping',
                'cmx_height',
                'cmx_autocomplete',
            ];
            $removed = 0;
            foreach ($legacyKeys as $key) {
                if ($object->xpdo->removeObject('modSystemSetting', ['key' => $key])) {
                    $removed++;
                }
            }
            if ($removed) {
                $log('✓ Removed ' . $removed . ' legacy (pre-1.0.1) settings');
            }

            // 3.0: revision table for the element history
            $corePath = $object->xpdo->getOption('cmx.core_path', null, $object->xpdo->getOption('core_path') . 'components/cmx/');
            if (file_exists($corePath . 'includes/revisions.php')) {
                require_once $corePath . 'includes/revisions.php';
                if (cmxRevisionCreateTable($object->xpdo)) {
                    $log('✓ Revision table ready (cmx_revision)');
                }
            } else {
                $object->xpdo->log(xPDO::LOG_LEVEL_WARN, '[CMX] includes/revisions.php not found — history disabled');
            }

            // 3.0: "CMX Scratchpad" dashboard widget (type file). The file
            // path supports the [[++core_path]] placeholder, so it keeps
            // working when the installation moves.
            $widget = $object->xpdo->getObject('modDashboardWidget', array('name' => 'CMX Scratchpad'));
            if (!$widget) {
                $widget = $object->xpdo->newObject('modDashboardWidget');
            }
            $widget->fromArray(array(
                'name' => 'CMX Scratchpad',
                'description' => 'Quick private notes and code sketches with the CMX editor (stored in your browser).',
                'type' => 'file',
                'content' => '[[++core_path]]components/cmx/elements/widgets/scratchpad.php',
                'namespace' => 'cmx',
                'lexicon' => 'cmx:default',
                'size' => 'half',
            ), '', true, true);
            if ($widget->save()) {
                $log('✓ Dashboard widget "CMX Scratchpad" available (add it via Dashboard → Edit)');
            }
            unset($widget);

            $log('[CMX] Default editor and settings configured.');
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            $setting = $object->xpdo->getObject('modSystemSetting', ['key' => 'which_element_editor']);
            if ($setting && trim((string) $setting->get('value')) === 'cmx') {
                $setting->set('value', '');
                $setting->save();
                $log('✓ Reset which_element_editor (was "cmx") — the manager falls back to plain textareas');
            }

            // remove the scratchpad widget; keep the revision table and
            // its data (nothing sensitive, but a site owner may still want
            // the history after removing the editor)
            if ($object->xpdo->removeObject('modDashboardWidget', array('name' => 'CMX Scratchpad'))) {
                $log('✓ Removed the "CMX Scratchpad" dashboard widget');
            }
            break;
    }
}

$log('✅ [CMX] Resolver completed.');
return $success;
