<?php
// Destination Custom Post Type
function travelcloud_register_destination_post_type() {
    $labels = array(
        'name' => __('Destinations', 'travelcloud'),
        'singular_name' => __('Destination', 'travelcloud'),
        'menu_name' => __('Destinations', 'travelcloud'),
        'name_admin_bar' => __('Destination', 'travelcloud'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'menu_icon' => 'dashicons-location-alt',
        'rewrite' => array('slug' => 'destinations'),
        'show_in_rest' => true,
    );

    register_post_type('destination', $args);

    // Destination Type Taxonomy
    $tax_labels = array(
        'name' => __('Destination Types', 'travelcloud'),
        'singular_name' => __('Destination Type', 'travelcloud'),
    );

    register_taxonomy('destination_type', 'destination', array(
        'labels' => $tax_labels,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'destination-type'),
    ));
}
add_action('init', 'travelcloud_register_destination_post_type');

// Testimonial Custom Post Type
function travelcloud_register_testimonial_post_type() {
    $labels = array(
        'name' => __('Testimonials', 'travelcloud'),
        'singular_name' => __('Testimonial', 'travelcloud'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-testimonial',
        'exclude_from_search' => true,
        'publicly_queryable' => false,
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'travelcloud_register_testimonial_post_type');