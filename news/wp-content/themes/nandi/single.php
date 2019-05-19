<?php
/**
 * The Template for displaying all single WPKoi events.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php nandi_content_class();?>>
		<main id="main" <?php nandi_main_class(); ?>>
			<?php
			/**
			 * nandi_before_main_content hook.
			 *
			 */
			do_action( 'nandi_before_main_content' );

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) :
					/**
					 * nandi_before_comments_container hook.
					 *
					 */
					do_action( 'nandi_before_comments_container' );
					?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

					<?php
				endif;

			endwhile;

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
