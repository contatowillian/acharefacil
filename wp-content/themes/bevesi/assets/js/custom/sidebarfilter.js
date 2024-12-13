(function ($) {
  "use strict";

	$(document).on('bevesiShopPageInit', function () {
		bevesiThemeModule.sidebarfilter();
	});

	bevesiThemeModule.sidebarfilter = function() {
		
		const filterButton = document.querySelectorAll('.filter-button');
		const filterSidebar = document.querySelector('.filter-sidebar');
		const mobileNavbar = document.querySelector('.site-mobile-navbar');

		if (filterSidebar !== null) {
			const filterOverlay = filterSidebar.querySelector('.sidebar-overlay');
			const filterInner = filterSidebar.querySelector('.sidebar-inner');

			let tl = gsap.timeline( { paused: true, reversed: true } );
			tl.to(filterSidebar, .1, {
			  autoAlpha: 1
			}).to(filterInner, .5, {
			  x:0,
			  ease: 'power4.inOut'
			}, "-=.1").to(filterOverlay, .5, {
			  autoAlpha: 1
			}, "-=.5");

			if (filterButton !== null) {

		      for( var i = 0; i < filterButton.length; i++ ) {
		        filterButton[i].addEventListener('click', (e) => {
		          e.preventDefault();
		          document.body.classList.add('filtered-sidebar-active');
		          filterSidebar.classList.add('filter-sidebar-active');
		          tl.reversed() ? tl.play() : tl.reverse();
		        });
		      }

			  filterOverlay.addEventListener('click', () => {
				document.body.classList.remove('filtered-sidebar-active');
				filterSidebar.classList.remove('filter-sidebar-active');
				tl.reversed() ? tl.play() : tl.reverse();
			  });

			}
		}
	}
	
	$(document).ready(function() {
		bevesiThemeModule.sidebarfilter();
	});

})(jQuery);
