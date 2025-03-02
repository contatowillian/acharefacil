<?php
if ( ! function_exists( 'bevesi_search_holder' ) ) {
	function bevesi_search_holder(){
		$headersearch = get_theme_mod('bevesi_header_search','0');
		if($headersearch == 1){
		
		?>
			<div id="search-drawer" class="site-drawer site-search-drawer get-header-height">
				<div class="site-drawer-inner get-mobile-nav-height">
					<div class="site-header-row site-drawer-body">
						<form action="<?php echo esc_url( home_url( '/'  ) ); ?>" class="search-form" role="search" method="get">
							<div class="search-form-icon">
								<i class="klb-icon-search"></i>
							</div><!-- search-form-icon -->
							<input type="search" class="form-control search-input size-lg" name="s" value="<?php echo get_search_query(); ?>"  placeholder="<?php esc_attr_e('Search everything at bevesi online and in store...', 'bevesi'); ?>" autocomplete="off">
							<button type="submit" class="btn unset search-button color-black"><i class="klb-icon-search"></i></button>
							<input type="hidden" name="post_type" value="product" />
							<input type="hidden" name="shop_view" value="list_view" />
							<div class="site-search-form-result">
								<?php if(function_exists('bevesi_get_most_popular_keywords') && bevesi_get_most_popular_keywords()){ ?>
									<?php $total_products = wp_count_posts( 'product' ); ?>
									<?php $total_count = $total_products->publish; ?>
									<?php $total_format = esc_html__('Out of a total of %s products:','bevesi'); ?>
		
									<div class="search-popular-tags">
										<?php echo bevesi_get_most_popular_keywords(); ?>
									</div><!-- search-popular-tags -->
									
								<?php } ?>
							</div><!-- site-search-form-result -->
						</form>
					</div><!-- site-header-row -->
				</div><!-- site-drawer-inner -->
				<div class="site-drawer-overlay"></div>
			</div><!-- site-drawer -->

		<?php  }
	}
}
add_action('wp_footer', 'bevesi_search_holder');