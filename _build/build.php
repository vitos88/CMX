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

use MODX\Revolution\modX;
use MODX\Revolution\modCategory;
use MODX\Revolution\modDashboardWidget;
use MODX\Revolution\modPlugin;
use MODX\Revolution\modPluginEvent;
use MODX\Revolution\Transport\modPackageBuilder;
use MODX\Revolution\Transport\modTransportPackage;

class CMXPackage
{
    private $modx;
    private $config = [];
    private $category;
    private $categoryAttributes = [];

    public $builder;

    public function __construct(modX $modx, array $config = [])
    {
        $this->modx = $modx;
        $this->modx->initialize('mgr');

        // A web build is allowed only to an authenticated sudo manager.
        if (PHP_SAPI !== 'cli'
            && (!$this->modx->user || !(bool) $this->modx->user->get('sudo'))
        ) {
            http_response_code(403);
            exit('CMX build requires CLI or an authenticated sudo Manager user.');
        }

        $root = dirname(__FILE__, 2) . '/';
        $this->config = array_merge([
            'log_level' => modX::LOG_LEVEL_INFO,
            'log_target' => XPDO_CLI_MODE ? 'ECHO' : 'HTML',
            'root' => $root,
            'build' => $root . '_build/',
            'elements' => $root . '_build/elements/',
            'resolvers' => $root . '_build/resolvers/',
            'core' => $root . 'core/components/' . $config['name_lower'] . '/',
            'assets' => $root . 'assets/components/' . $config['name_lower'] . '/',
        ], $config);

        $this->modx->setLogLevel($this->config['log_level']);
        $this->modx->setLogTarget($this->config['log_target']);
        $this->initialize();
    }

    public function process()
    {
        // Each elements/<name>.php file has a matching builder method.
        foreach (scandir($this->config['elements']) as $element) {
            if ($element === '.' || $element === '..' || $element[0] === '_') {
                continue;
            }
            $method = preg_replace('#\.php$#', '', $element);
            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }

        $vehicle = $this->builder->createVehicle($this->category, $this->categoryAttributes);
        $vehicle->resolve('file', [
            'source' => $this->config['core'],
            'target' => "return MODX_CORE_PATH . 'components/';",
        ]);
        $vehicle->resolve('file', [
            'source' => $this->config['assets'],
            'target' => "return MODX_ASSETS_PATH . 'components/';",
        ]);

        foreach (scandir($this->config['resolvers']) as $resolver) {
            if ($resolver === '.' || $resolver === '..' || $resolver[0] === '_') {
                continue;
            }
            if ($vehicle->resolve('php', ['source' => $this->config['resolvers'] . $resolver])) {
                $this->modx->log(modX::LOG_LEVEL_INFO, 'Added resolver ' . preg_replace('#\.php$#', '', $resolver));
            }
        }
        $this->builder->putVehicle($vehicle);

        $this->builder->setPackageAttributes([
            'license' => file_get_contents($this->config['core'] . 'documents/license.txt'),
            'readme' => file_get_contents($this->config['core'] . 'documents/readme.txt'),
            'changelog' => file_get_contents($this->config['core'] . 'documents/changelog.txt'),
            'requires' => [
                'php' => '>=8.0.0',
                'modx' => '>=3.0.0',
            ],
        ]);

        $this->modx->log(modX::LOG_LEVEL_INFO, 'Packing CMX transport package...');
        $this->builder->pack();

        if (!empty($this->config['install'])) {
            $this->install();
        }

        return $this->builder;
    }

    private function initialize()
    {
        $this->builder = new modPackageBuilder($this->modx);
        $this->builder->createPackage(
            $this->config['name'],
            $this->config['version'],
            $this->config['release']
        );
        $this->builder->registerNamespace(
            $this->config['name_lower'],
            false,
            true,
            '{core_path}components/' . $this->config['name_lower'] . '/'
        );

        $this->category = $this->modx->newObject(modCategory::class);
        $this->category->set('category', $this->config['name']);
        $this->categoryAttributes = [
            xPDOTransport::UNIQUE_KEY => 'category',
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::RELATED_OBJECTS => true,
            xPDOTransport::RELATED_OBJECT_ATTRIBUTES => [],
        ];
        $this->modx->log(modX::LOG_LEVEL_INFO, 'Created package, namespace and main category.');
    }

