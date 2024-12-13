(function ($) {
  "use strict";

	$(document).on('bevesiShopPageInit', function () {
		bevesiThemeModule.producttypequantity();
	});

	bevesiThemeModule.producttypequantity = function() {
		$('.product-cart-wrapper.style-1 .plus').on('click', function () {
			$(this).closest('.product-cart-wrapper').find('a.button').attr('data-quantity', $(this).closest('.product-cart-wrapper').find('.input-text.qty').val());
		});

		$('.product-cart-wrapper.style-1 .minus').on('click', function () {
			$(this).closest('.product-cart-wrapper').find('a.button').attr('data-quantity', $(this).closest('.product-cart-wrapper').find('.input-text.qty').val());
		});

	}
	
	$(document).ready(function() {
		bevesiThemeModule.producttypequantity();
	});

})(jQuery);
