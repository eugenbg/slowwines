<?php
//Hook Widget
add_action( 'widgets_init', 'social_master_widget_basic' );
//Register Widget
function social_master_widget_basic() {
register_widget( 'social_master_widget_basic' );
}

class social_master_widget_basic extends WP_Widget {
	function __construct(){
	$widget_ops = array( 'classname' => 'Social Master Basic', 'description' => __('This Widget was specially designed in html5 to be easy to use and deploy, all settings are on auto mode. Extremely fast page load times and small system trace. ', 'social_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'social_master_widget_basic' );
	parent::__construct( 'social_master_widget_basic', __('Social Master Basic', 'social_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$social_title = isset( $instance['social_title'] ) ? $instance['social_title'] :false;
		$social_title_new = isset( $instance['social_title_new'] ) ? $instance['social_title_new'] :false;
		@$uribase = site_url( $path, $scheme );
		@$uricurrent ="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$socialspacer ="'";
		$show_display = isset( $instance['show_display'] ) ? $instance['show_display'] :false;
		$show_facebook = isset( $instance['show_facebook'] ) ? $instance['show_facebook'] :false;
		$show_twitter = isset( $instance['show_twitter'] ) ? $instance['show_twitter'] :false;
		$show_google = isset( $instance['show_google'] ) ? $instance['show_google'] :false;
		echo $before_widget;
		
		// Display the widget title
	if ( $social_title ){
		if (empty ($social_title_new)){
			$social_title_new = constant('SOCIAL_MASTER_NAME');
			echo $before_title . $social_title_new . $after_title;
		}
		else{
			echo $before_title . $social_title_new . $after_title;
		}
	}
	else{
	}
//CSS FOR BUTTONS
	//HORIZONTAL
	if ( $show_display == 'on' ) {
	echo '<div class="social-master-buttons" style="font-size: 1px; max-height: 20px !important; display:flex !important;">';
	//Display Facebook
	if ( $show_facebook ){
		require( dirname( __FILE__ ) . '/social-master-facebook.php');
	}
	else{
	}
	//Display Twitter
	if ( $show_twitter ){
		require( dirname( __FILE__ ) . '/social-master-twitter.php');
	}
	else{
	}
	//Display Google Plus
	if ( $show_google ){
		require( dirname( __FILE__ ) . '/social-master-google.php');
	}
	else{
	}
	echo '</div>';
	}
	//Vertical
	else{
		if ( $show_facebook ){
		require( dirname( __FILE__ ) . '/social-master-facebook.php');
	}
	else{
	}
	//Display Twitter
	if ( $show_twitter ){
		require( dirname( __FILE__ ) . '/social-master-twitter.php');
	}
	else{
	}
	//Display Google Plus
	if ( $show_google ){
		require( dirname( __FILE__ ) . '/social-master-google.php');
	}
	else{
	}
	}
		echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
	global $wpdb, $blog_id;
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['social_title'] = strip_tags( $new_instance['social_title'] );
		$instance['social_title_new'] = $new_instance['social_title_new'];
		$instance['show_display'] = $new_instance['show_display'];
		$instance['show_facebook'] = $new_instance['show_facebook'];
		$instance['show_twitter'] = $new_instance['show_twitter'];
		$instance['show_google'] = $new_instance['show_google'];
		if(is_multisite()){
			update_blog_option($blog_id, 'social_master_wb_show_display', $new_instance['show_display']);
		}
		else{
			update_option('social_master_wb_show_display', $new_instance['show_display']);
		}
		return $instance;
	}
	function form( $instance ) {
	$plugin_master_name = constant('SOCIAL_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'social_title_new' => __('Social Master', 'social_master'), 'social_title' => true, 'social_title_new' => false, 'show_display' => false, 'show_facebook' => false, 'show_twitter' => false, 'show_google' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
	<br>
	<b>Check the buttons to be displayed:</b>
		<!--TITLE-->
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['social_title'], true ); ?> id="<?php echo $this->get_field_id( 'social_title' ); ?>" name="<?php echo $this->get_field_name( 'social_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'social_title' ); ?>"><b><?php _e('Display Widget Title', 'social_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'social_title_new' ); ?>"><?php _e('Change Title:', 'social_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'social_title_new' ); ?>" name="<?php echo $this->get_field_name( 'social_title_new' ); ?>" value="<?php echo $instance['social_title_new']; ?>" style="width:auto;" />
	</p>
		<!--DISPLAY-->
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_display'], true ); ?> id="<?php echo $this->get_field_id( 'show_display' ); ?>" name="<?php echo $this->get_field_name( 'show_display' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_display' ); ?>"><b><?php _e('Activates Horizontal Display', 'social_master'); ?></b></label></br>
	<div class="description">Unchecked display is Vertical.</div>
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
		<!--FACEBOOK-->
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_facebook'], true ); ?> id="<?php echo $this->get_field_id( 'show_facebook' ); ?>" name="<?php echo $this->get_field_name( 'show_facebook' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_facebook' ); ?>"><b><?php _e('Facebook Button', 'social_master'); ?></b></label></br>
	</p>
	<p>
	<div class="description">Check Plugin Settings Page for Facebook Options.</div>
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
		<!--TWITTER-->
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_twitter'], true ); ?> id="<?php echo $this->get_field_id( 'show_twitter' ); ?>" name="<?php echo $this->get_field_name( 'show_twitter' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_twitter' ); ?>"><b><?php _e('Twitter Button', 'social_master'); ?></b></label></br>
	</p>
	<p>
	<div class="description">Check Plugin Settings Page for Twitter Options.</div>
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
		<!--GOOGLE-->
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_google'], true ); ?> id="<?php echo $this->get_field_id( 'show_google' ); ?>" name="<?php echo $this->get_field_name( 'show_google' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_google' ); ?>"><b><?php _e('Google Button', 'social_master'); ?></b></label>
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
		<!--NETWORKS-->
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<b><?php echo $plugin_master_name; ?> Website</b>
	</p>
	<p><a class="button-secondary" href="https://wordpress.techgasp.com/social-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Info Page">Info Page</a> <a class="button-secondary" href="https://wordpress.techgasp.com/social-master-documentation/" target="_blank" title="<?php echo $plugin_master_name; ?> Documentation">Documentation</a> <a class="button-primary" href="https://wordpress.techgasp.com/social-master/" target="_blank" title="Get Add-ons">Get Add-ons</a></p>
	<?php
	}
 }
?>
