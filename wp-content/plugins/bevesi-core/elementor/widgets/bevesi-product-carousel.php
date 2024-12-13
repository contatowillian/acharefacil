<?php

namespace Elementor;

class Bevesi_Product_Carousel_Widget extends Widget_Base {
    use Bevesi_Helper;

    public function get_name() {
        return 'bevesi-product-carousel';
    }
    public function get_title() {
        return 'Product Carousel (K)';
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
                'label' => esc_html__( 'Auto Speed', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '1600',
                'pleaceholder' => esc_html__( 'Set auto speed.', 'chakta' ),
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
				'default' => 'false',
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

		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
		
		/***** START QUERY CONTROLS SECTION *****/
		$this->bevesi_query_elementor_controls($post_count = 8, $column = 5, $carousel = 'yes');
		/***** END QUERY CONTROLS SECTION *****/
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	
		$output = '';
		
		$output .= '<div class="site-slider-wrapper">';
		$output .= '<div class="site-slider carousel-style loader-default arrows-style-rounded arrows-white products" data-items="'.esc_attr($settings['column']).'" data-itemslaptop="3" data-itemstablet="'.esc_attr($settings['tablet_column']).'" data-itemsmobile="'.esc_attr($settings['mobile_column']).'" data-itemsmobilexs="1" data-slidescroll="1" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="'.esc_attr($settings['arrows']).'" data-arrowstablet="'.esc_attr($settings['arrows']).'" data-arrowsmobile="'.esc_attr($settings['arrows']).'" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="'.esc_attr($settings['dots']).'" data-dotstablet="'.esc_attr($settings['dots']).'" data-dotsmobile="'.esc_attr($settings['dots']).'" data-infinite="false" data-centermode="false" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'">';
        $output .= $this->bevesi_elementor_product_loop($settings, $productslider = 'yes');	               
		$output .= '</div><!-- site-slider -->';
		$output .= '</div><!-- site-slider-wrapper-->';
		
		echo $output;
	}

}
