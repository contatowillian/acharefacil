<?php
/*************************************************
* Mobile Filter
*************************************************/
add_action('wp_footer', 'bevesi_mobile_filter'); 
function bevesi_mobile_filter() { 

	$mobilebottommenu = get_theme_mod('bevesi_mobile_bottom_menu','0');
	if($mobilebottommenu == '1'){

?>	

	<?php $edittoggle = get_theme_mod('bevesi_mobile_bottom_menu_edit_toggle','0'); ?>
	<?php if($edittoggle == '1'){ ?>
		<div class="klb-mobile-bottom site-mobile-navbar">
			<div class="site-mobile-navbar-inner">
				<nav class="site-menu horizontal">
					<ul class="menu">
						<?php $editrepeater = get_theme_mod('bevesi_mobile_bottom_menu_edit'); ?>
						
						<?php foreach($editrepeater as $e){ ?>
							<?php if($e['mobile_menu_type'] == 'filter'){ ?>
								<?php if(is_shop()){ ?>
									<li>
										<a href="#" class="filter-button">
											<i class="klb-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
											<span class="mobile-navbar-label"><?php echo esc_html($e['mobile_menu_text']); ?></span>
										</a>
									</li>
								<?php } ?>
							<?php } elseif($e['mobile_menu_type'] == 'search'){ ?>
								<li>
									<a href="#" class="drawer-button" data-drawer="search-drawer">
										<i class="klb-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
										<span class="mobile-navbar-label"><?php echo esc_html($e['mobile_menu_text']); ?></span>
									</a>
								</li>
							<?php } elseif($e['mobile_menu_type'] == 'category'){ ?>
								<?php if(!is_shop()){ ?>
								<li>
									<a href="#" class="drawer-button" data-drawer="categories-drawer">
										<i class="klb-icon-layout-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
										<span class="mobile-navbar-label"><?php echo esc_html($e['mobile_menu_text']); ?></span>
									</a>
								</li>
								<?php } ?>
							<?php } else { ?>
								<li>
									<a href="<?php echo esc_url($e['mobile_menu_url']); ?>">
										<i class="klb-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
										<span class="mobile-navbar-label"><?php echo esc_html($e['mobile_menu_text']); ?></span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</div>
	<?php } else { ?>
		<div class="klb-mobile-bottom site-mobile-navbar">
			<div class="site-mobile-navbar-inner">
				<nav class="site-menu horizontal">
					<ul class="menu">
						<li>
							<?php if(!is_shop()){ ?>
								 
								<a href="<?php echo wc_get_page_permalink( 'shop' ); ?>">
									<i class="klb-icon-store-minimal"></i>
									<span class="mobile-navbar-label"><?php esc_html_e('STORE','bevesi-core'); ?></span>
								</a>							
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( "/" ) ); ?>">
									<i class="klb-icon-home"></i>
									<span class="mobile-navbar-label"><?php esc_html_e('HOME','bevesi-core'); ?></span>
								</a>
							<?php } ?>
						</li>

						<?php if(is_shop()){ ?>
							<li>
								<a href="#" class="filter-button">
									<i class="klb-icon-filter"></i>
									<span class="mobile-navbar-label"><?php esc_html_e('FILTER', 'bevesi-core'); ?></span>
								</a>
							</li>
						<?php } ?>
						
						<li>
							<a href="#" class="drawer-button" data-drawer="search-drawer">
								<i class="klb-icon-search"></i>
								<span class="mobile-navbar-label"><?php esc_html_e('SEARCH','bevesi-core'); ?></span>
							</a>
						</li>	
						
						<?php if ( class_exists( 'KlbWishlist' ) ) { ?>
							<li>
								<a href="<?php echo KlbWishlist::get_url(); ?>">
									<i class="klb-icon-hearth"></i>
									<span class="mobile-navbar-label"><?php esc_html_e('WISHLIST','bevesi-core'); ?></span>
								</a>
							</li>	
						<?php } ?>
						
						<li>
							<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>">
								<i class="klb-icon-user"></i>
								<span class="mobile-navbar-label"><?php esc_html_e('ACCOUNT','bevesi-core'); ?></span>
							</a>
						</li>

						<?php $sidebarmenu = get_theme_mod('bevesi_header_sidebar','0'); ?>
						<?php if($sidebarmenu == '1'){ ?>
							<?php if(!is_shop()){ ?>
								<li>
									<a href="#" class="drawer-button" data-drawer="categories-drawer">
										<i class="klb-icon-layout-list"></i>
										<span class="mobile-navbar-label"><?php esc_html_e('CATEGORIES','bevesi-core'); ?></span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
					
					</ul>
				</nav><!-- site-menu -->
			</div><!-- site-mobile-navbar-inner -->
		</div><!-- site-mobile-navbar -->

	<?php } ?>
	
<?php }

    
}