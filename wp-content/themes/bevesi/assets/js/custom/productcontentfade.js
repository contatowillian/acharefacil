(function ($) {
  "use strict";

	$(document).on('bevesiShopPageInit added_to_cart', function () {
		bevesiThemeModule.productcontentfade();
	});

	bevesiThemeModule.productcontentfade = function() {
      const product = document.querySelectorAll('.products .product');

      if (product !== null) {
        for( var i = 0; i < product.length; i++ ) {
          const productWrapper = product[i].querySelector('.product-wrapper');
          if (productWrapper !== null) {
            if (productWrapper.classList.contains('with-content-fade')) {
              const wrapperHeight = productWrapper.offsetHeight;
              const fadeBlock = product[i].querySelector('.product-content-fade');
              const hiddenContent = productWrapper.querySelector('.product-hidden-content');
              const hiddenContentHeight = hiddenContent.offsetHeight;
  
              if (fadeBlock !== null) {
                fadeBlock.style.marginBottom = `-${hiddenContentHeight}px`;
              }
            }
          }
        }
      }
	}
	
	$(document).ready(function() {
		bevesiThemeModule.productcontentfade();
	});

})(jQuery);
