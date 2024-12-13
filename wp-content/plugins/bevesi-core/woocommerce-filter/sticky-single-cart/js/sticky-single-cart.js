(function ($) {
  "use strict";

	$(document).ready(function() {
	
		var singleCartPos = $('.single-product-wrapper  .single-product-detail .single_add_to_cart_button').offset();
		var singleCartTop = $('.single-product-wrapper  .single-product-detail .single_add_to_cart_button').length && $(".bevesi-product-bottom-popup-cart").length ? singleCartPos.top : 0;

		$(window).on("scroll", function () {

			if ( $(".bevesi-product-bottom-popup-cart").length && $(".single-product-detail .single_add_to_cart_button").length ) {

				if ( $(window).scrollTop() > singleCartTop ) {
					$(".bevesi-product-bottom-popup-cart").addClass('active');
				} else {
					$(".bevesi-product-bottom-popup-cart").removeClass('active');
				}

			}

		});
		
		
		$(".sticky_add_to_cart").click(function () {
		   //1 second of animation time
		   //html works for FFX but not Chrome
		   //body works for Chrome but not FFX
		   //This strange selector seems to work universally
		   $("html, body").animate({scrollTop: 0}, 400);
		});

		
	});
	
}(jQuery));