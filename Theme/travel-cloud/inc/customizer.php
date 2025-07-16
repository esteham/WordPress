<?php

function travelcloud_customize_register($wp_customize) {
    // Color Scheme Section
    $wp_customize->add_section('travelcloud_colors', array(
        'title' => __('Color Scheme', 'travelcloud'),
        'priority' => 30,
    ));

    // Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#3498db',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'travelcloud'),
        'section' => 'travelcloud_colors',
        'settings' => 'primary_color',
    )));

    // Header Settings Section
    $wp_customize->add_section('travelcloud_header', array(
        'title' => __('Header Settings', 'travelcloud'),
        'priority' => 35,
    ));

    // Sticky Header
    $wp_customize->add_setting('sticky_header', array(
        'default' => true,
        'sanitize_callback' => 'travelcloud_sanitize_checkbox',
    ));

    $wp_customize->add_control('sticky_header', array(
        'label' => __('Enable Sticky Header', 'travelcloud'),
        'section' => 'travelcloud_header',
        'type' => 'checkbox',
    ));

    // Footer Settings Section
    $wp_customize->add_section('travelcloud_footer', array(
        'title' => __('Footer Settings', 'travelcloud'),
        'priority' => 40,
    ));

    // Footer Copyright Text
    $wp_customize->add_setting('footer_text', array(
        'default' => '&copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_text', array(
        'label' => __('Footer Text', 'travelcloud'),
        'section' => 'travelcloud_footer',
        'type' => 'textarea',
    ));

    // Blog Layout Section
    $wp_customize->add_section('travelcloud_blog', array(
        'title' => __('Blog Settings', 'travelcloud'),
        'priority' => 45,
    ));

    // Blog Layout
    $wp_customize->add_setting('blog_layout', array(
        'default' => 'grid',
        'sanitize_callback' => 'travelcloud_sanitize_select',
    ));

    $wp_customize->add_control('blog_layout', array(
        'label' => __('Blog Layout', 'travelcloud'),
        'section' => 'travelcloud_blog',
        'type' => 'select',
        'choices' => array(
            'grid' => __('Grid Layout', 'travelcloud'),
            'list' => __('List Layout', 'travelcloud'),
        ),
    ));
}

function travelcloud_sanitize_checkbox($input) {
    return (isset($input) && true === $input ? true : false);
}

function travelcloud_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

add_action('customize_register', 'travelcloud_customize_register');

// Output customizer CSS
function travelcloud_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr(get_theme_mod('primary_color', '#3498db')); ?>;
        }
        
        a, .read-more, .main-navigation a:hover {
            color: var(--primary-color);
        }
        
        .read-more, .button-primary {
            background-color: var(--primary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'travelcloud_customizer_css');
