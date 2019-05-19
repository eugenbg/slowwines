<?php
/**
 * ImpulsePress Framework functions and definitions.
  */

 /*
 * load the include files
 */
define( 'IMPULSE_PRESS_PATH', get_template_directory() );
define( 'IMPULSE_PRESS_URI', get_template_directory_uri() );

require_once (impulse_press_directory() . '/includes/admin/index.php');
require_once( impulse_press_directory() . '/includes/wp_bootstrap_navwalker.php');
require_once( impulse_press_directory() . '/includes/class-ip-bootstrap-page-walker.php');
require_once( impulse_press_directory() . '/includes/utilities.php');
require_once( impulse_press_directory() . '/includes/google-fonts.php' );
require_once( impulse_press_directory() . '/includes/css.php' );
require_once( impulse_press_directory() . '/includes/social.php' );
require_once( impulse_press_directory() . '/includes/login-logo.php' );
require_once( impulse_press_directory() . '/includes/portfolio.php' );
require_once( impulse_press_directory() . '/includes/gallery.php' );
require_once( impulse_press_directory() . '/includes/pages-options.php' );
require_once( impulse_press_directory() . '/includes/widgets.php' );
require_once( impulse_press_directory() . '/includes/shortcodes/shortcodes.php' );



add_action( 'wp_enqueue_scripts', 'impulse_press_register_styles' );
add_action( 'wp_enqueue_scripts', 'impulse_press_register_scripts' );
add_action('widgets_init', 'impulse_press_widgets_init');
add_action( 'wp_enqueue_scripts', 'impulse_press_enqueue_comment_reply' );
add_action( 'wp_dashboard_setup', 'impulse_press_add_dashboard_widgets' );
add_action( 'admin_init', 'impulse_press_hide_editor' );
add_filter('widget_text', 'do_shortcode');
add_action( 'init', 'impulse_press_initialize_cmb_meta_boxes' );
add_filter( 'cmb_meta_boxes', 'impulse_press_sample_metaboxes' );
add_action('after_setup_theme', 'impulse_press_setup');

function impulse_press_directory() {
    return IMPULSE_PRESS_PATH; 
}

function impulse_press_directory_uri() {
    return IMPULSE_PRESS_URI;
}

function impulse_press_setup() {

     global $content_width;
     if (!isset($content_width)) {
         $content_width = 550;
     }

    add_theme_support('automatic-feed-links');
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 450, 300, true );

    register_nav_menu( 'top-menu', 'Top Menu' );
    register_nav_menu( 'footer-menu', 'Footer Menu' );
}


/*
 * Shortcodes initialization
 */
function impulse_press_admin_inline_js(){
        $url = impulse_press_directory_uri() . '/includes/shortcodes/';
	    echo "<script type='text/javascript'>\n";
	    echo 'var shortcode_url = "'.$url .'"';
	    echo "\n</script>";
}


/**
 * A comment reply.
 */
function impulse_press_enqueue_comment_reply() {
if ( is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}



/**
 * Add a widget to the dashboard.
 */
function impulse_press_add_dashboard_widgets() {

	add_meta_box(
                 'impulse_press_widget',         // Widget slug.
                 'Impulse Press',         // Title.
                 'impulse_press_dashboard_widget_function', // Display function.
            'dashboard', 'side', 'high'
        );

}


/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function impulse_press_dashboard_widget_function() {

    impulse_press_display_rss_feed('Latest News','http://impulsepress.twoimpulse.com/feed');
    impulse_press_display_rss_feed('Tutorials','http://www.twoimpulse.com/support/category/impulse-press/feed');


}

/*
 * Register the JavaScript libraries
 */
function impulse_press_register_scripts()
{

    // De-register default jquery
    if( !is_admin()){
	    wp_deregister_script('jquery');
    }

	// Register the scripts for this theme:
    wp_register_script( 'jquery', impulse_press_directory_uri() . '/js/jquery-2.0.3.min.js', array(),null ,false);
    wp_register_script( 'bootstrap', impulse_press_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'placeholder', impulse_press_directory_uri() . '/js/holder.js', array( 'jquery' ),null, false );
    wp_register_script( 'scroll', impulse_press_directory_uri() . '/js/scroll.js', array( 'jquery' ),null, false );
    wp_register_script( 'easing', impulse_press_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ),null, false );
    wp_register_script( 'validate', impulse_press_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'isotope', impulse_press_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'masonry', impulse_press_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'blueimp', impulse_press_directory_uri() . '/js/jquery.blueimp-gallery.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'blueimp2', impulse_press_directory_uri() . '/js/bootstrap-image-gallery.min.js', array( 'jquery' ),null, false );


	//  enqueue the scripts
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'placeholder' );
    wp_enqueue_script( 'scroll' );
    wp_enqueue_script( 'easing' );
    wp_enqueue_script( 'validate' );
    wp_enqueue_script( 'isotope' );
    wp_enqueue_script( 'masonry' );
    wp_enqueue_script( 'blueimp' );
    wp_enqueue_script( 'blueimp2' );

}


