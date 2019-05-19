<?php
/**
 * ImpulsePress Framework functions and definitions.
  */

 /*
 * load the include files
 */

if ( ! function_exists( 'add_image_size' ) ) {
    function add_image_size() {
		add_image_size( "size-name", 780, 350, true ); // new post thumbnail size
    }
}