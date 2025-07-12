<?php
global $wpdb;
$cat_table = $wpdb->prefix . 'pcc_categories';
$product_table = $wpdb->prefix . 'pcc_products';
$categories = $wpdb->get_results("SELECT * FROM $cat_table");
?>
<!--Shortcode function-->
<script type="text/javascript">
    function copyShortcode() {
    const copyText = document.getElementById("shortcodeText");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Shortcode copied: " + copyText.value);
}

</script>

<div class="container mt-4">
    <h2>Category Management</h2>
<!--Short Code Add-->
    <div class="input-group mb-3">
    <input type="text" class="form-control" id="shortcodeText" value="[pcc_products]" readonly>
    <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" onclick="copyShortcode()">Copy Shortcode</button>
    </div>
    </div>
<!--Short Code Add Ends-->

    <form id="categoryForm" class="form-inline mb-3">
        <input type="text" name="category_name" class="form-control mr-2" placeholder="Category Name" required>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
    <div id="categoryMsg"></div>
    <table class="table table-bordered" id="categoryTable">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <hr>

    <h2>Product Management</h2>
    <?php if (!empty($categories)): ?>
    <form id="productForm" enctype="multipart/form-data">
        <div class="form-group">
            <label>Product Name</label><br>
            <input type="text" name="product_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label><br>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Unit Price</label><br>
            <input type="number" step="0.01" name="unit_price" class="form-control">
        </div>
        <div class="form-group">
            <label>Selling Price</label><br>
            <input type="number" step="0.01" name="selling_price" class="form-control">
        </div>
        <div class="form-group">
            <label>Stock</label><br>
            <input type="number" name="total_stock" class="form-control">
        </div>
        <div class="form-group">
            <label>Category</label><br>
            <select name="category_id" class="form-control" required>
                <option value="">Select</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat->id ?>"><?= esc_html($cat->category_name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Image</label><br>
            <input type="file" name="image" class="form-control-file">
        </div>
        <br>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
    <br>
    
    <div id="productMsg" class="my-2"></div>
    <?php else: ?>
        <div class="alert alert-warning">Please add at least one category first.</div>
    <?php endif; ?>

    <table class="table table-striped mt-3" id="productTable">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Price</th><th>Stock</th><th>Category</th><th>Image</th><th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Category Modal-->

<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <form id="editCategoryForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="cat_id" id="edit_cat_id">
                <label>Category Name</label>
                <input type="text" name="category_name" id="edit_category_name" class="form-control" required>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>    
</div>

<!-- Product Modal -->

<div class="modal fade" id="editProductModal">
    <div class="modal-dialog modal-lg">
        <form id="editProductForm" class="modal-content" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="product_id" id="edit_product_id">
             <div>
                 <label>Product Name</label>
                <input type="text" name="product_name" id="edit_product_name" class="form-control" required>
             </div>
            
             <div>
                 <label>Description</label>
                <textarea name="description" id="edit_description" class="form-control"></textarea>
             </div>
             <div>
                 <label>Unit Price</label>
                <input type="number" step="0.01" name="unit_price" id="edit_unit_price" class="form-control" required>
             </div>

             <div>
                 <label>Selling Price</label>
                <input type="number" step="0.01" name="selling_price" id="edit_selling_price" class="form-control" required>
             </div>
              <div>
                 <label>Stock</label>
                <input type="number" name="total_stock" id="edit_total_stock" class="form-control" required>
             </div>

              <div>
                 <label>Category</label>
                <select name="category_id" id="edit_category_id" class="form-control">
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat->id?>"><?= esc_html($cat->category_name) ?></option>
                    <?php endforeach; ?>
                </select>
             </div>

             <div class="form-group">
                 <label>Image</label>
                 <input type="file" name="image" class="form-control-file">
             </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>    
</div>