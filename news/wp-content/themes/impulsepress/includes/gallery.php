<?php


add_image_size('featured_preview', 150, 150, true);

// GET POST IMAGES

function get_one_image($post_ID) {
    $thumb_ID = get_post_thumbnail_id( $post_ID );
    if ($images = get_posts(array(
		'post_parent' => $post_ID,
		'post_type' => 'attachment',
		'numberposts' => -1,
		'orderby'        => 'title',
		'order'           => 'ASC',
		'post_mime_type' => 'image',
		'exclude' => $thumb_ID,
		))) {

        return $images[0];
    } else {
       return get_featured_image($post_ID);
    }

}

// GET FEATURED IMAGE
function get_featured_image($post_ID)
{
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function columns_head($defaults)
{
    $defaults['featured_image'] = 'Image';
    return $defaults;
}

// SHOW THE FEATURED IMAGE
function columns_content($column_name, $post_ID)
{
    if ($column_name == 'featured_image') {
        $post_featured_image = get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" width="200" height="200"/>';
        }
    }
}

// ONLY WORDPRESS DEFAULT PAGES
add_filter('manage_gallery_posts_columns', 'columns_head', 10);
add_action('manage_gallery_posts_custom_column', 'columns_content', 10, 2);




// Overriding the gallery shortcode
remove_shortcode('gallery');
add_shortcode('gallery', 'gallery_shortcode_custom');

/**
 * The Gallery shortcode.
 *
 * This function overrides the default gallery shortcode and implements a masonry gallery with a touch enabled view gallery
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function gallery_shortcode_custom($atts) {

	global $post;

    if ( ! empty( $atts['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $atts['orderby'] ) )
            $atts['orderby'] = 'post__in';
        $atts['include'] = $atts['ids'];
    }

    extract(shortcode_atts(array(
        'orderby' => 'menu_order ASC, ID ASC',
        'include' => '',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'medium',
        'link' => 'file',
        'type' => 'lightbox'
    ), $atts));


    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'orderby' => $orderby
    );

    if ( !empty($include) )
        $args['include'] = $include;
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }

    if ( $type == 'masonry' ) {
        $output =  generateMasonryGallery($columns, $args);
    } elseif ($type == 'carousel') {
        $output =  generateBlueimpCarouselGallery( $args );
    }

    return $output;

}

function generateMasonryGallery($columns, $args)
{ // generate the thumbnails
    static $blueimp_included = false;

    $style = '<style type="text/css">';
    $style .= '.masonry .item, .masonry .grid-sizer {';

    $percent = 100 / $columns;
    $style .= 'width:  ' . $percent . '%;';
    $style .= '}';
    $style .= '</style>';
    $output = $style;
    $output .= '<div class="masonry-container masonry">';

    $output .= '<div class="grid-sizer"></div>';
    $images = get_posts($args);
    $i = 0;
    foreach ($images as $image) {
        $image_attributes = wp_get_attachment_image_src($image->ID, 'large', false); // returns an array
        $thumb_url = $image_attributes[0];
        $image_attributes = wp_get_attachment_image_src($image->ID, 'full', false); // returns an array
        $image_url = $image_attributes[0];
        $resized = false;
        $output .= '<a class="item" data-index="' . $i . '"  href="' . $image_url . '">';

        $output .= '<img src="' . $thumb_url . '">';
        $output .= '</a>';

        $i++;
    }

    $output .= '</div>';

    if ( ! $blueimp_included ) {
        $blueimp_included = true;
        $output .= '
        <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery">
            <!-- The container for the modal slides -->
            <div class="slides">


            </div>
            <!-- Controls for the borderless lightbox -->
            <h3 class="title"></h3>
            <a class="prev">&lsaquo;</a>
            <a class="next">&rsaquo;</a>
            <a class="close"><i class="fa fa-2x fa-remove"></i></a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
            <!-- The modal dialog, which will be used to wrap the lightbox content -->
            <div class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body next"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left prev">
                                <i class="fa fa-chevron-sign-left"></i>
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Next
                                <i class="fa fa-chevron-sign-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    wp_enqueue_script(
        'impulse-press-gallery',
        impulse_press_directory_uri() . '/js/gallery_shortcode.js',
        array( 'masonry' ),
        false,
        true
    );

    return $output;
}

function generateBlueimpCarouselGallery( $args ) {
    static $id = 0;

    $output = '<div class="gallery-carousel">';
    $images = get_posts($args);
    $i = 0;
    foreach ($images as $image) {
        $image_attributes = wp_get_attachment_image_src($image->ID, 'large', false); // returns an array
        $thumb_url = $image_attributes[0];
        $image_attributes = wp_get_attachment_image_src($image->ID, 'full', false); // returns an array
        $image_url = $image_attributes[0];

        $output .= '<a class="item"  href="' . $image_url . '">';
        $output .= '<img src="' . $thumb_url . '">';
        $output .= '</a>';

        $i++;
    }

    $output .= '
        <div id="blueimp-gallery-carousel-' . $id++ . '" class="blueimp-gallery blueimp-gallery-carousel">
            <div class="slides">
            </div>
            <h3 class="title"></h3>
            <a class="prev">&lsaquo;</a>
            <a class="next">&rsaquo;</a>
            <a class="play-pause"></a>
        </div>';

    $output .= '</div>';

    wp_enqueue_script(
        'impulse-press-gallery',
        impulse_press_directory_uri() . '/js/gallery_shortcode.js',
        array( 'masonry' ),
        false,
        true
    );

    return $output;
}

function generateBootstrapCarouselGallery($columns, $args)
{

    $images = get_posts($args);
    $output = '<div id="myCarousel" class="carousel slide">';


    $output .= '<ol class="carousel-indicators">';
    $i = 0;
    foreach ($images as $image) {
       $output .= '<li data-target="#myCarousel" data-slide-to="'.$i.'">';
       $output .= '</li>';
       $i++;
    }
    $output .= '</ol>';

    $output .= '<div class="carousel-inner">';

    $i = 0;
    foreach ($images as $image) {
        $output = '<div class="carousel-inner">';
        $image_attributes = wp_get_attachment_image_src($image->ID, 'full', false); // returns an array
        $image_url = $image_attributes[0];
        $output .= '<img src="' . $image_url . '">';
        $output .= '</div>';
        $i++;
    }

    $output .= '</div>';

    $output .= '</div>';
    return $output;
}

