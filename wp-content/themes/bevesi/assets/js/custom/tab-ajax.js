jQuery(document).ready(function($) {
	"use strict";

	$(document).on('click', '.module-header-tab li:not(active) a', function(event){
		event.preventDefault(); 
		
		var $thisbutton = $(this);
		
        var data = {
			cache: false,
            action: 'tab_view',
			beforeSend: function() {
				$($thisbutton).closest('.klb-module').find('.klb-products-tab .products').append('<svg class="tab-ajax loader-image preloader quick-view" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>');
			},
			'catid': $(this).attr('id'),
			'items': $('.klb-products-tab .products').data('items'),
			'mobile': $('.klb-products-tab .products').data('itemsmobile'),
			'tablet': $('.klb-products-tab .products').data('itemstablet'),
			'speed': $('.klb-products-tab .products').data('speed'),
			'post_count': $('.klb-products-tab .products').data('perpage'),
			'dots': $('.klb-products-tab .products').data('dots'),
			'arrows': $('.klb-products-tab .products').data('arrows'),
			'autoplay': $('.klb-products-tab .products').data('autoplay'),
			'autospeed': $('.klb-products-tab .products').data('autospeed'),
			'producttype': $('.klb-products-tab .products').data('producttype'),
			'productclass': $('.klb-products-tab .products').attr('class').replace(/slick-(\S+)/g,''),
			'best_selling': $('.klb-products-tab .products').data('best_selling'),
			'featured': $('.klb-products-tab .products').data('featured'),
			'on_sale': $('.klb-products-tab .products').data('onsale'),
			'stockprogressbar': $('.klb-products-tab .products').data('stockprogressbar'),
			'countdown': $('.klb-products-tab .products').data('countdown'),
			'stockstatus': $('.klb-products-tab .products').data('stockstatus'),
			'shippingclass': $('.klb-products-tab .products').data('shippingclass'),
        };
		

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(MyAjax.ajaxurl, data, function(response) {
			$($thisbutton).closest('.klb-module').find('.klb-products-tab').html(response);

		    $thisbutton.closest('.module-header-tab').find('.tab-link').removeClass('active');
		    $thisbutton.closest('.tab-link').addClass('active');


			bevesiThemeModule.siteslider();
	
			bevesiThemeModule.countdown();
			
			bevesiThemeModule.producthover();

			bevesiThemeModule.productquantity();

			bevesiThemeModule.producttypequantity();
			
        });
    });	

});