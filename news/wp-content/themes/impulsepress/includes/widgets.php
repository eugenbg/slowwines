<?php

/**
 *  Sidebar Widgets
 */
function impulse_press_widgets_init()
{


    /* The Hero Jumbotron */
    register_sidebar(array(
        'name' => __('Hero Landing', 'impulse-press'),
        'description' => __('Hero Landing', 'impulse-press'),
        'id' => 'hero-landing',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
        'after_widget' => '</div>'
    ));

         /* The Hero Jumbotron */
      register_sidebar(array(
                          'name' => __('Hero Jumbotron', 'impulse-press'),
                          'description' => __('Hero Jumbotron', 'impulse-press'),
                          'id' => 'hero-jumbotron',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

	/* The Hero Slider */
      register_sidebar(array(
                          'name' => __('Hero Slider', 'impulse-press'),
                          'description' => __('Hero Slider', 'impulse-press'),
                          'id' => 'hero-slider',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

      /* The Hero Parallax */
      register_sidebar(array(
                          'name' => __('Hero Parallax', 'impulse-press'),
                          'description' => __('Hero Parallax', 'impulse-press'),
                          'id' => 'hero-parallax',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));	


    /* The 3 widgets for the main page, below the heroe unit */
    register_sidebar(array(
                          'name' => __('Main One', 'impulse-press'),
                          'description' => __('Main One', 'impulse-press'),
                          'id' => 'main-1',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

    register_sidebar(array(
                          'name' => __('Main Two', 'impulse-press'),
                          'description' => __('Main Two', 'impulse-press'),
                          'id' => 'main-2',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

    register_sidebar(array(
                          'name' => __('Main Three', 'impulse-press'),
                          'description' => __('Main Three', 'impulse-press'),
                          'id' => 'main-3',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));


    /* left and right sidebar */
    register_sidebar(array(
                          'name' => 'Sidebar Left',
                          'description' => 'Sidebar Left',
                          'id' => 'sidebar-left',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

	register_sidebar(array(
                          'name' => 'Sidebar Right' ,
                          'description' => 'Sidebar Right',
                          'id' => 'sidebar-right',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));


           


      /* The Home Gallery Unit */
      register_sidebar(array(
                          'name' => __('Home Gallery', 'impulse-press'),
                          'description' => __('Home Gallery', 'impulse-press'),
                          'id' => 'hero-gallery',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

         /* The 3 featurette widgets */
    register_sidebar(array(
                          'name' => __('Featurette One', 'impulse-press'),
                          'description' => __('Featurette One', 'impulse-press'),
                          'id' => 'featurette-1',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

    register_sidebar(array(
                          'name' => __('Featurette Two', 'impulse-press'),
                          'description' => __('Featurette Two', 'impulse-press'),
                          'id' => 'featurette-2',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));



    register_sidebar(array(
                          'name' => __('Featurette Three', 'impulse-press'),
                          'description' => __('Featurette Three', 'impulse-press'),
                          'id' => 'featurette-3',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));


    register_sidebar(array(
                          'name' => __('Sections', 'impulse-press'),
                          'description' => __('sections', 'impulse-press'),
                          'id' => 'services',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

        register_sidebar(array(
                          'name' => __('Section 1', 'impulse-press'),
                          'description' => __('Section 1', 'impulse-press'),
                          'id' => 'section1',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

        register_sidebar(array(
                          'name' => __('Section 2 ', 'impulse-press'),
                          'description' => __('Section 2', 'impulse-press'),
                          'id' => 'section2',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

        register_sidebar(array(
                          'name' => __('Section 3', 'impulse-press'),
                          'description' => __('Section 3', 'impulse-press'),
                          'id' => 'section3',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

}
