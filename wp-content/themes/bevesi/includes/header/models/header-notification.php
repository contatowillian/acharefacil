<?php
if ( ! function_exists( 'bevesi_header_notification' ) ) {
	function bevesi_header_notification(){
		$headernotification = get_theme_mod('bevesi_header_notification_toggle','0'); 
		if($headernotification == '1'){ ?>
			
			<div class="site-header-text-message">
                <a href="#"><p><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_header_notification_content')); ?></p>
					<i class="<?php echo bevesi_sanitize_data(get_theme_mod('bevesi_header_notification_icon')); ?>"></i> 
				</a>
            </div> 
			
		<?php  }
	}
}