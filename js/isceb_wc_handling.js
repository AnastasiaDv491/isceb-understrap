jQuery(function($) {
    $('.single_add_to_cart_button').on('click', function(e){ 
    e.preventDefault();

    $thisbutton = $(this),
                $form = $thisbutton.closest('form.cart'),
                id = $thisbutton.val(),
                product_qty = $form.find('input[name=quantity]').val() || 1,
                product_id = $form.find('input[name=product_id]').val() || id,
                variation_id = $form.find('input[name=variation_id]').val() || 0;
    var data = {
            action: 'ql_woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };
    $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            }, 
            success: function (response) { 
                console.log(response);
                if (response.error && response.product_url) {
                    //This is navigating to a page which in this case is the current page. This is needed I think to show the error message.
                    window.location = response.product_url;
                    
                    return;
                } else { 
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                } 
            }, 
        }); 
     }); 
});