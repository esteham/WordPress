<?php
// Add theme options page
function travelcloud_theme_menu() {
    add_theme_page('TravelCloud Options', 'Theme Options', 'manage_options', 'travelcloud-options', 'travelcloud_theme_options_page');
}
add_action('admin_menu', 'travelcloud_theme_menu');

// Theme options page content
function travelcloud_theme_options_page() {
    ?>
    <div class="wrap">
        <h1>TravelCloud Theme Options</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('travelcloud_options');
            do_settings_sections('travelcloud-options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Initialize theme options
function travelcloud_theme_options_init() {
    register_setting('travelcloud_options', 'travelcloud_options');
    
    // Social Media Section
    add_settings_section(
        'travelcloud_social',
        __('Social Media Links', 'travelcloud'),
        'travelcloud_social_section_text',
        'travelcloud-options'
    );
    
    // Social fields
    $social_platforms = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'pinterest' => 'Pinterest',
        'youtube' => 'YouTube'
    );
    
    foreach ($social_platforms as $id => $label) {
        add_settings_field(
            'travelcloud_' . $id,
            $label,
            'travelcloud_social_field',
            'travelcloud-options',
            'travelcloud_social',
            array('id' => $id)
        );
    }
    
    // Contact Information Section
    add_settings_section(
        'travelcloud_contact',
        __('Contact Information', 'travelcloud'),
        'travelcloud_contact_section_text',
        'travelcloud-options'
    );
    
    add_settings_field(
        'travelcloud_phone',
        __('Phone Number', 'travelcloud'),
        'travelcloud_text_field',
        'travelcloud-options',
        'travelcloud_contact',
        array('id' => 'phone')
    );
    
    add_settings_field(
        'travelcloud_email',
        __('Email Address', 'travelcloud'),
        'travelcloud_text_field',
        'travelcloud-options',
        'travelcloud_contact',
        array('id' => 'email')
    );
    
    add_settings_field(
        'travelcloud_address',
        __('Physical Address', 'travelcloud'),
        'travelcloud_textarea_field',
        'travelcloud-options',
        'travelcloud_contact',
        array('id' => 'address')
    );
}
add_action('admin_init', 'travelcloud_theme_options_init');

// Section text callbacks
function travelcloud_social_section_text() {
    echo '<p>' . __('Enter your social media profile URLs', 'travelcloud') . '</p>';
}

function travelcloud_contact_section_text() {
    echo '<p>' . __('Enter your contact information', 'travelcloud') . '</p>';
}

// Field callbacks
function travelcloud_social_field($args) {
    $options = get_option('travelcloud_options');
    $value = isset($options[$args['id']]) ? esc_url($options[$args['id']]) : '';
    echo '<input type="url" id="travelcloud_' . $args['id'] . '" name="travelcloud_options[' . $args['id'] . ']" value="' . $value . '" class="regular-text" />';
}

function travelcloud_text_field($args) {
    $options = get_option('travelcloud_options');
    $value = isset($options[$args['id']]) ? esc_attr($options[$args['id']]) : '';
    echo '<input type="text" id="travelcloud_' . $args['id'] . '" name="travelcloud_options[' . $args['id'] . ']" value="' . $value . '" class="regular-text" />';
}

function travelcloud_textarea_field($args) {
    $options = get_option('travelcloud_options');
    $value = isset($options[$args['id']]) ? esc_textarea($options[$args['id']]) : '';
    echo '<textarea id="travelcloud_' . $args['id'] . '" name="travelcloud_options[' . $args['id'] . ']" rows="3" class="large-text">' . $value . '</textarea>';
}

// Display social icons in theme
function travelcloud_display_social_icons() {
    $options = get_option('travelcloud_options');
    $social_platforms = array('facebook', 'twitter', 'instagram', 'pinterest', 'youtube');
    
    echo '<div class="social-icons">';
    foreach ($social_platforms as $platform) {
        if (!empty($options[$platform])) {
            echo '<a href="' . esc_url($options[$platform]) . '" target="_blank" rel="noopener noreferrer"><i class="fab fa-' . esc_attr($platform) . '"></i></a>';
        }
    }
    echo '</div>';
}