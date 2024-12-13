<?php
/*----------------------------
  Product Type List
 ----------------------------*/
function bevesi_product_type_list2(){
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
		
		$output .= '<li>';
		$output .= '<div class="search-img">';
		$output .= bevesi_product_image();
		$output .= '</div>';
		$output .= '<div class="search-content">';
		$output .= '<h3 class="product-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
		$output .= '<span class="price size-small">';
		$output .= $price;
		$output .= '</span><!-- price -->';
		$output .= '</div><!-- search-content -->';
		$output .= '</li>';
		
	return $output;
}