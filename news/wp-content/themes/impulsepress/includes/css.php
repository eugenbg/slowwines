<?php

define( 'CSS_THEMES_PATH', get_stylesheet_directory() . '/css-themes/' );
define( 'CSS_THEMES_URI', get_stylesheet_directory_uri() . '/css-themes/' );

function impulse_press_load_css_themes() {
    //Stylesheets Reader
    $alt_stylesheet_path = CSS_THEMES_PATH;
    $alt_stylesheets = array();

    if ( is_dir($alt_stylesheet_path) )
    {
        if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
        {
            while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
            {
                if(stristr($alt_stylesheet_file, ".css") !== false)
                {
                    $alt_stylesheets[] = $alt_stylesheet_file;
                }
            }
        }
    }
    return $alt_stylesheets;
}

function  impulse_press_print_load_css_themes() {
    $res = '';
    $css_themes =  impulse_press_load_css_themes();
     foreach ($css_themes as &$css_theme_file) {
        $res .= '<strong>' . $css_theme_file . '</strong><br>';
     }

    return $res;
}

function  impulse_press_print_list_css_themes() {
    $themes = array ();


    $css_themes =  impulse_press_load_css_themes();
     foreach ($css_themes as &$css_theme_file) {
         array_push($themes, $css_theme_file);
     }

    return $themes;
}


