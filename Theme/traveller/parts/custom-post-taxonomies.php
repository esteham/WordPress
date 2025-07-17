<?php
function popular_custom_post_type() {
      
    //notice custom post
	register_post_type('popular_post',
		array(
			'labels'      => array(
				'name'          => __('Popular', 'textdomain'),
				'singular_name' => __('Popular', 'textdomain'),
			),
				'public'      => true,
				'has_archive' => true,
        'show_in_rest' => true//for gutenburg editor post
		)
	);
    //events custom post
	register_post_type('events_post',
		array(
			'labels'      => array(
				'name'          => __('Events', 'textdomain'),
				'singular_name' => __('Event', 'textdomain'),
			),
				'public'      => true,
				'has_archive' => true,
        'show_in_rest' => true//for gutenburg editor post
		)
	);
  add_post_type_support( 'events_post', array( 'thumbnail', 'comments' ) );
  add_post_type_support( 'popular_post', array( 'thumbnail', 'comments') );
    //add custom taxonomy
    register_taxonomy('location', 'events_post', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
          'name' => _x( 'Locations', 'taxonomy general name' ),
          'singular_name' => _x( 'Location', 'taxonomy singular name' ),
          'search_items' =>  __( 'Search Locations' ),
          'all_items' => __( 'All Locations' ),
          'parent_item' => __( 'Parent Location' ),
          'parent_item_colon' => __( 'Parent Location:' ),
          'edit_item' => __( 'Edit Location' ),
          'update_item' => __( 'Update Location' ),
          'add_new_item' => __( 'Add New Location' ),
          'new_item_name' => __( 'New Location Name' ),
          'menu_name' => __( 'Locations' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
          'slug' => 'locations', // This controls the base slug that will display before each term
          'with_front' => false, // Don't display the category base before "/locations/"
          'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
      ));//location taxonomy end
    
      //

    
}
add_action('init', 'popular_custom_post_type',0);



function ctc(){
          //course taxonomy start
          $labels = array(
            'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Categories', 'text_domain' ),
            'all_items'                  => __( 'All Courses', 'text_domain' ),
            'parent_item'                => __( 'Parent Course', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Course:', 'text_domain' ),
            'new_item_name'              => __( 'New Course Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Course', 'text_domain' ),
            'edit_item'                  => __( 'Edit Course', 'text_domain' ),
            'update_item'                => __( 'Update Course', 'text_domain' ),
            'view_item'                  => __( 'View Course', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate courses with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove courses', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Courses', 'text_domain' ),
            'search_items'               => __( 'Search Courses', 'text_domain' ),
            'not_found'                  => __( 'No courses found', 'text_domain' ),
            'no_terms'                   => __( 'No courses', 'text_domain' ),
            'items_list'                 => __( 'Courses list', 'text_domain' ),
            'items_list_navigation'      => __( 'Courses list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest' => true,
        );
        register_taxonomy( 'categories', array( 'events_post','popular_post' ), $args );
        register_taxonomy_for_object_type( 'course', 'post' );
}
add_action('after_setup_theme', 'ctc');



