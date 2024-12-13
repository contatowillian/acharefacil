<?php

function bevesi_add_elementor_page_settings_controls( $page ) {

	$page->add_control( 'bevesi_elementor_enable_sidebar_collapse',
		[
			'label'          => esc_html__( 'Sidebar Collapse', 'bevesi-core' ),
            'type'           => \Elementor\Controls_Manager::SWITCHER,
			'label_on'       => esc_html__( 'Yes', 'bevesi-core' ),
			'label_off'      => esc_html__( 'No', 'bevesi-core' ),
			'return_value'   => 'yes',
			'default'        => 'no',
		]
	);

	$page->add_control( 'bevesi_elementor_hide_page_header',
		[
			'label'          => esc_html__( 'Hide Header', 'bevesi-core' ),
            'type'           => \Elementor\Controls_Manager::SWITCHER,
			'label_on'       => esc_html__( 'Yes', 'bevesi-core' ),
			'label_off'      => esc_html__( 'No', 'bevesi-core' ),
			'return_value'   => 'yes',
			'default'        => 'no',
		]
	);
	
	$page->add_control( 'bevesi_elementor_page_header_type',
		[
			'label' => esc_html__( 'Header Type', 'bevesi-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => esc_html__( 'Select a type', 'bevesi-core' ),
				'type1' 	  => esc_html__( 'Type 1', 'bevesi-core' ),
				'type2'		  => esc_html__( 'Type 2', 'bevesi-core' ),
				'type3'		  => esc_html__( 'Type 3', 'bevesi-core' ),
				'type4'		  => esc_html__( 'Type 4', 'bevesi-core' ),
				'type5'		  => esc_html__( 'Type 5', 'bevesi-core' ),
				'type6'		  => esc_html__( 'Type 6', 'bevesi-core' ),
			],
		]
	);
	
	$page->add_control( 'bevesi_elementor_hide_page_footer',
		[
			'label'          => esc_html__( 'Hide Footer', 'bevesi-core' ),
			'type'           => \Elementor\Controls_Manager::SWITCHER,
			'label_on'       => esc_html__( 'Yes', 'bevesi-core' ),
			'label_off'      => esc_html__( 'No', 'bevesi-core' ),
			'return_value'   => 'yes',
			'default'        => 'no',
		]
	);
	
	$page->add_control( 'bevesi_elementor_page_footer_type',
		[
			'label' => esc_html__( 'Footer Type', 'bevesi-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => esc_html__( 'Select a type', 'bevesi-core' ),
				'type1' 	  => esc_html__( 'Type 1', 'bevesi-core' ),
				'type2'		  => esc_html__( 'Type 2', 'bevesi-core' ),
				'type3'		  => esc_html__( 'Type 3', 'bevesi-core' ),
			],
		]
	);
	
	$page->add_control( 'bevesi_elementor_logo',
		[
			'label'          => esc_html__( 'Set Dark Logo', 'bevesi-core' ),
            'type' 			 => \Elementor\Controls_Manager::MEDIA,
		]
	);
	
	$page->add_control( 'bevesi_elementor_logo_light',
		[
			'label'          => esc_html__( 'Set Light Logo', 'bevesi-core' ),
            'type' 			 => \Elementor\Controls_Manager::MEDIA,
		]
	);
	
	$page->add_control(
		'page_width',
		[
			'label' => __( 'Width', 'bevesi-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'devices' => [ 'desktop' ],
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 1100,
					'max' => 1650,
					'step' => 5,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 1460,
			],
			'selectors' => [
				'{{WRAPPER}} .container' => 'max-width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-section.elementor-section-boxed>.elementor-container' => 'max-width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .e-con ' => '--container-max-width: {{SIZE}}{{UNIT}};',
			],
		]
	);

}

add_action( 'elementor/element/wp-page/document_settings/before_section_end', 'bevesi_add_elementor_page_settings_controls' );