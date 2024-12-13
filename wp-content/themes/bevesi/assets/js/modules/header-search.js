(function ($) {
  "use strict";

  const desktopSearch = document.querySelector('.search-form-desktop');

  if (desktopSearch !== null) {
    const input = desktopSearch.querySelector('.search-input');
    const searchAddon = desktopSearch.querySelector('.search-addon-dropdown');

    input.addEventListener('focus', () => {
      desktopSearch.classList.add('is-searchable');
    })

    input.addEventListener('blur', () => {
      setTimeout(() => {
        desktopSearch.classList.remove('is-searchable');
      }, 100);
    });

    if (searchAddon !== null) {
      const addonInput = searchAddon.querySelector('.search-addon-input');
      const addonValue = searchAddon.querySelector('.search-addon-value');
      const addonLinks = searchAddon.querySelectorAll('.search-addon-dropdown-menu li');
      const addonHiddenInput = searchAddon.querySelector('.search-category');

      if (addonInput !== null) {
        addonInput.addEventListener('click', () => {
          searchAddon.classList.toggle('open');
        });

        document.addEventListener('click', (e)=> {
          if(e.target.closest('.open')) return;
          
          searchAddon.classList.remove('open');
        });

        for( var i = 0; i < addonLinks.length; i++ ) {
          const addLinkText = addonLinks[i].querySelector('P').innerText;
          const addLinkValue = addonLinks[i].dataset.value;

          if (addonLinks[i] !== null) {
            addonLinks[i].addEventListener('click', () => {
              searchAddon.classList.remove('open');
              addonValue.innerHTML = addLinkText;
              addonHiddenInput.value = addLinkValue;
            });
          }
        }
      }
    }
  }

}(jQuery));