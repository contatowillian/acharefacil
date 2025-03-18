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


return array(

	'tumblr' => array(

		'section_tumblr_settings'     => array(
			'name' => __( 'Tumblr settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . '?hauth.done=Tumblr' ),
			'type' => 'title',
			'id'   => 'ywsl_section_tumblr',
		),

		'tumblr_enable'               => array(
			'name'      => __( 'Enable Tumblr Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_tumblr_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'tumblr_key'                  => array(
			'name'      => __( 'Tumblr Consumer Key', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_tumblr_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'tumblr_secret'               => array(
			'name'      => __( 'Tumblr Secret Key', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_tumblr_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'tumblr_icon'                 => array(
			'name'      => __( 'Tumblr Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_tumblr_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_tumblr_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_tumblr_end',
		),

	),
);
