<?php
/**
 * Show Social Connection in My Account Page
 *
 * @package YITH WooCommerce Social Login
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

$soc = '';
if ( apply_filters( 'yit_social_login_show_form', true ) ) {
	?>
	<h2><?php echo wp_kses_post( apply_filters( 'ywsl_my_account_social_connection_title', esc_html__( 'Social Connections', 'yith-woocommerce-social-login' ) ) ); ?></h2>
	<?php
	if ( ! empty( $user_connections ) ) :
		$soc = esc_html__( 'also', 'yith-woocommerce-social-login' );
		?>
		<table class="shop_table shop_table_responsive my_account_social">

			<tbody>
			<?php
			foreach ( $user_connections as $provider => $social ) :

				if ( $social['profileURL'] ) {
					$profile = sprintf( '<a href="%s" target="_blank">$soc</a>', $social['profileURL'], $social['displayName'] );
				} else {
					$profile = $social['displayName'];
				}

				?>
				<tr class="order">
					<td class="sl-username" data-title="<?php esc_html_e( 'Username', 'yith-woocommerce-social-login' ); ?>">
						<?php echo wp_kses_post( $social['button'] ); ?>
						<?php echo wp_kses_post( $profile ); ?>
					</td>
					<td class="sl-unlink" data-title="<?php esc_html_e( 'Unlink', 'yith-woocommerce-social-login' ); ?>"><?php echo $social['unlink_button']; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>

		</table>
		<?php
	endif;
	if ( ! empty( $user_unlinked_social ) ) :
		?>
		<p>
		<?php
			// translators: the name of the social network.
			printf( esc_html__( 'You can %s login with:', 'yith-woocommerce-social-login' ), esc_html( $soc ) );
		?>
			</p>
		<?php

		foreach ( $user_unlinked_social as $key => $value ) {

			$social_args = array(
				'value'     => $value,
				'image_url' => apply_filters( 'ywsl_custom_icon_' . $key, YITH_YWSL_ASSETS_URL . '/images/' . $key . '.png', $key ),
				'class'     => 'ywsl-social ywsl-' . $key,
			);

			$social_args = apply_filters( 'yith_wc_social_login_args', $social_args );

			$image  = sprintf( '<img src="%s" alt="%s"/>', $social_args['image_url'], ( isset( $value['label'] ) ? $value['label'] : $value ) );
			$social = sprintf( '<div class="%s" data-social="%s">%s</div>', $social_args['class'], strtolower( $value['label'] ), $image );

			echo wp_kses_post( apply_filters( 'yith_wc_social_login_icon', $social, $key, $social_args ) );
		}

		?>
	<?php endif ?>
	<?php
}
