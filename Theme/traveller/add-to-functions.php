<?php
require get_template_directory().'/parts/class-wp-bootstrap-navwalker.php';
add_theme_support( 'menus' );
//action hook
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			//'secondary-menu' => __( 'Secondary Menu' ),
			//'sidebar-menu' => __( 'Sidebar Menu' )
		)
	);
}