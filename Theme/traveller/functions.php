<?php 
add_theme_support('post-thumbnails');
require get_template_directory().'/parts/class-wp-bootstrap-navwalker.php'; 
require __DIR__."/parts/carousel.php";
require __DIR__."/parts/custom-post-taxonomies.php";
require 'add-to-functions.php';
?>
<?php
function itbari_wp_widget_areas() {
	register_sidebar( array(
		'name' => __( 'Right Menu 2', 'itbari' ),
		'id' => 'right_sidebar2',
		'before_widget' => '<div class="single_sidebar">',
		'after_widget' => '</div>',
	    'before_title' => '<h2>',
	    'after_title' => '</h2>',
	) );
}
add_action('widgets_init', 'itbari_wp_widget_areas');
?>