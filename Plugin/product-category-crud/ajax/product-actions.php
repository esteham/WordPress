<?php
add_action('wp_ajax_pcc_add_product', 'pcc_add_product');
add_action('wp_ajax_pcc_get_products', 'pcc_get_products');
add_action('wp_ajax_pcc_delete_product', 'pcc_delete_product');

function pcc_add_product() 
{
    global $wpdb;
    $table = $wpdb->prefix . 'pcc_products';

    $product_name = sanitize_text_field($_POST['product_name']);
    $description = sanitize_textarea_field($_POST['description']);
    $unit_price = floatval($_POST['unit_price']);
    $selling_price = floatval($_POST['selling_price']);
    $stock = intval($_POST['total_stock']);
    $category_id = intval($_POST['category_id']);

    $image_path = '';
    if (!empty($_FILES['image']['name'])) 
    {
        $upload_dir = plugin_dir_path(__DIR__) . 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file = $_FILES['image'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = time() . '_' . uniqid() . '.' . $ext;
        $destination = $upload_dir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) 
        {
            $image_path = plugin_dir_url(__DIR__) . 'uploads/' . $filename;
        }
    }

    $wpdb->insert($table, [
        'product_name' => $product_name,
        'description' => $description,
        'unit_price' => $unit_price,
        'selling_price' => $selling_price,
        'total_stock' => $stock,
        'category_id' => $category_id,
        'image' => $image_path
    ]);

    wp_send_json_success('Product added successfully.');
    wp_die(); // ✅ very important
}

function pcc_get_products() 
{
    global $wpdb;
    $product_table = $wpdb->prefix . 'pcc_products';
    $cat_table = $wpdb->prefix . 'pcc_categories';

    $products = $wpdb->get_results("SELECT p.*, c.category_name FROM $product_table p
                                    LEFT JOIN $cat_table c ON p.category_id = c.id");

    ob_start();
    foreach ($products as $index => $p) 
    {
        echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td>" . esc_html($p->product_name) . "</td>
            <td>{$p->selling_price}</td>
            <td>{$p->total_stock}</td>
            <td>" . esc_html($p->category_name) . "</td>
            <td><img src='{$p->image}' width='50'></td>

            <td><button class='btn btn-sm btn-warning edit-product' 
            data-id='{$p->id}' 
            data-name='{$p->product_name}' 
            data-description='{$p->description}' 
            data-unit-price='{$p->unit_price}' 
            data-selling-price='{$p->selling_price}' 
            data-stock='{$p->total_stock}' 
            data-category-id='{$p->category_id}'
            >Edit</button></td>

            <td><button class='btn btn-sm btn-danger delete-product' data-id='{$p->id}'>Delete</button></td>
        </tr>";
    }
    $output = ob_get_clean();

    wp_send_json_success($output);
}

function pcc_delete_product() 
{
    global $wpdb;
    $table = $wpdb->prefix . 'pcc_products';
    $id = intval($_POST['id']);

    $product = $wpdb->get_row("SELECT image FROM $table WHERE id = $id");
    if ($product && !empty($product->image)) {
        $image_path = str_replace(plugin_dir_url(__DIR__), plugin_dir_path(__DIR__), $product->image);
        if (file_exists($image_path)) 
        {
            unlink($image_path);
        }
    }

    $wpdb->delete($table, ['id' => $id]);

    wp_send_json_success('Product deleted.');
}
