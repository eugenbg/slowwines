<?php
global $wpdb, $blog_id;
get_post_custom();
$socialspacer = "'";
@$uricurrent ="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//Display Facebook
if(is_multisite()){
	$social_master_system_wide_facebook_display = get_blog_option($blog_id, 'social_master_system_wide_facebook_display');
	$social_master_system_wide_facebook_page  = get_blog_option($blog_id, 'social_master_system_wide_facebook_page');
	$social_master_system_wide_facebook_id = get_blog_option($blog_id, 'social_master_system_wide_facebook_id');
	$social_master_system_wide_facebook_lang = get_blog_option($blog_id, 'social_master_system_wide_facebook_lang');

}
else{
	$social_master_system_wide_facebook_display = get_option('social_master_system_wide_facebook_display');
	$social_master_system_wide_facebook_page  = get_option('social_master_system_wide_facebook_page');
	$social_master_system_wide_facebook_id = get_option('social_master_system_wide_facebook_id');
	$social_master_system_wide_facebook_lang = get_option('social_master_system_wide_facebook_lang');
}

if(empty($social_master_system_wide_facebook_lang)){
	$social_master_system_wide_facebook_lang = 'en_US';
}

if ( $show_display == 'on' ){
	if ($social_master_system_wide_facebook_display == "true"){
		echo '<div id="fb-like" style="overflow: visible !important">' .
		'<div id="fb-root"></div>' .
		'<script>(function(d, s, id) {' .
		'var js, fjs = d.getElementsByTagName(s)[0];' .
		'if (d.getElementById(id)) return;' .
		'js = d.createElement(s); js.id = id;' .
		'js.src = "//connect.facebook.net/'.$social_master_system_wide_facebook_lang.'/sdk.js#xfbml=1&version=v2.10&appId='.$social_master_system_wide_facebook_id.'";' .
		'fjs.parentNode.insertBefore(js, fjs);' .
		'}(document, '.$socialspacer.'script'.$socialspacer.', '.$socialspacer.'facebook-jssdk'.$socialspacer.'));</script>' .
		'<div class="fb-like" data-href="'.$social_master_system_wide_facebook_page.'" data-share="true" data-action="like" data-layout="button_count" data-size="small" data-show-faces="false" style="overflow: visible !important z-index:9999 !important"></div>' .
		'</div>';
	}
	else {
		echo '<div id="fb-like" style="overflow: visible !important">' .
		'<div id="fb-root"></div>' .
		'<script>(function(d, s, id) {' .
		'var js, fjs = d.getElementsByTagName(s)[0];' .
		'if (d.getElementById(id)) return;' .
		'js = d.createElement(s); js.id = id;' .
		'js.src = "//connect.facebook.net/'.$social_master_system_wide_facebook_lang.'/sdk.js#xfbml=1&version=v2.10&appId='.$social_master_system_wide_facebook_id.'";' .
		'fjs.parentNode.insertBefore(js, fjs);' .
		'}(document, '.$socialspacer.'script'.$socialspacer.', '.$socialspacer.'facebook-jssdk'.$socialspacer.'));</script>' .
		'<div class="fb-like" data-href="'.$uricurrent.'" data-share="true" data-action="like" data-layout="button_count" data-size="small" data-show-faces="false" style="overflow: visible !important z-index:9999 !important"></div>' .
		'</div>';
	}
}
else{
	if ($social_master_system_wide_facebook_display == "true"){
	echo '<div style="text-align: center;display: flex;">' .
		'<div id="fb-root"></div>' .
		'<script>(function(d, s, id) {' .
		'var js, fjs = d.getElementsByTagName(s)[0];' .
		'if (d.getElementById(id)) return;' .
		'js = d.createElement(s); js.id = id;' .
		'js.src = "//connect.facebook.net/'.$social_master_system_wide_facebook_lang.'/sdk.js#xfbml=1&version=v2.10&appId='.$social_master_system_wide_facebook_id.'";' .
		'fjs.parentNode.insertBefore(js, fjs);' .
		'}(document, '.$socialspacer.'script'.$socialspacer.', '.$socialspacer.'facebook-jssdk'.$socialspacer.'));</script>' .
		'<div class="fb-like" data-href="'.$social_master_system_wide_facebook_page.'" data-share="true" data-action="like" data-layout="box_count" data-size="small" data-show-faces="false" style="width: 450px !important; overflow: visible !important z-index:9999 !important"></div>' .
		'</div>';
	}
	else {
	echo '<div style="text-align: center;display: flex;">' .
		'<div id="fb-root"></div>' .
		'<script>(function(d, s, id) {' .
		'var js, fjs = d.getElementsByTagName(s)[0];' .
		'if (d.getElementById(id)) return;' .
		'js = d.createElement(s); js.id = id;' .
		'js.src = "//connect.facebook.net/'.$social_master_system_wide_facebook_lang.'/sdk.js#xfbml=1&version=v2.10&appId='.$social_master_system_wide_facebook_id.'";' .
		'fjs.parentNode.insertBefore(js, fjs);' .
		'}(document, '.$socialspacer.'script'.$socialspacer.', '.$socialspacer.'facebook-jssdk'.$socialspacer.'));</script>' .
		'<div class="fb-like" data-href="'.$uricurrent.'" data-share="true" data-action="like" data-layout="box_count" data-size="small" data-show-faces="false" style="width: 450px !important; overflow: visible !important z-index:9999 !important"></div>' .
		'</div>';
	}
}
?>
