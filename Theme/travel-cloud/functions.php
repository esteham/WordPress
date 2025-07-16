<?php
/**
 * TravelCloud theme functions and definitions
 *
 * @package TravelCloud
 */

if (!defined('TRAVELCLOUD_VERSION')) {
    define('TRAVELCLOUD_VERSION', '1.1.0'); // Updated version
}

if (!function_exists('travelcloud_setup')) :
    function travelcloud_setup() {
        // Textdomain
        load_theme_textdomain('travelcloud', get_template_directory() . '/languages');

        // Default supports
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        // Menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'travelcloud'),
            'footer'  => esc_html__('Footer Menu', 'travelcloud'),
        ));

        // HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Customizer support
        add_theme_support('customize-selective-refresh-widgets');

        // Custom logo
        add_theme_support('custom-logo', array(
            'height'      => 60,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        // WooCommerce support
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // Gutenberg support
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_editor_style('assets/css/editor-style.css');

        // Image sizes
        add_image_size('travelcloud-featured', 1200, 800, true);
        add_image_size('travelcloud-card', 400, 300, true);
    }
endif;
add_action('after_setup_theme', 'travelcloud_setup');

// Enqueue scripts and styles
function travelcloud_scripts() {
    // Theme style
    wp_enqueue_style('travelcloud-style', get_stylesheet_uri(), array(), TRAVELCLOUD_VERSION);

    // Google Fonts
    wp_enqueue_style('travelcloud-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap');

    // Font Awesome
    wp_enqueue_style('travelcloud-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

    // Customizer CSS
    wp_enqueue_style('travelcloud-customizer', get_template_directory_uri() . '/assets/css/customizer.css');

    // Main JS
    wp_enqueue_script('travelcloud-script', get_template_directory_uri() . '/assets/js/main.js', array(), TRAVELCLOUD_VERSION, true);

    // Comment Reply
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'travelcloud_scripts');

// Register widget areas
function travelcloud_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'travelcloud'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'travelcloud'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name'          => esc_html__('Footer ' . $i, 'travelcloud'),
            'id'            => 'footer-' . $i,
            'description'   => esc_html__('Add widgets here to appear in your footer.', 'travelcloud'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'travelcloud_widgets_init');

// Required files
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/widgets.php';
