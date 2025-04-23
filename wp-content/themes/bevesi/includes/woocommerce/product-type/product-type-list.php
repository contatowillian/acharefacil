<?php
/*----------------------------
  Product Type List
 ----------------------------*/
function bevesi_product_type_list($stockprogressbar = '', $stockstatus = '', $shippingclass = '', $countdown = ''){
	global $product;
	global $post;
	global $woocommerce;
	
	$output = '';
	
	$id = get_the_ID();
	$allproduct = wc_get_product( get_the_ID() );

	$cart_url = wc_get_cart_url();
	$price = $allproduct->get_price_html();
	$weight = $product->get_weight();
	$stock_status = $product->get_stock_status();
	$stock_text = $product->get_availability();
	$short_desc = $product->get_short_description();
	$rating = wc_get_rating_html($product->get_average_rating());
	$ratingcount = $product->get_review_count();
	$ratingaverage  = $product->get_average_rating();
	$wishlist = get_theme_mod( 'bevesi_wishlist_button', '0' );
	$compare = get_theme_mod( 'bevesi_compare_button', '0' );
	$quickview = get_theme_mod( 'bevesi_quick_view_button', '0' );

	if( $product->is_type('variable') ) {
		$variation_ids = $product->get_visible_children();

		if($variation_ids[0]){
			$variation = wc_get_product( $variation_ids[0] );

			$sale_price_dates_to = ( $date = get_post_meta( $variation_ids[0], '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
		} else {
			$sale_price_dates_to = '';
		}
	} else {
		$sale_price_dates_to = ( $date = get_post_meta( $id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
	}
	
	$managestock = $product->managing_stock();
	$stock_quantity = $product->get_stock_quantity();
	$stock_format = esc_html__('Only %s left in stock','bevesi');
	$stock_poor = '';
	if($managestock && $stock_quantity < 10) {
		$stock_poor .= '<div class="product-inventory color-red">'.sprintf($stock_format, $stock_quantity).'</div>';
	}

	$postview  = isset( $_POST['shop_view'] ) ? $_POST['shop_view'] : '';
	
		$output .= '<div class="product-wrapper with-content-fade product-type-1">';
		$output .= '<div class="product-inner">';
		$output .= '<div class="product-thumbnail-wrapper">';
					  
		$output .= '<div class="product-buttons">';
			ob_start();
			do_action('bevesi_wishlist_action');
			$output .= ob_get_clean();
			
			$output .= bevesi_quickview('quickview_type1');
			
			$output .= '<div class="product-button product-compare">';
				ob_start();
				do_action('bevesi_compare_action');
				$output .= ob_get_clean();
			$output .= '</div>';
		$output .= '</div><!-- product-buttons -->';
		$output .= '<div class="product-thumbnail thumbnail-gallery-dots-style-1 thumbnail-gallery-slider">';
			ob_start();
			$output .= bevesi_product_second_image();
			$output .= ob_get_clean();
		$output .= '</div><!-- product-thumbnail -->';
		$output .= '</div><!-- product-thumbnail-wrapper -->';
		$output .= '<div class="product-content-wrapper">';
		$output .= '<div class="product-content-body">';
		$output .= '<div class="product-content-row">';
		$output .= '<div class="col-lg-9 linha_desc_anuncio_texto"> <!-- product-content-row col-lg-9 -->';
		$output .= '<div class="product-price-wrapper">';
		$output .= '<span class="price">';
		$output .= $price;
		$output .= '</span> ';               
		$output .= bevesi_sale_percentage();
		$output .= '</div><!-- product-price-wrapper -->';
		$output .= '<div class="titulo_produto_busca"><h2 class="product-title"><a href="'.get_permalink().'"><span>'.get_the_title().'</span></a></h2></div>
					<div class="limpa_linha"></div>';
		
		if($ratingcount){
			$output .= '<div class="product-rating yellow">';
			$output .= $rating;
			$output .= '<div class="rating-count">';
			$output .= '<span class="count-text">'.esc_html($ratingaverage).'</span>';
			$output .= '</div><!-- rating-count -->';
			$output .= '</div><!-- product-rating -->';  
		} 

		if($short_desc){
			$output .= '<div class="entry-description">';
			$output .= $short_desc;
			$output .= '</div><!-- product-details -->';
		}

		$output .= '<div class="info_extra_anunciante_busca">';
		$output .= '<div class="site_lista_busca"><i class="klb-icon-www"></i>www.jaraguaveiculos.com.br</div>';
	//	$output .= '<div class="instagram_lista_busca"><img class="icones_rede_social_lista_busca"  src="wp-content/themes/bevesi/assets/img/barra_icones.png"></div>';
		$output .= '</div>';

		$output .= '</div><!-- product-content-row col-lg-9 -->';
		$output .= '<div class="col-lg-3 coluna_info_anunciante_busca"> <!-- product-content-row col-lg-3 -->';
		$output .= '<div class="linha_top_info_lista_imoveis"></div>';
		$output .= '<div class="info-section info-secondary">
					<div class="phones phone primary"><strong>Informações:</strong></div>
					<div class="phones phone primary"><i class="klb-icon-phone"></i>(11) 99738-2911</div>
						<div class="adr">
						<div class="street-address"><i class="klb-icon-home"></i>Av. Paulista, 80</div>
						<div class="locality"><i class="klb-icon-map"></i>São Paulo,SP</div>
						</div>
					</div>';

		$output .= '</div><!-- product-content-row  col-lg-3-->';
		$output .= '</div><!-- product-content-row -->';

		$output .= '<div class="product-content-row">';
		
		ob_start();
		do_action('bevesi_product_box_footer', $stockprogressbar, $stockstatus, $shippingclass, $countdown);
		$output .= ob_get_clean();
		
		$output .= '</div><!-- product-content-row -->';
		$output .= '</div><!-- product-content-body -->';
		$output .= '<div class="product-content-footer">';
		$output .= '<div class="product-extra-content">';
		
		
		$output .= '</div><!-- product-extra-content -->';
		$output .= bevesi_loop_add_to_cart($id, 'product_type2');
		$output .= '</div><!-- product-content-footer -->';
		$output .= '</div><!-- product-content-wrapper -->';
		$output .= '</div><!-- product-inner -->';
		
		$output .= '<div class="product-hidden-content">';
		$output .= bevesi_loop_add_to_cart($id, 'product_type2');
		$output .= '</div><!-- product-hidden-content -->';
		
		$output .= '</div><!-- product-wrapper -->';
		
	return $output;
}