<div class="site-page-header style-1">
	<div class="container">
		<div class="site-page-header-inner">
			<?php $breadcrumb_title = get_theme_mod('bevesi_blog_breadcrumb_title'); ?>
			<?php if($breadcrumb_title){ ?>
				<h1 class="page-title"><?php echo esc_html($breadcrumb_title); ?></h1>
			<?php } else { ?>
				<h1 class="page-title"><?php echo esc_html_e('Our News','bevesi'); ?></h1>
			<?php } ?>
			<div class="entry-description">
				<p><?php echo bevesi_sanitize_data(get_theme_mod('bevesi_blog_breadcrumb_desc')); ?></p>
			</div><!-- entry-description -->
		</div><!-- site-page-header-inner -->
	</div><!-- container -->
</div><!-- site-page-header -->