<?php

namespace Elementor;

class Bevesi_Product_Tab_Carousel_Widget extends \Elementor\Widget_Base {
    use Bevesi_Helper;
    public function get_name() {
        return 'bevesi-product-tab-carousel';
    }
    public function get_title() {
        return esc_html__('Product Tab Carousel (K)', 'bevesi-core');
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
				'label' => esc_html__( 'Products', 'bevesi-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'header_type',
			[
				'label' => esc_html__( 'Header Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' 	=> esc_html__( 'Select Type', 'bevesi-core' ),
					'type1' 	=> esc_html__( 'Style 1', 'bevesi-core' ),
					'type2'		=> esc_html__( 'Style 2', 'bevesi-core' ),
					'type3'		=> esc_html__( 'Style 3', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Limited Campaign',				
            ]
        );
		
		$this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'bevesi-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View All Products',
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
                'default' => '1600',
                'pleaceholder' => esc_html__( 'Set auto speed.', 'bevesi-core' ),
				'condition' => ['auto_play' => 'true']
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

		$this->add_control( 'dots',
			[
				'label' => esc_html__( 'Dots', 'bevesi-core' ),
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
                'default' => '600',
                'pleaceholder' => esc_html__( 'Set slide speed.', 'bevesi-core' ),
            ]
        );
		
		$this->end_controls_section();
		
		/*****   END CONTROLS SECTION   ******/
		
		/***** START QUERY CONTROLS SECTION *****/
		$this->bevesi_query_elementor_controls($post_count = 8, $column = 6, $default_type = 'type2');
		/***** END QUERY CONTROLS SECTION *****/

	}

	protected function render() {

		return true;
		
		$settings = $this->get_settings_for_display();

		$output = '';
		$cat_filter = '';

		
		$include = array();
		$exclude = array();
			
		$portfolio_filters = get_terms(array(
			'taxonomy' => 'product_cat',
			'include' => $settings['cat_filter'],
		));
		
		$headertype= '';
		
		if($settings['header_type'] == 'type3'){
			$headertype .= 'style-3 bordered';
		} elseif($settings['header_type'] == 'type2'){	
			$headertype .= 'style-2';
		} else {
			$headertype .= 'style-1';
		}
		
		
			
			if($portfolio_filters){
				
				$cat_filter .= '<div class="col left">';
				if($settings['title']){
					$cat_filter .= '<h3 class="entry-title">'.esc_html($settings['title']).'</h3>';
				}
				$cat_filter .= '<div class="module-header-tab">';
				$cat_filter .= '<ul>';
				
				foreach($portfolio_filters as $portfolio_filter){
						
					$active_class = '';
					if(reset($settings['cat_filter']) == $portfolio_filter->term_id){
						$active_class .= 'active';
					}
					
					$cat_filter .= '<li class=""><a class="'.esc_attr($active_class).' tab-link" href="#'.esc_attr($portfolio_filter->slug).'" id="'.esc_attr($portfolio_filter->term_id).'">'.esc_html($portfolio_filter->name).'</a></li>';
					
				}
                 
				$cat_filter .= '</ul>';
				$cat_filter .= '</div><!-- module-header-tab -->';
				$cat_filter .= '</div><!-- col -->';
				
				if($settings['btn_title']){
					$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
						
					$cat_filter .= '<div class="col right">';
					$cat_filter .= '<div class="module-header-button">';
					$cat_filter .= '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="button link">'.esc_html($settings['btn_title']).'</a>';
					$cat_filter .= '</div><!-- module-header-button -->';
					$cat_filter .= '</div><!-- col -->';
				}
				
			}
				
				$output .= '<div class="site-slider carousel-style loader-default arrows-style-rounded arrows-white products" data-items="'.esc_attr($settings['column']).'" data-itemslaptop="4" data-itemstablet="'.esc_attr($settings['tablet_column']).'" data-itemsmobile="'.esc_attr($settings['mobile_column']).'" data-itemsmobilexs="1" data-slidescroll="1" data-autoplay="'.esc_attr($settings['auto_play']).'"  data-autospeed="'.esc_attr($settings['auto_speed']).'" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="true" data-arrowstablet="'.esc_attr($settings['arrows']).'" data-arrowsmobile="'.esc_attr($settings['arrows']).'" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="true" data-dotstablet="'.esc_attr($settings['dots']).'" data-dotsmobile="'.esc_attr($settings['dots']).'" data-producttype="'.esc_attr($settings['product_type']).'" data-perpage="'.esc_attr($settings['post_count']).'" data-best_selling="'.esc_attr($settings['best_selling']).'" data-featured="'.esc_attr($settings['featured']).'" data-onsale="'.esc_attr($settings['on_sale']).'" data-stockprogressbar="'.esc_attr($settings['stock_progressbar']).'" data-countdown="'.esc_attr($settings['product_box_countdown']).'" data-stockstatus="'.esc_attr($settings['stock_status']).'" data-shippingclass="'.esc_attr($settings['shipping_class']).'" data-infinite="false" data-centermode="false" data-autoplay="false">';
				$output .= $this->bevesi_elementor_product_loop($settings, $productslider = 'yes', $widget = 'tabcarousel');		
				$output .= '</div>';
				
				
		echo  '<div class="klb-module">
				  <div class="site-module-header '.esc_attr($headertype).'">
					'.$cat_filter.'
				  </div>
				  <div class="klb-products-tab site-slider-wrapper">
					'.$output.'
				  </div>
				</div>';		
		
		
	}

}
