<?php
/**
 * Settings Language file for CMX (Ukrainian).
 *
 * @package cmx
 * @subpackage lexicon
 */

$_lang['area_general'] = 'Основні';
$_lang['area_appearance'] = 'Зовнішній вигляд';
$_lang['area_editing'] = 'Редагування';
$_lang['area_modx'] = 'MODX';
$_lang['area_completion'] = 'Автодоповнення';

$_lang['setting_cmx.theme'] = 'Тема редактора';
$_lang['setting_cmx.theme_desc'] = 'Теми: auto (як в операційній системі), manager (підлаштуватися під світлий/темний менеджер), light, light-quiet, light-solarized, dark, dark-dracula, dark-nord, dark-gruvbox, dark-vscode, dark-monokai, dark-solarized. Тему можна перемикати й прямо в панелі редактора — цей вибір зберігається окремо для кожного користувача у його браузері.';
$_lang['setting_cmx.height'] = 'Висота області редагування';
$_lang['setting_cmx.height_desc'] = 'Висота редактора в пікселях, наприклад 480. Якщо порожньо — використовується висота поля, яке замінюється.';
$_lang['setting_cmx.toolbar'] = 'Панель інструментів';
$_lang['setting_cmx.toolbar_desc'] = 'Показувати панель інструментів (перемикання теми, палітра команд, історія версій, медіа-браузер, повноекранний режим) у правому верхньому куті редактора.';
$_lang['setting_cmx.statusbar'] = 'Рядок стану';
$_lang['setting_cmx.statusbar_desc'] = 'Показувати рядок стану: рядок/стовпець, розмір виділення, розмір документа, мова і поточна тема (клік по назві теми перемикає її).';
$_lang['setting_cmx.command_palette'] = 'Палітра команд';
$_lang['setting_cmx.command_palette_desc'] = 'Палітра команд (Ctrl/Cmd-Shift-P): пошук по всіх командах редактора — тема, перенос, згортання, реіндент, перехід до рядка, вставка елемента, історія тощо.';

$_lang['setting_cmx.font_family'] = 'Шрифт';
$_lang['setting_cmx.font_family_desc'] = 'Гарнітура шрифту редактора, наприклад "JetBrains Mono", Consolas чи monospace. Якщо порожньо — стандартний моноширинний набір.';
$_lang['setting_cmx.font_size'] = 'Розмір шрифту';
$_lang['setting_cmx.font_size_desc'] = 'Розмір шрифту редактора в пікселях, наприклад 13 чи 15 (10–28).';
$_lang['setting_cmx.line_numbers'] = 'Нумерація рядків';
$_lang['setting_cmx.line_numbers_desc'] = 'Показувати номери рядків у гутері.';
$_lang['setting_cmx.active_line'] = 'Підсвітка активного рядка';
$_lang['setting_cmx.active_line_desc'] = 'Підсвічувати рядок, у якому знаходиться курсор.';
$_lang['setting_cmx.fold_gutter'] = 'Згортання коду';
$_lang['setting_cmx.fold_gutter_desc'] = 'Показувати стрілки згортання в гутері та дозволяти згортати блоки (HTML-теги, CSS-блоки, коментарі).';
$_lang['setting_cmx.word_wrap'] = 'Перенос рядків';
$_lang['setting_cmx.word_wrap_desc'] = 'Переносити довгі рядки замість горизонтальної прокрутки.';
$_lang['setting_cmx.bracket_matching'] = 'Підсвітка парних дужок';
$_lang['setting_cmx.bracket_matching_desc'] = 'Підсвічувати пару дужок, на якій стоїть курсор (зокрема всередині MODX-тегів).';
$_lang['setting_cmx.bracket_colors'] = 'Кольорові пари дужок';
$_lang['setting_cmx.bracket_colors_desc'] = 'Розфарбовувати пари дужок за глибиною вкладеності («веселкові дужки»). Дужки всередині рядків, коментарів, MODX-тегів та тегів Fenom/Twig не розфарбовуються.';
$_lang['setting_cmx.indent_guides'] = 'Лінії відступів';
$_lang['setting_cmx.indent_guides_desc'] = 'Малювати вертикальні лінії відступів (indent guides) на кожному рівні вкладеності.';
$_lang['setting_cmx.ruler'] = 'Вертикальна лінійка';
$_lang['setting_cmx.ruler_desc'] = 'Показувати тонку вертикальну лінію на заданій колонці — наприклад 80 чи 120. 0 = вимкнено.';
$_lang['setting_cmx.highlight_trailing'] = 'Підсвітка кінцевих пробілів';
$_lang['setting_cmx.highlight_trailing_desc'] = 'Підсвічувати пробіли і таби в кінці рядків.';

