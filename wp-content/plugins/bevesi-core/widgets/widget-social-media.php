<?php

class widget_social_media extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('Only Detail Page: Social Media.','bevesi-core') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'social_media' );
		 parent::__construct( 'social_media', esc_html__('Bevesi Social Media','bevesi-core'), $widget_ops, $control_ops );
	}


	
	// Widget Output
	function widget($args, $instance) {

		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		
		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>

		
		<?php $socialmedia = get_theme_mod( 'bevesi_social_media_widget' ); ?>
		<?php if(!empty($socialmedia)){ ?>
			<div class="widget-body">
                <div class="site-social widget-style">
					<ul class="social-media background-social">
						<?php foreach($socialmedia as $s){ ?>
							<li>
								<a href="<?php echo esc_url($s['social_url']); ?>" class="<?php echo esc_attr($s['social_icon']); ?>">
								  <div class="site-social-icon">
									<i class="klb-social-icon-<?php echo esc_attr($s['social_icon']); ?>"></i>
								  </div><!-- site-social-icon -->
								  <div class="site-social-content">
									<p><?php echo esc_attr($s['social_icon']); ?></p>
									<span><?php esc_html_e('Follow','bevesi-core'); ?></span>
								  </div><!-- site-social-content -->
								</a>
							</li>
						<?php } ?>
                    </ul>
                </div><!-- site-social -->
            </div><!-- widget-body -->
		<?php } ?>
	


		<?php echo $after_widget;

	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','bevesi-core'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		  <?php esc_html_e('You can customize the social media from Dashboard > Appearance > Customize > bevesi Widgets > Social Media','bevesi-core'); ?>

		</p>
	<?php
	}
}

// Add Widget
function widget_social_media_init() {
	register_widget('widget_social_media');
}
add_action('widgets_init', 'widget_social_media_init');

?>