<?php
/**
 * Home Slider Template
 *
 * Template Name:  Home Slider
 *
 * @file           home-slider.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.2.5
 */

get_header(); ?>
<div class="container-carousel">
<?php if (!dynamic_sidebar('hero-slider')) : ?>
    <div class="widget-title-home"><h3><?php _e('Hero Slider', 'impulse-press'); ?></h3></div>
    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Slider.', 'impulse-press'); ?></div>
<?php endif;  ?>
</div>

<div class="container marketing">

     <!-- Three columns of text below the carousel -->
     <div class="row">
	 	<div class="col-lg-12">
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
           </div><!-- /.col-lg-4 -->
     	</div><!-- /.col-lg-12 -->
     </div><!-- /.row -->
</div><!--end Container  marketing-->

<div class="container">

     <!-- START THE FEATURETTES -->
     <div class="row">
	 	<div class="col-lg-12">
    <?php if (!dynamic_sidebar('featurette-1')) : ?>
        <div class="widget-title-home"><h3><?php _e('Featurette One', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette One.', 'impulse-press'); ?></div>
    <?php endif;  ?>

    <?php if (!dynamic_sidebar('featurette-2')) : ?>
        <div class="widget-title-home"><h3><?php _e('Featurette Two', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette Two.', 'impulse-press'); ?></div>
    <?php endif;  ?>

    <?php if (!dynamic_sidebar('featurette-3')) : ?>
        <div class="widget-title-home"><h3><?php _e('Featurette Three', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette Three.', 'impulse-press'); ?></div>
    <?php endif;  ?>
    	</div><!-- /.col-lg-12 -->
    </div><!-- /.row -->


     <!-- /END THE FEATURETTES -->
 </div><!--end Container-->

<?php get_footer(); ?>