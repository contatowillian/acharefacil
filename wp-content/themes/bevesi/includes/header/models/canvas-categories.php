<?php

if ( ! function_exists( 'bevesi_header_canvas_categories' ) ) {
	function bevesi_header_canvas_categories(){
		$canvascategories = get_theme_mod('bevesi_header_sidebar','0');
		if($canvascategories == 1){
						
		?>
		
		<div id="categories-drawer" class="site-drawer site-categories-drawer drawer-right-side get-header-height">
			<div class="site-drawer-inner get-mobile-nav-height">
				<div class="site-header-row site-drawer-body">
					<nav class="site-categories">
						<?php
						wp_nav_menu(array(
						'theme_location' => 'sidebar-menu',
						'container' => '',
						'fallback_cb' => 'show_top_menu',
						'menu_id' => 'menu',
						'menu_class' => '',
						'echo' => true,
						"walker" => '',
						'depth' => 0 
						));
						?>
					</nav><!-- site-categories -->    
				</div><!-- site-header-row -->
			</div><!-- site-drawer-inner -->
			<div class="site-drawer-overlay"></div>
		</div><!-- site-drawer -->
	<?php  }
	}
}

add_action('wp_footer', 'bevesi_header_canvas_categories');