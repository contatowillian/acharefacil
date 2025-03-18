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

$callback_url = YITH_YWSL_URL . 'includes/hybridauth/vkontakte.php';

return array(

	'vkontakte' => array(

		'section_vkontakte_settings'     => array(
			'name' => __( 'Vkontakte settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', $callback_url ),
			'type' => 'title',
			'id'   => 'ywsl_section_vkontakte',
		),

		'vkontakte_enable'               => array(
			'name'      => __( 'Enable Vkontakte Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_vkontakte_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'vkontakte_id'                   => array(
			'name'      => __( 'Vkontakte App ID', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_vkontakte_id',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'vkontakte_secret'               => array(
			'name'      => __( 'Vkontakte Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_vkontakte_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'vkontakte_icon'                 => array(
			'name'      => __( 'Vkontakte Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_vkontakte_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_vkontakte_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_vkontakte_end',
		),

	),
);
