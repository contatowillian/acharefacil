<?php

namespace Elementor;

class Bevesi_Counter_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-counter-banner';
    }
    public function get_title() {
        return esc_html__('Counter Banner (K)', 'bevesi-core');
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
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'BIGGEST',
                'description'=> 'Add a title.',
				'label_block' => true,
            ]
        );
		
		$this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'FRIDAY SALE',
                'description'=> 'Add a Subtitle.',
            ]
        );
		
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Now is the time to take advantage of a limited number of discounts.',
                'description'=> 'Add a description.',
				'label_block' => true,
            ]
        );
		
		$this->add_control( 'counter_title',
            [
                'label' => esc_html__( 'Counter Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Remains until the end of the offer',
                'description'=> 'Add a title.',
				'label_block' => true,
            ]
        );
		
		$this->add_control('due_date',
			[
				'label' => esc_html__( 'Due Date', 'bevesi-core' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => '2024/05/14',
				'picker_options' => ['enableTime' => false],
			]
		);
		
		$this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All Products',
                'pleaceholder' => esc_html__( 'Enter button title here', 'bevesi-core' ),
            ]
        );
		
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'bevesi-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'bevesi-core' ),
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
		
		$this->add_control( 'title_bgcolor',
			[
               'label' => esc_html__( 'Title Background Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .entry-title' => 'background-color: {{VALUE}} !important;']
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
                'selectors' => [ '{{WRAPPER}} .second-title' => 'font-size: {{SIZE}}px !important;' ],
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
                'selectors' => [ '{{WRAPPER}} .second-title' => 'font-weight: {{SIZE}} !important;' ],
            ]
        );
		
		$this->add_control( 'subtitle_color',
			[
               'label' => esc_html__( 'Subtitle Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .second-title' => 'color: {{VALUE}} !important;'],
			]
        );
		
		$this->add_control( 'subtitle_bgcolor',
			[
               'label' => esc_html__( 'Subtitle Background Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .second-title' => 'background-color: {{VALUE}} !important;'],
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
                'selectors' => ['{{WRAPPER}} .second-title ' => 'opacity: {{VALUE}} ;'],
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_text_shadow',
				'selector' => '{{WRAPPER}} .second-title',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .second-title',
				
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
		$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
			
		$output = '';
		
		$date = date_create($settings['due_date']);
		
		echo '<div class="site-text-block background-slate-50 border-radius-base height-full display-flex align-items-center justify-content-center padding-24 padding-36-laptop">';
		echo '<div class="text-block-inner">';
		echo '<div class="text-block-color-header text-center">';
		echo '<h4 class="entry-title display-inline-flex text-xl font-black mb-0 background-sky-500 color-white">'.esc_html($settings['title']).'</h4>';
		echo '<h4 class="second-title display-inline-flex text-xl font-black mb-0 background-rose-500 color-white">'.esc_html($settings['subtitle']).'</h4>';
		echo '</div><!-- text-block-color-header -->';
		echo '<div class="entry-description text-sm color-slate-500 text-center">';
		echo '<p>'.esc_html($settings['desc']).'</p>';
		echo '</div><!-- entry-description -->';
		echo '<div class="site-countdown countdown-size-1" data-date="'.esc_attr(date_format($date,"Y/m/d")).'" data-text="'.esc_attr__('Expired','bevesi-core').'">';
		echo '<div class="countdown-item filled color-black border-1-solid border-color-black border-radius-small">';
		echo '<div class="countdown-value days">00</div>';
		echo '</div><!-- countdown-item -->';
		echo '<div class="countdown-item filled color-black border-1-solid border-color-black border-radius-small">';
		echo '<div class="countdown-value hours">00</div>';
		echo '</div><!-- countdown-item -->';
		echo '<div class="countdown-item filled color-black border-1-solid border-color-black border-radius-small">';
		echo '<div class="countdown-value minutes">00</div>';
		echo '</div><!-- countdown-item -->';
		echo '<span class="countdown-seperator">:</span>';
		echo '<div class="countdown-item filled color-black border-1-solid border-color-black border-radius-small">';
		echo '<div class="countdown-value second">00</div>';
		echo '</div><!-- countdown-item -->';
		echo '</div><!-- site-countdown -->';
		echo '<span class="display-block text-xs color-slate-400 text-center">'.esc_html($settings['counter_title']).'</span>';
		if($settings['btn_title']){
			echo '<div class="text-block-button display-inline-flex justify-content-center width-full mt-4">';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button black rounded-style size-xs">'.esc_html($settings['btn_title']).'</a>';
			echo '</div><!-- text-block-button -->';
		}
		echo '</div><!-- text-block-inner -->';
		echo '</div><!-- site-text-block -->';
		
	}

}
