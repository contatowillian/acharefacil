(function ($) {
  "use strict";

  const BEVESI_SITE = {
    init() {
      this.dom();
      this.themeMyAccountMenu();
      this.themeSidebarMenuCollapse();
    },
    dom() {
      this.body = document.body;
      // Mobile navbar selector
      const mobileNavbar = document.querySelector('.site-mobile-navbar');
      // Header selectors
      const header = document.querySelector('.site-header');
      const gliobalNotification = document.querySelector('.site-notification-global');

      const mobileNavbarSettingSize = () => {
        const getMobileNavHeightItem = document.querySelectorAll('.get-mobile-nav-height');
		
        if (getMobileNavHeightItem !== null && mobileNavbar !== null) {
		  let setMobileNavbar = mobileNavbar.clientHeight;
		  
          for( var i = 0; i < getMobileNavHeightItem.length; i++ ) {
            if (getMobileNavHeightItem[i].getAttribute("style")) {
              getMobileNavHeightItem[i].style.cssText = `${getMobileNavHeightItem[i].getAttribute("style")} --mobile-nav-height: ${setMobileNavbar}px`;
            } else {
              getMobileNavHeightItem[i].style.cssText = `--mobile-nav-height: ${setMobileNavbar}px`;
            }
          }
        }
      }

      window.addEventListener("load", mobileNavbarSettingSize);
      window.addEventListener("resize", mobileNavbarSettingSize);

      const headerHeightSettings = () => {
        const getHeagederHeightItem = document.querySelectorAll('.get-header-height');

        if (getHeagederHeightItem !== null) {
          let setHeight = header.clientHeight;

          if (gliobalNotification !== null) {
            setHeight = header.clientHeight + gliobalNotification.clientHeight;
          }

          for( var i = 0; i < getHeagederHeightItem.length; i++ ) {
            if (getHeagederHeightItem[i].getAttribute("style")) {
              getHeagederHeightItem[i].style.cssText = `${getHeagederHeightItem[i].getAttribute("style")} --header-height: ${setHeight}px`;
            } else {
              getHeagederHeightItem[i].style.cssText = `--header-height: ${setHeight}px`;
            }
          }
        }
      }

      window.addEventListener("load", headerHeightSettings);
      window.addEventListener("resize", headerHeightSettings);
    },
    themeMyAccountMenu() {
      const button = document.querySelector('.user-menu-toggle a');
      const accountMenu = document.querySelector('.my-account-navigation');

      if (button !== null || accountMenu !== null) {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          accountMenu.classList.toggle('active');
        })
      }
    },

    themeSidebarMenuCollapse() {
      var content = $( '.site-header .categories-menu' );
      var button = content.find( '> a' );
      var subMenu = content.find( '.site-categories' );

      button.on( 'click', function(e) {
        e.preventDefault();
        subMenu.slideToggle('200');
        
      });
    },

  }

  BEVESI_SITE.init();
	

	
	
	$(window).load(function(){
		$('.site-loading').fadeOut('slow',function(){$(this).remove();});
	});
	
	$(window).scroll(function() {
        $(this).scrollTop() > 135 ? $("header.site-header").addClass("sticky-header") : $("header.site-header").removeClass("sticky-header")
    });
	
}(jQuery));