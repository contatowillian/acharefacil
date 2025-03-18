<?php

namespace P4W\Plugin_Manager;

require_once 'My_Products_Controller.php';

use stdClass;

class Plugin_Manager_PluginsForWP {
	const VERSION = '7.0.1';
	const PLUGIN_PREFIX = 'pluginsforwp';
	const COMPANY_NAME = 'Plugins for WP';
	const SERVER_URL = 'https://pluginsforwp.com';
	const BANNER_URL = 'https://pluginsforwp.com/wp-content/uploads/2021/05/wp-dashboard-banner.png';
	const PLUGIN_HOME_PAGE = '/wp-admin/admin.php?page=' . self::PLUGIN_PREFIX . '-plugin-manager%2F' . self::PLUGIN_PREFIX . '-plugin-manager.vue';

	public static function run() {
		// Add main menu item
		add_action( 'admin_menu',
			function () {
				add_menu_page(
					self::COMPANY_NAME,
					self::COMPANY_NAME,
					'manage_options',
					plugin_dir_path( __FILE__ ) . Plugin_Manager_PluginsForWP::PLUGIN_PREFIX . '-plugin-manager.vue',
					'',
					'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iNTEyLjAwMDAwMHB0IiBoZWlnaHQ9IjUxMi4wMDAwMDBwdCIgdmlld0JveD0iMCAwIDUxMi4wMDAwMDAgNTEyLjAwMDAwMCIKIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgoKPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsNTEyLjAwMDAwMCkgc2NhbGUoMC4xMDAwMDAsLTAuMTAwMDAwKSIKZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSJub25lIj4KPHBhdGggZD0iTTAgMjU2MCBsMCAtMjU2MCAyNTYwIDAgMjU2MCAwIDAgMjU2MCAwIDI1NjAgLTI1NjAgMCAtMjU2MCAwIDAKLTI1NjB6IG0zMzE1IDE4NjYgYzI4IC0xMyA2MiAtMzYgNzcgLTUyIDYzIC02OCA4MCAtMTgyIDM4IC0yNjQgLTE1IC0zMCAtMTMzCi0xNTYgLTM1NiAtMzgwIGwtMzM0IC0zMzUgMzQwIC0zNDAgMzQwIC0zNDAgMzQyIDM0MiBjMjMwIDIyOSAzNTUgMzQ3IDM4MAozNTggNDYgMTkgMTM4IDIwIDE4MSAyIDExOSAtNTEgMTgxIC0yMDAgMTI2IC0zMTAgLTEzIC0yNyAtMTQyIC0xNjQgLTM2MAotMzgyIGwtMzM5IC0zNDAgMjIxIC0yMjAgYzEyMSAtMTIxIDIzMCAtMjM4IDI0MiAtMjYwIDI5IC01NSAyOSAtMTU0IDAgLTIxMAotNDMgLTgyIC0xMTggLTEyOCAtMjA4IC0xMjggLTc0IDAgLTEzMCAzMCAtMjI1IDEyMSAtNDcgNDUgLTg3IDgyIC05MCA4MiAtMwowIC0zMyAtMjMgLTY1IC01MSAtMzI0IC0yNzggLTY5NSAtNDY5IC0xMDY0IC01NDYgLTE2NCAtMzQgLTQyNSAtMzkgLTU2MSAtOQotMTA5IDIzIC0yMjQgNjUgLTMwNyAxMTIgbC02NSAzNiAtMzAxIC0yOTkgYy0xOTAgLTE4OSAtMzE2IC0zMDYgLTM0MSAtMzE3Ci05MCAtNDIgLTE3NyAtMjkgLTI1MiAzNyAtODEgNzEgLTEwNSAxNzQgLTYzIDI2NyAxNSAzMyAxMDMgMTI4IDMzMiAzNTcgbDMxMQozMTMgLTEzIDMyIGMtMzIgODAgLTYzIDE4NyAtNzcgMjcxIC0yMyAxMjkgLTE1IDM4MyAxNiA1MjcgNzIgMzQyIDIzOSA2ODEKNDgxIDk3OSA0NiA1NyA5MyAxMTQgMTAzIDEyNyBsMjAgMjMgLTk1IDk4IGMtNzcgNzkgLTk4IDEwNyAtMTA4IDE0NiAtMjggMTAwCjE0IDIwNiAxMDQgMjYyIDQzIDI3IDU3IDMwIDEyNCAzMCAxMDAgMCAxMTEgLTggMzQ2IC0yNDQgbDE5MCAtMTkxIDM0MCAzNDAKYzM2MSAzNjAgMzg0IDM3OCA0NzUgMzc5IDI4IDEgNjQgLTggOTUgLTIzeiIvPgo8L2c+Cjwvc3ZnPgo='
				);
			}
		);

		// Add scripts and styles
		add_action( 'admin_enqueue_scripts',
			function ( $hook ) {
				$plugin_dir = plugin_dir_url( __FILE__ );
				$assets_dir = $plugin_dir . 'assets' . DIRECTORY_SEPARATOR;
				$css_dir    = $assets_dir . 'css' . DIRECTORY_SEPARATOR;
				$js_dir     = $assets_dir . 'js' . DIRECTORY_SEPARATOR;

				if ( 'plugin-install.php' === $hook ) {
					wp_enqueue_script( 'p4w_plugin_manager_add_plugin_button_js',
						$js_dir . 'plugin-button.js',
						null,
						self::VERSION,
						true );
				}

				if ( stripos( $hook, self::PLUGIN_PREFIX ) === false ) {
					// not part of this plugin
					return;
				}

				// Vendor JS
				wp_enqueue_script( 'p4w_plugin_manager_vuejs', $js_dir . 'vue.min.js', [], self::VERSION, true );
				wp_enqueue_script( 'p4w_plugin_manager_vuetify', $js_dir . 'quasar.min.js', [], self::VERSION, true );
				wp_enqueue_script( 'p4w_plugin_manager_axios', $js_dir . 'axios.min.js', [], self::VERSION, true );
				wp_enqueue_script( 'p4w_plugin_manager_compare_versions',
					$js_dir . 'compare-versions.min.js',
					[],
					self::VERSION,
					true );

				// Vendor CSS
				wp_enqueue_style( 'p4w_plugin_manager_bulma', $css_dir . 'bulma.min.css', [], self::VERSION );
				wp_enqueue_style( 'p4w_plugin_manager_buefy_css', $css_dir . 'buefy.min.css', self::VERSION );
				wp_enqueue_style( 'p4w_plugin_manager_vuetify', $css_dir . 'quasar.min.css', [], self::VERSION );

				// Load TLWP plugin assets
				wp_enqueue_style( 'p4w_tailwind-css', $css_dir . 'main.css', [], self::VERSION );
				wp_enqueue_script( 'p4w_clipboardjs', $js_dir . 'clipboard.min.js', [], self::VERSION, false );

				// Add the rtl class to the body if we are in RTL languages, something WP should do by itself but fails to
				if ( is_rtl() ) {
					wp_enqueue_style( 'p4w_plugin_manager_rtl', $css_dir . 'rtl.css', [], self::VERSION );
				}

				// App JS
				wp_enqueue_script( 'p4w_plugin_manager_main_js',
					plugin_dir_url( __FILE__ ) . Plugin_Manager_PluginsForWP::PLUGIN_PREFIX . '-plugin-manager.js',
					'p4w_plugin_manager_vuejs',
					self::VERSION,
					true );
				wp_localize_script( 'p4w_plugin_manager_main_js', 'p4wSPA', [
					'nonce'  => wp_create_nonce( 'wp_rest' ),
					'apiUrl' => sanitize_url( rest_url() ),
				] );

				// App CSS
				wp_enqueue_style( 'p4w_plugin_manager_main_css',
					plugin_dir_url( __FILE__ ) . Plugin_Manager_PluginsForWP::PLUGIN_PREFIX . '-plugin-manager.css',
					'p4w_plugin_manager_bulma',
					self::VERSION );
			}
		);

		add_action( 'admin_notices',
			function () {
				$prod_controller = new My_Products_Controller_PluginsForWP();
				$response        = $prod_controller->make_request( '/my-subscription' );
				if ( $response && ! ( $response instanceof \WP_Error ) ) {
					$hasAllAccess = \json_decode( $response['body'], true )['subscription']['allAccess'] ?: null;
					if ( $hasAllAccess ) {
						// If the user has a subscription, don't show anything
						return;
					}
				}

				$time             = get_option( Settings_Controller_PluginsForWP::PLUGINS_FOR_WP_BANNER );
				$plugin_home_page = self::PLUGIN_HOME_PAGE;
				$banner_url       = self::BANNER_URL;
				$company_name     = self::COMPANY_NAME;
				if ( ! $time && self::COMPANY_NAME !== 'Pluginizer' ) {
					print "<div id='p4w-admin-banner' class='notice notice-warning is-dismissible' style='padding: 0; border:0;'>
						<a href='$plugin_home_page'>
						<img src='$banner_url' style='max-width: 100%;display:block;' alt='$company_name Banner'>
						</a>
					</div>";
				}
			} );

		// Get list of potential updates and tell WP where it can find the update files for our plugins
		$filters = [
			'pre_set_site_transient_update_plugins' => 'plugin',
			'pre_set_site_transient_update_themes'  => 'theme',
		];
		foreach ( $filters as $filter => $type ) {
			add_filter( $filter,
				function ( $transient ) use ( $type ) {
					if ( empty( $transient->checked ) ) {
						return $transient;
					}

					$prod_controller = new My_Products_Controller_PluginsForWP();
					$products        = $prod_controller->get_my_products();
					foreach ( $products as $product ) {
						if ( ! $product['purchased'] || ! $product['name'] || $type !== $product['type'] ) {
							continue;
						}

						// Compare version
						$slug                   = $product['slug'];
						$new_plugin_version     = $product['version'];
						$current_plugin_version = isset( $transient->checked[ $slug ] ) ? $transient->checked[ $slug ] : null;
						if ( ! $new_plugin_version || ! $current_plugin_version || version_compare( $new_plugin_version,
								$current_plugin_version,
								'<=' ) ) {
							continue;
						}

						$shortSlug = $slug;
						if ( $type === 'plugin' ) {
							list ( $_, $t2 ) = explode( '/', $slug );
							$shortSlug = str_replace( '.php', '', $t2 );
						}

						$obj                          = new stdClass();
						$obj->slug                    = $shortSlug;
						$obj->new_version             = $product['version'];
						$obj->url                     = $product['serverUrl'];
						$obj->package                 = $product['url'];
						$transient->response[ $slug ] = $obj;
					}

					return $transient;
				}
			);
		}
	}
}
