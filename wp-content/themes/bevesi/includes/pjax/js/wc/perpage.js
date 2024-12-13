/* global bevesi_settings */
(function($) {
	bevesiThemeModule.$document.on('bevesiShopPageInit', function() {
		bevesiThemeModule.perpage();
	});

	bevesiThemeModule.perpage = function() {
		
		var $wcperpage = $('.products-per-page');

		$wcperpage.on('change', 'select.perpage', function() {
			var $form = $(this).closest('form');
			$form.find('[name="_pjax"]').remove();

			$.pjax({
				container: '.main-content',
				timeout  : bevesi_settings.pjax_timeout,
				url      : '?' + $form.serialize(),
				scrollTo : false,
				renderCallback: function(context, html, afterRender) {
					context.html(html);
					afterRender();
				}
			});
		});

		$wcperpage.on('submit', function(e) {
			e.preventDefault(e);
		});
	};

	$(document).ready(function() {
		bevesiThemeModule.perpage();
	});
})(jQuery);
