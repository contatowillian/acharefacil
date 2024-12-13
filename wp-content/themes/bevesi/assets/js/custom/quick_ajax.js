jQuery(document).ready(function($) {
	"use strict";

	$(document).on('click', '.product-quickview a', function(event){
		event.preventDefault(); 
		
		var $this = $(this);
		 
        var data = {
			cache: false,
            action: 'quick_view',
			beforeSend: function() {
				$this.addClass('quickview-loading');
			},
			'id': $this.data('product_id'),
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(MyAjax.ajaxurl, data, function(response) {
            $.magnificPopup.open({
                type: 'inline',
                items: {
                    src: response
                }
            })
			
			$this.removeClass('quickview-loading');
			
			bevesiThemeModule.countdown();
			
			bevesiThemeModule.siteslider();
			
			bevesiThemeModule.productquantity();
			
			
			$("form.cart.grouped_form .input-text.qty").attr("value", "0");

			$( document.body ).trigger( 'bevesiSinglePageInit' );
			
			$('.input-text.qty').closest('.quick-view-product-wrapper').find( '.input-text.qty' ).val($('.input-text.qty').closest('.quick-view-product-wrapper').find( '.input-text.qty' ).attr('min'));
        });
    });	

});