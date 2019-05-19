<?php

add_action('login_head', 'style_login_logo');

if ( ! function_exists('style_login_logo') ) :

	function style_login_logo() {

		if( impulse_press_options('custom_login_logo') !== '' ) {
			$custom_login_logo_css = '';
			$custom_login_logo_css .= '<style type="text/css">';
			$custom_login_logo_css .= 'h1 a {';
			$custom_login_logo_css .= 'background-image:url('. impulse_press_options('custom_login_logo') .') !important;width: auto !important;background-size: auto !important;';
			if(impulse_press_options('custom_login_logo_height')) {
				$custom_login_logo_css .= 'height: '.impulse_press_options('custom_login_logo_height').' !important;';
			}
			$custom_login_logo_css .= '}</style>';

			echo $custom_login_logo_css;
		}
	}

endif;