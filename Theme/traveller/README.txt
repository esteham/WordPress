works for bootstrap 5.3.x
1. add 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> and 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
in your theme for bootstrap 5 support.

2. append add-to-functions.php code in your theme functions.php file
```
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
```

3. add get_template_part("nav"); in your front-page.php or home.php or index.php