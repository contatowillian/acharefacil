<?php

/*************************************************
## Scripts
*************************************************/
function bevesi_location_scripts() {
	wp_register_style( 'klb-location-filter',   plugins_url( 'css/location-filter.css', __FILE__ ), false, '1.0');
	wp_register_script( 'klb-location-filter',  plugins_url( 'js/location-filter.js', __FILE__ ), true );

}
add_action( 'wp_enqueue_scripts', 'bevesi_location_scripts' );

/*************************************************
## Register Location Taxonomy
*************************************************/ 

function custom_taxonomy_location()  {
$labels = array(
    'name'                       => 'Locations',
    'singular_name'              => 'Location',
    'menu_name'                  => 'Locations',
    'all_items'                  => 'All Locations',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Location',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'separate_items_with_commas' => 'Separate Item with commas',
    'search_items'               => 'Search Items',
    'add_or_remove_items'        => 'Add or remove Items',
    'choose_from_most_used'      => 'Choose from the most used Items',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'location', array( 'product','shop_coupon' ), $args );
register_taxonomy_for_object_type( 'location', array( 'product','shop_coupon' ) );
}
add_action( 'init', 'custom_taxonomy_location' );



/*************************************************
## Bevesi Query Vars
*************************************************/ 
function bevesi_query_vars( $query_vars ){
    $query_vars[] = 'klb_special_query';
    return $query_vars;
}
add_filter( 'query_vars', 'bevesi_query_vars' );

/*************************************************
## Bevesi Product Query for Klb Shortcodes
*************************************************/ 
function bevesi_location_product_query( $query ){
    if( isset( $query->query_vars['klb_special_query'] ) && bevesi_location() != 'all'){
		$tax_query[] = array(
			'taxonomy' => 'location',
			'field'    => 'slug',
			'terms'    => bevesi_location(),
		);

		$query->set( 'tax_query', $tax_query );
	}
}
add_action( 'pre_get_posts', 'bevesi_location_product_query' );

/*************************************************
## Bevesi Location
*************************************************/ 
function bevesi_location(){	
	$location  = isset( $_COOKIE['location'] ) ? $_COOKIE['location'] : 'all';
	if($location){
		return $location;
	}
}

/*************************************************
## Bevesi Location Output
*************************************************/
add_action('wp_footer', 'bevesi_location_output'); 
function bevesi_location_output(){
	
	wp_enqueue_style( 'klb-location-filter');
	wp_enqueue_script( 'jquery-cookie');
	wp_enqueue_script( 'klb-location-filter');
	wp_localize_script( 'klb-location-filter', 'locationfilter', array(
		'popup' => bevesi_ft() == 'location' ? '1' : get_theme_mod('bevesi_location_filter_popup',0),
		
	));

	$terms = get_terms( array(
		'taxonomy' => 'location',
		'hide_empty' => false,
		'parent'    => 0,
	) );

	$output = '';
	
	$output .= '<div id="location-selector" class="site-modal modal-location strech d-flex align-items-center justify-content-center">';
	$output .= '<div class="site-modal-overlay strech position-absolute"></div>';
	$output .= '<div class="site-modal-body position-relative z-1 bg-white">';
	$output .= '<div class="site-modal-header d-flex align-items-center justify-content-between pt-14 lg-pt-28 px-20 lg-px-30">';
	$output .= '<h4 class="entry-title text-16 lg-text-18 fw-semibold mb-0">'.esc_html__('Delivery to you', 'bevesi-core').'</h4>';
	$output .= '<div class="site-button close-button">';
	$output .= '<a href="#"><i class="klb-icon-x"></i></a>';
	$output .= '</div><!-- site-button -->';
	$output .= '</div><!-- site-modal-header -->';
	$output .= '<div class="site-modal-inner px-20 lg-px-32 py-10 lg-py-16 mb-16">';
	$output .= '<p class="entry-text text-13 lg-text-14 text-gray-500">'.esc_html__('Add an exact address, a convenient pick-up point or a parcel locker to see the conditions for delivery of goods in advances.', 'bevesi-core').'</p>';
	$output .= '<div class="search-wrapper position-relative d-flex align-items-center mb-24">';
	$output .= '<i class="klb-icon-search position-absolute text-22 lg-text-24"></i>';
	$output .= '<input class="form-control location-input" type="text" placeholder="'.esc_html__('Search your location...', 'bevesi-core').'">';
	$output .= '<div class="site-loader dots-animation">';
	$output .= '<div class="loader-dot"></div>';
	$output .= '<div class="loader-dot"></div>';
	$output .= '<div class="loader-dot"></div>';
	$output .= '</div><!-- site-loader -->';
	$output .= '</div><!-- search-wrapper -->';
	$output .= '<div class="location-items pb-20 lg-pb-10">';
	$output .= '<ul class="site-scroll">';
			
	$output .= '<li class="location-item">';
	$output .= '<a href="" data-slug="all">';
	$output .= '<input type="radio" name="location" id="all">';
	$output .= '<label >';
	$output .= '<i class="klb-icon-map-pin mr-6"></i>';
	$output .= '<div class="location-detail d-flex flex-wrap align-items-start justify-content-between w-100">';
	$output .= '<div class="location-col flex-fill">';
	$output .= '<h4 class="entry-title fw-semibold text-14 mb-0">'.esc_html__('Select a Location','bevesi-core').'</h4>';
	$output .= '</div><!-- location-col -->';
	$output .= '</div><!-- location-detail -->';
	$output .= '</label>';
	$output .= '</a>';
	$output .= '</li>';
			
	foreach ( $terms as $term ) {
		if($term->slug == bevesi_location()){
			$select = 'active';
		} else {
			$select = '';
		}
			
		$output .= '<li class="location-item '.esc_attr($select).'">';
		$output .= '<a href="'.add_query_arg('location', esc_attr($term->slug)).'" data-slug="'.esc_attr($term->slug).'">';
		$output .= '<input type="radio" name="location" id="'.esc_attr($term->slug).'">';
		$output .= '<label >';
		$output .= '<i class="klb-icon-map-pin mr-6"></i>';
		$output .= '<div class="location-detail d-flex flex-wrap align-items-start justify-content-between w-100">';
		$output .= '<div class="location-col flex-fill">';
		$output .= '<h4 class="entry-title fw-semibold text-14 mb-0">'.esc_html($term->name).'</h4>';
		$output .= '</div><!-- location-col -->';
		$output .= '<div class="location-col flex-auto">';
		$output .= '<span class="min-currency text-11 text-gray-600">'.bevesi_sanitize_data($term->description).'</span>';
		$output .= '</div><!-- location-col -->';
		$output .= '</div><!-- location-detail -->';
		$output .= '</label>';
		$output .= '</a>';
		$output .= '</li>';
	
	}
	$output .= '</ul>';
	$output .= '</div><!-- location-items -->';
	$output .= '</div><!-- site-modal-inner -->';
	$output .= '</div><!-- site-modal-body -->';
	$output .= '</div><!-- site-modal -->';


	echo $output;
}