<?php

/*************************************************
## Item Quantity 
*************************************************/
function bevesi_item_quantity_in_cart($product_id) {
	if ( isset(WC()->cart)) {
		foreach( WC()->cart->get_cart() as $cart_item ) {
			
			if ( $cart_item['product_id'] === $product_id ){
				return $cart_item['quantity'];
				
			}

		}
	}
}

/*************************************************
## Loop Add to Cart Button
*************************************************/
function bevesi_loop_add_to_cart($id, $type){
	global $product;
	$output = '';
	
	$quantity = '';
	$cart_with_class = '';
	$in_cart_class = '';

	if(get_theme_mod('bevesi_quantity_box',0) == 1){
		
		wp_enqueue_script( 'bevesi-cartquantity');
		
		$max_value    = ($product->get_max_purchase_quantity() > 0) ? $product->get_max_purchase_quantity() : '';

		$step_quantity = function_exists('bevesi_step_quantity') ? bevesi_step_quantity($product) : '1';
		$min_quantity = function_exists('bevesi_min_quantity') ? bevesi_min_quantity($product) : '0';
		$max_quantity = function_exists('bevesi_max_quantity') ? bevesi_max_quantity($product) : $max_value;

		$in_cart_class .= bevesi_item_quantity_in_cart($id) ? 'product-in-cart' : '';
		$in_cart_value = bevesi_item_quantity_in_cart($id) ? bevesi_item_quantity_in_cart($id) : '1';

		$cart_with_class .= 'cart-with-quantity';	
		
		$quantity .= '<div class="quantity ajax-quantity style-1 primary">';
		$quantity .= '<div class="quantity-button minus"><i class="klb-icon-minus"></i></div>';
		$quantity .= '<input type="text" class="input-text qty text" name="quantity" step="'.esc_attr($step_quantity).'" min="'.esc_attr($min_quantity).'" max="'.esc_attr($max_quantity).'" value="'.esc_attr($in_cart_value).'" title="Menge" size="4" inputmode="numeric">';
		$quantity .= '<div class="quantity-button plus"><i class="klb-icon-plus"></i></div>';
		$quantity .= '</div><!-- quantity -->';

	}
	
	
	
	
	if($type == 'product_type4'){
			$output .= '<div class="product-cart-wrapper style-2">';
			ob_start();
			woocommerce_template_loop_add_to_cart();
			$output .= ob_get_clean();;
			
			$output .= bevesi_quickview('quickview_type2');
			$output .= '</div><!-- product-cart-wrapper -->';
	} elseif($type == 'product_type3'){
			$output .= '<div class="product-cart-wrapper style-1 '.esc_attr($cart_with_class).' '.esc_attr($in_cart_class).'">';
				
				if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
					wp_enqueue_script( 'bevesi-producttypequantity'); 		
					$output .= '<div class="quantity bordered size-small">';
					$output .= '<div class="quantity-button minus">';
					$output .= '<i class="klb-icon-minus"></i>';
					$output .= '</div><!-- quantity-button -->';
					$output .= '<input type="text" class="input-text qty text" name="quantity" step="1" min="1" max="" value="1" size="4" inputmode="numeric" tabindex="0">';
					$output .= '<div class="quantity-button plus">';
					$output .= '<i class="klb-icon-plus"></i>';
					$output .= '</div><!-- quantity-button -->';
					$output .= '</div><!-- quantity --> ';
				}	
			
				ob_start();
				woocommerce_template_loop_add_to_cart();
				$output .= ob_get_clean();;
				
			$output .= '</div><!-- product-cart -->';
	} elseif($type == 'product_type2'){
			$output .= '<div class="product-cart-wrapper style-1 '.esc_attr($cart_with_class).' '.esc_attr($in_cart_class).'">';
		
				ob_start();
				woocommerce_template_loop_add_to_cart();
				$output .= ob_get_clean();;
			
				$output .= $quantity;
				
			$output .= '</div><!-- product-cart -->';	
	} else {
		$output .= '<div class="product-cart-wrapper style-1 '.esc_attr($cart_with_class).' '.esc_attr($in_cart_class).'">';
		
			ob_start();
			woocommerce_template_loop_add_to_cart();
			$output .= ob_get_clean();;
			
			$output .= bevesi_quickview('quickview_type1');
		
			ob_start();
			do_action('bevesi_compare_action');
			$output .= ob_get_clean();
			
			$output .= $quantity;      
			
		$output .= '</div><!-- product-cart -->';
	}
	
	return $output;
}

/*************************************************
## Quantity Button CallBack
*************************************************/ 

add_action( 'wp_ajax_nopriv_quantity_button', 'bevesi_quantity_button_callback' );
add_action( 'wp_ajax_quantity_button', 'bevesi_quantity_button_callback' );
function bevesi_quantity_button_callback() {


	$id = intval( $_POST['id'] );
	$quantity = intval( $_POST['quantity'] );
	$product    = isset( $_POST['id'] ) ? wc_get_product( absint( $_POST['id'] ) ) : false;

    $specific_ids = array($id);
    $new_qty = $quantity; // New quantity
	
    foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id = $cart_item['data']->get_id();
        // Check for specific product IDs and change quantity
        if( in_array( $product_id, $specific_ids ) && $cart_item['quantity'] != $new_qty ){
            WC()->cart->set_quantity( $cart_item_key, $new_qty ); // Change quantity
        }
    }
	?>
	
	<?php if($product){ ?>
	
		<?php $cart_url   = wc_get_cart_url(); ?>
		<?php $checkout_url   = wc_get_checkout_url(); ?>
		
		<div class="woocommerce-message" role="alert">
			<a href="<?php echo esc_url( $cart_url ); ?>" tabindex="1" class="button wc-forward"><?php esc_html_e( 'View cart', 'bevesi' ); ?></a> 
			<?php echo esc_attr($quantity).' &times; ' . esc_html( $product->get_title() ); ?>
			<div class="klb-notice-close"><i class="klb-icon-x"></i></div>
			<p><?php esc_html_e('Cart Updated','bevesi'); ?></p>
		</div>
	<?php } ?>
	
	<?php


	wp_die();

}