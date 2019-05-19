<?php global $portfolio_cols ?>
<div class="container">
<?php
   if ( post_password_required( $post ) ) {
		echo  get_the_password_form( $post );
     } else { ?>
    <div class="row">
        <div class="col-lg-12">
            <?php
                    $breadcrumbs_enabled = impulse_press_options('enable_disable_breadcrumbs','1') == '1';
                    $breadcrumbs_enabled_here = get_post_meta( $post->ID, 'ip_enable_breadcrumbs', true );
                    if($breadcrumbs_enabled && $breadcrumbs_enabled_here ) {
             ?>
                    <?php echo impulse_press_breadcrumb_lists(); ?>
             <?php } ?>
            <div id="portfolio-filter" data-toggle="buttons-radio" class="btn-group">
            <?php
                $terms = get_terms("tagportfolio");
                $count = count($terms);
                echo '<a title="" data-filter="*" href="#all" class="btn btn-default btn-small active">Show All</a>';
                if ($count > 0) {
                    foreach ($terms as $term) {
                        $termname = strtolower($term->name);
                        $termname = str_replace(' ', '-', $termname);
                        echo '<a class="btn btn-default btn-small" rel="' . $termname . '" title="' . $termname . '" href="#' . $termname . '" data-filter=".' . $termname . '">' . $termname . '</a>';
                    }
                }

                $loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
                $count = 0;
            ?>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="portfolio-wrapper">
                <ul id="portfolio-list" class="thumbnails">
                    <?php if ($loop) :

                    while ($loop->have_posts()) : $loop->the_post(); ?>

                        <?php
                             $terms = get_the_terms($post->ID, 'tagportfolio');
                            if ($terms && !is_wp_error($terms)) :
                                $links = array();

                                foreach ($terms as $term) {
                                    $links[] = $term->name;
                                }
                                $links = str_replace(' ', '-', $links);
                                $tax = join(" ", $links);
                            else :
                                $tax = '';
                            endif;
                        ?>

                        <?php $infos = get_post_custom_values('_url'); ?>

                       <div class="item portfolio-item  <?php echo $portfolio_cols ?> <?php echo strtolower($tax) ?>">

                            <div class="thumb">
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                            </div>
                            <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

                            <p class="excerpt">
                                <a href="<?php the_permalink() ?>"><?php echo get_the_excerpt(); ?></a>
                            </p>

                            <p class="links"><a href="<?php echo $infos[0]; ?>" target="_blank">Live Preview
                                →</a> <a href="<?php the_permalink() ?>">More Details →</a>
                            </p>

                        </div>


                        <?php endwhile; else: ?>

                    <div class="error-not-found">Sorry, no portfolio entries for while.</div>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

  <?php } ?>
</div>

<script>
    jQuery(document).ready(function() {
        // cache container
        var $container = $('#portfolio-list');

        // initialize isotope
        $container.imagesLoaded(function() {
            $container.isotope({
                itemSelector : '.item',
                layoutMode : 'fitRows',
                masonry : {
                    columnWidth : 25
                }
            });
        });

        // filter items when filter link is clicked
        $('#portfolio-filter a').click(function() {
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector });

            $('#portfolio-filter a').removeClass('active');
            $(this).addClass('active');
            return false;
        });
    });
</script>

