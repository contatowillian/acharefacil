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

	'google' => array(

		'section_google_settings'     => array(
			'name' => __( 'Google settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . '?hauth.done=Google' ),
			'type' => 'title',
			'id'   => 'ywsl_section_google',
		),

		'google_enable'               => array(
			'name'      => __( 'Enable Google Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_google_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'google_id'                   => array(
			'name'      => __( 'Google ID', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_google_id',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'google_secret'               => array(
			'name'      => __( 'Google secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_google_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'google_icon'                 => array(
			'name'      => __( 'Google Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_google_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_google_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_google_end',
		),
	),
);
