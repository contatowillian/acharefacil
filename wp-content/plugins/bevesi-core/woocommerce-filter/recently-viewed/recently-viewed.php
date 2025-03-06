<?php

/*************************************************
## Recently Viewed Products Always
*************************************************/ 
function bevesi_track_product_view() {
	if ( ! is_singular( 'product' )) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
		$viewed_products = array();
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
	}

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

remove_action( 'template_redirect', 'wc_track_product_view', 20 );
add_action( 'template_redirect', 'bevesi_track_product_view', 20 );

/*************************************************
## Add Class in Body
*************************************************/ 

function bevesi_recently_body_classes( $classes ) {
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
	
	if ( is_product() && !empty( $viewed_products) && is_woocommerce()) {
		$classes[] = 'recently-viewed';
	}
	
	return $classes;
}
add_filter( 'body_class', 'bevesi_recently_body_classes' );


/*************************************************
## Recently Viewed Products Loop
*************************************************/ 
function bevesi_recently_viewed_product_loop(){
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

	if ( empty( $viewed_products) || !is_woocommerce()) {
		return;
	}
	
	$column = get_theme_mod('bevesi_recently_viewed_products_column', 4);

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $column,
		'post__in'       => $viewed_products,
		'orderby'        => 'post__in',
		'post_status'    => 'publish',
	);
	
	$loop = new WP_Query( $args );
		
		echo '<div class="container">';
		echo '<div class="site-module klb-module module-recently-products mt-20">';
		echo '<div class="klb-module-header d-flex align-items-center flex-wrap mb-30 gap-2 gap-md-4">';
		echo '<div class="column">';
		echo '<h3 class="entry-title">'.esc_html__('Vistos Recentemente','bevesi-core').'</h3>';
		echo '</div><!-- column -->';
             
		echo '</div><!-- site-module-header -->';
		echo '<div class="site-module-body">';
		echo '<div class="products product-grid-style grid-column-2-mobile grid-column-'.esc_attr($column).' grid-gap-30">';
            if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
			} else {
				echo esc_html__( 'No products found', 'bevesi-core');
			}
		echo '</div><!-- products -->';
		echo '</div><!-- site-module-body -->';
		echo '</div><!-- site-module -->';
		echo '</div>';
		

	wp_reset_postdata();	
}
add_action('get_footer','bevesi_recently_viewed_product_loop');

/*************************************************
## Recently Viewed Products Loop For Product Info
*************************************************/ 
function bevesi_recently_viewed_product_loop_product_info(){
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

	if ( empty( $viewed_products) || !is_woocommerce()) {
		return;
	}
	
	$column = get_theme_mod('bevesi_recently_viewed_products_column', 4);

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $column,
		'post__in'       => $viewed_products,
		'orderby'        => 'post__in',
		'post_status'    => 'publish',
	);
	
	$loop = new WP_Query( $args );


	echo '<h4 class="entry-title">'.esc_html__('Vistos Recentemente', 'bevesi-core').'</h4>';
	echo '<ul class="products list-style sm-list">';
	
	if ( $loop->have_posts() ) {
		
		while ( $loop->have_posts() ) : $loop->the_post();
			global $product;
			global $post;
			global $woocommerce;
			
			$id = get_the_ID();
			$allproduct = wc_get_product( get_the_ID() );
	
			$price = $allproduct->get_price_html();
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0];
			
			echo '<li>';
			echo '<div class="product-img">';
			echo '<img src="'.esc_url($image_src).'" alt="'.the_title_attribute( 'echo=0' ).'">';
			echo '</div>';
			echo '<div class="product-content">';
			echo '<h3 class="product-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
			echo '<span class="price size-small">';
			echo $price;
			echo '</span><!-- price -->';
			echo '</div><!-- search-content -->';
			echo '</li>';
	
		endwhile;
	} else {
		echo esc_html__( 'No products found', 'bevesi-core');
	}
	
	echo '</ul>';

	
	wp_reset_postdata();	
}

add_action('bevesi_single_recent_views','bevesi_recently_viewed_product_loop_product_info');