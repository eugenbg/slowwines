<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   SiteCondor_SEO
 * @author    Sebastián Brocher <seb@sitecondor.com> and Judd Lyon <judd@sitecondor.com>
 * @license   GPL-2.0+
 * @link      https://www.sitecondor.com/wordpress-plugin
 * @copyright 2015 Noctual, LLC
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

if ( is_multisite() ) {

	$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );
		/* @TODO: delete all transient, options and files you may have added
		delete_transient( 'TRANSIENT_NAME' );
		delete_option('OPTION_NAME');
		//info: remove custom file directory for main site
		$upload_dir = wp_upload_dir();
		$directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
		if (is_dir($directory)) {
			foreach(glob($directory.'*.*') as $v){
				unlink($v);
			}
			rmdir($directory);
		}
		*/
	if ( $blogs ) {

	 	foreach ( $blogs as $blog ) {
			switch_to_blog( $blog['blog_id'] );
			/* @TODO: delete all transient, options and files you may have added
			delete_transient( 'TRANSIENT_NAME' );
			delete_option('OPTION_NAME');
			//info: remove custom file directory for main site
			$upload_dir = wp_upload_dir();
			$directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
			if (is_dir($directory)) {
				foreach(glob($directory.'*.*') as $v){
					unlink($v);
				}
				rmdir($directory);
			}
			//info: remove and optimize tables
			$GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."TABLE_NAME`");
			$GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
			*/
			restore_current_blog();
		}
	}

} else {
	/* @TODO: delete all transient, options and files you may have added
	delete_transient( 'TRANSIENT_NAME' );
	delete_option('OPTION_NAME');
	//info: remove custom file directory for main site
	$upload_dir = wp_upload_dir();
	$directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
	if (is_dir($directory)) {
		foreach(glob($directory.'*.*') as $v){
			unlink($v);
		}
		rmdir($directory);
	}
	//info: remove and optimize tables
	$GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."TABLE_NAME`");
	$GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
	*/

		/**
	 * Calls SiteCondor API
	 * Method: POST, PUT, GET etc
	 * Data: array("param" => "value") ==> index.php?param=value
	 *
	 * @since    1.0.0
	 */
	function sc_call_sitecondor_api( $method, $url, $data = false ) {

		$dev = true;

		if($dev) {
			$base_url = 'http://0.0.0.0:3000/api/v1/';
    	$sslverify = false;
    } else {
    	$base_url = 'https://www.sitecondor.com/api/v1/';
    	$sslverify = true;
    }

  	$args = array(
			'timeout' => 15,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'user-agent'  => 'WordPress/; ' . get_bloginfo( 'url' ),
			'headers' => array(),
			'body' => $data,
			'cookies' => array(),
	    'compress'    => false,
	    'decompress'  => true,
	    'sslverify'   => $sslverify,
	    'stream'      => false,
	    'filename'    => null
		);

    switch ( $method ) {
      case "POST":
      	$args['method'] = 'POST';
      	$args['data'] = $data;
				$result = wp_remote_post( $base_url . $url, $args );
        break;
      case "PUT":
      	$args['method'] = 'PUT';
      	$args['data'] = $data;
				$result = wp_remote_post( $base_url . $url, $args );
        break;
      default:
        if ( $data ) {
          $url = sprintf( "%s?%s", $url, http_build_query( $data ) );
        }
        $result = wp_remote_get( $base_url . $url, $args );
        break;
    }

		if ( is_wp_error( $result ) ) {
		   return
			   array(
					'status' => 599,
					'result' => $result->get_error_message()
				);
		}
    return
    	array(
				'status' => $result['response']['code'],
				'result' => $result['body']
			);
	}

	$options = get_option( 'sitecondor_options' );
	$data = array('apikey' => $options['apikey']);

	sc_call_sitecondor_api("POST", "deletion-email", $data);

  $GLOBALS['wpdb']->query("DELETE FROM {$GLOBALS['wpdb']->prefix}options WHERE option_name = 'sitecondor_options'");
}
