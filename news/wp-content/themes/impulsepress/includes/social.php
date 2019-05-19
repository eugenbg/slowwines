<?php
// Create Social Array
if ( !function_exists('get_social_links') ) {
	
	function get_social_links() {
				
		$social_icons = array('twitter','tumblr','github','instagram','pinterest','dribbble','flickr','google-plus','facebook','linkedin','youtube','rss');		
			
		return apply_filters('get_social_links', $social_icons);
				
	}
	
}

if ( !function_exists('impulse_press_opt_display_social_links') ) {
	function impulse_press_opt_display_social_links() {
		$bi_social_links = get_social_links();
		$social_style = ( impulse_press_options('social_style') !== 'one' ) ? NULL : '-sign';
		
		if ( !$bi_social_links ) return;
		
		$output = '';
				foreach ( $bi_social_links as $social_link ) {
					if ( impulse_press_options($social_link) ) {
						$output .= '<a href="'. impulse_press_options($social_link) .'" title="'. $social_link .'" target="_blank">
						<i class="fa fa-2x fa-'.$social_link.''.$social_style.'"></i></a>';
					}
				}


		echo apply_filters('display_social_links', $output);
	}
	
}