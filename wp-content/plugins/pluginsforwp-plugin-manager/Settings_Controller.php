<?php

namespace P4W\Plugin_Manager;

use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;

class Settings_Controller_PluginsForWP extends WP_REST_Controller {
	const PLUGINS_FOR_WP_USERNAME = Api_PluginsForWP::OPTIONS_PREFIX . '_username';
	const PLUGINS_FOR_WP_SECRET_KEY = Api_PluginsForWP::OPTIONS_PREFIX . '_secret_key';
	const PLUGINS_FOR_WP_AFFILIATE = Api_PluginsForWP::OPTIONS_PREFIX . '_affiliate';
	const PLUGINS_FOR_WP_BANNER = Api_PluginsForWP::OPTIONS_PREFIX . '_banner';

	public function register_routes() {
		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/settings/save',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'save_settings' ],
					'permission_callback' => [ $this, 'save_settings_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/settings/update-admin-banner-time',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'update_admin_banner_time' ],
					'permission_callback' => [ $this, 'update_admin_banner_time_check' ],
				],
			]
		);
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function save_settings( $request ) {
		$settings = \json_decode( $request->get_body(), true );

		update_option( self::PLUGINS_FOR_WP_USERNAME, trim( $settings['username'] ) );
		update_option( self::PLUGINS_FOR_WP_SECRET_KEY, trim( $settings['key'] ) );
		update_option( self::PLUGINS_FOR_WP_AFFILIATE, trim( $settings['affiliate'] ) );

		return new WP_REST_Response( [], 200 );
	}

	/**
	 * @param $request
	 */
	public function update_admin_banner_time( $request ) {
		update_option( self::PLUGINS_FOR_WP_BANNER, time() );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return bool|true
	 */
	public function save_settings_permissions_check( $request ) {
		return current_user_can( 'manage_options' );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function update_admin_banner_time_check( $request ) {
		return current_user_can( 'manage_options' );
	}
}
