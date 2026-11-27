<?php
/**
 * Settings Language file for CMX.
 *
 * @package cmx
 * @subpackage lexicon
 */

$_lang['area_general'] = 'Основные';
$_lang['area_appearance'] = 'Внешний вид';
$_lang['area_editing'] = 'Редактирование';
$_lang['area_modx'] = 'MODX';
$_lang['area_completion'] = 'Автодополнение';

$_lang['setting_cmx.theme'] = 'Тема редактора';
$_lang['setting_cmx.theme_desc'] = 'Темы: auto (как в операционной системе), manager (подстроиться под светлый/тёмный менеджер), light, light-quiet, light-solarized, dark, dark-dracula, dark-nord, dark-gruvbox, dark-vscode, dark-monokai, dark-solarized. Тему можно переключать и прямо в панели редактора — этот выбор сохраняется отдельно для каждого пользователя в его браузере.';
$_lang['setting_cmx.height'] = 'Высота области редактирования';
$_lang['setting_cmx.height_desc'] = 'Высота редактора в пикселях, например 480. Если пусто — используется высота заменяемого поля.';
$_lang['setting_cmx.toolbar'] = 'Панель инструментов';
$_lang['setting_cmx.toolbar_desc'] = 'Показывать панель инструментов (переключение темы, палитра команд, история версий, медиа-браузер, полноэкранный режим) в правом верхнем углу редактора.';
$_lang['setting_cmx.statusbar'] = 'Строка состояния';
$_lang['setting_cmx.statusbar_desc'] = 'Показывать строку состояния: строка/столбец, размер выделения, размер документа, язык и текущая тема (клик по названию темы переключает её).';
$_lang['setting_cmx.command_palette'] = 'Палитра команд';
$_lang['setting_cmx.command_palette_desc'] = 'Палитра команд (Ctrl/Cmd-Shift-P): поиск по всем командам редактора — тема, перенос, сворачивание, реиндент, переход к строке, вставка элемента, история и т.д.';

$_lang['setting_cmx.font_family'] = 'Шрифт';
$_lang['setting_cmx.font_family_desc'] = 'Гарнитура шрифта редактора, например "JetBrains Mono", Consolas или monospace. Если пусто — стандартный моноширинный набор.';
$_lang['setting_cmx.font_size'] = 'Размер шрифта';
$_lang['setting_cmx.font_size_desc'] = 'Размер шрифта редактора в пикселях, например 13 или 15 (10–28).';
$_lang['setting_cmx.line_numbers'] = 'Нумерация строк';
$_lang['setting_cmx.line_numbers_desc'] = 'Показывать номера строк в гуттере.';
$_lang['setting_cmx.active_line'] = 'Подсветка активной строки';
$_lang['setting_cmx.active_line_desc'] = 'Подсвечивать строку, в которой находится курсор.';
$_lang['setting_cmx.fold_gutter'] = 'Сворачивание кода';
$_lang['setting_cmx.fold_gutter_desc'] = 'Показывать стрелки сворачивания в гуттере и позволять сворачивать блоки (HTML-теги, CSS-блоки, комментарии).';
$_lang['setting_cmx.word_wrap'] = 'Перенос строк';
$_lang['setting_cmx.word_wrap_desc'] = 'Переносить длинные строки вместо горизонтальной прокрутки.';
$_lang['setting_cmx.bracket_matching'] = 'Подсветка парных скобок';
$_lang['setting_cmx.bracket_matching_desc'] = 'Подсвечивать пару скобок, на которой стоит курсор (в том числе внутри MODX-тегов).';
$_lang['setting_cmx.bracket_colors'] = 'Цветные пары скобок';
$_lang['setting_cmx.bracket_colors_desc'] = 'Раскрашивать пары скобок по глубине вложенности («радужные скобки»). Скобки внутри строк, комментариев, MODX-тегов и тегов Fenom/Twig не раскрашиваются.';
$_lang['setting_cmx.indent_guides'] = 'Линии отступов';
$_lang['setting_cmx.indent_guides_desc'] = 'Рисовать вертикальные линии отступов (indent guides) на каждом уровне вложенности.';
$_lang['setting_cmx.ruler'] = 'Вертикальная линейка';
$_lang['setting_cmx.ruler_desc'] = 'Показывать тонкую вертикальную линию на заданной колонке — например 80 или 120. 0 = выключено.';
$_lang['setting_cmx.highlight_trailing'] = 'Подсветка конечных пробелов';
$_lang['setting_cmx.highlight_trailing_desc'] = 'Подсвечивать пробелы и табы в конце строк.';

