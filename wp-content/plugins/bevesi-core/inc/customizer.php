<?php
/*======
*
* Kirki Settings
*
======*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

Kirki::add_config(
	'bevesi_customizer', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

/*======
*
* Sections
*
======*/
$sections = array(
	'shop_settings' => array (
		esc_attr__( 'Shop Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the shop settings.', 'bevesi-core' ),
	),
	
	'blog_settings' => array (
		esc_attr__( 'Blog Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the blog settings.', 'bevesi-core' ),
	),

	'header_settings' => array (
		esc_attr__( 'Header Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the header settings.', 'bevesi-core' ),
	),

	'main_color' => array (
		esc_attr__( 'Main Color', 'bevesi-core' ),
		esc_attr__( 'You can customize the main color.', 'bevesi-core' ),
	),

	'elementor_templates' => array (
		esc_attr__( 'Elementor Templates', 'bevesi-core' ),
		esc_attr__( 'You can customize the elementor templates.', 'bevesi-core' ),
	),
	
	'map_settings' => array (
		esc_attr__( 'Map Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the map settings.', 'bevesi-core' ),
	),

	'footer_settings' => array (
		esc_attr__( 'Footer Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the footer settings.', 'bevesi-core' ),
	),
	
	'bevesi_widgets' => array (
		esc_attr__( 'Bevesi Widgets', 'bevesi-core' ),
		esc_attr__( 'You can customize the bevesi widgets.', 'bevesi-core' ),
	),

	'gdpr_settings' => array (
		esc_attr__( 'GDPR Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the GDPR settings.', 'bevesi-core' ),
	),

	'newsletter_settings' => array (
		esc_attr__( 'Newsletter Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the Newsletter Popup settings.', 'bevesi-core' ),
	),
	
	'maintenance_settings' => array (
		esc_attr__( 'Maintenance Settings', 'bevesi-core' ),
		esc_attr__( 'You can customize the Maintenance settings.', 'bevesi-core' ),
	),
	
	'typography_settings' => array (
		esc_attr__( 'Bevesi Typography', 'bevesi-core' ),
		esc_attr__( 'You can customize the Typography settings.', 'bevesi-core' ),
	),

);

