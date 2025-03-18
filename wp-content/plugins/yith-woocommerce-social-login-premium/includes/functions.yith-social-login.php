<?php
/**
 * General functions
 *
 * @package YITH WooCommerce Social Login
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

/**
 * Return the current page
 *
 * @return string
 * @since    1.0.0
 */
function ywsl_curPageURL() { //phpcs:ignore
	$page_url = 'http';  //phpcs:ignore
	if ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ) { //phpcs:ignore
		$page_url .= 's';
	}
	$page_url .= '://';
	if ( '80' !== $_SERVER['SERVER_PORT'] ) { //phpcs:ignore
		$page_url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']; //phpcs:ignore
	} else {
		$page_url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; //phpcs:ignore
	}
	return $page_url;
}

/**
 * Sort Provider Array
 *
 * @param mixed $a First element.
 * @param mixed $b Second element.
 * @return array
 * @since    1.0.0
 */
function ywsl_providers_stats_sort( $a, $b ) {
	return $b['data'] - $a['data'];
}

if ( ! function_exists( 'ywsl_check_wpengine' ) ) {
	/**
	 * Check if the website is stored on wp engine
	 *
	 * @return bool
	 * @since 1.3.0
	 */
	function ywsl_check_wpengine() {
		$is_wp_engine = defined( 'WPE_APIKEY' );

		if ( $is_wp_engine && ! defined( 'YWSL_FINAL_SLASH' ) ) {
			define( 'YWSL_FINAL_SLASH', true );
		}

		return $is_wp_engine;
	}
}