$_lang['setting_cmx.soft_tabs'] = 'Пробелы вместо табов';
$_lang['setting_cmx.soft_tabs_desc'] = 'Вставлять пробелы вместо символа табуляции.';
$_lang['setting_cmx.tab_size'] = 'Размер табуляции';
$_lang['setting_cmx.tab_size_desc'] = 'Количество пробелов на один уровень отступа (2–8).';
$_lang['setting_cmx.close_brackets'] = 'Автозакрытие скобок';
$_lang['setting_cmx.close_brackets_desc'] = 'Автоматически закрывать (), [], {} и кавычки при вводе.';
$_lang['setting_cmx.auto_close_tags'] = 'Автозакрытие тегов';
$_lang['setting_cmx.auto_close_tags_desc'] = 'Автоматически закрывать HTML-теги при вводе.';
$_lang['setting_cmx.format_button'] = 'Кнопка «Выровнять код»';
$_lang['setting_cmx.format_button_desc'] = 'Кнопка в панели инструментов: заново выровнять отступы всего документа (или только выделенных строк) с учётом Fenom/MODX-тегов — то же, что Shift-Alt-F. Меняются только отступы, содержимое не трогается.';
$_lang['setting_cmx.search_panel'] = 'Панель поиска и замены';
$_lang['setting_cmx.search_panel_desc'] = 'Включить панель поиска и замены (Ctrl/Cmd-F) с поддержкой регулярных выражений.';
$_lang['setting_cmx.highlight_matches'] = 'Подсветка совпадений';
$_lang['setting_cmx.highlight_matches_desc'] = 'Подсвечивать все вхождения выделенного слова в документе.';
$_lang['setting_cmx.emmet'] = 'Emmet';
$_lang['setting_cmx.emmet_desc'] = 'Аббревиатуры Emmet в документах HTML/CSS/XML: введите аббревиатуру вида ul.nav>li*5 и нажмите Tab, чтобы развернуть. При вводе показывается превью.';
$_lang['setting_cmx.autosave'] = 'Автосохранение черновиков';
$_lang['setting_cmx.autosave_desc'] = 'Периодически сохранять рабочую копию документа в браузере (localStorage). После сбоя или случайно закрытой вкладки редактор предложит восстановить черновик.';
$_lang['setting_cmx.autosave_lifetime'] = 'Время жизни черновика';
$_lang['setting_cmx.autosave_lifetime_desc'] = 'Сколько времени несохранённый черновик остаётся доступным для восстановления, в минутах (например, 240 = 4 часа). 0 = до восстановления или удаления.';
$_lang['setting_cmx.keymap'] = 'Набор горячих клавиш';
$_lang['setting_cmx.keymap_desc'] = 'standard (стандартный CodeMirror), sublime (Sublime Text: Alt-↑/↓ — перенос строки, Shift-Alt-↑/↓ — дублирование, Ctrl/Cmd-Shift-K — удаление строки, Ctrl/Cmd-L — выделить строку, Ctrl/Cmd-/ — комментарий) или vim (полная эмуляция Vim от Replit).';
$_lang['setting_cmx.trim_trailing'] = 'Удалять конечные пробелы при сохранении';
$_lang['setting_cmx.trim_trailing_desc'] = 'Перед отправкой формы автоматически удалять пробелы и табы в конце строк.';

