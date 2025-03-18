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
$deprecated_msg = '<div><h3 style="color: darkred;">' . __( 'Please note, Live has been discontinued. Support for legacy users only.', 'yith-woocommerce-social-login' ) . '</h3></div> ';
return array(

	'live' => array(

		'section_live_settings'     => array(
			'name' => __( 'Live settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => $deprecated_msg . sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . 'live.php' ),
			'type' => 'title',
			'id'   => 'ywsl_section_live',
		),

		'live_enable'               => array(
			'name'      => __( 'Enable Live Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_live_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'live_key'                  => array(
			'name'      => __( 'Live Consumer Key', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_live_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'live_secret'               => array(
			'name'      => __( 'Live Consumer Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_live_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'live_icon'                 => array(
			'name'      => __( 'Live Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_live_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_live_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_live_end',
		),

	),
);
