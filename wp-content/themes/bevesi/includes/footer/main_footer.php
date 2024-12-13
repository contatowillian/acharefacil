<?php

/*************************************************
## Main Footer Function
*************************************************/

add_action('bevesi_main_footer','bevesi_main_footer_function',20);

if ( ! function_exists( 'bevesi_main_footer_function' ) ) {
	function bevesi_main_footer_function(){
		
		if(bevesi_page_settings('page_footer_type') == 'type3') {
			
			get_template_part( 'includes/footer/footer-type3' );
			
		} elseif(bevesi_page_settings('page_footer_type') == 'type2') {
			
			get_template_part( 'includes/footer/footer-type2' );
			
		} elseif(bevesi_page_settings('page_footer_type') == 'type1') {
			
			get_template_part( 'includes/footer/footer-type1' );
			
		} elseif(get_theme_mod('bevesi_footer_type') == 'type3'){
			
			get_template_part( 'includes/footer/footer-type3' );
			
		} elseif(get_theme_mod('bevesi_footer_type') == 'type2'){
			
			get_template_part( 'includes/footer/footer-type2' );
			
		} else {
			
			get_template_part( 'includes/footer/footer-type1' );
			
		}
		
	}
}