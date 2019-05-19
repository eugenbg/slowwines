<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class social_master_admin_widgets_table extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
	$plugin_master_name = constant('SOCIAL_MASTER_NAME');
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Screenshot', 'social_master'); ?></h2></th>
			<th><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Description', 'social_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th><a class="button-primary" href="<?php echo get_site_url(); ?>/wp-admin/widgets.php" title="To Widgets Page" style="float:left;">To Widgets Page</a></p></th>
			<th><a class="button-primary" href="<?php echo get_site_url(); ?>/wp-admin/widgets.php" title="To Widgets Page" style="float:right;">To Widgets Page</a></p></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-widget-basic.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Social Master Basic Fast Loading Widget</h3><p>This Widget was specially designed in html5 to be easy to use and deploy, all settings are on auto mode. Extremely fast page load times and small system trace.</p><p>Packed with <b>Facebook Like</b> and <b>Share</b>, <b>Follow Twitter</b>, <b>Tweet</b> and <b>Google Plus</b> Buttons. Remember you can always hide or change the widget title.</p><p>Navigate to your wordpress widgets page and start using it.</p></td>
		</tr>
		<tr>
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-socialmaster-admin-widget-advanced.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Social Master Advanced Widget</h3><p>The "Top of the Line" Advanced Widget that contains all Social Network Buttons. <b>Facebook Like</b> and <b>Share</b>, <b>Twitter Follow</b> and <b>Tweet</b>, <b>Google Plus</b>, <b>LinkedIn Share</b>, <b>Tumblr Follow</b>, <b>Pinterest "pin it"</b>, <b>View on Instagram</b>, <b>Youtube Subscribe</b>, <b>Soundcloud Profile</b>, <b>Reverbnation Profile</b>, <b>Spotify Profile</b>, <b>StumbleUpon Share</b>, <b>MySpace Share</b>, <b>Buffer Share</b>, <b>Digg Share</b> and <b>Reddit Share</b>. Bombastic!!!</p><p> Social Master is currently the only plugin where users can decide which social network buttons to show and their order, yes you can order the buttons according to your social network priorities</p><p>Makes <b>NO USE</b> of nasty Javascipt or Ajax.</p><p>Check Add-ons page.</p></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-admin-widget-blank.png', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td style="vertical-align:middle"><h3>Suggest a Widget</h3><p>Would you like to see your widget idea added to this plugin? Just drop us a line and we will make sure it gets included in the next release.</p><p>Get in touch with TechGasp.</p></td>
		</tr>
	</tbody>
</table>
<?php
		}
}