/*
 * Register stylesheets
 */
function impulse_press_register_styles()
{
	// Register the styles
	wp_register_style( 'bootstrap', impulse_press_directory_uri() . '/css/bootstrap.min.css', array(), null, 'all' ) ;
    wp_register_style( 'font-awesome', impulse_press_directory_uri() . '/css/font-awesome.min.css', array(), null, 'all' );
    wp_register_style( 'blueimp', impulse_press_directory_uri() . '/css/blueimp-gallery.css', array(), null, 'all' );
    wp_register_style( 'blueimp2', impulse_press_directory_uri() . '/css/bootstrap-image-gallery.css', array(), null, 'all' );
    wp_register_style( 'waypoints', impulse_press_directory_uri() . '/css/waypoints.css', array(), null, 'all' );


	//  enqueue the styles
	wp_enqueue_style('bootstrap' );
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('blueimp');
    wp_enqueue_style('blueimp2');
    wp_enqueue_style('waypoints');

    // register the theme selected
    $css_theme_file = impulse_press_options('theme');
     $css_theme_file_path = CSS_THEMES_URI . $css_theme_file;
     wp_register_style($css_theme_file ,$css_theme_file_path, array(), null, 'all' );
     wp_enqueue_style($css_theme_file);



}







function impulse_press_options($id, $fallback = false) {
        if ( $fallback == false ) $fallback = '';
        if (defined('SMOF_VERSION')) {
		    global $smof_data;
		    $output = ( isset($smof_data[$id]) && $smof_data[$id] !== '' ) ? $smof_data[$id] : $fallback;
		    return $output;
	    } else {
            return $fallback;
        }
}


function impulse_page_options($page_id,$option_id, $fallback = false) {
    if ( $fallback == false ) $fallback = '';
    $result = $fallback;

    $option = get_post_meta($page_id, $option_id, true);
    if($option != '') {
        $result = $option;
    }
    return $result;
}

function impulse_page_options_multi($page_id,$option_id, $fallback = array()) {
    $values = get_post_custom($page_id);
    $result = $values[$option_id];
    return $result;
}


/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Courtesy of Dimox
 *
 * bbPress compatibility patch by Dan Smith
 */
