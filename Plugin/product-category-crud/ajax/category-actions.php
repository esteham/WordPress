<?php
add_action('wp_ajax_pcc_add_category', 'pcc_add_category');
add_action('wp_ajax_pcc_get_categories', 'pcc_get_categories');
add_action('wp_ajax_pcc_delete_category', 'pcc_delete_category');

function pcc_add_category() 
{
    global $wpdb;
    $table = $wpdb->prefix . 'pcc_categories';

    $name = sanitize_text_field($_POST['category_name']);

    if (empty($name)) 
    {
        wp_send_json_error('Category name is required.');
    }

    $wpdb->insert($table, ['category_name' => $name]);

    wp_send_json_success('Category added successfully.');
}

function pcc_get_categories() 
{
    global $wpdb;
    $table = $wpdb->prefix . 'pcc_categories';

    $categories = $wpdb->get_results("SELECT * FROM $table");

    ob_start();
    foreach ($categories as $index => $cat) 
    {
        echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td>" . esc_html($cat->category_name) . "</td>

            <td><button class='btn btn-sm btn-warning edit-category' data-id='{$cat->id}'>Edit</button></td>
            <td><button class='btn btn-sm btn-danger delete-category' data-id='{$cat->id}'>Delete</button></td>
        </tr>";
    }
    $output = ob_get_clean();

    wp_send_json_success($output);
}

function pcc_delete_category() 
{
    global $wpdb;
    $table = $wpdb->prefix . 'pcc_categories';
    $id = intval($_POST['id']);

    $wpdb->delete($table, ['id' => $id]);

    wp_send_json_success('Category deleted.');
}
