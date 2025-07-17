<?php
//create section
//create setting to store the values
//create control to show the controls to the user
function my_theme_customize_register( $wp_customize ) {
    //theme colors start
    $wp_customize->add_section( 'my_theme_colors_section', array(
        'title'       => __( 'Theme Colors', 'my_theme' ),
        'priority'    => 30,
        'description' => 'Customize theme Colors.',
    ) );
    $wp_customize->add_setting( 'my_theme_background_color', array(
        'default'           => '#ffffff', // Set a default background color
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage', // Allows live preview of the color change
    ) );

    // Text color setting
    $wp_customize->add_setting( 'my_theme_text_color', array(
        'default'           => '#333333', // Set a default text color
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    // Add control for background color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'my_theme_background_color', array(
        'label'    => __( 'Background Color', 'my_theme' ),
        'section'  => 'my_theme_colors_section', // Customize section to add the control to
    ) ) );

    // Add control for text color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'my_theme_text_color', array(
        'label'    => __( 'Text Color', 'my_theme' ),
        'section'  => 'my_theme_colors_section', // Customize section to add the control to
    ) ) );


//theme colors end




    //carousel
    $wp_customize->add_section( 'my_theme_carousel_section', array(
        'title'       => __( 'Carousel Images', 'my_theme' ),
        'priority'    => 30,
        'description' => 'Upload images for the carousel on the front page.',
    ) );

    $wp_customize->add_setting( 'my_theme_carousel_image_1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'my_theme_carousel_image_1', array(
        'label'    => __( 'Carousel Image 1', 'my_theme' ),
        'section'  => 'my_theme_carousel_section',
        'settings' => 'my_theme_carousel_image_1',
    ) ) ); 
/*     $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'my_theme_carousel_image_1', array(
        'label'       => __( 'Carousel Image 1', 'my_theme' ),
        'section'     => 'my_theme_carousel_section',
        'settings'    => 'my_theme_carousel_image_1',
        'width'       => 1600,
        'height'      => 900,
        'flex_width'  => true,
        'flex_height' => true,
    ) ) ); */
    $wp_customize->add_setting( 'my_theme_carousel_image_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'my_theme_carousel_image_2', array(
        'label'    => __( 'Carousel Image 2', 'my_theme' ),
        'section'  => 'my_theme_carousel_section',
        'settings' => 'my_theme_carousel_image_2',
    ) ) );
    $wp_customize->add_setting( 'my_theme_carousel_image_3', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'my_theme_carousel_image_3', array(
        'label'    => __( 'Carousel Image 3', 'my_theme' ),
        'section'  => 'my_theme_carousel_section',
        'settings' => 'my_theme_carousel_image_3',
    ) ) );

    // Repeat for carousel_image_2 and carousel_image_3
}
//hook
add_action( 'customize_register', 'my_theme_customize_register' );





function my_theme_customize_preview_js() {
    wp_enqueue_script( 'my-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'my_theme_customize_preview_js' );


function my_theme_customize_controls_enqueue_scripts() {
    wp_enqueue_script( 'my-theme-cropped-image-control', get_template_directory_uri() . '/js/cropped-image-control.js', array( 'customize-controls' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'my_theme_customize_controls_enqueue_scripts' );