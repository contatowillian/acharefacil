<?php

namespace WeglotWP\Actions\Front;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Exception;
use Weglot\Client\Api\LanguageEntry;
use WeglotWP\Helpers\Helper_API;
use WeglotWP\Helpers\Helper_Is_Admin;
use WeglotWP\Models\Hooks_Interface_Weglot;
use Weglot\Client\Api\Enum\BotType;
use Weglot\Util\Server;
use WeglotWP\Services\Href_Lang_Service_Weglot;
use WeglotWP\Services\Language_Service_Weglot;
use WeglotWP\Services\Option_Service_Weglot;
use WeglotWP\Services\Redirect_Service_Weglot;
use WeglotWP\Services\Request_Url_Service_Weglot;
use WeglotWP\Services\Translate_Service_Weglot;
use WeglotWP\Services\Feature_Flags_Service_Weglot;


/**
 * Translate page
 *
 * @since 2.0
 */
class Translate_Page_Weglot implements Hooks_Interface_Weglot {
	/**
	 * @var Option_Service_Weglot
	 */
	private $option_services;

	/**
	 * @var LanguageEntry
	 */
	private $current_language;
	/**
	 * @var Request_Url_Service_Weglot
	 */
	private $request_url_services;
	/**
	 * @var Language_Service_Weglot
	 */
	private $language_services;
	/**
	 * @var Redirect_Service_Weglot
	 */
	private $redirect_services;
	/**
	 * @var Translate_Service_Weglot
	 */
	private $translate_services;
	/**
	 * @var Href_Lang_Service_Weglot
	 */
	private $href_lang_services;
	/**
	 * @var Feature_Flags_Service_Weglot
	 */
	private $feature_flags_services;

