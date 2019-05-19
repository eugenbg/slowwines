<?php
/**
 * The template for displaying the header.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php nandi_body_schema();?> <?php body_class(); ?>>
	<?php
	/**
	 * nandi_before_header hook.
	 *
	 *
	 * @hooked nandi_do_skip_to_content_link - 2
	 * @hooked nandi_top_bar - 5
	 * @hooked nandi_add_navigation_before_header - 5
	 */
	do_action( 'nandi_before_header' );

	/**
	 * nandi_header hook.
	 *
	 *
	 * @hooked nandi_construct_header - 10
	 */
	do_action( 'nandi_header' );

	/**
	 * nandi_after_header hook.
	 *
	 *
	 * @hooked nandi_featured_page_header - 10
	 */
	do_action( 'nandi_after_header' );
	?>

	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php
			/**
			 * nandi_inside_container hook.
			 *
			 */
			do_action( 'nandi_inside_container' );