$_lang['setting_cmx.soft_tabs'] = 'Пробіли замість табів';
$_lang['setting_cmx.soft_tabs_desc'] = 'Вставляти пробіли замість символу табуляції.';
$_lang['setting_cmx.tab_size'] = 'Розмір табуляції';
$_lang['setting_cmx.tab_size_desc'] = 'Кількість пробілів на один рівень відступу (2–8).';
$_lang['setting_cmx.close_brackets'] = 'Автозакриття дужок';
$_lang['setting_cmx.close_brackets_desc'] = 'Автоматично закривати (), [], {} і лапки під час введення.';
$_lang['setting_cmx.auto_close_tags'] = 'Автозакриття тегів';
$_lang['setting_cmx.auto_close_tags_desc'] = 'Автоматично закривати HTML-теги під час введення.';
$_lang['setting_cmx.format_button'] = 'Кнопка «Вирівняти код»';
$_lang['setting_cmx.format_button_desc'] = 'Кнопка в панелі інструментів: заново вирівняти відступи всього документа (або лише виділених рядків) з урахуванням Fenom/MODX-тегів — те саме, що Shift-Alt-F. Змінюються тільки відступи, вміст не чіпається.';
$_lang['setting_cmx.search_panel'] = 'Панель пошуку і заміни';
$_lang['setting_cmx.search_panel_desc'] = 'Увімкнути панель пошуку і заміни (Ctrl/Cmd-F) з підтримкою регулярних виразів.';
$_lang['setting_cmx.highlight_matches'] = 'Підсвітка збігів';
$_lang['setting_cmx.highlight_matches_desc'] = 'Підсвічувати всі входження виділеного слова в документі.';
$_lang['setting_cmx.emmet'] = 'Emmet';
$_lang['setting_cmx.emmet_desc'] = 'Абревіатури Emmet у документах HTML/CSS/XML: введіть абревіатуру виду ul.nav>li*5 і натисніть Tab, щоб розгорнути. Під час введення показується прев\'ю.';

$_lang['setting_cmx.autosave'] = 'Автозбереження чернеток';
$_lang['setting_cmx.autosave_desc'] = 'Періодично зберігати робочу копію документа в браузері (localStorage). Після збою чи випадково закритої вкладки редактор запропонує відновити чернетку.';
$_lang['setting_cmx.autosave_lifetime'] = 'Час життя чернетки';
$_lang['setting_cmx.autosave_lifetime_desc'] = 'Скільки часу незбережена чернетка залишається доступною для відновлення, у хвилинах (наприклад, 240 = 4 години). 0 = до відновлення чи видалення.';
$_lang['setting_cmx.keymap'] = 'Набір гарячих клавіш';
$_lang['setting_cmx.keymap_desc'] = 'standard (стандартний CodeMirror), sublime (Sublime Text: Alt-↑/↓ — перенос рядка, Shift-Alt-↑/↓ — дублювання, Ctrl/Cmd-Shift-K — видалення рядка, Ctrl/Cmd-L — виділити рядок, Ctrl/Cmd-/ — коментар) або vim (повна емуляція Vim від Replit).';
$_lang['setting_cmx.trim_trailing'] = 'Видаляти кінцеві пробіли під час збереження';
$_lang['setting_cmx.trim_trailing_desc'] = 'Перед відправкою форми автоматично видаляти пробіли і таби в кінці рядків.';

