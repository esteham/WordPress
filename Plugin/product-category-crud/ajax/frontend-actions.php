<?php
add_action('wp_ajax_pcc_filter_products', 'pcc_filter_products');
add_action('wp_ajax_nopriv_pcc_filter_products', 'pcc_filter_products');

function pcc_filter_products() 
{
    global $wpdb;
    $cat_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    $product_table = $wpdb->prefix . 'pcc_products';
    $cat_table = $wpdb->prefix . 'pcc_categories';

    $query = "SELECT p.*, c.category_name FROM $product_table p
              LEFT JOIN $cat_table c ON p.category_id = c.id";
    if ($cat_id) 
    {
        $query .= " WHERE p.category_id = $cat_id";
    }

    $products = $wpdb->get_results($query);

    ob_start();
    if ($products):
        foreach ($products as $product):
?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php if (!empty($product->image)): ?>
                    <img src="<?= esc_url($product->image) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= esc_html($product->product_name) ?></h5>
                    <p class="card-text"><?= esc_html($product->description) ?></p>
                    <p><strong>Price:</strong> <?= number_format($product->selling_price, 2) ?></p>
                    <p><strong>Stock:</strong> <?= $product->total_stock ?></p>
                    <p><strong>Category:</strong> <?= esc_html($product->category_name) ?></p>
                </div>
            </div>
        </div>
<?php
        endforeach;
    else:
        echo '<div class="col-12"><div class="alert alert-warning">No products found for selected category.</div></div>';
    endif;
    $output = ob_get_clean();

    wp_send_json_success($output);
}
