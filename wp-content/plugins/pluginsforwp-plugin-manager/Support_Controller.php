<?php

namespace P4W\Plugin_Manager;

use RuntimeException;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;

class Support_Controller_PluginsForWP extends WP_REST_Controller {
	public function register_routes() {
		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/support/link',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'create_support_link' ],
					'permission_callback' => [ $this, 'create_support_link_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/support/link-list',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'list_support_links' ],
					'permission_callback' => [ $this, 'list_support_links_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/support/deps',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'install_dependencies' ],
					'permission_callback' => [ $this, 'install_dependencies_permissions_check' ],
				],
			]
		);
	}

	/**
	 * Create a support link
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function create_support_link( $request ) {
		if ( ! class_exists( 'Wp_Temporary_Login_Without_Password_Common' ) ) {
			throw new RuntimeException( 'Temporary Login Without Password plugin is not installed' );
		}

		$user = \Wp_Temporary_Login_Without_Password_Common::create_new_user( [
			'first_name' => 'PluginsForWP',
			'last_name'  => 'Support',
			'user_email' => 'support@pluginsforwp.com',
			'role'       => 'administrator',
			'expiry'     => 'week',
		] );

		$link = \Wp_Temporary_Login_Without_Password_Common::get_login_url( $user['user_id'] );

		return new WP_REST_Response( [ 'link' => $link ], 200 );
	}

	/**
	 * Show our support link and actions using WTLWP template
	 *
	 * @param $request
	 *
	 * @return WP_REST_Response
	 */
	public function list_support_links( $request ) {
		if ( ! defined( 'WTLWP_PLUGIN_DIR' ) ) {
			throw new RuntimeException( 'Temporary Login Without Password plugin is not installed' );
		}

		// Fill this page in, so template links work
		global $_parent_pages;
		$_parent_pages['wp-temporary-login-without-password'] = 'users.php';

		ob_start();
		load_template( WTLWP_PLUGIN_DIR . '/templates/list-temporary-logins.php' );
		$template = ob_get_clean();
		$template = '<div class="wrap wtlwp wtlwp-settings-wrap" id="temporary-logins"><div class="wrap list-wtlwp-logins mt-4" id="list-wtlwp-logins">' . $template . '</div></div>';

		return new WP_REST_Response( [ 'template' => $template ], 200 );
	}

	/**
	 * Install Temporary Login Without Password plugin and activate it
	 *
	 * @param $request
	 *
	 * @return WP_REST_Response
	 */
	public function install_dependencies( $request ) {
		$product = [
			'type'     => 'plugin',
			'url'      => 'https://downloads.wordpress.org/plugin/temporary-login-without-password.zip',
			'slug'     => 'temporary-login-without-password/temporary-login-without-password.php',
			'filename' => 'temporary-login-without-password.zip',
		];

		$slug = $product['slug'];
		if ( is_plugin_active( $slug ) ) {
			return new WP_REST_Response( [], 200 );
		}

		My_Products_Controller_PluginsForWP::do_install( $product );
		My_Products_Controller_PluginsForWP::do_activate_plugin( $slug );

		return new WP_REST_Response( [], 200 );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return bool|true
	 */
	public function create_support_link_permissions_check( $request ) {
		return current_user_can( 'manage_options' );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return bool|true
	 */
	public function list_support_links_permissions_check( $request ) {
		return current_user_can( 'manage_options' );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return bool|true
	 */
	public function install_dependencies_permissions_check( $request ) {
		return current_user_can( 'manage_options' );
	}
}
