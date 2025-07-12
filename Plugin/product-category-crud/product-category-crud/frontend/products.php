<?php
global $wpdb;
$cat_table = $wpdb->prefix . 'pcc_categories';
$categories = $wpdb->get_results("SELECT * FROM $cat_table");
?>

<div class="container mt-4">
    <h2 class="mb-3">Product Listing</h2>
    <div class="form-group">
        <label for="category_filter">Filter by Category:</label>
        <select id="category_filter" class="form-control w-50">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat->id ?>"><?= esc_html($cat->category_name) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="product_list" class="row mt-4">
        <!-- Products will load here via AJAX -->
    </div>
</div>
