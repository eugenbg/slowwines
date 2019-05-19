<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class social_master_admin_addons_table extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
	$plugin_master_name = constant('SOCIAL_MASTER_NAME');
	$path = ABSPATH . 'wp-content/plugins/social-master-addons/';
	if ( is_plugin_active( 'social-master-addons/social-master-addons.php' ) && file_exists($path) ) {
		$social_master_addon = "yes";
		$social_master_addon_get = '<b>All add-ons Installed</b>';
	}
	else{
		$social_master_addon = "no";
		$social_master_addon_get = '<a class="button-primary" href="https://wordpress.techgasp.com/social-master/" target="_blank" title="Get Add-ons" style="float:left;">Get Add-ons</a>';
	}
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Screenshot', 'social_master'); ?></h2></th>
			<th><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Description', 'social_master'); ?></h2></th>
			<th><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Installed', 'social_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th><?php echo $social_master_addon_get; ?></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-addons-widget-basic.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="139px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Social Master Basic Fast Loading Widget</h3><p>This Widget was specially designed in html5 to be easy to use and deploy, all settings are on auto mode. Extremely fast page load times and small system trace.</p><p>Packed with <b>Facebook Like</b> and <b>Share</b>, <b>Follow Twitter</b>, <b>Tweet</b> and <b>Google Plus</b> Buttons. Remember you can always hide or change the widget title.</p><p>Navigate to your wordpress widgets page and start using it.</p></td>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-check-yes.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="200px" height="121px" style="padding:5px;"/></td>
		</tr>
		<tr>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-addons-widget-advanced.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="139px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Social Master Advanced Widget</h3><p>The "Top of the Line" Advanced Widget that contains all Social Network Buttons. <b>Facebook Like</b> and <b>Share</b>, <b>Twitter Follow</b> and <b>Tweet</b>, <b>Google Plus</b>, <b>LinkedIn Share</b>, <b>Tumblr Follow</b>, <b>Pinterest "pin it"</b>, <b>View on Instagram</b>, <b>Youtube Subscribe</b>, <b>Soundcloud Profile</b>, <b>Reverbnation Profile</b>, <b>Spotify Profile</b>, <b>StumbleUpon Share</b>, <b>MySpace Share</b>, <b>Buffer Share</b>, <b>Digg Share</b> and <b>Reddit Share</b>. Bombastic!!!</p><p> Social Master is currently the only plugin where users can decide which social network buttons to show and their order, yes you can order the buttons according to your social network priorities</p><p>Makes <b>NO USE</b> of nasty Javascipt or Ajax.</p><p>Navigate to your wordpress widgets page and start using it.</p></td>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-check-'.$social_master_addon.'.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="200px" height="121px" style="padding:5px;"/></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-addons-shortcode-in.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="139px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Individual Shortcode</h3><p>Social Master uses TechGasp Wordpress Framework. The <b>Individual Shortcode</b> allows you to have a different customized social buttons in each page or post. Easy to use it can be found when you edit a page or a post under the wordpress text editor. Once you have created your shortcode, Just insert the shortcode <b>[social-master]</b> anywhere inside that text.</p></td>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-check-'.$social_master_addon.'.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="200px" height="121px" style="padding:5px;"/></td>
		</tr>
		<tr>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-addons-shortcode-un.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="139px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Universal Shortcode</h3><p>Social Master uses TechGasp Wordpress Framework. The <b>Universal Shortcode</b> allows you to have the same social buttons across different pages or posts. Easy to use it can be found right here under the Shortcodes menu. Once you have created your shortcode, Just insert the shortcode <b>[social-master-un]</b> anywhere inside the text of your pages or posts.</p></td>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-check-'.$social_master_addon.'.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="200px" height="121px" style="padding:5px;"/></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-addons-updater.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="139px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Advanced Updater</h3><p>The Advanced Updater allows you to easily Update / Upgrade your Advanced Plugin. You can instantly update your plugin after we release a new version with more goodies without having to wait for the nightly native wordpress updater that runs every 24/48 hours. Get it fresh, get it fast.</p></td>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-check-'.$social_master_addon.'.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="200px" height="121px" style="padding:5px;"/></td>
		</tr>
		<tr>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-addons-support.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="139px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Award Winning Professional Support</h3><p>Need professional help deploying this plugin? TechGasp provides award winning professional wordpress support for all advanced version costumers and wordpress professionals. Support Us and we will Support You.</p></td>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-check-'.$social_master_addon.'.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="200px" height="121px" style="padding:5px;"/></td>
		</tr>
	</tbody>
</table>
<?php
		}
}
