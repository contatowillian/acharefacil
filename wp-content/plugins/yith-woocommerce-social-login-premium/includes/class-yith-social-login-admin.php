<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Admin class
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH WooCommerce Social Login
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YWSL_INIT' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WC_Social_Login_Admin' ) ) {
	/**
	 * YITH WooCommerce Social Login Admin class
	 *
	 * @since 1.0.0
	 */
	class YITH_WC_Social_Login_Admin {
		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var \YITH_WC_Social_Login_Admin
		 */
		protected static $instance;

		/**
		 * Panel
		 *
		 * @var Panel
		 */
		protected $panel;

		/**
		 * Premium tab template file name
		 *
		 * @var string
		 */
		protected $premium = 'premium.php';

		/**
		 * Premium version landing link
		 *
		 * @var string
		 */
		protected $premium_landing = 'https://yithemes.com/themes/plugins/yith-woocommerce-social-login/';

		/**
		 * Panel Page
		 *
		 * @var string
		 */
		protected $panel_page = 'yith_woocommerce_social_login';

		/**
		 * Returns single instance of the class
		 *
		 * @return YITH_WC_Social_Login_Admin
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$this->create_menu_items();

			// Add action links.
			add_filter( 'plugin_action_links_' . plugin_basename( YITH_YWSL_DIR . '/' . basename( YITH_YWSL_FILE ) ), array( $this, 'action_links' ) );
			add_filter( 'yith_show_plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 5 );

			if ( ywsl_check_wpengine() ) {
				add_filter( 'ywsl_callback_url_list', array( $this, 'get_only_callback_url' ) );
			}

			// custom styles and javascripts.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );

			// Add a message in administrator panel if there's the old mode.
			add_action( 'admin_notices', array( $this, 'google_plus_notice' ) );
			add_action( 'wp_ajax_ywsl_dismiss_google_plus_notice', array( $this, 'dismiss_google_check_notice' ) );
		}


		/**
		 * Enqueue styles and scripts
		 *
		 * @access public
		 * @return void
		 * @since  1.0.0
		 */
		public function enqueue_styles_scripts() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_register_script( 'yith_ywsl_admin', YITH_YWSL_ASSETS_URL . '/js/backend' . $suffix . '.js', array( 'jquery' ), YITH_YWSL_VERSION, true );
			if ( ( isset( $_GET['page'] ) && $_GET['page'] === $this->panel_page ) || ( isset( $_GET['report'] ) && $_GET['report'] === 'social_login' ) ) { //phpcs:ignore
				wp_enqueue_script( 'yith_ywsl_admin' );
				wp_enqueue_style( 'yith_ywsl_backend', YITH_YWSL_ASSETS_URL . '/css/backend.css', false, YITH_YWSL_VERSION );
			}
		}

		/**
		 * Create Menu Items
		 *
		 * Print admin menu items
		 *
		 * @since  1.0
		 */
		private function create_menu_items() {
			// Add a panel under YITH Plugins tab.
			add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );
			add_action( 'ywsl_premium_tab', array( $this, 'premium_tab' ) );
		}

		/**
		 * Add a panel under YITH Plugins tab
		 *
		 * @return   void
		 * @since    1.0
		 * @use      /Yit_Plugin_Panel class
		 * @see      plugin-fw/lib/yit-plugin-panel.php
		 */
		public function register_panel() {

			if ( ! empty( $this->panel ) ) {
				return;
			}

			$admin_tabs = apply_filters(
				'ywsl_admin_tabs',
				array(
					'settings' => __( 'Settings', 'yith-woocommerce-social-login' ),
				)
			);

			if ( defined( 'YITH_YWSL_FREE_INIT' ) ) {
				$admin_tabs['premium'] = __( 'Premium Version', 'yith-woocommerce-social-login' );
			}

			$args = array(
				'create_menu_page' => true,
				'parent_slug'      => '',
				'page_title'       => 'YITH WooCommerce Social Login Premium',
				'menu_title'       => 'Social Login',
				'capability'       => 'manage_options',
				'parent'           => '',
				'is_premium'       => true,
				'parent_page'      => 'yith_plugin_panel',
				'page'             => $this->panel_page,
				'admin-tabs'       => $admin_tabs,
				'options-path'     => YITH_YWSL_DIR . '/plugin-options',
				'class'            => yith_set_wrapper_class(),
			);

			/* === Fixed: not updated theme  === */
			if ( ! class_exists( 'YIT_Plugin_Panel_WooCommerce' ) ) {
				require_once YITH_YWSL_DIR . '/plugin-fw/lib/yit-plugin-panel-wc.php';
			}

			$this->panel = new YIT_Plugin_Panel_WooCommerce( $args );

			do_action( 'ywsl_register_panel', $this->panel );

		}

		/**
		 * Premium Tab Template
		 *
		 * Load the premium tab template on admin page
		 *
		 * @return   void
		 * @since    1.0
		 */
		public function premium_tab() {
			$premium_tab_template = YITH_YWSL_TEMPLATE_PATH . '/admin/' . $this->premium;
			if ( file_exists( $premium_tab_template ) ) {
				include_once $premium_tab_template;
			}
		}

		/**
		 * Action Links
		 *
		 * @param Links $links Plugin array.
		 *
		 * @return mixed
		 * @use      plugin_action_links_{$plugin_file_name}
		 * @since    1.0
		 */
		public function action_links( $links ) {
			$links = yith_add_action_links( $links, $this->panel_page, false );
			return $links;
		}

		/**
		 * Add the action links to plugin admin page.
		 *
		 * @param array  $new_row_meta_args Plugin Meta New args.
		 * @param string $plugin_meta Plugin Meta.
		 * @param string $plugin_file Plugin file.
		 * @param array  $plugin_data Plugin data.
		 * @param string $status Status.
		 * @param string $init_file Init file.
		 *
		 * @return array
		 */
		public function plugin_row_meta( $new_row_meta_args, $plugin_meta, $plugin_file, $plugin_data, $status, $init_file = 'YITH_YWSL_FREE_INIT' ) {
			if ( defined( $init_file ) && constant( $init_file ) == $plugin_file ) { //phpcs:ignore
				$new_row_meta_args['slug'] = YITH_YWSL_SLUG;
			}

			return $new_row_meta_args;
		}

		/**
		 * Get the premium landing uri
		 *
		 * @return  string The premium landing link
		 * @since   1.0.0
		 */
		public function get_premium_landing_uri() {
			return defined( 'YITH_REFER_ID' ) ? $this->get_premium_landing_uri() . '?refer_id=' . YITH_REFER_ID : $this->premium_landing;
		}


		/**
		 * Get callback url
		 *
		 * @param array $callback_list Callback list url.
		 *
		 * @return mixed
		 * @since  1.3.0
		 */
		public function get_only_callback_url( $callback_list ) {
			if ( isset( $callback_list['hybrid'] ) ) {
				unset( $callback_list['hybrid'] );
			}

			return $callback_list;
		}


		/**
		 * Show the notice for Google Plus
		 */
		public function google_plus_notice() {

			if ( ! current_user_can( 'manage_options' ) || get_option( 'ywsl_google_enable' ) !== 'yes' ) {
				return;
			}

			if ( 'yes' !== get_option( 'yit_social_login_google_check', 'no' ) || apply_filters( 'ywsl_google_check', false ) ) {
				?>
				<div class="notice notice-warning is-dismissible ywsl-dismiss-google-check">
					<p>
						<strong><?php echo esc_html_x( 'YITH WooCommerce Social Login', 'Do not translate', 'yith-woocommerce-social-login' ); ?></strong>
					</p>

					<p>
						<?php esc_html_e( 'Please, note: the Google+ Sign-in feature has been fully deprecated and will also be shut down on March 7, 2019.', 'yith-woocommerce-social-login' ); ?>
					</p>

					<p>
						<?php esc_html_e( 'The administrator should check if their credentials are compatible and adjust them if necessary.', 'yith-woocommerce-social-login' ); ?>
					</p>

					<p>
						<a href="https://docs.yithemes.com/yith-woocommerce-social-login/premium-version-settings/google-configuration-settings/" target="_blank"><?php esc_html_e( 'Please, check the plugin documentation.', 'yith-woocommerce-social-login' ); ?></a>
					</p>
				</div>
				<script>
					(function ($) {
						$('.ywsl-dismiss-google-check').on('click', '.notice-dismiss', function () {
							jQuery.post("<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>", {
								action: "ywsl_dismiss_google_plus_notice",
								dismiss_action: "ywsl_dismiss_google_check",
								nonce: "<?php echo esc_js( wp_create_nonce( 'ywsl_dismiss_google_check' ) ); ?>"
							});
						});
					})(jQuery);
				</script>
				<?php
			}
		}


		/**
		 * AJAX handler for dismiss notice action.
		 *
		 * @since  2.0.0
		 * @access public
		 */
		public function dismiss_google_check_notice() {
			if ( empty( $_POST['dismiss_action'] ) ) {
				return;
			}

			check_ajax_referer( 'ywsl_dismiss_google_check', 'nonce' );

			update_option( 'yit_social_login_google_check', 'yes' );

			wp_die();
		}


	}

	/**
	 * Unique access to instance of YITH_WC_Social_Login_Admin class
	 *
	 * @return \YITH_WC_Social_Login_Admin
	 */
	function YITH_WC_Social_Login_Admin() { //phpcs:ignore
		return YITH_WC_Social_Login_Admin::get_instance();
	}
}

