<?php
if ( ! function_exists( 'bevesi_discount_products' ) ) {
	function bevesi_discount_products(){
	?>	
	
	<?php $discount_products = get_theme_mod('bevesi_header_products_tab','0'); ?>
		<?php if($discount_products == '1'){ ?>
			<div class="site-header-custom-button">
				<a href="/criar-anuncio" >
					<div class="custom-button-icon"></div>
					<div class="custom-button-label" style='display:none'>
						<span class="custom-button-name">x<?php echo bevesi_sanitize_data(get_theme_mod('bevesi_header_products_button_title')); ?></span>
					</div><!-- custom-button-label -->

					<div class="custom-button-label criar_anuncio_botao_header">
						<span class="custom-button-name"><i class="klb-icon-plus"></i>Divulgue seu negócio</span>
					</div>
				</a>
				<div class="custom-button-holder">
					<?php

								$args = array(
									'post_type' => 'product',
									'posts_per_page' => get_theme_mod('bevesi_header_products_tab_post_count','6'),
									'order'          => 'DESC',
									'post_status'    => 'publish',
								);

								$args['klb_special_query'] = true;

								if(get_theme_mod('bevesi_header_products_tab_best_selling') == '1'){
									$args['meta_key'] = 'total_sales';
									$args['orderby'] = 'meta_value_num';
								}

								if(get_theme_mod('bevesi_header_products_tab_featured') == '1'){
									$args['tax_query'] = array( array(
										'taxonomy' => 'product_visibility',
										'field'    => 'name',
										'terms'    => array( 'featured' ),
											'operator' => 'IN',
									) );
								}
								
								if(get_theme_mod('bevesi_header_products_tab_on_sale') == '1'){
									$args['meta_key'] = '_sale_price';
									$args['meta_value'] = array('');
									$args['meta_compare'] = 'NOT IN';
								}

								$loop = new \WP_Query( $args );
							?>
							
							<div class="products product-grid-style grid-column-2-mobile grid-column-6 grid-gap-30">
								<?php 					
									if ( $loop->have_posts() ) {
										while ( $loop->have_posts() ) : $loop->the_post();
											global $product;
											global $post;
											global $woocommerce;
								?>
									
									
									<?php echo bevesi_product_type_header(); ?>
									
								
								<?php 
										endwhile;
									}
									wp_reset_postdata();
								?>
							</div><!-- products -->
				</div><!-- custom-button-holder -->
			</div><!-- site-header-custom-button -->  
			
	<?php } 

	}
}