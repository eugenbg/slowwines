<?php
/**
 * Utilities for the Impulse Press framework
 *
 * @file           utilities.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 0.1
 */

function impulse_press_display_rss_feed($title, $url) {
     echo ' <div class="postbox" style="padding: 5px;">';
    echo '<h3>'.$title .'</h3>';

    // Get a SimplePie feed object from the specified feed source.
    $rss = fetch_feed( $url );

    if ( ! is_wp_error( $rss ) ) { // Checks that the object is created correctly

        // Figure out how many total items there are, but limit it to 5.
        $maxitems = $rss->get_item_quantity( 5 );

        // Build an array of all the items, starting with element 0 (first element).
        $rss_items = $rss->get_items( 0, $maxitems );
    }


    if ( $maxitems == 0 ) {
        echo '<li style="padding: 5px;">'. __( 'No items', 'impulse-press' ). '</li>';
    } else {
        // Loop through each feed item and display each item as a hyperlink.
        foreach ( $rss_items as $item ) {
          echo ' <div class="rss-widget">';
          echo '<ul style="padding: 5px;"> ';
           echo '<li> ';
           echo '<a class="rss-widget" href="' . esc_url( $item->get_permalink() ) . '"title="' . printf( __( 'Posted %s', 'impulse-press' ), $item->get_date('j F Y | g:i a') ). ' "><br>';
           echo esc_html( $item->get_title() );
           echo '</a>';
           echo '</li>';
             echo '</ul> ';
             echo '</div> ';
        }


    }

      echo '</div> ';
}


 
