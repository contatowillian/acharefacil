<?php


if ( ! defined( 'WPINC' ) ) {
	die; 
}

if ( !class_exists( 'Addify_Registration_Fields_Admin_Email' ) ) { 

	class Addify_Registration_Fields_Admin_Email extends WC_Email {

		/**
		 * Constructor of membership activated.
		 */
		public function __construct() { 
			$this->id             = 'afreg_new_user_email_admin'; // Unique ID to Store Emails Settings
			$this->title          = __( 'Addify Registration New User Email Admin', 'addify_reg' ); // Title of email to show in Settings
			$this->customer_email = false; // Set true for customer email and false for admin email.
			$this->description    = __( 'This email will be sent to admin when new account is created.', 'addify_reg' ); // description of email
			$this->template_base  = AFREG_PLUGIN_DIR . 'templates/'; // Base directory of template 
			$this->template_html  = 'emails/afreg-new-user-email-admin.php'; // HTML template path
			$this->template_plain = 'emails/plain/afreg-new-user-email-admin.php'; // Plain template path

			$this->placeholders = array( // Placeholders/Variables to be used in email
				

			);

			// Call to the  parent constructor.
			parent::__construct(); // Must call constructor of parent class

			// Other settings.
			$this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );

			// Trigger function.
			add_action( 'afreg_new_user_email_notification_admin', array( $this, 'trigger' ), 10, 2 ); // action hook(s) to trigger email 
		}

		/**
		 * Get email subject.
		 *
		 * @since  3.1.0
		 * @return string
		 */
		public function get_default_subject() {

			//Old versions compatibility.
			if (!empty(get_option('afreg_admin_email_subject'))) {

				return __(get_option('afreg_admin_email_subject'), 'addify_reg');

			} else {

				return __( '[{site_title}]: New User Registration', 'addify_reg' );

			}           
		}

		/**
		 * Get email heading.
		 *
		 * @since  3.1.0
		 * @return string
		 */
		public function get_default_heading() {
			return __( 'New User Registration', 'addify_reg' );
		}


		public function trigger( $customer_id, $default_fields ) {

			$this->setup_locale();

					$customer = new WP_User($customer_id);

					$customer_details = '';
				
			if (!empty($customer)) {

						

				$user_meta = get_userdata($customer_id);

				$user_role = $user_meta->roles;

				$user_login = stripslashes($customer->user_login);
				$user_email = stripslashes($customer->user_email);

				//custom message
				$email_content = get_option('afreg_admin_email_text');

				if (!empty(get_option('afreg_exclude_user_roles_approve_new_user'))) {

					$exclude_user_roles = get_option('afreg_exclude_user_roles_approve_new_user');
				} else {

					$exclude_user_roles = array();
				}

				

				//Approve user link, this will work only when approve new user setting is enabled.
				if ('yes' == get_option('afreg_enable_approve_user') && !in_array($user_role[0], $exclude_user_roles) ) {
					$default_admin_url = admin_url( 'users.php?afreg-status-query-submit=addify-afreg-fields&action_email=approved&paged=1&user=' . $customer_id );
					$approve_link      = wp_nonce_url($default_admin_url );

					//Disapprove user link, this will work only when approve new user setting is enabled.
					$default_admin_url2 = admin_url( 'users.php?afreg-status-query-submit=addify-afreg-fields&action_email=disapproved&paged=1&user=' . $customer_id );
					$disapprove_link    = wp_nonce_url($default_admin_url2 );

					$email_content = str_replace('{approve_link}', $approve_link, $email_content);
					$email_content = str_replace('{disapprove_link}', $disapprove_link, $email_content);

				} else {

					$email_content = str_replace('{approve_link}', '', $email_content);
					$email_content = str_replace('{disapprove_link}', '', $email_content);
				}

						
				$customer_details .= '<p><b>' . esc_html__('Username: ', 'addify_reg') . '</b>' . $user_login . '</p>';
				$customer_details .= '<p><b>' . esc_html__('E-mail: ', 'addify_reg') . '</b>' . $user_email . '</p>';

				//Default Fields
				if (!empty($default_fields)) {

					$customer_details .= $default_fields;
				}

				//User Role
				if ( !empty( get_option('afreg_enable_approve_user')) && 'yes' == get_option('afreg_enable_approve_user')) {
							

					if ( !empty(get_option('afreg_user_role_field_text'))) {

						$role_field_label = get_option('afreg_user_role_field_text');
					} else {

						$role_field_label = 'User Role';
					}

					$customer_details .= '<p><b>' . esc_html__( $role_field_label . ': ', 'addify_reg') . '</b><span style="text-transform: capitalize;">' . $user_role[0] . '</span></p>';
				}

				//Additional Fields
				$afreg_args = array( 
					'posts_per_page' => -1,
					'post_type'      => 'afreg_fields',
					'post_status'    => 'publish',
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				);

				$afreg_extra_fields = get_posts($afreg_args);
				if (!empty($afreg_extra_fields)) {
					foreach ($afreg_extra_fields as $afreg_field) {
						
						$afreg_field_type = get_post_meta( intval($afreg_field->ID), 'afreg_field_type', true );
						$afregcheck       = get_user_meta( $customer_id, 'afreg_additional_' . intval($afreg_field->ID), true );

						if (!empty($afregcheck)) {

							$value = get_user_meta( $customer_id, 'afreg_additional_' . intval($afreg_field->ID), true );
									
							if ( 'checkbox' == $afreg_field_type) {
								if ('yes' == $value) {
									$customer_details .= '<p><b>' . esc_html__($afreg_field->post_title . ': ', 'addify_reg') . '</b>' . esc_html__('Yes', 'addify_reg') . '</p>';
								} else {
									$customer_details .= '<p><b>' . esc_html__($afreg_field->post_title . ': ', 'addify_reg') . '</b>' . esc_html__('No', 'addify_reg') . '</p>';
								}
										
							} elseif ( 'fileupload' == $afreg_field_type) {


								$upload_url = wp_upload_dir();

								$current_file = '';

								$curr_image_new_folder = $upload_url['basedir'] . '/addify_registration_uploads/' . $value;
						
								$curr_image = esc_url(AFREG_URL . 'uploaded_files/' . $value);

								if (file_exists($curr_image_new_folder)) {

									$current_file = esc_url($upload_url['baseurl'] . '/addify_registration_uploads/' . $value);

								} elseif (file_exists($curr_image)) {

									$current_file = esc_url(AFREG_URL . 'uploaded_files/' . $value);

								}


										
								$customer_details .= '<p><b>' . esc_html__($afreg_field->post_title . ': ', 'addify_reg') . '</b>' . $current_file . '</p>';

							} elseif ( in_array( $afreg_field_type , array( 'multiselect', 'multi_checkbox', 'select', 'radio' ) ) ) {
								$val_array           = explode(', ' , $value );
								$afreg_field_options = unserialize(get_post_meta(  intval($afreg_field->ID) , 'afreg_field_option', true )); 
								$value               = '';
								foreach ( $val_array as $option_val ) {
									foreach ($afreg_field_options as $afreg_field_option ) { 
										if ( esc_attr( $option_val ) == $afreg_field_option['field_value'] ) {
											$value .=  $afreg_field_option['field_text'] . ', ';
										}
									}
								}

								$customer_details .= '<p><b>' . esc_html__($afreg_field->post_title . ': ', 'addify_reg') . '</b>' . $value . '</p>';
							} elseif ('timepicker' == $afreg_field_type) {

								$customer_details .= '<p><b>' . esc_html__($afreg_field->post_title . ': ', 'addify_reg') . '</b><input type="time" value="' . $value . '" readonly="readonly"></p>';
										
							} else {
								$customer_details .= '<p><b>' . esc_html__($afreg_field->post_title . ': ', 'addify_reg') . '</b>' . $value . '</p>';
							}

						}
					}
				}




				$email_content = str_replace('{customer_details}', $customer_details, $email_content);

				$this->email_content = $email_content;
				$this->object        = $customer;
				
			}
				
			

			if ( $this->is_enabled() && $this->get_recipient() ) {

				$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
			}

			$this->restore_locale();
		}


		public function get_content_html() {
			return wc_get_template_html(
				$this->template_html,
				array(
					'customer'           => $this->object,
					'email_heading'      => $this->get_heading(),
					'email_content'      => $this->email_content,
					'additional_content' => $this->get_additional_content(),
					'sent_to_admin'      => true,
					'plain_text'         => false,
					'email'              => $this,
				),
				'',
				$this->template_base
			);
		}

	
		public function get_content_plain() {
			return wc_get_template_html(
				$this->template_html,
				array(
					'customer'           => $this->object,
					'email_heading'      => $this->get_heading(),
					'email_content'      => $this->email_content,
					'additional_content' => $this->get_additional_content(),
					'sent_to_admin'      => true,
					'plain_text'         => false,
					'email'              => $this,
				),
				'',
				$this->template_base
			);
		}


		/**
		 * Initialise settings form fields.
		 */
		public function init_form_fields() {



			/* translators: %s: list of placeholders */
			$placeholder_text  = sprintf( __( 'Available placeholders: %s', 'addify_reg' ), '<code>' . implode( '</code>, <code>', array_keys( $this->placeholders ) ) . '</code>' );
			$this->form_fields = array(
				'enabled'            => array(
					'title'   => __( 'Enable/Disable', 'addify_reg' ),
					'type'    => 'checkbox',
					'label'   => __( 'Enable this email notification', 'addify_reg' ),
					'default' => 'yes',
				),
				'recipient'          => array(
					'title'       => __( 'Recipient(s)', 'addify_reg' ),
					'type'        => 'text',
					/* translators: %s: WP admin email */
					'description' => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to %s.', 'addify_reg' ), '<code>' . esc_attr( get_option( 'admin_email' ) ) . '</code>' ),
					'placeholder' => '',
					'default'     => '',
					'desc_tip'    => true,
				),
				'subject'            => array(
					'title'       => __( 'Subject', 'addify_reg' ),
					'type'        => 'text',
					'desc_tip'    => true,
					'description' => $placeholder_text,
					'placeholder' => $this->get_default_subject(),
					'default'     => '',
				),
				'heading'            => array(
					'title'       => __( 'Email heading', 'addify_reg' ),
					'type'        => 'text',
					'desc_tip'    => true,
					'description' => $placeholder_text,
					'placeholder' => $this->get_default_heading(),
					'default'     => '',
				),
				'additional_content' => array(
					'title'       => __( 'Additional content', 'addify_reg' ),
					'description' => __( 'Text to appear below the main email content.', 'addify_reg' ) . ' ' . $placeholder_text,
					'css'         => 'width:400px; height: 75px;',
					'placeholder' => __( 'N/A', 'addify_reg' ),
					'type'        => 'textarea',
					'default'     => $this->get_default_additional_content(),
					'desc_tip'    => true,
				),
				'email_type'         => array(
					'title'       => __( 'Email type', 'addify_reg' ),
					'type'        => 'select',
					'description' => __( 'Choose which format of email to send.', 'addify_reg' ),
					'default'     => 'html',
					'class'       => 'email_type wc-enhanced-select',
					'options'     => $this->get_email_type_options(),
					'desc_tip'    => true,
				),
			);
		}
	}

	

}
