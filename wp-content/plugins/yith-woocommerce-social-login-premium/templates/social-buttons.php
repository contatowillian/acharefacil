<?php
/**
 * Section to show social login buttons
 *
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 * @package YITH WooCommerce Social Login
 */

?>

<div class="wc-social-login">
	<style>
		a.ywsl-social {
			text-decoration: none;
			display: inline-block;
			margin-right: 2px;
		}
	</style>
	<?php if ( ! empty( $label ) ) : ?>
	<p class="ywsl-label"><?php echo wp_kses_post( $label ); ?></p>
	<?php endif; ?>
	<div class="socials-list">
		<?php YITH_WC_Social_Login_Frontend()->social_buttons( 'social-icons', false, $args ); ?>
	</div>
</div>
