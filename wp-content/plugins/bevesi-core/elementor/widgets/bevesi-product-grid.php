<?php

namespace Elementor;

class Bevesi_Product_Grid_Widget extends Widget_Base {
    use Bevesi_Helper;

    public function get_name() {
        return 'bevesi-product-grid';
    }
    public function get_title() {
        return esc_html__('Product Grid (K)', 'bevesi-core');
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
		
		$this->add_control( 'grid_type',
			[
				'label' => esc_html__( 'Product Grid Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' 	=> esc_html__( 'Select Type', 'bevesi-core' ),
					'type1' 		=> esc_html__( 'Type 1', 'bevesi-core' ),
					'type2'			=> esc_html__( 'Type 2', 'bevesi-core' ),
				],
			]
		);
		
		
		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
		
		/***** START QUERY CONTROLS SECTION *****/
		$this->bevesi_query_elementor_controls($post_count = 4, $column = 4);
		/***** END QUERY CONTROLS SECTION *****/

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$output = '';
		
		$gridtype= '';
		
		if($settings['grid_type'] == 'type2'){
			$gridtype .= 'product-center';
		} else {
			$gridtype .= '';
		}
		
		
		$output .= '<div class="products product-grid-style grid-column-'.esc_attr($settings['mobile_column']).'-mobile grid-column-'.esc_attr($settings['column']).' grid-gap-20 '.esc_attr($gridtype).'">';
		$output .= $this->bevesi_elementor_product_loop($settings);  
		$output .= '</div><!-- products -->';
		
		echo $output;
			
		
	}

}
