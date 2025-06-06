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

	'foursquare' => array(

		'section_foursquare_settings'     => array(
			'name' => __( 'Foursquare settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . '?hauth.done=Foursquare' ),
			'type' => 'title',
			'id'   => 'ywsl_section_foursquare',
		),

		'foursquare_enable'               => array(
			'name'      => __( 'Enable Foursquare Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_foursquare_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'foursquare_key'                  => array(
			'name'      => __( 'Foursquare Client ID', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_foursquare_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'foursquare_secret'               => array(
			'name'      => __( 'Foursquare Client Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_foursquare_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'foursquare_icon'                 => array(
			'name'      => __( 'Foursquare Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_foursquare_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_foursquare_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_foursquare_end',
		),

	),
);
