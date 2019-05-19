<?php
/*
Forked from DW Shortcodes Bootstrap http://wordpress.org/plugins/dw-shortcodes-bootstrap/
*/

// add a plugin here
require_once('font_awesome.php');
require_once('bootstrap.php');

class Shortcodes{

    // add an item here following the name convention to add a plugin
    public $shortcodes = array(
        'bootstrap',
        'font_awesome'
    );



    public function __construct() {
        add_action( 'init' , array( &$this, 'init' ) );

        register_activation_hook(__FILE__, array(&$this, 'add_options_defaults'));

        add_action( 'admin_print_scripts', 'impulse_press_admin_inline_js' );
    }





    function init() {
        if(is_admin()){
            wp_enqueue_style("bs_admin_style", impulse_press_directory_uri() .'/includes/shortcodes/css/admin.css' );
            wp_enqueue_style("bs_shortcodes", impulse_press_directory_uri() .'/includes/shortcodes/css/shortcodes.css' );
        }

        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
        }

        if ( get_user_option('rich_editing') == 'true' ) {
            add_filter( 'mce_external_plugins', array(&$this, 'regplugins') );
            add_filter( 'mce_buttons', array(&$this, 'regbtns') );
        }


    }

    function regbtns($buttons) {
        foreach ($this->shortcodes as &$shortcode) {
            array_push($buttons,'separator',$shortcode);
        }
        return $buttons;
    }

    function regplugins($plgs) {
        foreach ($this->shortcodes as &$shortcode) {
            $plugin_url = impulse_press_directory_uri(). '/includes/shortcodes/js/plugins/'. $shortcode . '.js';
            $plgs[$shortcode] = $plugin_url;
        }

        return $plgs;
    }


}

$shortcodes = new Shortcodes();
