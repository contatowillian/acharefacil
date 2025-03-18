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

if ( ywsl_check_wpengine() ) {
	$callback_url = site_url() . '/?hauth_done=Facebook';
} else {
	$callback_url = YITH_YWSL_URL . 'includes/hybridauth/facebook.php';
}

return array(

	'facebook' => array(

		'section_facebook_settings'     => array(
			'name' => __( 'Facebook settings', 'yith-woocommerce-social-login' ),
			'type' => 'title',
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sValid OAuth Redirect URI%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', $callback_url ),
			'id'   => 'ywsl_section_facebook',
		),

		'facebook_enable'               => array(
			'name'      => __( 'Enable Facebook Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_facebook_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'facebook_id'                   => array(
			'name'      => __( 'Facebook App ID', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_facebook_id',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'facebook_secret'               => array(
			'name'      => __( 'Facebook Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_facebook_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'facebook_icon'                 => array(
			'name'      => __( 'Facebook Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_facebook_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_facebook_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_facebook_end',
		),

	),
);
