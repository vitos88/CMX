<?php
/**
 * Settings Language file for CMX.
 *
 * @package cmx
 * @subpackage lexicon
 */

$_lang['area_general'] = 'General';
$_lang['area_appearance'] = 'Appearance';
$_lang['area_editing'] = 'Editing';
$_lang['area_modx'] = 'MODX';
$_lang['area_completion'] = 'Autocompletion';

$_lang['setting_cmx.theme'] = 'Editor theme';
$_lang['setting_cmx.theme_desc'] = 'Themes: auto (follows the OS color scheme), manager (match the light/dark manager), light, light-quiet, light-solarized, dark, dark-dracula, dark-nord, dark-gruvbox, dark-vscode, dark-monokai, dark-solarized. The theme can also be switched right in the editor toolbar; that choice is stored per user in the browser.';
$_lang['setting_cmx.height'] = 'Edit area height';
$_lang['setting_cmx.height_desc'] = 'Editor height in pixels, e.g. 480. If left blank, the height of the replaced field is used.';
$_lang['setting_cmx.toolbar'] = 'Toolbar';
$_lang['setting_cmx.toolbar_desc'] = 'Show the toolbar (theme toggle, command palette, version history, media browser, fullscreen) in the top right corner of the editor.';
$_lang['setting_cmx.statusbar'] = 'Status bar';
$_lang['setting_cmx.statusbar_desc'] = 'Show the status bar: line / column, selection size, document size, language and the current theme (click the theme name to switch it).';
$_lang['setting_cmx.command_palette'] = 'Command palette';
$_lang['setting_cmx.command_palette_desc'] = 'Command palette (Ctrl/Cmd-Shift-P): search every editor command — theme, wrap, folding, reindent, goto line, insert element, history and more.';

$_lang['setting_cmx.font_family'] = 'Font';
$_lang['setting_cmx.font_family_desc'] = 'Font family of the editor, e.g. "JetBrains Mono", Consolas or monospace. Leave blank for the default monospace stack.';
$_lang['setting_cmx.font_size'] = 'Font size';
$_lang['setting_cmx.font_size_desc'] = 'Editor font size in pixels, e.g. 13 or 15 (10-28).';
$_lang['setting_cmx.line_numbers'] = 'Line numbers';
$_lang['setting_cmx.line_numbers_desc'] = 'Show line numbers in the gutter.';
$_lang['setting_cmx.active_line'] = 'Highlight active line';
$_lang['setting_cmx.active_line_desc'] = 'Highlight the line the cursor is on.';
$_lang['setting_cmx.fold_gutter'] = 'Code folding';
$_lang['setting_cmx.fold_gutter_desc'] = 'Show the folding arrows in the gutter and allow collapsing blocks (HTML tags, CSS blocks, comments).';
$_lang['setting_cmx.word_wrap'] = 'Word wrap';
$_lang['setting_cmx.word_wrap_desc'] = 'Wrap long lines instead of horizontal scrolling.';
$_lang['setting_cmx.bracket_matching'] = 'Bracket matching';
$_lang['setting_cmx.bracket_matching_desc'] = 'Highlight the bracket pair the cursor is on (also inside MODX tags).';
$_lang['setting_cmx.bracket_colors'] = 'Bracket pair colors';
$_lang['setting_cmx.bracket_colors_desc'] = 'Colorize bracket pairs by nesting depth ("rainbow brackets"). Brackets inside strings, comments, MODX tags and Fenom/Twig tags are not colorized.';
$_lang['setting_cmx.indent_guides'] = 'Indentation guides';
$_lang['setting_cmx.indent_guides_desc'] = 'Draw vertical indentation guide lines at every nesting level.';
$_lang['setting_cmx.ruler'] = 'Vertical ruler';
$_lang['setting_cmx.ruler_desc'] = 'Show a thin vertical line at the given column, e.g. 80 or 120. 0 = off.';
$_lang['setting_cmx.highlight_trailing'] = 'Highlight trailing whitespace';
$_lang['setting_cmx.highlight_trailing_desc'] = 'Highlight spaces and tabs at the end of lines.';

