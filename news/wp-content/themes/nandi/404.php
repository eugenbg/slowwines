<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php nandi_content_class(); ?>>
		<main id="main" <?php nandi_main_class(); ?>>
			<?php
			/**
			 * nandi_before_main_content hook.
			 *
			 */
			do_action( 'nandi_before_main_content' );
			?>

			<div class="inside-article">

				<?php
				/**
				 * nandi_before_content hook.
				 *
				 *
				 * @hooked nandi_featured_page_header_inside_single - 10
				 */
				do_action( 'nandi_before_content' );
				?>

				<header class="entry-header">
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'nandi_404_title', __( 'Oops! That page can&rsquo;t be found.', 'nandi' ) ); // WPCS: XSS OK. ?></h1>
				</header><!-- .entry-header -->

				<?php
				/**
				 * nandi_after_entry_header hook.
				 *
				 *
				 * @hooked nandi_post_image - 10
				 */
				do_action( 'nandi_after_entry_header' );
				?>

				<div class="entry-content" itemprop="text">
					<?php
					echo '<p>' . apply_filters( 'nandi_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'nandi' ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * nandi_after_content hook.
				 *
				 */
				do_action( 'nandi_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
			/**
			 * nandi_after_main_content hook.
			 *
			 */
			do_action( 'nandi_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * nandi_after_primary_content_area hook.
	 *
	 */
	 do_action( 'nandi_after_primary_content_area' );

	 nandi_construct_sidebars();

get_footer();
