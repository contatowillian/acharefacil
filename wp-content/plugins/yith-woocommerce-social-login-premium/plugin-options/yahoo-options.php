<?php
/**
 * Config file for HybridAuth Class
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH WooCommerce Social Login
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

$callback_url = YITH_YWSL_URL . 'includes/hybridauth/yahoo.php';


return array(

	'yahoo' => array(

		'section_yahoo_settings'     => array(
			'name' => __( 'Yahoo settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', $callback_url ),
			'type' => 'title',
			'id'   => 'ywsl_section_yahoo',
		),

		'yahoo_enable'               => array(
			'name'      => __( 'Enable Yahoo Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_yahoo_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'yahoo_key'                  => array(
			'name'      => __( 'Yahoo Consumer Key', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_yahoo_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'yahoo_secret'               => array(
			'name'      => __( 'Yahoo Consumer Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_yahoo_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'yahoo_icon'                 => array(
			'name'      => __( 'Yahoo Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_yahoo_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_yahoo_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_yahoo_end',
		),

	),
);
