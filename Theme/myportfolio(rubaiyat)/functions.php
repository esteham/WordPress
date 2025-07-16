<?php
// Enqueue Bootstrap CSS & JS and Main stylesheet
function theme_resource() {
    // Bootstrap 5 CSS from CDN
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

    // Main theme stylesheet (style.css)
    wp_enqueue_style('style', get_stylesheet_uri());

    // Bootstrap JS Bundle (includes Popper)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'theme_resource');


// Register Navigation Menus
function theme_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'portfolioTheme'),
        'top'     => __('Top Menu', 'portfolioTheme'),
        'footer'  => __('Footer Menu', 'portfolioTheme'),
    ));
}
add_action('after_setup_theme', 'theme_register_menus');


// Enable post thumbnails and set thumbnail size
function theme_setup() {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 9999);

    // Custom Header support with default image
    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . '/header.jpg',
        'uploads'       => true,
    ));
}
add_action('after_setup_theme', 'theme_setup');


// Register Sidebar
function theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'portfolioTheme'),
        'id'            => 'sidebar-1',
        'description'   => __('Main Sidebar Area', 'portfolioTheme'),
        'before_widget' => '<div class="mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="fw-bold">',
        'after_title'   => '</h4>',
    ));

    // Register 3 footer widget areas dynamically
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name'          => esc_html__("Footer $i", 'portfolioTheme'),
            'id'            => "footer$i",
            'description'   => esc_html__("Footer column $i widget area", 'portfolioTheme'),
            'before_widget' => '<div class="mb-4">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="fw-bold">',
            'after_title'   => '</h5>',
        ));
    }
}
add_action('widgets_init', 'theme_widgets_init');
?>
