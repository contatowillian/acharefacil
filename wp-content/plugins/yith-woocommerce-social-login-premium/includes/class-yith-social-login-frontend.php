<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Frontend class
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH WooCommerce Social Login
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YWSL_INIT' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WC_Social_Login_Frontend' ) ) {
	/**
	 * YITH WooCommerce Social Login Admin class
	 *
	 * @since 1.0.0
	 */
	class YITH_WC_Social_Login_Frontend {
		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var \YITH_WC_Social_Login_Frontend
		 */
		protected static $instance;

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WC_Social_Login_Frontend
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

			// custom styles and javascripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );
		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return void
		 * @since  1.0.0
		 */
		public function enqueue_styles_scripts() {

			$socials     = YITH_WC_Social_Login()->enabled_social;
			$redirect_to = YITH_WC_Social_Login()->get_redirect_to();
			$social_args = array();

			foreach ( $socials as $key => $value ) {
				$enabled = get_option( 'ywsl_' . $key . '_enable' );

				if ( 'yes' === $enabled ) {
					$social_args[ strtolower( $value['label'] ) ] = esc_url(
						add_query_arg(
							array(
								'ywsl_social' => $key,
								'redirect'    => urlencode( $redirect_to ), //phpcs:ignore
							),
							site_url( 'wp-login.php' )
						)
					);
				}
			}

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_enqueue_script( 'ywsl_frontend_social', YITH_YWSL_ASSETS_URL . '/js/frontend' . $suffix . '.js', array( 'jquery' ), YITH_YWSL_VERSION, true );
			wp_localize_script( 'ywsl_frontend_social', 'ywsl', $social_args );

			wp_enqueue_style( 'ywsl_frontend', YITH_YWSL_ASSETS_URL . '/css/frontend.css', false, YITH_YWSL_VERSION );
		}

		/**
		 * Print social buttons
		 *
		 * @param string $template_part Template part.
		 * @param bool   $is_shortcode  Is Shortcode.
		 * @param array  $atts          Attributes.
		 *
		 * @since  1.0.0
		 */
		public function social_buttons( $template_part = '', $is_shortcode = false, $atts = array() ) {

			$enabled_social = YITH_WC_Social_Login()->enabled_social;
			$template_part  = empty( $template_part ) ? 'social-buttons' : $template_part;

			if ( $is_shortcode ) {
				ob_start();
			}

			$args = array(
				'label'          => get_option( 'ywsl_social_label' ),
				'socials'        => $enabled_social,
				'label_checkout' => get_option( 'ywsl_social_label_checkout' ),
				'redirect_to'    => YITH_WC_Social_Login()->get_redirect_to(),
			);

			$args = wp_parse_args( $atts, $args );

			if ( ! empty( $enabled_social ) ) {
				if ( ! is_user_logged_in() ) {
					wc_get_template( $template_part . '.php', $args, '', YITH_YWSL_TEMPLATE_PATH . '/' );
				} else {
					YITH_WC_Social_Login_Premium()->my_account_social_connection();
				}
			}

			if ( $is_shortcode ) {
				return ob_get_clean();
			}
		}

		/**
		 * Show social buttons in checkout page
		 *
		 * @param string $template_name Template name.
		 *
		 * @return void
		 * @since  1.0.0
		 */
		public function social_buttons_in_checkout( $template_name ) {
			if ( 'checkout/form-login.php' === $template_name ) {
				$this->social_buttons( 'social-buttons-checkout' );
			}
		}

		/**
		 * Add Social login to Checkout Block
		 *
		 * @param string $content The content.
		 *
		 * @return string
		 * @since 1.36.0
		 */
		public function social_buttons_in_checkout_blocks( $content ) {
			return $this->social_buttons( 'social-buttons-checkout', true ) . $content;
		}
	}

	/**
	 * Unique access to instance of YITH_WC_Social_Login_Frontend class
	 *
	 * @return \YITH_WC_Social_Login_Frontend
	 */
	function YITH_WC_Social_Login_Frontend() { //phpcs:ignore
		return YITH_WC_Social_Login_Frontend::get_instance();
	}
}
