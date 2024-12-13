<?php

if ( ! function_exists( 'bevesi_header_categories_popup' ) ) {
	function bevesi_header_categories_popup(){
		$categoriespopup = get_theme_mod('bevesi_categories_popup','0');
		if($categoriespopup == 1){
						
		?>
	
	<div class="site-categories-button">
        <a href="#" class="toggle-button"><i class="klb-icon-layout-grid"></i><span><?php esc_html_e('All Categories', 'bevesi'); ?></span></a>
		<div class="all-categories-wrapper get-header-height">
			<div class="container">
				<div class="all-categories-inner">
					<div class="column w-[300px]">
						<nav class="site-categories style-2">
							<?php
							wp_nav_menu(array(
							'theme_location' => 'sidebar-menu',
							'container' => '',
							'fallback_cb' => 'show_top_menu',
							'menu_id' => 'category-menu',
							'menu_class' => 'menu',
							'echo' => true,
							"walker" => '',
							'depth' => 0 
							));
							?>  
						</nav><!-- site-categories -->        
					</div><!-- column -->
					<div class="column flex-1">
			  
					</div><!-- column -->
					
					<?php

						$args = array(
							'post_type' => 'product',
							'posts_per_page' => 6,
							'order'          => 'DESC',
							'post_status'    => 'publish',
						);

						$args['klb_special_query'] = true;

						$loop = new \WP_Query( $args );
					?>
					
					<div class="column w-[300px]">
						<ul class="products">
							<?php 					
								if ( $loop->have_posts() ) {
									while ( $loop->have_posts() ) : $loop->the_post();
									global $product;
									global $post;
									global $woocommerce;
							?>
										
								<?php echo bevesi_product_type_list2(); ?>
					
							<?php endwhile; }
								wp_reset_postdata();
							?>
						</ul>
					</div><!-- column -->
				</div><!-- all-categories-inner -->
			</div><!-- container -->
        </div><!-- all-categories-wrapper -->
    </div><!-- site-categories-button -->

	<?php  }
	}
}