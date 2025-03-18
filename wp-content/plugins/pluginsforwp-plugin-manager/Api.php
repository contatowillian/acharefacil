<?php

namespace P4W\Plugin_Manager;

require_once 'My_Products_Controller.php';
require_once 'Settings_Controller.php';
require_once 'Support_Controller.php';

class Api_PluginsForWP {
	const ROUTE_NAMESPACE = 'pluginsforwp/v1';
	const SERVER_ROUTE_NAMESPACE = 'pluginsforwp/v1';
	const OPTIONS_PREFIX = 'pluginsforwp';

	public static function getServerUrl() {
		return getenv( 'P4W_TEST_SERVER' ) ?: Plugin_Manager_PluginsForWP::SERVER_URL;
	}

	/**
	 * Register controllers and api with wordpress
	 */
	public static function run() {
		add_action( 'rest_api_init',
			function () {
				$controllers = [
					My_Products_Controller_PluginsForWP::class,
					Settings_Controller_PluginsForWP::class,
					Support_Controller_PluginsForWP::class,
				];

				foreach ( $controllers as $controller ) {
					$instance = new $controller;
					$instance->register_routes();
				}
			}
		);
	}
}
