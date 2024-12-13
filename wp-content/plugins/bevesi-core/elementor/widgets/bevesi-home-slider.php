<?php

namespace Elementor;

class Bevesi_Home_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'bevesi-home-slider';
    }
    public function get_title() {
        return 'Home Slider (K)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'bevesi' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'bevesi-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'slider_type',
			[
				'label' => esc_html__( 'Slider Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bevesi-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_control( 'auto_play',
			[
				'label' => esc_html__( 'Auto Play', 'bevesi-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bevesi-core' ),
				'label_off' => esc_html__( 'False', 'bevesi-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);

        $this->add_control( 'auto_speed',
            [
                'label' => esc_html__( 'Auto Speed', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '500',
                'pleaceholder' => esc_html__( 'Set auto speed.', 'bevesi-core' ),
				'condition' => ['auto_play' => 'true']
            ]
        );
		
		$this->add_control( 'dots',
			[
				'label' => esc_html__( 'Dots', 'bevesi-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bevesi-core' ),
				'label_off' => esc_html__( 'False', 'bevesi-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);
		
		$this->add_control( 'arrows',
			[
				'label' => esc_html__( 'Arrows', 'bevesi-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bevesi-core' ),
				'label_off' => esc_html__( 'False', 'bevesi-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

        $this->add_control( 'slide_speed',
            [
                'label' => esc_html__( 'Slide Speed', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '700',
                'pleaceholder' => esc_html__( 'Set slide speed.', 'bevesi-core' ),
            ]
        );
		
		$defaultbg = plugins_url( 'images/slider-01.jpg', __DIR__ );
		
		$repeater = new Repeater();
        $repeater->add_control( 'slider_image',
            [
                'label' => esc_html__( 'Image', 'bevesi-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control( 'slider_title',
            [
                'label' => esc_html__( 'Item Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Paragyn odade, budgetstup, pemolig.',
                'pleaceholder' => esc_html__( 'Enter item title here.', 'bevesi-core' )
            ]
        );
		
		 $repeater->add_control( 'slider_subtitle',
            [
                'label' => esc_html__( 'Item Subtitle', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Antisk timung mynade geonyng antifoni.',
                'pleaceholder' => esc_html__( 'Enter item subtitle here.', 'bevesi-core' )
            ]
        );
		
        $repeater->add_control( 'slider_desc',
            [
                'label' => esc_html__( 'Item Description', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Vahet pukroren euronas oaktat astrocentrism susat. Psykogyn fabel ontocism gigt. Faregt puskade, på döjon multisat.',
                'pleaceholder' => esc_html__( 'Enter item desc here.', 'bevesi-core' )
            ]
        );

        $repeater->add_control( 'slider_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'bevesi-core' )
            ]
        );
		
        $repeater->add_control( 'slider_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'bevesi-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'bevesi-core' )
            ]
        );
		
		$this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'bevesi-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Paragyn odade, budgetstup, pemolig.',
						'slider_subtitle' => 'Antisk timung mynade geonyng antifoni.',
                        'slider_desc' => 'Vahet pukroren euronas oaktat astrocentrism susat. Psykogyn fabel ontocism gigt. Faregt puskade, på döjon multisat.',
                        'slider_btn_title' => ' Shop Now ',
                        'slider_btn_link' => '#',
                    ],
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Paragyn odade, budgetstup, pemolig.',
						'slider_subtitle' => 'Antisk timung mynade geonyng antifoni.',
						'slider_desc' => 'Vahet pukroren euronas oaktat astrocentrism susat. Psykogyn fabel ontocism gigt. Faregt puskade, på döjon multisat.',
                        'slider_btn_title' => ' Shop Now ',
                        'slider_btn_link' => '#',
                    ],
					[
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Paragyn odade, budgetstup, pemolig.',
                        'slider_subtitle' => 'Antisk timung mynade geonyng antifoni.',
						'slider_desc' => 'Vahet pukroren euronas oaktat astrocentrism susat. Psykogyn fabel ontocism gigt. Faregt puskade, på döjon multisat.',
                        'slider_btn_title' => ' Shop Now ',
                        'slider_btn_link' => '#',
                    ],
                ]
            ]
        );
		
		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
		
		/*****   START CONTROLS SECTION   ******/
		$this->start_controls_section('bevesi_styling',
            [
                'label' => esc_html__( ' Style', 'bevesi-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		
		$this->add_responsive_control( 'banner_box_text_alignment',
            [
                'label' => esc_html__( 'Alignment Text', 'bevesi-core' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .site-banner-content' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'bevesi-core' ),
                        'icon' => 'eicon-text-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bevesi-core' ),
                        'icon' => 'eicon-text-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'bevesi-core' ),
                        'icon' => 'eicon-text-align-right'
                    ]
                ],
                'toggle' => true,
                
            ]
        );
		
		$this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}}  .site-banner-image img',
			]
		);
		
		$this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_responsive_control( 'title_size',
            [
                'label' => esc_html__( 'Title Size', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-title' => 'font-size: {{SIZE}}px !important;' ],
            ]
        );
		
		$this->add_responsive_control( 'title_weight',
            [
                'label' => esc_html__( 'Title Weight', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 1000,
                'step' => 100,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-title' => 'font-weight: {{SIZE}} !important;' ],
            ]
        );
		
		$this->add_control( 'title_color',
			[
               'label' => esc_html__( 'Title Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .entry-title' => 'color: {{VALUE}} !important;']
			]
        );
		
		$this->add_control( 'title_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .entry-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .entry-title',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-title',
				
            ]
        );
		
		$this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
		
		$this->add_responsive_control( 'subtitle_size',
            [
                'label' => esc_html__( 'Subtitle Size', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-subtitle' => 'font-size: {{SIZE}}px !important;' ],
            ]
        );
		
		$this->add_responsive_control( 'subtitle_weight',
            [
                'label' => esc_html__( 'Subtitle Weight', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 1000,
                'step' => 100,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-subtitle' => 'font-weight: {{SIZE}} !important;' ],
            ]
        );
		
		$this->add_control( 'subtitle_color',
			[
               'label' => esc_html__( 'Subtitle Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .entry-subtitle' => 'color: {{VALUE}} !important;'],
			]
        );
		
		$this->add_control( 'subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .entry-subtitle ' => 'opacity: {{VALUE}} ;'],
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_text_shadow',
				'selector' => '{{WRAPPER}} .entry-subtitle',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-subtitle',
				
            ]
        );
		
		$this->add_control( 'description_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_responsive_control( 'desc_size',
            [
                'label' => esc_html__( 'Description Size', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-description p' => 'font-size: {{SIZE}}px !important;' ],
            ]
        );
		
		$this->add_responsive_control( 'desc_weight',
            [
                'label' => esc_html__( 'Description Weight', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 1000,
                'step' => 100,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-description p' => 'font-weight: {{SIZE}} !important;' ],
            ]
        );
		
		
		$this->add_control( 'desc_color',
			[
               'label' => esc_html__( 'Description Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .entry-description p' => 'color: {{VALUE}} !important;']
			]
        );
		
		$this->add_control( 'description_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .entry-description p ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_text_shadow',
				'selector' => '{{WRAPPER}} .entry-description p ',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-description p',
				
            ]
        );
		
		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
		
		/*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('btn_styling',
            [
                'label' => esc_html__( ' Button Style', 'bevesi-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} a.button  '
            ]
        );
		
		$this->add_control( 'btn_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} a.button' => 'opacity: {{VALUE}} ;'],
            ]
        );
		
		$this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'bevesi-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} a.button' => 'color: {{VALUE}};']
            ]
        );
		
	    $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'bevesi-core' ),
                'selector' => '{{WRAPPER}} a.button ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'bevesi-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
		
		$this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'bevesi-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
       
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'bevesi-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} a.button',
            ]
        );
		
		$this->add_responsive_control( 'btn_height',
            [
                'label' => esc_html__( 'Button Height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} a.button' => 'height: {{SIZE}}px !important;' ],
            ]
        );
		
		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/	
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if($settings['slider_type'] == 'type2'){
			
			if ( $settings['slider_items'] ) {
				echo '<div class="site-slider-wrapper">';
				echo '<div class="site-slider slider-style loader-default arrows-style-long arrows-white" data-items="1" data-itemslaptop="1" data-itemstablet="1" data-itemsmobile="1" data-itemsmobilexs="1" data-slidescroll="1" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="'.esc_attr($settings['arrows']).'" data-arrowstablet="'.esc_attr($settings['arrows']).'" data-arrowsmobile="'.esc_attr($settings['arrows']).'" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="'.esc_attr($settings['dots']).'" data-dotstablet="'.esc_attr($settings['dots']).'" data-dotsmobile="'.esc_attr($settings['dots']).'" data-infinite="true" data-centermode="false" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'">';
				
				foreach ( $settings['slider_items'] as $item ) {
					$target = $item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
			  
					echo '<div class="slider-item">';
					echo '<div class="site-banner horizontal-half banner-align-center banner-justify-start banner-color-custom custom-background" style="--banner-desktop-height: 520px; --banner-laptop-height: 520px; --banner-tablet-height: 520px; --banner-mobile-height: 320px; --banner-color: #6D4D36; --custom-background-block: #F9F6F3;">';
					echo '<div class="site-banner-content">';
					echo '<div class="site-banner-inner gap-small width-full padding-20 padding-60-mobile">';
					echo '<div class="site-banner-row site-banner-header">';
					echo '<h4 class="entry-subtitle text-sm font-medium">'.esc_html($item['slider_subtitle']).'</h4>';
					echo '</div><!-- site-banner-row -->';
					echo '<div class="site-banner-row site-banner-body">';
					echo '<h2 class="entry-title text-3xl mobile:text-[52px]/[62px] font-bold tracking-tight laptop:mb-3">'.esc_html($item['slider_title']).'</h2>';
					echo '<div class="entry-description width-80">';
					echo '<p class="text-sm mobile:text-base">'.bevesi_sanitize_data($item['slider_desc']).'</p>';
					echo '</div><!-- entry-description -->';
					echo '</div><!-- site-banner-row -->';

					if($item['slider_btn_title']){	
						echo '<div class="site-banner-row site-banner-footer">';
						echo '<a href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button black outline rounded-style">'.esc_html($item['slider_btn_title']).' </a>';
						echo '</div><!-- site-banner-row -->';
					}

					echo '</div><!-- site-banner-inner -->';
					echo '</div><!-- site-banner-content -->';
					echo '<div class="site-banner-image">';
					echo '<img src="'.esc_url($item['slider_image']['url']).'" alt="">';
					echo '</div><!-- site-banner-image -->';
					echo '<a href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="site-overlay-link"></a>';
					echo '</div><!-- site-banner -->';
					echo '</div><!-- slider-item -->';
					
				} 
			  
				echo '</div><!-- site-slider -->';
				echo '</div><!-- site-slider-wrapper -->';
			}
		} else {
			if ( $settings['slider_items'] ) {
				echo '<div class="site-slider-wrapper">';
				echo '<div class="site-slider slider-style loader-default arrows-style-long arrows-white" data-items="1" data-itemslaptop="1" data-itemstablet="1" data-itemsmobile="1" data-itemsmobilexs="1" data-slidescroll="1" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="'.esc_attr($settings['arrows']).'" data-arrowstablet="'.esc_attr($settings['arrows']).'" data-arrowsmobile="'.esc_attr($settings['arrows']).'" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="'.esc_attr($settings['dots']).'" data-dotstablet="'.esc_attr($settings['dots']).'" data-dotsmobile="'.esc_attr($settings['dots']).'" data-infinite="true" data-centermode="false" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'">';
				
				foreach ( $settings['slider_items'] as $item ) {
					$target = $item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
					
					echo '<div class="slider-item">';
					echo '<div class="site-banner banner-align-center banner-justify-start banner-color-custom" style="--banner-desktop-height: 512px; --banner-laptop-height: 512px; --banner-tablet-height: 512px; --banner-mobile-height: 320px; --banner-color: #41543E;">';
					echo '<div class="site-banner-content">';
					echo '<div class="site-banner-inner gap-small width-80 width-70-mobile width-60-laptop padding-20 padding-60-mobile">';
					echo '<div class="site-banner-row site-banner-header">';
					echo '<h4 class="entry-subtitle text-sm font-medium">'.esc_html($item['slider_subtitle']).'</h4>';
					echo '</div><!-- site-banner-row -->';
					echo '<div class="site-banner-row site-banner-body">';
					echo '<h2 class="entry-title text-3xl mobile:text-[52px]/[62px] font-bold tracking-tight laptop:mb-3">'.esc_html($item['slider_title']).'</h2>';
					echo '<div class="entry-description width-80">';
					echo '<p class="text-sm mobile:text-base">'.bevesi_sanitize_data($item['slider_desc']).'</p>';
					echo '</div><!-- entry-description -->';
					echo '</div><!-- site-banner-row -->';
					
					if($item['slider_btn_title']){	
						echo '<div class="site-banner-row site-banner-footer">';
						echo '<a href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button white shadow-style">'.esc_html($item['slider_btn_title']).' </a>';
						echo '</div><!-- site-banner-row -->';
					}
					
					echo '</div><!-- site-banner-inner -->';
					echo '</div><!-- site-banner-content -->';
					echo '<div class="site-banner-image">';
					echo '<img src="'.esc_url($item['slider_image']['url']).'" alt="">';
					echo '</div><!-- site-banner-image -->';
					echo '<a href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="site-overlay-link"></a>';
					echo '</div><!-- site-banner -->';
					echo '</div><!-- slider-item -->';
					
				}
				
				echo '</div><!-- site-slider -->';
				echo '</div><!-- site-slider-wrapper -->'; 
			}
		}	
		
	}

}