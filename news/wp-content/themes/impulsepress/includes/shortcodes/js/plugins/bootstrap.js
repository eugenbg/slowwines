(function() {
    tinymce.PluginManager.add( 'bootstrap', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton('bootstrap', {
            type: 'menubutton',
            icon: 'bootstrap',
            menu: [
                {
                    text: 'Fluid grid system',
                    value: 'Fluid grid system',
                    menu: addGrids()
                },

                {
                    text: 'Alerts',
                    value: 'Alerts',
                    menu: addAlerts()
                },

                {
                    text: 'Buttons',
                    value: 'Buttons',
                    onclick: function() {
                        addButtons(editor)
                    }

                },

                {
                    text: 'Button Groups',
                    value: 'Button Groups',
                    onclick: function() {
                        addButtonGroups(editor)
                    }

                },

                {
                    text: 'Collapse',
                    value: 'Collapse',
                    onclick: function() {
                        addCollapse(editor)
                    }

                },

                {
                    text: 'Glyphicons',
                    value: 'Glyphicons',
                    onclick: function() {
                        addIcons(editor)
                    }

                },

                {
                    text: 'Labels',
                    value: 'Labels',
                    menu: addLabels()

                },

                {
                    text: 'Lead',
                    value: 'Lead',
                    onclick: function() {
                        addLead();
                    }

                },

                {
                    text: 'Tabs',
                    value: 'Tabs',
                    onclick: function() {
                        addTabs(editor);
                    }

                },

                {
                    text: 'Tooltip',
                    value: 'Tooltip',
                    onclick: function() {
                        addTooltip(editor);
                    }

                },

                {
                    text: 'Well',
                    value: 'Well',
                    menu: addWells()
                },

                {
                    text: 'Carousel',
                    value: 'Carousel',
                    onclick: function() {
                        addCarousel()
                    }
                }



            ]
        });

    });





    function addWells(m) {

        var res =
            [
                {
                    text: 'Small',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[well size="sm"]This well needs your attention.[/well]');
                    }
                },
                {
                    text: 'Medium',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[well size="md"]This well needs your attention.[/well]');
                    }
                },
                {
                    text: 'Large',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[well size="lg"]This well needs your attention.[/well]');
                    }
               }

            ];

        return res;

    }

    function addTooltip(editor) {

        editor.windowManager.open( {
            title: 'Tooltip',
            body: [
                {
                    type: 'textbox',
                    name: 'title',
                    label: 'Title'
                },

                {
                    type: 'textbox',
                    name: 'content',
                    label: 'Content'
                },

                {
                    type: 'listbox',
                    name: 'placement',
                    label: 'Placement',
                    'values': [
                        {text: 'Top', value: 'top'},
                        {text: 'Right', value: 'right'},
                        {text: 'Bottom', value: 'bottom'},
                        {text: 'Back', value: 'back'}
                    ]
                },

                {
                    type: 'listbox',
                    name: 'trigger',
                    label: 'Trigger',
                    'values': [
                        {text: 'Click', value: 'click'},
                        {text: 'Hover', value: 'hover'},
                        {text: 'Focus', value: 'focus'}
                    ]
                }

            ],

            onsubmit: function( e ) {
                var content = e.data.content;
                var placement = e.data.placement;
                var trigger = e.data.trigger;
                var title = e.data.title;
                var shortcode = '[tooltip title="' + title + '" placement="' + placement + '" trigger="' + trigger + '"]';
                shortcode+= content;
                shortcode+= '[/tooltip]';

                tinymce.activeEditor.execCommand('mceInsertContent', false, shortcode);
            }
        });

    }

    function addTabs(editor) {
        editor.windowManager.open({
            title: "Tabs",
            url: shortcode_url + '/js/plugins/tabs.html?TB_iframe=1',
            width: 700,
            height: 600
        });
    }


    function addCarousel() {
        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[carousel][carousel_slide]...[/carousel_slide][carousel_slide]...[/carousel_slide][carousel_slide]...[/carousel_slide][/carousel]');
    }

    function addLead() {
       tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[lead]This is a lead text and needs your attention.[/lead]');
    }

    function addLabels() {

        var res =
            [
                {
                    text: 'Default',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[label]Default[/label]' );
                    }
                },
                {
                    text: 'Primary',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[label class="primary"]Primary[/label]' );
                    }
                },
                {
                    text: 'Success',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[label class="success"]Success[/label]' );
                    }
                },
                {
                    text: 'Info',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[label class="info"]Info[/label]' );
                    }
                },

                {
                    text: 'Warning',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[label class="warning"]Warning[/label]' );
                    }
                }
                    ,

                {
                    text: 'Danger',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[label class="danger"]Danger[/label]' );
                    }
                }


            ];

        return res;

    }

    function addIcons(editor) {
        editor.windowManager.open({
            title: "Icons",
            url: shortcode_url + '/js/plugins/icons.html?TB_iframe=1',
            width: 700,
            height: 600
        });
    }


    function addGrids() {
        var res =
        [
            {
                text: '12 Columns',
                onclick: function (e) {
                    e.stopPropagation();
                    tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row class="row"]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[col class="col-xs-1"]Text[/col]<br class="nc"/>[/row]');
                }
            },
            {
                text: '6 Columns',
                onclick: function (e) {
                    e.stopPropagation();
                    tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row class="row"]<br class="nc"/>[col class="col-xs-2"]Text[/col]<br class="nc"/>[col class="col-xs-2"]Text[/col]<br class="nc"/>[col class="col-xs-2"]Text[/col]<br class="nc"/>[col class="col-xs-2"]Text[/col]<br class="nc"/>[col class="col-xs-2"]Text[/col]<br class="nc"/>[col class="col-xs-2"]Text[/col]<br class="nc"/>[/row]');
                }
            },
            {
                text: '4 Columns',
                onclick: function (e) {
                    e.stopPropagation();
                    tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row class="row"]<br class="nc"/>[col class="col-xs-3"]Text[/col]<br class="nc"/>[col class="col-xs-3"]Text[/col]<br class="nc"/>[col class="col-xs-3"]Text[/col]<br class="nc"/>[col class="col-xs-3"]Text[/col]<br class="nc"/>[/row]');
                }
            },
            {
                text: '3 Columns',
                onclick: function (e) {
                    e.stopPropagation();
                    tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row class="row"]<br class="nc"/>[col class="col-xs-4"]Text[/col]<br class="nc"/>[col class="col-xs-4"]Text[/col]<br class="nc"/>[col class="col-xs-4"]Text[/col]<br class="nc"/>[/row]');
                }
            },
            {
                text: '2 Columns',
                onclick: function (e) {
                    e.stopPropagation();
                    tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row class="row"]<br class="nc"/>[col class="col-xs-6"]Text[/col]<br class="nc"/>[col class="col-xs-6"]Text[/col]<br class="nc"/>[/row]');
                }
            },
             {
                text: '1 Columns',
                onclick: function (e) {
                    e.stopPropagation();
                    tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row class="row"]<br class="nc"/>[col class="col-xs-12"]Text[/col]<br class="nc"/>[/row]');
                }
            },

            {
                text: 'Custom Grid',
                onclick: function (e) {
                    e.stopPropagation();
                    tb_show('Custom Grid', shortcode_url + '/js/plugins/grid.html?TB_iframe=1');
                }
            }

        ]

        return res;
    }


    function addAlerts(m) {
        var res =
            [
                {
                    text: 'Success',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[notification type="success"]<strong>Well done!</strong>   You successfully read <a href="#" class="alert-link">this important alert message</a>.  [/notification]' );
                    }
                },
{
                    text: 'Info',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[notification type="info"]<strong>Heads up!</strong>   This <a href="#" class="alert-link">alert needs your attention</a>, but it\'s not super important.  [/notification]' );
                    }
                },
{
                    text: 'Warning',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[notification type="warning"]<strong>Warning!</strong>  Best check yo self, you\'re <a href="#" class="alert-link">not looking too good</a>. [/notification]' );
                    }
                },
{
                    text: 'Error',
                    onclick: function (e) {
                        e.stopPropagation();
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[notification type="danger"]<strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things</a> up and try submitting again.[/notification]' );
                    }
                }


            ];

        return res;
    }


    function addButtons(editor) {

        editor.windowManager.open( {
            title: 'Buttons',
            body: [
                {
                    type: 'textbox',
                    name: 'link',
                    label: 'Link'
                },
                {
                    type: 'listbox',
                    name: 'size',
                    label: 'Size',
                    'values': [
                        {text: 'Default', value: 'md'},
                        {text: 'Mini', value: 'xs'},
                        {text: 'Small', value: 'sm'},
                        {text: 'Large', value: 'lg'}
                    ]
                },

                {
                    type: 'listbox',
                    name: 'type',
                    label: 'Type',
                    'values': [
                        {text: 'Default', value: 'default'},
                        {text: 'Primary', value: 'primary'},
                        {text: 'Success', value: 'success'},
                        {text: 'Info', value: 'info'},
                        {text: 'Warning', value: 'warning'},
                        {text: 'Danger', value: 'danger'}
                    ]
                }

            ],

            onsubmit: function( e ) {
                tinymce.activeEditor.execCommand('mceInsertContent', false, '[button size="' + e.data.size.toLowerCase() + '" type="' + e.data.type.toLowerCase() + '" value="' + e.data.type + '" href="' + e.data.link + '"]');
            }
        });
    }

    function addButtonGroups(editor) {


        editor.windowManager.open( {
            title: 'Buttons',
            body: [

                {
                    type: 'listbox',
                    name: 'type',
                    label: 'type',
                    'values': [
                        {text: 'Basic', value: 'basic'},
                        {text: 'Toolbar', value: 'toolbar'}
                    ]
                }

            ],

            onsubmit: function( e ) {
                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '' +
                    '[button_group type="' +e.data.type +  '"]' +
                    '   [button size="normal" type="default" value="Left" href="#"] ' +
                    '   [button size="normal" type="default" value="Middle" href="#"] ' +
                    '   [button size="normal" type="default" value="Right" href="#"]' +
                    '[/button_group]');
            }
        });




    }

    function addCollapse(editor) {

        editor.windowManager.open( {
            title: 'Buttons',
            body: [

                {
                    type: 'listbox',
                    name: 'items',
                    label: 'items',
                    'values': [
                        {text: '1', value: '1'},
                        {text: '2', value: '2'},
                        {text: '3', value: '4'},
                        {text: '4', value: '4'},
                        {text: '5', value: '5'},
                        {text: '6', value: '6'}
                    ]
                }

            ],

            onsubmit: function( e ) {
                /**
                 * Shortcode markup
                 * -----------------------
                 *      [collapse id="#"]
                 *         [citem title="" id="" parent=""]
                 *         [/citem]
                 *     [/collapse]
                 *  -----------------------
                 */
                var uID =  Math.floor((Math.random()*100)+1);
                var shortcode = '[collapse id="collapse_'+uID+'"]<br class="nc"/>';
                var num = e.data.items;
                for(i=0;i<num;i++){
                    var id = Math.floor((Math.random()*100)+1);
                    var title = 'Collapsible Group Item '+(i+1);
                    shortcode+= '[citem title="'+title+'" id="citem_'+id+'" parent="collapse_'+uID+'"]<br class="nc"/>';
                    shortcode += 'Collapse content goes here....<br class="nc"/>';
                    shortcode += '[/citem]<br class="nc"/>';
                }

                shortcode+= '[/collapse]';

                tinymce.activeEditor.execCommand('mceInsertContent',false,shortcode);
            }
        });







    }


})();