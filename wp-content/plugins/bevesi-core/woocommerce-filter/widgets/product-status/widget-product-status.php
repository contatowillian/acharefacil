<?php

class widget_product_status extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('For Product Archive Page.','bevesi-core') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'product_status' );
		 parent::__construct( 'product_status', esc_html__('Bevesi Product Status','bevesi-core'), $widget_ops, $control_ops );
	}

	// Widget Output
	function widget($args, $instance) {
			extract($args);
			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
			
			echo $before_widget;
	
			if($title) {
				echo $before_title . $title . $after_title;
			}

			global $wp;
			if ( '' === get_option( 'permalink_structure' ) ) {
				$link = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
			} else {
				$link = preg_replace( '%\/page/[0-9]+%', '', add_query_arg( null, null ) );
			}
				
			if(bevesi_stock_status() == 'instock'){
				$checkbox = 'checked';
				$stocklink = remove_query_arg('stock_status');
			} else {
				$checkbox = '';
				$stocklink = add_query_arg('stock_status','instock',$link);
			}
	
			if(bevesi_on_sale() == 'onsale'){
				$onsalecheckbox = 'checked';
				$salelink = remove_query_arg('on_sale');
			} else {
				$onsalecheckbox = '';
				$salelink = add_query_arg('on_sale','onsale',$link);
			}
	
			wp_enqueue_style( 'klb-widget-product-categories');

			echo '<div class="widget-body">';
			echo '<div class="widget-checkbox-list">';
			echo '<ul>';
			
			echo '<li>';
			echo '<a href="'.esc_url($stocklink).'">';
			echo '<input name="stockonsale" value="instock" id="instock" type="checkbox" '.esc_attr($checkbox).'>';
			echo '<label><span></span>'.esc_html__('In Stock','bevesi-core').'</label>';
			echo '</a>';
			echo '</li>';
			
			echo '<li>';
			echo '<a href="'.esc_url($salelink).'">';
			echo '<input name="stockonsale" value="onsale" id="onsale" type="checkbox" '.esc_attr($onsalecheckbox).'>';
			echo '<label><span></span>'.esc_html__('On Sale','bevesi-core').'</label>';
			echo '</a>';
			echo '</li>';
			
			echo '</ul>';
			echo '</div>';
			echo '</div>';
		
	
	
			echo $after_widget;
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => 'Product Status');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','bevesi-core'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

	<?php
	}
}

// Add Widget
function widget_product_status_init() {
	register_widget('widget_product_status');
}
add_action('widgets_init', 'widget_product_status_init');

?>