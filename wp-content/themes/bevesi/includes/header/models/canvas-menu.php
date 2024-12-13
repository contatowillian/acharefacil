<?php

if ( ! function_exists( 'bevesi_header_canvas_menu' ) ) {
	function bevesi_header_canvas_menu(){

		?>
		
		<div id="menu-drawer" class="site-drawer">
			<div class="site-drawer-inner get-mobile-nav-height">
				<div class="site-drawer-row site-drawer-header">
					<div class="site-brand">
						<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
							<?php if (get_theme_mod( 'bevesi_logo' )) { ?>
						<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bevesi_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
							<?php } elseif (get_theme_mod( 'bevesi_logo_text' )) { ?>
						<span><?php echo esc_html(get_theme_mod( 'bevesi_logo_text' )); ?></span>
							<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-dark.png" alt="<?php bloginfo("name"); ?>">   
							<?php } ?>
						</a>
					</div><!-- site-brand -->        
					<div class="site-close">
						<a href="#"><i class="klb-icon-x"></i></a>
					</div><!-- site-close -->   
				</div><!-- site-drawer-row -->
				<div class="site-drawer-row site-drawer-body">
					<h4 class="site-drawer-heading"><?php esc_html_e('Primary Menu','bevesi'); ?></h4>
					<nav class="site-menu vertical site-menu-drawer drawer-primary-menu">
						<?php 
						wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => '',
						'fallback_cb' => 'show_top_menu',
						'menu_id' => '',
						'menu_class' => 'menu',
						'echo' => true,
						"walker" => '',
						'depth' => 0 
						));
						?>    
					</nav><!-- site-menu -->      
					
					<?php $canvasbottommenu = get_theme_mod('bevesi_canvas_bottom_menu','0'); ?>
						<?php if($canvasbottommenu == '1'){ ?>
						
							<h4 class="site-drawer-heading"><?php esc_html_e('Second Menu','bevesi'); ?></h4>
							<div class="site-menu vertical drawer-secondary-menu">
								<?php 
									 wp_nav_menu(array(
									 'theme_location' => 'canvas-bottom',
									 'container' => '',
									 'fallback_cb' => 'show_top_menu',
									 'menu_id' => '',
									 'menu_class' => 'menu',
									 'echo' => true,
									 'depth' => 0 
									)); 
								?>
							</div><!-- site -->    
					<?php } ?>	
				</div><!-- site-drawer-row -->
			</div><!-- site-drawer-inner -->
			<div class="site-drawer-overlay"></div>
		</div><!-- site-drawer --> 
		
	<?php }
}

add_action('wp_footer', 'bevesi_header_canvas_menu');