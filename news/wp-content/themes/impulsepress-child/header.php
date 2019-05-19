<?php
/**
* The header template file
*
* @file           header.php
* @package        Impulse Press
* @author         Two Impulse
* @copyright      2014 Two Impulse
* @license        license.txt
* @version        Release: 1.3
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<title>
		<?php wp_title('&#124;', true, 'right'); ?>
	</title>
	<?php
	if(impulse_press_options('custom_favicon') !== '')
	{
		?>
		<link rel="icon" type="image/png" href="<?php echo impulse_press_options('custom_favicon'); ?>"/>
		<?php
	}
	else
	{
		?>
		<link rel="shortcut icon" href="<?php echo impulse_press_directory_uri(); ?>/favicon.png"/>
		<?php
	}  ?>

	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo impulse_press_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo impulse_press_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>"/>

	<?php echo impulse_press_options('tracking_header'); ?>

</head>

<body <?php body_class(); ?>>

	<div id="wrap">
	<header id="q23Head">
	</header>