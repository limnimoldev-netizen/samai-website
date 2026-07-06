<?php

/**
 * Theme Functions
 */

// Security: Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Run this function when WordPress starts.
add_action( 'init', 'samai_register_venue_post_type' );

// Create the Venue post type.
function samai_register_venue_post_type() {

    // Labels shown in the WordPress Dashboard.
    $labels = array(

        'name'          => 'Venues',          // Plural name.
        'singular_name' => 'Venue',           // Singular name.
        'menu_name'     => 'Samai Venues',    // Sidebar menu name.
        'add_new'       => 'Add New',         // Add button.
        'add_new_item'  => 'Add New Venue',   // Add page title.

    );

    // Post type settings.
    $args = array(

        'labels'       => $labels,                     // Use labels above.
        'public'       => true,                        // Publicly accessible.
        'menu_icon'    => 'dashicons-location',        // Sidebar icon.
        'supports'     => array(
            'title',      // Venue name.
            'editor',     // Description.
            'thumbnail'   // Featured image.
        ),
        'show_in_rest' => true,                        // Enable Block Editor.

    );

    // Register the Venue post type.
    register_post_type( 'samai_venue', $args );

}



