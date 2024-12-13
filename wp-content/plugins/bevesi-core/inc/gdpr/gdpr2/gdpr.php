<?php

/*************************************************
## Scripts
*************************************************/
function bevesi_gdpr_scripts() {
	wp_register_style( 'klb-gdpr',   plugins_url( 'css/gdpr.css', __FILE__ ), false, '1.0');
	wp_register_script( 'klb-gdpr',  plugins_url( 'js/gdpr.js', __FILE__ ), true );

}
add_action( 'wp_enqueue_scripts', 'bevesi_gdpr_scripts' );

/*************************************************
## GDPR COOKIE
*************************************************/ 
function bevesi_gdpr_cookie(){	
	$gdpr  = isset( $_COOKIE['cookie-popup-visible'] ) ? $_COOKIE['cookie-popup-visible'] : 'enable';
	if($gdpr){
		return $gdpr;
	}
}

/*************************************************
## GDPR WP_Footer
*************************************************/ 

add_action('wp_footer', 'bevesi_gdpr_filter'); 
function bevesi_gdpr_filter() { 

	if ( ! apply_filters( 'bevesi_gdpr_filter', true ) ) {
		return;
	}

	if(get_theme_mod('bevesi_gdpr_toggle',0) == 1 && bevesi_gdpr_cookie() == 'enable'){
		wp_enqueue_script('jquery-cookie');
		wp_enqueue_script('klb-gdpr');
		wp_enqueue_style('klb-gdpr');
		?>

		<div class="site-gdpr get-mobile-nav-height" data-expires="<?php echo esc_attr(get_theme_mod('bevesi_gdpr_expire_date')); ?>">
		  <div class="site-gdpr-inner">
			<p><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_gdpr_text')); ?></p>
			<div class="gdpr-button">
				<a class="button link bordered" href="#"><?php echo esc_html(get_theme_mod('bevesi_gdpr_button_text')); ?></a>
			</div><!-- gdpr-button -->
		  </div><!-- site-gdpr-inner -->
		</div>
		
		<?php
	}
}