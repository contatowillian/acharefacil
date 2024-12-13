<?php

namespace Elementor;

class Bevesi_Client_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'bevesi-client-carousel';
    }
    public function get_title() {
        return 'Client Carousel (K)';
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
				'default' => '8',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'1' 	  => esc_html__( '1 Columns', 'bevesi-core' ),
					'2'		  => esc_html__( '2 Columns', 'bevesi-core' ),
					'3'		  => esc_html__( '3 Columns', 'bevesi-core' ),
					'4'		  => esc_html__( '4 Columns', 'bevesi-core' ),
					'5'		  => esc_html__( '5 Columns', 'bevesi-core' ),
					'6'		  => esc_html__( '6 Columns', 'bevesi-core' ),
					'7'		  => esc_html__( '7 Columns', 'bevesi-core' ),
					'8'		  => esc_html__( '8 Columns', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_control( 'mobile_column',
			[
				'label' => esc_html__( 'Mobile Column', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'1' 	  => esc_html__( '1 Column', 'bevesi-core' ),
					'2'		  => esc_html__( '2 Columns', 'bevesi-core' ),
					'3'		  => esc_html__( '3 Columns', 'bevesi-core' ),
					'4'		  => esc_html__( '4 Columns', 'bevesi-core' ),
				],
			]
		);
		
		$this->add_control( 'tablet_column',
			[
				'label' => esc_html__( 'Tablet Column', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'1' 	  => esc_html__( '1 Columns', 'bevesi-core' ),
					'2'		  => esc_html__( '2 Columns', 'bevesi-core' ),
					'3'		  => esc_html__( '3 Columns', 'bevesi-core' ),
					'4'		  => esc_html__( '4 Columns', 'bevesi-core' ),
					'5'		  => esc_html__( '5 Columns', 'bevesi-core' ),
					'6'		  => esc_html__( '6 Columns', 'bevesi-core' ),
					'7'		  => esc_html__( '7 Columns', 'bevesi-core' ),
					'8'		  => esc_html__( '8 Columns', 'bevesi-core' ),
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
                'default' => '700',
                'pleaceholder' => esc_html__( 'Set slide speed.', 'bevesi-core' ),
            ]
        );
		
		$defaultbg = plugins_url( 'images/logo-01.png', __DIR__ );
		
		$repeater = new Repeater();
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'bevesi' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Image Link', 'bevesi-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'bevesi-core' )
            ]
        );
		
        $this->add_control( 'client_items',
            [
                'label' => esc_html__( 'Client Items', 'bevesi-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
                    [
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
                    [
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
                    [
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
                    [
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
                    [
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
					[
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],
					[
						'image' => ['url' => $defaultbg],
						'btn_link' => '#',
                    ],

                ]
            ]
        );

		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$output = '';
		
		if ( $settings['client_items'] ) {
			echo '<div class="site-slider-wrapper">';
			echo '<div class="site-slider carousel-style loader-default arrows-style-rounded arrows-white products" data-items="'.esc_attr($settings['column']).'" data-itemslaptop="6" data-itemstablet="'.esc_attr($settings['tablet_column']).'" data-itemsmobile="'.esc_attr($settings['mobile_column']).'" data-itemsmobilexs="2" data-slidescroll="1" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="'.esc_attr($settings['arrows']).'" data-arrowstablet="'.esc_attr($settings['arrows']).'" data-arrowsmobile="'.esc_attr($settings['arrows']).'" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="'.esc_attr($settings['dots']).'" data-dotstablet="'.esc_attr($settings['dots']).'" data-dotsmobile="'.esc_attr($settings['dots']).'" data-infinite="false" data-centermode="false" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'">';
			
			foreach ( $settings['client_items'] as $item ) {
				$target = $item['btn_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
				
				echo '<div class="slider-item">';
				echo '<div class="site-logo-item">';
				echo '<a href="'.esc_url($item['btn_link']['url']).'" '.esc_attr($target.$nofollow).'><img src="'.esc_url($item['image']['url']).'" alt=""></a>';
				echo '</div><!-- site-logo-item -->';
				echo '</div><!-- slider-item -->';
			}
          
			echo '</div><!-- site-slider -->';
			echo '</div><!-- site-slider-wrapper -->'; 
			
		}
		
	}

}
