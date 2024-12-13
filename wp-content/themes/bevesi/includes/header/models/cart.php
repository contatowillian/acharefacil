<?php
if ( ! function_exists( 'bevesi_cart_icon' ) ) {
	function bevesi_cart_icon(){
		$headercart = get_theme_mod('bevesi_header_cart','0');
		if($headercart == '1'){
			global $woocommerce;
			$carturl = wc_get_cart_url(); 
			?>
				
				<div class="site-quick-button quick-button-cart style-3">
					<a href="<?php echo esc_url($carturl); ?>" class="quick-button-link">
						<div class="quick-button-icon">
							<i class="klb-icon-shopping-bag-wide"></i>
							<span class="quick-button-count cart-count count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'bevesi'), $woocommerce->cart->cart_contents_count);?></span>
						</div><!-- quick-button-icon -->
					</a>
					
					<div class="site-mini-cart">
						<div class="site-mini-cart-inner">
							<div class="site-mini-cart-row site-mini-cart-body">
								<div class="fl-mini-cart-content">
									<?php woocommerce_mini_cart(); ?>
								</div><!-- fl-mini-cart-content -->
							</div><!-- site-mini-cart-row -->
							
						</div><!-- site-mini-cart-inner -->
					</div><!-- site-mini-cart -->
				</div><!-- site-quick-button --> 
				
		<?php }
	}
}