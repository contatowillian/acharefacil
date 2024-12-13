(function ($) {
  "use strict";

	$(document).on('bevesiShopPageInit added_to_cart', function () {
		bevesiThemeModule.filterproducts();
	});

	bevesiThemeModule.filterproducts = function() {
	    $(function() {
	      $(".filter-wide-button .dropdown-toggle").on("click", function() { 
	        $(".filter-wide-button .dropdown-menu").toggleClass('open'); });
	    });
	}
	
	$(document).ready(function() {
		bevesiThemeModule.filterproducts();
	});

}(jQuery));