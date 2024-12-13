<?php

namespace Elementor;

class Bevesi_Product_Categories_Widget extends Widget_Base {
    use Bevesi_Helper;
	
    public function get_name() {
        return 'bevesi-product-categories';
    }
    public function get_title() {
        return 'Product Categories (K)';
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
		
		$this->add_control( 'categories_type',
			[
				'label' => esc_html__( 'Categories Type', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bevesi-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bevesi-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bevesi-core' ),
				],
			]
		);
		
		$this->start_controls_tabs('cat_exclude_include_tabs');
        $this->start_controls_tab('cat_include_tab',
            [ 'label' => esc_html__( 'Include Category', 'bevesi-core' ) ]
        );
       
        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Include Category', 'bevesi-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->bevesi_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'default' => '',
                'label_block' => true,
            ]
        );
		
		$this->end_controls_tab(); // cat_include_tab 
		
        $this->start_controls_tab( 'cat_exclude_tab',
            [ 'label' => esc_html__( 'Exclude Category', 'bevesi-core' ) ]
        );
		
        $this->add_control( 'exclude_category',
            [
                'label' => esc_html__( 'Exclude Category', 'bevesi-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->bevesi_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'default' => '',
                'label_block' => true,
            ]
        );
       
		$this->end_controls_tab(); // cat_exclude_tab

		$this->end_controls_tabs(); // cat_exclude_include_tabs
		
		$this->add_control( 'column',
			[
				'label' => esc_html__( 'Column', 'bevesi-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '8',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'3'		  => esc_html__( '3 Columns', 'bevesi-core' ),
					'4'		  => esc_html__( '4 Columns', 'bevesi-core' ),
					'5'		  => esc_html__( '5 Columns', 'bevesi-core' ),
					'6'		  => esc_html__( '6 Columns', 'bevesi-core' ),
					'7'		  => esc_html__( '7 Columns', 'bevesi-core' ),
					'8'		  => esc_html__( '8 Columns', 'bevesi-core' ),
					'9'		  => esc_html__( '9 Columns', 'bevesi-core' ),
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
				'default' => '2',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bevesi-core' ),
					'2' 	  => esc_html__( '2 Columns', 'bevesi-core' ),
					'3'		  => esc_html__( '3 Columns', 'bevesi-core' ),
					'4'		  => esc_html__( '4 Columns', 'bevesi-core' ),
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
		
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'bevesi-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'bevesi-core' ),
                    'DESC' => esc_html__( 'Descending', 'bevesi-core' )
                ],
                'default' => 'ASC'
            ]
        );
		
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'bevesi-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'bevesi-core' ),
                    'menu_order' => esc_html__( 'Menu Order', 'bevesi-core' ),
                    'rand' => esc_html__( 'Random', 'bevesi-core' ),
                    'date' => esc_html__( 'Date', 'bevesi-core' ),
                    'title' => esc_html__( 'Title', 'bevesi-core' ),
                ],
                'default' => 'menu_order',
            ]
        );
		
		$this->end_controls_section();
		/*****   END CONTROLS SECTION   ******/
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if($settings['cat_filter'] || $settings['exclude_category']){
			$terms = get_terms( array(
				'taxonomy' => 'product_cat',
				'hide_empty' => 1,
				'parent'    => 0,
				'include'   => $settings['cat_filter'],
				'exclude'   => $settings['exclude_category'],
				'order'          => $settings['order'],
				'orderby'        => $settings['orderby']
			) );
		} else {
			$terms = get_terms( array(
				'taxonomy' => 'product_cat',
				'hide_empty' => 1,
				'parent'    => 0,
				'order'          => $settings['order'],
				'orderby'        => $settings['orderby']
			) );
		}
		
		$categorytype= '';

		if($settings['categories_type'] == 'type2'){
			$categorytype .= 'style-2';
		} else {
			$categorytype .= 'style-1';
		}
		
		echo '<div class="site-slider-wrapper">';
		echo '<div class="site-slider carousel-style loader-default arrows-style-rounded arrows-white site-categories-small" data-items="'.esc_attr($settings['column']).'" data-itemslaptop="6" data-itemstablet="'.esc_attr($settings['tablet_column']).'" data-itemsmobile="'.esc_attr($settings['mobile_column']).'" data-itemsmobilexs="1" data-slidescroll="1" data-speed="'.esc_attr($settings['slide_speed']).'" data-arrows="'.esc_attr($settings['arrows']).'" data-arrowslaptop="'.esc_attr($settings['arrows']).'" data-arrowstablet="'.esc_attr($settings['arrows']).'" data-arrowsmobile="'.esc_attr($settings['arrows']).'" data-dots="'.esc_attr($settings['dots']).'" data-dotslaptop="'.esc_attr($settings['dots']).'" data-dotstablet="'.esc_attr($settings['dots']).'" data-dotsmobile="'.esc_attr($settings['dots']).'" data-infinite="false" data-centermode="false" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'">';
        
		foreach ( $terms as $term ) {
			$term_data = get_option('taxonomy_'.$term->term_id);
			$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			$term_children = get_term_children( $term->term_id, 'product_cat' );
			
			echo '<div class="slider-item">';
			echo '<div class="site-category-box '.esc_attr($categorytype).'">';
			echo '<div class="site-category-thumbnail">';
			if($image){
				echo '<a href="'.esc_url(get_term_link( $term )).'"><img src="'.esc_url($image).'" alt="'.esc_attr($term->name).'"></a>';
			}
			echo '</div><!-- site-category-thumbnail -->';
			echo '<div class="site-category-content">';
			echo '<h4 class="category-name"><a href="'.esc_url(get_term_link( $term )).'">'.esc_html($term->name).'</a></h4>';
			echo '<span class="category-count">'.esc_html($term->count).' '.esc_html__('Products','bevesi-core').'</span>';
			echo '</div><!-- site-category-content -->';
			echo '</div><!-- site-category-box -->';
			echo '</div><!-- slider-item -->';
          
        }      
          
		echo '</div><!-- site-slider -->';
		echo '</div><!-- site-slider-wrapper -->';
		
	}

}
