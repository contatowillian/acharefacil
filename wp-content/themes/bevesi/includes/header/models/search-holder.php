<?php
if ( ! function_exists( 'bevesi_search_holder' ) ) {
	function bevesi_search_holder(){
		$headersearch = get_theme_mod('bevesi_header_search','0');
		if($headersearch == 1){
		
		?>
			<div id="search-drawer" class="site-drawer site-search-drawer get-header-height">
				<div class="site-drawer-inner get-mobile-nav-height">
					<div class="site-header-row site-drawer-body">
						<form action="<?php echo esc_url( home_url( '/busca'  ) ); ?>" class="search-form" role="search" method="get">
							<div class="search-form-icon">
								<i class="klb-icon-search"></i>
							</div><!-- search-form-icon -->
							<input type="search" value="" class="form-control search-input size-lg" name="palavra_chave" placeholder="Procure os melhores serviços próximos à você" autocomplete="off">
						</form>
					</div><!-- site-header-row -->
				</div><!-- site-drawer-inner -->
				<div class="site-drawer-overlay"></div>
			</div><!-- site-drawer -->

		<?php  }
	}
}
add_action('wp_footer', 'bevesi_search_holder');