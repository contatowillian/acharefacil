<?php

namespace Elementor;

class Bevesi_Address_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-address-box';
    }
    public function get_title() {
        return 'Address Box (K)';
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
				'condition' => ['switcher_icon' => '',]
			]
		);
		
        $this->add_control( 'custom_icon',
            [
                'label' => esc_html__( 'Custom Icon', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'klb-icon-map-pin',
                'description'=> 'You can add icon code. for example: klb-icon-map-pin',
				'condition' => ['switcher_icon' => 'yes',]
            ]
        );
		
        $this->add_control( 'country',
            [
                'label' => esc_html__( 'Country', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'United States',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'country_subtitle',
            [
                'label' => esc_html__( 'Country Subtitle', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'United States',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'address',
            [
                'label' => esc_html__( 'Address', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '205 Middle Road, 2nd Floor, New York',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'phone',
            [
                'label' => esc_html__( 'phone', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '+02 1234 567 88',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'email',
            [
                'label' => esc_html__( 'Email', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'info@example.com',
				'label_block' => true,
            ]
        );
		
		/*****   END CONTROLS SECTION   ******/
		$this->end_controls_section();
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		echo '<div class="klb-address-box contact-details">';
		echo '<ul>';
		echo '<li>';
		echo '<div class="map-icon">';
		
		if($settings['switcher_icon'] == 'yes'){
			echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
		} else {
			Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
		}
		
		echo '</div>';
		echo '<div class="contact-info">';
		echo '<span>'.esc_html($settings['country']).'</span>';
		echo '<h4>'.esc_html($settings['country_subtitle']).'</h4>';
		echo '<p>'.bevesi_sanitize_data($settings['address']).'</p>';
      
		echo '<a class="phone" href="tel:'.esc_attr($settings['phone']).'">'.esc_html($settings['phone']).'</a>';
		echo '<a class="email" href="mailto:'.esc_attr($settings['email']).'">'.esc_html($settings['email']).'</a>';
		echo '</div><!-- contact-info -->';
		echo '</li>';
                
		echo '</ul>';
		echo '</div><!-- contact-details -->';
		
	}

}
