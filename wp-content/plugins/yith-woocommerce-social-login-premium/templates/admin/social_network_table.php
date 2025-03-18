<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Show Social Connection table in general settings
 *
 * @package YITH WooCommerce Social Login Premium
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

?>
<tr valign="top">
	<th scope="row" class="titledesc"><?php esc_html_e( 'Social Connections', 'yith-woocommerce-social-login' ); ?></th>
	<td class="forminp">
<table class="ywsl_social_networks widefat" cellspacing="0">
	<thead>
	<tr>
		<th class="name"><?php esc_html_e( 'Social Network', 'yith-woocommerce-social-login' ); ?></th>
		<th class="status"><?php esc_html_e( 'Status', 'yith-woocommerce-social-login' ); ?></th>
		<th class="settings">&nbsp;</th>
	</tr>
	</thead>
	<tbody class="ui-sortable">

	<?php
	foreach ( $tabs as $key => $tab ) : //phpcs:ignore
			$status = ( get_option( 'ywsl_' . $key . '_enable' ) === 'yes' ) ? array( 'enabled', __( 'Enabled', 'yith-woocommerce-social-login' ) ) : array( 'disabled', __( 'Disabled', 'yith-woocommerce-social-login' ) ); //phpcs:ignore
		?>
		<tr>
			<td class="name ui-sortable-handle">
				<input type="hidden" name="<?php echo esc_attr( $id ); ?>[]" value="<?php echo esc_attr( $key ); ?>">
				<span class="icon-social"><img src="<?php echo esc_url( YITH_YWSL_ASSETS_URL . '/images/' . $key . '.png' ); ?>"></span>
				<?php echo wp_kses_post( $tab ); ?>
			</td>
			<td class="status ui-sortable-handle">
				<span class="status-<?php echo esc_attr( $status[0] ); ?>"><?php echo wp_kses_post( $status[1] ); ?></span>
			</td>
			<td class="settings ui-sortable-handle">
				<a class="button" href="<?php echo esc_url( admin_url( "admin.php?page={$panel_page}&tab={$key}" ) ); ?>"><?php esc_html_e( 'Settings', 'yith-woocommerce-social-login' ); ?></a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
	<tr>
		<th colspan="3">
			<span class="description"><?php esc_html_e( 'Drag and drop the above listed icons for social networks to set their display order.', 'yith-woocommerce-social-login' ); ?></span>
		</th>
	</tr>
	</tfoot>
</table>
		</td>
	</tr>
