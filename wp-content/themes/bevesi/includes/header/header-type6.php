<header id="masthead" class="site-header header-type6">
    <div id="header-top" class="site-header-row site-header-topbar header-row-bg-white header-row-text-slate border-container display-none display-block-laptop">
        <div class="container">
			<div class="site-header-inner">
				<div class="col display-inline-flex align-items-center justify-start">
					<?php if(get_theme_mod('bevesi_top_left_menu','0') == 1){ ?>
						<nav class="site-menu horizontal">
							<?php 
								wp_nav_menu(array(
								'theme_location' => 'top-left-menu',
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
					<?php } ?>	      
				</div><!-- col -->
				<div class="col display-inline-flex align-items-center justify-end">
					<?php if(get_theme_mod('bevesi_top_right_menu','0') == 1){ ?>
						<nav class="site-menu horizontal">
							<?php 
								wp_nav_menu(array(
								'theme_location' => 'top-right-menu',
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
					<?php } ?>			        
				</div><!-- col -->
			</div><!-- site-header-inner -->
        </div><!-- container -->
	</div><!-- site-header-row -->
    
    <div id="header-main" class="site-header-row site-header-main header-main-padding header-row-bg-white border-container">
        <div class="container">
			<div class="site-header-inner">
				<div class="col display-inline-flex display-none-laptop align-items-center flex-initial">
				  <div class="site-quick-button quick-button-menu-toggle">
					<a href="#" class="quick-button-link drawer-button" data-drawer="menu-drawer">
					  <div class="quick-button-icon">
						<i class="klb-icon-menu"></i>
					  </div><!-- quick-button-icon -->
					</a>
				  </div><!-- site-quick-button -->        
				</div><!-- col -->
				<div class="col display-inline-flex align-items-center justify-content-center justify-content-start-mobile flex-1 flex-initial-mobile">
					<div class="site-brand">
						<?php $elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true ); ?> 
							
							<?php if($elementor_page){ ?>
								<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
									<?php if(bevesi_page_settings('logo')['url']){ ?>
										<img src="<?php echo esc_url( bevesi_page_settings('logo')['url'] ); ?>" alt="<?php bloginfo("name"); ?>">
									<?php } elseif (get_theme_mod( 'bevesi_logo' )) { ?>
										<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bevesi_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
									<?php } elseif (get_theme_mod( 'bevesi_logo_text' )) { ?>
										<span class="brand-text"><?php echo esc_html(get_theme_mod( 'bevesi_logo_text' )); ?></span>
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-dark.png" width="122" height="36" alt="<?php bloginfo("name"); ?>">
									<?php } ?>
								</a>
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
									<?php if (get_theme_mod( 'bevesi_logo' )) { ?>
										<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bevesi_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
									<?php } elseif (get_theme_mod( 'bevesi_logo_text' )) { ?>
										<span class="brand-text"><?php echo esc_html(get_theme_mod( 'bevesi_logo_text' )); ?></span>
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-dark.png" width="122" height="36" alt="<?php bloginfo("name"); ?>">
									<?php } ?>
								</a>
							<?php } ?>
					</div><!-- site-brand -->      
				</div><!-- col -->
				<div class="col display-none display-inline-flex-laptop align-items-center flex-1">
					
					<?php bevesi_header_sale_banner(); ?>
              
					<div class="site-search-form search-form-desktop style-4">
						<?php echo bevesi_header_product_search(); ?> 
					</div><!-- site-search-form -->        
					
				</div><!-- col -->
				<div class="col display-none display-inline-flex-mobile align-items-center flex-1 flex-initial-laptop justify-content-end">
					<?php bevesi_wishlist_icon(); ?>         
					
					<?php bevesi_compare_icon(); ?>  
					
					<?php bevesi_account_icon(); ?>       
					
					<?php bevesi_cart_icon(); ?>         
				</div><!-- col -->
				<div class="col display-inline-flex display-none-mobile align-items-center flex-initial">
					<?php bevesi_cart_icon(); ?>      
				</div><!-- col -->
			</div><!-- site-header-inner -->
        </div><!-- container -->
    </div><!-- site-header-row -->
    
    <div id="header-bottom" class="site-header-row site-header-bottom header-row-bg-white border-full display-none display-block-laptop">
        <div class="container">
			<div class="site-header-inner">
				<div class="col display-inline-flex align-items-center justify-start">
					
					<?php bevesi_discount_products(); ?> 
					
					<nav class="site-menu horizontal primary-menu">
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
				</div><!-- col -->
				<div class="col display-inline-flex align-items-center justify-end flex-initial">
					<?php bevesi_header_notification(); ?>        
				</div><!-- col -->
			</div><!-- site-header-inner -->
        </div><!-- container -->
    </div><!-- site-header-row -->
</header><!-- site-heaader -->