$_lang['setting_cmx.goto_definition'] = 'Перехід до елемента (Ctrl/Cmd-клік)';
$_lang['setting_cmx.goto_definition_desc'] = 'Ctrl/Cmd-клік по MODX-тегу відкриває редагування: [[snippet]] — сніпет, [[$chunk]] — чанк, [[*tv]] — TV, [[~id]] — ресурс.';
$_lang['setting_cmx.hovers'] = 'Підказки при наведенні';
$_lang['setting_cmx.hovers_desc'] = 'Показувати спливаючі підказки на MODX-тегах: назва і URL ресурсу для [[~id]], опис сніпета/чанка/TV, довідку по фільтрах виводу (:isempty, :cat ...) і модифікаторах Fenom.';
$_lang['setting_cmx.media_button'] = 'Кнопка медіа-браузера';
$_lang['setting_cmx.media_button_desc'] = 'Кнопка в панелі інструментів (для HTML-документів з MODX-тегами): відкриває штатний медіа-браузер менеджера і вставляє обраний файл (шлях або <img> для картинок).';
$_lang['setting_cmx.versions'] = 'Історія версій';
$_lang['setting_cmx.versions_desc'] = 'Зберігати знімок коду при кожному збереженні сніпета, чанка, шаблону, плагіна чи ресурсу (власна таблиця). Список версій — по кнопці з годинником у панелі редактора; будь-яку версію можна переглянути, порівняти з іншою, завантажити файлом чи повернути в редактор. Файли в менеджері файлів не версіонуються.';
$_lang['setting_cmx.versions_max'] = 'Глибина історії версій';
$_lang['setting_cmx.versions_max_desc'] = 'Скільки останніх знімків на елемент зберігати (наприклад, 20). Старіші видаляються автоматично; історія елемента видаляється разом з ним.';
$_lang['setting_cmx.php_lint'] = 'Перевірка синтаксису PHP';
$_lang['setting_cmx.php_lint_desc'] = 'Перевіряти код сніпетів/плагінів/PHP-файлів при паузі в наборі: помилки підкреслюються, повідомлення видно при наведенні. Базова перевірка (дужки, рядки, heredoc) працює прямо в браузері завжди; повна — через php -l на сервері, коли PHP CLI доступний.';
$_lang['setting_cmx.css_lint'] = 'Перевірка CSS';
$_lang['setting_cmx.css_lint_desc'] = 'Підкреслювати помилки в CSS: невідомі властивості (описки на кшталт paddings замість padding — з підказкою правильної назви), незакриті і зайві дужки. Працює в CSS/SCSS/LESS-файлах і в блоках <style> шаблонів; теги MODX і Fenom всередині CSS не заважають.';
$_lang['setting_cmx.php_path'] = 'Шлях до PHP CLI';
$_lang['setting_cmx.php_path_desc'] = 'Команда або шлях до PHP CLI для перевірки синтаксису, за замовчуванням php (з PATH). Приклад: /usr/bin/php8.2.';
$_lang['setting_cmx.tv'] = 'Тип вводу TV «cmx»';
$_lang['setting_cmx.tv_desc'] = 'Реєструвати тип вводу «cmx» для шаблонних змінних: будь-який TV можна редагувати повноцінним редактором прямо у формі ресурсу. Мова задається властивістю language у TV; якщо її не задано, TV редагується як шаблон сайту (HTML + Fenom, коли увімкнений парсер pdoTools).';

