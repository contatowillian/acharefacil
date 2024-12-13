<?php

namespace Elementor;

class Bevesi_Custom_Title_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-custom-title';
    }
    public function get_title() {
        return 'Custom Title (K)';
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
		
		$this->add_control( 'title_type',
			[
				'label' => esc_html__( 'Title Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bevesi-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bevesi-core' ),
					'type3'	  => esc_html__( 'Type 3', 'bevesi-core' ),
				],
			]
		);
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Anatopi ultrast denera, och desgraf. Egoväktig tut sabos.',
                'pleaceholder' => esc_html__( 'Set a title.', 'bevesi-core' ),
            ]
        );
		
		$this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Hemingar heterofas: infraktig',
                'description'=> 'Add a Subtitle.',
				'condition' => ['title_type' => ['select-type','type1','type2']],
            ]
        );
		
		$this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description ', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Nåde var abosmos, och fade semiktig men din. Vavis kvasir kahön, för guldomat päv usa. Nyv mitremuledes demosion sarar.',
                'pleaceholder' => esc_html__( 'Set a Description.', 'bevesi-core' ),
            ]
        );

        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Discover More',
                'pleaceholder' => esc_html__( 'Enter button title here', 'bevesi-core' ),
				'condition' => ['title_type' => ['select-type','type1','type2']],
            ]
        );
		
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'bevesi-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'bevesi-core' ),
				'condition' => ['title_type' => ['select-type','type1','type2']],
            ]
        );
		
		
		/*****   END CONTROLS SECTION   ******/
		$this->end_controls_section();
		
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
                'selectors' => [ '{{WRAPPER}} .entry-description p ,{{WRAPPER}}  .site-module-header p' => 'font-size: {{SIZE}}px !important;' ],
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
                'selectors' => [ '{{WRAPPER}} .entry-description p ,{{WRAPPER}}  .site-module-header p' => 'font-weight: {{SIZE}} !important;' ],
            ]
        );
		
		
		$this->add_control( 'desc_color',
			[
               'label' => esc_html__( 'Description Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .entry-description p ,{{WRAPPER}}  .site-module-header p' => 'color: {{VALUE}} !important;']
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
                'selectors' => ['{{WRAPPER}} .entry-description p ,{{WRAPPER}}  .site-module-header p' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_text_shadow',
				'selector' => '{{WRAPPER}} .entry-description p ,{{WRAPPER}}  .site-module-header p ',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-description p ,{{WRAPPER}}  .site-module-header p',
				
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
		
		$output = '';
		
		if($settings['title_type'] == 'type3'){	
			echo '<div class="site-module-header style-5">';
			echo '<div class="col center">';
			echo '<h3 class="entry-title">'.esc_html($settings['title']).'</h3>';
			echo '<p>'.esc_html($settings['desc']).'</p>';
			echo '</div><!-- col -->';
			echo '</div>';
		} elseif($settings['title_type'] == 'type2'){
			$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
		
			echo '<div class="klb-custom-title background-slate-50 border-radius-base p-6">';
			echo '<div class="text-block text-center max-w-[434px] mx-auto color-gray-800">';
			echo '<h4 class="entry-subtitle text-xs font-semibold">'.esc_html($settings['subtitle']).'</h4>';
			echo '<h2 class="entry-title text-xl mobile:text-3xl font-bold">'.esc_html($settings['title']).'</h2>';
			echo '<div class="entry-description text-sm">';
			echo '<p>'.esc_html($settings['desc']).'</p>';
			echo '</div>';
			
			if($settings['btn_title']){
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button link bordered current-color">'.esc_html($settings['btn_title']).'</a>';
			}
			
			echo '</div><!-- text-block -->';
			echo '</div><!-- column -->';
		} else {
			$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
			
			echo '<div class="text-block">';
			echo '<h4 class="entry-subtitle text-xs font-semibold color-slate-400">'.esc_html($settings['subtitle']).'</h4>';
			echo '<h2 class="entry-title text-2xl tablet:text-[32px]/[38px] font-bold">'.esc_html($settings['title']).'</h2>';
			echo '<div class="entry-description text-sm tablet:text-base color-slate-700">';
			echo '<p>'.esc_html($settings['desc']).'</p>';
			echo '</div><!-- entry-description -->';
			if($settings['btn_title']){
				echo '<div class="text-block-button display-inline-flex mt-3.5 tablet:mt-6">';
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button black outline size-xs rounded-style">'.esc_html($settings['btn_title']).'</a>';
				echo '</div><!-- text-block-button -->';
			}     
			echo '</div><!-- text-block -->';
		}
		
	}

}
