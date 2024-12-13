<?php
if ( ! function_exists( 'bevesi_top_notification' ) ) {
	function bevesi_top_notification(){
		$topnotification = get_theme_mod('bevesi_top_notification_toggle','0'); 
		if($topnotification == '1'){ ?>
			
			<div class="site-notification site-notification-global bg-primary color-white" style="background-image: url(<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bevesi_top_notification_image' )) ); ?>);">
				<div class="container">
					<div class="site-notification-inner">
						<p><?php echo esc_html(get_theme_mod('bevesi_top_notification_title')); ?></p>
						<a href="<?php echo esc_attr(get_theme_mod('bevesi_top_notification_button_url')); ?>" class="button black size-xs"><?php echo esc_html(get_theme_mod('bevesi_top_notification_button_title')); ?></a>
					</div><!-- site-notification-inner -->
				</div><!-- container -->
			</div><!-- site-notification -->
			
		<?php  }
	}
}

add_action('bevesi_before_main_header', 'bevesi_top_notification');