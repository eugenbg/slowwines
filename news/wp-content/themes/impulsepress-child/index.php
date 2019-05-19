<?php
/**
*
* @file           index.php
* @package        Impulse Press
* @author         Two Impulse
* @copyright      2014 Two Impulse
* @license        license.txt
* @version        Release: 1.3
*/
?>
<?php get_header(); ?>

<!--TODO add option for posts per page -->
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="row">
					<!-- Start the Loop. -->
					<?php
					if(have_posts()) : ?>

					<?php while(have_posts()) : the_post(); ?>

					<div class="col-lg-6">

						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="post-entry spacer25">
								<div class="post-image">
									<?php
									if( has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
										<?php the_post_thumbnail("size-name"); ?>
									</a>
									<?php endif; ?>
								</div>
								<!-- end of post-image -->

								<div class="post-intro ">
									<h3 class="post-title">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'impulse-press'), the_title_attribute('echo=0')); ?>">
											<?php the_title(); ?>
										</a>
									</h3>

									<?php
									if( impulse_press_options('enable_disable_meta','1') == '1')
									{
										?>
										<div class="post-meta">
											<?php
											// TODO this code is ugly
											printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'impulse-press' ),
												esc_url( get_permalink() ),
												esc_attr( get_the_time() ),
												esc_attr( get_the_date( 'c' ) ),
												esc_html( get_the_date() ),
												esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
												esc_attr( sprintf( __( 'View all posts by %s', 'impulse-press' ), get_the_author() ) ),
												get_the_author()
											);
											?>
											<?php
											if( comments_open() ) : ?>
											<span class="comments-link">
												<span class="mdash">
													&mdash;
												</span>
												<?php comments_popup_link(__('No Comments <i class="fa fa-arrow-down"></i>', 'impulse-press'), __('1 Comment <i class="icon-arrow-down"></i>', 'impulse-press'), __('% Comments <i class="icon-arrow-down"></i>', 'impulse-press')); ?>
											</span>
											<?php endif; ?>
										</div><!-- end of .post-meta -->
										<?php
									} ?>

									<div class="post-excerpt spacer10">
										<?php the_excerpt(); ?>
										<a href="<?php echo get_permalink(); ?>">
											<button type="button" class="readmore btn btn-default">
												<?php echo impulse_press_options('read_more_text','Read more...')?>
											</button>
										</a>
									</div>
								</div>
							</div>  <!-- end of .post-entry -->
						</div>
						<div class="post-edit">
							<?php edit_post_link(__('Edit', 'impulse-press')); ?>
						</div>
					</div><!-- end of #post-<?php the_ID(); ?> -->

					<?php endwhile; ?>

					<?php
					if($wp_query->max_num_pages > 1) : ?>

					<div class="navigation">
						<div class="previous">
							<?php next_posts_link(__('&#8249; Older posts', 'impulse-press')); ?>
						</div>
						<div class="next">
							<?php previous_posts_link(__('Newer posts &#8250;', 'impulse-press')); ?>
						</div>
					</div><!-- end of .navigation -->
					<?php endif; ?>
					<?php endif; ?>

				</div><!-- end of #col-lg-8 -->
			</div>
			<div class="col-sm-4">
				<div id="widgets">
					<?php
					if( dynamic_sidebar('sidebar-right') ) :
					else : endif; ?>
				</div>
			</div><!-- end of col-lg-4 -->

		</div><!-- end of row -->
	</div>
</section>

<?php get_footer(); ?>