$_lang['setting_cmx.autocomplete'] = 'Автодоповнення';
$_lang['setting_cmx.autocomplete_desc'] = 'Головний вимикач автодоповнення (Ctrl/Space також відкриває його явно).';
$_lang['setting_cmx.autocomplete_modx'] = 'Автодоповнення MODX-тегів';
$_lang['setting_cmx.autocomplete_modx_desc'] = 'Підказувати сніпети, чанки, шаблони, TV і поля ресурсів всередині тегів [[ ... ]]; властивості сніпета після & (з описом; вже використані у виклику ховаються, за замовчуванням підставляється &властивість=`значення` — див. «Підставляти значення за замовчуванням»), набори властивостей після @, ресурси для [[~id]], фільтри виводу MODX після : (фільтри зі значенням вставляються як :date=`формат`). На формі ресурсу в [[*]] пропонуються тільки TV поточного шаблону. Списки беруться з сайту з урахуванням ваших прав на елементи.';
$_lang['setting_cmx.autocomplete_fenom'] = 'Автодоповнення Fenom / Twig';
$_lang['setting_cmx.autocomplete_fenom_desc'] = 'Повноцінні підказки Fenom/pdoTools: теги ({if, {foreach, {include ...) після { і каркаси конструкцій; назви сніпетів і чанків всередині {\'...\' | snippet / {include \'...\'}; модифікатори (|upper, |decl, |snippet, |chunk ...) після |, зокрема з пробілами навколо |; поля ресурсу після {$_modx->resource. і поля користувача після {$_modx->user.; поля і TV після {$; ключі системних налаштувань після {$_modx->config. Для text/x-twig — теги і фільтри Twig. Всередині <script>/<style> підказки Fenom не з\'являються.';
$_lang['setting_cmx.autocomplete_php'] = 'Автодоповнення PHP';
$_lang['setting_cmx.autocomplete_php_desc'] = 'Підказувати ключові слова PHP і ~200 часто вживаних функцій (з сигнатурами) при редагуванні сніпетів, плагінів і PHP-файлів.';
$_lang['setting_cmx.autocomplete_settings'] = 'Автодоповнення [[++налаштувань]]';
$_lang['setting_cmx.autocomplete_settings_desc'] = 'Підказувати ключі системних налаштувань у тегах [[++...]] з поточним значенням (потрібні права на «Налаштування»).';
$_lang['setting_cmx.autocomplete_lexicons'] = 'Автодоповнення [[%лексиконів]]';
$_lang['setting_cmx.autocomplete_lexicons_desc'] = 'Підказувати записи лексиконів у тегах [[%...]] з їхнім текстом і темою (потрібні права на «Лексикони»); результати обмежені мовою менеджера. Пошук у міру набору від 2 символів.';
$_lang['setting_cmx.autocomplete_api'] = 'Автодоповнення MODX API';
$_lang['setting_cmx.autocomplete_api_desc'] = 'Підказувати методи MODX/xPDO в PHP-коді: $modx->getOption(...), $modx->getChunk(...), $modx->resource->getTVValue(...), $xpdo->newQuery(...) та інші — з сигнатурами і описами, офлайн.';
$_lang['setting_cmx.snippets'] = 'Користувацькі сніпети';
$_lang['setting_cmx.snippets_desc'] = 'Власні варіанти автодоповнення, по одному на рядок, у форматі: мітка :: текст, що вставляється. Текст може бути багаторядковим. Приклад: bootstrap5card :: <div class="card"><div class="card-body">|</div></div>. Пропонуються при введенні мітки (від 2 символів) або через Ctrl/Space.';

$_lang['setting_cmx.template_lint'] = 'Перевірка шаблонних тегів';
$_lang['setting_cmx.template_lint_desc'] = 'Перевіряти баланс тегів Fenom ({if} без {/if}, {foreach}/{/foreach}, {switch}, {block}, {literal}, {ignore} ...) і незакриті MODX-теги ([[ без ]]) прямо під час набору: помилки підкреслюються червоним, лічильник помилок видно в статус-барі (клік — перехід до наступної помилки). CSS/JS-фігурні дужки не вважаються тегами.';
$_lang['setting_cmx.warn_on_save'] = 'Попереджати при збереженні з помилками';
$_lang['setting_cmx.warn_on_save_desc'] = 'При натисканні «Зберегти» (кнопка або Ctrl/Cmd-S), якщо в редакторі є помилки (незакриті теги Fenom, [[ без ]], синтаксис PHP), показувати запит: зберегти все одно чи залишитися і виправити. Скасування запиту — попередження не буде, код зберігається як завжди.';
$_lang['setting_cmx.autocomplete.insert_defaults'] = 'Підставляти значення за замовчуванням';
$_lang['setting_cmx.autocomplete.insert_defaults_desc'] = 'При виборі властивості сніпета з підказок вставляти одразу &властивість=`значення за замовчуванням` (значення береться з «Властивостей за замовчуванням» сніпета). Також працює для фільтрів виводу: :date=`%d.%m.%Y`, :limit=`100`, :userinfo=`fullname` тощо. Вимкніть, щоб вставлялася лише назва властивості.';
$_lang['setting_cmx.autocomplete.close_tags'] = 'Закривати MODX-теги при виборі';
$_lang['setting_cmx.autocomplete.close_tags_desc'] = 'При виборі назви сніпета/чанка/TV/поля з підказок автоматично дописувати ]] і ставити курсор перед закривною дужкою — зручно одразу набрати :фільтр чи ? &властивості.';
$_lang['setting_cmx.autocomplete.skeletons'] = 'Каркаси тегів Fenom';
$_lang['setting_cmx.autocomplete.skeletons_desc'] = 'При виборі блочного тега Fenom з підказок вставляти одразу всю конструкцію з закривним тегом і курсором на місці умови: {if }…{/if}, {foreach $rows as $row}…{/foreach}, {switch }…{case 1}…{default}…{/switch}, {include \'\'} та інші. Сильно знижує ризик зберегти незакритий тег.';
