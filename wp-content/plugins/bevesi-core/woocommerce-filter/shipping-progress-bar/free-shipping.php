<?php
/*************************************************
## Free shipping progress bar.
*************************************************/
function bevesi_shipping_progress_bar() {
		
		$total           = WC()->cart->get_displayed_subtotal();
		$limit           = get_theme_mod( 'shipping_progress_bar_amount' );
		$percent         = 100;


		if ( $total < $limit ) {
			$percent = floor( ( $total / $limit ) * 100 );
			$message = str_replace( '[remainder]', wc_price( $limit - $total ), get_theme_mod( 'shipping_progress_bar_message_initial' ) );
			$class = 'warning';
		} else {
			$message = get_theme_mod( 'shipping_progress_bar_message_success' );
			$class = 'bg-green-50 border-green-200';
		}
		
	?>	
		
		<div class="klb-free-shipping woocommerce-notice site-free-shipping background-green-50 border-green-200 <?php echo esc_attr($class); ?>">
			<div class="notice-header shipping-notice-header color-green-800">
			  <i class="klb-icon-box"></i>
			  <p><?php echo wp_kses( $message, 'post' ); ?></p>
			</div><!-- shipping-notice -->
			<div class="shipping-progress">
			  <span class="background-green-600" style="width: <?php echo esc_attr( $percent ); ?>%"></span>
			</div><!-- shipping-progress -->
		</div>
			
	<?php
}

/*************************************************
## Free shipping progress bar.
*************************************************/
function bevesi_shipping_cart_progress_bar() {
		
		$total           = WC()->cart->get_displayed_subtotal();
		$limit           = get_theme_mod( 'shipping_progress_bar_amount' );
		$percent         = 100;


		if ( $total < $limit ) {
			$percent = floor( ( $total / $limit ) * 100 );
			$message = str_replace( '[remainder]', wc_price( $limit - $total ), get_theme_mod( 'shipping_progress_bar_message_initial' ) );
			$class = 'warning';
		} else {
			$message = get_theme_mod( 'shipping_progress_bar_message_success' );
			$class = 'success';
		}
		
	?>	
		<div class="klb-cart-free-shipping <?php echo esc_attr($class); ?>">
			<div class="site-mini-cart-notice background-slate-50 color-slate-800">
				<p><?php echo wp_kses( $message, 'post' ); ?></p>
				<div class="site-mini-cart-progress">
				  <span style="width: <?php echo esc_attr( $percent ); ?>%;"></span>
				</div><!-- site-mini-cart-progress -->
			</div><!-- site-mini-cart-notice -->
		</div>
			
	<?php
}

if(get_theme_mod( 'shipping_progress_bar_location_card_page',0) == '1'){
	add_action( 'woocommerce_before_cart_table',  'bevesi_shipping_progress_bar' );
}

if(get_theme_mod( 'shipping_progress_bar_location_mini_cart',0) == '1'){
	add_action( 'woocommerce_after_mini_cart', 'bevesi_shipping_cart_progress_bar' );
}

if(get_theme_mod( 'shipping_progress_bar_location_checkout',0) == '1'){
	add_action( 'woocommerce_checkout_billing', 'bevesi_shipping_progress_bar' );
}
