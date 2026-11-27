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
if (!class_exists('CmxInputRender')) {
    class CmxInputRender extends modTemplateVarInputRender {
        public function getTemplate() {
            $corePath = $this->modx->getOption(
                'cmx.core_path',
                null,
                $this->modx->getOption('core_path') . 'components/cmx/'
            );
            return $corePath . 'tv/input/tpl/cmx.tpl';
        }

        public function process($value, array $params = array()) {
            $language = '';
            if (isset($params['language']) && is_string($params['language']) && $params['language'] !== '') {
                $language = $params['language'];
            }
            if ($language === '') {
                // no language set on the TV — follow the template engine of
                // the site (the same map as the plugin): Fenom templates get
                // text/x-smarty, so Fenom completion works in TV fields too
                $language = 'text/html';
                $custom = $this->modx->getOption('cmx.html_elements_mime', null, false);
                if ($custom) {
                    $language = $custom;
                } elseif ($this->modx->getOption('twiggy_class')) {
                    $language = 'text/x-twig';
                } elseif ($this->modx->getOption('pdotools_fenom_parser')) {
                    $language = 'text/x-smarty';
                }
            }
            $height = 260;
            if (isset($params['height']) && (int) $params['height'] >= 100) {
                $height = (int) $params['height'];
            }
            $this->setPlaceholder('cmx_language', $language);
            $this->setPlaceholder('cmx_height', $height);
            return parent::process($value, $params);
        }
    }
}
return 'CmxInputRender';
