# CMX

**CMX** is a code editor for the **MODX Revolution** control panel, built on **CodeMirror 6**. It replaces the standard text fields of elements, files, resources and TVs with a full-featured editor that provides syntax highlighting, MODX tag autocompletion, code validation, version history, drafts, search, Emmet, themes and multiple keyboard layouts.

The package runs entirely locally inside the manager: the editor ships as a single compiled JavaScript bundle and does not load CodeMirror, themes or modes from external CDNs.

[![Version](https://img.shields.io/badge/version-1.0.0--pl-de1a68)](https://github.com/vitos88/cmx/releases/tag/v1.0.0)
[![MODX](https://img.shields.io/badge/MODX-3.x-green)](https://modx.com/)
[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777bb3)](https://php.net/)

[Русский &#127479;&#127482;](README.ru.md) | English

<p align="center">
    <picture>
      <img src="image/logo.png" alt="Cmx" style="max-width: 100%; height: auto;">
    </picture>
</p>

## Table of Contents

1. [Installation and Activation](#installation-and-activation)
2. [Where CMX Works](#where-cmx-works)
3. [Editor Features](#editor-features)
4. [TV with CMX Input Type](#tv-with-cmx-input-type)
5. [CMX Scratchpad Widget](#cmx-scratchpad-widget)
6. [Keyboard Shortcuts](#keyboard-shortcuts)
7. [System Settings](#system-settings)
8. [Data Storage and Permissions](#data-storage-and-permissions)
9. [Building](#building)
10. [Changelog](#Changelog)
11. [License](#license)

---

## Installation and Activation

1. In the MODX manager, open **Packages → Package Manager**.
2. Upload [`cmx-1.0.0-pl.transport.zip`](https://github.com/vitos88/Cmx/releases) and install the transport package.
3. During installation CMX:
   - selects itself in the `which_element_editor` system setting;
   - creates the `cmx_revision` version history table;
   - registers the plugin and its events;
   - adds the **CMX Scratchpad** widget.
4. Open or refresh the element editing page.

If the editor was not selected automatically, open **System → System Settings**, find `which_element_editor` and select **cmx**.

To temporarily switch back to the standard field or another editor, change the value of that same setting. Uninstalling CMX is not required for this.

> When the package is uninstalled, the editor selection is reset. The version history table is preserved.

## Where CMX Works

| Form | Language and specifics |
| --- | --- |
| Snippets | PHP without the opening `<?php`; autocompletion of MODX/xPDO API and PHP functions |
| Plugins | PHP without the opening `<?php`; browser-side and server-side syntax checking |
| Chunks | HTML, Fenom or Twig; for static chunks the language is determined by the file extension |
| Templates | HTML with MODX tags, Fenom or Twig |
| Files | The language is determined by the file extension; PHP files support a full `<?php` document |
| TV with `cmx` input type | Language and height are configured in the properties of the specific TV |
| CMX Scratchpad | A personal notepad on the manager dashboard |

If a visual RTE is enabled for a resource, for example TinyMCE, CMX does not replace it.

---

## Editor Features

### Syntax Highlighting

CMX supports:

- PHP, including mixed `PHP + HTML` documents;
- HTML with nested CSS and JavaScript;
- CSS, SCSS and Less;
- JavaScript and JSON;
- SQL;
- XML and SVG;
- Markdown;
- Fenom and Twig;
- MODX tags `[[...]]`.

Each theme contains its own colours for syntax, MODX/Fenom constructs, brackets, diagnostics and the editor panels.

### Semantic Highlighting of MODX Tags

The following are highlighted separately:

- the `[[` and `]]` brackets;
- the uncached call flag `!`;
- the `$`, `*`, `+`, `%`, `~`, `++` prefixes;
- the names of elements, resources, TVs and settings;
- the `?` separator, `&...` properties, `:...` filters and `@...` sets;
- strings in backticks;
- comments `[[-...]]`;
- nested tags, including constructs such as `[[~[[*id]]]]`.

### Autocompletion

Hints appear automatically or on `Ctrl+Space`.

| Context | Suggestions |
| --- | --- |
| `[[` and `[[!` | Snippets and MODX tag type prefixes |
| `[[$` | Chunks |
| `[[*` | TVs and resource fields; on a resource form - the TVs of the current template |
| `[[+` | Resource fields and placeholders already present in the document |
| `[[~` | Resources with ID and title |
| `[[++` | System settings and their current values |
| `[[%...` | Lexicon entries in the manager language |
| `&property` | Parameters of the snippet or chunk being called, their descriptions and default values |
| `:filter` | MODX output filters with descriptions and ready-made values |
| `@set` | Property sets |
| `{...` | Fenom tags, blocks and modifiers; Twig tags and filters |
| `{'name` | Snippets and chunks inside Fenom strings |
| `{'!pdoCrumbs' \| snippet : [...]}` | Snippet parameters in a multi-line Fenom call |
| `{$...` | Fenom variables, resource fields and TVs |
| `{$_modx->...` | modX methods, resource/user/config/placeholders objects |
| `$modx->...`, `$xpdo->...` | MODX/xPDO API methods with signatures |
| A regular word in PHP | Commonly used PHP functions and custom snippets from `cmx.snippets` |

Additionally:

- parameters that have already been used are hidden from subsequent suggestions;
- default values are inserted automatically;
- after selecting a prefix, parameter or filter, the next level of suggestions may open;
- MODX tags and Fenom blocks can be closed automatically;
- block-level Fenom tags are inserted as ready-made skeletons;
- custom snippets are defined in the `label :: text to insert` format;
- suggestion descriptions are localised in Russian and English.

### Go to Element

With the `cmx.goto_definition` setting enabled, hold `Ctrl` on Windows/Linux or `Cmd` on Mac and click a name inside a MODX tag:

- `[[PdoPage]]` - open the snippet;
- `[[$header]]` - open the chunk;
- `[[*tv_name]]` - open the TV;
- `[[~42]]` - open the resource with ID 42.

The element opens **in a new browser tab**, so the current editing form is not lost.

### Hover Hints

With the `cmx.hovers` setting enabled, the editor shows:

- the title and URI of a resource;
- the description of a snippet, chunk or TV;
- the description of a resource field;
- help for MODX output filters;
- help for Fenom modifiers.

### Search, Replace and Multi-Cursors

The search panel opens with `Ctrl+F` or `Cmd+F` and supports:

- regular search and regular expression search;
- case sensitivity;
- whole word search;
- jumping to the next and previous match;
- replacing one or all matches;
- jumping to a line number;
- Russian and English localisation of the panel.

For working with multiple occurrences, `Ctrl/Cmd+D`, `Ctrl/Cmd+Shift+L`, adding cursors above and below, and rectangular selection with the mouse using `Alt`/`Option` are available.

### Editing and Formatting

CMX includes:

- automatic closing of brackets, quotes and HTML tags;
- matching bracket highlighting;
- optional rainbow bracket colouring by nesting level;
- line and block comments;
- increasing and decreasing indentation with `Tab` and `Shift+Tab`;
- soft tabs with configurable width;
- automatic indentation while typing;
- moving, copying and deleting lines;
- code folding;
- selecting an entire line by clicking its number;
- selecting a range of lines by dragging over the line numbers;
- highlighting of the active line and of matches for the selected word;
- display of indent guides and a vertical ruler;
- highlighting and removal of trailing whitespace.

Indentation formatting takes into account HTML, MODX tags and Fenom structure: the bodies of `{if}`, `{foreach}`, `{switch}`, `{block}`, multi-line snippet parameters and closing constructs. Either the whole document or only the selected lines can be processed.

The command is invoked with the **“Format Code”** button, from the command palette, or with the shortcut:

- Windows/Linux: `Shift+Alt+F`;
- macOS: `Cmd+Shift+F`.

### Emmet

In supported HTML, CSS and XML contexts, Emmet abbreviations are underlined as you type and expanded with `Tab`.

For example:

```text
ul.nav>li*5>a
```

The feature is disabled by the `cmx.emmet` setting.

### PHP Validation

With the `cmx.php_lint` setting enabled, two independent levels work:

1. **Browser-side validation** - unmatched and extra brackets, unclosed strings, comments and heredoc/nowdoc. PHP 8 attributes, string interpolation, mixed PHP/HTML documents and snippet code without `<?php` are taken into account.
2. **Validation via PHP CLI** - running `php -l` on the server after a pause in editing. The path to the interpreter is set by the `cmx.php_path` setting.

If PHP CLI is unavailable or `exec()` is disabled by the host, server-side validation is turned off while browser-side validation keeps working.

### CSS Validation

The `cmx.css_lint` setting enables validation of CSS files and `<style>` blocks:

- unknown properties;
- probable typos with a suggested similar name;
- unclosed and extra curly braces;
- warnings for unknown vendor-prefixed properties.

CSS variables, common hacks, SCSS/Less constructs and MODX/Fenom/Twig tags are not treated as errors.

### Fenom and MODX Tag Validation

The `cmx.template_lint` setting enables diagnostics for:

- unclosed and mismatched block-level Fenom tags;
- unclosed quotes inside a tag;
- an unclosed `[[` MODX tag;
- an unmatched backtick inside a MODX tag;
- unmatched brackets inside Fenom constructs.

The scanner distinguishes template tags from ordinary CSS/JavaScript curly braces and takes strings, comments and `{ignore}` blocks into account.

Errors are underlined and their number is shown in the status bar. On save, CMX can display the list of critical errors and ask for confirmation (`cmx.warn_on_save`). Saving is never blocked outright: the user can deliberately save incomplete code.

### Drafts

With the `cmx.autosave` setting enabled, the working copy is saved to the browser `localStorage` of the current manager.

After a failure or when the page is opened again, CMX offers to:

- compare the saved document and the draft in a side-by-side diff;
- restore the draft;
- discard the draft.

The retention period is set by the `cmx.autosave_lifetime` setting. Drafts are never sent to the server.

### Version History

With the `cmx.versions` setting enabled, CMX saves snapshots of snippets, chunks, templates, plugins and resources to the `cmx_revision` table.

The history panel allows you to:

- view the time, author and size of a snapshot;
- open a version in a read-only editor;
- load a version into the current editor without saving it immediately;
- copy the code of a version;
- mark two versions and compare them line by line;
- download the history of an element as JSON.

The number of stored snapshots is limited by the `cmx.versions_max` setting. Repeated identical snapshots within a short interval are not created. When an element is deleted, its history is deleted as well; when the trash is permanently emptied, the history of the corresponding resources is removed. Files in the file manager are not versioned.

### Command and Element Palettes

The **command palette** opens with `Ctrl/Cmd+Shift+P` and contains search, go-to-line, formatting, trailing whitespace removal, commenting, code folding, theme and font switching, word wrap, history, media browser and fullscreen mode commands.

The **element palette** opens with the `{ }` button: it lets you find a snippet, chunk, TV or resource and insert the corresponding MODX tag at the cursor position.

### Media Browser

For HTML documents with MODX tags, the image button opens the built-in MODX media browser. The selected file is inserted into the editor as a path, while an image is inserted as a ready-made `<img>` tag.

Setting: `cmx.media_button`.

### Themes and Appearance

12 appearance variants are available:

- Auto - follows the system light or dark theme;
- Manager - detects the colour mode of the manager;
- GitHub Light;
- Quiet Light;
- Solarized Light;
- One Dark;
- Dracula;
- Nord;
- Gruvbox Dark;
- VS Code Dark+;
- Monokai;
- Solarized Dark.

The theme can be changed with the button on the panel, by clicking the theme name in the status bar, or via the quick menu. Font, font size and word wrap are configured separately.

### Toolbar and Status Bar

The toolbar provides: theme, quick settings, fullscreen mode, formatting, command palette, element insertion, media browser and version history. Its contents depend on the settings and the type of document.

The status bar shows:

- the line and column number;
- the size of the selection;
- the number of lines and characters;
- the document language;
- the current theme;
- the number of errors and warnings.

The quick menu saves the theme, font size and word wrap in the browser of the specific manager. The reset command restores the system values.

### Keyboard Layouts

The `cmx.keymap` setting supports:

- `standard` - standard CodeMirror commands;
- `sublime` - additional familiar Sublime Text shortcuts;
- `vim` - Normal/Insert/Visual modes, motions, operators, search, registers and macros via `@replit/codemirror-vim`.

---

## TV with CMX Input Type

CMX registers its own input type for Template Variables.

1. Create or open a TV.
2. On the Input Options tab, select the **cmx** type.
3. Set the optional properties:
   - `language` - `text/html`, `text/css`, `application/javascript`, `application/json`, `text/x-sql`, `application/xml`, `text/x-markdown` or `application/x-php`;
   - `height` - the editor height in pixels, minimum 100, default 260.
4. Add the TV to the required template.

On the resource page the TV is rendered as a full CMX editor. The value is saved as an ordinary TV and remains in the editor after the resource is saved.

The feature is disabled by the `cmx.tv` setting.

## CMX Scratchpad Widget

**CMX Scratchpad** is a personal notepad with syntax highlighting for the MODX dashboard.

Adding it: **Dashboard → Edit → Widgets → CMX Scratchpad**.

The text is stored only in the browser `localStorage` of the current manager and is never sent to the server.

---

## Keyboard Shortcuts

The full list is in the [COMMANDS.md](COMMANDS.md) file.

Main shortcuts:

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| Save the MODX form | `Ctrl+S` | `Cmd+S` |
| Command palette | `Ctrl+Shift+P` | `Cmd+Shift+P` |
| Search and replace | `Ctrl+F` | `Cmd+F` |
| Autocompletion | `Ctrl+Space` | `Ctrl+Space` |
| Format code | `Shift+Alt+F` | `Cmd+Shift+F` |
| Go to line | `Ctrl+Alt+G` | `Ctrl+G` |
| Undo / redo | `Ctrl+Z` / `Ctrl+Y` | `Cmd+Z` / `Cmd+Shift+Z` |
| Next occurrence | `Ctrl+D` | `Cmd+D` |
| All occurrences | `Ctrl+Shift+L` | `Cmd+Shift+L` |
| Comment | `Ctrl+/` | `Cmd+/` |
| Go to element | `Ctrl` + click | `Cmd` + click |

On Mac the Alt key is called **Option (⌥)**. For letter commands that macOS may turn into special characters, separate shortcuts without Option are provided.

## System Settings

The package adds **50 settings** in the `cmx` namespace, distributed across five sections. They can be overridden for an individual user via **Users → user → Settings**.

| Section | Settings |
| --- | --- |
| General | `cmx.theme`, `cmx.height`, `cmx.toolbar`, `cmx.statusbar`, `cmx.command_palette` |
| Appearance | `cmx.font_family`, `cmx.font_size`, `cmx.line_numbers`, `cmx.active_line`, `cmx.fold_gutter`, `cmx.word_wrap`, `cmx.bracket_matching`, `cmx.bracket_colors`, `cmx.indent_guides`, `cmx.ruler`, `cmx.highlight_trailing` |
| Editing | `cmx.soft_tabs`, `cmx.tab_size`, `cmx.close_brackets`, `cmx.auto_close_tags`, `cmx.format_button`, `cmx.search_panel`, `cmx.highlight_matches`, `cmx.emmet`, `cmx.autosave`, `cmx.autosave_lifetime`, `cmx.keymap`, `cmx.trim_trailing` |
| MODX | `cmx.goto_definition`, `cmx.hovers`, `cmx.media_button`, `cmx.versions`, `cmx.versions_max`, `cmx.php_lint`, `cmx.php_path`, `cmx.css_lint`, `cmx.template_lint`, `cmx.warn_on_save`, `cmx.tv` |
| Autocompletion | `cmx.autocomplete`, `cmx.autocomplete_modx`, `cmx.autocomplete_fenom`, `cmx.autocomplete_php`, `cmx.autocomplete_settings`, `cmx.autocomplete_lexicons`, `cmx.autocomplete_api`, `cmx.autocomplete.insert_defaults`, `cmx.autocomplete.close_tags`, `cmx.autocomplete.skeletons`, `cmx.snippets` |

Custom snippets for `cmx.snippets` are defined one per line:

```text
My snippet :: text to insert
```

## Data Storage and Permissions

- Drafts and the Scratchpad are stored locally in the user's browser.
- The version history is stored in the database of the current MODX site.
- Autocompletion, lexicon and history requests go through the CMX connector with a manager permission check.
- Reading and exporting history is restricted by the permissions for the corresponding element type.
- Server-side PHP validation runs on the current server; no external validation service is used.
- For `lint` and `getlexicons`, an additional per-session request rate limit applies in the manager session.
- No external CDNs are required to load the editor.

## Building

### Building the Transport Package

From the project root:

```bash
php _build/build.php
```

The resulting `cmx-1.0.0-pl.transport.zip` file is saved to the `core/packages/` directory of the MODX installation. Automatic installation and downloading after the build are controlled by the `install` and `download` parameters in `_build/config.inc.php`.

## Changelog

First public release.

**Code editor:** CodeMirror 6 for snippets, plugins, chunks, templates, files, resource content without RTE, the resource/data cache buffer and Template Variables. Highlighting for PHP, HTML, CSS/SCSS/Less, JavaScript, JSON, SQL, XML/SVG, Markdown, Fenom, Twig and MODX tags.

**MODX integration:**

- Semantic highlighting of MODX tags and autocompletion of snippets, chunks, TVs, resource fields, placeholders, resources, system settings, lexicons, property sets, output filters and snippet/chunk parameters.
- Fenom and Twig autocompletion: block skeletons, modifiers, snippet parameters, `$_modx` objects and fields.
- Offline hints for MODX/xPDO API and PHP functions with signatures.
- Ctrl/Cmd-click navigation from a MODX tag to the element in a new browser tab.
- Hover hints for resources, elements, resource fields, output filters and Fenom modifiers.

**Workflow convenience:**

- Search and replace with regular expressions, case sensitivity and whole word search.
- Multi-cursors, match highlighting and rectangular selection.
- Command and element palettes, media browser, fullscreen mode and Emmet.
- Automatic indentation for HTML, Fenom and MODX constructs; formatting of the whole document or of a selection.
- Standard, Sublime Text and Vim layouts; separate macOS shortcuts for letter commands where Option inserts special characters.
- Twelve themes, code folding, matching and rainbow brackets, indent guides, a ruler, word wrap and a status bar.
- Local drafts with a line-by-line comparison before restoring.

**Code quality and history:**

- Browser-side PHP validation plus optional server-side validation via `php -l`.
- Diagnostics of CSS typos and braces in files and `<style>` blocks.
- Validation of Fenom/MODX templates and an optional warning before saving code with errors.
- Version history for elements and resources: viewing, restoring, copying, comparing two versions and JSON export.
- Permission checks for connector actions and rate limiting for resource-intensive requests.

## License

CMX is distributed under the terms of the **GNU General Public License v2.0 or, at your option, any later version**.