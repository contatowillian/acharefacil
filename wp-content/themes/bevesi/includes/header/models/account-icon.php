<?php

if ( ! function_exists( 'bevesi_account_icon' ) ) {
	function bevesi_account_icon(){
		$headersearch = get_theme_mod('bevesi_header_account','0');
		if($headersearch == 1){
						
		?>
			<div class="site-quick-button quick-button-account style-1">
				<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="quick-button-link">
					<div class="quick-button-icon">
						<i class="klb-icon-user"></i>
					</div><!-- quick-button-icon -->
					 <div class="quick-button-text">
						<?php if(is_user_logged_in()){ ?>
							<?php $current_user = wp_get_current_user(); ?>
							<span class="quick-button-description"><?php esc_html_e('Bem Vindo','bevesi'); ?></span>
							<p class="quick-button-label"><?php echo esc_html($current_user->user_login); ?></p>
						<?php } else { ?>
							<span class="quick-button-description"><?php esc_html_e('Logar','bevesi'); ?></span>
							<p class="quick-button-label"><?php esc_html_e('Conta','bevesi'); ?></p>
						<?php } ?>
						
					</div><!-- quick-button-text -->
				</a>
            </div><!-- site-quick-button --> 
	<?php  }
	}
}