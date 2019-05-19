<?php
/**
Plugin Name: Social Master
Plugin URI: https://wordpress.techgasp.com/social-master/
Version: 5.0.10
Author: TechGasp
Author URI: https://wordpress.techgasp.com
Text Domain: social-master
Description: Social Master is a light weight and shiny clean code wordpress plugin that you need to boost your wordpress social engagement, attracting new users, visits or sales. Social Master replaces a bunch of extensions keeping your wordpress website code clean and with fast page loading times because it makes NO use of Javascipt or Ajax. Buil-in html5 and iframe, Social Master combines all major social networks.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('social_master')) :
///////DEFINE///////
define( 'SOCIAL_MASTER_VERSION', '5.0.10' );
define( 'SOCIAL_MASTER_NAME', 'Social Master' );

class social_master{
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function social_master_links( $links, $file ) {
if ( $file == plugin_basename( dirname(__FILE__).'/social-master.php' ) ) {
		if( is_network_admin() ){
		$techgasp_plugin_url = network_admin_url( 'admin.php?page=social-master' );
		}
		else {
		$techgasp_plugin_url = admin_url( 'admin.php?page=social-master' );
		}
	$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}

//END CLASS
}
add_filter('the_content', array('social_master', 'content_with_quote'));
add_filter( 'plugin_action_links', array('social_master', 'social_master_links'), 10, 2 );
endif;

// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/social-master-admin.php');
// HOOK ADMIN SETTINGS PAGE
require_once( dirname( __FILE__ ) . '/includes/social-master-admin-settings-wide.php');
// HOOK ADMIN ADDONS
require_once( dirname( __FILE__ ) . '/includes/social-master-admin-addons.php');
// HOOK ADMIN WIDGETS
require_once( dirname( __FILE__ ) . '/includes/social-master-admin-widgets.php');
// HOOK WIDGET BASIC
require_once( dirname( __FILE__ ) . '/includes/social-master-widget-basic.php');
