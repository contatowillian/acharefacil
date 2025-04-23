<footer class="site-footer footer-type3">
	<?php $footericonboxes = get_theme_mod('bevesi_footer_icon_box',0); ?>
		<?php if($footericonboxes == 1){ ?>	
		
		<div id="footer-iconboxes" class="site-footer-row border-container footer-row-background-white">
			<div class="container">
				<div class="site-footer-inner">
					<div class="iconboxes-content flex-initial">
						<h4 class="text-lg font-semibold mb-0"><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_footer_icon_box_title')); ?></h4>
						<p class="text-sm mb-0"><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_footer_icon_box_subtitle')); ?></p>
					</div><!-- iconboxes-content -->
					<div class="iconboxes flex-1">
					
						<?php $footericonbox = get_theme_mod('bevesi_footer_icon_box_repeater',0); ?>
							<?php if($footericonbox){ ?>
								<div class="iconboxes flex-1">
								<?php foreach($footericonbox as $f){ ?>
								
									<div class="iconbox">
										<div class="icon">
										  <i class="<?php echo esc_attr($f['box_icon']); ?>"></i>
										</div><!-- icon -->
										<div class="content">
										  <h4 class="entry-title"><?php echo esc_html($f['icon_box_title']); ?></h4>
										  <p><?php echo esc_html($f['icon_box_desc']); ?></p>
										</div><!-- content -->
									</div><!-- iconbox -->	
									
								<?php } ?>
								</div><!-- iconboxes -->
						<?php } ?>
						
					</div><!-- iconboxes -->
				</div><!-- site-footer-inner -->
			</div><!-- container -->
			<img class='img-selo-seguro-rodape'  src="<?php echo get_template_directory_uri(); ?>/assets/img/certificado_loja_segura.png" alt="Selo Seguro"/>

		</div><!-- site-footer-row -->
	<?php } ?>	
		
		
	<?php $subscribe = get_theme_mod('bevesi_footer_subscribe_area',0); ?>
		<?php if($subscribe == 1){ ?>		
			<div id="footer-newsletter" class="site-footer-row footer-row-background-black footer-row-color-white footer-newsletter-style-1">
				<div class="container">
					<div class="site-footer-inner">
						<div class="footer-icon">
							<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod('bevesi_footer_subscribe_image'))); ?>" alt="<?php esc_attr_e('subscribe','bevesi'); ?>">      							      
						</div><!-- footer-icon -->
						<div class="footer-newsletter-text">
							<h4 class="entry-title"><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_footer_subscribe_title')); ?></h4>
							<p><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_footer_subscribe_subtitle')); ?></p>
						</div><!-- footer-newsletter-text -->
						<div class="footer-newsletter-form">
							<?php echo do_shortcode('[mc4wp_form id="'.get_theme_mod('bevesi_footer_subscribe_formid').'"]'); ?>
						</div><!-- footer-newsletter-form -->
					</div><!-- site-footer-inner -->
				</div><!-- container -->
			</div><!-- site-footer-row -->
	<?php } ?>
		
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-4' )) { ?>

    <div id="footer-widgets" class="site-footer-row footer-row-background-black footer-row-color-white border-full">
        <div class="container">
			<?php if(get_theme_mod('bevesi_footer_column') == '3columns'){ ?>
				<div class="site-footer-inner widgets-column-3">
					<div class="column">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div><!-- col -->
				</div>
			<?php } elseif(get_theme_mod('bevesi_footer_column') == '4columns'){ ?>
				<div class="site-footer-inner widgets-column-4">
					<div class="column">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div><!-- col -->
				</div>
			<?php } else { ?>
				<div class="site-footer-inner widgets-column-5">
					<div class="column">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div><!-- col -->
					<div class="column">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div><!-- col -->
					
					<?php $appimage = get_theme_mod('bevesi_footer_app_image'); ?>
					<?php if($appimage){ ?>
						<div class="column">
							<div class="widget">
								<div class="widget-body">
									<div class="contact-info">
										<div class="contact-item"><?php echo bevesi_sanitize_data(get_theme_mod( 'bevesi_footer_app_title' )); ?></div><!-- contact-item -->
						  
										<div class="contact-item"><?php echo bevesi_sanitize_data(get_theme_mod( 'bevesi_footer_app_subtitle' )); ?></div><!-- contact-item -->
									</div><!-- contact-info -->
									
									<div class="app-buttons">
										<?php foreach($appimage as $app){ ?>
											<div class="app-button">
											  <a href="<?php echo esc_url($app['app_url']); ?>"><img src="<?php echo esc_url( bevesi_get_image($app['app_image'])); ?>" alt="<?php esc_attr_e('app','bevesi'); ?>"/></a>
											  <p><?php echo esc_html($app['app_image_title']); ?></p>
											</div><!-- app-button -->
										<?php } ?>
									</div><!-- app-buttons -->
								</div><!-- widget-body -->
							</div><!-- widget -->
						</div><!-- column -->
					<?php } ?>	
				</div>
			<?php } ?>
		</div><!-- container -->
    </div><!-- site-footer-row -->
	
	<?php } ?>
	
	<?php $footercontacts = get_theme_mod('bevesi_footer_contact_icon',0); ?>
		<?php if($footercontacts == 1){ ?>
		
		<div id="footer-contact" class="site-footer-row footer-row-background-black footer-row-color-white border-full">
			<div class="container">
				<?php $footercontact = get_theme_mod('bevesi_footer_contact_repeater',0); ?>
				<?php if($footercontact){ ?>
					<div class="site-footer-inner">
						<ul>
							<?php foreach($footercontact as $f){ ?>
								<li>
									<a href="<?php echo esc_url($f['contact_url']); ?>">
									  <i class="<?php echo esc_attr($f['contact_icon']); ?>"></i>
									  <p><?php echo esc_html($f['contact_title']); ?></p>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div><!-- site-footer-inner -->
				<?php } ?>
			</div><!-- container -->
		</div><!-- site-footer-row -->
	
	<?php } ?>
	
    <div id="footer-copyright" class="site-footer-row footer-row-background-black footer-row-color-white border-full get-mobile-nav-height">
        <div class="container">
			<div class="site-footer-inner">
				
				<?php $footersocial = get_theme_mod('bevesi_footer_social_list'); ?>
				<?php if($footersocial){ ?>
					<div class="site-social">
						<ul class="social-media color-white rounded-style shadow-style justify-content-center">
							<?php foreach($footersocial as $f){ ?>
								<li><a href="<?php echo esc_url($f['social_url']); ?>" class="<?php echo esc_attr($f['social_icon']); ?>"><i class="klb-social-icon-<?php echo esc_attr($f['social_icon']); ?>"></i></a></li>
							<?php } ?>	
						</ul>
					</div><!-- site-social -->
				<?php } ?>
				
				<div class="site-copyright-content">
				  <p><?php echo bevesi_sanitize_data(get_theme_mod( 'bevesi_second_copyright' )); ?></p>
				</div><!-- site-copyright-content -->
				
				<?php if(get_theme_mod( 'bevesi_copyright' )){ ?>
					<!--<p class="site-copyright"><?php echo bevesi_sanitize_data(get_theme_mod( 'bevesi_copyright' )); ?></p>-->
				<?php } else { ?>
					<p class="site-copyright"><?php esc_html_e('Copyright 2024.KlbTheme . All rights reserved','bevesi'); ?></p>
				<?php } ?>       
			</div><!-- site-footer-inner -->
        </div><!-- container -->
    </div><!-- site-footer-row -->
</footer><!-- site-footer --> 