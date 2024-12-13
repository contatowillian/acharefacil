<?php

namespace Elementor;

class Bevesi_Banner_Box2_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-banner-box2';
    }
    public function get_title() {
        return 'Banner Box 2 (K)';
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
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'banner_type',
			[
				'label' => esc_html__( 'Banner Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bevesi-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bevesi-core' ),
					'type3'	  => esc_html__( 'Type 3', 'bevesi-core' ),
					'type4'	  => esc_html__( 'Type 4', 'bevesi-core' ),
				],
			]
		);
		
		$defaultimage = plugins_url( 'images/banner-05.jpg', __DIR__ );
		
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'bevesi-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $defaultimage],
            ]
        );
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Palig panysell solhybrid juviren',
                'description'=> 'Add a title.',
				'label_block' => true,
            ]
        );
		
		$this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Antisk timung mynade geonyng antifoni.',
                'description'=> 'Add a Subtitle.',
            ]
        );
		
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Vahet pukroren euronas oaktat astrocentrism susat. Psykogyn fabel ontocism gigt. Faregt puskade.',
                'description'=> 'Add a description.',
				'label_block' => true,
				'condition' => ['banner_type' => ['select-type','type1','type2','type3']],
            ]
        );
		
		$this->add_control( 'counter_title',
            [
                'label' => esc_html__( 'Counter Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Remaining Time:',
				'label_block' => true,
				'condition' => ['banner_type' => ['type3']],
            ]
        );
		
		$this->add_control('due_date',
			[
				'label' => esc_html__( 'Due Date', 'bevesi-core' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => '2024/06/14',
				'picker_options' => ['enableTime' => false],
				'condition' => ['banner_type' => ['type3']],
			]
		);
		
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'bevesi-core' ),
				'condition' => ['banner_type' => ['select-type','type1','type3']],
            ]
        );
		
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'bevesi-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'bevesi-core' )
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
                'selectors' => ['{{WRAPPER}} .site-banner-inner' => 'text-align: {{VALUE}};'],
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
		
		$this->add_control( 'align_items',
			[
				'label' => esc_html__( 'Align Items', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'start'	  => esc_html__( 'Start', 'bevesi-core' ),
					'center'  => esc_html__( 'Center', 'bevesi-core' ),
					'end'	  => esc_html__( 'End', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_control( 'justify_content',
			[
				'label' => esc_html__( 'Justify Content', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'start',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'start'	  => esc_html__( 'Start', 'bevesi-core' ),
					'center'  => esc_html__( 'Center', 'bevesi-core' ),
					'end'	  => esc_html__( 'End', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_responsive_control( 'desktop_height',
            [
                'label' => esc_html__( 'Desktop Height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => '480',
            ]
        );
		
		$this->add_responsive_control( 'laptop_height',
            [
                'label' => esc_html__( 'Laptop Height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => '480',
            ]
        );
		
		$this->add_responsive_control( 'tablet_height',
            [
                'label' => esc_html__( 'Tablet Height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => '480',
            ]
        );
		
		$this->add_responsive_control( 'mobile_height',
            [
                'label' => esc_html__( 'Mobile Height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => '320',
            ]
        );
		
		$this->add_responsive_control( 'width',
            [
                'label' => esc_html__( 'Width', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .site-banner-inner' => 'width: {{SIZE}}% !important;' ],
            ]
        );
		
		$this->add_responsive_control( 'padding',
            [
                'label' => esc_html__( 'Padding', 'bevesi-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .site-banner-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],              
            ]
        );
		
		$this->add_control( 'banner_color',
			[
               'label' => esc_html__( 'Banner Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .site-banner.banner-color-custom' => 'color: {{VALUE}} !important;']
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
		
		$this->add_responsive_control( 'title_width',
            [
                'label' => esc_html__( 'Title Width', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-title' => 'width: {{SIZE}}% !important;' ],
            ]
        );
		
		$this->add_control( 'title_line_height_style',
            [
                'label' => esc_html__( 'Line-height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .entry-title ' => 'line-height: {{VALUE}}em !important;']
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
		
		$this->add_responsive_control( 'subtitle_width',
            [
                'label' => esc_html__( 'Subtitle Width', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-subtitle' => 'width: {{SIZE}}% !important;' ],
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
		
		$this->add_responsive_control( 'desc_width',
            [
                'label' => esc_html__( 'Description Width', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .entry-description ' => 'width: {{SIZE}}% !important;' ],
            ]
        );
		
		$this->add_control( 'desc_line_height_style',
            [
                'label' => esc_html__( 'Line-height', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .entry-description p ' => 'line-height: {{VALUE}}em !important;']
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
		$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
			
		if($settings['banner_type'] == 'type4'){	
			
			$aligntype= '';
	
			if($settings['align_items'] == 'end'){
				$aligntype .= 'end';
			} elseif($settings['align_items'] == 'start'){	
				$aligntype .= 'start';
			} else {
				$aligntype .= 'center';
			}
			
			$justifytype= '';
		
			if($settings['justify_content'] == 'end'){
				$justifytype .= 'end';
			} elseif($settings['justify_content'] == 'start'){	
				$justifytype .= 'start';
			} else {
				$justifytype .= 'center';
			}
			
			echo '<div class="site-banner banner-align-'.esc_attr($aligntype).' banner-justify-'.esc_attr($justifytype).' banner-color-custom" style="--banner-desktop-height: '.esc_attr($settings['desktop_height']).'px; --banner-laptop-height: '.esc_attr($settings['laptop_height']).'px; --banner-tablet-height: '.esc_attr($settings['tablet_height']).'px; --banner-mobile-height: '.esc_attr($settings['mobile_height']).'px; --banner-color: #6C597C;">';
			echo '<div class="site-banner-content">';
			echo '<div class="site-banner-inner gap-small width-full padding-20 padding-24-desktop">';
			echo '<div class="site-banner-row site-banner-header">';
			echo '<h4 class="entry-subtitle text-sm font-medium">'.esc_html($settings['subtitle']).'</h4>';
			echo '</div><!-- site-banner-row -->';
			echo '<div class="site-banner-row site-banner-body">';
			echo '<h2 class="entry-title text-2xl/6 mobile:text-xl desktop:text-2xl/7 font-bold tracking-tight laptop:mb-3">'.esc_html($settings['title']).'</h2>';
			echo '</div><!-- site-banner-row -->';
			echo '</div><!-- site-banner-inner -->';
			echo '</div><!-- site-banner-content -->';
			echo '<div class="site-banner-image">';
			echo '<img src="'.esc_url($settings['image']['url']).'" alt="">';
			echo '</div><!-- site-banner-image -->';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="site-overlay-link"></a>';
			echo '</div><!-- site-banner -->';
		} elseif($settings['banner_type'] == 'type3'){	
			
			$aligntype= '';
	
			if($settings['align_items'] == 'end'){
				$aligntype .= 'end';
			} elseif($settings['align_items'] == 'start'){	
				$aligntype .= 'start';
			} else {
				$aligntype .= 'center';
			}
			
			$justifytype= '';
		
			if($settings['justify_content'] == 'end'){
				$justifytype .= 'end';
			} elseif($settings['justify_content'] == 'start'){	
				$justifytype .= 'start';
			} else {
				$justifytype .= 'center';
			}
			
			$date = date_create($settings['due_date']);
			
			echo '<div class="site-banner banner-align-'.esc_attr($aligntype).' banner-justify-'.esc_attr($justifytype).' banner-color-custom" style="--banner-desktop-height: '.esc_attr($settings['desktop_height']).'px; --banner-laptop-height: '.esc_attr($settings['laptop_height']).'px; --banner-tablet-height: '.esc_attr($settings['tablet_height']).'px; --banner-mobile-height: '.esc_attr($settings['mobile_height']).'px; --banner-color: #584F46;">';
			echo '<div class="site-banner-content flex-col">';
			echo '<div class="site-banner-inner gap-small width-70 width-80-tablet width-60-desktop padding-24 padding-36-mobile padding-46-laptop">';
			echo '<div class="site-banner-row site-banner-header">';
			echo '<h4 class="entry-subtitle text-sm font-medium">'.esc_html($settings['subtitle']).'</h4>';
			echo '</div><!-- site-banner-row -->';
			echo '<div class="site-banner-row site-banner-body">';
			echo '<h2 class="entry-title text-[26px] mobile:text-4xl desktop:text-5xl font-bold tracking-tight laptop:mb-3">'.esc_html($settings['title']).'</h2>';
			echo '<div class="entry-description">';
			echo '<p class="text-sm laptop:text-base">'.esc_html($settings['desc']).'</p>';
			echo '</div><!-- entry-description -->';
			echo '</div><!-- site-banner-row -->';
			
			if($settings['btn_title']){
				echo '<div class="site-banner-row site-banner-footer">';
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button white shadow-style">'.esc_html($settings['btn_title']).'</a>';
				echo '</div><!-- site-banner-row -->';
			}
			
			echo '</div><!-- site-banner-inner -->';
			echo '<div class="site-banner-row w-full mt-auto padding-24 padding-36-mobile padding-46-laptop">';
			echo '<span class="block text-xs font-medium mb-1.5">'.esc_html($settings['counter_title']).'</span>';
			echo '<div class="banner-countdown-wrapper inline-flex background-white">';
			echo '<div class="site-countdown countdown-size-1" data-date="'.esc_attr(date_format($date,"Y/m/d")).'" data-text="'.esc_attr__('Expired','bevesi-core').'">';
			echo '<div class="countdown-item">';
			echo '<div class="countdown-value days">00</div>';
			echo '</div><!-- countdown-item -->';
			echo '<span class="countdown-seperator">:</span>';
			echo '<div class="countdown-item">';
			echo '<div class="countdown-value hours">00</div>';
			echo '</div><!-- countdown-item -->';
			echo '<span class="countdown-seperator">:</span>';
			echo '<div class="countdown-item">';
			echo '<div class="countdown-value minutes">00</div>';
			echo '</div><!-- countdown-item -->';
			echo '<span class="countdown-seperator">:</span>';
			echo '<div class="countdown-item">';
			echo '<div class="countdown-value second">00</div>';
			echo '</div><!-- countdown-item -->';
			echo '</div><!-- site-countdown -->';
			echo '</div><!-- banner-countdown-wrapper -->';
			echo '</div><!-- site-banner-row -->';
			echo '</div><!-- site-banner-content -->';
			echo '<div class="site-banner-image">';
			echo '<img src="'.esc_url($settings['image']['url']).'" alt="">';
			echo '</div><!-- site-banner-image -->';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="site-overlay-link"></a>';
			echo '</div><!-- site-banner -->';
		} elseif($settings['banner_type'] == 'type2'){
			
			
			$justifytype= '';
		
			if($settings['justify_content'] == 'end'){
				$justifytype .= 'end';
			} elseif($settings['justify_content'] == 'start'){	
				$justifytype .= 'start';
			} else {
				$justifytype .= 'center';
			}
			
			echo '<div class="site-banner banner-align-stert banner-justify-'.esc_attr($justifytype).' banner-color-custom" style="--banner-desktop-height: '.esc_attr($settings['desktop_height']).'px; --banner-laptop-height: '.esc_attr($settings['laptop_height']).'px; --banner-tablet-height: '.esc_attr($settings['tablet_height']).'px; --banner-mobile-height: '.esc_attr($settings['mobile_height']).'px; --banner-color: #5F5D66;">';
			echo '<div class="site-banner-content">';
			echo '<div class="site-banner-inner gap-small width-full padding-24 padding-30-mobile padding-40-laptop">';
			echo '<div class="site-banner-row site-banner-header">';
			echo '<h4 class="entry-subtitle text-sm font-medium">'.esc_html($settings['subtitle']).'</h4>';
			echo '<h2 class="entry-title text-[26px] tablet:text-4xl font-bold tracking-tight laptop:mb-3">'.esc_html($settings['title']).'</h2>';
			echo '</div><!-- site-banner-row -->';
			echo '<div class="site-banner-row site-banner-body mt-auto">';
			echo '<div class="entry-description">';
			echo '<p class="text-sm tablet:text-base">'.esc_html($settings['desc']).'</p>';
			echo '</div><!-- entry-description -->';
			echo '</div><!-- site-banner-row -->';
			echo '</div><!-- site-banner-inner -->';
			echo '</div><!-- site-banner-content -->';
			echo '<div class="site-banner-image">';
			echo '<img src="'.esc_url($settings['image']['url']).'" alt="">';
			echo '</div><!-- site-banner-image -->';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="site-overlay-link"></a>';
			echo '</div><!-- site-banner -->';
		} else {
			
			$aligntype= '';
	
			if($settings['align_items'] == 'end'){
				$aligntype .= 'end';
			} elseif($settings['align_items'] == 'start'){	
				$aligntype .= 'start';
			} else {
				$aligntype .= 'center';
			}
			
			$justifytype= '';
		
			if($settings['justify_content'] == 'end'){
				$justifytype .= 'end';
			} elseif($settings['justify_content'] == 'start'){	
				$justifytype .= 'start';
			} else {
				$justifytype .= 'center';
			}
			
			echo '<div class="site-banner banner-align-'.esc_attr($aligntype).' banner-justify-'.esc_attr($justifytype).' banner-color-custom" style="--banner-desktop-height: '.esc_attr($settings['desktop_height']).'px; --banner-laptop-height: '.esc_attr($settings['laptop_height']).'px; --banner-tablet-height: '.esc_attr($settings['tablet_height']).'px; --banner-mobile-height: '.esc_attr($settings['mobile_height']).'px; --banner-color: #746350;">';
			echo '<div class="site-banner-content">';
			echo '<div class="site-banner-inner gap-small width-60 width-80-tablet width-50-desktop padding-24 padding-36-mobile padding-60-laptop">';
			echo '<div class="site-banner-row site-banner-header">';
			echo '<h4 class="entry-subtitle text-sm font-medium">'.esc_html($settings['subtitle']).'</h4>';
			echo '</div><!-- site-banner-row -->';
			echo '<div class="site-banner-row site-banner-body">';
			echo '<h2 class="entry-title text-[26px] mobile:text-[40px] desktop:text-5xl/tight font-bold tracking-tight laptop:mb-3">'.esc_html($settings['title']).'</h2>';
			echo '<div class="entry-description">';
			echo '<p class="text-sm tablet:text-base">'.esc_html($settings['desc']).'</p>';
			echo '</div><!-- entry-description -->';
			echo '</div><!-- site-banner-row -->';
			
			if($settings['btn_title']){
				echo '<div class="site-banner-row site-banner-footer">';
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button white shadow-style">'.esc_html($settings['btn_title']).'</a>';
				echo '</div><!-- site-banner-row -->';
			}
			
			echo '</div><!-- site-banner-inner -->';
			echo '</div><!-- site-banner-content -->';
			echo '<div class="site-banner-image">';
			echo '<img src="'.esc_url($settings['image']['url']).'" alt="">';
			echo '</div><!-- site-banner-image -->';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="site-overlay-link"></a>';
			echo '</div><!-- site-banner -->';
		}	

	}

}
