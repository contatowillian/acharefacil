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

$callback_url = YITH_YWSL_URL . 'includes/hybridauth/twitter.php';

return array(

	'twitter' => array(

		'section_twitter_settings'     => array(
			'name' => __( 'Twitter settings', 'yith-woocommerce-social-login' ),
			// translators: 1. html tag, 2. url, 3. html tag.
			'desc' => sprintf( esc_html__( '%1$sCallback URL%2$s: %3$s', 'yith-woocommerce-social-login' ), '<strong>', '</strong>', $callback_url ),
			'type' => 'title',
			'id'   => 'ywsl_section_twitter',
		),

		'twitter_enable'               => array(
			'name'      => __( 'Enable Twitter Login', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_twitter_enable',
			'default'   => 'no',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
		),

		'twitter_key'                  => array(
			'name'      => __( 'Twitter Key', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_twitter_key',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'twitter_secret'               => array(
			'name'      => __( 'Twitter Secret', 'yith-woocommerce-social-login' ),
			'desc'      => '',
			'id'        => 'ywsl_twitter_secret',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'text',
		),

		'twitter_icon'                 => array(
			'name'      => __( 'Twitter Icon', 'yit' ),
			'desc'      => '',
			'id'        => 'ywsl_twitter_icon',
			'default'   => '',
			'type'      => 'yith-field',
			'yith-type' => 'upload',
		),

		'section_twitter_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_twitter_end',
		),

	),
);
