<?php
if ( ! function_exists( 'bevesi_wishlist_icon' ) ) {
	function bevesi_wishlist_icon(){
	?>

	<?php $wishlistheader = get_theme_mod('bevesi_header_wishlist',0); ?>
	<?php if($wishlistheader == 1){ ?>
	
		<?php if ( class_exists( 'KlbWishlist' ) ) { ?>	
			
			<div class="site-quick-button quick-button-wishlist style-1">
                <a href="<?php echo KlbWishlist::get_url(); ?>" class="quick-button-link">
					<div class="quick-button-icon">
						<i class="klb-icon-hearth"></i>
					</div><!-- quick-button-icon -->
					<div class="quick-button-text">
						<span class="quick-button-description"><?php esc_html_e('Listar','bevesi'); ?></span>
						<p class="quick-button-label"><?php esc_html_e('Favoritos','bevesi'); ?></p>
					</div><!-- quick-button-text -->
                </a>
            </div><!-- site-quick-button --> 
			
		<?php } ?>
		
	<?php } ?>
	
	<?php 
	
	}
}