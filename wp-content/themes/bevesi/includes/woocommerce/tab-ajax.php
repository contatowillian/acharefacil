<?php
/*************************************************
## Tab View
*************************************************/ 

add_action( 'wp_ajax_nopriv_tab_view', 'bevesi_tab_view_callback' );
add_action( 'wp_ajax_tab_view', 'bevesi_tab_view_callback' );
function bevesi_tab_view_callback() {
	
	global $product;
	global $woocommerce;
	$catid = intval( $_POST['catid'] );
	$items = intval( $_POST['items'] );
	$mobile = intval( $_POST['mobile'] );
	$tablet = intval( $_POST['tablet'] );
	$speed = intval( $_POST['speed'] );
	$post_count = intval( $_POST['post_count'] );
	$dots = $_POST['dots'];
	$arrows = $_POST['arrows'];
	$autoplay = $_POST['autoplay'];
	$autospeed = intval( $_POST['autospeed'] );
	$producttype = $_POST['producttype'];
	$productclass = $_POST['productclass'];
	$best_selling = $_POST['best_selling'];
	$featured = $_POST['featured'];
	$on_sale = $_POST['on_sale'];
	$stockprogressbar = $_POST['stockprogressbar'];
	$stockstatus = $_POST['stockstatus'];
	$shippingclass = $_POST['shippingclass'];
	$countdown = $_POST['countdown'];
	
	$output = '';
    
	$output .= '<div id="'.esc_attr($catid).'" class="'.esc_attr($productclass).'" data-speed="'.esc_attr($speed).'" data-items="'.esc_attr($items).'" data-itemslaptop="4" data-itemstablet="'.esc_attr($tablet).'" data-itemsmobile="'.esc_attr($mobile).'" data-itemsmobilexs="1" data-itemScroll="1" data-arrows="'.esc_attr($arrows).'" data-arrowslaptop="true" data-arrowstablet="'.esc_attr($arrows).'" data-arrowsmobile="'.esc_attr($arrows).'" data-dots="'.esc_attr($dots).'" data-dotslaptop="true" data-dotstablet="'.esc_attr($dots).'" data-dotsmobile="'.esc_attr($dots).'" data-autoplay="'.esc_attr($autoplay).'" data-autospeed="'.esc_attr($autospeed).'" data-producttype="'.esc_attr($producttype).'" data-perpage="'.esc_attr($post_count).'" data-best_selling="'.esc_attr($best_selling).'" data-featured="'.esc_attr($featured).'" data-onsale="'.esc_attr($on_sale).'" data-stockprogressbar="'.esc_attr($stockprogressbar).'" data-countdown="'.esc_attr($countdown).'" data-stockstatus="'.esc_attr($stockstatus).'" data-shippingclass="'.esc_attr($shippingclass).'" data-infinite="true" data-draggable="true">';
		
	$args = array(
		'post_type' => 'product',
		'posts_per_page'         => $post_count,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish',
	);

	$args['tax_query'][] = array(
		'taxonomy' 	=> 'product_cat',
		'field' 	=> 'term_id',
		'terms' 	=> $catid,
	);
	
	if($best_selling == 'true'){
		$args['meta_key'] = 'total_sales';
		$args['orderby'] = 'meta_value_num';
	}

	if($featured == 'true'){
		$args['tax_query'] = array( array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => array( 'featured' ),
				'operator' => 'IN',
		) );
	}
	
	if($on_sale == 'true'){
		$args['meta_key'] = '_sale_price';
		$args['meta_value'] = array('');
		$args['meta_compare'] = 'NOT IN';
	}
	
    query_posts( $loop );

		$loop = new \WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				global $product;
				global $post;
				global $woocommerce;

			$output .= '<div class="slider-item"> ';
			$output .= '<div class="'.esc_attr( implode( ' ', wc_get_product_class( '', $product->get_id()))).'"> ';
				if($producttype == 'type6'){
					$output .= bevesi_product_type6($stockprogressbar, $stockstatus, $shippingclass, $countdown);
				} elseif($producttype == 'type5'){
					$output .= bevesi_product_type5($stockprogressbar, $stockstatus, $shippingclass, $countdown);
				} elseif($producttype == 'type4'){
					$output .= bevesi_product_type4($stockprogressbar, $stockstatus, $shippingclass, $countdown);
				} elseif($producttype == 'type3'){
					$output .= bevesi_product_type3($stockprogressbar, $stockstatus, $shippingclass, $countdown);
				} elseif($producttype == 'type2'){
					$output .= bevesi_product_type2($stockprogressbar, $stockstatus, $shippingclass, $countdown);
				} else {
					$output .= bevesi_product_type1($stockprogressbar, $stockstatus, $shippingclass, $countdown);
				}
			$output .= '</div>';
			$output .= '</div>';
			
			endwhile;
		}
		wp_reset_postdata();
		
		$output .= '</div>';
			
	 	$output_escaped = $output;
	 	echo $output_escaped;

	
		wp_die();
}