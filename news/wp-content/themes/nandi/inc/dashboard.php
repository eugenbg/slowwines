<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'nandi_create_menu' ) ) {
	add_action( 'admin_menu', 'nandi_create_menu' );
	/**
	 * Adds our "Nandi" dashboard menu item
	 *
	 */
	function nandi_create_menu() {
		$nandi_page = add_theme_page( 'Nandi', 'Nandi', apply_filters( 'nandi_dashboard_page_capability', 'edit_theme_options' ), 'nandi-options', 'nandi_settings_page' );
		add_action( "admin_print_styles-$nandi_page", 'nandi_options_styles' );
	}
}

if ( ! function_exists( 'nandi_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Nandi dashboard page
	 *
	 */
	function nandi_options_styles() {
		wp_enqueue_style( 'nandi-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), NANDI_VERSION );
	}
}

if ( ! function_exists( 'nandi_settings_page' ) ) {
	/**
	 * Builds the content of our Nandi dashboard page
	 *
	 */
	function nandi_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="nandi-masthead clearfix">
					<div class="nandi-container">
						<div class="nandi-title">
							<a href="<?php echo esc_url(NANDI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Nandi', 'nandi' ); ?></a> <span class="nandi-version"><?php echo NANDI_VERSION; ?></span>
						</div>
						<div class="nandi-masthead-links">
							<?php if ( ! defined( 'NANDI_PREMIUM_VERSION' ) ) : ?>
								<a class="nandi-masthead-links-bold" href="<?php echo esc_url(NANDI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'nandi' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(NANDI_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'nandi' ); ?></a>
                            <a href="<?php echo esc_url(NANDI_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'nandi' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * nandi_dashboard_after_header hook.
				 *
				 */
				 do_action( 'nandi_dashboard_after_header' );
				 ?>

				<div class="nandi-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * nandi_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'nandi_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'nandi-settings-group' ); ?>
									<?php do_settings_sections( 'nandi-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="nandi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'nandi' )
										);
										?>
									</div>

									<?php
									/**
									 * nandi_inside_options_form hook.
									 *
									 */
									 do_action( 'nandi_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => NANDI_THEME_URL,
									),
									'Blog' => array(
											'url' => NANDI_THEME_URL,
									),
									'Colors' => array(
											'url' => NANDI_THEME_URL,
									),
									'Copyright' => array(
											'url' => NANDI_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => NANDI_THEME_URL,
									),
									'Demo Import' => array(
											'url' => NANDI_THEME_URL,
									),
									'Hooks' => array(
											'url' => NANDI_THEME_URL,
									),
									'Import / Export' => array(
											'url' => NANDI_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => NANDI_THEME_URL,
									),
									'Page Header' => array(
											'url' => NANDI_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => NANDI_THEME_URL,
									),
									'Spacing' => array(
											'url' => NANDI_THEME_URL,
									),
									'Typography' => array(
											'url' => NANDI_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => NANDI_THEME_URL,
									)
								);

								if ( ! defined( 'NANDI_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox nandi-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'nandi' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated nandi-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'More info', 'nandi' ); ?></a>
													</div>
												</div>
												<div class="nandi-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * nandi_options_items hook.
								 *
								 */
								do_action( 'nandi_options_items' );
								?>
							</div>

							<div class="nandi-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="nandi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'nandi' )
									);
									?>
								</div>

								<?php
								/**
								 * nandi_admin_right_panel hook.
								 *
								 */
								 do_action( 'nandi_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Nandi documentation', 'nandi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'nandi' ); ?></p>
                                    <a href="<?php echo esc_url(NANDI_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Nandi documentation', 'nandi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'nandi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'nandi' ); ?></p>
                                    <a href="<?php echo esc_url(NANDI_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'nandi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'nandi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Nandi theme, show it to the world with Your review. Your feedback helps a lot.', 'nandi' ); ?></p>
                                    <a href="<?php echo esc_url(NANDI_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'nandi' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'nandi_admin_errors' ) ) {
	add_action( 'admin_notices', 'nandi_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function nandi_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_nandi-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'nandi-notices', 'true', esc_html__( 'Settings saved.', 'nandi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'nandi-notices', 'imported', esc_html__( 'Import successful.', 'nandi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'nandi-notices', 'reset', esc_html__( 'Settings removed.', 'nandi' ), 'updated' );
		}

		settings_errors( 'nandi-notices' );
	}
}
