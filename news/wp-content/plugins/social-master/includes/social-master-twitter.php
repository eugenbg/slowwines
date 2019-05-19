<?php
global $wpdb, $blog_id;
get_post_custom();
//Display Twitter
$socialspacer = "'";
@$uricurrent ="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if ( $show_display == 'on' ){
	if(is_multisite()){
		$social_master_system_wide_twitter_user = get_blog_option($blog_id, 'social_master_system_wide_twitter_user');
		$social_master_system_wide_twitter_follow_w = get_blog_option($blog_id, 'social_master_system_wide_twitter_follow_w');
		$social_master_system_wide_twitter_tweet_w = get_blog_option($blog_id, 'social_master_system_wide_twitter_tweet_w');
			if ($social_master_system_wide_twitter_follow_w == "true") {
				$social_master_twitter_follow_w = "150";
			}
			else{
				$social_master_twitter_follow_w = "140";
			}
			if ($social_master_system_wide_twitter_tweet_w == "true") {
				$social_master_twitter_tweet_w = "90";
			}
			else{
			$social_master_twitter_tweet_w = "85";
			}
	}
	else{
		$social_master_system_wide_twitter_user = get_option('social_master_system_wide_twitter_user');
		$social_master_system_wide_twitter_follow_w = get_option('social_master_system_wide_twitter_follow_w');
		$social_master_system_wide_twitter_tweet_w = get_option('social_master_system_wide_twitter_tweet_w');
			if ($social_master_system_wide_twitter_follow_w == "true") {
				$social_master_twitter_follow_w = "150";
			}
			else{
				$social_master_twitter_follow_w = "140";
			}
			if ($social_master_system_wide_twitter_tweet_w == "true") {
				$social_master_twitter_tweet_w = "90";
			}
			else{
			$social_master_twitter_tweet_w = "85";
			}
	}
	if (!empty($social_master_system_wide_twitter_user)) {
		echo '<div style="margin-left:4px; min-width: 127px; overflow: visible !important">' .
			'<div style="float:left;">' .
			'<a class="twitter-follow-button" data-show-screen-name="false" data-show-count="false" href="https://twitter.com/'.$social_master_system_wide_twitter_user.'" ></a>' .
			'</div>'.
			'<div style="padding-left: 4px; float:left;">'.
			'<a class="twitter-share-button" href="'.$uricurrent.'" data-via="'.$social_master_system_wide_twitter_user.'"></a>'.
			'</div>'.
			'</div>';
		}
	else{
		echo '<div class="twitter-share-button" style="width: '.$social_master_twitter_tweet_w.'px !important; margin-left: 5px; z-index:10; padding-left: 4px;">' . 
			'<a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$uricurrent.'" data-via="'.$social_master_system_wide_twitter_user.'"></a>'  .
			'</div>';
	}
}
//vertical
else{
	if(is_multisite()){
		$social_master_system_wide_twitter_user = get_blog_option($blog_id, 'social_master_system_wide_twitter_user');
	}
	else{
		$social_master_system_wide_twitter_user = get_option('social_master_system_wide_twitter_user');
	}
	if (!empty($social_master_system_wide_twitter_user)) {
		echo '<div style="text-align: center; height: 20px; margin-top: 4px;">
			<a class="twitter-follow-button" data-show-count="false" data-show-screen-name="false" href="https://twitter.com/'.$social_master_system_wide_twitter_user.'"></a>
			</div>' .
			'<div style="text-align: center; height: 20px; margin-top: 4px;">' .
			'<a class="twitter-share-button" href="'.$uricurrent.'" data-via="'.$social_master_system_wide_twitter_user.'"></a>'.
			'</div>';
	}
	else{
		echo '<div style="text-align: center; height: 20px; margin-top: 4px;">' .
			'<a class="twitter-share-button" href="'.$uricurrent.'" data-via="'.$social_master_system_wide_twitter_user.'"></a>'.
			'</div>';
	}
}
?>
<script>window.twttr = (function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0],
t = window.twttr || {};
if (d.getElementById(id)) return t;
js = d.createElement(s);
js.id = id;
js.src = "https://platform.twitter.com/widgets.js";
fjs.parentNode.insertBefore(js, fjs);
t._e = [];
t.ready = function(f) {
t._e.push(f);
};
return t;
}(document, "script", "twitter-wjs"));</script>
