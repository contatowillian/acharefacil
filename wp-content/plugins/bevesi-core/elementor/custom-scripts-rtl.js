/* KLB Addons for Elementor v1.0 */

jQuery.noConflict();
!(function ($) {
	"use strict";

	
	/* CAROUSEL*/
	function klb_carousel($scope, $) {
		const container = document.querySelectorAll('.site-slider');

		if (container !== null) {
			for( var i = 0; i < container.length; i++ ) {
			  const self = container[i];

			  let slide_items = Number(self.dataset.items);
			  let slide_items_laptop = Number(self.dataset.itemslaptop);
			  let slide_items_tablet = Number(self.dataset.itemstablet);
			  let slide_items_mobile = Number(self.dataset.itemsmobile);
			  let slide_items_mobilexs = Number(self.dataset.itemsmobilexs);
			  let slide_item_slide_show = Number(self.dataset.itemscroll) ? Number(self.dataset.itemscroll) : 1;
			  let slide_speed = Number(self.dataset.speed);

			  let slide_arrows = self.dataset.arrows === 'true' ? true : false;
			  let slide_arrows_laptop = self.dataset.arrowslaptop === 'true' ? true : false;
			  let slide_arrows_tablet = self.dataset.arrowstablet === 'true' ? true : false;
			  let slide_arrows_mobile = self.dataset.arrowsmobile === 'true' ? true : false;

			  let slide_dots = self.dataset.dots === 'true' ? true : false;
			  let slide_dots_laptop = self.dataset.dotslaptop === 'true' ? true : false;
			  let slide_dots_tablet = self.dataset.dotstablet === 'true' ? true : false;
			  let slide_dots_mobile = self.dataset.dotsmobile === 'true' ? true : false;

			  let slide_autoplay = self.dataset.autoplay === 'true' ? true : false;
			  let slide_auto_speed = Number(self.dataset.autospeed);

			  let slide_infinite = self.dataset.infinite === 'true' ? true : false;
			  let slide_center = self.dataset.centered === 'true' ? true : false;
			  let slide_as_nav_for = self.dataset.assfornav;
			  let slide_focus_on_select = self.dataset.focusonselect === 'true' ? true : false;
			  let slide_css = self.dataset.css;

			  let slide_rtl = self.dataset.rtl === 'true' ? true : false;
			  let slide_vertical = self.dataset.vertical === 'true' ? true : false;
			  let slide_draggable = self.dataset.draggable === 'true' ? true : false;
			  let slide_adaptive_height = self.dataset.adaptiveheight === 'true' ? true : false;
			  let slide_variable_width = self.dataset.variablewidth === 'true' ? true : false;

			  let args = {
				rtl: true,
				slidesToShow: slide_items,
				slidesToScroll: slide_item_slide_show,
				speed: slide_speed,
				arrows: slide_arrows,
				dots: slide_dots,
				infinite: slide_infinite,
				centerMode: slide_center,
				asNavFor: slide_as_nav_for,
				focusOnSelect: slide_focus_on_select,
				autoplay: slide_autoplay,
				autoplaySpeed: slide_auto_speed,
				cssEase: slide_css,
				lazyLoad: 'ondemand',
				rtl: slide_rtl,
				vertical: slide_vertical,
				variableWidth: slide_variable_width,
				adaptiveHeight: slide_adaptive_height,
				draggable: slide_draggable,
				prevArrow: '<button type="button" class="slick-nav slick-prev slick-button unset"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="currentColor"><polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="17.2,22.4 6.8,12 17.2,1.6 "/></svg></button>',
				nextArrow: '<button type="button" class="slick-nav slick-next slick-button unset"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="currentColor"><polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="6.8,22.4 17.2,12 6.8,1.6 "/></svg></button>',
				touchThreshold: 100,
				rows: 0,
				responsive: [
				  {
					breakpoint: 1280,
					settings: {
					  slidesToShow: slide_items <= 6 ? slide_items : 5
					}
				  }, {
					breakpoint: 1200,
					settings: {
					  slidesToShow: slide_items_laptop ? slide_items_laptop : (slide_items <= 6 ? slide_items : 5),
					  arrows: slide_arrows_laptop,
					  dots: slide_dots_laptop
					}
				  }, {
					breakpoint: 1024,
					settings: {
					  slidesToShow: slide_items_tablet ? slide_items_tablet : (slide_items <= 5 ? slide_items : 4),
					  arrows: slide_arrows_tablet,
					  dots: slide_dots_tablet
					}
				  }, {
					breakpoint: 768,
					settings: {
					  slidesToShow: slide_items_mobile ? slide_items_mobile : (slide_items <= 4 ? slide_items : 3),
					  arrows: slide_arrows_mobile,
					  dots: slide_dots_mobile,
					  vertical: false
					}
				  }, {
					breakpoint: 320,
					settings: {
					  slidesToShow: slide_items_mobilexs ? slide_items_mobilexs : (slide_items <= 3 ? slide_items : 2),
					}
				  }
				]
			  };

			  $(self).on('init', function(event, slick){
				const items = self.querySelectorAll( '.slider-item' );
				if (self.classList.contains('slick-initialized')) {
				  if (items !== null) {
					for( var i = 0; i < items.length; i++ ) {
					  const product = items[i].querySelector('.product');
					  if (product !== null) {
						const productWrapper = product.querySelector('.product-wrapper');
						if (productWrapper.classList.contains('with-content-fade')) {
						  const wrapperHeight = productWrapper.offsetHeight;
						  const fadeBlock = product.querySelector('.product-content-fade');
						  const hiddenContent = productWrapper.querySelector('.product-hidden-content');
						  const hiddenContentHeight = hiddenContent.offsetHeight;

						  const slickList = self.querySelector('.slick-list');
						  fadeBlock.style.marginBottom = `-${hiddenContentHeight}px`;

						  product.addEventListener('mouseover', (e) => {
							slickList.style.paddingBottom = `${wrapperHeight + hiddenContentHeight + 14}px`;
							slickList.style.marginBottom = `-${wrapperHeight + hiddenContentHeight + 14}px`;
						  })
					  
						  product.addEventListener('mouseleave', (e) => {
							slickList.style.paddingBottom = '';
							slickList.style.marginBottom = '';
						  })
						}
					  }
					}
				  }
				}
			  });

			  $(self).not('.slick-initialized').slick( args );

			  $(self).on('setPosition', function(event) {
				let img = $(event.currentTarget).find('.slick-active img');
				let topPosition = img.height()/2;
				topPosition-=$(event.currentTarget).find('.slick-arrow').height()/2;
				$(event.currentTarget).find('.slick-arrow').css('top',topPosition + 'px');
			  }).trigger('afterChange');
			}
		}
	}
	
	/* Countdown */
	function klb_countdown($scope, $) {
		$('.site-countdown').each(function() {
			let $this = $(this);
			let currentDate = $(this).data('date');
			let currentTimeZone = $(this).data('timezone');
			let $days = $this.find('.days');
			let $hours = $this.find('.hours');
			let $minutes = $this.find('.minutes');
			let $second = $this.find('.second');

			let finalDate = moment.tz(currentDate, currentTimeZone);
			$this.countdown(finalDate.toDate(), function(event) {
			  $days.html(event.strftime('%D'));
			  $hours.html(event.strftime('%H'));
			  $minutes.html(event.strftime('%M'));
			  $second.html(event.strftime('%S'));
			});
		});
	}
	
	/* PRODUCT HOVER*/
	function klb_product_hover($scope, $) {
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
	
	
	
	

    jQuery(window).on('elementor/frontend/init', function () {
		
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-home-slider.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-tab-carousel.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-vendor-carousel.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-categories.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-carousel.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-client-carousel.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-category-banner.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-category-banner2.default', klb_carousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-text-box.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-tab-carousel.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-counter-banner.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-carousel.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-grid.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-banner-box2.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-category-banner.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-category-banner2.default', klb_countdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-tab-carousel.default', klb_product_hover);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-carousel.default', klb_product_hover);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-product-grid.default', klb_product_hover);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-category-banner.default', klb_product_hover);
		elementorFrontend.hooks.addAction('frontend/element_ready/bevesi-category-banner2.default', klb_product_hover);
		
    });

})(jQuery);
