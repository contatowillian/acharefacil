(function ($) {
  "use strict";

  const header = document.querySelector('.site-header');
  const gliobalNotification = document.querySelector('.site-notification-global');
  const button = document.querySelector('.site-categories-button .toggle-button');
  const wrapper = document.querySelector('.site-categories-button .all-categories-wrapper')

  const setHeaderHeight = () => {
    let setHeight = header.clientHeight;

    if (header !== null) {
      setHeight = header.clientHeight;
    }

    if (gliobalNotification !== null) {
      setHeight = header.clientHeight + gliobalNotification.clientHeight;
    }

    return setHeight;
  }

  window.addEventListener("load", setHeaderHeight);
  window.addEventListener("resize", setHeaderHeight);

  const ifWindowScroll = (event) => {
    if (window.matchMedia("(min-width: 1024px)").matches) {
      window.addEventListener('scroll', function() {
        event.classList.add('scrolled');
        if (window.scrollY > setHeaderHeight()) {
          event.classList.add('fixed-on-top');
        } else {
          event.getAttribute("style");
          event.style.cssText = `${event.getAttribute("style")} --scrolled-size: ${window.scrollY}px`;
          event.classList.remove('fixed-on-top');
        }
      });
    }
  }

  if (button !== null) {
    button.addEventListener('click', (e) => {
      e.preventDefault();

      document.body.classList.toggle('categories-holder-active');
      if (wrapper !== null) {
        wrapper.classList.toggle('categories-active');
        ifWindowScroll(wrapper);
      }
    });
  }

}(jQuery));