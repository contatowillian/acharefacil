<?php
/*************************************************
## Single Product Side Inner
*************************************************/
function bevesi_single_product_side_inner(){
	global $product;
	
	?>
	
	<div class="column single-product-list">
		<?php do_action('bevesi_single_recent_views'); ?>
	</div>

	<?php
}

if(get_theme_mod('bevesi_single_type') == 'type2'){
	add_action('bevesi_single_side_inner','bevesi_single_product_side_inner');
	
	//Remove Single Price
	remove_action( 'get_footer', 'bevesi_recently_viewed_product_loop');
	if(function_exists('bevesi_recently_viewed_product_loop_product_info')){
		add_action('bevesi_single_recent_views','bevesi_recently_viewed_product_loop_product_info');
	}	
	
} else {
	add_action('bevesi_single_recent_views','bevesi_recently_viewed_product_loop_product_info');
	
	//Remove Single Price
	remove_action( 'get_footer', 'bevesi_recently_viewed_product_loop');
	if(function_exists('bevesi_recently_viewed_product_loop_product_info')){
		add_action('get_footer','bevesi_recently_viewed_product_loop');
	}
	
}	