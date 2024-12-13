(function ($) {
  "use strict";

  const header = document.querySelector('.site-header');
  const gliobalNotification = document.querySelector('.site-notification-global');
  const drawers = gsap.utils.toArray(document.querySelectorAll('.site-drawer'))
  const drawerButtons = document.querySelectorAll('.drawer-button');
  let drawerActiveAnimation = gsap.to({}, {});

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

  const removeButtonClass = () => {
    if (drawerButtons !== null) {
      drawerButtons.forEach((button) => {
        button.classList.remove('active');
      });
    }
  }

  const drawerButtonClicked = (button, anim) => {
    document.body.classList.remove('site-drawer-active');
    removeButtonClass();

    drawerActiveAnimation.reverse();
    drawerActiveAnimation = anim;
    if (!drawerActiveAnimation.isActive()) {
      drawerActiveAnimation.play();
      button.classList.add('active');
      document.body.classList.toggle('site-drawer-active');
    }
  }

  if (drawerButtons !== null) {
    drawerButtons.forEach((button) => {
      const currentDrawer = drawers.filter(x => x.id === button.dataset.drawer)[0];
      let tl = gsap.timeline({ paused: true, reversed: true });
      if (currentDrawer !== null) {
        const drawerInner = currentDrawer.querySelector('.site-drawer-inner');
        const drawerOverlay = currentDrawer.querySelector('.site-drawer-overlay');

        tl.to(currentDrawer, .1, {
          autoAlpha: 1
        }).to(drawerInner, .5, {
          x:0,
          ease: 'power4.inOut'
        }, "-=.1").to(drawerOverlay, .5, {
          autoAlpha: 1
        }, "-=.5")

      }
      button.addEventListener('click', (e) => {
        e.preventDefault();
        const currentButton = e.target.closest('A');

        currentButton.anim = tl;
        drawerButtonClicked(currentButton, currentButton.anim);
      })
    })
  }

  if (drawers !== null) {
    for( var i = 0; i < drawers.length; i++ ) {
      const self = drawers[i];
      const drawerClose = self.querySelector('.site-close a');

      ifWindowScroll(self);

      if (drawerClose !== null) {
        drawerClose.addEventListener('click', (e) => {
          e.preventDefault();
          document.body.classList.remove('site-drawer-active');
          removeButtonClass();
          drawerActiveAnimation.reverse();
        })
      }
    }
  }

}(jQuery));