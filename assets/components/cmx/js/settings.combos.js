/**
 * System setting combo for cmx.theme
 */
MODx.combo.CMXTheme = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.SimpleStore({
            fields: ['d', 'v'],
            data: [
                      ['Auto', 'auto'],
                      ['Manager', 'manager'],
                      ['Light', 'light'],
                      ['Light Quiet', 'light-quiet'],
                      ['Light Solarized', 'light-solarized'],
                      ['Dark', 'dark'],
                      ['Dark Dracula', 'dark-dracula'],
                      ['Dark Nord', 'dark-nord'],
                      ['Dark Gruvbox', 'dark-gruvbox'],
                      ['Dark VSCode', 'dark-vscode'],
                      ['Dark Monokai', 'dark-monokai'],
                      ['Dark Solarized', 'dark-solarized']
                  ]
        }),
        displayField: 'd',
        valueField: 'v',
        mode: 'local',
        triggerAction: 'all',
        editable: false,
        selectOnFocus: false,
        preventRender: true,
        forceSelection: true,
        typeAhead: false
    });
    MODx.combo.CMXTheme.superclass.constructor.call(this, config);
};
Ext.extend(MODx.combo.CMXTheme, MODx.combo.ComboBox);
Ext.reg('cmx-combo-theme', MODx.combo.CMXTheme);

/**
 * System setting combo for cmx.keymap.
 */
MODx.combo.CMXKeymap = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.SimpleStore({
            fields: ['d', 'v'],
            data: [
                ['Standard', 'standard'],
                ['Sublime Text', 'sublime'],
                ['Vim', 'vim']
            ]
        }),
        displayField: 'd',
        valueField: 'v',
        mode: 'local',
        triggerAction: 'all',
        editable: false,
        selectOnFocus: false,
        preventRender: true,
        forceSelection: true,
        typeAhead: false
    });
    MODx.combo.CMXKeymap.superclass.constructor.call(this, config);
};
Ext.extend(MODx.combo.CMXKeymap, MODx.combo.ComboBox);
Ext.reg('cmx-combo-keymap', MODx.combo.CMXKeymap);
