<?php

/*************************************************
## Scripts
*************************************************/
function bevesi_attribute_filter() {
	wp_register_script( 'bevesi-attribute-filter',   plugins_url( 'js/attribute-search.js', __FILE__ ), false, '1.0');
}
add_action( 'wp_enqueue_scripts', 'bevesi_attribute_filter' );

/*************************************************
## Models Output Callback
*************************************************/ 
add_action( 'wp_ajax_nopriv_klb_models_output', 'bevesi_klb_models_output_callback' );
add_action( 'wp_ajax_klb_models_output', 'bevesi_klb_models_output_callback' );
function bevesi_klb_models_output_callback() {

	global $wpdb;

	$term_id = $_POST['selected_id'];
	$attribute_name = $_POST['attribute_name'];
	$tax = $_POST['tax'];

	
	$term_children = get_term_children( $term_id, $tax );
	
	
	if($term_children){
		echo '<div class="form-column"> ';
		echo '<select class="theme-select" name="'.esc_attr($attribute_name).'" id="filter_'.esc_attr($attribute_name).'" data-placeholder="'.esc_attr__('Select Model','bevesi-core').'" data-search="true" data-searchplaceholder="'.esc_attr__('Search item...', 'bevesi-core').'">';
		
		echo '<option value="">'.sprintf('Select Model', $attribute_name).'</option>';
		foreach ($term_children as $child) {
			$childterm = get_term_by( 'id', $child, $tax);
			echo '<option value="'.esc_attr($childterm->slug).'">'.esc_html($childterm->name).'</option>';
		}
		echo '</select>';
		echo '</div>';
	} else {
		echo '<div class="form-column"> ';
		echo '<select class="theme-select" name="'.esc_attr($attribute_name).'" id="filter_'.esc_attr($attribute_name).'" >';
		echo '<option value="'.esc_attr($childterm->slug).'">'.sprintf('No model for %s ', $attribute_name).'</option>';
		echo '</select>';
		echo '</div>';
	}

	
	
	wp_die();
}

/*************************************************
## Enable Parent-Child for the Attributes
*************************************************/ 
if( function_exists( 'WC' ) ){
    add_action( 'init', 'bevesi_woocommerce_register_taxonomies_hack', 4 );

    if( ! function_exists( 'bevesi_woocommerce_register_taxonomies_hack' ) ){
        function bevesi_woocommerce_register_taxonomies_hack(){
            if( $attribute_taxonomies = wc_get_attribute_taxonomies() ) {
                foreach ($attribute_taxonomies as $tax) {
                    if ($name = wc_attribute_taxonomy_name($tax->attribute_name)) {
                        add_filter( "woocommerce_taxonomy_args_{$name}", 'bevesi_woocommerce_taxonomy_product_attribute_args' );
                    }
                }
            }
        }
    }

    if( ! function_exists( 'bevesi_woocommerce_taxonomy_product_attribute_args' ) ){
        function bevesi_woocommerce_taxonomy_product_attribute_args( $taxonomy_data ){
            $taxonomy_data['hierarchical'] = true;
            return $taxonomy_data;
        }
    }
}