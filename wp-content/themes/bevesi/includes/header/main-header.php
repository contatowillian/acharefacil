<?php

/*************************************************
## Bevesi Theme options
*************************************************/
require_once get_template_directory() . '/includes/header/models/search.php';
require_once get_template_directory() . '/includes/header/models/search-holder.php';
require_once get_template_directory() . '/includes/header/models/cart.php';
require_once get_template_directory() . '/includes/header/models/wishlist-icon.php';
require_once get_template_directory() . '/includes/header/models/compare-icon.php';
require_once get_template_directory() . '/includes/header/models/account-icon.php';
require_once get_template_directory() . '/includes/header/models/discount-products.php';
require_once get_template_directory() . '/includes/header/models/canvas-menu.php';
require_once get_template_directory() . '/includes/header/models/canvas-categories.php';
require_once get_template_directory() . '/includes/header/models/sidebar-menu.php';
require_once get_template_directory() . '/includes/header/models/sale-banner.php';
require_once get_template_directory() . '/includes/header/models/header-notification.php';
require_once get_template_directory() . '/includes/header/models/top-notification.php';
require_once get_template_directory() . '/includes/header/models/categories-popup.php';
/*************************************************
## Main Header Function
*************************************************/

add_action('bevesi_main_header','bevesi_main_header_function',20);

if ( ! function_exists( 'bevesi_main_header_function' ) ) {
	function bevesi_main_header_function(){
		
		if(bevesi_page_settings('page_header_type') == 'type6') {
			
			get_template_part( 'includes/header/header-type6' );
			
		} elseif(bevesi_page_settings('page_header_type') == 'type5') {
			
			get_template_part( 'includes/header/header-type5' );
			
		} elseif(bevesi_page_settings('page_header_type') == 'type4') {
			
			get_template_part( 'includes/header/header-type4' );
			
		} elseif(bevesi_page_settings('page_header_type') == 'type3') {
			
			get_template_part( 'includes/header/header-type3' );
			
		} elseif(bevesi_page_settings('page_header_type') == 'type2') {
			
			get_template_part( 'includes/header/header-type2' );
			
		} elseif(bevesi_page_settings('page_header_type') == 'type1') {
			
			get_template_part( 'includes/header/header-type1' );
			
		} elseif(get_theme_mod('bevesi_header_type') == 'type6'){
			
			get_template_part( 'includes/header/header-type6' );
			
		} elseif(get_theme_mod('bevesi_header_type') == 'type5'){
			
			get_template_part( 'includes/header/header-type5' );
			
		} elseif(get_theme_mod('bevesi_header_type') == 'type4'){
			
			get_template_part( 'includes/header/header-type4' );
			
		} elseif(get_theme_mod('bevesi_header_type') == 'type3'){
			
			get_template_part( 'includes/header/header-type3' );
			
		} elseif(get_theme_mod('bevesi_header_type') == 'type2'){
			
			get_template_part( 'includes/header/header-type2' );
			
		} else {
			
			get_template_part( 'includes/header/header-type1' );
			
		}
		
	}
}
