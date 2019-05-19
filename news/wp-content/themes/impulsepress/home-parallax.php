<?php
/**
 * Home Template
 *
 * Template Name:  Home Parallax
 *
 * @file           home-parallax.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 *
 *
 * In this home page template, one can assign a parallax effect on the divs background,
 * by adding it the class "parallax" and assigning a value to the "data-speed" property
 *
 * The template reads the background images from the post's custom meta fields
 */

get_header(); ?>



<style type="text/css">

    .carousel-caption {
        position: relative;
        padding-top: 0;
    }

    .home-div1 {
        background-image:url(<?php echo impulse_page_options($post->ID, 'home_div1_background');?>);
    }

    .home-div2 {
        background-image:url(<?php echo impulse_page_options($post->ID, 'home_div2_background'); ?>);
    }
    .home-div3 {
        background-image:url(<?php echo impulse_page_options($post->ID, 'home_div3_background'); ?>);
    }

     .home-gallery {
        padding-top: 100px;
        padding-bottom: 100px;
    }

    .home-div4 {
        background-image:url(<?php echo impulse_page_options($post->ID, 'home_div4_background'); ?>);
    }
    .home-div5 {
        background-image:url(<?php echo impulse_page_options($post->ID, 'home_div5_background'); ?>);

    }



</style>


<div id="home-div1" class="home-div1 <?php echo (impulse_page_options($post->ID, 'home_div1_enable_parallax') =='on')  ? 'parallax' : '';?>" data-speed="<?php echo impulse_page_options($post->ID, 'home_div1_parallax_speed')?>">
  <?php if (!dynamic_sidebar('hero-parallax')) : ?>
        <div class="widget-title-home"><h3><?php _e('Hero Parallax', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Parallax.', 'impulse-press'); ?></div>
    <?php endif;  ?>
</div>

<div id="home-div2" class="home-div2 <?php echo (impulse_page_options($post->ID, 'home_div2_enable_parallax') =='on')  ? 'parallax' : '';?>" data-speed="<?php echo impulse_page_options($post->ID, 'home_div2_parallax_speed')?>">
    <div class="container home-widgets">

              <!-- Three columns of text below the carousel -->
         <div class="row">

           <div class="col-lg-4">
                <?php if (!dynamic_sidebar('main-1')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Main One', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main One.', 'impulse-press'); ?></div>
                <?php endif;  ?>
           </div><!-- /.col-xs-4 -->

           <div class="col-lg-4">
             <?php if (!dynamic_sidebar('main-2')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Main Two', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main Two.', 'impulse-press'); ?></div>
                <?php endif;  ?>
           </div><!-- /.col-xs-4 -->


           <div class="col-lg-4">
             <?php if (!dynamic_sidebar('main-3')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Main Three', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main Three.', 'impulse-press'); ?></div>
                <?php endif;  ?>
           </div><!-- /.col-xs-4 -->
         </div><!-- /.row -->

    </div>
</div>





<div id="home-gallery" class="home-gallery">

          <?php if (!dynamic_sidebar('home-gallery')) : ?>
                  <div class="widget-title-home"><h3><?php _e('Home Gallery', 'impulse-press'); ?></h3></div>
                  <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Home Gallery.', 'impulse-press'); ?></div>
           <?php endif;  ?>

</div>

<div id="home-div3" class="home-div3 <?php echo (impulse_page_options($post->ID, 'home_div3_enable_parallax') =='on')  ? 'parallax' : '';?>" data-speed="<?php echo impulse_page_options($post->ID, 'home_div3_parallax_speed')?>">
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
            <div class="col-lg-4">
                 <?php if (!dynamic_sidebar('section1')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Section 1', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Section 1.', 'impulse-press'); ?></div>
                <?php endif;  ?>

            </div>
            <!-- end of .span4 -->

            <div class="col-lg-4">
                 <?php if (!dynamic_sidebar('section2')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Section 2', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Section 2.', 'impulse-press'); ?></div>
                <?php endif;  ?>


            </div>
            <!-- end of .span4 -->

            <div class="col-lg-4">
                 <?php if (!dynamic_sidebar('section 3')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Services', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Section 3.', 'impulse-press'); ?></div>
                <?php endif;  ?>

            </div>
            <!-- end of .span4 -->
        </div>
    </div>

</div>


<div id="home-div4" class="home-div4 <?php echo (impulse_page_options($post->ID, 'home_div4_enable_parallax') =='on')  ? 'parallax' : '';?>" data-speed="<?php echo impulse_page_options($post->ID, 'home_div4_parallax_speed')?>">
    <div class="container home-widgets">
        <?php if (!dynamic_sidebar('featurette-1')) : ?>
        <div class="widget-title-home"><h3><?php _e('Featurette One', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette One.', 'impulse-press'); ?></div>
        <?php endif;  ?>
    </div>
</div>


<div id="home-div5" class="home-div5 <?php echo (impulse_page_options($post->ID, 'home_div5_enable_parallax') =='on')  ? 'parallax' : '';?>" data-speed="<?php echo impulse_page_options($post->ID, 'home_div5_parallax_speed')?>">
     <div class="container home-widgets">
        <?php if (!dynamic_sidebar('featurette-2')) : ?>
        <div class="widget-title-home"><h3><?php _e('Featurette Two', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette Two.', 'impulse-press'); ?></div>
        <?php endif;  ?>
    </div>
</div>


<script src="<?php echo impulse_press_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script src="<?php echo impulse_press_directory_uri(); ?>/js/waypoints.min.js"></script>
<script src="<?php echo impulse_press_directory_uri(); ?>/js/animate-waypoints.js"></script>
<script src="<?php echo impulse_press_directory_uri(); ?>/js/parallax.js"></script>

<?php get_footer(); ?>