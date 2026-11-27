<?php
/**
 * The base class for CMX.
 *
 * @package cmx
 */
class Cmx {
    /**
     * @var modX A reference to the modX object.
     */
    public $modx = null;
    /**
     * @var array An array of configuration options
     */
    public $config = array();
    /**
     * @var bool A flag to prevent double script registering
     */
    public $assetsLoaded = false;

    public function __construct(modX &$modx, array $config = array()) {
        $this->modx = &$modx;

        $corePath = $this->modx->getOption('cmx.core_path', $config, $this->modx->getOption('core_path') . 'components/cmx/');
        $assetsUrl = $this->modx->getOption('cmx.assets_url', $config, $this->modx->getOption('assets_url') . 'components/cmx/');

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'assetsUrl' => $assetsUrl,
        ), $config);

        $this->modx->addPackage('cmx', $this->config['corePath'] . 'model/');
        $this->modx->lexicon->load('cmx:default');
    }

    public function initialize() {
        if (!$this->assetsLoaded) {
            $this->modx->controller->addLexiconTopic('cmx:default');
            $this->modx->controller->addHtml($this->getLangScript());
            $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'js/cmx.min.js');
        }
        $this->assetsLoaded = true;
    }

    /**
     * Publishes the manager language of the logged-in user to
     * MODx.ux.Cmx.lang. The editor UI strings and completion
     * descriptions follow it. This is the only reliable source:
     * manager_language never reaches MODx.config on MODX 2.x, and
     * cultureKey is the context setting ("en" in mgr by default), not
     * the language picked at the login screen.
     *
     * @return string
     */
    protected function getLangScript() {
        $lang = strtolower((string) $this->modx->getOption('manager_language', null, ''));
        if ($lang === '') {
            $lang = strtolower((string) $this->modx->getOption('cultureKey', null, 'en'));
        }
        $short = in_array($lang, array('ru', 'uk', 'be'), true) ? 'ru' : 'en';

        return '<script>/* CMX: manager language for the editor UI */'
            . '(function(w){w.MODx=w.MODx||{};w.MODx.ux=w.MODx.ux||{};w.MODx.ux.Cmx=w.MODx.ux.Cmx||{};'
            . 'w.MODx.ux.Cmx.lang=' . json_encode($short) . ';})(window);</script>';
    }
}
