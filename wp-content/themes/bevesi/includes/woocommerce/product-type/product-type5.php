<?php
/*----------------------------
  Product Type 5
 ----------------------------*/
function bevesi_product_type5($stockprogressbar = '', $stockstatus = '', $shippingclass = '', $countdown = ''){
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

	$managestock = $product->managing_stock();
	$stock_quantity = $product->get_stock_quantity();
	$stock_format = esc_html__('Only %s unit left','bevesi');
	$stock_poor = '';
	if($managestock && $stock_quantity < 10) {
		$stock_poor .= '<div class="product-inventory color-red">'.sprintf($stock_format, $stock_quantity).'</div>';
	}
	
	$total_sales = $product->get_total_sales();
	$total_stock = $total_sales + $stock_quantity;
	
	if($managestock && $stock_quantity > 0) {
	$progress_percentage = floor($total_sales / (($total_sales + $stock_quantity) / 100)); // yuvarlama
	}
	
	$gallery = get_theme_mod('bevesi_product_hover_gallery') == 1 ? 'product-thumbnail' : '';
		
		$output .= '<div class="product-wrapper with-content-fade product-type-5 ">';
		$output .= '<div class="product-inner">';
		$output .= '<div class="product-thumbnail-wrapper">';
                        
		$output .= '<div class="product-buttons">';
			ob_start();
			do_action('bevesi_wishlist_action');
			$output .= ob_get_clean();
			
			$output .= '<div class="product-button product-compare">';
				ob_start();
				do_action('bevesi_compare_action');
				$output .= ob_get_clean();
			$output .= '</div>';
		$output .= '</div><!-- product-buttons -->';
		$output .= '<div class="product-thumbnail thumbnail-gallery-dots-style-1 thumbnail-gallery-hover">';
			ob_start();
			$output .= bevesi_product_second_image();
			$output .= ob_get_clean();
		$output .= '</div><!-- product-thumbnail -->';
		$output .= '</div><!-- product-thumbnail-wrapper -->';
		$output .= '<div class="product-content-wrapper">';
		$output .= '<div class="product-content-body">';
		$output .= '<div class="product-content-row">';
		$output .= '<div class="product-brand">';
		$output .= wc_get_product_category_list($product->get_id(), '');
		$output .= '</div><!-- product-brand -->';
		$output .= '<h2 class="product-title"><a href="'.get_permalink().'"><span>'.get_the_title().'</span></a></h2>';
		
		if($ratingcount){
			$output .= '<div class="product-rating black">';
			$output .= $rating;
			$output .= '<div class="rating-count">';
			$output .= '<span class="count-text">'.esc_html($ratingaverage).'</span>';
			$output .= '</div><!-- rating-count -->';
			$output .= '</div><!-- product-rating -->';  
		}
        
		$output .= '</div><!-- product-content-row -->';
		$output .= '<div class="product-content-row">';
		$output .= '<div class="product-price-wrapper">';
		$output .= '<span class="price">';
		$output .= $price;	
		$output .= '</span>';               
		$output .= bevesi_sale_percentage();
		$output .= '</div><!-- product-price-wrapper -->';
		$output .= '</div><!-- product-content-row -->';
			ob_start();
			do_action('bevesi_product_box_footer', $stockprogressbar, $stockstatus, $shippingclass, $countdown);
			$output .= ob_get_clean();
		$output .= '</div><!-- product-content-body -->';
		$output .= '</div><!-- product-content-wrapper -->';
		$output .= '</div><!-- product-inner -->';
		$output .= '<div class="product-hidden-content">';
		
		$output .= bevesi_loop_add_to_cart($id, 'product_type4');
		
		$output .= '</div><!-- product-hidden-content -->';
		$output .= '</div><!-- product-wrapper -->';
		$output .= '<div class="product-content-fade style-3"></div>';
		
	return $output;
}