    private function plugins()
    {
        $plugins = include $this->config['elements'] . 'plugins.php';
        if (!is_array($plugins)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not package plugins.');
            return;
        }

        $this->categoryAttributes[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['Plugins'] = [
            xPDOTransport::UNIQUE_KEY => 'name',
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => !empty($this->config['update']['plugins']),
            xPDOTransport::RELATED_OBJECTS => true,
            xPDOTransport::RELATED_OBJECT_ATTRIBUTES => [
                'PluginEvents' => [
                    xPDOTransport::PRESERVE_KEYS => true,
                    xPDOTransport::UPDATE_OBJECT => true,
                    xPDOTransport::UNIQUE_KEY => ['pluginid', 'event'],
                ],
            ],
        ];

        $objects = [];
        foreach ($plugins as $name => $data) {
            $plugin = $this->modx->newObject(modPlugin::class);
            $plugin->fromArray([
                'name' => $name,
                'category' => 0,
                'description' => $data['description'] ?? '',
                'plugincode' => $this->getFileContent(
                    $this->config['core'] . 'elements/plugins/' . $data['file'] . '.php'
                ),
                'static' => !empty($this->config['static']['plugins']),
                'static_file' => $this->config['name_lower'] . '/elements/plugins/' . $data['file'] . '.php',
            ], '', true, true);

            $events = [];
            foreach ($data['events'] ?? [] as $eventName => $eventData) {
                $event = $this->modx->newObject(modPluginEvent::class);
                $event->fromArray(array_merge([
                    'event' => $eventName,
                    'priority' => 0,
                    'propertyset' => 0,
                ], $eventData), '', true, true);
                $events[] = $event;
            }
            if ($events) {
                $plugin->addMany($events);
            }
            $objects[] = $plugin;
        }

        $this->category->addMany($objects);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'Packaged ' . count($objects) . ' plugin with its events.');
    }

    private function settings()
    {
        // The shared definitions use the same local $modx variable as the
        // standalone element definitions in the reference package layout.
        $modx = $this->modx;
        $settings = include $this->config['elements'] . 'settings.php';
        if (!is_array($settings)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not package system settings.');
            return;
        }

        $attributes = [
            xPDOTransport::UNIQUE_KEY => 'key',
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => !empty($this->config['update']['settings']),
        ];
        foreach ($settings as $setting) {
            $this->builder->putVehicle($this->builder->createVehicle($setting, $attributes));
        }
        $this->modx->log(modX::LOG_LEVEL_INFO, 'Packaged ' . count($settings) . ' system settings.');
    }

    private function widgets()
    {
        $widgets = include $this->config['elements'] . 'widgets.php';
        if (!is_array($widgets)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not package dashboard widgets.');
            return;
        }

        $attributes = [
            xPDOTransport::UNIQUE_KEY => 'name',
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => !empty($this->config['update']['widgets']),
        ];
        foreach ($widgets as $name => $data) {
            $widget = $this->modx->newObject(modDashboardWidget::class);
            $widget->fromArray(array_merge(['name' => $name], $data), '', true, true);
            $this->builder->putVehicle($this->builder->createVehicle($widget, $attributes));
        }
        $this->modx->log(modX::LOG_LEVEL_INFO, 'Packaged ' . count($widgets) . ' dashboard widget.');
    }

    /**
     * MODX adds PHP tags when it caches a plugin. Store only the executable
     * code in plugincode, otherwise the cached file starts with two <?php tags.
     */
    private function getFileContent($filename)
    {
        if (!file_exists($filename)) {
            return '';
        }
        $content = trim(file_get_contents($filename));
        $content = preg_replace('/^<\?php\b/i', '', $content, 1);
        $content = preg_replace('/\?>\s*$/', '', $content, 1);
        return trim($content);
    }

    private function install()
    {
        $signature = $this->builder->getSignature();
        $parts = explode('-', $signature);
        $version = explode('.', $parts[1]);

        $package = $this->modx->getObject(modTransportPackage::class, ['signature' => $signature]);
        if (!$package) {
            $package = $this->modx->newObject(modTransportPackage::class);
            $package->set('signature', $signature);
            $package->fromArray([
                'created' => date('Y-m-d H:i:s'),
                'updated' => null,
                'state' => 1,
                'workspace' => 1,
                'provider' => 0,
                'source' => $signature . '.transport.zip',
                'package_name' => $this->config['name'],
                'version_major' => $version[0],
                'version_minor' => $version[1] ?? 0,
                'version_patch' => $version[2] ?? 0,
            ]);
            if (!empty($parts[2])) {
                $release = preg_split('/([0-9]+)/', $parts[2], -1, PREG_SPLIT_DELIM_CAPTURE);
                $package->set('release', $release[0]);
                $package->set('release_index', $release[1] ?? '0');
            }
            $package->save();
        }

        if ($package->install()) {
            $this->modx->runProcessor('System/ClearCache');
            $this->modx->log(modX::LOG_LEVEL_INFO, 'Package ' . $signature . ' installed successfully.');
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not auto-install ' . $signature . '.');
        }
    }
}

$configFile = dirname(__FILE__) . '/config.inc.php';
if (!file_exists($configFile)) {
    exit('Could not load CMX build config.');
}
$config = require $configFile;
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
$package = new CMXPackage($modx, $config);
$builder = $package->process();

if (!empty($config['download'])) {
    $name = $builder->getSignature() . '.transport.zip';
    $content = file_get_contents(MODX_CORE_PATH . '/packages/' . $name);
    if ($content !== false) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $name);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($content));
        exit($content);
    }
}
