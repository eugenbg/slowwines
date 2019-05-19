<?php
/**
* Tracking
*/
if ( !function_exists('bi_header_tracking') ) {
	add_action('wp_head', 'bi_header_tracking');
	function bi_header_tracking() {
		if ( impulse_press_options('tracking_header') ) {
			echo impulse_press_options('tracking_header');
		}
	}
}

if ( !function_exists('bi_footer_tracking') ) {
	add_action('wp_footer', 'bi_footer_tracking');
	function bi_footer_tracking() {
		if ( impulse_press_options('tracking_footer') ) {
			echo impulse_press_options('tracking_footer');
		}
	}
}