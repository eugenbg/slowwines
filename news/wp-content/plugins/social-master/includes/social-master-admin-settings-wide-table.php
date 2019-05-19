<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class social_master_admin_settings_wide_table extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Instructions', 'social_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td>
<p>This is the central place to easily set all your social buttons preferences</b>.</p>
<p>These settings apply to all widgets and shortcodes. It is <b>mandatory</b> to fill out these settings in order for the buttons to work properly.</p>
<p>If you do not wish to display certain buttons, you can leave empty or blank the options for those specific buttons.</p>
<p>In case of trouble get in touch with us via <a href="http://wordpress.techgasp.com/support/" target="_blank"><b>support ticket</b></a>.</p>
</td>
		</tr>
	</tbody>
</table>
<?php
		}
}
