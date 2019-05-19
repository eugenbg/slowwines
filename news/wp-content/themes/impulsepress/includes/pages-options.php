<?php


/*
 * Hides post editor for certain page templates
 */

function impulse_press_hide_editor() {
    // Get the Post ID.
    if ( isset ( $_GET['post'] ) )
        $post_id = $_GET['post'];
    else if ( isset ( $_POST['post_ID'] ) )
        $post_id = $_POST['post_ID'];

    if( !isset ( $post_id ) || empty ( $post_id ) )
        return;

    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    // hide the edit part for home page post types
    if($template_file == 'home-simple.php'){

        remove_post_type_support('page', 'editor');
    }

    // hide the edit part for home page post types
    if($template_file == 'home-parallax.php'){
        remove_post_type_support('page', 'editor');
    }

    if($template_file == 'home-touch.php'){
        remove_post_type_support('page', 'editor');
    }

    if($template_file == 'home-large.php'){
        remove_post_type_support('page', 'editor');
    }

    if($template_file == 'home-landing.php'){
        remove_post_type_support('page', 'editor');
    }

    if($template_file == 'portfolio.php'){
        remove_post_type_support('page', 'editor');
    }

}

/*
 *  Individual page options
 */
function impulse_press_sample_metaboxes( $meta_boxes ) {
    $prefix = 'ip_'; // Prefix for all fields


    /* Home Landing Page template options */
    $meta_boxes['impulse_press_home_landing_options'] = array(
        'id' => 'impulse_press_home_landing_options',
        'title' => 'Home Landing Template Options',
        'pages' => array('page'), // post type
        'show_on' => array( 'key' => 'page-template', 'value' => 'home-landing.php' ),
        'context' => 'normal', //  'normal', 'advanced', or 'side'
        'priority' => 'high',  //  'high', 'core', 'default' or 'low'
        'show_names' => true, // Show field names on the left
        'fields' => array(

            array(
                'name' => __('','impulse-press'),
                'desc' =>  __('The Home Landing page template contains a background picture and 4 widgets. <br>Also it doesn\'t have a content editing are because the page does not display free content. The div on the top is the Slogan widget and the other three are main 1, 2 and 3.','impulse-press'),
                'type' => 'title',
                'id' => $prefix . 'home_landing_title'
            ),

            array(
                'name' =>  __('Background Picture','impulse-press'),
                'desc' => __('Select and upload a picture or type a url.','impulse-press'),
                'id' => $prefix . 'home_landing_background',
                'type' => 'file',
                'save_id' => false, // save ID using true
                'allow' => array('url', 'attachment') // limit to just attachments with array( 'attachment' )
            ),

        ),
    );

    /* Home Parallax Page template options */
    $div_name = 'DIV X';
    $div_description = 'This div includes the Hero Parallax widget';
    $background_option_id = 'home_div1_background';

    $meta_boxes['impulse_press_home_parallax_options'] = array(
        'id' => 'impulse_press_home_parallax_options',
        'title' => __('Home Parallax Template Options','impulse-press'),
        'pages' => array('page'), // post type
        'show_on' => array( 'key' => 'page-template', 'value' => 'home-parallax.php' ),
        'context' => 'normal', //  'normal', 'advanced', or 'side'
        'priority' => 'high',  //  'high', 'core', 'default' or 'low'
        'show_names' => true, // Show field names on the left
        'fields' => array(

            array(
                'name' => __('','impulse-press'),
                'desc' => __('The Home Parallax page template contains 5 divs. For each div, it allows you to define a background picture and a velocity for the parallax effect. <br>It doesn\'t have a content editing area because the page does not display free content.','impulse-press'),
                'type' => 'title',
                'id' => $prefix . 'home_parallax_title'
            ),

            /* div 1*/
            impulse_press_cmb_option_title(__('DIV 1','impulse-press'), __('This div includes the Hero Parallax widget','impulse-press'), 'home_div1_title'),
            impulse_press_cmb_option_background_picture('home_div1_background'),
            impulse_press_cmb_option_enable_parallax('home_div1_enable_parallax'),
            impulse_press_cmb_option_parallax_speed('home_div1_parallax_speed'),

            /* div 2*/
            impulse_press_cmb_option_title(__('DIV 2','impulse-press'), __('This div includes three widgets horizontally: Main One, Main Two and Main Three','impulse-press'), 'home_div2_title'),
            impulse_press_cmb_option_background_picture('home_div2_background'),
            impulse_press_cmb_option_enable_parallax('home_div2_enable_parallax'),
            impulse_press_cmb_option_parallax_speed('home_div2_parallax_speed'),

            /* div 3*/
            impulse_press_cmb_option_title(__('DIV 3','impulse-press'), __('This div includes four  widgets: Sections (on top) and below it has the widgets Section One, Section Two and Section Three side by side','impulse-press'), 'home_div3_title'),
            impulse_press_cmb_option_background_picture('home_div3_background'),
            impulse_press_cmb_option_enable_parallax('home_div3_enable_parallax'),
            impulse_press_cmb_option_parallax_speed('home_div3_parallax_speed'),

            /* div 4*/
            impulse_press_cmb_option_title(__('DIV 4','impulse-press'), __('This div includes one widget: Featurette One', 'impulse-press'),'home_div4_title'),
            impulse_press_cmb_option_background_picture('home_div4_background'),
            impulse_press_cmb_option_enable_parallax('home_div4_enable_parallax'),
            impulse_press_cmb_option_parallax_speed('home_div4_parallax_speed'),

            /* div 5*/
            impulse_press_cmb_option_title(__('DIV 5','impulse-press'), __('This div includes one widget: Featurette One','impulse-press'), 'home_div5_title'),
            impulse_press_cmb_option_background_picture('home_div5_background'),
            impulse_press_cmb_option_enable_parallax('home_div5_enable_parallax'),
            impulse_press_cmb_option_parallax_speed('home_div5_parallax_speed')


        ),
    );

    /* Portfolio Gallery Page options */
    $meta_boxes['impulse_press_portfolio_gallery_options'] = array(
        'id' => 'impulse_press_portfolio_gallery_options',
        'title' => 'Portfolio Gallery Page options',
        'pages' => array('page'), // post type
        'show_on' => array( 'key' => 'page-template', 'value' => 'portfolio.php' ),
        'context' => 'normal', //  'normal', 'advanced', or 'side'
        'priority' => 'high',  //  'high', 'core', 'default' or 'low'
        'show_names' => true, // Show field names on the left
        'fields' => array(

            array(
                'name' => __('','impulse-press'),
                'desc' =>  __('The Portfolio gallery page template display an Isotope gallery of the project post. <br>It doesn\'t have a content editing area because the page does not display free content. Below you can choose the number of columns of your gallery','impulse-press'),
                'type' => 'title',
                'id' => $prefix . 'home_landing_title'
            ),


            array(
                'name'    => __('Number of Columns','impulse-press'),
                'id'      => $prefix . 'portfolio_num_cols',
                'type'    => 'radio',
                'options' => array(
                    '2' => __( 'Two', 'impulse-press' ),
                    '3'   => __( 'Three', 'impulse-press' ),
                    '4'     => __( 'Four', 'impulse-press' ),
                ),
            ),

        ),
    );

    // general options that apply to all pages
    $meta_boxes['impulse_press_page_options'] = array(
        'id' => 'impulse_press_page_options',
        'title' => __('General Page Options','impulse-press'),
        'pages' => array('page','project','post'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Show Breadcrumbs','impulse-press'),
                'desc' => __('Show Breadcrumbs in this page?','impulse-press'),
                'id' => $prefix . 'enable_breadcrumbs',
                'type' => 'checkbox'
            ),

            array(
                'name' => __('Show Title','impulse-press'),
                'desc' => __('Show Title in this page?','impulse-press'),
                'id' => $prefix . 'enable_title',
                'type' => 'checkbox'
            ),
        ),
    );

    return $meta_boxes;
}

function impulse_press_cmb_option_parallax_speed($id)
{
    return array(
        'name' => __('Parallax Speed','impulse-press'),
        'desc' => __('The speed of the parallax effect for this picture (integer)','impulse-press'),
        'std' => '0',
        'id' => $id,
        'type' => 'text_small'
    );
}

function impulse_press_cmb_option_enable_parallax($id)
{
    return array(
        'name' => __('Enable Parallax','impulse-press'),
        'desc' => __('Enable Parallax effect for this div','impulse-press'),
        'id' => $id,
        'type' => 'checkbox'
    );
}

function impulse_press_cmb_option_background_picture($id)
{
    return array(
        'name' => __('Background Picture','impulse-press'),
        'desc' => __('Select or upload a picture.','impulse-press'),
        'id' => $id,
        'type' => 'file',
        'save_id' => false, // save ID using true
        'allow' => array('url', 'attachment') // limit to just attachments with array( 'attachment' )
    );
}

function impulse_press_cmb_option_title($div_name, $div_description, $id)
{
    return array(
        'name' => $div_name,
        'desc' => $div_description,
        'type' => 'title',
        'id' => $id
    );
}