foreach ( $sections as $section_id => $section ) {
	$section_args = array(
		'title' => $section[0],
		'description' => $section[1],
	);

	if ( isset( $section[2] ) ) {
		$section_args['type'] = $section[2];
	}

	if( $section_id == "colors" ) {
		Kirki::add_section( str_replace( '-', '_', $section_id ), $section_args );
	} else {
		Kirki::add_section( 'bevesi_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
	}
}


/*======
*
* Fields
*
======*/
function bevesi_customizer_add_field ( $args ) {
	Kirki::add_field(
		'bevesi_customizer',
		$args
	);
}

	/*====== Header ==================================================================================*/
		/*====== Header Panels ======*/
		Kirki::add_panel (
			'bevesi_header_panel',
			array(
				'title' => esc_html__( 'Header Settings', 'bevesi-core' ),
				'description' => esc_html__( 'You can customize the header from this panel.', 'bevesi-core' ),
			)
		);

		$sections = array (
			'header_logo' => array(
				esc_attr__( 'Logo', 'bevesi-core' ),
				esc_attr__( 'You can customize the logo which is on header..', 'bevesi-core' )
			),
		
			'header_general' => array(
				esc_attr__( 'Header General', 'bevesi-core' ),
				esc_attr__( 'You can customize the header.', 'bevesi-core' )
			),
			
			'header_product_tab' => array(
				esc_attr__( 'Header Products Tab', 'bevesi-core' ),
				esc_attr__( 'You can customize the header products tab.', 'bevesi-core' )
			),
			
			'header_search' => array(
				esc_attr__( 'Header Search', 'bevesi-core' ),
				esc_attr__( 'You can customize the loader.', 'bevesi-core' )
			),
			
			'header_notification' => array(
				esc_attr__( 'Header Notification', 'bevesi-core' ),
				esc_attr__( 'You can customize the header notification.', 'bevesi-core' )
			),

			'header_preloader' => array(
				esc_attr__( 'Preloader', 'bevesi-core' ),
				esc_attr__( 'You can customize the loader.', 'bevesi-core' )
			),
			
			'header1_style' => array(
				esc_attr__( 'Header 1 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'header2_style' => array(
				esc_attr__( 'Header 2 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'header3_style' => array(
				esc_attr__( 'Header 3 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'header4_style' => array(
				esc_attr__( 'Header 4 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'header5_style' => array(
				esc_attr__( 'Header 5 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'header6_style' => array(
				esc_attr__( 'Header 6 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'mobile_bottom_menu_style' => array(
				esc_attr__( 'Mobile Bottom Menu Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the style.', 'bevesi-core' )
			),
			
			'top_notification_style' => array(
				esc_attr__( 'Top Notification Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the top notification.', 'bevesi-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bevesi_header_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bevesi_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Logo ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_logo',
				'label' => esc_attr__( 'Logo', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload a logo.', 'bevesi-core' ),
				'section' => 'bevesi_header_logo_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Logo White======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_logo_white',
				'label' => esc_attr__( 'Logo White', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload a logo white.', 'bevesi-core' ),
				'section' => 'bevesi_header_logo_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Logo Text ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_logo_text',
				'label' => esc_attr__( 'Set Logo Text', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set logo as text.', 'bevesi-core' ),
				'section' => 'bevesi_header_logo_section',
				'default' => 'Bevesi',
			)
		);

		/*====== Logo Size ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'slider',
				'settings'    => 'bevesi_logo_size',
				'label'       => esc_html__( 'Logo Size', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set size of the logo.', 'bevesi-core' ),
				'section'     => 'bevesi_header_logo_section',
				'default'     => 122,
				'transport'   => 'auto',
				'choices'     => [
					'min'  => 20,
					'max'  => 400,
					'step' => 1,
				],
				'output' => [
				[
					'element' => '.site-header .site-header-main .site-brand img, .site-drawer .site-brand a img',
					'property'    => 'width',
					'units' => 'px',
				], ],
			)
		);
		
		/*====== Header Type ======*/
		bevesi_customizer_add_field(
			array (
				'type'        => 'select',
				'settings'    => 'bevesi_header_type',
				'label'       => esc_html__( 'Header Type', 'bevesi-core' ),
				'section'     => 'bevesi_header_general_section',
				'default'     => 'type1',
				'priority'    => 10,
				'choices'     => array(
					'type1' => esc_attr__( 'Type 1', 'bevesi-core' ),
					'type2' => esc_attr__( 'Type 2', 'bevesi-core' ),
					'type3' => esc_attr__( 'Type 3', 'bevesi-core' ),
					'type4' => esc_attr__( 'Type 4', 'bevesi-core' ),
					'type5' => esc_attr__( 'Type 5', 'bevesi-core' ),
					'type6' => esc_attr__( 'Type 6', 'bevesi-core' ),
				) 
			) 
		);

		/*====== Middle Sticky Header Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_sticky_header',
				'label' => esc_attr__( 'Sticky Header', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the header.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);

		/*====== Mobile Sticky Header Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_mobile_sticky_header',
				'label' => esc_attr__( 'Mobile Sticky Header', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the header on the mobile.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Sale Banner Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_sale_banner_toggle',
				'label' => esc_attr__( 'Sale Banner', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Sale Banner', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Sale Banner Icon ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_sale_banner_icon',
				'label' => esc_attr__( 'Sale Banner Icon', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set an icon. for example; "klb-icon-discount-solid"', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => 'klb-icon-discount-solid',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_sale_banner_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Sale Banner Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_header_sale_banner_title',
				'label' => esc_attr__( 'Sale Banner Title', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '-50% SALE',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_sale_banner_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Sale Banner Subtitle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_header_sale_banner_subtitle',
				'label' => esc_attr__( 'Sale Banner Subtitle', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => 'Winter Sale',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_sale_banner_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Account Icon ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_account',
				'label' => esc_attr__( 'Account Icon / Login', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable User Login/Signup on the header.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Cart Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_cart',
				'label' => esc_attr__( 'Header Cart', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the mini cart on the header.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Sidebar ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_sidebar',
				'label' => esc_attr__( 'Sidebar Menu', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Sidebar Menu', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Sidebar Collapse ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_sidebar_collapse',
				'label' => esc_attr__( 'Disable Collapse on Frontpage', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Sidebar Collapse on Home Page.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_sidebar',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Left Menu Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_top_left_menu',
				'label' => esc_attr__( 'Top Left Menu', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the top left menu.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Top Right Menu Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_top_right_menu',
				'label' => esc_attr__( 'Top Right Menu', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the top right menu.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Categories Popup Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_categories_popup',
				'label' => esc_attr__( 'Categories Popup', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the categories popup.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Canvas Bottom Menu Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_canvas_bottom_menu',
				'label' => esc_attr__( 'Canvas Bottom Menu', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the Canvas Bottom menu.', 'bevesi-core' ),
				'section' => 'bevesi_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Products Tab Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_products_tab',
				'label' => esc_attr__( 'Products Tab', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Products Tab', 'bevesi-core' ),
				'section' => 'bevesi_header_product_tab_section',
				'default' => '0',
			)
		);
		
		/*====== Header Products Tab Button Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_header_products_button_title',
				'label' => esc_attr__( 'Button Title', 'bevesi-core' ),
				'description' => esc_attr__( 'You can add a text for the button.', 'bevesi-core' ),
				'section' => 'bevesi_header_product_tab_section',
				'default' => 'Todays Deal',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_products_tab',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Products Tab On Sale ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_products_tab_on_sale',
				'label' => esc_attr__( 'On Sale Products?', 'bevesi-core' ),
				'section' => 'bevesi_header_product_tab_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_products_tab',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Products Tab Featured ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_products_tab_featured',
				'label' => esc_attr__( 'Featured Products?', 'bevesi-core' ),
				'section' => 'bevesi_header_product_tab_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_products_tab',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Products Tab Best Selling ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_products_tab_best_selling',
				'label' => esc_attr__( 'Best Selling Products?', 'bevesi-core' ),
				'section' => 'bevesi_header_product_tab_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_products_tab',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Products Tab Post count ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_header_products_tab_post_count',
				'label' => esc_attr__( 'Posts Count', 'bevesi-core' ),
				'section' => 'bevesi_header_product_tab_section',
				'default' => '6',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_products_tab',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Search Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_search',
				'label' => esc_attr__( 'Header Search', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the search on the header.', 'bevesi-core' ),
				'section' => 'bevesi_header_search_section',
				'default' => '0',
			)
		);
		
		/*====== Ajax Search Form ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_ajax_search_form',
				'label' => esc_attr__( 'Ajax Search Form', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable ajax search form for the header search.', 'bevesi-core' ),
				'section' => 'bevesi_header_search_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_search',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Notification Text Toggle======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_notification_toggle',
				'label' => esc_attr__( 'Header Notification', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the notification on the header.', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => '0',
			)
		);
		
		/*====== Header Notification Icon ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_header_notification_icon',
				'label' => esc_attr__( 'Header Notification Icon', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set an icon. for example; "klb-icon-chevron-right"', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => 'klb-icon-chevron-right',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_notification_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Notification Content ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_header_notification_content',
				'label' => esc_attr__( 'Header Notification Content', 'bevesi-core' ),
				'description' => esc_attr__( 'You can add a text for the notification content.', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => 'Your order is at your door in <strong>2 hours with fast shipping.</strong>',
				'required' => array(
					array(
					  'setting'  => 'bevesi_header_notification_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Notification Text Toggle======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_top_notification_toggle',
				'label' => esc_attr__( 'Top Notification', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the notification on the header.', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => '0',
			)
		);
		
		/*====== Top Notification Image======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_top_notification_image',
				'label' => esc_attr__( 'Image', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_top_notification_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Notification title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_top_notification_title',
				'label' => esc_attr__( 'Top Notification Title', 'bevesi-core' ),
				'description' => esc_attr__( 'You can add a text for the notification title.', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => 'FREE delivery & 40% Discount for next 3 orders! Place your 1st order in.',
				'required' => array(
					array(
					  'setting'  => 'bevesi_top_notification_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Notification Button ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_top_notification_button_title',
				'label' => esc_attr__( 'Top Notification Button Title', 'bevesi-core' ),
				'description' => esc_attr__( 'You can add a text for the notification button title.', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => 'Shop Now',
				'required' => array(
					array(
					  'setting'  => 'bevesi_top_notification_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Notification Button url ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_top_notification_button_url',
				'label' => esc_attr__( 'Top Notification Button Url', 'bevesi-core' ),
				'section' => 'bevesi_header_notification_section',
				'default' => '#',
				'required' => array(
					array(
					  'setting'  => 'bevesi_top_notification_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== PreLoader Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_preloader',
				'label' => esc_attr__( 'Enable Loader', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the loader.', 'bevesi-core' ),
				'section' => 'bevesi_header_preloader_section',
				'default' => '0',
			)
		);	
		
	/*====== Header 1 Style ================*/		
			
			/*====== Header 1 Top Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#FFFFFF',
					'settings' => 'bevesi_header1_top_bg_color',
					'label' => esc_attr__( 'Header Top Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);	
			
			/*====== Header 1 Top Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#64748b',
					'settings' => 'bevesi_header1_top_font_color',
					'label' => esc_attr__( 'Header Top Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header 1 Top Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#334155',
					'settings' => 'bevesi_header1_top_font_hvrcolor',
					'label' => esc_attr__( 'Header Top Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for hover color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header 1 Top Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header1_top_border_color',
					'label' => esc_attr__( 'Header Top Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 1 Main Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header1_main_bg_color',
					'label' => esc_attr__( 'Header Main Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header 1 Main Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header1_main_border_color',
					'label' => esc_attr__( 'Header Main Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 1 Main Icon Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000000',
					'settings' => 'bevesi_header1_main_icon_color',
					'label' => esc_attr__( 'Header Main Icon Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header 1 Bottom Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header1_bottom_bg_color',
					'label' => esc_attr__( 'Header Bottom Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header 1 Bottom Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header1_bottom_border_color',
					'label' => esc_attr__( 'Header Bottom Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header1 Bottom Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header1_bottom_font_color',
					'label' => esc_attr__( 'Header Bottom Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			
			/*====== Header1 Bottom Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header1_bottom_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header 1 Bottom Submenu Header Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header1_bottom_submenu_header_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Header Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header1 Bottom Submenu Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header1_bottom_submenu_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
			
			/*====== Header1 Bottom Submenu Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header1_bottom_submenu_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Submenu Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header1_style_section',
				)
			);
	
	/*====== Header 2 Style ================*/		
			
			/*====== Header 2 Top Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#FFFFFF',
					'settings' => 'bevesi_header2_top_bg_color',
					'label' => esc_attr__( 'Header Top Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);	
			
			/*====== Header 2 Top Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#64748b',
					'settings' => 'bevesi_header2_top_font_color',
					'label' => esc_attr__( 'Header Top Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Top Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#334155',
					'settings' => 'bevesi_header2_top_font_hvrcolor',
					'label' => esc_attr__( 'Header Top Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for hover color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Main Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header2_main_bg_color',
					'label' => esc_attr__( 'Header Main Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Main Icon Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000000',
					'settings' => 'bevesi_header2_main_icon_color',
					'label' => esc_attr__( 'Header Main Icon Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Bottom Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header2_bottom_bg_color',
					'label' => esc_attr__( 'Header Bottom Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Bottom Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header2_bottom_border_color',
					'label' => esc_attr__( 'Header Bottom Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 2 Bottom Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header2_bottom_font_color',
					'label' => esc_attr__( 'Header Bottom Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			
			/*====== Header 2 Bottom Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header2_bottom_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Bottom Submenu Header Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header2_bottom_submenu_header_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Header Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Bottom Submenu Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header2_bottom_submenu_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);
			
			/*====== Header 2 Bottom Submenu Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header2_bottom_submenu_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Submenu Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header2_style_section',
				)
			);		
	
	/*====== Header 3 Style ================*/		
			
			/*====== Header 3 Top Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#111827',
					'settings' => 'bevesi_header3_top_bg_color',
					'label' => esc_attr__( 'Header Top Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);	
			
			/*====== Header 3 Top Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header3_top_font_color',
					'label' => esc_attr__( 'Header Top Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Top Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#d1d5db',
					'settings' => 'bevesi_header3_top_font_hvrcolor',
					'label' => esc_attr__( 'Header Top Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for hover color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Top Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#374151',
					'settings' => 'bevesi_header3_top_border_color',
					'label' => esc_attr__( 'Header Top Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 3 Main Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#111827',
					'settings' => 'bevesi_header3_main_bg_color',
					'label' => esc_attr__( 'Header Main Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Main Icon Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header3_main_icon_color',
					'label' => esc_attr__( 'Header Main Icon Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Bottom Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header3_bottom_bg_color',
					'label' => esc_attr__( 'Header Bottom Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Bottom Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header3_bottom_border_color',
					'label' => esc_attr__( 'Header Bottom Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 3 Bottom Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header3_bottom_font_color',
					'label' => esc_attr__( 'Header Bottom Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			
			/*====== Header 3 Bottom Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header3_bottom_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Bottom Submenu Header Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header3_bottom_submenu_header_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Header Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Bottom Submenu Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header3_bottom_submenu_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);
			
			/*====== Header 3 Bottom Submenu Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header3_bottom_submenu_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Submenu Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header3_style_section',
				)
			);

	/*====== Header 4 Style ================*/		
			
			/*====== Header 4 Top Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(0, 113, 220, 1)',
					'settings' => 'bevesi_header4_top_bg_color',
					'label' => esc_attr__( 'Header Top Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);	
			
			/*====== Header 4 Top Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header4_top_font_color',
					'label' => esc_attr__( 'Header Top Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			/*====== Header 4 Top Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header4_top_font_hvrcolor',
					'label' => esc_attr__( 'Header Top Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for hover color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			/*====== Header 4 Top Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(255, 255, 255, 0.2)',
					'settings' => 'bevesi_header4_top_border_color',
					'label' => esc_attr__( 'Header Top Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 4 Main Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(0, 113, 220, 1)',
					'settings' => 'bevesi_header4_main_bg_color',
					'label' => esc_attr__( 'Header Main Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 4 Main Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(255, 255, 255, 0.2)',
					'settings' => 'bevesi_header4_main_border_color',
					'label' => esc_attr__( 'Header Main Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 4 Main Icon Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header4_main_icon_color',
					'label' => esc_attr__( 'Header Main Icon Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			/*====== Header 4 Bottom Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(0, 113, 220, 1)',
					'settings' => 'bevesi_header4_bottom_bg_color',
					'label' => esc_attr__( 'Header Bottom Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 4 Bottom Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(255, 255, 255, 0.2)',
					'settings' => 'bevesi_header4_bottom_border_color',
					'label' => esc_attr__( 'Header Bottom Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 4 Bottom Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header4_bottom_font_color',
					'label' => esc_attr__( 'Header Bottom Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			
			/*====== Header 4 Bottom Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header4_bottom_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			/*====== Header 4 Bottom Submenu Header Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header4_bottom_submenu_header_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Header Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			/*====== Header 4 Bottom Submenu Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#6b7280',
					'settings' => 'bevesi_header4_bottom_submenu_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);
			
			/*====== Header 4 Bottom Submenu Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#374151',
					'settings' => 'bevesi_header4_bottom_submenu_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Submenu Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header4_style_section',
				)
			);		

	/*====== Header 5 Style ================*/		
			
			/*====== Header 5 Top Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#FFFFFF',
					'settings' => 'bevesi_header5_top_bg_color',
					'label' => esc_attr__( 'Header Top Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);	
			
			/*====== Header 5 Top Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#64748b',
					'settings' => 'bevesi_header5_top_font_color',
					'label' => esc_attr__( 'Header Top Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Top Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#334155',
					'settings' => 'bevesi_header5_top_font_hvrcolor',
					'label' => esc_attr__( 'Header Top Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for hover color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Top Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header5_top_border_color',
					'label' => esc_attr__( 'Header Top Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 5 Main Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header5_main_bg_color',
					'label' => esc_attr__( 'Header Main Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Main Icon Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000000',
					'settings' => 'bevesi_header5_main_icon_color',
					'label' => esc_attr__( 'Header Main Icon Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Main Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header5_main_font_color',
					'label' => esc_attr__( 'Header Main Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			
			/*====== Header 5 Main Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header5_main_font_hvrcolor',
					'label' => esc_attr__( 'Header Main Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Main Submenu Header Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header5_main_submenu_header_font_color',
					'label' => esc_attr__( 'Header Main Submenu Header Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Main Submenu Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000000',
					'settings' => 'bevesi_header5_main_submenu_font_color',
					'label' => esc_attr__( 'Header Main Submenu Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Main Submenu Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#374151',
					'settings' => 'bevesi_header5_main_submenu_font_hvrcolor',
					'label' => esc_attr__( 'Header Main Submenu Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
				)
			);
			
			/*====== Header 5 Bottom Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(0, 113, 220, 1)',
					'settings' => 'bevesi_header5_bottom_bg_color',
					'label' => esc_attr__( 'Header Bottom Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== Header 5 Bottom Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => 'rgba(255, 255, 255, 0.2)',
					'settings' => 'bevesi_header5_bottom_border_color',
					'label' => esc_attr__( 'Header Bottom Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header5_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
	/*====== header 6 Style ================*/		
			
			/*====== header 6 Top Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#FFFFFF',
					'settings' => 'bevesi_header6_top_bg_color',
					'label' => esc_attr__( 'Header Top Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);	
			
			/*====== header 6 Top Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#64748b',
					'settings' => 'bevesi_header6_top_font_color',
					'label' => esc_attr__( 'Header Top Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Top Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#334155',
					'settings' => 'bevesi_header6_top_font_hvrcolor',
					'label' => esc_attr__( 'Header Top Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for hover color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Top Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header6_top_border_color',
					'label' => esc_attr__( 'Header Top Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== header 6 Main Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header6_main_bg_color',
					'label' => esc_attr__( 'Header Main Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Main Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header6_main_border_color',
					'label' => esc_attr__( 'Header Main Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== header 6 Main Icon Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000000',
					'settings' => 'bevesi_header6_main_icon_color',
					'label' => esc_attr__( 'Header Main Icon Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Bottom Background Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#fff',
					'settings' => 'bevesi_header6_bottom_bg_color',
					'label' => esc_attr__( 'Header Bottom Background Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  background.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Bottom Border Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#e5e7eb',
					'settings' => 'bevesi_header6_bottom_border_color',
					'label' => esc_attr__( 'Header Bottom Border Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
					'choices'     => [
						'alpha' => true,
					],
				)
			);
			
			/*====== header 6 Bottom Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header6_bottom_font_color',
					'label' => esc_attr__( 'Header Bottom Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			
			/*====== header 6 Bottom Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header6_bottom_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Bottom Submenu Header Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#9ca3af',
					'settings' => 'bevesi_header6_bottom_submenu_header_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Header Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Bottom Submenu Font Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header6_bottom_submenu_font_color',
					'label' => esc_attr__( 'Header Bottom Submenu Font Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);
			
			/*====== header 6 Bottom Submenu Font Hover Color ======*/
			bevesi_customizer_add_field (
				array(
					'type' => 'color',
					'default' => '#000',
					'settings' => 'bevesi_header6_bottom_submenu_font_hvrcolor',
					'label' => esc_attr__( 'Header Bottom Submenu Font Hover Color', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
					'section' => 'bevesi_header6_style_section',
				)
			);		

	/*====== Mobile Bottom Menu Style ========*/	
		
		/*====== Mobile Bottom Menu Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_mobile_bottom_menu_bg_color',
				'label' => esc_attr__( 'Mobile Bottom Menu Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
				'section' => 'bevesi_mobile_bottom_menu_style_section',
			)
		);
		
		/*====== Mobile Bottom Menu Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e5e7eb',
				'settings' => 'bevesi_mobile_bottom_menu_border_color',
				'label' => esc_attr__( 'Mobile Bottom Menu Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
				'section' => 'bevesi_mobile_bottom_menu_style_section',
			)
		);
		
		/*====== Mobile Bottom Menu Icon Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000000',
				'settings' => 'bevesi_mobile_bottom_menu_icon_color',
				'label' => esc_attr__( 'Mobile Bottom Menu Icon Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_mobile_bottom_menu_style_section',
			)
		);
		
		/*====== Mobile Bottom Menu Font Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#94a3b8',
				'settings' => 'bevesi_mobile_bottom_menu_font_color',
				'label' => esc_attr__( 'Mobile Bottom Menu Font Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_mobile_bottom_menu_style_section',
			)
		);		


	/*====== Header Top Notification Style ========*/	
		
		/*====== Top Notification Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(0, 113, 220, 1)',
				'settings' => 'bevesi_top_notification_bg_color',
				'label' => esc_attr__( 'Top Notification Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
				'section' => 'bevesi_top_notification_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Top Notification Font Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_top_notification_font_color',
				'label' => esc_attr__( 'Top Notification Font Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_top_notification_style_section',
			)
		);
		
		/*====== Top Notification Button Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_top_notification_button_color',
				'label' => esc_attr__( 'Top Notification Button Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_top_notification_style_section',
			)
		);
		
		/*====== Top Notification Button Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_top_notification_button_bg_color',
				'label' => esc_attr__( 'Top Notification Button Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for  background color.', 'bevesi-core' ),
				'section' => 'bevesi_top_notification_style_section',
			)
		);
		
			
			
	/*====== SHOP ====================================================================================*/
		/*====== Shop Panels ======*/
		Kirki::add_panel (
			'bevesi_shop_panel',
			array(
				'title' => esc_html__( 'Shop Settings', 'bevesi-core' ),
				'description' => esc_html__( 'You can customize the shop from this panel.', 'bevesi-core' ),
			)
		);

		$sections = array (
			'shop_general' => array(
				esc_attr__( 'General', 'bevesi-core' ),
				esc_attr__( 'You can customize shop settings.', 'bevesi-core' )
			),
			
			'shop_product_box' => array(
				esc_attr__( 'Product Box', 'bevesi-core' ),
				esc_attr__( 'You can customize the product box settings.', 'bevesi-core' )
			),
			
			'shop_single' => array(
				esc_attr__( 'Product Detail', 'bevesi-core' ),
				esc_attr__( 'You can customize the product single settings.', 'bevesi-core' )
			),
			
			'my_account' => array(
				esc_attr__( 'My Account', 'bevesi-core' ),
				esc_attr__( 'You can customize the my account page.', 'bevesi-core' )
			),

			'free_shipping_bar' => array(
				esc_attr__( 'Free Shipping Bar ', 'bevesi-core' ),
				esc_attr__( 'You can customize the free shipping bar settings.', 'bevesi-core' )
			),
			
			'wishlist' => array(
				esc_attr__( 'Wishlist', 'bevesi-core' ),
				esc_attr__( 'You can customize the wishlist settings.', 'bevesi-core' )
			),
			
			'compare' => array(
				esc_attr__( 'Compare', 'bevesi-core' ),
				esc_attr__( 'You can customize the compare settings.', 'bevesi-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bevesi_shop_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bevesi_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Shop Layouts ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bevesi_shop_layout',
				'label' => esc_attr__( 'Layout', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose a layout for the shop.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => 'left-sidebar',
				'choices' => array(
					'left-sidebar' => esc_attr__( 'Left Sidebar', 'bevesi-core' ),
					'full-width' => esc_attr__( 'Full Width', 'bevesi-core' ),
					'right-sidebar' => esc_attr__( 'Right Sidebar', 'bevesi-core' ),
				),
			)
		);

		/*====== Shop Width ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bevesi_shop_width',
				'label' => esc_attr__( 'Shop Page Width', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose a layout for the shop page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => 'boxed',
				'choices' => array(
					'boxed' => esc_attr__( 'Boxed', 'bevesi-core' ),
					'wide' => esc_attr__( 'Wide', 'bevesi-core' ),
				),
			)
		);

		bevesi_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bevesi_paginate_type',
			'label'       => esc_html__( 'Pagination Type', 'bevesi-core' ),
			'section'     => 'bevesi_shop_general_section',
			'default'     => 'default',
			'priority'    => 10,
			'choices'     => array(
				'default' => esc_attr__( 'Default', 'bevesi-core' ),
				'loadmore' => esc_attr__( 'Load More', 'bevesi-core' ),
				'infinite' => esc_attr__( 'Infinite', 'bevesi-core' ),
			),
			) 
		);

		/*====== Ajax on Shop Page ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_ajax_on_shop',
				'label' => esc_attr__( 'Ajax on Shop Page', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Ajax for the shop page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Grid-List Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_grid_list_view',
				'label' => esc_attr__( 'Grid List View', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable grid list view on shop page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Atrribute Swatches ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_attribute_swatches',
				'label' => esc_attr__( 'Attribute Swatches', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the attribute types (Color - Button - Images).', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Perpage Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_perpage_view',
				'label' => esc_attr__( 'Perpage View', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable perpage view on shop page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Atrribute Swatches ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_attribute_swatches',
				'label' => esc_attr__( 'Attribute Swatches', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the attribute types (Color - Button - Images).', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Ajax Notice Shop ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_notice_ajax_addtocart',
				'label' => esc_attr__( 'Added to Cart Ajax Notice', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the ajax notice feature.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Product Badge Tab ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_badge_tab',
				'label' => esc_attr__( 'Product Badge Tab', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the product badge tab.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Remove All Button ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_remove_all_button',
				'label' => esc_attr__( 'Remove All Button in cart page', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the remove all button.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Mobile Bottom Menu======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_mobile_bottom_menu',
				'label' => esc_attr__( 'Mobile Bottom Menu', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the bottom menu on mobile.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Mobile Bottom Menu Edit Toggle======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_mobile_bottom_menu_edit_toggle',
				'label' => esc_attr__( 'Mobile Bottom Menu Edit', 'bevesi-core' ),
				'description' => esc_attr__( 'Edit the mobile bottom menu.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_mobile_bottom_menu',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
				
			)
			
		);
		
		/*====== Mobile Menu Repeater ======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_mobile_bottom_menu_edit',
				'label' => esc_attr__( 'Mobile Bottom Menu Edit', 'bevesi-core' ),
				'description' => esc_attr__( 'Edit the mobile bottom menu.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'required' => array(
					array(
					  'setting'  => 'bevesi_mobile_bottom_menu_edit_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
				'fields' => array(
					'mobile_menu_type' => array(
						'type' => 'select',
						'label' => esc_attr__( 'Select Type', 'bevesi-core' ),
						'description' => esc_attr__( 'You can select a type', 'bevesi-core' ),
						'default' => 'default',
						'choices' => array(
							'default' => esc_attr__( 'Default', 'bevesi-core' ),
							'search' => esc_attr__( 'Search', 'bevesi-core' ),
							'filter' => esc_attr__( 'Filter', 'bevesi-core' ),
							'category' => esc_attr__( 'category', 'bevesi-core' ),
						),
					),
				
					'mobile_menu_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "store"', 'bevesi-core' ),
					),
					'mobile_menu_text' => array(
						'type' => 'text',
						'label' => esc_attr__( ' Text', 'bevesi-core' ),
						'description' => esc_attr__( 'You can enter a text.', 'bevesi-core' ),
					),
					'mobile_menu_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bevesi-core' ),
					),
				),
				
			)
		);

		/*====== Product Stock Quantity ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_stock_quantity',
				'label' => esc_attr__( 'Show Stock Quantity', 'bevesi-core' ),
				'description' => esc_attr__( 'Show stock quantity on the label.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Product Min/Max Quantity ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_min_max_quantity',
				'label' => esc_attr__( 'Min/Max Quantity', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable the additional quantity setting fields in product detail page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Category Description ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_category_description_after_content',
				'label' => esc_attr__( 'Category Desc After Content', 'bevesi-core' ),
				'description' => esc_attr__( 'Add the category description after the products.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Catalog Mode - Disable Add to Cart ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_catalog_mode',
				'label' => esc_attr__( 'Catalog Mode', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable Add to Cart button on the shop page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);	

		/*====== Recently Viewed Products ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_recently_viewed_products',
				'label' => esc_attr__( 'Recently Viewed Products', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Recently Viewed Products.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Recently Viewed Products Coulmn ======*/
		bevesi_customizer_add_field(
			array (
				'type'        => 'radio-buttonset',
				'settings'    => 'bevesi_recently_viewed_products_column',
				'label'       => esc_html__( 'Recently Viewed Products Column', 'bevesi-core' ),
				'section'     => 'bevesi_shop_general_section',
				'default'     => '4',
				'priority'    => 10,
				'choices'     => array(
					'6' => esc_attr__( '6', 'bevesi-core' ),
					'5' => esc_attr__( '5', 'bevesi-core' ),
					'4' => esc_attr__( '4', 'bevesi-core' ),
					'3' => esc_attr__( '3', 'bevesi-core' ),
					'2' => esc_attr__( '2', 'bevesi-core' ),
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_recently_viewed_products',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			) 
		);

		/*====== Min Order Amount ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_min_order_amount_toggle',
				'label' => esc_attr__( 'Min Order Amount', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable Min Order Amount.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Min Order Amount Value ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_min_order_amount_value',
				'label' => esc_attr__( 'Min Order Value', 'bevesi-core' ),
				'description' => esc_attr__( 'Set amount to specify a minimum order value.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bevesi_min_order_amount_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== Product Image Size ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'dimensions',
				'settings' => 'bevesi_product_image_size',
				'label' => esc_attr__( 'Product Image Size', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set size of the product image for the shop page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_general_section',
				'default' => array(
					'width' => '',
					'height' => '',
				),
			)
		);
		
		/*====== Product Box Type ======*/
		bevesi_customizer_add_field(
			array (
				'type'        => 'select',
				'settings'    => 'bevesi_product_box_type',
				'label'       => esc_html__( 'Shop Product Box Type', 'bevesi-core' ),
				'section'     => 'bevesi_shop_product_box_section',
				'default'     => 'type1',
				'priority'    => 10,
				'choices'     => array(
					'type1' => esc_attr__( 'Type 1', 'bevesi-core' ),
					'type2' => esc_attr__( 'Type 2', 'bevesi-core' ),
					'type3' => esc_attr__( 'Type 3', 'bevesi-core' ),
					'type4' => esc_attr__( 'Type 4', 'bevesi-core' ),
					'type5' => esc_attr__( 'Type 5', 'bevesi-core' ),
					'type6' => esc_attr__( 'Type 6', 'bevesi-core' ),
				),
			) 
		);
		
		/*====== Product Box Gallery Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_box_gallery',
				'label' => esc_attr__( 'Product Gallery', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable gallery on the product box.', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
			)
		);

		/*====== Quick View Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_quick_view_button',
				'label' => esc_attr__( 'Quick View Button', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the quick view button.', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
			)
		);
		
		/*====== Shipping Class  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_box_shipping_class',
				'label' => esc_attr__( 'Shipping Classes', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable or Disable the shipping class on the product box', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
			)
		);
		
		/*====== Product Box Type ======*/
		bevesi_customizer_add_field(
			array (
				'type'        => 'radio-buttonset',
				'settings'    => 'bevesi_product_box_shipping_class_type',
				'label'       => esc_html__( 'Shipping Class Type', 'bevesi-core' ),
				'section'     => 'bevesi_shop_product_box_section',
				'default'     => 'default',
				'priority'    => 10,
				'choices'     => array(
					'default' => esc_attr__( 'Default', 'bevesi-core' ),
					'bordered' => esc_attr__( 'Bordered', 'bevesi-core' ),
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_product_box_shipping_class',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			) 
		);
		
		/*====== Stock Status  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_box_stock_status',
				'label' => esc_attr__( 'Stock Status', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable or Disable the stock statu on the product box', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
			)
		);
		
		/*====== Poor Stock Status  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_box_poor_stock',
				'label' => esc_attr__( 'Poor Stock', 'bevesi-core' ),
				'description' => esc_attr__( 'Show quantity remaining in stock when low e.g. "Only 9 left in stock"', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_product_box_stock_status',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Stock Progress Bar  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_box_stock_progress_bar',
				'label' => esc_attr__( 'Stock Progress Bar', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable or Disable the stock progress bar on the product box', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
			)
		);
		
		/*====== Countdown  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_product_box_countdown',
				'label' => esc_attr__( 'Countdown', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable or Disable the countdown on the product box', 'bevesi-core' ),
				'section' => 'bevesi_shop_product_box_section',
				'default' => '0',
			)
		);
		
		/*====== Shop Single Gallery Type ======*/
		bevesi_customizer_add_field(
			array (
				'type'        => 'radio-buttonset',
				'settings'    => 'bevesi_single_gallery_type',
				'label'       => esc_html__( 'Gallery Type (Product Detail)', 'bevesi-core' ),
				'section'     => 'bevesi_shop_single_section',
				'default'     => 'horizontal',
				'priority'    => 10,
				'choices'     => array(
					'horizontal' => esc_attr__( 'Horizontal', 'bevesi-core' ),
					'vertical' => esc_attr__( 'Vertical', 'bevesi-core' ),
				),
			) 
		);
		
		/*====== Shop Single Type ======*/
		bevesi_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bevesi_single_type',
			'label'       => esc_html__( 'Type (Product Detail)', 'bevesi-core' ),
			'section'     => 'bevesi_shop_single_section',
			'default'     => 'type1',
			'priority'    => 10,
			'choices'     => array(
				'type1' => esc_attr__( 'Type 1', 'bevesi-core' ),
				'type2' => esc_attr__( 'Type 2', 'bevesi-core' ),
			),
			) 
		);
		
		/*====== Shop Single Full width ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_single_full_width',
				'label' => esc_attr__( 'Full Width', 'bevesi-core' ),
				'description' => esc_attr__( 'Stretch the single product page content.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Image Zoom  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_single_image_zoom',
				'label' => esc_attr__( 'Image Zoom', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the zoom feature.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Comment by Rating ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_comment_rating',
				'label' => esc_attr__( 'Comment Rating', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the review slot.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Product360 View ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_single_product360',
				'label' => esc_attr__( 'Product360 View', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Product 360 View.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Ajax Add To Cart ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_single_ajax_addtocart',
				'label' => esc_attr__( 'Ajax Add to Cart', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable ajax add to cart button.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);
		
		/*======  Sticky Single Cart ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_single_sticky_cart',
				'label' => esc_attr__( 'Sticky Add to Cart', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable sticky cart button.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Single Sticky Titles ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_single_sticky_titles',
				'label' => esc_attr__( 'Sticky Titles', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the sticky titles for desktop.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Mobile Sticky Single Cart ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_mobile_single_sticky_cart',
				'label' => esc_attr__( 'Mobile Sticky Add to Cart', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable sticky cart button on mobile.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Buy Now Single ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_single_buy_now',
				'label' => esc_attr__( 'Buy Now Button', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable Buy Now button.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Related By Tags ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_related_by_tags',
				'label' => esc_attr__( 'Related Products with Tags', 'bevesi-core' ),
				'description' => esc_attr__( 'Display the related products by tags.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Order on WhatsApp ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_single_orderonwhatsapp',
				'label' => esc_attr__( 'Order on WhatsApp', 'bevesi-core' ),
				'description' => esc_attr__( 'Enable the button on the product detail page.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Order on WhatsApp Number======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_shop_single_whatsapp_number',
				'label' => esc_attr__( 'WhatsApp Number', 'bevesi-core' ),
				'description' => esc_attr__( 'You can add a phone number for order on WhatsApp.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bevesi_shop_single_orderonwhatsapp',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Move Review Tab ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_single_review_tab_move',
				'label' => esc_attr__( 'Move Review Tab', 'bevesi-core' ),
				'description' => esc_attr__( 'Move the review tab out of tabs', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Product Related Post Column ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_shop_related_post_column',
				'label' => esc_attr__( 'Related Post Column', 'bevesi-core' ),
				'description' => esc_attr__( 'You can control related post column with this option.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '4',
				'choices' => array(
					'6' => esc_attr__( '6 Columns', 'bevesi-core' ),
					'5' => esc_attr__( '5 Columns', 'bevesi-core' ),
					'4' => esc_attr__( '4 Columns', 'bevesi-core' ),
					'3' => esc_attr__( '3 Columns', 'bevesi-core' ),
					'2' => esc_attr__( '2 Columns', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Re-Order Product Detail ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'sortable',
				'settings' => 'bevesi_shop_single_reorder',
				'label' => esc_attr__( 'Re-order Product Summary', 'bevesi-core' ),
				'description' => esc_attr__( 'Please save the changes and refresh the page once. Live preview is not available for the option.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default'     => [
					'bevesi_single_product_brand',
					'woocommerce_template_single_title',
					'woocommerce_template_single_rating',
					'woocommerce_template_single_price',
					'woocommerce_template_single_excerpt',
					'woocommerce_template_single_add_to_cart',
					'woocommerce_template_single_meta',
					'bevesi_single_product_checklist',
					'bevesi_social_share',
				],
				'choices'     => [
					'bevesi_single_product_brand' 				=> esc_html__( 'Category', 		'bevesi-core' ),
					'woocommerce_template_single_title' 		=> esc_html__( 'Title',  		'bevesi-core' ),
					'woocommerce_template_single_rating' 		=> esc_html__( 'Rating', 		'bevesi-core' ),
					'woocommerce_template_single_price' 		=> esc_html__( 'Price', 		'bevesi-core' ),
					'woocommerce_template_single_excerpt' 		=> esc_html__( 'Excerpt', 		'bevesi-core' ),
					'woocommerce_template_single_add_to_cart' 	=> esc_html__( 'Add to Cart', 	'bevesi-core' ),
					'woocommerce_template_single_meta'			=> esc_html__( 'Meta', 			'bevesi-core' ),
					'bevesi_single_product_checklist' 			=> esc_html__( 'Checklist', 	'bevesi-core' ),
					'bevesi_social_share'					    => esc_html__( 'Share', 		'bevesi-core' ),
					'bevesi_product_stock_progress_bar' 		=> esc_html__( 'Progress Bar', 	'bevesi-core' ),
					'bevesi_product_time_countdown'			    => esc_html__( 'Time Countdown', 'bevesi-core' ),
					
				],
			)
		);
		
		/*====== Shop Single Checklist ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_single_checklist',
				'label' => esc_attr__( 'Checklist', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable the featured list.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Shop Single Checklist ======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_single_products_checklist',
				'label' => esc_attr__( 'Product Checklist', 'bevesi-core' ),
				'description' => esc_attr__( 'You can create the checklist list.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'row_label' => array (
					'type' => 'field',
					'field' => 'link_text',
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_single_checklist',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
				'fields' => array(
					'checklist_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "klb-icon-truck"', 'bevesi-core' ),
					),
					
					'checklist_title' => array(
						'type' => 'textarea',
						'label' => esc_attr__( 'Title', 'bevesi-core' ),
						'description' => esc_attr__( 'You can enter a title.', 'bevesi-core' ),
					),
				),
			)
		);
		
		/*====== Shop Single Social Share ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_shop_social_share',
				'priority'    => 15,
				'label' => esc_attr__( 'Social Share (Product Detail)', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable social share buttons.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Social Share ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'multicheck',
				'settings'    => 'bevesi_shop_single_share',
				'section'     => 'bevesi_shop_single_section',
				'priority'    => 16,
				'default'     => array('facebook','twitter', 'pinterest', 'linkedin', 'whatsapp'),
				'choices'     => [
					'facebook'  => esc_html__( 'Facebook', 	'bevesi-core' ),
					'twitter' 	=> esc_html__( 'Twitter', 	'bevesi-core' ),
					'pinterest' => esc_html__( 'Pinterest', 'bevesi-core' ),
					'linkedin'  => esc_html__( 'Linkedin', 	'bevesi-core' ),
					'whatsapp'  => esc_html__( 'WhatsApp', 	'bevesi-core' ),
				],
				'required' => array(
					array(
					  'setting'  => 'bevesi_shop_social_share',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Banner Repeater For each category ======*/
		add_action( 'init', function() {
			new \Kirki\Field\Repeater(
				array(
					'settings' => 'bevesi_shop_banner_each_category',
					'label' => esc_attr__( 'Banner For Categories', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set banner for each category.', 'bevesi-core' ),
					'section' => 'bevesi_shop_banner_section',
					'fields' => array(
						
						'category_id' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Select Category', 'bevesi-core' ),
							'description' => esc_html__( 'Set a category', 'bevesi-core' ),
							'priority'    => 10,
							'choices'     => Kirki_Helper::get_terms( array('taxonomy' => 'product_cat') )
						),
						
						'category_image' =>  array(
							'type' => 'image',
							'label' => esc_attr__( 'Image', 'bevesi-core' ),
							'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
						),
						
						'category_title' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set Title', 'bevesi-core' ),
							'description' => esc_attr__( 'You can set a title.', 'bevesi-core' ),
						),
						
						'category_subtitle' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set Subtitle', 'bevesi-core' ),
							'description' => esc_attr__( 'You can set a subtitle.', 'bevesi-core' ),
						),
						
						'category_desc' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set Description', 'bevesi-core' ),
							'description' => esc_attr__( 'You can set a description.', 'bevesi-core' ),
						),
						
						'category_button_title' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set button title', 'bevesi-core' ),
							'description' => esc_attr__( 'You can set a description.', 'bevesi-core' ),
						),
						
						
						'category_button_url' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set URL', 'bevesi-core' ),
							'description' => esc_attr__( 'Set an url for the button', 'bevesi-core' ),
						),
					),
				)
			);
		} );
		
		/*====== My Account Layouts ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bevesi_my_account_layout',
				'label' => esc_attr__( 'Layout', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose a layout for the login form.', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => 'default',
				'choices' => array(
					'default' => esc_attr__( 'Default', 'bevesi-core' ),
					'logintab' => esc_attr__( 'Login Tab', 'bevesi-core' ),
				),
			)
		);

		/*====== Registration Form First Name ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_registration_first_name',
				'label' => esc_attr__( 'Register - First Name', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bevesi-core' ),
					'visible' => esc_attr__( 'Visible', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Registration Form Last Name ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_registration_last_name',
				'label' => esc_attr__( 'Register - Last Name', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bevesi-core' ),
					'visible' => esc_attr__( 'Visible', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Registration Form Billing Company ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_registration_billing_company',
				'label' => esc_attr__( 'Register - Billing Company', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bevesi-core' ),
					'visible' => esc_attr__( 'Visible', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Registration Form Billing Phone ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_registration_billing_phone',
				'label' => esc_attr__( 'Register - Billing Phone', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bevesi-core' ),
					'visible' => esc_attr__( 'Visible', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Ajax Login-Register ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_ajax_login_form',
				'label' => esc_attr__( 'Activate Ajax for Login Form', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => '0',
			)
		);

		/*====== Redirect URL After Login ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'url',
				'settings' => 'bevesi_redirect_url_after_login',
				'label' => esc_attr__( 'Redirect URL After Login', 'bevesi-core' ),
				'section' => 'bevesi_my_account_section',
				'default' => '',
			)
		);
		
	/*====== Free Shipping Settings =======================================================*/
	
		/*====== Free Shipping ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_free_shipping',
				'label' => esc_attr__( 'Free shipping bar', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => '0',
			)
		);
		
		/*====== Free Shipping Goal Amount ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shipping_progress_bar_amount',
				'label' => esc_attr__( 'Goal Amount', 'bevesi-core' ),
				'description' => esc_attr__( 'Amount to reach 100% defined in your currency absolute value. For example: 300', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => '100',
				'required' => array(
					array(
					  'setting'  => 'bevesi_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Location Cart Page ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shipping_progress_bar_location_card_page',
				'label' => esc_attr__( 'Cart page', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Location Mini cart ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shipping_progress_bar_location_mini_cart',
				'label' => esc_attr__( 'Mini cart', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Location Checkout page ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shipping_progress_bar_location_checkout',
				'label' => esc_attr__( 'Checkout page', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Message Initial ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'shipping_progress_bar_message_initial',
				'label' => esc_attr__( 'Initial Message', 'bevesi-core' ),
				'description' => esc_attr__( 'Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => 'Add [remainder] to cart and get free shipping!',
				'required' => array(
					array(
					  'setting'  => 'bevesi_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Message Success ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'shipping_progress_bar_message_success',
				'label' => esc_attr__( 'Success message', 'bevesi-core' ),
				'description' => esc_attr__( 'Message to show after reaching 100%.', 'bevesi-core' ),
				'section' => 'bevesi_free_shipping_bar_section',
				'default' => 'Your order qualifies for free shipping!',
				'required' => array(
					array(
					  'setting'  => 'bevesi_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
	/*====== Wishlist Settings =======================================================*/
		
		/*====== Wishlist Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_wishlist_button',
				'label' => esc_attr__( 'Custom Wishlist Button', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of the wishlist button.', 'bevesi-core' ),
				'section' => 'bevesi_wishlist_section',
				'default' => '0',
			)
		);
		
		/*====== Wishlist Page ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_wishlist_page',
				'label' => esc_attr__( 'Select a Wishlist Page', 'bevesi-core' ),
				'description' => esc_attr__( 'You can select a wishlist page. [klbwl_list]', 'bevesi-core' ),
				'section' => 'bevesi_wishlist_section',
				'default' => '',
				'choices'     => Kirki\Util\Helper::get_posts(
					array(
						'posts_per_page' => 30,
						'post_type'      => 'page'
					) ,
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_wishlist_button',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Wishlist  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_wishlist',
				'label' => esc_attr__( 'Wishlist', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable wishlist on the header.', 'bevesi-core' ),
				'section' => 'bevesi_wishlist_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_wishlist_button',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
	/*====== Compare Settings =======================================================*/
	
		/*====== Shop Compare Toggle  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_compare_button',
				'label' => esc_attr__( 'Compare on Shop', 'bevesi-core' ),
				'description' => esc_attr__( 'Activate the compare button on the shop page.', 'bevesi-core' ),
				'section' => 'bevesi_compare_section',
				'default' => '0',
			)
		);
		
		/*====== Compare Page ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_compare_page',
				'label' => esc_attr__( 'Select a Compare Page', 'bevesi-core' ),
				'description' => esc_attr__( 'You can select a compare page. [klbcp_list]', 'bevesi-core' ),
				'section' => 'bevesi_compare_section',
				'default' => '',
				'choices'     => Kirki\Util\Helper::get_posts(
					array(
						'posts_per_page' => 30,
						'post_type'      => 'page'
					) ,
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_compare_button',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Compare  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_header_compare',
				'label' => esc_attr__( 'Compare on Header', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable compare on the header.', 'bevesi-core' ),
				'section' => 'bevesi_compare_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bevesi_compare_button',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		

		
	/*====== Shop Single Style Settings =======================================================*/
		
		/*====== Shop Single Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_shop_single_bg_color',
				'label' => esc_attr__( 'Shop Single Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Image Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#212529',
				'settings' => 'bevesi_shop_single_image_border_color',
				'label' => esc_attr__( 'Shop Single Image Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);	
		
		/*====== Shop Single Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#212529',
				'settings' => 'bevesi_shop_single_title_color',
				'label' => esc_attr__( 'Shop Single Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Stock Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#E6FCF5',
				'settings' => 'bevesi_shop_single_stock_bg_color',
				'label' => esc_attr__( 'Shop Single Stock Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Stock Text Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#099268',
				'settings' => 'bevesi_shop_single_stock_text_color',
				'label' => esc_attr__( 'Shop Single Stock Text Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Out Of Stock Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#FFF5F5',
				'settings' => 'bevesi_shop_single_out_of_stock_bg_color',
				'label' => esc_attr__( 'Shop Single Out Of Stock Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Out Of Stock Text Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#C92A2A',
				'settings' => 'bevesi_shop_single_out_of_stock_text_color',
				'label' => esc_attr__( 'Shop Single Out Of Stock Text Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Regular Price Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#868E96',
				'settings' => 'bevesi_shop_single_regular_price_color',
				'label' => esc_attr__( 'Shop Single Regular Price Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Sale Price Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f03e3e',
				'settings' => 'bevesi_shop_single_sale_price_color',
				'label' => esc_attr__( 'Shop Single Sale Price Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Description Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#868E96',
				'settings' => 'bevesi_shop_single_desc_color',
				'label' => esc_attr__( 'Shop Single Description Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Button Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#12B886',
				'settings' => 'bevesi_shop_single_button_bg_color',
				'label' => esc_attr__( 'Shop Single Button Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Button Background Hover Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#099268',
				'settings' => 'bevesi_shop_single_button_bg_hvrcolor',
				'label' => esc_attr__( 'Shop Single Button Background Hover Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Button Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#12B886',
				'settings' => 'bevesi_shop_single_button_border_color',
				'label' => esc_attr__( 'Shop Single Button border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Button Border Hover Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#099268',
				'settings' => 'bevesi_shop_single_button_border_hvrcolor',
				'label' => esc_attr__( 'Shop Single Button border Hover Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Button Text Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_shop_single_button_text_color',
				'label' => esc_attr__( 'Shop Single Button Text Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Button Text Hover Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_shop_single_button_text_hvrcolor',
				'label' => esc_attr__( 'Shop Single Button Text Hover Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#212529',
				'settings' => 'bevesi_shop_single_wishlist_title_color',
				'label' => esc_attr__( 'Shop Single Wishlist Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Icon Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_shop_single_wishlist_title_icon_bg_color',
				'label' => esc_attr__( 'Shop Single Wishlist Icon Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Icon Background Hover Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#FFF5F5',
				'settings' => 'bevesi_shop_single_wishlist_title_icon_bg_hvrcolor',
				'label' => esc_attr__( 'Shop Single Wishlist Icon Background Hover Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Icon Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#DEE2E6',
				'settings' => 'bevesi_shop_single_wishlist_title_icon_border_color',
				'label' => esc_attr__( 'Shop Single Wishlist Icon Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Icon Border Hover Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#00000000',
				'settings' => 'bevesi_shop_single_wishlist_title_icon_border_hvrcolor',
				'label' => esc_attr__( 'Shop Single Wishlist Icon Border Hover Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Icon Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#212529',
				'settings' => 'bevesi_shop_single_wishlist_title_icon_color',
				'label' => esc_attr__( 'Shop Single Wishlist Icon Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Wishlist Icon Hover Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f03e3e',
				'settings' => 'bevesi_shop_single_wishlist_title_icon_hvrcolor',
				'label' => esc_attr__( 'Shop Single Wishlist Icon Hover Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Meta Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#868E96',
				'settings' => 'bevesi_shop_single_meta_title_color',
				'label' => esc_attr__( 'Shop Single Meta Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Meta Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#212529',
				'settings' => 'bevesi_shop_single_meta_subtitle_color',
				'label' => esc_attr__( 'Shop Single Meta Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);
		
		/*====== Shop Single Module Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#212529',
				'settings' => 'bevesi_shop_single_module_title_color',
				'label' => esc_attr__( 'Shop Single Module Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_shop_single_style_section',
			)
		);


	/*====== Blog Settings =======================================================*/
		/*====== Layouts ======*/
		
		bevesi_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bevesi_blog_layout',
				'label' => esc_attr__( 'Layout', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose a layout.', 'bevesi-core' ),
				'section' => 'bevesi_blog_settings_section',
				'default' => 'right-sidebar',
				'choices' => array(
					'left-sidebar' => esc_attr__( 'Left Sidebar', 'bevesi-core' ),
					'full-width' => esc_attr__( 'Full Width', 'bevesi-core' ),
					'right-sidebar' => esc_attr__( 'Right Sidebar', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Breadcrumb Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_blog_breadcrumb',
				'label' => esc_attr__( 'Breadcrumb', 'bevesi' ),
				'description' => esc_attr__( 'Disable or Enable breadcrumb on blog pages.', 'bevesi' ),
				'section' => 'bevesi_blog_settings_section',
				'default' => '0',
			)
		);
		
		/*====== Breadcrumb Text ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_blog_breadcrumb_title',
				'label' => esc_attr__( 'Breadcrumb Title', 'bevesi' ),
				'description' => esc_attr__( 'You can set a title for the breadcrumb..', 'bevesi' ),
				'section' => 'bevesi_blog_settings_section',
				'default' => 'Our News',
				'required' => array(
					array(
					  'setting'  => 'bevesi_blog_breadcrumb',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Breadcrumb Desc ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_blog_breadcrumb_desc',
				'label' => esc_attr__( 'Breadcrumb Desc', 'bevesi' ),
				'description' => esc_attr__( 'You can set a description for the breadcrumb..', 'bevesi' ),
				'section' => 'bevesi_blog_settings_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bevesi_blog_breadcrumb',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Main color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(0, 113, 220, 0.1)',
				'settings' => 'bevesi_main_color',
				'label' => esc_attr__( 'Main Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can customize the main color.', 'bevesi-core' ),
				'section' => 'bevesi_main_color_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*======  Secondary Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(250, 204, 21, 0.1)',
				'settings' => 'bevesi_secondary_color',
				'label' => esc_attr__( 'Secondary Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can customize the secondary color.', 'bevesi-core' ),
				'section' => 'bevesi_main_color_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
	/*====== Elementor Templates =======================================================*/
		/*====== Before Shop Elementor Templates ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bevesi_before_main_shop_elementor_template',
				'label'       => esc_html__( 'Before Shop Elementor Template', 'bevesi-core' ),
				'section'     => 'bevesi_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates ', 'bevesi-core' ),
				'choices'     => bevesi_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== After Shop Elementor Templates ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bevesi_after_main_shop_elementor_template',
				'label'       => esc_html__( 'After Shop Elementor Template', 'bevesi-core' ),
				'section'     => 'bevesi_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates ', 'bevesi-core' ),
				'choices'     => bevesi_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== Before Header Elementor Templates ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bevesi_before_main_header_elementor_template',
				'label'       => esc_html__( 'Before Header Elementor Template', 'bevesi-core' ),
				'section'     => 'bevesi_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bevesi-core' ),
				'choices'     => bevesi_get_elementorTemplates('section'),
				
			)
		);
	
		/*====== After Header Elementor Templates ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bevesi_after_main_header_elementor_template',
				'label'       => esc_html__( 'After Header Elementor Template', 'bevesi-core' ),
				'section'     => 'bevesi_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates ', 'bevesi-core' ),
				'choices'     => bevesi_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== Before Footer Elementor Template ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bevesi_before_main_footer_elementor_template',
				'label'       => esc_html__( 'Before Footer Elementor Template', 'bevesi-core' ),
				'section'     => 'bevesi_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bevesi-core' ),
				'choices'     => bevesi_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== After Footer Elementor  Template ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bevesi_after_main_footer_elementor_template',
				'label'       => esc_html__( 'After Footer Elementor Templates', 'bevesi-core' ),
				'section'     => 'bevesi_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bevesi-core' ),
				'choices'     => bevesi_get_elementorTemplates('section'),
				
			)
		);

		/*====== Templates Repeater For each category ======*/
		add_action( 'init', function() {
			new \Kirki\Field\Repeater(
				array(
					'settings' => 'bevesi_elementor_template_each_shop_category',
					'label' => esc_attr__( 'Template For Categories', 'bevesi-core' ),
					'description' => esc_attr__( 'You can set template for each category.', 'bevesi-core' ),
					'section' => 'bevesi_elementor_templates_section',
					'fields' => array(
						
						'category_id' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Select Category', 'bevesi-core' ),
							'description' => esc_html__( 'Set a category', 'bevesi-core' ),
							'priority'    => 10,
							'default'     => '',
							'choices'     => Kirki_Helper::get_terms( array('taxonomy' => 'product_cat') )
						),
						
						'bevesi_before_main_shop_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Before Shop Elementor Template', 'bevesi-core' ),
							'choices'     => bevesi_get_elementorTemplates('section'),
							'default'     => '',
							'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bevesi-core' ),
						),
						
						'bevesi_after_main_shop_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'After Shop Elementor Template', 'bevesi-core' ),
							'choices'     => bevesi_get_elementorTemplates('section'),
						),
						
						'bevesi_before_main_header_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Before Header Elementor Template', 'bevesi-core' ),
							'choices'     => bevesi_get_elementorTemplates('section'),
						),
						
						'bevesi_after_main_header_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'After Header Elementor Template', 'bevesi-core' ),
							'choices'     => bevesi_get_elementorTemplates('section'),
						),
						
						'bevesi_before_main_footer_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Before Footer Elementor Template', 'bevesi-core' ),
							'choices'     => bevesi_get_elementorTemplates('section'),
						),
						
						'bevesi_after_main_footer_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'After Footer Elementor Template', 'bevesi-core' ),
							'choices'     => bevesi_get_elementorTemplates('section'),
						),
						

					),
				)
			);
		} );


		/*====== Map Settings ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_mapapi',
				'label' => esc_attr__( 'Google Map Api key', 'bevesi-core' ),
				'description' => esc_attr__( 'Add your google map api key', 'bevesi-core' ),
				'section' => 'bevesi_map_settings_section',
				'default' => '',
			)
		);
		
	/*====== Bevesi Widgets ======*/
		/*====== Widgets Panels ======*/
		Kirki::add_panel (
			'bevesi_widgets_panel',
			array(
				'title' => esc_html__( 'Bevesi Widgets', 'bevesi-core' ),
				'description' => esc_html__( 'You can customize the bevesi widgets.', 'bevesi-core' ),
			)
		);

		$sections = array (
			
			'social_media' => array(
				esc_attr__( 'Social Media', 'bevesi-core' ),
				esc_attr__( 'You can customize the social media widget.', 'bevesi-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bevesi_widgets_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bevesi_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}

		/*====== Social Media Widget ======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_social_media_widget',
				'label' => esc_attr__( 'Social Media Widget', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set social icons.', 'bevesi-core' ),
				'section' => 'bevesi_social_media_section',
				'fields' => array(
					'social_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "facebook"', 'bevesi-core' ),
					),

					'social_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bevesi-core' ),
					),

				),
			)
		);
		
	
		
	/*====== Footer ======*/
		/*====== Footer Panels ======*/
		Kirki::add_panel (
			'bevesi_footer_panel',
			array(
				'title' => esc_html__( 'Footer Settings', 'bevesi-core' ),
				'description' => esc_html__( 'You can customize the footer from this panel.', 'bevesi-core' ),
			)
		);

		$sections = array (
			'footer_icon_box' => array(
				esc_attr__( 'Icon Box', 'bevesi-core' ),
				esc_attr__( 'You can customize the icon box.', 'bevesi-core' )
			),
			
			'footer_subscribe' => array(
				esc_attr__( 'Subscribe', 'bevesi-core' ),
				esc_attr__( 'You can customize the subscribe area.', 'bevesi-core' )
			),
			
			'footer_extra' => array(
				esc_attr__( 'Footer Extra', 'bevesi-core' ),
				esc_attr__( 'You can customize the footer extra section.', 'bevesi-core' )
			),
			
			'footer_general' => array(
				esc_attr__( 'Footer General', 'bevesi-core' ),
				esc_attr__( 'You can customize the footer settings.', 'bevesi-core' )
			),
			
			'footer_icon_box_style' => array(
				esc_attr__( 'Icon Box Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the icon box style.', 'bevesi-core' )
			),
			
			'footer1_style' => array(
				esc_attr__( 'Footer 1 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the footer settings.', 'bevesi-core' )
			),
			
			'footer2_style' => array(
				esc_attr__( 'Footer 2 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the footer settings.', 'bevesi-core' )
			),
			
			'footer3_style' => array(
				esc_attr__( 'Footer 3 Style', 'bevesi-core' ),
				esc_attr__( 'You can customize the footer settings.', 'bevesi-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bevesi_footer_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bevesi_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Icon Box Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_footer_icon_box',
				'label' => esc_attr__( 'Icon Box', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of Icon Box.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_section',
				'default' => '0',
			)
		);
		
		/*====== Icon Box Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_footer_icon_box_title',
				'label' => esc_attr__( 'Title', 'bevesi-core' ),
				'description' => esc_attr__( 'You can enter a title.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_section',
				'default' => 'Need help?',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_icon_box',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Icon Box Subtitle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_footer_icon_box_subtitle',
				'label' => esc_attr__( 'Subtitle', 'bevesi-core' ),
				'description' => esc_attr__( 'You can enter a subtitle.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_section',
				'default' => 'Reach out to us on any of the support channel',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_icon_box',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Icon Box ======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_footer_icon_box_repeater',
				'label' => esc_attr__( 'Icon Box', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set the icon box repeater.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_section',
				'fields' => array(
					'box_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "klb-icon-discount-solid"', 'bevesi-core' ),
					),
					'icon_box_title' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Title', 'bevesi-core' ),
						'description' => esc_attr__( 'You can enter a title.', 'bevesi-core' ),
					),
					'icon_box_desc' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Description', 'bevesi-core' ),
						'description' => esc_attr__( 'You can enter a description.', 'bevesi-core' ),
					),
				),
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_icon_box',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
				
			)
		);
		
		/*====== Subcribe Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_footer_subscribe_area',
				'label' => esc_attr__( 'Subcribe', 'bevesi-core' ),
				'description' => esc_attr__( 'Disable or Enable subscribe section.', 'bevesi-core' ),
				'section' => 'bevesi_footer_subscribe_section',
				'default' => '0',
			)
		);
		
		/*====== Subscribe Image======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_footer_subscribe_image',
				'label' => esc_attr__( 'Image', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
				'section' => 'bevesi_footer_subscribe_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					],
					[
					  'setting'  => 'bevesi_footer_type',
					  'operator' => '!==',
					  'value'    => 'type2',
					],
				],
			)
		);
		
		/*====== Subscribe Image======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_footer_subscribe_image2',
				'label' => esc_attr__( 'Image', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
				'section' => 'bevesi_footer_subscribe_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					],
					[
					  'setting'  => 'bevesi_footer_type',
					  'operator' => '==',
					  'value'    => 'type2',
					],
				],
				
			)
		);
		
		/*====== Subscribe Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_footer_subscribe_title',
				'label' => esc_attr__( 'Title', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set text for subscribe section.', 'bevesi-core' ),
				'section' => 'bevesi_footer_subscribe_section',
				'default' => 'Learn first about discounts',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Subscribe Subtitle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_footer_subscribe_subtitle',
				'label' => esc_attr__( 'Subtitle', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set text for subscribe section.', 'bevesi-core' ),
				'section' => 'bevesi_footer_subscribe_section',
				'default' => 'As well as news, special offers and promotions',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Subcribe FORM ID======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_footer_subscribe_formid',
				'label' => esc_attr__( 'Subscribe Form Id.', 'bevesi-core' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'bevesi-core' ),
				'section' => 'bevesi_footer_subscribe_section',
				'default' => '',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Footer Type ======*/
		bevesi_customizer_add_field(
			array (
				'type'        => 'select',
				'settings'    => 'bevesi_footer_type',
				'label'       => esc_html__( 'Footer Type', 'bevesi-core' ),
				'section'     => 'bevesi_footer_general_section',
				'default'     => 'type1',
				'choices'     => array(
					'type1' => esc_attr__( 'Type 1', 'bevesi-core' ),
					'type2' => esc_attr__( 'Type 2', 'bevesi-core' ),
					'type3' => esc_attr__( 'Type 3', 'bevesi-core' ),
				) 
			) 
		);
		
		/*====== Footer Column ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bevesi_footer_column',
				'label' => esc_attr__( 'Footer Column', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set footer column.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => '4columns',
				'choices' => array(
					'5columns' => esc_attr__( '5 Columns', 'bevesi-core' ),
					'4columns' => esc_attr__( '4 Columns', 'bevesi-core' ),
					'3columns' => esc_attr__( '3 Columns', 'bevesi-core' ),
				),
			)
		);
		
		/*====== Footer Copyright Second Text ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_second_copyright',
				'label' => esc_attr__( 'Copyright Second Text', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a copyright text for the footer.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => 'These contacts are, among other things, contacts for communication regarding the appeal of buyers about a violation of their rights. Persons authorized to consider buyers ’appeals about violation of their rights - KLBThemes. Phone number of employees of local executive and administrative bodies at the place of state registration of LLC « Triovist » authorized to consider customer requests: + 375 17 374 01 46.',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_footer_type',
					  'operator' => '!==',
					  'value'    => 'type1',
					],
				],
			)
		);
		
		/*====== Copyright ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_copyright',
				'label' => esc_attr__( 'Copyright', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a copyright text for the footer.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => '',
			)
		);
		
		/*====== Back to top  ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_scroll_to_top',
				'label' => esc_attr__( 'Back To Top Button', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => '0',
			)
		);

		/*====== Footer Contact Icon Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_footer_contact_icon',
				'label' => esc_attr__( 'Contact Icon', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of Contact Icon.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => '0',
			)
		);
		
		/*====== Contact Icon repeater======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_footer_contact_repeater',
				'label' => esc_attr__( 'Contact Icon Repeater', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set the contact icon repeater.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'fields' => array(
					'contact_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "klb-icon-discount-solid"', 'bevesi-core' ),
					),
					'contact_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bevesi-core' ),
					),
					'contact_title' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Title', 'bevesi-core' ),
						'description' => esc_attr__( 'You can enter a title.', 'bevesi-core' ),
					),
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_footer_contact_icon',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== APP Title======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_footer_app_title',
				'label' => esc_attr__( 'APP Title', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a title.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => '',
				'priority'    => 11,
			)
		);
		
		/*====== APP Title======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_footer_app_subtitle',
				'label' => esc_attr__( 'APP Subtitle', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a subtitle.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'default' => '',
				'priority'    => 11,
			)
		);
		
		/*====== APP Image ======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_footer_app_image',
				'label' => esc_attr__( 'APP IMAGE', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set the app images.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'priority'    => 12,
				'fields' => array(
					'app_image' => array(
						'type' => 'image',
						'label' => esc_attr__( 'Image', 'bevesi-core' ),
						'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
					),
					
					'app_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bevesi-core' ),
						'description' => esc_attr__( 'set an url for the image.', 'bevesi-core' ),
					),
					
					'app_image_title' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Text', 'bevesi-core' ),
						'description' => esc_attr__( 'set an url for the text.', 'bevesi-core' ),
					),
				),
			)
		);
		
		/*====== Footer Social List ======*/
		new \Kirki\Field\Repeater(
			array(
				'settings' => 'bevesi_footer_social_list',
				'label' => esc_attr__( 'Social List', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set social icons.', 'bevesi-core' ),
				'section' => 'bevesi_footer_general_section',
				'fields' => array(
					'social_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "facebook"', 'bevesi-core' ),
					),

					'social_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bevesi-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bevesi-core' ),
					),

				),
				'priority'    => 13,
			)
		);
		
		
	/*====== Icon Box Style ========*/	
		
		/*====== Icon Box Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_icon_box_bg_color',
				'label' => esc_attr__( 'Icon Box Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_style_section',
			)
		);
		
		/*====== Icon Box Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e8f0',
				'settings' => 'bevesi_icon_box_border_color',
				'label' => esc_attr__( 'Icon Box Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_style_section',
			)
		);
		
		/*====== Icon Box Icon Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000000',
				'settings' => 'bevesi_icon_box_icon_color',
				'label' => esc_attr__( 'Icon Box Icon Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_style_section',
			)
		);
		
		/*====== Icon Box Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_icon_box_title_color',
				'label' => esc_attr__( 'Icon Box Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_style_section',
			)
		);	

		/*====== Icon Box Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_icon_box_subtitle_color',
				'label' => esc_attr__( 'Icon Box Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer_icon_box_style_section',
			)
		);	
		
	/*====== Footer 1 Style =============================*/	
		
		/*====== Footer 1 Top Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(0, 113, 220, 1)',
				'settings' => 'bevesi_footer1_top_bg_color',
				'label' => esc_attr__( 'Footer Top Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Top Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer1_top_title_color',
				'label' => esc_attr__( 'Footer Top Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
			)
		);
		
		/*====== Footer 1 Main Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(0, 113, 220, 1)',
				'settings' => 'bevesi_footer1_main_bg_color',
				'label' => esc_attr__( 'Footer Main Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Main Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(255, 255, 255, 0.2)',
				'settings' => 'bevesi_footer1_main_border_color',
				'label' => esc_attr__( 'Footer Main Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Main Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer1_main_title_color',
				'label' => esc_attr__( 'Footer Main Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
			)
		);
		
		/*====== Footer 1 Main Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e8f0',
				'settings' => 'bevesi_footer1_main_subtitle_color',
				'label' => esc_attr__( 'Footer Main Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
			)
		);
		
		/*====== Footer 1 Bottom Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(0, 113, 220, 1)',
				'settings' => 'bevesi_footer1_bottom_bg_color',
				'label' => esc_attr__( 'Footer Bottom Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Bottom Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(255, 255, 255, 0.2)',
				'settings' => 'bevesi_footer1_bottom_border_color',
				'label' => esc_attr__( 'Footer Bottom Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Bottom Icon Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer1_bottom_icon_color',
				'label' => esc_attr__( 'Footer Bottom Icon Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
			)
		);
		
		/*====== Footer 1 Bottom Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer1_bottom_title_color',
				'label' => esc_attr__( 'Footer Bottom Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
			)
		);
		
		/*====== Footer 1 Copyright Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(0, 113, 220, 1)',
				'settings' => 'bevesi_footer1_copyright_bg_color',
				'label' => esc_attr__( 'Footer Copyright Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Copyright Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(255, 255, 255, 0.2)',
				'settings' => 'bevesi_footer1_copyright_border_color',
				'label' => esc_attr__( 'Footer Copyright Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 1 Copyright Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer1_copyright_color',
				'label' => esc_attr__( 'Footer Copyright Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer1_style_section',
			)
		);
		
	/*====== Footer 2 Style =============================*/	
		
		/*====== Footer 2 Top Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f8fafc',
				'settings' => 'bevesi_footer2_top_bg_color',
				'label' => esc_attr__( 'Footer Top Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Top Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000000',
				'settings' => 'bevesi_footer2_top_title_color',
				'label' => esc_attr__( 'Footer Top Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);
		
		/*====== Footer 2 Top Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#64748b',
				'settings' => 'bevesi_footer2_top_subtitle_color',
				'label' => esc_attr__( 'Footer Top Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);
		
		/*====== Footer 2 Main Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f8fafc',
				'settings' => 'bevesi_footer2_main_bg_color',
				'label' => esc_attr__( 'Footer Main Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Main Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e8f0',
				'settings' => 'bevesi_footer2_main_border_color',
				'label' => esc_attr__( 'Footer Main Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Main Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_footer2_main_title_color',
				'label' => esc_attr__( 'Footer Main Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);
		
		/*====== Footer 2 Main Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_footer2_main_subtitle_color',
				'label' => esc_attr__( 'Footer Main Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);
		
		/*====== Footer 2 Bottom Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f8fafc',
				'settings' => 'bevesi_footer2_bottom_bg_color',
				'label' => esc_attr__( 'Footer Bottom Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Bottom Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e8f0',
				'settings' => 'bevesi_footer2_bottom_border_color',
				'label' => esc_attr__( 'Footer Bottom Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Bottom Icon Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_footer2_bottom_icon_color',
				'label' => esc_attr__( 'Footer Bottom Icon Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);
		
		/*====== Footer 2 Bottom Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#64748b',
				'settings' => 'bevesi_footer2_bottom_title_color',
				'label' => esc_attr__( 'Footer Bottom Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);
		
		/*====== Footer 2 Copyright Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f8fafc',
				'settings' => 'bevesi_footer2_copyright_bg_color',
				'label' => esc_attr__( 'Footer Copyright Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Copyright Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e8f0',
				'settings' => 'bevesi_footer2_copyright_border_color',
				'label' => esc_attr__( 'Footer Copyright Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 2 Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#64748b',
				'settings' => 'bevesi_footer2_copyright_title_color',
				'label' => esc_attr__( 'Footer Copyright Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);	
		
		/*====== Footer 2 Copyright Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000',
				'settings' => 'bevesi_footer2_copyright_color',
				'label' => esc_attr__( 'Footer Copyright Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer2_style_section',
			)
		);	
		
	/*====== Footer 3 Style =============================*/	
		
		/*====== Footer 3 Top Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#0f172a',
				'settings' => 'bevesi_footer3_top_bg_color',
				'label' => esc_attr__( 'Footer Top Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Top Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_top_title_color',
				'label' => esc_attr__( 'Footer Top Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);
		
		/*====== Footer 3 Top Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_top_subtitle_color',
				'label' => esc_attr__( 'Footer Top Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);
		
		/*====== Footer 3 Main Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#0f172a',
				'settings' => 'bevesi_footer3_main_bg_color',
				'label' => esc_attr__( 'Footer Main Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Main Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(255, 255, 255, 0.1)',
				'settings' => 'bevesi_footer3_main_border_color',
				'label' => esc_attr__( 'Footer Main Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Main Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_main_title_color',
				'label' => esc_attr__( 'Footer Main Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);
		
		/*====== Footer 3 Main Subtitle Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e8f0',
				'settings' => 'bevesi_footer3_main_subtitle_color',
				'label' => esc_attr__( 'Footer Main Subtitle Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);
		
		/*====== Footer 3 Bottom Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#0f172a',
				'settings' => 'bevesi_footer3_bottom_bg_color',
				'label' => esc_attr__( 'Footer Bottom Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Bottom Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(255, 255, 255, 0.1)',
				'settings' => 'bevesi_footer3_bottom_border_color',
				'label' => esc_attr__( 'Footer Bottom Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Bottom Icon Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_bottom_icon_color',
				'label' => esc_attr__( 'Footer Bottom Icon Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);
		
		/*====== Footer 3 Bottom Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_bottom_title_color',
				'label' => esc_attr__( 'Footer Bottom Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);
		
		/*====== Footer 3 Copyright Background Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#0f172a',
				'settings' => 'bevesi_footer3_copyright_bg_color',
				'label' => esc_attr__( 'Footer Copyright Background Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Copyright Border Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => 'rgba(255, 255, 255, 0.1)',
				'settings' => 'bevesi_footer3_copyright_border_color',
				'label' => esc_attr__( 'Footer Copyright Border Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for border.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
				'choices'     => [
					'alpha' => true,
				],
			)
		);
		
		/*====== Footer 3 Title Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_copyright_title_color',
				'label' => esc_attr__( 'Footer Copyright Title Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);	
		
		/*====== Footer 3 Copyright Color ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bevesi_footer3_copyright_color',
				'label' => esc_attr__( 'Footer Copyright Color', 'bevesi-core' ),
				'description' => esc_attr__( 'You can set a color for color.', 'bevesi-core' ),
				'section' => 'bevesi_footer3_style_section',
			)
		);	
		
		/*====== GDPR Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_gdpr_toggle',
				'label' => esc_attr__( 'Enable GDPR', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of GDPR.', 'bevesi-core' ),
				'section' => 'bevesi_gdpr_settings_section',
				'default' => '0',
			)
		);
		
		/*====== GDPR Type ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bevesi_gdpr_type',
				'label' => esc_attr__( 'GDPR Type', 'bevesi-core' ),
				'section' => 'bevesi_gdpr_settings_section',
				'default' => 'type1',
				'choices' => array(
					'type1' => esc_attr__( 'Type 1', 'bevesi-core' ),
					'type2' => esc_attr__( 'Type 2', 'bevesi-core' ),
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== GDPR Image======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_gdpr_image',
				'label' => esc_attr__( 'Image', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
				'section' => 'bevesi_gdpr_settings_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'active_callback' => [
					[
					  'setting'  => 'bevesi_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					],
					[
					  'setting'  => 'bevesi_gdpr_type',
					  'operator' => '!=',
					  'value'    => 'type2',
					]
				],
			)
		);
		
		/*====== GDPR Text ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_gdpr_text',
				'label' => esc_attr__( 'GDPR Text', 'bevesi-core' ),
				'section' => 'bevesi_gdpr_settings_section',
				'default' => 'In order to provide you a personalized shopping experience, our site uses cookies. <br><a href="#">cookie policy</a>.',
				'required' => array(
					array(
					  'setting'  => 'bevesi_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== GDPR Expire Date ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_gdpr_expire_date',
				'label' => esc_attr__( 'GDPR Expire Date', 'bevesi-core' ),
				'section' => 'bevesi_gdpr_settings_section',
				'default' => '15',
				'required' => array(
					array(
					  'setting'  => 'bevesi_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== GDPR Button Text ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_gdpr_button_text',
				'label' => esc_attr__( 'GDPR Button Text', 'bevesi-core' ),
				'section' => 'bevesi_gdpr_settings_section',
				'default' => 'Accept Cookies',
				'required' => array(
					array(
					  'setting'  => 'bevesi_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== Newsletter Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_newsletter_popup_toggle',
				'label' => esc_attr__( 'Enable Newsletter', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of Newsletter Popup.', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'default' => '0',
			)
		);
		
		/*====== Newsletter Type ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bevesi_newsletter_type',
				'label' => esc_attr__( 'Newsletter Type', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'default' => 'type1',
				'choices' => array(
					'type1' => esc_attr__( 'Type 1', 'bevesi-core' ),
					'type2' => esc_attr__( 'Type 2', 'bevesi-core' ),
					'type3' => esc_attr__( 'Type 3', 'bevesi-core' ),
				),
				'required' => array(
					array(
					  'setting'  => 'bevesi_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Newsletter Image ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_newsletter_image',
				'label' => esc_attr__( 'Image', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'input_attrs' => array( 'class' => 'my_custom_class' ),

				'active_callback' => [
					[
					  'setting'  => 'bevesi_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					],
					[
					  'setting'  => 'bevesi_newsletter_type',
					  'operator' => '!=',
					  'value'    => 'type1',
					]
				],

			)
		);
		
		
		/*====== Newsletter Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_newsletter_popup_title',
				'label' => esc_attr__( 'Newsletter Title', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'default' => 'Subscribe To Newsletter',
				'required' => array(
					array(
					  'setting'  => 'bevesi_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Newsletter Subtitle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_newsletter_popup_subtitle',
				'label' => esc_attr__( 'Newsletter Subtitle', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'default' => 'Subscribe to the Bevesi mailing list to receive updates on new arrivals, special offers and our promotions.',
				'required' => array(
					array(
					  'setting'  => 'bevesi_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subcribe Popup FORM ID======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_newsletter_popup_formid',
				'label' => esc_attr__( 'Newsletter Form Id.', 'bevesi-core' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bevesi_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subcribe Popup Expire Date ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_newsletter_popup_expire_date',
				'label' => esc_attr__( 'Newsletter Expire Date', 'bevesi-core' ),
				'section' => 'bevesi_newsletter_settings_section',
				'default' => '15',
				'required' => array(
					array(
					  'setting'  => 'bevesi_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Maintenance Toggle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bevesi_maintenance_toggle',
				'label' => esc_attr__( 'Enable Maintenance Mode', 'bevesi-core' ),
				'description' => esc_attr__( 'You can choose status of Maintenance.', 'bevesi-core' ),
				'section' => 'bevesi_maintenance_settings_section',
				'default' => '0',
			)
		);
		
		/*====== Maintenance Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_maintenance_title',
				'label' => esc_attr__( 'Title', 'bevesi-core' ),
				'section' => 'bevesi_maintenance_settings_section',
				'default' => 'Coming',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_maintenance_toggle',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);

		/*====== Maintenance Second Title ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_maintenance_second_title',
				'label' => esc_attr__( 'Second Title', 'bevesi-core' ),
				'section' => 'bevesi_maintenance_settings_section',
				'default' => 'Soon',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_maintenance_toggle',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Maintenance Subtitle ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bevesi_maintenance_subtitle',
				'label' => esc_attr__( 'Subtitle', 'bevesi-core' ),
				'section' => 'bevesi_maintenance_settings_section',
				'default' => 'Get ready! Something really cool is coming!',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_maintenance_toggle',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Maintenance Mailchimp FORM ID======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_maintenance_mailchimp_formid',
				'label' => esc_attr__( 'Mailchimp Form Id.', 'bevesi-core' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'bevesi-core' ),
				'section' => 'bevesi_maintenance_settings_section',
				'default' => '',
				'active_callback' => [
					[
					  'setting'  => 'bevesi_maintenance_toggle',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Maintenance Image ======*/
		bevesi_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bevesi_maintenance_image',
				'label' => esc_attr__( 'Background Image', 'bevesi-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bevesi-core' ),
				'section' => 'bevesi_maintenance_settings_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'input_attrs' => array( 'class' => 'my_custom_class' ),
				'active_callback' => [
					[
					  'setting'  => 'bevesi_maintenance_toggle',
					  'operator' => '==',
					  'value'    => '1',
					]
				],
			)
		);
		
		/*====== Body Typography ======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_body_typography',
				'label'       => esc_attr__( 'Body Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'    => '"Outfit", sans-serif',
					'variant'        => 'regular',
					'font-size'      => '16px',
					'letter-spacing' => '-0.01em',
					'line-height'	 => '1.5',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
				
			)
		);

		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator1',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );

		/*====== Heading Typography h1,h2,h3,h4,h5,h6======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_heading_typography',
				'label'       => esc_attr__( 'Heading Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'    => '"Outfit", sans-serif',
					'variant'        => '500',
					'letter-spacing' => '-0.025rem',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
				
			)
		);

		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator2',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );

		/*====== Main Menu Typography======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_menu_typography',
				'label'       => esc_attr__( 'Menu Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'    => '"Outfit", sans-serif',
					'variant'        => '600',
					'font-size'      => '16px',
					'letter-spacing' => '-0.015rem',
					'text-transform' => 'none',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
				
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator3',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		/*====== Form Typography======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_form_typography',
				'label'       => esc_attr__( 'Form Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'    => '"Outfit", sans-serif',
					'variant'        => 'regular',
					'font-size'      => '14px',
					'letter-spacing' => '-0.02em',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
				
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator4',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		/*====== Button Typography======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_button_typography',
				'label'       => esc_attr__( 'Button Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'    => '"Outfit", sans-serif',
					'variant'        => '600',
					'font-size'      => '14px',
					'letter-spacing' => '-0.02em',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
				
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator5',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		/*====== Price Typography======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_price_typography',
				'label'       => esc_attr__( 'Price Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'       => '"Outfit", sans-serif',
					'variant'           => '700',
					'font-size'      	=> '18px',
					'letter-spacing' 	=> '-0.02em',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
				
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator6',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		/*====== Product Name Typography======*/
		bevesi_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bevesi_product_name_typography',
				'label'       => esc_attr__( 'Product Name Typography', 'bevesi-core' ),
				'section'     => 'bevesi_typography_settings_section',
				'default'     => [
					'font-family'       => '"Outfit", sans-serif',
					'variant'           => '400',
					'font-size'      	=> '14px',
					'letter-spacing' 	=> '-0.02em',	
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'choices' => [
					'fonts' => [
						'google'   => [],
						'families' => [
							'custom' => [
								'text'     => 'Bevesi Fonts',
								'children' => [
									[ 'id' => '"Outfit", sans-serif', 'text' => 'Outfit' ],
								],
							],
						],
						'variants' => [
							'"Outfit", sans-serif'       => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900', '100italic', '200italic', '300italic', 'italic', '500italic', '600italic', '700italic', '800italic', '900italic' ),
						],
					],
				],
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator7',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_site_gutter',
				'label' => esc_attr__( 'Site Gutter', 'bevesi-core' ),
				'section' => 'bevesi_typography_settings_section',
				'default' => '30px',
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator8',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_border_radius',
				'label' => esc_attr__( 'Border Radius', 'bevesi-core' ),
				'section' => 'bevesi_typography_settings_section',
				'default' => '6px',
			)
		);
		
		// Separator
		bevesi_customizer_add_field ( array(
			'type'        => 'custom',
			'settings'    => 'klb_separator9',
			'section'     => 'bevesi_typography_settings_section',
			'default'     => '<hr>',
		) );
		
		bevesi_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bevesi_site_width',
				'label' => esc_attr__( 'Site Width', 'bevesi-core' ),
				'section' => 'bevesi_typography_settings_section',
				'default' => '1460px',
			)
		);