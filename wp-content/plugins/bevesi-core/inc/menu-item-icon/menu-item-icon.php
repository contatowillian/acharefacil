<?php

/*************************************************
## Admin style and scripts  
*************************************************/ 
function bevesi_menu_item_icon_admin_scripts() {
    wp_register_script('klb-menu-item-icon', plugins_url( 'js/menu-item-icon.js', __FILE__ ), false, '1.0');
	wp_register_style('klb-menu-item-icon', plugins_url( 'css/menu-item-icon.css', __FILE__ ), false, '1.0');	
}
add_action( 'admin_enqueue_scripts', 'bevesi_menu_item_icon_admin_scripts' );

/*************************************************
## Support SVG Media
*************************************************/ 
if( ! function_exists( 'bevesi_upload_mimes' ) ) {
	add_filter( 'upload_mimes', 'bevesi_upload_mimes', 100, 1 );
	function bevesi_upload_mimes( $mimes ) {

		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		$mimes['woff'] = 'font/woff';
		$mimes['woff2'] = 'font/woff2';
		$mimes['ttf'] = 'font/ttf';
		$mimes['eot'] = 'font/eot';
		// $mimes['svg'] = 'font/svg';
		// $mimes['woff'] = 'application/x-font-woff';
		// $mimes['ttf'] = 'application/x-font-ttf';
		// $mimes['eot'] = 'application/vnd.ms-fontobject';
		return $mimes;
	}
}


/*************************************************
## bevesi Menu Custom Fields
*************************************************/
function bevesi_custom_fields( $item_id, $item ) {
	
	wp_enqueue_style('klb-menu-item-icon');
	wp_enqueue_script('klb-menu-item-icon');
	
    $menu_item_icon = get_post_meta( $item_id, '_menu_item_icon', true );

    ?>

	<div class="bevesi-field-menu-item-icon description description-wide">

		<?php wp_enqueue_media(); ?>

		<label for="menu_item_icon-<?php echo esc_attr($item_id); ?>">
			<?php esc_html_e( 'Menu Item Icon', 'bevesi'  ); ?>
		</label>

		<div class='image-preview-wrapper'>
			<?php $image_attributes = wp_get_attachment_image_src( $menu_item_icon, 'thumbnail' );
			if ($image_attributes != '' ) { ?>
				<img id='image-preview-<?php echo esc_attr($item_id); ?>' class="image-preview" src="<?php echo esc_attr( $image_attributes[0]); ?>" />
			<?php } ?>
		</div>
		<?php if ($image_attributes != '' ) { ?>
		<input id="remove_image_button-<?php echo esc_attr($item_id); ?>" type="button" class="remove_image_button button" value="<?php esc_attr_e( 'Remove', 'bevesi-core' ); ?>" />
		<?php } ?>
		<input id="upload_image_button-<?php echo esc_attr($item_id); ?>" type="button" class="upload_image_button button" value="<?php esc_attr_e( 'Select image', 'bevesi-core' ); ?>" />

		<input type="hidden" class="widefat code edit-menu-item-custom image_attachment_id" id="menu_item_icon-<?php echo esc_attr($item_id); ?>" name="menu_item_icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $menu_item_icon ); ?>"/>

	</div>

   

    <?php

}
add_action( 'wp_nav_menu_item_custom_fields', 'bevesi_custom_fields', 10, 2 );

/*************************************************
## bevesi Save menu item meta
*************************************************/
function bevesi_nav_update( $menu_id, $menu_item_db_id ) {

    if (!empty($_REQUEST['menu_item_icon'])) {
        $icon_enabled_value = $_REQUEST['menu_item_icon'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_enabled_value );
    }
}

add_action( 'wp_update_nav_menu_item', 'bevesi_nav_update', 10, 2 );

/*************************************************
## Output menu icon field
*************************************************/
add_filter( 'wp_nav_menu_objects', 'bevesi_icon_wp_nav_menu_objects', 10, 2 );
function bevesi_icon_wp_nav_menu_objects( $sorted_menu_items, $args  ) {
    foreach ( $sorted_menu_items as $item ) {
		$menu_item_iconfield = get_post_meta( $item->ID, '_menu_item_icon', true );	

		$image_attributes = wp_get_attachment_image_src( $menu_item_iconfield, 'full' );
		
		if($menu_item_iconfield){
			$item->title = '<span class="menu-item-icon"><img src="'.esc_url($image_attributes[0]).'"></span> ' . $item->title;
		}
    }

    return $sorted_menu_items;
}