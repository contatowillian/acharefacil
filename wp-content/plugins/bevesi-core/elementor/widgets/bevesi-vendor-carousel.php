<?php

namespace Elementor;

class Bevesi_Vendor_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-vendor-carousel';
    }
    public function get_title() {
        return esc_html__('Vendor Carousel (K)', 'bevesi-core');
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
		
		$this->add_control( 'column',
			[
				'label' => esc_html__( 'Column', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'1' 	  => esc_html__( '1 Columns', 'bevesi-core' ),
					'2' 	  => esc_html__( '2 Columns', 'bevesi-core' ),
					'3'		  => esc_html__( '3 Columns', 'bevesi-core' ),
					'4'		  => esc_html__( '4 Columns', 'bevesi-core' ),
					'5'		  => esc_html__( '5 Columns', 'bevesi-core' ),
					'6'		  => esc_html__( '6 Columns', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_control( 'mobile_column',
			[
				'label' => esc_html__( 'Mobile Column', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'1' 	  => esc_html__( '1 Column', 'bevesi-core' ),
					'2'		  => esc_html__( '2 Columns', 'bevesi-core' ),
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
                'default' => '1200',
                'pleaceholder' => esc_html__( 'Set slide speed.', 'bevesi-core' ),
            ]
        );
		
		/*****   END CONTROLS SECTION   ******/
		
		$this->end_controls_section();
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		echo '<div class="site-slider-wrapper">';
		echo '<div class="site-slider carousel-style loader-default arrows-style-rounded arrows-white site-vendors" data-items="'.esc_attr($settings['column']).'" data-itemslaptop="3" data-itemstablet="2" data-itemsmobile="'.esc_attr($settings['mobile_column']).'" data-itemsmobilexs="1" data-slidescroll="1" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="false" data-arrowstablet="false" data-arrowsmobile="false" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="false" data-dotstablet="true" data-dotsmobile="true" data-infinite="false" data-centermode="false" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'">';
        
		$sellers = dokan_get_sellers();
	
	    foreach ($sellers['users'] as $seller){			
			
			$vendor                   = dokan()->vendor->get( $seller->ID );	
			$user_description 		  = get_the_author_meta( 'description', $seller->ID );
			$store_banner_id          = $vendor->get_banner_id();
			$store_name               = $vendor->get_shop_name();
			$store_url                = $vendor->get_shop_url();
			$store_rating             = $vendor->get_rating();
			$is_store_featured        = $vendor->is_featured();
			$store_phone              = $vendor->get_phone();
			$store_info               = dokan_get_store_info( $seller->ID );
			$store_address            = dokan_get_seller_short_address( $seller->ID );
			$store_banner_url         = $store_banner_id ? wp_get_attachment_image_src( $store_banner_id ) : '';
			$show_store_open_close    = dokan_get_option( 'store_open_close', 'dokan_appearance', 'on' );
			$dokan_store_time_enabled = isset( $store_info['dokan_store_time_enabled'] ) ? $store_info['dokan_store_time_enabled'] : '';
			$store_open_is_on         = ( 'on' === $show_store_open_close && 'yes' === $dokan_store_time_enabled && ! $is_store_featured ) ? 'store_open_is_on' : '';
				
			echo '<div class="slider-item">';
			echo '<div class="site-vendor-box">';
			echo '<div class="site-vendor-brand">';
			echo '<a href="'.esc_url($store_url ).'"><img src="'.esc_url( $vendor->get_avatar() ).'"></a>';
			echo '</div><!-- site-vendor-brand -->';
			echo '<div class="site-vendor-content">';
			echo '<div class="site-vendor-header">';
			echo '<h3 class="site-vendor-name"><a href="'.esc_url($store_url ).'">'.esc_html($store_name ).'</a></h3>';
			echo '<div class="site-vendor-link">';
			echo '<a href="'.esc_url($store_url ).'"><i class="klb-icon-arrow-up-right-from-square"></i></a>';
			echo '</div><!-- site-vendor-link -->';
			echo '</div><!-- site-vendor-header -->';
			
			if ( $user_description ){
				echo '<div class="site-vendor-content">';
				echo '<p>'.esc_html($user_description ).'</p>';
				echo '</div><!-- site-vendor-content -->';
			}
			
			echo '<div class="product-rating black">';
			echo wc_get_rating_html($store_rating['rating'], $store_rating['count'] );
			echo '<div class="rating-count">';
			echo '<span class="count-text">'.esc_html($store_rating['count']).'</span>';
			echo '</div><!-- rating-count -->';
			echo '</div><!-- product-rating -->';        
			echo '</div><!-- site-vendor-content -->';
			echo '</div><!-- site-vendor-box -->';
			echo '</div><!-- slider-item -->';
        }       
          
		echo '</div><!-- site-slider -->';
		echo '</div><!-- site-slider-wrapper -->';
		
	}

}
