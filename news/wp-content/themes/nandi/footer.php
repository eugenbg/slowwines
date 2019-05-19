<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * nandi_before_footer hook.
 *
 */
do_action( 'nandi_before_footer' );
?>

<div <?php nandi_footer_class(); ?>>
	<?php
	/**
	 * nandi_before_footer_content hook.
	 *
	 */
	do_action( 'nandi_before_footer_content' );

	/**
	 * nandi_footer hook.
	 *
	 *
	 * @hooked nandi_construct_footer_widgets - 5
	 * @hooked nandi_construct_footer - 10
	 */
	do_action( 'nandi_footer' );

	/**
	 * nandi_after_footer_content hook.
	 *
	 */
	do_action( 'nandi_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * nandi_after_footer hook.
 *
 */
do_action( 'nandi_after_footer' );

wp_footer();
?>

</body>
</html>