$_lang['setting_cmx.soft_tabs'] = 'Soft tabs';
$_lang['setting_cmx.soft_tabs_desc'] = 'Insert spaces instead of a tab character.';
$_lang['setting_cmx.tab_size'] = 'Tab size';
$_lang['setting_cmx.tab_size_desc'] = 'Number of spaces per indent level (2-8).';
$_lang['setting_cmx.close_brackets'] = 'Auto close brackets';
$_lang['setting_cmx.close_brackets_desc'] = 'Automatically close (), [], {}, quotes when typing.';
$_lang['setting_cmx.auto_close_tags'] = 'Auto close tags';
$_lang['setting_cmx.auto_close_tags_desc'] = 'Automatically close HTML tags while typing.';
$_lang['setting_cmx.format_button'] = 'Format code button';
$_lang['setting_cmx.format_button_desc'] = 'Toolbar button: re-indent the whole document (or the selected lines) with the Fenom/MODX-aware rules — same as Shift-Alt-F. Only leading whitespace changes.';
$_lang['setting_cmx.search_panel'] = 'Search & replace panel';
$_lang['setting_cmx.search_panel_desc'] = 'Enable the search & replace panel (Ctrl/Cmd-F) with regular expressions support.';
$_lang['setting_cmx.highlight_matches'] = 'Highlight selection matches';
$_lang['setting_cmx.highlight_matches_desc'] = 'Highlight all occurrences of the selected word in the document.';
$_lang['setting_cmx.emmet'] = 'Emmet';
$_lang['setting_cmx.emmet_desc'] = 'Emmet abbreviations in HTML/CSS/XML documents: type an abbreviation like ul.nav>li*5 and press Tab to expand. A preview appears while typing.';
$_lang['setting_cmx.autosave'] = 'Autosave drafts';
$_lang['setting_cmx.autosave_desc'] = 'Periodically save the working copy of the document in the browser (localStorage). After a crash or an accidentally closed tab the editor offers to restore the draft.';
$_lang['setting_cmx.autosave_lifetime'] = 'Draft lifetime';
$_lang['setting_cmx.autosave_lifetime_desc'] = 'How long an unsaved draft stays restorable, in minutes (e.g. 240 = 4 hours). 0 = until it is restored or discarded.';
$_lang['setting_cmx.keymap'] = 'Keymap';
$_lang['setting_cmx.keymap_desc'] = 'standard (default CodeMirror), sublime (Sublime Text: Alt-Up/Down move line, Shift-Alt-Up/Down duplicate, Ctrl/Cmd-Shift-K delete line, Ctrl/Cmd-L select line, Ctrl/Cmd-/ toggle comment) or vim (full Vim emulation by Replit).';
$_lang['setting_cmx.trim_trailing'] = 'Trim trailing whitespace on save';
$_lang['setting_cmx.trim_trailing_desc'] = 'Automatically remove trailing spaces and tabs from lines when the form is submitted.';

$_lang['setting_cmx.goto_definition'] = 'Go to element (Ctrl/Cmd-click)';
$_lang['setting_cmx.goto_definition_desc'] = 'Ctrl/Cmd-click on a MODX tag opens its edit form: [[snippet]] — snippet, [[$chunk]] — chunk, [[*tv]] — TV, [[~id]] — resource.';
$_lang['setting_cmx.hovers'] = 'Hover tooltips';
$_lang['setting_cmx.hovers_desc'] = 'Show tooltips on MODX tags: resource title and URL for [[~id]], snippet/chunk/TV descriptions, help for output filters (:isempty, :cat ...) and Fenom modifiers.';
$_lang['setting_cmx.media_button'] = 'Media browser button';
$_lang['setting_cmx.media_button_desc'] = 'Toolbar button (for HTML documents with MODX tags): opens the standard manager media browser and inserts the picked file (path, or an <img> for images).';
$_lang['setting_cmx.versions'] = 'Version history';
$_lang['setting_cmx.versions_desc'] = 'Save a code snapshot on every save of a snippet, chunk, template, plugin or resource (own table). The clock button lists the versions; any of them can be viewed, compared with another, exported as a JSON file and loaded back into the editor. Deleting an element deletes its history. Files in the file manager are not versioned.';
$_lang['setting_cmx.versions_max'] = 'Version history depth';
$_lang['setting_cmx.versions_max_desc'] = 'How many last snapshots to keep per element (e.g. 20). Older ones are pruned automatically.';
$_lang['setting_cmx.php_lint'] = 'PHP syntax check';
$_lang['setting_cmx.php_lint_desc'] = 'Check snippet/plugin/PHP file code while pausing typing: errors are underlined, the message appears on hover. The basic check (brackets, strings, heredocs) always runs right in the browser; the full parse runs via php -l on the server when the PHP CLI is available.';
$_lang['setting_cmx.css_lint'] = 'CSS check';
$_lang['setting_cmx.css_lint_desc'] = 'Underline CSS errors: unknown properties (typos like paddings instead of padding — with the correct name suggested), unclosed and stray braces. Works in CSS/SCSS/LESS files and in the <style> blocks of templates; MODX and Fenom tags inside the CSS never interfere.';
$_lang['setting_cmx.php_path'] = 'PHP CLI path';
$_lang['setting_cmx.php_path_desc'] = 'Command or path of the PHP CLI used for the syntax check, default php (from PATH). Example: /usr/bin/php8.2.';
$_lang['setting_cmx.tv'] = 'TV input type "cmx"';
$_lang['setting_cmx.tv_desc'] = 'Register the "cmx" TV input type: any template variable can be edited with the full editor right inside the resource form. The language comes from the TV property "language"; when not set, the TV is edited like a site template (HTML + Fenom when the pdoTools parser is on).';

