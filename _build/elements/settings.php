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

$settings = array();

function cmxSetting($modx, $key, $xtype, $value, $area) {
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array(
        'key' => $key,
        'xtype' => $xtype,
        'value' => $value,
        'namespace' => 'cmx',
        'area' => $area,
    ), '', true, true);
    return $setting;
}

/* ----- general ----------------------------------------------------- */
$settings['theme'] = cmxSetting($modx, 'cmx.theme', 'cmx-combo-theme', 'auto', 'general');
$settings['height'] = cmxSetting($modx, 'cmx.height', 'textfield', '', 'general');
$settings['toolbar'] = cmxSetting($modx, 'cmx.toolbar', 'combo-boolean', '1', 'general');
$settings['statusbar'] = cmxSetting($modx, 'cmx.statusbar', 'combo-boolean', '1', 'general');
$settings['command_palette'] = cmxSetting($modx, 'cmx.command_palette', 'combo-boolean', '1', 'general');

/* ----- appearance --------------------------------------------------- */
$settings['font_family'] = cmxSetting($modx, 'cmx.font_family', 'textfield', '', 'appearance');
$settings['font_size'] = cmxSetting($modx, 'cmx.font_size', 'textfield', '13', 'appearance');
$settings['line_numbers'] = cmxSetting($modx, 'cmx.line_numbers', 'combo-boolean', '1', 'appearance');
$settings['active_line'] = cmxSetting($modx, 'cmx.active_line', 'combo-boolean', '1', 'appearance');
$settings['fold_gutter'] = cmxSetting($modx, 'cmx.fold_gutter', 'combo-boolean', '1', 'appearance');
$settings['word_wrap'] = cmxSetting($modx, 'cmx.word_wrap', 'combo-boolean', '0', 'appearance');
$settings['bracket_matching'] = cmxSetting($modx, 'cmx.bracket_matching', 'combo-boolean', '1', 'appearance');
$settings['bracket_colors'] = cmxSetting($modx, 'cmx.bracket_colors', 'combo-boolean', '0', 'appearance');
$settings['indent_guides'] = cmxSetting($modx, 'cmx.indent_guides', 'combo-boolean', '1', 'appearance');
$settings['ruler'] = cmxSetting($modx, 'cmx.ruler', 'textfield', '0', 'appearance');
$settings['highlight_trailing'] = cmxSetting($modx, 'cmx.highlight_trailing', 'combo-boolean', '1', 'appearance');

/* ----- editing ------------------------------------------------------ */
$settings['soft_tabs'] = cmxSetting($modx, 'cmx.soft_tabs', 'combo-boolean', '1', 'editing');
$settings['tab_size'] = cmxSetting($modx, 'cmx.tab_size', 'textfield', '4', 'editing');
$settings['close_brackets'] = cmxSetting($modx, 'cmx.close_brackets', 'combo-boolean', '1', 'editing');
$settings['auto_close_tags'] = cmxSetting($modx, 'cmx.auto_close_tags', 'combo-boolean', '1', 'editing');
$settings['format_button'] = cmxSetting($modx, 'cmx.format_button', 'combo-boolean', '1', 'editing');
$settings['search_panel'] = cmxSetting($modx, 'cmx.search_panel', 'combo-boolean', '1', 'editing');
$settings['highlight_matches'] = cmxSetting($modx, 'cmx.highlight_matches', 'combo-boolean', '1', 'editing');
$settings['emmet'] = cmxSetting($modx, 'cmx.emmet', 'combo-boolean', '1', 'editing');
$settings['autosave'] = cmxSetting($modx, 'cmx.autosave', 'combo-boolean', '1', 'editing');
$settings['autosave_lifetime'] = cmxSetting($modx, 'cmx.autosave_lifetime', 'textfield', '240', 'editing');
$settings['keymap'] = cmxSetting($modx, 'cmx.keymap', 'cmx-combo-keymap', 'standard', 'editing');
$settings['trim_trailing'] = cmxSetting($modx, 'cmx.trim_trailing', 'combo-boolean', '0', 'editing');

/* ----- modx ---------------------------------------------------------- */
$settings['goto_definition'] = cmxSetting($modx, 'cmx.goto_definition', 'combo-boolean', '1', 'modx');
$settings['hovers'] = cmxSetting($modx, 'cmx.hovers', 'combo-boolean', '1', 'modx');
$settings['media_button'] = cmxSetting($modx, 'cmx.media_button', 'combo-boolean', '1', 'modx');
$settings['versions'] = cmxSetting($modx, 'cmx.versions', 'combo-boolean', '1', 'modx');
$settings['versions_max'] = cmxSetting($modx, 'cmx.versions_max', 'textfield', '20', 'modx');
$settings['php_lint'] = cmxSetting($modx, 'cmx.php_lint', 'combo-boolean', '1', 'modx');
$settings['css_lint'] = cmxSetting($modx, 'cmx.css_lint', 'combo-boolean', '1', 'modx');
$settings['php_path'] = cmxSetting($modx, 'cmx.php_path', 'textfield', 'php', 'modx');
$settings['tv'] = cmxSetting($modx, 'cmx.tv', 'combo-boolean', '1', 'modx');
$settings['template_lint'] = cmxSetting($modx, 'cmx.template_lint', 'combo-boolean', '1', 'modx');
$settings['warn_on_save'] = cmxSetting($modx, 'cmx.warn_on_save', 'combo-boolean', '1', 'modx');

/* ----- completion ---------------------------------------------------- */
$settings['autocomplete'] = cmxSetting($modx, 'cmx.autocomplete', 'combo-boolean', '1', 'completion');
$settings['autocomplete_modx'] = cmxSetting($modx, 'cmx.autocomplete_modx', 'combo-boolean', '1', 'completion');
$settings['autocomplete_fenom'] = cmxSetting($modx, 'cmx.autocomplete_fenom', 'combo-boolean', '1', 'completion');
$settings['autocomplete_php'] = cmxSetting($modx, 'cmx.autocomplete_php', 'combo-boolean', '1', 'completion');
$settings['autocomplete_settings'] = cmxSetting($modx, 'cmx.autocomplete_settings', 'combo-boolean', '1', 'completion');
$settings['autocomplete_lexicons'] = cmxSetting($modx, 'cmx.autocomplete_lexicons', 'combo-boolean', '1', 'completion');
$settings['autocomplete_api'] = cmxSetting($modx, 'cmx.autocomplete_api', 'combo-boolean', '1', 'completion');
$settings['insert_defaults'] = cmxSetting($modx, 'cmx.autocomplete.insert_defaults', 'combo-boolean', '1', 'completion');
$settings['close_tags'] = cmxSetting($modx, 'cmx.autocomplete.close_tags', 'combo-boolean', '1', 'completion');
$settings['skeletons'] = cmxSetting($modx, 'cmx.autocomplete.skeletons', 'combo-boolean', '1', 'completion');
$settings['snippets'] = cmxSetting($modx, 'cmx.snippets', 'textarea', '', 'completion');

return $settings;
