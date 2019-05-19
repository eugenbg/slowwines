<?php
/**
 * Home Template Landing
 *
 * Template Name:  Home Page Landing 
 *
 * @file           home-landing.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */

get_header(); ?>

<script type="text/javascript">
	$().ready(function(){	
		
		// Add handler on 'Scroll down to learn more' link
		$().ready(function(){
			$(".content-scroll .scroll-button").click(function(e){
				e.preventDefault();
				$("body,html").animate({scrollTop: $(window).height()});
			});
		});		
		
	});
</script>
<style type="text/css">
    .back-img-fullscreen {
        background: url(<?php echo impulse_page_options($post->ID, 'ip_home_landing_background');?>) no-repeat scroll center center / cover rgba(0, 0, 0, 0);
    }
</style>

<div class="back-img-fullscreen"></div>

<div class="covering">
    <div class="slogan-center">
        <?php if (!dynamic_sidebar('hero-landing')) : ?>
            <div class="widget-title-home"><h3><?php _e('Hero Landing', 'impulse-press'); ?></h3></div>
            <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Landing.', 'impulse-press'); ?></div>
        <?php endif;  ?>
    </div>
</div>


<div class="content-scroll">
<a class="scroll-button" href="#"><?php _e('Scroll down <i class="fa fa-angle-down fa-2x"></i> to discover', 'impulse-press'); ?></a>
    <div class="container">
    
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

<div class="footer-fullscreen">
<div class="container">

    <div class="row">
          <div class="col-lg-6">
            <?php if (has_nav_menu('footer-menu')) { ?>
            <?php wp_nav_menu(array(
              'container'       => '',
              'depth'      => 1,
              'menu_class'      => 'footer-menu',
              'theme_location'  => 'footer-menu')
            );
            ?>
            <?php } ?>

          </div><!-- end of col-lg-6 -->

          <div class="col-lg-6">
              <div class="social-icons">
                <?php
                    if( impulse_press_options('enable_social_footer','1') == '1')
                        impulse_press_opt_display_social_links();
                ?>
             </div><!-- end of col-lg-6 -->
      </div>
       </div><!-- end of row -->

    <div class="row">

            <div class="col-lg-5 copyright">
                <?php if( impulse_press_options('custom_copyright') ) : ?>
                     <?php echo impulse_press_options('custom_copyright','Copyright 2013 | Two Impulse'); ?>
                <?php else : ?>
                      &copy; <?php _e('Copyright', 'impulse-press'); ?> <?php echo date('Y'); ?><a href="<?php echo esc_url(__('http://www.twoimpulse.com/products/impulse-press','impulse-press')); ?>" title="<?php esc_attr_e('ImpulsePress', 'impulse-press'); ?>">
                          <a href="<?php echo esc_url(__('http://twoimpulse.com','impulse-press')); ?>" title="<?php esc_attr_e('Two Impulse', 'impulse-press'); ?>">
                          <?php printf('Two Impulse'); ?></a>

                <?php endif; ?>
            </div> <!-- end copyright -->


            <div class="col-lg-2 scroll-top">
                <a href="#wrap" class="scroll" title="<?php esc_attr_e( 'scroll to top', 'impulse-press' ); ?>"><?php _e( '<i class="fa fa-chevron-up"></i>', 'impulse-press' ); ?></a>
            </div>


            <div class="col-lg-5 powered">
                <?php if( impulse_press_options('custom_poweredby') ) : ?>
                        <?php echo impulse_press_options('custom_poweredby'); ?>
                  <?php else : ?>
                    <?php _e('Powered by <a href="http://www.twoimpulse.com/products/impulse-press" target="_blank" rel="home">Impulse Press</a>', 'impulse-press'); ?>
                  <?php endif; ?>

            </div><!-- end .powered -->
    </div><!-- end row -->
</div>
</div>
     
</div>




<?php wp_footer(); ?>
</body>
</html>
