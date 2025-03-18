<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Admin class for Premium Version
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH WooCommerce Social Login
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YWSL_INIT' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WC_Social_Login_Admin_Premium' ) ) {
	/**
	 * YITH WooCommerce Social Login Admin Premium class
	 *
	 * @since 1.0.0
	 */
	class YITH_WC_Social_Login_Admin_Premium extends YITH_WC_Social_Login_Admin {

		/**
		 * Panel
		 *
		 * @var Panel
		 */
		protected $panel; //phpcs:ignore

		/**
		 * Stats
		 *
		 * @var array
		 */
		public $stats = array();

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WC_Social_Login_Admin_Premium
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
		 * @return \YITH_WC_Social_Login_Admin_Premium
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct();

			// reports.
			add_filter( 'woocommerce_admin_reports', array( $this, 'add_report_customer' ) );

			// user list table.
			add_action( 'manage_users_columns', array( $this, 'add_connection_user_column' ) );
			add_action( 'manage_users_custom_column', array( $this, 'add_connection_user_column_content' ), 10, 3 );

			// user profile.
			add_action( 'show_user_profile', array( $this, 'show_connection_in_user_profile' ) );
			add_action( 'edit_user_profile', array( $this, 'show_connection_in_user_profile' ) );

			// apply_filters.
			add_filter( 'ywsl_admin_tabs', array( $this, 'admin_tab_premium' ) );
			add_action( 'ywsl_register_panel', array( $this, 'register_panel_advanced' ) );

			if ( ! empty( get_option( 'ywsl_instagram_key', '' ) ) ) {
				add_action( 'admin_notices', array( $this, 'instagram_notice' ), 15 );
				add_action( 'init', array( $this, 'instagram_notice_update_option' ), 15 );
			}

		}

		/**
		 * Instagram update option to dismiss notice
		 */
		public function instagram_notice_update_option() {
			if ( isset( $_REQUEST['ywsl_instagram_dismiss'] ) ) {
				wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['ywsl_instagram_dismiss'] ) ), 'ywsl_instagram_notice' );
				update_option( 'ywsl_instagram_message', 1 );
				update_option( 'ywsl_instagram_enable', 'no' );
			}
		}

		/**
		 * Add a notice in Administrator
		 */
		public function instagram_notice() {
			$not_administrator = function_exists( 'current_user_can' ) && ! current_user_can( 'administrator' );
			$option            = get_option( 'ywsl_instagram_message', '' );

			if ( $not_administrator || 1 == $option ) { //phpcs:ignore
				return;
			}

			wp_enqueue_script( 'yith_ywsl_admin' );
			?>
			<style>
				#ywsl_instagram_notice span.yith-logo {
					border-radius: 50%;
					background: #265b7a;
					height: 30px;
					width: 30px;
					display: flex;
					text-align: center;
					margin: 0 10px 0 0;
					float: left;
					align-items: center;
					justify-content: center;
				}
			</style>
			<div id="ywsl_instagram_notice" class="notice notice-error is-dismissible"
				data-nonce="<?php echo esc_html( wp_create_nonce( 'ywsl_instagram_notice' ) ); ?>" style="position: relative;">
				<p>
					<span class="yith-logo" style="background-color: "><img src="<?php echo wp_kses_post( yith_plugin_fw_get_default_logo() ); ?>"/></span>
					<b>YITH WooCommerce Social Login</b><br/>
					<?php esc_html_e( 'Due to Instagram Legacy API permission ("Basic Permission") deprecated on June 29, 2020, Instagram authentication has been removed and is no longer available.', 'yith-woocommerce-social-login' ); ?>
				</p>
				<span class="notice-dismiss"></span>

			</div> 
			<?php
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
		public function plugin_row_meta( $new_row_meta_args, $plugin_meta, $plugin_file, $plugin_data, $status, $init_file = 'YITH_YWSL_INIT' ) {
			$new_row_meta_args = parent::plugin_row_meta( $new_row_meta_args, $plugin_meta, $plugin_file, $plugin_data, $status, $init_file );

			if ( defined( $init_file ) && constant( $init_file ) === $plugin_file ) {
				$new_row_meta_args['is_premium'] = true;
			}

			return $new_row_meta_args;
		}

		/**
		 * Action links
		 *
		 * @param array $links Links.
		 *
		 * @return mixed
		 */
		public function action_links( $links ) {
			$links = yith_add_action_links( $links, $this->panel_page, true, YITH_YWSL_SLUG );
			return $links;
		}


		/**
		 * Add A link to Customer Tab in WooCommerce Report
		 *
		 * @param array $report Report.
		 *
		 * @since    1.0.0
		 */
		public function add_report_customer( $report ) {

			if ( isset( $report['customers'] ) ) {

				$report['customers']['reports']['social_login'] = array(
					'title'       => __( 'Social Connections', 'yith-woocommerce-social-login' ),
					'description' => '',
					'hide_title'  => true,
					'callback'    => array( $this, 'get_social_login_report' ),
				);
			}

			return $report;

		}

		/**
		 * Print Social Connection report in Customer Tab of WooCommerce Report
		 *
		 * @return void
		 * @since    1.0.0
		 */
		public function get_social_login_report() {

			$args = array(
				'enabled_social' => YITH_WC_Social_Login()->enabled_social,
				'stats'          => $this->get_providers_stats(),
				'colors'         => $this->get_providers_colors(),
			);

			yit_plugin_get_template( YITH_YWSL_DIR, 'admin/reports/social-connect-report.php', $args );
		}

		/**
		 * Return the stats of connection for network order by connection desc
		 *
		 * @return array
		 * @since    1.0.0
		 */
		public function get_providers_stats() {
			global $wpdb;
			$enabled_social = YITH_WC_Social_Login()->enabled_social;

			foreach ( $enabled_social as $key => $value ) {
				$query         = $wpdb->prepare( 'SELECT count(1) from ' . $wpdb->usermeta . ' WHERE meta_key LIKE "%s"', $key . '_login_id' ); //phpcs:ignore
				$this->stats[] = array(
					'id'    => $key,
					'label' => $value['label'],
					'data'  => $wpdb->get_var( $query ), //phpcs:ignore
				);
			}
			usort( $this->stats, 'ywsl_providers_stats_sort' );
			return $this->stats;
		}

		/**
		 * Return the colors of connection for pie
		 *
		 * @return array
		 * @since    1.0.0
		 */
		public function get_providers_colors() {
			$enabled_social = YITH_WC_Social_Login()->enabled_social;
			$colors         = array();
			foreach ( $this->stats as $stat ) {

				$colors[] = $enabled_social[ $stat['id'] ]['color'];
			}

			return $colors;

		}

		/**
		 * Add a "Connections" column in user table of WordPress
		 *
		 * @param array $columns Columns.
		 *
		 * @return array
		 * @since    1.0.0
		 */
		public function add_connection_user_column( $columns ) {
			$new_columns = array();
			foreach ( $columns as $key => $column ) {
				$new_columns[ $key ] = $column;
				if ( 'email' === $key ) {
					$new_columns['connections'] = __( 'Connections', 'yith-woocommerce-social-login' );
				}
			}
			return $new_columns;
		}

		/**
		 * Return the connections for each user in the user table of WordPress
		 *
		 * @param mixed  $value Value.
		 * @param string $column_name Column name.
		 * @param int    $user_id User id.
		 * @return array|string
		 */
		public function add_connection_user_column_content( $value, $column_name, $user_id ) {
			$connections = YITH_WC_Social_Login_Premium()->get_social_login_connection( $user_id, 20, 'buttons' );
			if ( 'connections' === $column_name ) {
				return $connections;
			}
			return $value;
		}

		/**
		 * Add social connetion info in user profile
		 *
		 * @param WP_User $user User.
		 * @return   void
		 * @since    1.0.0
		 */
		public function show_connection_in_user_profile( $user ) {
			$args = array(
				'connections' => YITH_WC_Social_Login_Premium()->get_social_login_connection( $user->ID, 30, 'buttons' ),
			);

			yit_plugin_get_template( YITH_YWSL_DIR, 'admin/users/social-connect-profile.php', $args );
		}

		/**
		 * Add admin tabs to premium version
		 *
		 * @param array $tabs Tabs.
		 *
		 * @return   array
		 * @since    1.0.0
		 */
		public function admin_tab_premium( $tabs = array() ) {

			$premium_tabs = array(
				'facebook'   => esc_html__( 'Facebook', 'yith-woocommerce-social-login' ),
				'twitter'    => esc_html__( 'Twitter', 'yith-woocommerce-social-login' ),
				'google'     => esc_html__( 'Google', 'yith-woocommerce-social-login' ),
				'linkedin'   => esc_html__( 'LinkedIn', 'yith-woocommerce-social-login' ),
				'yahoo'      => esc_html__( 'Yahoo', 'yith-woocommerce-social-login' ),
				'foursquare' => esc_html__( 'Foursquare', 'yith-woocommerce-social-login' ),
				'live'       => esc_html__( 'Live', 'yith-woocommerce-social-login' ),
				'paypal'     => esc_html__( 'PayPal', 'yith-woocommerce-social-login' ),
				'tumblr'     => esc_html__( 'Tumblr', 'yith-woocommerce-social-login' ),
				'vkontakte'  => esc_html__( 'Vkontakte', 'yith-woocommerce-social-login' ),
				'github'     => esc_html__( 'GitHub', 'yith-woocommerce-social-login' ),
			);

			return array_merge( $tabs, $premium_tabs );
		}

		/**
		 * Order tab in panel options
		 *
		 * @return   array
		 * @since    1.0.0
		 */
		public function admin_tab_premium_ordered() {
			$tabs = $this->admin_tab_premium();
			if ( get_option( 'ywsl_social_networks' ) ) {
				$tabs = array_merge( array_flip( get_option( 'ywsl_social_networks' ) ), $tabs );
			}
			return $tabs;
		}

		/**
		 * Add more featured in options  panel
		 *
		 * @return   void
		 * @since    1.0.0
		 */
		public function register_panel_advanced() {
			add_action( 'woocommerce_admin_field_ywsl_social_networks', array( $this, 'social_network_table' ), 10, 2 );
		}

		/**
		 * Show the table with social
		 *
		 * @param array $args Arguments.
		 * @return   void
		 * @since    1.0.0
		 */
		public function social_network_table( $args = array() ) {
			$new_args = array(
				'tabs'       => $this->admin_tab_premium_ordered(),
				'panel_page' => $this->panel_page,
			);

			$args = array_merge( $new_args, $args );
			yit_plugin_get_template( YITH_YWSL_DIR, 'admin/social_network_table.php', $args );
		}

	}

	/**
	 * Unique access to instance of YITH_WC_Social_Login_Admin_Premium class
	 *
	 * @return \YITH_WC_Social_Login_Admin_Premium
	 */
	function YITH_WC_Social_Login_Admin_Premium() { //phpcs:ignore
		return YITH_WC_Social_Login_Admin_Premium::get_instance();
	}
}

