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

	'linkedin' => array(

		'section_linkedin_settings'     => array(
			'name' => __( 'LinkedIn settings', 'yith-woocommerce-social-login' ),
			'type' => 'title',
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . '?hauth.done=LinkedIn' ),

			'id'   => 'ywsl_section_linkedin',
		),

		'linkedin_enable'               => array(
			'name'      => __( 'Enable LinkedIn Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_linkedin_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'linkedin_api_key'              => array(
			'name'      => __( 'LinkedIn Api Key', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_linkedin_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'linkedin_secret'               => array(
			'name'      => __( 'LinkedIn secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_linkedin_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'linkedin_icon'                 => array(
			'name'      => __( 'LinkedIn Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_linkedin_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_linkedin_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_linkedin_end',
		),
	),
);
