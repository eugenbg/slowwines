(function() {
    tinymce.PluginManager.add( 'font_awesome', function( editor, url ) {
        editor.addButton('font_awesome', {
            title: 'Font Awesome Shortcodes',
            icon: 'font_awesome',
            onclick: function () {
                editor.windowManager.open({
                    title: "Font Awesome Icons",
                    url: shortcode_url + '/js/plugins/font_awesome.html?TB_iframe=1',
                    width: 700,
                    height: 600
                });
            }
        });

    });

})();

