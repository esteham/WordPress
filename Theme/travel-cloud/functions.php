<?php
/**
 * TravelCloud theme functions and definitions
 *
 * @package TravelCloud
 */

if (!defined('TRAVELCLOUD_VERSION')) {
    define('TRAVELCLOUD_VERSION', '1.0.0');
}

if (!function_exists('travelcloud_setup')) :
    function travelcloud_setup() {
        load_theme_textdomain('travelcloud', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        // Register menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'travelcloud'),
            'footer' => esc_html__('Footer Menu', 'travelcloud'),
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'height' => 60,
            'width' => 200,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'travelcloud_setup');

/**
 * Enqueue scripts and styles.
 */
function travelcloud_scripts() {
    // Theme stylesheet
    wp_enqueue_style('travelcloud-style', get_stylesheet_uri(), array(), TRAVELCLOUD_VERSION);
    
    // Main JavaScript file
    wp_enqueue_script('travelcloud-script', get_template_directory_uri() . '/assets/js/main.js', array(), TRAVELCLOUD_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'travelcloud_scripts');

/**
 * Register widget areas.
 */
function travelcloud_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'travelcloud'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'travelcloud'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'travelcloud'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here to appear in your footer.', 'travelcloud'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'travelcloud'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here to appear in your footer.', 'travelcloud'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'travelcloud'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here to appear in your footer.', 'travelcloud'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'travelcloud_widgets_init');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';