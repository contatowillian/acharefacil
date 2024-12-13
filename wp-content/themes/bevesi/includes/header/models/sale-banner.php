<?php
if ( ! function_exists( 'bevesi_header_sale_banner' ) ) {
	function bevesi_header_sale_banner(){
		$salebanner = get_theme_mod('bevesi_header_sale_banner_toggle','0'); 
		if($salebanner == '1'){ ?>
			
			<div class="site-header-sale-banner">
                <a href="#" class="color-slate-400">
                  <div class="header-sale-banner-icon">
                    <i class="<?php echo bevesi_sanitize_data(get_theme_mod('bevesi_sale_banner_icon')); ?>"></i>
                  </div><!-- header-sale-banner-icon -->
                  <div class="header-sale-banner-content">
                    <p><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_header_sale_banner_title')); ?></p>
                    <span><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_header_sale_banner_subtitle')); ?></span>
                  </div><!-- header-sale-banner-content -->
                </a>
              </div><!-- site-header-sale-banner -->
			  
			
			
		<?php  }
	}
}