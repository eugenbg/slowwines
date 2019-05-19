<?php
/**
 * Single Project Template
 *
 * @file           single-project.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */
?>
<?php get_header(); ?>

<div class="container">
	<div class="row">
        <div class="col-md-12">
            <?php
                    $breadcrumbs_enabled = impulse_press_options('enable_disable_breadcrumbs','1') == '1';
                    $breadcrumbs_enabled_here = get_post_meta( $post->ID, 'ip_enable_breadcrumbs', true );
                    if($breadcrumbs_enabled && $breadcrumbs_enabled_here ) {
             ?>
                    <?php echo impulse_press_breadcrumb_lists(); ?>
             <?php } ?>
          <?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <?php endif; ?>

                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_content(); ?>
                            <?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'impulse-press') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-meta">
                            <?php edit_post_link( __( 'Edit', 'impulse-press' ), '<span class="edit-link">', '</span>' ); ?>
                        </footer><!-- .entry-meta -->
                    </article><!-- #post -->

                <?php endwhile; ?>

            </div><!-- end of col-md-12 -->

    </div>
</div><!-- end of row -->
<?php get_footer(); ?>