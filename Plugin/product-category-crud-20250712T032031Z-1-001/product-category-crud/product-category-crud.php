<?php
/*
Plugin Name: Product Category CRUD
Description: A plugin to manage products and categories with full CRUD, AJAX, and shortcode display.
Version: 1.0
Author: Amanur Rahman
*/

defined('ABSPATH') || exit;

register_activation_hook(__FILE__, 'pcc_create_tables');

function pcc_create_tables() 
{
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $cat_table = $wpdb->prefix . 'pcc_categories';
    $product_table = $wpdb->prefix . 'pcc_products';

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql1 = "CREATE TABLE $cat_table (
        id INT NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(100) NOT NULL,
        PRIMARY KEY(id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $product_table (
        id INT NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(100) NOT NULL,
        description TEXT,
        unit_price DECIMAL(10,2),
        selling_price DECIMAL(10,2),
        image VARCHAR(255),
        total_stock INT DEFAULT 0,
        category_id INT,
        PRIMARY KEY(id),
        FOREIGN KEY (category_id) REFERENCES $cat_table(id) ON DELETE CASCADE
    ) $charset_collate;";

    dbDelta($sql1);
    dbDelta($sql2);
}

// Admin menu
add_action('admin_menu', 'pcc_admin_menu');
function pcc_admin_menu() 
{
    add_menu_page('Product Manager', 'Product Manager', 'manage_options', 'pcc-manager', 'pcc_admin_page', 'dashicons-cart');
}

// Enqueue scripts
add_action('admin_enqueue_scripts', 'pcc_admin_scripts');
add_action('wp_enqueue_scripts', 'pcc_frontend_scripts');

function pcc_admin_scripts($hook) 
{
    if ($hook != 'toplevel_page_pcc-manager') return;

   // ✅ Add this line to ensure jQuery loads
    wp_enqueue_script('jquery');

    wp_enqueue_style('bootstrap-css', plugin_dir_url(__FILE__) . 'assets/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', plugin_dir_url(__FILE__) . 'assets/bootstrap.bundle.min.js', ['jquery'], null, true);

    wp_enqueue_script('pcc-admin-js', plugin_dir_url(__FILE__) . 'js/admin.js', ['jquery'], null, true);
    wp_localize_script('pcc-admin-js', 'pcc_ajax', ['ajaxurl' => admin_url('admin-ajax.php')]);

}

// Frontend shortcode
add_shortcode('pcc_products', 'pcc_frontend_products');
function pcc_frontend_products() 
{
    ob_start();
    include plugin_dir_path(__FILE__) . 'frontend/products.php';
    return ob_get_clean();
}

function pcc_frontend_scripts() 
{
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.bundle.min.js', ['jquery'], null, true);

    wp_enqueue_script('pcc-frontend-js', plugin_dir_url(__FILE__) . 'js/frontend.js', ['jquery'], null, true);
    wp_localize_script('pcc-frontend-js', 'pcc_ajax', ['ajaxurl' => admin_url('admin-ajax.php')]);
}

// Include Admin Page
function pcc_admin_page() 
{
    include plugin_dir_path(__FILE__) . 'admin/admin.php';
}

// AJAX handlers (you'll create files inside /ajax/ folder)
include plugin_dir_path(__FILE__) . 'ajax/category-actions.php';
include plugin_dir_path(__FILE__) . 'ajax/product-actions.php';
include plugin_dir_path(__FILE__) . 'ajax/frontend-actions.php';
