<?php
/**
 * header.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( "charset" ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/wp-content/uploads/2024/03/logo-dark.png">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<?php if (get_theme_mod( 'bevesi_preloader' )) { ?>
	<div class="site-loading">
		<div class="preloading">
			<svg class="circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
			</svg>
		</div>
	</div>
	<?php } ?>

	<div id="page" class="page-content">
		
		<?php bevesi_do_action( 'bevesi_before_main_header'); ?>

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) { ?>
			<?php
			/**
			* Hook: bevesi_main_header
			*
			* @hooked bevesi_main_header_function - 10
			*/
			do_action( 'bevesi_main_header' );
		
			?>
		<?php } ?>
		
		<?php bevesi_do_action( 'bevesi_after_main_header'); ?> 
	
		<div id="main" class="main-content">