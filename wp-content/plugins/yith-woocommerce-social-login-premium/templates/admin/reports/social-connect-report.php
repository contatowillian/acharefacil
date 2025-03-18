<?php
/**
 * Show Social Connection report in Customer Tab of WooCommerce Report
 *
 * @package YITH WooCommerce Social Login Premium
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

?>
<div id="poststuff" class="woocommerce-reports-wide">
	<div class="postbox">

		<div class="inside">
			<div class="main">
				<div class="chart-container">
					<div class="social-connect" id="yith-social-connection" data-colors="<?php echo esc_attr( wp_json_encode( $colors ) ); ?>" data-pie="<?php echo esc_attr( wp_json_encode( $stats ) ); ?>"></div>

					<table class="yith_wc_social_connect widefat" cellspacing="0">
						<thead>
							<tr>
								<th class="color" width="1%"></th>
								<th class="network">Network</th>
								<th class="connections">Connections</th>
							</tr>
						</thead>
						<tbody class="ui-sortable">
						<?php
						$i = 0;
						foreach ( $stats as $stat ) :
							?>
							<tr>
								<td class="color">
									<span style="background-color: <?php echo esc_html( $colors[ $i++ ] ); ?>"></span>
								</td>
								<td class="network ui-sortable-handle">
									<?php echo wp_kses_post( $stat['label'] ); ?>
								</td>
								<td class="connections ui-sortable-handle">
									<?php echo wp_kses_post( $stat['data'] ); ?>
								</td>
							</tr>
						<?php endforeach; ?>

						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
