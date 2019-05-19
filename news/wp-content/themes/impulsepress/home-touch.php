<?php
/**
 * Home Template
 *
 * Template Name:  Home Touch
 *
 * @file           home-touch.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 *
 *
 * In this template example, one can use the cool features of skroll, and make parallax scroll
 * work pretty well on touch devices, in particular iOS
 *
 * The template reads the background images from the post's custom meta fields
 */

get_header(); ?>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/skrollr.css"/>

<style type="text/css">

    .home-div1 {
        background-image: url(<?php echo get_post_meta($post->ID, 'home-div1-background', true); ?>);
        min-height: 500px;
    }

    .home-div2 {
        background-image: url(<?php echo get_post_meta($post->ID, 'home-div2-background', true); ?>);
        background-color: #ffffff;
        width: 100%
    }

    .home-div3 {
        background-image: url(<?php echo get_post_meta($post->ID, 'home-div3-background', true); ?>);
        min-height: 300px;
        background-size: 100% auto;
        margin-top: 100px;
        margin-bottom: 100px;
    }

    .home-div4 {
        background-image: url(<?php echo get_post_meta($post->ID, 'home-div4-background', true); ?>);
        background-size: 100% auto;
        padding-top: 100px;
        padding-bottom: 100px;
    }

    .home-div5 {
        background-image: url(<?php echo get_post_meta($post->ID, 'home-div5-background', true); ?>);
        min-height: 300px;
    }

    .slide {
        width: 100%;

    }

    .back {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center center;
    }

     .home-gallery {
        padding-top: 100px;
        padding-bottom: 100px;
    }



</style>

<div id="home-div1" class="home-div1 back"
    data-0="top: 0%; opacity: 1.0;"
    data-500="top: 0%; opacity: 1.0;"
    data-1000="top: -100%; opacity: 0.0;"
    style="z-index: 1;">

  <?php if (!dynamic_sidebar('hero-parallax')) : ?>
        <div class="widget-title-home"><h3><?php _e('Hero Parallax', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Parallax.', 'impulse-press'); ?></div>
    <?php endif;  ?>

</div>

<div id="home-div2" class="home-div2"
    data-500="top: 100%; opacity: 1.0;"
    data-1000="top: 0%; opacity: 1.0;"
    data-1500="top: -100%; opacity: 1.0;"
    style="z-index: 2;">

    <div class="container home-widgets">

              <!-- Three columns of text below the carousel -->
         <div class="row">

           <div class="col-xs-4">
                <?php if (!dynamic_sidebar('main-1')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Main One', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main One.', 'impulse-press'); ?></div>
                <?php endif;  ?>
           </div><!-- /.col-xs-4 -->

           <div class="col-xs-4">
             <?php if (!dynamic_sidebar('main-2')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Main Two', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main Two.', 'impulse-press'); ?></div>
                <?php endif;  ?>
           </div><!-- /.col-xs-4 -->


           <div class="col-xs-4">
             <?php if (!dynamic_sidebar('main-3')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Main Three', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main Three.', 'impulse-press'); ?></div>
                <?php endif;  ?>
           </div><!-- /.col-xs-4 -->
         </div><!-- /.row -->

    </div>
</div>



<div id="home-div3" class="home-div3 back"
     data-1000="top: 100%; opacity: 1.0;"
     data-1500="top: 0%; opacity: 1.0;"
     data-2000="top: -100%; opacity: 1.0;"
     style="z-index: 4;">

    <div class="container home-widgets">
        <div class="row">
            <div class="col-xs-12 sections">
                 <?php if (!dynamic_sidebar('sections')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Sections', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Sections.', 'impulse-press'); ?></div>
                <?php endif;  ?>
            </div>
            <!-- end of .span3 -->
        </div>
        <div class="row">
            <div class="col-xs-4">
                 <?php if (!dynamic_sidebar('section1')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Section 1', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Section 1.', 'impulse-press'); ?></div>
                <?php endif;  ?>

            </div>
            <!-- end of .span4 -->

            <div class="col-xs-4">
                 <?php if (!dynamic_sidebar('section2')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Section 2', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Section 2.', 'impulse-press'); ?></div>
                <?php endif;  ?>


            </div>
            <!-- end of .span4 -->

            <div class="col-xs-4">
                 <?php if (!dynamic_sidebar('section 3')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Services', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Section 3.', 'impulse-press'); ?></div>
                <?php endif;  ?>

            </div>
            <!-- end of .span4 -->
        </div>
    </div>


</div>


<div id="home-div4" class="home-div4 back"
    data-1500="top: 100%; opacity: 1.0;"
    data-2000="top: 0%; opacity: 1.0;"
    data-2500="top: -100%; opacity: 1.0;"
    style="z-index: 5;">

</div>


<div id="progress" data-0="width:0%;background:hsla(0, 0%, 0%, 0.5);" data-end="width:100%;background:hsla(0, 0%, 0%, 0.5);"></div>


<script src="<?php echo impulse_press_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script src="<?php echo impulse_press_directory_uri(); ?>/js/skrollr.min.js"></script>
<script src="<?php echo impulse_press_directory_uri(); ?>/js/parallax-touch.js"></script>

<?php get_footer(); ?>