$_lang['setting_cmx.goto_definition'] = 'Переход к элементу (Ctrl/Cmd-клик)';
$_lang['setting_cmx.goto_definition_desc'] = 'Ctrl/Cmd-клик по MODX-тегу открывает редактирование: [[snippet]] — сниппет, [[$chunk]] — чанк, [[*tv]] — TV, [[~id]] — ресурс.';
$_lang['setting_cmx.hovers'] = 'Подсказки при наведении';
$_lang['setting_cmx.hovers_desc'] = 'Показывать всплывающие подсказки на MODX-тегах: название и URL ресурса для [[~id]], описание сниппета/чанка/TV, справку по фильтрам вывода (:isempty, :cat ...) и модификаторам Fenom.';
$_lang['setting_cmx.media_button'] = 'Кнопка медиа-браузера';
$_lang['setting_cmx.media_button_desc'] = 'Кнопка в панели инструментов (для HTML-документов с MODX-тегами): открывает штатный медиа-браузер менеджера и вставляет выбранный файл (путь или <img> для картинок).';
$_lang['setting_cmx.versions'] = 'История версий';
$_lang['setting_cmx.versions_desc'] = 'Сохранять снимок кода при каждом сохранении сниппета, чанка, шаблона, плагина или ресурса (своя таблица). Список версий — по кнопке с часиками в панели редактора; любую версию можно посмотреть, сравнить с другой, выгрузить файлом JSON и вернуть в редактор. При удалении элемента его история удаляется вместе с ним. Файлы в менеджере файлов не версируются.';
$_lang['setting_cmx.versions_max'] = 'Глубина истории версий';
$_lang['setting_cmx.versions_max_desc'] = 'Сколько последних снимков на элемент хранить (например, 20). Более старые удаляются автоматически.';
$_lang['setting_cmx.php_lint'] = 'Проверка синтаксиса PHP';
$_lang['setting_cmx.php_lint_desc'] = 'Проверять код сниппетов/плагинов/PHP-файлов при паузе в наборе: ошибки подчёркиваются, сообщение видно при наведении. Базовая проверка (скобки, строки, heredoc) работает прямо в браузере всегда; полная — через php -l на сервере, когда PHP CLI доступен.';
$_lang['setting_cmx.css_lint'] = 'Проверка CSS';
$_lang['setting_cmx.css_lint_desc'] = 'Подчёркивать ошибки в CSS: неизвестные свойства (опечатки вроде paddings вместо padding — с подсказкой правильного имени), незакрытые и лишние скобки. Работает в CSS/SCSS/LESS-файлах и в блоках <style> шаблонов; теги MODX и Fenom внутри CSS не мешают.';
$_lang['setting_cmx.php_path'] = 'Путь к PHP CLI';
$_lang['setting_cmx.php_path_desc'] = 'Команда или путь к PHP CLI для проверки синтаксиса, по умолчанию php (из PATH). Пример: /usr/bin/php8.2.';
$_lang['setting_cmx.tv'] = 'Тип ввода TV «cmx»';
$_lang['setting_cmx.tv_desc'] = 'Регистрировать тип ввода «cmx» для шаблонных переменных: любой TV можно редактировать полноценным редактором прямо в форме ресурса. Язык задаётся свойством language у TV; если оно не задано, TV редактируется как шаблон сайта (HTML + Fenom, когда включён парсер pdoTools).';