function impulse_press_breadcrumb_lists() {

        $chevron = '<span class="divider">/</span>';
        $name = __('Home','impulse-press'); //text for the 'Home' link
        $currentBefore = '<li class="active">';
        $currentAfter = '</li>';

        echo '<ul class="breadcrumb">';

        global $post;
        $home = esc_url( home_url() );
        echo '<li><a href="' . $home . '">' . $name . '</a></li>';

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, TRUE, ''));
            echo $currentBefore . 'Archive by category &#39;';
            single_cat_title();
            echo '&#39;' . $currentAfter;
        } elseif (get_post_type( get_the_ID() ) == 'project')  {
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $chevron . '</li>  ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ';
            echo $currentBefore . get_the_time('d') . $currentAfter;
        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
            echo $currentBefore . get_the_time('F') . $currentAfter;
        } elseif (is_year()) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;
        } elseif (is_single()) {
            $pid = $post->ID;
            $pdata = get_the_category($pid);
            $adata = get_post($pid);
            if(!empty($pdata)){
                echo '<li>' .get_category_parents($pdata[0]->cat_ID, TRUE, ' '). '</li> ';
                echo $currentBefore;
            }
            echo $adata->post_title;
            echo $currentAfter;
        } elseif (is_page() && !$post->post_parent) {
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumb_lists = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumb_lists[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumb_lists = array_reverse($breadcrumb_lists);
            foreach ($breadcrumb_lists as $crumb)
                echo $crumb . ' ' . $chevron . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_search()) {
            echo $currentBefore . __('Search results for &#39;','impulse-press') . get_search_query() . __('&#39;','impulse-press') . $currentAfter;
        } elseif (is_tag()) {
            echo $currentBefore . __('Posts tagged &#39;','impulse-press');
            single_tag_title();
            echo '&#39;' . $currentAfter;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . __('Articles posted by ','impulse-press') . $userdata->display_name . $currentAfter;
        } elseif (is_404()) {
            echo $currentBefore . __('Error 404','impulse-press') . $currentAfter;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __('Page','impulse-press') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</ul>';
}



if ( !function_exists('impulse_press_opt_display_social_links') ) {
    function impulse_press_opt_display_social_links() {
        $output = '';
        $output += '<a target="_blank" title="twitter" href="http://twitter.com/twoimpulse"> <i class="fa fa-2x fa-twitter"></i></a>';
        $output +='<a target="_blank" title="github" href="https://github.com/twoimpulse/"><i class="fa fa-2x fa-github"></i></a>';
        $output += '<a target="_blank" title="facebook" href="https://www.facebook.com/twoimpulse"><i class="fa fa-2x fa-facebook"></i></a>';
        return $output;
    }
}


/**
 * ImpulsePress Page Menu generator
 * @param array $args options
 */
function impulse_press_page_menu( $args = array() ) {
    $defaults = array(
        'sort_column' => 'menu_order, post_title',
        'menu_class' => 'menu',
        'container' => 'div',
        'echo' => true,
        'link_before' => '',
        'link_after' => '',
    );
    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_page_menu_args', $args );

    $menu = '';

    $list_args = $args;

    // Show Home in the menu
    if ( ! empty($args['show_home']) ) {
        if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
            $text = __('Home','impulse-press');
        else
            $text = $args['show_home'];
        $class = '';
        if ( is_front_page() && !is_paged() )
            $class = 'class="current_page_item"';
        $menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
        // If the front page is a page, add it to the exclude list
        if (get_option('show_on_front') == 'page') {
            if ( !empty( $list_args['exclude'] ) ) {
                $list_args['exclude'] .= ',';
            } else {
                $list_args['exclude'] = '';
            }
            $list_args['exclude'] .= get_option('page_on_front');
        }
    }

    $list_args['echo'] = false;
    $list_args['title_li'] = '';
    $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

    if ( $menu ) {
        $menu = '<ul class="' . esc_attr($args['menu_class']) . '">' . $menu . '</ul>';
    }

    if ( $args['container'] && in_array( $args['container'], array( 'nav', 'div' ) ) ) {
        $tag = $args['container'];
        $menu = '<' . $tag . ' class="' . esc_attr($args['menu_class']) . '">' . $menu . "</' . $tag . '>\n";
    }

    $menu = apply_filters( 'wp_page_menu', $menu, $args );

    if ( $args['echo'] )
        echo $menu;
    else
        return $menu;
}

function impulse_press_set_title( $title, $sep, $seplocation ) {
    $sitename = get_bloginfo( 'name' );
    if ( preg_match( "/(\\s|^)$sitename(\\s|$)/", $title ) === 0 ) {
        if ( $seplocation == 'right' )
            return $title . '  '. $sitename;
        else
            return $sitename . '  ' .  $title;
    }
    return $title;
}

add_filter('wp_title', 'impulse_press_set_title', 30, 3);




// Initialize the metabox class
function impulse_press_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once(  impulse_press_directory() .'/includes/meta-boxes/init.php' );
    }
}




