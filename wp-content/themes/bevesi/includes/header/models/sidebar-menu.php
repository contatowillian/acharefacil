<?php
if ( ! function_exists( 'bevesi_sidebar_menu' ) ) {
	function bevesi_sidebar_menu(){
	?>
		<?php $sidebarmenu = get_theme_mod('bevesi_header_sidebar','0'); ?>
		<?php if($sidebarmenu == '1'){ ?>
		
		<div class="site-header-custom-button categories-button categories-menu">
			<a href="#" class="has-dropdown">
			  <div class="custom-button-icon"><i class="klb-icon-layout-grid"></i></div>
			  <div class="custom-button-label">
				<span class="custom-button-name"><?php esc_html_e('All Categories','bevesi'); ?></span>
				<span class="custom-button-description"><?php esc_html_e('More than 100K.','bevesi'); ?></span>
			  </div><!-- custom-button-label -->
			</a>
			
			
			<?php if(bevesi_page_settings('enable_sidebar_collapse') == 'yes'){ ?>
				<?php $menu_collapse = 'collapse show'; ?>
			<?php } else { ?>
				<?php $menu_collapse = is_front_page() && !get_theme_mod('bevesi_header_sidebar_collapse') ? 'collapse show' : 'collapse'; ?>
			<?php } ?>
			
			<nav class="site-categories style-1 <?php echo esc_attr($menu_collapse); ?>">
				<?php
				wp_nav_menu(array(
				'theme_location' => 'sidebar-menu',
				'container' => '',
				'fallback_cb' => 'show_top_menu',
				'menu_id' => '',
				'menu_class' => 'menu',
				'echo' => true,
				"walker" => '',
				'depth' => 0 
				));
				?>  
            </nav><!-- site-categories -->
		</div><!-- site-header-custom-button --> 
		  
		
				
		<?php  }
	}
}