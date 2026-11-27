CMX
==============

## 🇬🇧 English
----------------

CMX 1.0.0-pl is a CodeMirror 6 code editor for the MODX Revolution 3 manager. It supports snippets, plugins, chunks, templates, files, resource content without an RTE, the resource/data cache buffer and Template Variables.

### Installation

1. Install `cmx-1.0.0-pl.transport.zip` through Package Management.
2. The installer selects `cmx` in the `which_element_editor` system setting, creates the revision table and registers the CMX Scratchpad dashboard widget.
3. Reload the manager page after installation.

To select the editor manually, open **System → System Settings → which_element_editor** and choose **cmx**. Choose another value in the same setting to switch back without uninstalling CMX.

### Editor

CMX provides syntax highlighting, MODX/Fenom/Twig autocomplete, MODX/xPDO and PHP API hints, Ctrl/Cmd-click navigation, hover information, search and replace, multiple cursors, Emmet, code folding, configurable indentation, twelve themes, Standard/Sublime/Vim keymaps, local drafts and revision history.

The command palette opens with **Ctrl/Cmd+Shift+P**. The reindent command is available through the toolbar and with **Shift+Alt+F** on Windows/Linux or **Cmd+Shift+F** on macOS.

The complete keyboard reference is available in `COMMANDS.md` in the package sources.

### Template Variables

Select the **cmx** input type for a TV. Optional input properties:

- **language** - `text/html`, `text/css`, `application/javascript`, `application/json`, `text/x-sql`, `application/xml`, `text/x-markdown` or `application/x-php`;
- **height** - editor height in pixels, default 260.

### Dashboard widget

Add **CMX Scratchpad** through the dashboard widget manager. Notes are stored only in the current manager's browser localStorage and are not sent to the server.

### Settings and requirements

The package provides 50 settings in the `cmx` namespace. They can be overridden per manager user. Theme, font size and word wrap are also available in the editor quick menu.

Requirements: MODX Revolution 3.x and PHP 8.0+. PHP CLI is optional and is used only for server-side `php -l` checks; browser diagnostics remain available without it.

License: GNU General Public License v2.0 or any later version. Copyright (C) 2026 vitos88.

----------------
## 🇷🇺 Русский

CMX 1.0.0-pl - редактор кода на CodeMirror 6 для панели управления MODX Revolution 3. Он работает со сниппетами, плагинами, чанками, шаблонами, файлами, содержимым ресурсов без RTE, буфером кэша resource/data и Template Variables.

### Установка

1. Установите `cmx-1.0.0-pl.transport.zip` через **Управление пакетами**.
2. Установщик выберет `cmx` в системной настройке `which_element_editor`, создаст таблицу истории версий и зарегистрирует виджет CMX Scratchpad.
3. После установки обновите страницу менеджера.

Для ручного выбора откройте **Система → Системные настройки → which_element_editor** и выберите **cmx**. Чтобы вернуть другой редактор, измените значение той же настройки - удалять CMX не требуется.

### Редактор

CMX включает подсветку синтаксиса, автодополнение MODX/Fenom/Twig, подсказки MODX/xPDO и PHP API, переход Ctrl/Cmd-кликом, подсказки при наведении, поиск и замену, мультикурсоры, Emmet, сворачивание кода, настраиваемые отступы, двенадцать тем, раскладки Standard/Sublime/Vim, локальные черновики и историю версий.

Палитра команд открывается по **Ctrl/Cmd+Shift+P**. Выровнять код можно кнопкой на панели или сочетанием **Shift+Alt+F** в Windows/Linux и **Cmd+Shift+F** в macOS.

Полная шпаргалка находится в файле `COMMANDS.md` в исходниках пакета.

### Template Variables

Выберите для TV тип ввода **cmx**. Необязательные параметры ввода:

- **language** - `text/html`, `text/css`, `application/javascript`, `application/json`, `text/x-sql`, `application/xml`, `text/x-markdown` или `application/x-php`;
- **height** - высота редактора в пикселях, по умолчанию 260.

### Виджет дашборда

Добавьте **CMX Scratchpad** через управление виджетами дашборда. Заметки хранятся только в localStorage браузера текущего менеджера и не отправляются на сервер.

### Настройки и требования

Пакет добавляет 50 настроек в пространстве имён `cmx`. Их можно переопределить для отдельного менеджера. Тема, размер шрифта и перенос строк также настраиваются в быстром меню редактора.

Требования: MODX Revolution 3.x и PHP 8.0+. PHP CLI необязателен и используется только для серверной проверки `php -l`; без него браузерная диагностика продолжает работать.

Лицензия: GNU General Public License v2.0 или любая более поздняя версия. Copyright (C) 2026 vitos88.
