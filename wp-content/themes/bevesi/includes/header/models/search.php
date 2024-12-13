<?php

if ( ! function_exists( 'bevesi_header_search_input' ) ) {
	function bevesi_header_search_input(){
		$headersearch = get_theme_mod('bevesi_header_search','0');
		if($headersearch == 1){
		?>
		
			<div class="site-search-form search-form-desktop style-3">
				<?php echo bevesi_header_product_search(); ?>
			</div><!-- header-search-form -->
	<?php  }
	}
}