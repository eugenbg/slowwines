<?php
/**
 * The footer template file
 *
 * @file           footer.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */
?>
 </div> <!--Wrap-->

<div class="footer">
  <div class="container">
    <div id="footer-wrapper">
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

        <div class="col-lg-4 copyright">
            <?php if( impulse_press_options('custom_copyright') ) : ?>
                 <?php echo impulse_press_options('custom_copyright','Copyright 2013 | Two Impulse'); ?>
            <?php else : ?>
                  &copy; <?php _e('Copyright', 'impulse-press'); ?> <?php echo date('Y'); ?><a href="<?php echo esc_url(__('http://www.twoimpulse.com/products/impulse-press','impulse-press')); ?>" title="<?php esc_attr_e('ImpulsePress', 'impulse-press'); ?>">
                      <a href="<?php echo esc_url(__('http://twoimpulse.com','impulse-press')); ?>" title="<?php esc_attr_e('Two Impulse', 'impulse-press'); ?>">
                      <?php printf('Two Impulse'); ?></a>

            <?php endif; ?>
        </div> <!-- end copyright -->


        <div class="col-lg-4 scroll-top">
            <a href="#wrap" class="scroll" title="<?php esc_attr_e( 'scroll to top', 'impulse-press' ); ?>"><?php _e( '<i class="fa fa-chevron-up"></i>', 'impulse-press' ); ?></a>
        </div>


        <div class="col-lg-4 powered">
            <?php if( impulse_press_options('custom_poweredby') ) : ?>
                    <?php echo impulse_press_options('custom_poweredby'); ?>
              <?php else : ?>
                 Powered by <a href="http://www.twoimpulse.com/products/impulse-press" target="_blank" rel="home">Impulse Press</a>
              <?php endif; ?>

        </div><!-- end .powered -->
    </div><!-- end row -->
    </div><!-- end #footer-wrapper -->
  </div> <!-- end container -->
</div><!-- end #footer -->
<?php echo impulse_press_options('tracking_footer'); ?>
<?php wp_footer(); ?>
</body>
</html>