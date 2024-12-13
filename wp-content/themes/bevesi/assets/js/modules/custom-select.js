(function ($) {
  "use strict";

  $('.custom-select').each(function() {
    const selectClass = $(this).data('classes');
    $( this ).select2({ theme : selectClass });
  });

}(jQuery));