$_lang['setting_cmx.autocomplete'] = 'Autocompletion';
$_lang['setting_cmx.autocomplete_desc'] = 'Master switch for autocompletion (Ctrl/Space also opens it explicitly).';
$_lang['setting_cmx.autocomplete_modx'] = 'Autocomplete MODX tags';
$_lang['setting_cmx.autocomplete_modx_desc'] = 'Suggest snippets, chunks, templates, TVs and resource fields inside [[ ... ]] tags; snippet properties after & (with descriptions; already used ones are hidden, &property=`value` is inserted by default — see "Insert default values"), property sets after @, resources for [[~id]], MODX output filters after : (filters that take a value are inserted as :date=`format`). On a resource form [[*]] offers only the TVs of the current template. The lists are fetched from the site with your element permissions.';
$_lang['setting_cmx.autocomplete_fenom'] = 'Autocomplete Fenom / Twig';
$_lang['setting_cmx.autocomplete_fenom_desc'] = 'Full Fenom/pdoTools completion: tags ({if, {foreach, {include ...) after { with ready skeletons; snippet and chunk names inside {\'...\' | snippet and {include \'...\'}; modifiers (|upper, |decl, |snippet, |chunk ...) after |, spaces around | allowed; resource fields after {$_modx->resource. and user fields after {$_modx->user.; fields and TVs after {$; system setting keys after {$_modx->config. Twig tags and filters are suggested for text/x-twig.';
$_lang['setting_cmx.autocomplete_php'] = 'Autocomplete PHP';
$_lang['setting_cmx.autocomplete_php_desc'] = 'Suggest PHP keywords and ~200 frequently used functions (with signatures) while editing snippets, plugins and PHP files.';
$_lang['setting_cmx.autocomplete_settings'] = 'Autocomplete [[++settings]]';
$_lang['setting_cmx.autocomplete_settings_desc'] = 'Suggest system setting keys inside [[++...]] tags with their current value (requires the Settings permission).';
$_lang['setting_cmx.autocomplete_lexicons'] = 'Autocomplete [[%lexicons]]';
$_lang['setting_cmx.autocomplete_lexicons_desc'] = 'Suggest lexicon entries inside [[%...]] tags with their text and topic (requires the Lexicons permission); results are limited to the manager language of the current user. Searching as you type from 2 characters.';
$_lang['setting_cmx.autocomplete_api'] = 'Autocomplete MODX API';
$_lang['setting_cmx.autocomplete_api_desc'] = 'Suggest MODX/xPDO methods in PHP code: $modx->getOption(...), $modx->getChunk(...), $modx->resource->getTVValue(...), $xpdo->newQuery(...) and more — with signatures and descriptions, offline.';
$_lang['setting_cmx.snippets'] = 'User snippets';
$_lang['setting_cmx.snippets_desc'] = 'Your own completion snippets, one per line in the format: label :: text to insert. Multi-line insert text is allowed. Example: bootstrap5card :: <div class="card"><div class="card-body">|</div></div>. They are suggested while typing the label (min. 2 characters) or via Ctrl/Space.';

$_lang['setting_cmx.template_lint'] = 'Template tag lint';
$_lang['setting_cmx.template_lint_desc'] = 'Check the balance of Fenom tags ({if} without {/if}, {foreach}/{/foreach}, {switch}, {block}, {literal}, {ignore} ...) and unclosed MODX tags ([[ without ]]) while typing: errors are underlined, the status bar shows an error counter (click it to jump to the next error). CSS/JS braces are never treated as tags.';
$_lang['setting_cmx.warn_on_save'] = 'Warn when saving with errors';
$_lang['setting_cmx.warn_on_save_desc'] = 'On Save (the toolbar button or Ctrl/Cmd-S), when the editor reports errors (unclosed Fenom tags, [[ without ]], PHP syntax), ask for a confirmation: save anyway or stay and fix. Turn off to save without the question.';
$_lang['setting_cmx.autocomplete.insert_defaults'] = 'Insert default values';
$_lang['setting_cmx.autocomplete.insert_defaults_desc'] = 'When a snippet property is picked from the completion, insert &property=`default value` right away (the value comes from the snippet Default Properties). Works for output filters too: :date=`%d.%m.%Y`, :limit=`100`, :userinfo=`fullname`, etc. Turn off to insert only the property name.';
$_lang['setting_cmx.autocomplete.close_tags'] = 'Close MODX tags on selection';
$_lang['setting_cmx.autocomplete.close_tags_desc'] = 'When an element name is picked from the completion, append ]] and place the cursor before the closing brackets — ready to type a :filter or ? &properties.';
$_lang['setting_cmx.autocomplete.skeletons'] = 'Fenom tag skeletons';
$_lang['setting_cmx.autocomplete.skeletons_desc'] = 'When a Fenom block tag is picked from the completion, insert the whole construct with the closing tag and the cursor at the condition: {if }...{/if}, {foreach $rows as $row}...{/foreach}, {switch }...{case 1}...{default}...{/switch}, {include \'\'} and more. Makes saving an unclosed tag much harder.';
