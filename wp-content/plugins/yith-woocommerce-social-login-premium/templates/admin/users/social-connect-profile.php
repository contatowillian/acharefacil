<?php
/**
 * Show Social Connection info in User Profile
 *
 * @package YITH WooCommerce Social Login Premium
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

?>
<h3><?php esc_html_e( 'Social Connections', 'yith-woocommerce-social-login' ); ?></h3>
<table class="form-table">
	<tbody>
		<tr>
			<th></th>
			<td>
				<?php echo wp_kses_post( $connections ); ?>
			</td>
		</tr>
	</tbody>
</table>
