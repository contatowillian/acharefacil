(function ($) {
  "use strict";

	$(document).on('bevesiShopPageInit', function () {
		bevesiThemeModule.woocommercePriceSlider();
	});

	bevesiThemeModule.woocommercePriceSlider = function() {
		$('.widget_klb_product_categories ul.children').closest('li').addClass("cat-parent");
		$(".widget_klb_product_categories ul > li.cat-parent").append('<span class="subDropdown plus"></span>');
		$('.widget_klb_product_categories ul.children input[checked]').closest('li.cat-parent').addClass("current-cat");

		$(".subDropdown")[0] && $(".subDropdown").on("click", function() {
			$(this).toggleClass("plus"), $(this).toggleClass("minus"), $(this).parent().find("ul").slideToggle();
		});
	}
	
	$(document).ready(function() {
		bevesiThemeModule.woocommercePriceSlider();
	});

})(jQuery);
