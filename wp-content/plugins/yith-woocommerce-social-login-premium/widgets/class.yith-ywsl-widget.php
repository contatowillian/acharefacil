<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * YWSL_Social_Login_Widget
 *
 * @class   YWSL_Social_Login_Widget
 * @package YITH Woocommerce Social Login Premium
 * @since   1.0.0
 * @author  YITH <plugins@yithemes.com>
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'YITH_YWSL_INIT' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'YWSL_Social_Login_Widget' ) ) {
	/**
	 * YWSL_Social_Login_Widget
	 *
	 * @since 1.0.0
	 */
	class YWSL_Social_Login_Widget extends WP_Widget {

		/**
		 * Constructor
		 *
		 * @access public
		 */
		public function __construct() {

			/* Widget variable settings. */
			$this->woo_widget_cssclass    = 'woocommerce widget_ywsl_social_login';
			$this->woo_widget_description = __( 'Show social login', 'yith-woocommerce-social-login' );
			$this->woo_widget_idbase      = 'yith_ywsl_social_login';
			$this->woo_widget_name        = __( 'YITH WooCommerce Social Login', 'yith-woocommerce-social-login' );

			/* Widget settings. */
			$widget_ops = array(
				'classname'   => $this->woo_widget_cssclass,
				'description' => $this->woo_widget_description,
			);

			/* Create the widget. */
			parent::__construct( 'yith_ywsl_social_login', $this->woo_widget_name, $widget_ops );

		}


		/**
		 * Widget function.
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $args Args.
		 * @param array $instance Instance.
		 * @return void
		 */
		public function widget( $args, $instance ) {

			extract( $args ); //phpcs:ignore

			$this->istance = $instance;
			$title         = isset( $instance['title'] ) ? $instance['title'] : '';
			$description   = isset( $instance['description'] ) ? $instance['description'] : '';
			$redirect_to   = isset( $instance['redirect_to'] ) ? $instance['redirect_to'] : '';
			$title         = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			if ( is_user_logged_in() ) {
				return;
			}

			echo $before_widget; //phpcs:ignore

			if ( $title ) {
				echo $before_title . $title . $after_title; //phpcs:ignore
			}

			echo do_shortcode( '[yith_wc_social_login label="' . $description . '" redirect_to="' . $redirect_to . '"]' ); //phpcs:ignore

			echo $after_widget; //phpcs:ignore
		}

		/**
		 * Update function.
		 *
		 * @see WP_Widget->update
		 * @access public
		 * @param array $new_instance New instance.
		 * @param array $old_instance Old instance.
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance['title']       = wp_strip_all_tags( stripslashes( $new_instance['title'] ) );
			$instance['description'] = wp_strip_all_tags( stripslashes( $new_instance['description'] ) );
			$instance['redirect_to'] = $new_instance['redirect_to'];

			$this->istance = $instance;
			return $instance;
		}

		/**
		 * Form function.
		 *
		 * @see WP_Widget->form
		 * @access public
		 * @param array $instance Instance.
		 * @return void
		 */
		public function form( $instance ) {
			$defaults = array(
				'title'       => esc_html__( 'Social Login', 'yith-woocommerce-social-login' ),
				'description' => esc_html__( 'Login width:', 'yith-woocommerce-social-login' ),
				'redirect_to' => '',
			);

			$instance    = wp_parse_args( (array) $instance, $defaults );
			$title       = isset( $instance['title'] ) ? $instance['title'] : '';
			$redirect    = isset( $instance['redirect_to'] ) ? $instance['redirect_to'] : '';
			$description = isset( $instance['description'] ) ? $instance['description'] : '';
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'yith-woocommerce-social-login' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description:', 'yith-woocommerce-social-login' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" value="<?php echo esc_attr( $description ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'redirect_to' ) ); ?>"><?php esc_html_e( 'Redirect To (optional):', 'yith-woocommerce-social-login' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'redirect_to' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'redirect_to' ) ); ?>" value="
				<?php echo esc_attr( $redirect ); ?>" />
			</p>

			<?php
		}


	}
}
