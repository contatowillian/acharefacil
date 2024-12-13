<?php

namespace Elementor;

class Bevesi_Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-icon-box';
    }
    public function get_title() {
        return esc_html__('Icon Box (K)', 'bevesi-core');
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
		
		$this->add_control( 'box_type',
			[
				'label' => esc_html__( 'Box Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bevesi-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bevesi-core' ),
					'type3'	  => esc_html__( 'Style 3', 'bevesi-core' ),
				],
			]
		);
		
		$defaultbg = plugins_url( 'images/icon-box-01.png', __DIR__ );
		
		$this->start_controls_tabs( 'icon_tabs');
		$this->start_controls_tab( 'image_tab',
			[ 'label'  => esc_html__( 'Image', 'bevesi-core' ) ]
		);
		
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'bevesi-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
		
		/*****   END CONTROLS TAB ******/
		$this->end_controls_tab();
		/*****  CONTROLS TAB START   ******/
        $this->start_controls_tab( 'icon_tab',
            [ 'label' => esc_html__( 'Icon', 'bevesi-core' ) ]
        );
		
		$this->add_control(
			'switcher_icon',
			[
				'label' => esc_html__( 'Use Custom Icon', 'bevesi-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'bevesi-core' ),
				'label_off' => esc_html__( 'No', 'bevesi-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bevesi-core' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brands',
				],
                'label_block' => true,
				'condition' => ['switcher_icon' => '']
			]
		);
		
        $this->add_control( 'custom_icon',
            [
                'label' => esc_html__( 'Custom Icon', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'klb-icon-discount-solid',
                'description'=> 'You can add icon code. for example: klb-icon-discount-solid',
				'condition' => ['switcher_icon' => 'yes']
            ]
        );
		
		$this->end_controls_tab();
        $this->end_controls_tabs();
		/*****   END CONTROLS TABS ******/

       $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter title here', 'bevesi-core' ),
                'default' => 'Opportunity Discounts',
				'condition' => ['box_type' => ['select-type','type1','type2']],
            ]
        );
		
       $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter desc here', 'bevesi-core' ),
                'default' => 'Tasigförsamhet beteendedesign. Mobile checkout. Ylig kärrtorpa.',
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
		
		$this->add_control( 'icon_heading',
            [
                'label' => esc_html__( 'ICON', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
		
		$this->add_control( 'icon_color',
           [
               'label' => esc_html__( 'Icon Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}}  .site-iconbox-icon' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'icon_hvrcolor',
           [
               'label' => esc_html__( 'Icon Hover Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .site-iconbox-icon:hover' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'icon_text_shadow',
				'selector' => '{{WRAPPER}} .site-iconbox-icon',
			]
		);
		
		$this->add_control( 'icon_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .site-iconbox-icon' => 'opacity: {{VALUE}};'],
				
            ]
        );
		
		$this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'title_color',
           [
               'label' => esc_html__( 'Title Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .entry-title' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'title_hvrcolor',
           [
               'label' => esc_html__( 'Title Hover Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}}  .entry-title:hover' => 'color: {{VALUE}};']
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
		
		$this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'bevesi-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
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
		
		$this->add_control( 'desc_hvrcolor',
           [
               'label' => esc_html__( 'Description Hover Color', 'bevesi-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}}  .entry-description p:hover' => 'color: {{VALUE}} !important;']
           ]
        );
		
		$this->add_control( 'desc_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bevesi-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .entry-description p' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_text_shadow',
				'selector' => '{{WRAPPER}} .entry-description p',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Typography', 'bevesi-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-description p',
				
            ]
        );
		
		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$output = '';
		
		$boxtype= '';
	
		if($settings['box_type'] == 'type3'){
			$boxtype .= 'style-3';
		} elseif($settings['box_type'] == 'type2'){	
			$boxtype .= 'style-2';
		} else {
			$boxtype .= 'style-1';
		}
		
		echo '<div class="site-iconbox '.esc_attr($boxtype).'">';
		echo '<div class="site-iconbox-icon">';
		
		if($settings['image']['url']){
			echo '<img src="'.esc_url($settings['image']['url']).'">';
		} else {
			if($settings['switcher_icon'] == 'yes'){
				echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
			} else {
				Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
			}
		}	
		
		echo '</div><!-- site-iconbox-icon -->';
		echo '<div class="site-iconbox-content">';
		
		if($settings['title']){
			echo '<h4 class="entry-title">'.esc_html($settings['title']).'</h4>';
		}
		
		if($settings['desc']){
			echo '<div class="entry-description">';
			echo '<p>'.bevesi_sanitize_data($settings['desc']).'</p>';
			echo '</div><!-- entry-description -->';
		}
		
		echo '</div><!-- site-iconbox-content -->';
		echo '</div><!-- site-iconbox -->';
		
	}

}
