jQuery(document).ready(function($) {
    function loadProducts(category_id = '') 
    {
        $.post(pcc_ajax.ajaxurl, {
            action: 'pcc_filter_products',
            category_id: category_id
        }, function(res) {
            if (res.success) {
                $('#product_list').html(res.data);
            }
        });
    }

    
    loadProducts();

    // On category change
    $('#category_filter').on('change', function() 
    {
        const cat_id = $(this).val();
        loadProducts(cat_id);
    });
});
