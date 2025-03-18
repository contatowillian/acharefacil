<?php
/**
 * Section to show social login buttons
 *
 * @package YITH WooCommerce Social Login
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

?>
<?php

if ( ! empty( $label_checkout ) ) :
	?>
	<p class="woocommerce-info"><?php wp_kses_post( printf( '%s <a href="#" class="show-ywsl-box">' . esc_html__( 'Click here to login', 'yith-woocommerce-social-login' ) . '</a>', wp_kses_post( $label_checkout ) ) ); ?>
	<form class="login ywsl-box">
	<?php
	endif;

	YITH_WC_Social_Login_Frontend()->social_buttons( 'social-icons' );
?>

</form>
