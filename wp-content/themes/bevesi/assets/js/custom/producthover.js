(function ($) {
  "use strict";

	$(document).on('bevesiShopPageInit added_to_cart', function () {
		bevesiThemeModule.producthover();
	});

	bevesiThemeModule.producthover = function() {
		const container = document.querySelectorAll('.product-thumbnail-gallery');
		  if (container !== null) {
			for( var i = 0; i < container.length; i++ ) {
			  const self = container[i];

			  const HoverGallerySlider = new HoverGallery({
				selector: self,
				duration: 0.3,
				resetHover: true // Mouse leave goes to the first item
			  });
			}
		}
	}
	
	$(document).ready(function() {
		bevesiThemeModule.producthover();
	});

})(jQuery);
