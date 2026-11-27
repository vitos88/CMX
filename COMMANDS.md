# CMX — Quick Commands and Keyboard Shortcuts

A cheat sheet for the commands wired up in CMX 3.7 (CodeMirror 6). The shortcuts were verified against `frontend/src/editor.js`, `frontend/src/keymaps.js` and the CodeMirror keymaps in use.

## Notation

- **Mod** — `Ctrl` on Windows/Linux and `Cmd` (`⌘`) on macOS.
- **Alt** — this is `Option` (`⌥`) on Mac. For letter commands where macOS substitutes characters instead of letters, CMX uses separate shortcuts without `Option`.
- `Shift`, `Alt`/`Option`, `Ctrl` and `Cmd` are held together with the specified key.
- Editing commands do not work in read-only mode.
- Some commands depend on the `cmx.*` settings: autocompletion, search, Emmet and go-to-element can be disabled.

## Main Commands

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| Save the element or resource in MODX | `Ctrl+S` | `Cmd+S` |
| Undo a change | `Ctrl+Z` | `Cmd+Z` |
| Redo a change | `Ctrl+Y` or `Ctrl+Shift+Z` | `Cmd+Shift+Z` |
| Select all | `Ctrl+A` | `Cmd+A` |
| Find and replace | `Ctrl+F` | `Cmd+F` |
| Go to line | `Ctrl+Alt+G` | `Ctrl+G` |
| Open the CMX command palette | `Ctrl+Shift+P` | `Cmd+Shift+P` |
| Format indentation of the document or of the selected lines | `Shift+Alt+F` | `Cmd+Shift+F` |
| Toggle a line comment | `Ctrl+/` | `Cmd+/` |
| Toggle a block comment | `Shift+Alt+A` | `Shift+Ctrl+A` |
| Increase indentation | `Tab` or `Ctrl+]` | `Tab` or `Cmd+]` |
| Decrease indentation | `Shift+Tab` or `Ctrl+[` | `Shift+Tab` or `Cmd+[` |
| Automatically re-indent the selection | `Ctrl+Alt+\` | `Cmd+Alt+\` |

`Tab` and `Shift+Tab` change the indentation of the current line or of all selected lines. If Emmet is enabled and there is an abbreviation before the cursor, `Tab` expands it first.

## Lines and Editing

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| New line with automatic indentation | `Enter` or `Shift+Enter` | `Enter` or `Shift+Enter` |
| Insert a blank line | `Ctrl+Enter` | `Cmd+Enter` |
| Move the line or the selected lines up | `Alt+↑` | `Alt+↑` |
| Move the line or the selected lines down | `Alt+↓` | `Alt+↓` |
| Copy the line or the selection up | `Shift+Alt+↑` | `Shift+Alt+↑` |
| Copy the line or the selection down | `Shift+Alt+↓` | `Shift+Alt+↓` |
| Delete the line | `Ctrl+Shift+K` | `Cmd+Shift+K` |
| Delete the previous character | `Backspace` | `Backspace` |
| Delete the next character | `Delete` | `Delete` |
| Delete the previous word | `Ctrl+Backspace` | `Alt+Backspace` |
| Delete the next word | `Ctrl+Delete` | `Alt+Delete` |
| Delete from the cursor to the start of the line | — | `Cmd+Backspace` |
| Delete from the cursor to the end of the line | — | `Cmd+Delete` |
| Go to the matching bracket | `Ctrl+Shift+\` | `Cmd+Shift+\` |
| Allow `Tab` to move focus out of the editor | `Ctrl+M` | `Shift+Ctrl+M` |

The last command toggles a special accessibility mode. Pressing it again restores the normal `Tab` behaviour.

## Navigation and Selection

Adding `Shift` to a movement command extends the selection.

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| Move by character | `←` / `→` | `←` / `→` |
| Move by line | `↑` / `↓` | `↑` / `↓` |
| Move by word | `Ctrl+←` / `Ctrl+→` | `Alt+←` / `Alt+→` |
| Move by syntax node | `Alt+←` / `Alt+→` | `Ctrl+←` / `Ctrl+→` |
| To the start or end of the line | `Home` / `End` | `Home` / `End` or `Cmd+←` / `Cmd+→` |
| To the start or end of the document | `Ctrl+Home` / `Ctrl+End` | `Cmd+↑` / `Cmd+↓` |
| One page up or down | `PageUp` / `PageDown` | `PageUp` / `PageDown` or `Ctrl+↑` / `Ctrl+↓` |
| Select the current line | `Alt+L` | `Ctrl+L` |
| Select the parent syntax node | `Ctrl+I` | `Cmd+I` |
| Collapse a multi-selection to a single cursor | `Esc` | `Esc` |

An extra CMX-specific way: click a line number to select that whole line including the line break. Dragging over the line numbers selects the entire range of lines, including the last one.

## Multi-Cursors and Matches

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| Add a cursor one line above | `Ctrl+Alt+↑` | `Cmd+Alt+↑` |
| Add a cursor one line below | `Ctrl+Alt+↓` | `Cmd+Alt+↓` |
| Select the next occurrence of the current word or selection | `Ctrl+D` | `Cmd+D` |
| Select all occurrences of the current selection | `Ctrl+Shift+L` | `Cmd+Shift+L` |
| Rectangular selection with the mouse | `Alt` + drag | `Alt` + drag |
| Undo the last selection change | `Ctrl+U` | `Cmd+U` |
| Redo an undone selection change | `Alt+U` | `Cmd+Shift+U` |

## Search and Replace

These shortcuts are available when the `cmx.search_panel` setting is enabled.

| Action | Shortcut |
| --- | --- |
| Open the search panel | `Mod+F` |
| Next match | `F3` or `Mod+G` |
| Previous match | `Shift+F3` or `Shift+Mod+G` |
| Go to line | `Ctrl+Alt+G` on Windows/Linux, `Ctrl+G` on macOS |
| Select the next occurrence | `Mod+D` |
| Select all occurrences | `Mod+Shift+L` |
| Close the search panel | `Esc` when the focus is inside the panel |

The panel provides case-sensitive search, regular expressions, whole word search, replacing a single match and replacing all matches.

## Autocompletion and Emmet

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| Open autocompletion manually | `Ctrl+Space` | `Ctrl+Space` |
| Next or previous option | `↓` / `↑` | `↓` / `↑` |
| One page of options down or up | `PageDown` / `PageUp` | `PageDown` / `PageUp` |
| Apply the selected option | `Enter` | `Enter` |
| Close the suggestion list | `Esc` | `Esc` |
| Expand an Emmet abbreviation | `Tab` | `Tab` |

`Enter` applies an option only when the autocompletion list is open. Emmet works in supported HTML/CSS/XML contexts when the `cmx.emmet` setting is enabled.

## CMX and MODX Commands

| Action | Command |
| --- | --- |
| Command palette | `Mod+Shift+P` |
| Indentation formatting | `Shift+Alt+F` on Windows/Linux, `Cmd+Shift+F` on macOS |
| Go to an element from a MODX tag | `Ctrl`-click on Windows/Linux, `Cmd`-click on macOS |
| Opening the element | In a new browser tab when `cmx.goto_definition` is enabled |
| Selecting a line | Click its number |
| Selecting a range of lines | Drag over the line numbers |
| Inserting a MODX element | The `{ }` button on the editor panel |
| Version history | The clock button on the editor panel |
| Fullscreen mode | The fullscreen button on the editor panel |
| Quick settings for theme, font and word wrap | The gear button |

Navigation works for snippets, chunks, TVs and resources, for example `[[Wayfinder]]`, `[[$header]]`, `[[*tv_name]]` and `[[~42]]`.

## Sublime Mode

Enabled by the `cmx.keymap = sublime` setting. All standard commands are preserved; in addition, a more familiar shortcut applies:

| Action | Windows / Linux | macOS |
| --- | --- | --- |
| Select the current line | `Ctrl+L` | `Cmd+L` |

Moving and copying lines, deleting a line and toggling a comment use the same shortcuts as in the tables above.

## Vim Mode

Enabled by the `cmx.keymap = vim` setting. Normal, Insert, Visual and Visual Line modes, operators, motions, registers and macros are supported.

| Action | Command |
| --- | --- |
| Enter Insert | `i`, `a`, `o` or `O` |
| Return to Normal | `Esc` |
| Motions | `h`, `j`, `k`, `l`, `w`, `b`, `e`, `0`, `^`, `$`, `gg`, `G` |
| Visual / Visual Line | `v` / `V` |
| Delete a character / a line | `x` / `dd` |
| Copy a line | `yy` |
| Paste after / before the cursor | `p` / `P` |
| Undo / redo | `u` / `Ctrl+R` |
| Search | `/`, then `n` and `N` to navigate |
| Record a macro | `q` + register name; pressing `q` again stops recording |
| Run a macro | `@` + register name |
| Saving the MODX form | `Mod+S` — uses the manager's standard save |

## Additional macOS Shortcuts

CodeMirror also wires up Emacs-compatible commands:

| Action | macOS |
| --- | --- |
| Character left / right | `Ctrl+B` / `Ctrl+F` |
| Line up / down | `Ctrl+P` / `Ctrl+N` |
| Start / end of the line | `Ctrl+A` / `Ctrl+E` |
| Delete a character forward / backward | `Ctrl+D` / `Ctrl+H` |
| Delete to the end of the line | `Ctrl+K` |
| Delete the previous word | `Ctrl+Alt+H` |
| Split the line | `Ctrl+O` |
| Swap adjacent characters | `Ctrl+T` |
| Page down | `Ctrl+V` |

## CodeMirror Reference

The official description of commands and standard keymaps: [CodeMirror Reference Manual — Commands](https://codemirror.net/docs/ref/#commands).
