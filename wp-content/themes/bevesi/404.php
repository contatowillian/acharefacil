<?php
/**
 * 404.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0
 */
?>

<?php get_header(); ?>


<div class="container">
	<div class="page-header text-center my-10 mobile:my-52">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/404.png" class="max-w-[40%] mb-10">
			<h1 class="entry-title text-2xl mobile:text-4xl font-semibold"><?php esc_html_e('404 - PAGE NOT FOUND','bevesi'); ?></h1>
			<div class="entry-teaser mb-3.5">
				<p class="mb-0 color-slate-500"><?php esc_html_e('It looks like nothing was found at this location. Maybe try to search for what you are looking for?','bevesi'); ?></p>
			</div><!-- entry-teaser -->
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="button primary"><?php esc_html_e('Go To Homepage','bevesi'); ?></a>
		</div><!-- container -->
	</div><!-- page-header -->
</div>

<?php get_footer(); ?>