	/**
	 * @throws Exception
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services        = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services   = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->redirect_services      = weglot_get_service( 'Redirect_Service_Weglot' );
		$this->translate_services     = weglot_get_service( 'Translate_Service_Weglot' );
		$this->href_lang_services     = weglot_get_service( 'Href_Lang_Service_Weglot' );
		$this->feature_flags_services = weglot_get_service( 'Feature_Flags_Service_Weglot' );
		$this->language_services      = weglot_get_service( 'Language_Service_Weglot' );
	}

	/**
	 * @return void
	 * @throws Exception
	 * @see Hooks_Interface_Weglot
	 *
	 * @since 2.0
	 */
	public function hooks() {

		$referer = wp_parse_url( wp_get_referer() );
		if ( wp_is_json_request() && isset( $referer['query'] ) ) {
			if ( strpos( $referer['query'], 'action=edit' ) !== false ) {
				return;
			}
		}

		//check if is elementor preview.
		$elementor_preview = filter_input(INPUT_GET, 'elementor-preview', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		if ( Helper_Is_Admin::is_wp_admin() || 'wp-login.php' === $GLOBALS['pagenow'] || $elementor_preview) {
			return;
		}

		if ( is_admin() && ( ! wp_doing_ajax() || $this->no_translate_action_ajax() ) ) {
			return;
		}

		if ( ! $this->option_services->get_option( 'api_key' ) ) {
			return;
		}

		$this->prepare_request_uri();
		$this->prepare_rtl_language();
		add_action( 'init', array( $this, 'weglot_init' ), 11 );
		add_action( 'wp_head', array( $this, 'weglot_href_lang' ) );
		add_action( 'wp_head', array( $this, 'weglot_custom_settings' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_switcher_templatefile' ) );
		add_action( 'wp_head', array( $this, 'weglot_dynamics' ) );
	}

	/**
	 * @return boolean
	 * @since 2.1.1
	 *
	 */
	protected function no_translate_action_ajax() {
		$action_ajax_no_translate = apply_filters(
			'weglot_ajax_no_translate',
			array(
				'add-menu-item', // WP Core.
				'query-attachments', // WP Core.
				'avia_ajax_switch_menu_walker', // Enfold theme.
				'query-themes', // WP Core.
				'wpestate_ajax_check_booking_valability_internal', // WP Estate theme.
				'wpestate_ajax_add_booking', // WP Estate theme.
				'wpestate_ajax_check_booking_valability', // WP Estate theme.
				'mailster_get_template', // Mailster Pro.
				'mmp_map_settings', // MMP Map.
				'elementor_ajax', // Elementor since 2.5.
				'ct_get_svg_icon_sets', // Oxygen.
				'oxy_render_nav_menu', // Oxygen.
				'hotel_booking_ajax_add_to_cart', // Hotel booking plugin.
				'imagify_get_admin_bar_profile', // Imagify Admin Bar.
				'el_check_user_login', // Event list plugin.
				'wcfm_ajax_controller', // wcfm_ajax_controller.
				'jet_ajax_search', // jet_ajax_search.
				'woofc_update_qty', // jet_ajax_search.
			)
		);

		if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['action'] ) && in_array( $_POST['action'], $action_ajax_no_translate ) ) { //phpcs:ignore
			return true;
		}

		if ( 'GET' === $_SERVER['REQUEST_METHOD'] && isset( $_GET['action'] ) && in_array( $_GET['action'], $action_ajax_no_translate ) ) { //phpcs:ignore
			return true;
		}

		return false;
	}

	/**
	 * @return void
	 * @throws Exception
	 * @version 2.3.0
	 * @see init
	 * @since 2.0
	 */
	public function weglot_init() {
		do_action( 'weglot_init_start' );

		// We refresh the current language as now the wp_doing_ajax is valid.
		$this->current_language = $this->request_url_services->get_current_language();

		if ( ! $this->option_services->get_option( 'original_language' ) ) {
			return;
		}

		if ( $this->request_url_services->is_allowed_private() ) {
			if ( ! isset( $_COOKIE['weglot_allow_private'] ) ) {
				setcookie( "weglot_allow_private", 'true', time() + 86400 * 2, '/' ); //phpcs:ignore
			}
		}

		$active_translation = apply_filters( 'weglot_active_translation_before_process', true );

		if ( ! $active_translation ) {
			return;
		}

		$manage_trailing_slash = apply_filters('manage_trailing_slash', false);
		if($manage_trailing_slash){
			$this->manage_trailing_slash();
		}
		$this->check_need_to_redirect();

		do_action( 'weglot_init_before_translate_page' );

		if ( ! function_exists( 'curl_version' ) ) {
			return;
		}

		$active_translation = apply_filters( 'weglot_active_translation_before_treat_page', true );

		if ( ! $active_translation ) {
			return;
		}

		$file = apply_filters( 'weglot_debug_file', WEGLOT_DIR . '/content.html' );


		if ( defined( 'WEGLOT_DEBUG' ) && WEGLOT_DEBUG && file_exists( $file ) ) {
			$this->translate_services->set_original_language( $this->language_services->get_original_language() );
			$this->translate_services->set_current_language( $this->request_url_services->get_current_language() );
			echo $this->translate_services->weglot_treat_page( file_get_contents( $file ) ); //phpcs:ignore
			die;
		} else {
			$this->translate_services->weglot_translate();
		}
	}

	/**
	 * @return void
	 * @throws Exception
	 * @since 2.0
	 */
	public function check_need_to_redirect() {

		$only_home     = apply_filters( 'weglot_autoredirect_only_home', false );
		$skip_redirect = apply_filters( 'weglot_autoredirect_skip', false );
		if (
			! $skip_redirect &&
			! wp_doing_ajax() && // no ajax.
			! is_rest() &&
			! Helper_Is_Admin::is_wp_admin() &&
			$this->language_services->get_original_language() === $this->request_url_services->get_current_language() &&
			! isset( $_COOKIE['WG_CHOOSE_ORIGINAL'] ) && // No force redirect.
			Server::detectBot( $_SERVER ) === BotType::HUMAN && //phpcs:ignore
			! Server::detectBotVe( $_SERVER ) && //phpcs:ignore
			( ! $only_home || ( $this->request_url_services->get_weglot_url()->getPath() === '/' ) ) && // front_page.
			$this->option_services->get_option( 'auto_redirect' ) // have option redirect.
		) {
			$this->redirect_services->auto_redirect();
		}
	}

	/**
	 * @return boolean
	 * @throws Exception
	 * @since 2.0
	 * @version 2.1.0
	 */
	public function check_custom_redirect($current_url) {
		$custom_redirect_exclude = $this->option_services->get_option_custom_settings('custom_redirect_exclude');

		foreach ($custom_redirect_exclude as $language => $urls) {
			if (in_array($current_url, $urls)) {
				// Replace only the language part in the URL
				$pattern = '/\/' . preg_quote($this->current_language->getInternalCode(), '/') . '\//';
				$replacement = '/' . $language . '/';
				$updated_url = preg_replace($pattern, $replacement, $current_url, 1); // Replace only the first occurrence

				return $updated_url; // Return the updated URL
			}
		}

		return false; // Return false if not found
	}

	/**
	 * @return void
	 * @version 2.1.0
	 * @since 2.0
	 */
	public function prepare_request_uri() {
		$original_language = $this->language_services->get_original_language();

		// We initialize the URL here for the first time, the current language might be wrong in case of ajax with the language in a referer because at this time wp_doing_ajax is always false.
		$this->current_language = $this->request_url_services->get_current_language();

		// If the URL has a GET parameter wg-choose-original we need to set / unset the cookie and redirect.
		$this->redirect_services->verify_no_redirect();

		if ( $original_language === $this->current_language ) {
			return;
		}

		// If we are not in the original language, but the URL is not available in the current language, and the option redirect is true,  we redirect to original.
		$redirect = $this->request_url_services->get_weglot_url()->getExcludeOption( $this->current_language, 'exclusion_behavior' );

		if ( $redirect === 'NOT_FOUND' ) {
			$randomString           = uniqid( '404_', true );
			$randomURI              = '/wg/' . $randomString;
			$_SERVER['REQUEST_URI'] = sanitize_url($randomURI);
			return;
		}

		if ( $redirect ) {
			if ( ! $this->request_url_services->get_weglot_url()->getForLanguage( $this->current_language ) && ! strpos( $this->request_url_services->get_weglot_url()->getForLanguage( $this->language_services->get_original_language() ), 'wp-comments-post.php' ) !== false ) {
				wp_safe_redirect( $this->request_url_services->get_weglot_url()->getForLanguage( $this->language_services->get_original_language() ), 301 );
				exit;
			}
		}

		// If we receive a not translated slug we return a 301. For example if we have /fr/products but should have /fr/produits we should redirect to /fr/produits.
		if ( $this->request_url_services->get_weglot_url()->getRedirect() !== null ) {
			$redirect_to = $this->request_url_services->get_weglot_url()->getRedirect();
			wp_safe_redirect( '/' . $this->current_language->getExternalCode() . $redirect_to, 301 );
			exit;
		}
		$_SERVER['REQUEST_URI'] = sanitize_url( $this->request_url_services->get_weglot_url()->getPathPrefix() .
												$this->request_url_services->get_weglot_url()->getPathAndQuery() );

	}

	/**
	 * @return void
	 * @since 2.0
	 */

	public function manage_trailing_slash() {
		if(empty($_SERVER['REQUEST_URI'])){
			return;
		}
		$request_uri = esc_url_raw($_SERVER['REQUEST_URI']);
		$current_language_code = $this->current_language->getExternalCode();
		if (!preg_match('#^/' . preg_quote($current_language_code, '#') . '(/|$)#', $request_uri)) {
			$request_uri = '/' . $current_language_code . $request_uri;
		}

		if (strpos($request_uri, '?') !== false) {
			[$path, $query] = explode('?', $request_uri, 2);

			if (!$this->ends_with_slash($path)) {
				$path .= '/';

				$new_request_uri = $path . '?' . $query;

				wp_safe_redirect($new_request_uri);
				exit;
			}
		} else {
			if (!$this->ends_with_slash($request_uri)) {
				$new_request_uri = $request_uri . '/';

				wp_safe_redirect($new_request_uri);
				exit;
			}
		}
	}

	/**
	 * @return bool
	 * @since 2.0
	 *
	 */
	private function ends_with_slash($string) {
		return substr($string, -1) === '/';
	}

	/**
	 * @return void
	 * @since 2.0
	 *
	 */
	public function prepare_rtl_language() {
		if ( $this->current_language->isRtl() ) {
			$GLOBALS['text_direction'] = 'rtl'; // phpcs:ignore
		} else {
			$GLOBALS['text_direction'] = 'ltr'; // phpcs:ignore
		}
	}

	/**
	 * @return void
	 * @since 2.0
	 * @version 2.3.0
	 * @see wp_head
	 */
	public function weglot_href_lang() {
		$remove_google_translate = apply_filters( 'weglot_remove_google_translate', true );
		if ( $remove_google_translate ) {
			$original_language = $this->language_services->get_original_language();
			$current_language  = $this->request_url_services->get_current_language();
			if ( $current_language !== $original_language ) {
				echo "\n" . '<meta name="google" content="notranslate"/>';
			}
		}

		$add_href_lang = apply_filters( 'weglot_add_hreflang', true );
		if ( $add_href_lang ) {
			echo $this->href_lang_services->generate_href_lang_tags(); //phpcs:ignore
		}
	}

	/**
	 * @return void
	 * @since 2.0
	 * @version 2.3.0
	 * @see wp_head
	 */
	public function weglot_custom_settings() {
		$settings = get_transient( 'weglot_cache_cdn' );
		if ( empty( $settings ) ) {
			$settings = $this->option_services->get_options();
		}
		unset( $settings['deleted_at'] );
		unset( $settings['api_key'] );
		unset( $settings['technology_id'] );
		unset( $settings['category'] );
		unset( $settings['versions'] );
		unset( $settings['wp_user_version'] );
		unset( $settings['page_views_enabled'] );
		unset( $settings['external_enabled'] );
		unset( $settings['media_enabled'] );
		unset( $settings['translate_amp'] );
		unset( $settings['translate_search'] );
		unset( $settings['translate_email'] );
		unset( $settings['button_style'] );
		unset( $settings['translation_engine'] );
		unset( $settings['auto_switch_fallback'] );
		unset( $settings['auto_switch'] );
		unset( $settings['dynamics'] );
		unset( $settings['technology_name'] );
		$settings['current_language'] = $this->current_language->getInternalCode();
		$settings['switcher_links']   = array();
		foreach ( $this->language_services->get_original_and_destination_languages( $this->request_url_services->is_allowed_private() ) as $language ) {
			$link_button = $this->request_url_services->get_weglot_url()->getForLanguage( $language, true );
			if ( $link_button ) {
				if ( $this->option_services->get_option( 'auto_redirect' )
				) {
					$is_orig = $language === $this->language_services->get_original_language() ? 'true' : 'false';
					if ( strpos( $link_button, '?' ) !== false ) {
						$link_button = str_replace( '?', "?wg-choose-original=$is_orig&", $link_button );
					} else {
						$link_button .= "?wg-choose-original=$is_orig";
					}
				}
				$settings['switcher_links'][ $language->getInternalCode() ] = $link_button;
			}
		}

		$settings['original_path'] = $this->request_url_services->get_weglot_url()->getPath();
		$settings                  = $this->feature_flags_services->generate_feature_flags( $settings );
		if ( ! empty( $settings['custom_settings']['switchers'] ) ) {
			echo '<script type="application/json" id="weglot-data">';
			echo wp_json_encode( $settings );
			echo '</script>';
		}
	}

	/**
	 *
	 * @return void
	 * @throws Exception
	 * @since 2.3.0
	 */
	public function enqueue_switcher_templatefile() {

		$show_switcher = $this->request_url_services->get_weglot_url()->getExcludeOption( $this->current_language, 'language_button_displayed' );
		$is_excluded = $this->request_url_services->get_weglot_url()->getExcludeOption( $this->current_language, 'exclusion_behavior' );

		if($is_excluded && !$show_switcher){
			return;
		}

		$settings      = $this->option_services->get_options();
		$template_file = array();

		if ( isset( $settings['custom_settings']['switchers'] ) && ! empty( $settings['custom_settings']['switchers'] ) ) {
			$switchers = $settings['custom_settings']['switchers'];
			foreach ( $switchers as $switcher ) {
				if ( isset( $switcher['template'] ) ) {
					if ( ! in_array( $switcher['template'], $template_file ) ) {
						$template_file[] = $switcher['template'];
					}
				}
			}
			if ( ! empty( $template_file ) ) {
				$template_file = array_merge( $template_file );
				foreach ( $template_file as $filename ) {
					$filename_esc = esc_attr( 'weglot-switcher-' . $filename['name'] );
					if ( isset( $filename['hash'] ) && ! empty( $filename['hash'] ) ) {
						$file_to_load = esc_url( Helper_API::get_tpl_switchers_url() . $filename['name'] . '.' . $filename['hash'] ) . '.min.js';
					} else {
						$file_to_load = esc_url( Helper_API::get_tpl_switchers_url() . $filename['name'] ) . '.min.js';
					}

					wp_enqueue_script(
						$filename_esc, // Handle name
						$file_to_load, // Script URL
						array(), // Dependencies (none in this case)
						null, // Version (null to avoid adding a version number)
						true // Load in the footer
					);
				}
			}
		}
	}

	/**
	 * @return void
	 * @throws \Exception
	 * @version 2.3.0
	 * @see wp_head
	 * @since 2.0
	 */
	public function weglot_dynamics() {

		if(weglot_get_current_language() === weglot_get_original_language()) {
			return;
		}
		$add_dynamics = apply_filters( 'weglot_translate_dynamics', false );

		if ( $add_dynamics ) {
			// Get the current URL
			$parsed_url  = wp_parse_url( weglot_get_current_full_url() );
			$current_url = $parsed_url['scheme'] . '://' . $parsed_url['host'];

			if ( isset( $parsed_url['port'] ) ) {
				$current_url .= ':' . $parsed_url['port'];
			}

			if ( isset( $parsed_url['path'] ) ) {
				$current_url .= $parsed_url['path'];
			}
			// Default to allowing the script on all URLs (empty array means no restrictions)
			$default_allowed_urls = [];

			// Allow modification of the allowed URLs via a filter
			$allowed_urls = apply_filters( 'weglot_allowed_urls', $default_allowed_urls );

			// Check if the filter specifies to allow the script on all pages
			if ( $allowed_urls === 'all' ) {
				// Add the script to all pages
				$load_script = true;
			} else {
				// Restrict script loading to specific URLs
				$load_script = ! empty( $allowed_urls ) && in_array( $current_url, $allowed_urls );
			}

			// If the filter returns URLs, restrict script loading to those URLs only
			if ( ! empty( $allowed_urls ) && is_array( $allowed_urls ) && ! in_array( $current_url, $allowed_urls ) ) {
				return; // Do nothing if the current URL is not in the allowed list
			}

			if ( $load_script ) {
				$api_key = weglot_get_option( 'api_key' );

				// Define default values
				$default_whitelist = [
					[ 'value' => '.wp-block-woocommerce-cart' ],
					[ 'value' => '.wc-block-checkout' ],
					[ 'value' => '.wp-block-woocommerce-mini-cart-contents' ],
					[ 'value' => '.wisepops-popup' ],
					[ 'value' => '.wisepops-tab' ],
				];
				$default_dynamics  = [
					[ 'value' => '.wp-block-woocommerce-cart' ],
					[ 'value' => '.wc-block-checkout' ],
					[ 'value' => '.wp-block-woocommerce-mini-cart-contents' ],
					[ 'value' => '.wisepops-popup' ],
					[ 'value' => '.wisepops-tab' ],
				];

				$default_proxify_iframes  = [
				];
				// Apply filters
				$whitelist = apply_filters( 'weglot_whitelist_selectors', $default_whitelist );
				$dynamics  = apply_filters( 'weglot_dynamics_selectors', $default_dynamics );
				$proxify_iframes  = apply_filters( 'weglot_proxify_iframes', $default_proxify_iframes );
				?>
				<script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
				<script>
					Weglot.initialize({
						api_key: '<?php echo esc_js( $api_key ); ?>',
						whitelist: <?php echo wp_json_encode( $whitelist ); ?>,
						dynamics: <?php echo wp_json_encode( $dynamics ); ?>,
						proxify_iframes: <?php echo wp_json_encode( $proxify_iframes ); ?>,
						hide_switcher: true,
						language_to: '<?php echo esc_js( weglot_get_current_language() ); ?>',
						auto_switch: true
					});
				</script>
				<?php
			}
		}
	}
}