$_lang['setting_cmx.autocomplete'] = 'Автодополнение';
$_lang['setting_cmx.autocomplete_desc'] = 'Главный выключатель автодополнения (Ctrl/Space также открывает его явно).';
$_lang['setting_cmx.autocomplete_modx'] = 'Автодополнение MODX-тегов';
$_lang['setting_cmx.autocomplete_modx_desc'] = 'Подсказывать сниппеты, чанки, шаблоны, TV и поля ресурсов внутри тегов [[ ... ]]; свойства сниппета после & (с описанием; уже использованные в вызове скрываются, по умолчанию подставляется &свойство=`значение` — см. «Подставлять значения по умолчанию»), наборы свойств после @, ресурсы для [[~id]], фильтры вывода MODX после : (фильтры со значением вставляются как :date=`формат`). На форме ресурса в [[*]] предлагаются только TV текущего шаблона. Списки берутся с сайта с учётом ваших прав на элементы.';
$_lang['setting_cmx.autocomplete_fenom'] = 'Автодополнение Fenom / Twig';
$_lang['setting_cmx.autocomplete_fenom_desc'] = 'Полноценные подсказки Fenom/pdoTools: теги ({if, {foreach, {include ...) после { и каркасы конструкций; имена сниппетов и чанков внутри {\'...\' | snippet / {include \'...\'}; модификаторы (|upper, |decl, |snippet, |chunk ...) после |, в том числе с пробелами вокруг |; поля ресурса после {$_modx->resource. и поля пользователя после {$_modx->user.; поля и TV после {$; ключи системных настроек после {$_modx->config. Для text/x-twig — теги и фильтры Twig.';
$_lang['setting_cmx.autocomplete_php'] = 'Автодополнение PHP';
$_lang['setting_cmx.autocomplete_php_desc'] = 'Подсказывать ключевые слова PHP и ~200 часто используемых функций (с сигнатурами) при редактировании сниппетов, плагинов и PHP-файлов.';
$_lang['setting_cmx.autocomplete_settings'] = 'Автодополнение [[++настроек]]';
$_lang['setting_cmx.autocomplete_settings_desc'] = 'Подсказывать ключи системных настроек в тегах [[++...]] с текущим значением (нужны права на «Настройки»).';
$_lang['setting_cmx.autocomplete_lexicons'] = 'Автодополнение [[%лексиконов]]';
$_lang['setting_cmx.autocomplete_lexicons_desc'] = 'Подсказывать записи лексиконов в тегах [[%...]] с их текстом и темой (нужны права на «Лексиконы»); результаты ограничены языком менеджера текущего пользователя. Поиск по мере набора от 2 символов.';
$_lang['setting_cmx.autocomplete_api'] = 'Автодополнение MODX API';
$_lang['setting_cmx.autocomplete_api_desc'] = 'Подсказывать методы MODX/xPDO в PHP-коде: $modx->getOption(...), $modx->getChunk(...), $modx->resource->getTVValue(...), $xpdo->newQuery(...) и другие — с сигнатурами и описаниями, офлайн.';
$_lang['setting_cmx.snippets'] = 'Пользовательские сниппеты';
$_lang['setting_cmx.snippets_desc'] = 'Свои варианты автодополнения, по одному на строку, в формате: метка :: вставляемый текст. Вставляемый текст может быть многострочным. Пример: bootstrap5card :: <div class="card"><div class="card-body">|</div></div>. Предлагаются при вводе метки (от 2 символов) или через Ctrl/Space.';

$_lang['setting_cmx.template_lint'] = 'Проверка шаблонных тегов';
$_lang['setting_cmx.template_lint_desc'] = 'Проверять баланс тегов Fenom ({if} без {/if}, {foreach}/{/foreach}, {switch}, {block}, {literal}, {ignore} ...) и незакрытые MODX-теги ([[ без ]]) прямо во время набора: ошибки подчёркиваются красным, счётчик ошибок виден в статус-баре (клик — переход к следующей ошибке). CSS/JS-фигурные скобки не считаются тегами.';
$_lang['setting_cmx.warn_on_save'] = 'Предупреждать при сохранении с ошибками';
$_lang['setting_cmx.warn_on_save_desc'] = 'При нажатии «Сохранить» (кнопка или Ctrl/Cmd-S), если в редакторе есть ошибки (незакрытые теги Fenom, [[ без ]], синтаксис PHP), показывать запрос: сохранить всё равно или остаться и исправить. Отмена запроса — предупреждения не будет, код сохраняется как обычно.';
$_lang['setting_cmx.autocomplete.insert_defaults'] = 'Подставлять значения по умолчанию';
$_lang['setting_cmx.autocomplete.insert_defaults_desc'] = 'При выборе свойства сниппета из подсказок вставлять сразу &свойство=`значение по умолчанию` (значение берётся из «Свойств по умолчанию» сниппета). Также работает для фильтров вывода: :date=`%d.%m.%Y`, :limit=`100`, :userinfo=`fullname` и т.п. Выключите, чтобы вставлялось только имя свойства.';
$_lang['setting_cmx.autocomplete.close_tags'] = 'Закрывать MODX-теги при выборе';
$_lang['setting_cmx.autocomplete.close_tags_desc'] = 'При выборе имени сниппета/чанка/TV/поля из подсказок автоматически дописывать ]] и ставить курсор перед закрывающей скобкой — удобно сразу набрать :фильтр или ? &свойства.';
$_lang['setting_cmx.autocomplete.skeletons'] = 'Каркасы тегов Fenom';
$_lang['setting_cmx.autocomplete.skeletons_desc'] = 'При выборе блочного тега Fenom из подсказок вставлять сразу всю конструкцию с закрывающим тегом и курсором на месте условия: {if }…{/if}, {foreach $rows as $row}…{/foreach}, {switch }…{case 1}…{default}…{/switch}, {include \'\'} и другие. Сильно снижает риск сохранить незакрытый тег.';
