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

require_once dirname(dirname(dirname(__FILE__))) . '/includes/helpers.php';

class modCompletionsLint extends modProcessor {
    public function checkPermissions() {
        // php -l costs one process spawn per request — keep it away from
        // read-only manager accounts. Any save permission of the code
        // surfaces (or documents) is enough to use the linter.
        return $this->modx->hasPermission('save_snippet')
            || $this->modx->hasPermission('save_plugin')
            || $this->modx->hasPermission('save_chunk')
            || $this->modx->hasPermission('save_template')
            || $this->modx->hasPermission('save_document');
    }
    public function getLanguageTopics() {
        return array();
    }

    public function initialize() {
        return true;
    }

    public function process() {
        $code = (string) $this->getProperty('code', '');
        if ($code === '' || strlen($code) > 512 * 1024) {
            return $this->success('', array('available' => true, 'errors' => array()));
        }

        // server-side guard against runaway loops (the editor debounces
        // at 900 ms; a scripted loop would spawn one php process per hit).
        // Over the limit the processor answers "no errors" — the client
        // keeps its browser-side check and simply gets no server diff.
        if (!cmxRateLimit($this->modx, 'lint', 40, 30)) {
            return $this->success('', array('available' => true, 'errors' => array()));
        }

        $phpBinary = trim((string) $this->modx->getOption('cmx.php_path', null, 'php'));
        if ($phpBinary === '') {
            $phpBinary = 'php';
        }

        if (!function_exists('exec')) {
            return $this->success('', array('available' => false, 'errors' => array()));
        }

        // snippets/plugins are edited without the opening <?php tag —
        // add it back, otherwise php -l reports a parse error
        $wrapped = $code;
        if (stripos(ltrim($code), '<?php') !== 0) {
            $wrapped = "<?php\n" . $code;
        }

        $file = tempnam(sys_get_temp_dir(), 'cmxlint');
        if ($file === false) {
            return $this->success('', array('available' => false, 'errors' => array()));
        }
        file_put_contents($file, $wrapped);

        // escapeshellarg() (NOT escapeshellcmd): the binary path is ONE
        // argument — escapeshellcmd() mangles paths with spaces or
        // brackets ("C:\Program Files\php\php.exe" on Windows) into a
        // command that can never run
        $command = sprintf('%s -l %s 2>&1', escapeshellarg($phpBinary), escapeshellarg($file));
        exec($command, $output, $codeExit);
        @unlink($file);
        $output = implode("\n", $output);

        // the binary is missing ("command not found", "not recognized")
        if ($codeExit === 127 || stripos($output, 'command not found') !== false || stripos($output, 'not recognized') !== false) {
            return $this->success('', array('available' => false, 'errors' => array()));
        }

        $errors = array();
        // "PHP Parse error:  syntax error, unexpected ... in /path on line 5"
        // "PHP Fatal error: ... in /path on line 12"
        if (preg_match_all('/(?:Parse|Fatal)\s+error:\s*(?:\s+syntax error,?\s*)?(.*?)\s+in\s+\S+\s+on\s+line\s+(\d+)/i', $output, $matches, PREG_SET_ORDER)) {
            $lineOffset = stripos(ltrim($code), '<?php') === 0 ? 0 : -1;
            foreach ($matches as $match) {
                $line = (int) $match[2] + $lineOffset;
                $errors[] = array(
                    'line' => max(1, $line),
                    'message' => trim($match[1]),
                );
            }
        }

        return $this->success('', array('available' => true, 'errors' => $errors));
    }
}
return 'modCompletionsLint';
