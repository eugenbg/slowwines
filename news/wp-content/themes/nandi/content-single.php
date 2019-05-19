<?php
/**
 * The template for displaying single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php nandi_article_schema( 'CreativeWork' ); ?>>
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
			<?php
			/**
			 * nandi_before_entry_title hook.
			 *
			 */
			do_action( 'nandi_before_entry_title' );

			if ( nandi_show_title() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			}

			/**
			 * nandi_after_entry_title hook.
			 *
			 *
			 * @hooked nandi_post_meta - 10
			 */
			do_action( 'nandi_after_entry_title' );
			?>
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
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'nandi' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * nandi_after_entry_content hook.
		 *
		 *
		 * @hooked nandi_footer_meta - 10
		 */
		do_action( 'nandi_after_entry_content' );

		/**
		 * nandi_after_content hook.
		 *
		 */
		do_action( 'nandi_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
