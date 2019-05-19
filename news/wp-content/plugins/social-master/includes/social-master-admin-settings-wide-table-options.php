<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class social_master_admin_settings_wide_table_options extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
function display() {
global $wpdb, $blog_id;

if (isset($_POST['update_system_wide'])){
	if(is_multisite()){
		//Facebook
		if (isset($_POST['social_master_system_wide_facebook_display'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_display', $_POST['social_master_system_wide_facebook_display']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_display', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_page'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_page', $_POST['social_master_system_wide_facebook_page']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_page', '');
		}
		if (isset($_POST['social_master_system_wide_facebook_lang'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_lang', $_POST['social_master_system_wide_facebook_lang']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_lang', '');
		}
		if (isset($_POST['social_master_system_wide_facebook_id'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_id', $_POST['social_master_system_wide_facebook_id']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_id', '');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_name_on'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_name_on', $_POST['social_master_system_wide_facebook_og_name_on']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_name_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_type_on'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_type_on', $_POST['social_master_system_wide_facebook_og_type_on']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_type_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_title_on'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_title_on', $_POST['social_master_system_wide_facebook_og_title_on']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_title_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_url_on'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_url_on', $_POST['social_master_system_wide_facebook_og_url_on']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_url_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_description_on'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_description_on', $_POST['social_master_system_wide_facebook_og_description_on']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_description_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_image_on'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_image_on', $_POST['social_master_system_wide_facebook_og_image_on']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_image_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_image'])){
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_image', $_POST['social_master_system_wide_facebook_og_image']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_facebook_og_image', '');
		}
		//Twitter
		if (isset($_POST['social_master_system_wide_twitter_user'])){
		update_blog_option($blog_id, 'social_master_system_wide_twitter_user', $_POST['social_master_system_wide_twitter_user']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_twitter_user', '');
		}
		if (isset($_POST['social_master_system_wide_twitter_follow_w'])){
		update_blog_option($blog_id, 'social_master_system_wide_twitter_follow_w', $_POST['social_master_system_wide_twitter_follow_w']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_twitter_follow_w', 'false');
		}
		if (isset($_POST['social_master_system_wide_twitter_tweet_w'])){
		update_blog_option($blog_id, 'social_master_system_wide_twitter_tweet_w', $_POST['social_master_system_wide_twitter_tweet_w']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_twitter_tweet_w', 'false');
		}
		//Linkedin
		if (isset($_POST['social_master_system_wide_linkedin_page'])){
		update_blog_option($blog_id, 'social_master_system_wide_linkedin_page', $_POST['social_master_system_wide_linkedin_page']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_linkedin_page', '');
		}
		//Youtube
		if (isset($_POST['social_master_system_wide_youtube_id'])){
		update_blog_option($blog_id, 'social_master_system_wide_youtube_id', $_POST['social_master_system_wide_youtube_id']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_youtube_id', '');
		}
		//Instagram
		if (isset($_POST['social_master_system_wide_instagram_user'])){
		update_blog_option($blog_id, 'social_master_system_wide_instagram_user', $_POST['social_master_system_wide_instagram_user']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_instagram_user', '');
		}
		//Soundcloud
		if (isset($_POST['social_master_system_wide_soundcloud_page'])){
		update_blog_option($blog_id, 'social_master_system_wide_soundcloud_page', $_POST['social_master_system_wide_soundcloud_page']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_soundcloud_page', '');
		}
		//Reverbnation
		if (isset($_POST['social_master_system_wide_reverbnation_page'])){
		update_blog_option($blog_id, 'social_master_system_wide_reverbnation_page', $_POST['social_master_system_wide_reverbnation_page']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_reverbnation_page', '');
		}
		//Spotify
		if (isset($_POST['social_master_system_wide_spotify_page'])){
		update_blog_option($blog_id, 'social_master_system_wide_spotify_page', $_POST['social_master_system_wide_spotify_page']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_spotify_page', '');
		}
		//Feedly
		if (isset($_POST['social_master_system_wide_feedly_page'])){
		update_blog_option($blog_id, 'social_master_system_wide_feedly_page', $_POST['social_master_system_wide_feedly_page']);
		}
		else{
		update_blog_option($blog_id, 'social_master_system_wide_feedly_page', '' );
		}
	}
	else{
		//Facebook
		if (isset($_POST['social_master_system_wide_facebook_display'])){
		update_option('social_master_system_wide_facebook_display', $_POST['social_master_system_wide_facebook_display']);
		}
		else{
		update_option('social_master_system_wide_facebook_display', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_page'])){
		update_option('social_master_system_wide_facebook_page', $_POST['social_master_system_wide_facebook_page']);
		}
		else{
		update_option('social_master_system_wide_facebook_page', '');
		}
		if (isset($_POST['social_master_system_wide_facebook_lang'])){
		update_option('social_master_system_wide_facebook_lang', $_POST['social_master_system_wide_facebook_lang']);
		}
		else{
		update_option('social_master_system_wide_facebook_lang', '');
		}
		if (isset($_POST['social_master_system_wide_facebook_id'])){
		update_option('social_master_system_wide_facebook_id', $_POST['social_master_system_wide_facebook_id']);
		}
		else{
		update_option('social_master_system_wide_facebook_id', '');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_name_on'])){
		update_option('social_master_system_wide_facebook_og_name_on', $_POST['social_master_system_wide_facebook_og_name_on']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_name_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_type_on'])){
		update_option('social_master_system_wide_facebook_og_type_on', $_POST['social_master_system_wide_facebook_og_type_on']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_type_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_title_on'])){
		update_option('social_master_system_wide_facebook_og_title_on', $_POST['social_master_system_wide_facebook_og_title_on']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_title_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_url_on'])){
		update_option('social_master_system_wide_facebook_og_url_on', $_POST['social_master_system_wide_facebook_og_url_on']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_url_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_description_on'])){
		update_option('social_master_system_wide_facebook_og_description_on', $_POST['social_master_system_wide_facebook_og_description_on']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_description_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_image_on'])){
		update_option('social_master_system_wide_facebook_og_image_on', $_POST['social_master_system_wide_facebook_og_image_on']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_image_on', 'false');
		}
		if (isset($_POST['social_master_system_wide_facebook_og_image'])){
		update_option('social_master_system_wide_facebook_og_image', $_POST['social_master_system_wide_facebook_og_image']);
		}
		else{
		update_option('social_master_system_wide_facebook_og_image', '');
		}
		//Twitter
		if (isset($_POST['social_master_system_wide_twitter_user'])){
		update_option('social_master_system_wide_twitter_user', $_POST['social_master_system_wide_twitter_user']);
		}
		else{
		update_option('social_master_system_wide_twitter_user', '');
		}
		if (isset($_POST['social_master_system_wide_twitter_follow_w'])){
		update_option('social_master_system_wide_twitter_follow_w', $_POST['social_master_system_wide_twitter_follow_w']);
		}
		else{
		update_option('social_master_system_wide_twitter_follow_w', 'false');
		}
		if (isset($_POST['social_master_system_wide_twitter_tweet_w'])){
		update_option('social_master_system_wide_twitter_tweet_w', $_POST['social_master_system_wide_twitter_tweet_w']);
		}
		else{
		update_option('social_master_system_wide_twitter_tweet_w', 'false');
		}
		//Linkedin
		if (isset($_POST['social_master_system_wide_linkedin_page'])){
		update_option('social_master_system_wide_linkedin_page', $_POST['social_master_system_wide_linkedin_page']);
		}
		else{
		update_option('social_master_system_wide_linkedin_page', '');
		}
		//Youtube
		if (isset($_POST['social_master_system_wide_youtube_id'])){
		update_option('social_master_system_wide_youtube_id', $_POST['social_master_system_wide_youtube_id']);
		}
		else{
		update_option('social_master_system_wide_youtube_id', '');
		}
		//Instagram
		if (isset($_POST['social_master_system_wide_instagram_user'])){
		update_option('social_master_system_wide_instagram_user', $_POST['social_master_system_wide_instagram_user']);
		}
		else{
		update_option('social_master_system_wide_instagram_user', '');
		}
		//Soundcloud
		if (isset($_POST['social_master_system_wide_soundcloud_page'])){
		update_option('social_master_system_wide_soundcloud_page', $_POST['social_master_system_wide_soundcloud_page']);
		}
		else{
		update_option('social_master_system_wide_soundcloud_page', '');
		}
		//Reverbnation
		if (isset($_POST['social_master_system_wide_reverbnation_page'])){
		update_option('social_master_system_wide_reverbnation_page', $_POST['social_master_system_wide_reverbnation_page']);
		}
		else{
		update_option('social_master_system_wide_reverbnation_page', '');
		}
		//Spotify
		if (isset($_POST['social_master_system_wide_spotify_page'])){
		update_option('social_master_system_wide_spotify_page', $_POST['social_master_system_wide_spotify_page']);
		}
		else{
		update_option('social_master_system_wide_spotify_page', '');
		}
		//Feedly
		if (isset($_POST['social_master_system_wide_feedly_page'])){
		update_option('social_master_system_wide_feedly_page', $_POST['social_master_system_wide_feedly_page']);
		}
		else{
		update_option('social_master_system_wide_feedly_page', '' );
		}
	}
?>
<div id="message" class="updated fade">
<p><strong><?php _e('Settings Saved!', 'social_master'); ?></strong></p>
</div>
<?php
}
//nothing to post
else{}

//Lets get data from single and multi to populate the form
if(is_multisite()){
	$social_master_system_wide_facebook_display = get_blog_option($blog_id, 'social_master_system_wide_facebook_display');
	$social_master_system_wide_facebook_page = get_blog_option($blog_id, 'social_master_system_wide_facebook_page');
	$social_master_system_wide_facebook_lang = get_blog_option($blog_id, 'social_master_system_wide_facebook_lang');
	$social_master_system_wide_facebook_id = get_blog_option($blog_id, 'social_master_system_wide_facebook_id');
	$social_master_system_wide_facebook_og_name_on = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_name_on');
	$social_master_system_wide_facebook_og_type_on = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_type_on');
	$social_master_system_wide_facebook_og_title_on = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_title_on');
	$social_master_system_wide_facebook_og_url_on = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_url_on');
	$social_master_system_wide_facebook_og_description_on = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_description_on');
	$social_master_system_wide_facebook_og_image_on = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_image_on');
	$social_master_system_wide_facebook_og_image = get_blog_option($blog_id, 'social_master_system_wide_facebook_og_image');
	$social_master_system_wide_twitter_user = get_blog_option($blog_id, 'social_master_system_wide_twitter_user');
	$social_master_system_wide_twitter_follow_w = get_blog_option($blog_id, 'social_master_system_wide_twitter_follow_w');
	$social_master_system_wide_twitter_tweet_w = get_blog_option($blog_id, 'social_master_system_wide_twitter_tweet_w');
	$social_master_system_wide_linkedin_page = get_blog_option($blog_id, 'social_master_system_wide_linkedin_page');
	$social_master_system_wide_youtube_id = get_blog_option($blog_id, 'social_master_system_wide_youtube_id');
	$social_master_system_wide_instagram_user = get_blog_option($blog_id, 'social_master_system_wide_instagram_user');
	$social_master_system_wide_soundcloud_page = get_blog_option($blog_id, 'social_master_system_wide_soundcloud_page');
	$social_master_system_wide_reverbnation_page = get_blog_option($blog_id, 'social_master_system_wide_reverbnation_page');
	$social_master_system_wide_spotify_page = get_blog_option($blog_id, 'social_master_system_wide_spotify_page');
	$social_master_system_wide_feedly_page = get_blog_option($blog_id, 'social_master_system_wide_feedly_page');
}
else{
	$social_master_system_wide_facebook_display = get_option('social_master_system_wide_facebook_display');
	$social_master_system_wide_facebook_page = get_option('social_master_system_wide_facebook_page');
	$social_master_system_wide_facebook_lang = get_option('social_master_system_wide_facebook_lang');
	$social_master_system_wide_facebook_id = get_option('social_master_system_wide_facebook_id');
	$social_master_system_wide_facebook_og_name_on = get_option('social_master_system_wide_facebook_og_name_on');
	$social_master_system_wide_facebook_og_type_on = get_option('social_master_system_wide_facebook_og_type_on');
	$social_master_system_wide_facebook_og_title_on = get_option('social_master_system_wide_facebook_og_title_on');
	$social_master_system_wide_facebook_og_url_on = get_option('social_master_system_wide_facebook_og_url_on');
	$social_master_system_wide_facebook_og_description_on = get_option('social_master_system_wide_facebook_og_description_on');
	$social_master_system_wide_facebook_og_image_on = get_option('social_master_system_wide_facebook_og_image_on');
	$social_master_system_wide_facebook_og_image = get_option('social_master_system_wide_facebook_og_image');
	$social_master_system_wide_twitter_user = get_option('social_master_system_wide_twitter_user');
	$social_master_system_wide_twitter_follow_w = get_option('social_master_system_wide_twitter_follow_w');
	$social_master_system_wide_twitter_tweet_w = get_option('social_master_system_wide_twitter_tweet_w');
	$social_master_system_wide_linkedin_page = get_option('social_master_system_wide_linkedin_page');
	$social_master_system_wide_youtube_id = get_option('social_master_system_wide_youtube_id');
	$social_master_system_wide_instagram_user = get_option('social_master_system_wide_instagram_user');
	$social_master_system_wide_soundcloud_page = get_option('social_master_system_wide_soundcloud_page');
	$social_master_system_wide_reverbnation_page = get_option('social_master_system_wide_reverbnation_page');
	$social_master_system_wide_spotify_page = get_option('social_master_system_wide_spotify_page');
	$social_master_system_wide_feedly_page = get_option('social_master_system_wide_feedly_page');
}
?>
<form method="post" width='1'>
<fieldset class="options">

<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="3"><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;System Wide Settings', 'social_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="3"></th>
		</tr>
	</tfoot>

	<tbody>
			<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Facebook Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_display" id="social_master_system_wide_facebook_display" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_display == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_display"><b><?php _e('Activate to Show Fanpage Total Count', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle">
				<div class="description">If <b>On</b>, (you need a Facebook Fan Page). Displays your facebook page total likes count and new likes are added to your facebook fan page.</div>
				<div class="description">If <b>Off</b>, shows individual wordpress pages and posts likes. New likes are just for that specific page or post.</div>
				<div class="description">What to select?</div>
				<div class="description">If you want to boost your Facebook Fan Page likes and get lots of people liking it and following it, select On.</div>
				<div class="description">If you have a nice blog with lots of pages and posts, then you will probably want people liking and sharing individual pages and posts, select Off.</div>
				<div class="description">If you do not have a Facebook Fan Page, select Off.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_facebook_page"><?php _e('Facebook Fan Page Link:', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_facebook_page" name="social_master_system_wide_facebook_page" type="text" size="22" value="<?php echo $social_master_system_wide_facebook_page; ?>">
				<div class="description">Mandatory if above Show Fanpage Total Count is On. Example: https://www.facebook.com/TechGasp</div>
				<div class="description">Leave empty or blank if Fanpage Total Count is Off.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_facebook_lang"><?php _e('Facebook Language:', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_facebook_lang" name="social_master_system_wide_facebook_lang" type="text" size="22" value="<?php echo $social_master_system_wide_facebook_lang; ?>">
				<div class="description">Enables language override, default is empty for english <b>en_US</b></div>
				<div class="description">To override insert your language code, example: <b>fr_FR</b> for french <b>es_ES</b> for Spanish <b>pt_PT</b> for Portuguese.</div>
				<div class="description"><a href="https://www.facebook.com/translations/FacebookLocales.xml" target="_blank">Click to search your language code.</a></div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_facebook_id"><?php _e('Facebook Application ID Number:', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_facebook_id" name="social_master_system_wide_facebook_id" type="text" size="22" value="<?php echo $social_master_system_wide_facebook_id; ?>">
				<div class="description">Optional, if you have a Facebook Application. <a href="https://developers.facebook.com/apps" target="_blank">Get App ID Number</a>.</div>
				<div class="description">Leave empty or blank if you do not have a Facebook Application.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><b>Facebook "og" settings</b></td>
			<td style="vertical-align:middle">
				<div class="description">Adds "og" properties to facebook like and share buttons.</div>
				<div class="description">These settings should be passed by themes inside the header tags but they are missing in the majority of themes.</div>
				<div class="description">For awesome facebook likes and shares, Social Master will automatically retrieve data from pages and posts to automatically generate facebook og settings.</div>
				<div class="description">When you activate these settings, it might take Facebook 48 hours to clear it's cache and apply these new settings.</div>
				<div class="description">If you don't know if your theme contains "og" settings, activate them. <b>Default is On</b> for all of them.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_og_name_on" id="social_master_system_wide_facebook_og_name_on" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_og_name_on == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_og_name_on"><?php _e('Activate "og" Name', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Sets website / blog name.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_og_type_on" id="social_master_system_wide_facebook_og_type_on" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_og_type_on == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_og_type_on"><?php _e('Activate "og" Type', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Sets website / blog type.</div>
			</td>
		</tr>
			<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_og_title_on" id="social_master_system_wide_facebook_og_title_on" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_og_title_on == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_og_title_on"><?php _e('Activate "og" Title', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Sets current page / post title.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_og_url_on" id="social_master_system_wide_facebook_og_url_on" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_og_url_on == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_og_url_on"><?php _e('Activate "og" Url', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Sets current page / post  url.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_og_description_on" id="social_master_system_wide_facebook_og_description_on" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_og_description_on == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_og_description_on"><?php _e('Activate "og" Description', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Sets current page / post description.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_facebook_og_image_on" id="social_master_system_wide_facebook_og_image_on" value="true" type="checkbox" <?php echo $social_master_system_wide_facebook_og_image_on == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_facebook_og_image_on"><?php _e('Activate "og" Image', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Sets current page / post featured image.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_facebook_og_image"><?php _e('override "og" image:', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_facebook_og_image" name="social_master_system_wide_facebook_og_image" type="text" size="22" value="<?php echo $social_master_system_wide_facebook_og_image; ?>">
					<div class="description">Optional, if you haven't set featured image in your pages and posts insert a link to your wordpress logo or any image.</div>
					<div class="description">When sharing or liking it will always display the same image. That kinda sucks!</div>
					<div class="description">You should set a different featured image in each page and post, and leave this field empty or blank.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Twitter Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_twitter_user"><b><?php _e('Twitter Username:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_twitter_user" name="social_master_system_wide_twitter_user" type="text" size="22" value="<?php echo $social_master_system_wide_twitter_user; ?>">
				<div class="description">Insert your Twitter username to display the Follow Button.</div>
				<div class="description">If you do not wish to display the Twitter follow Button... you might not have a twitter account, leave this field empty or blank and the follow button will not be generated.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_twitter_follow_w" id="social_master_system_wide_twitter_follow_w" value="true" type="checkbox" <?php echo $social_master_system_wide_twitter_follow_w == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_twitter_follow_w"><?php _e('Activate Bigger Follow Bubble', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Optional for Horizontal buttons Display.</div>
				<div class="description">Activate if you have thousands of followers and the Follow Button Bubble is being cut.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"><input name="social_master_system_wide_twitter_tweet_w" id="social_master_system_wide_twitter_tweet_w" value="true" type="checkbox" <?php echo $social_master_system_wide_twitter_tweet_w == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="social_master_system_wide_twitter_tweet_w"><?php _e('Activate Bigger Tweet Bubble', 'social_master'); ?></label></td>
			<td style="vertical-align:middle">
				<div class="description">Optional for Horizontal buttons Display.</div>
				<div class="description">Activate if you have thousands of tweets and the Tweet Button Bubble is being cut.</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Linkedin Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_linkedin_page"><b><?php _e('LinkedIn Profile Page:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle"><input id="social_master_system_wide_linkedin_page" name="social_master_system_wide_linkedin_page" type="text" size="22" value="<?php echo $social_master_system_wide_linkedin_page; ?>"></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Youtube Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_youtube_id"><b><?php _e('Youtube User or Channel ID:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle"><input id="social_master_system_wide_youtube_id" name="social_master_system_wide_youtube_id" type="text" size="22" value="<?php echo $social_master_system_wide_youtube_id; ?>"></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Instagram Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_instagram_user"><b><?php _e('Instagram Username:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle"><input id="social_master_system_wide_instagram_user" name="social_master_system_wide_instagram_user" type="text" size="22" value="<?php echo $social_master_system_wide_instagram_user; ?>"></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Soundcloud Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_soundcloud_page"><b><?php _e('Soundcloud User Profile Link:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle"><input id="social_master_system_wide_soundcloud_page" name="social_master_system_wide_soundcloud_page" type="text" size="22" value="<?php echo $social_master_system_wide_soundcloud_page; ?>"></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Reverbnation Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_reverbnation_page"><b><?php _e('Reverbnation User Profile Link:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle"><input id="social_master_system_wide_reverbnation_page" name="social_master_system_wide_reverbnation_page" type="text" size="22" value="<?php echo $social_master_system_wide_reverbnation_page; ?>"></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Spotify Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_spotify_page"><b><?php _e('Spotify User / Artist Profile URI:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_spotify_page" name="social_master_system_wide_spotify_page" type="text" size="22" value="<?php echo $social_master_system_wide_spotify_page; ?>">
					<div class="description">Spotify Artist URI example:</div>
					<div class="description">spotify:artist:1vCWHaC5f2uS3yhpwWbIA6</div>
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><h3>Feedly Options</h3></td>
			<td></td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td><label for="social_master_system_wide_feedly_page"><b><?php _e('Feedly Feed Link:', 'social_master'); ?></b></label></td>
			<td style="vertical-align:middle">
				<input id="social_master_system_wide_feedly_page" name="social_master_system_wide_feedly_page" type="text" size="22" value="<?php echo $social_master_system_wide_feedly_page; ?>">
				<div class="description">Feedly feed link example:</div>
				<div class="description">https://wordpress.techgasp.com/feed/</div>
			</td>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_system_wide' value='<?php _e("Save Settings", 'social_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
	}
//CLASS ENDS
}
