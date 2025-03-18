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

	'instagram' => array(

		'section_instagram_settings'     => array(
			'name' => __( 'Instagram settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . '?hauth.done=Instagram' ),
			'type' => 'title',
			'id'   => 'ywsl_section_instagram',
		),

		'instagram_enable'               => array(
			'name'      => __( 'Enable Instagram Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_instagram_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'instagram_key'                  => array(
			'name'      => __( 'Instagram Client ID', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_instagram_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'instagram_secret'               => array(
			'name'      => __( 'Instagram Client Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_instagram_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'instagram_icon'                 => array(
			'name'      => __( 'Instagram Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_instagram_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_instagram_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_instagram_end',
		),

	),
);
