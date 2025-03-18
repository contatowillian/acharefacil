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

	'github' => array(

		'section_github_settings'     => array(
			'name' => __( 'GitHub settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', YITH_WC_Social_Login()->get_base_url() . '?hauth.done=GitHub' ),
			'type' => 'title',
			'id'   => 'ywsl_section_github',
		),

		'github_enable'               => array(
			'name'      => __( 'Enable GitHub Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_github_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'github_key'                  => array(
			'name'      => __( 'GitHub Client ID', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_github_id',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'github_secret'               => array(
			'name'      => __( 'GitHub Client Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_github_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'github_icon'                 => array(
			'name'      => __( 'GitHub Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_github_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_github_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_github_end',
		),

	),
);
