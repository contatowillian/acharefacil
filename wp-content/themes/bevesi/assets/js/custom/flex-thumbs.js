jQuery(document).ready(function($) {
	"use strict";
	
	setTimeout(() => {
		$(".flex-control-thumbs").addClass("product-thumbnails klb-slider");
		
		if ($(".single-product-gallery").hasClass("vertical") && $(window).width() > 992) {
			var verti = true;
		} else {
			var verti = false;
		}
		
		$('.product-thumbnails').slick({
		  dots: false,
		  arrows: false,
          prevArrow: '<button type="button" class="slick-nav slick-prev slick-button"><?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="0.97" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M15 6l-6 6 6 6" stroke="#000000" stroke-width="0.97" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>',
          nextArrow: '<button type="button" class="slick-nav slick-next slick-button"><?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="0.97" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M9 6l6 6-6 6" stroke="#000000" stroke-width="0.97" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>',
		  autoplay: false,
		  Speed: 2000,
		  slidesToShow: $('.woocommerce-product-gallery.woocommerce-product-gallery--with-images').attr('data-columns'),
		  slidesToScroll: 1,
		  focusOnSelect: true,
		  vertical: verti,
		});

		$(".flex-control-nav" ).wrapAll( "<div class='product-thumbnail-items'></div>" );
		
		if ( $('.product-brand > *').length < 1 ) {
			$('.product-brand').remove();
		}
		
		$(".woocommerce-product-gallery__trigger").prependTo(".flex-viewport");
		$(".klb-product360-btn").prependTo(".flex-viewport");
		$(".klb-single-video").prependTo(".flex-viewport");
		
		
		$('.woocommerce-product-gallery__wrapper > div:not([data-thumb])').each(function() {
			$(this).prependTo(".flex-viewport");
		});
		
		
	}, 100);
	
});