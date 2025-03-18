<?php

namespace P4W\Plugin_Manager;

require_once 'vendor/autoload.php';
require_once 'Settings_Controller.php';
require_once 'Patcher.php';
require_once ABSPATH . '/wp-admin/includes/file.php';
require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once ABSPATH . '/wp-admin/includes/template.php';
require_once ABSPATH . '/wp-admin/includes/theme.php';

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use WP_Error;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use WP_Theme;

class My_Products_Controller_PluginsForWP extends WP_REST_Controller {
	const PLUGIN = 'plugin';
	const THEME = 'theme';

	public function register_routes() {
		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/install',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'install' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/patch',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'patch' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/delete',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'delete' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/activate-plugin',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'activate_plugin' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/deactivate-plugin',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'deactivate_plugin' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/activate-theme',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'activate_theme' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/auto-updates',
			[
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'auto_updates' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);

		register_rest_route(
			Api_PluginsForWP::ROUTE_NAMESPACE,
			'/products/list',
			[
				[
					'methods'             => 'GET',
					'callback'            => [ $this, 'get_installed_products' ],
					'permission_callback' => [ $this, 'general_permissions_check' ],
				],
			]
		);
	}

	/**
	 * Get products installed locally
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function get_installed_products( $request ) {
		$plugins             = [];
		$active_plugins      = get_option( 'active_plugins', [] );
		$auto_update_plugins = get_option( 'auto_update_plugins', [] );
		$auto_update_themes  = get_option( 'auto_update_themes', [] );
		$plugins_raw         = get_plugins();
		$plugins_dir         = self::get_product_dir( self::PLUGIN );

		foreach ( $plugins_raw as $slug => $plugin ) {
			$subdir  = dirname( $slug );
			$patched = false;
			if ( file_exists( $plugins_dir . $subdir . DIRECTORY_SEPARATOR . '.patched' ) ) {
				$patched = true;
			}

			$plugins[] = [
				'name'             => $this->normalize_name( $plugin['Name'] ),
				'version'          => 'Not Available',
				'installedVersion' => $plugin['Version'],
				'description'      => $plugin['Description'],
				'slug'             => $slug,
				'type'        => self::PLUGIN,
				'installed'        => true,
				'active'           => in_array( $slug, $active_plugins ),
				'autoUpdates' => in_array( $slug, $auto_update_plugins ),
				'patched'          => $patched,
			];
		}

		$current_theme_name = wp_get_theme()->get( 'Name' );
		$themes             = [];
		$theme_objs         = wp_get_themes( [ 'errors' => null ] );
		$themes_dir          = self::get_product_dir( self::THEME );

		foreach ( $theme_objs as $subdir => $theme_obj ) {
			$patched = false;
			if ( file_exists( $themes_dir . $subdir . DIRECTORY_SEPARATOR . '.patched' ) ) {
				$patched = true;
			}

			/** @var WP_Theme $theme_obj */
			$theme_name = $theme_obj->get( 'Name' );
			$themes[]   = [
				'name'             => $this->normalize_name( $theme_name ),
				'version'          => 'Not Available',
				'installedVersion' => $theme_obj->get( 'Version' ),
				'description'      => $theme_obj->get( 'Description' ),
				'slug'             => $theme_obj->get_stylesheet(),
				'type'        => self::THEME,
				'installed'        => true,
				'active'           => $current_theme_name === $theme_name,
				'patched'          => $patched,
				'autoUpdates' => in_array( $subdir, $auto_update_themes ),
			];
		}

		$serverUrl = Api_PluginsForWP::getServerUrl();
		$username  = get_option( Settings_Controller_PluginsForWP::PLUGINS_FOR_WP_USERNAME, null );
		if ( $username === '' ) {
			$username = null;
		}

		$key = get_option( Settings_Controller_PluginsForWP::PLUGINS_FOR_WP_SECRET_KEY, null );
		if ( $key === '' ) {
			$key = null;
		}

		$affiliate = get_option( Settings_Controller_PluginsForWP::PLUGINS_FOR_WP_AFFILIATE, null );
		if ( $affiliate === '' ) {
			$affiliate = null;
		}

		$data = [
			'plugins'   => $plugins,
			'themes'    => $themes,
			'serverUrl' => $serverUrl,
			'username'  => $username,
			'key'       => $key,
			'affiliate' => $affiliate,
		];

		return new WP_REST_Response( $data, 200 );
	}

	/**
	 * Install action. Install a plugin
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function install( $request ) {
		$product = $this->get_product( $request );
		self::do_install( $product );

		return new WP_REST_Response( [], 200 );
	}

	public static function do_install( $product ) {
		$path   = self::get_product_dir( $product['type'] );
		$data   = self::download_file( $product['url'] );
		$subdir = dirname( $product['slug'] );
		$dir    = $path . $subdir;
		$file   = $path . $product['filename'];

		if ( file_put_contents( $file, $data ) ) {
			WP_Filesystem();
			$unzipfile = unzip_file( $file, $path );
			unlink( $file );

			if ( ! $unzipfile || $unzipfile instanceof WP_Error ) {
				throw new RuntimeException( 'File could not be unzipped' );
			}

			// Unmark as patched
			unlink( $dir . DIRECTORY_SEPARATOR . '.patched' );
		} else {
			throw new RuntimeException( 'File could not be downloaded' );
		}
	}

	/**
	 * If the product has a patch, apply it to enable the premium version
	 *
	 * @param $request
	 *
	 * @return WP_REST_Response
	 */
	public function patch( $request ) {
		$product = $this->get_product( $request );
		$path    = self::get_product_dir( $product['type'] );
		$data    = self::download_file( $product['patchUrl'] );
		$subdir  = dirname( $product['slug'] );
		$dir     = $path . $subdir;
		$file    = $path . 'enable.patch';

		if ( file_put_contents( $file, $data ) ) {
			$changed_files = $this->extract_filenames( $file );
			$backup_dir    = $this->backup_directory( $dir );

			$patcher = new Patcher_PluginsForWP();
			if ( ! $patcher->apply_patch( $file, $dir ) ) {
				$this->rrmdir( $dir );
				$this->restore_directory( $backup_dir, $dir );

				throw new RuntimeException( 'Patch could not be applied' );
			}

			unlink( $file );

			$year    = date( 'Y' );
			$comment = "/** 
 * This file was modified to enable usage without any external dependencies or servers.
 *
 * Changes were made by:
 *
 * @author            PluginsForWP
 * @copyright         $year Incodepany LLC
 * @license           GPL-2.0-or-later
 */";

			foreach ( $changed_files as $changed_file ) {
				$this->prepend_text_to_file( $dir . DIRECTORY_SEPARATOR . $changed_file, $comment );
			}

			// Mark the patch as applied
			file_put_contents( $dir . DIRECTORY_SEPARATOR . '.patched', '' );
			// Clean up temporary directory
			$this->rrmdir( $backup_dir );
		} else {
			throw new RuntimeException( 'Patch could not be downloaded' );
		}

		return new WP_REST_Response( [], 200 );
	}

	/**
	 * Delete a product
	 *
	 * @param $request
	 *
	 * @return WP_REST_Response
	 */
	public function delete( $request ) {
		$slug = $request->get_params()['slug'];
		$type = $request->get_params()['type'];

		if ( $type === self::PLUGIN ) {
			if ( is_plugin_active( $slug ) ) {
				deactivate_plugins( $slug );
			}

			if ( file_exists( WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $slug ) ) {
				delete_plugins( [ $slug ] );
			}
		} elseif ( $type === self::THEME ) {
			// Don't allow deleting the current theme
			if ( wp_get_theme()->get_stylesheet() !== $slug ) {
				if ( wp_get_theme( $slug )->exists() ) {
					delete_theme( $slug );
				}
			}
		}

		return new WP_REST_Response( [], 200 );
	}

	/**
	 * Get my products list from the p4w server
	 *
	 * @param int|null $id
	 *
	 * @return array
	 */
	public function get_my_products( $id = null ) {
		$url = '/my-products';
		if ( $id ) {
			$url .= "?id=$id";
		}
		$response = $this->make_request( $url );

		if ( $response instanceof WP_Error ) {
			return [];
		}

		$code = isset( $response['response']['code'] ) ? $response['response']['code'] : null;
		if ( $code !== 200 ) {
			return [];
		}

		$products = json_decode( $response['body'], true );
		if ( ! isset( $products['products'] ) ) {
			return [];
		}

		return $products['products'];
	}

	/**
	 * @param string $path
	 *
	 * @return array|WP_Error
	 */
	public function make_request( $path ) {
		$username = get_option( Settings_Controller_PluginsForWP::PLUGINS_FOR_WP_USERNAME, null );
		if ( $username === '' ) {
			$username = null;
		}

		$secret = get_option( Settings_Controller_PluginsForWP::PLUGINS_FOR_WP_SECRET_KEY, null );
		if ( $secret === '' ) {
			$secret = null;
		}

		if ( ! $username || ! $secret ) {
			return null;
		}

		$url        = Api_PluginsForWP::getServerUrl();
		$url        .= '/wp-json/' . Api_PluginsForWP::SERVER_ROUTE_NAMESPACE . $path;
		$auth_token = base64_encode( $username . ':' . $secret );

		return wp_remote_request(
			$url,
			[
				'method'  => 'GET',
				'timeout' => 20,
				'headers' => [
					'Authorization' => "Basic $auth_token",
					'Content-type'  => 'application/json',
				],
			]
		);
	}

	/**
	 * Activate a plugin
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function activate_plugin( $request ) {
		$plugin = $request->get_params()['slug'];
		self::do_activate_plugin( $plugin );

		return new WP_REST_Response( [], 200 );
	}

	public static function do_activate_plugin( $plugin ) {
		$network_admin = is_network_admin();
		$result        = activate_plugin( $plugin, '', $network_admin );
		if ( is_wp_error( $result ) ) {
			throw new RuntimeException( 'There was an error activating this plugin.' );
		}

		if ( ! $network_admin ) {
			$recent = (array) get_option( 'recently_activated' );
			unset( $recent[ $plugin ] );
			update_option( 'recently_activated', $recent );
		} else {
			$recent = (array) get_site_option( 'recently_activated' );
			unset( $recent[ $plugin ] );
			update_site_option( 'recently_activated', $recent );
		}
	}

	/**
	 * Deactivate a plugin
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function deactivate_plugin( $request ) {
		$network_admin = is_network_admin();
		$plugin        = $request->get_params()['slug'];
		deactivate_plugins( $plugin, false, $network_admin );

		return new WP_REST_Response( [], 200 );
	}

	/**
	 * Activate a theme
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function activate_theme( $request ) {
		$theme = $request->get_params()['slug'];
		switch_theme( $theme );

		return new WP_REST_Response( [], 200 );
	}

	/**
	 * Turn auto updates on or off for a product
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function auto_updates( $request ) {
		$status              = $request->get_params()['status'];
		$product             = $request->get_params()['product'];
		$type                = $product['type'];
		$slug                = $product['slug'];
		$auto_update_plugins = get_option( 'auto_update_plugins', [] );
		$auto_update_themes  = get_option( 'auto_update_themes', [] );

		if ( $type === self::PLUGIN ) {
			if ( $status ) {
				if ( ! in_array( $slug, $auto_update_plugins ) ) {
					$auto_update_plugins[] = $slug;
					update_option( 'auto_update_plugins', $auto_update_plugins );
				}
			} else {
				if ( in_array( $slug, $auto_update_plugins ) ) {
					$auto_update_plugins = array_diff( $auto_update_plugins, [ $slug ] );
					update_option( 'auto_update_plugins', $auto_update_plugins );
				}
			}
		} elseif ( $type === self::THEME ) {
			if ( $status ) {
				if ( ! in_array( $slug, $auto_update_themes ) ) {
					$auto_update_themes[] = $slug;
					update_option( 'auto_update_themes', $auto_update_themes );
				}
			} else {
				if ( in_array( $slug, $auto_update_themes ) ) {
					$auto_update_themes = array_diff( $auto_update_themes, [ $slug ] );
					update_option( 'auto_update_themes', $auto_update_themes );
				}
			}
		}
	}

	/**
	 * Normalize a plugin's name so it can be searched for easily in WP
	 * WP won't find the name with the dash on the left. It needs to be a regular - dash
	 *
	 * @param $name
	 *
	 * @return string|string[]
	 */
	protected function normalize_name( $name ) {
		$norm_dashes = str_replace( '–', '-', $name );

		return html_entity_decode( $norm_dashes );
	}

	/**
	 * Recursively remove dir
	 *
	 * @param string $dir
	 */
	protected function rrmdir( string $dir ): void {
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ( $files as $fileinfo ) {
			$todo = ( $fileinfo->isDir() ? 'rmdir' : 'unlink' );
			$todo( $fileinfo->getRealPath() );
		}

		rmdir( $dir );
	}

	/**
	 * Get product data from request and validate it against the product data from our server
	 *
	 * @param $request
	 *
	 * @return mixed
	 */
	protected function get_product( $request ) {
		$my_product = \json_decode( $request->get_body(), true );
		$id         = $my_product['id'];

		$my_products = $this->get_my_products( $id );
		$product     = isset( $my_products[0] ) ? $my_products[0] : null;
		if ( ! $product ) {
			throw new RuntimeException( 'Product does not match' );
		}

		return $product;
	}

	/**
	 * Get the directory path for a product type (plugin or theme)
	 *
	 * @param $type
	 *
	 * @return string
	 */
	protected static function get_product_dir( $type ) {
		$path = null;
		if ( $type === self::PLUGIN ) {
			$path = ABSPATH . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR;
			if ( defined( 'WP_PLUGIN_DIR' ) ) {
				$path = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR;
			}
		} elseif ( $type === self::THEME ) {
			$path = get_theme_root() . DIRECTORY_SEPARATOR;
		}

		if ( ! $path ) {
			throw new RuntimeException( 'Plugin path not available' );
		}

		return $path;
	}

	/**
	 * Download a file using curl
	 *
	 * @param $url
	 *
	 * @return bool|string
	 */
	protected static function download_file( $url ) {
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$data = curl_exec( $ch );

		try {
			if ( curl_errno( $ch ) ) {
				throw new RuntimeException( 'File could not be downloaded' );
			}

			$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
			if ( $http_code !== 200 ) {
				throw new RuntimeException( "File could not be downloaded. HTTP status: $http_code" );
			}
		} finally {
			curl_close( $ch );
		}

		return $data;
	}

	/**
	 * Extract filenames that are additions or modifications from a patch file
	 *
	 * @param $patch_file
	 *
	 * @return array
	 */
	protected function extract_filenames( $patch_file ) {
		$filenames = [];

		if ( ! file_exists( $patch_file ) ) {
			return $filenames;
		}

		$lines = file( $patch_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

		foreach ( $lines as $line ) {
			// Detect new or modified files (lines starting with '+++ ')
			if ( strpos( $line, '+++ ' ) === 0 ) {
				// Extract filename and remove 'b/' prefix if it exists
				$filename = trim( substr( $line, 4 ) ); // Extract filename after '+++ '
				if ( strpos( $filename, 'b/' ) === 0 ) {
					$filename = substr( $filename, 2 ); // Remove 'b/' prefix
				}
				$filenames[] = $filename;
			}
		}

		return $filenames;
	}

	/**
	 * Add text and comments to the beginning of a file
	 *
	 * @param $file
	 * @param $text
	 *
	 * @return bool
	 */
	protected function prepend_text_to_file( $file, $text ) {
		if ( ! file_exists( $file ) ) {
			return false;
		}

		$current_content = file_get_contents( $file );
		$extension       = pathinfo( $file, PATHINFO_EXTENSION );

		if ( in_array( $extension, [ 'php', 'phtml', 'inc' ] ) ) {
			// PHP files
			$new_content = str_replace( '<?php', "<?php\n\n" . $text . "\n\n", $current_content );
		} else {
			// JS, CSS, SCSS, LESS, etc.
			$new_content = $text . "\n\n" . $current_content;
		}

		$result = file_put_contents( $file, $new_content );
		if ( $result === false ) {
			return false;
		}

		return true;
	}

	/**
	 * Copy contents from one directory to another.
	 *
	 * @param string $source
	 * @param string $destination
	 *
	 * @throws RuntimeException If the copy fails.
	 */
	protected function copy_directory_contents( string $source, string $destination ): void {
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $source, FilesystemIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::SELF_FIRST
		);

		foreach ( $files as $file ) {
			$relativePath = substr( $file->getPathname(), strlen( $source ) + 1 );
			$destPath     = $destination . DIRECTORY_SEPARATOR . $relativePath;
			if ( $file->isDir() ) {
				if ( ! mkdir( $destPath, 0777, true ) && ! is_dir( $destPath ) ) {
					throw new RuntimeException( 'Could not create directory: ' . $destPath );
				}
			} else {
				if ( ! copy( $file, $destPath ) ) {
					throw new RuntimeException( 'Could not copy file: ' . $file->getPathname() );
				}
			}
		}
	}

	/**
	 * Backup a directory to a temporary location.
	 *
	 * @param string $dir
	 *
	 * @return string The path to the backup directory.
	 * @throws RuntimeException If the backup fails.
	 */
	protected function backup_directory( string $dir ): string {
		$temp_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid( 'backup_', true );
		if ( ! mkdir( $temp_dir ) && ! is_dir( $temp_dir ) ) {
			throw new RuntimeException( 'Could not create temporary directory.' );
		}

		$this->copy_directory_contents( $dir, $temp_dir );

		return $temp_dir;
	}

	/**
	 * Restore a directory from a backup.
	 *
	 * @param string $backup_dir
	 * @param string $dir
	 *
	 * @throws RuntimeException If the restore fails.
	 */
	protected function restore_directory( string $backup_dir, string $dir ): void {
		$this->copy_directory_contents( $backup_dir, $dir );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function general_permissions_check( $request ) {
		return current_user_can( 'install_plugins' );
	}
}
