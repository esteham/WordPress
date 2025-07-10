jQuery(document).ready(function($) 
{
   
    if (typeof pcc_ajax === 'undefined') 
    {
        console.error("pcc_ajax is undefined!");
        return;
    }

    // Load all categories
    function loadCategories() 
    {
        $.post(pcc_ajax.ajaxurl, { action: 'pcc_get_categories' }, function(res) 
        {
            if (res.success) {
                $('#categoryTable tbody').html(res.data);
            }
        });
    }

    loadCategories();

    // Add category
    $('#categoryForm').on('submit', function(e) 
    {
        e.preventDefault();
        const name = $(this).find('input[name="category_name"]').val();

        $.post(pcc_ajax.ajaxurl, {
            action: 'pcc_add_category',
            category_name: name
        }, function(res) {
            $('#categoryMsg').html(`<div class="alert alert-${res.success ? 'success' : 'danger'}">${res.data}</div>`);
            if (res.success) {
                $('#categoryForm')[0].reset();
                loadCategories();
            }
        });
    });

    // Delete category
    $(document).on('click', '.delete-category', function() 
    {
        if (!confirm('Are you sure you want to delete this category?')) return;
        const id = $(this).data('id');

        $.post(pcc_ajax.ajaxurl, {
            action: 'pcc_delete_category',
            id: id
        }, function(res) 
        {
            if (res.success) 
            {
                loadCategories();
            }
        });
    });

    // Edit category
    $(document).on('click', '.edit-category', function(){
        const id = $(this).data('id');
        const name = $(this).data('name');
        $('#edit_cat_id').val(id);
        $('#edit_cat_name').val(name);
        $('#editCategoryModal').modal('show');        
    });

    //Update Category
    $('#editCategoryForm').on('submit', function(e){
    
        e.preventDefault();
        $.post(pcc_ajax.ajaxurl, {
            action: 'pcc_update_category',
            cat_id: $('#edit_cat_id').val(),
            category_name: $('#edit_cat_name').val()
        }, function(res) {
            $('#categoryMsg').html(`<div class="alert alert-${res.success ? 'success' : 'danger'}">${res.data}</div>`);
            if (res.success) {
                $('#editCategoryModal').modal('hide');
                loadCategories();
            }
        });
    });

    // Load all products
    function loadProducts() 
    {
        $.post(pcc_ajax.ajaxurl, { action: 'pcc_get_products' }, function(res) 
        {
            if (res.success) 
            {
                $('#productTable tbody').html(res.data);
            }
        });
    }

    loadProducts();

    // Add product
    $('#productForm').on('submit', function(e) 
    {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('action', 'pcc_add_product');

        $.ajax({
            url: pcc_ajax.ajaxurl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                $('#productMsg').html(`<div class="alert alert-${res.success ? 'success' : 'danger'}">${res.data}</div>`);
                if (res.success) {
                    $('#productForm')[0].reset();
                    loadProducts();
                }
            },
            error: function(err) 
            {
                console.log("AJAX Error:", err); // Debug
            }
        });
    });

    // Delete product
    $(document).on('click', '.delete-product', function()
     {
        if (!confirm('Are you sure you want to delete this product?')) return;
        const id = $(this).data('id');

        $.post(pcc_ajax.ajaxurl, {
            action: 'pcc_delete_product',
            id: id
        }, function(res) {
            if (res.success) {
                loadProducts();
            }
        });
    });

});


//Edit comment