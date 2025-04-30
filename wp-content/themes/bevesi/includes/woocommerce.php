<?php

/*************************************************
## Woocommerce 
*************************************************/

/*************************************************
## Bevesi Product Box
*************************************************/
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type1.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type2.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type3.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type4.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type5.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type6.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-list.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-list2.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-list3.php';
require_once get_template_directory() . '/includes/woocommerce/product-type/product-type-header.php';
require_once get_template_directory() . '/includes/woocommerce/single-type/single-type.php';
require_once get_template_directory() . '/includes/woocommerce/add-to-cart.php';


/*************************************************
## Bevesi Image
*************************************************/
function bevesi_product_image(){
	global $product;

	$size = get_theme_mod( 'bevesi_product_image_size', array( 'width' => '', 'height' => '') );

	if($size['width'] && $size['height']){
		$image = $product->get_image(array( $size['width'], $size['height'] ));
	} else {
		$image = $product->get_image();
	}

	return $image;

}

/*************************************************
## Bevesi Second Image
*************************************************/
function bevesi_product_second_image(){
	global $product;
	
	$product_image_ids = $product->get_gallery_image_ids();
	$size = get_theme_mod( 'bevesi_product_image_size', array( 'width' => '', 'height' => '') );
			
	if($product_image_ids && get_theme_mod('bevesi_product_box_gallery') == 1){
		
		wp_enqueue_script( 'bevesi-hover-gallery');
		
		echo '<a href="'.get_permalink().'">';
		echo '<div class="product-thumbnail-gallery">';
		
		echo '<div class="product-thumbnail-gallery-item">';
		echo bevesi_product_image();
		echo '</div>';
		
			
		foreach( $product_image_ids as $product_image_id ){
			echo '<div class="product-thumbnail-gallery-item">';
			if($size['width'] && $size['height']){
				echo wp_get_attachment_image($product_image_id, array( $size['width'], $size['height'] ));
			} else {
				echo  wp_get_attachment_image($product_image_id, 'full');
			}
			echo '</div><!-- product-gallery-item -->';
		}
		
		echo '</div>';
		echo '</a>';
		
	} else {
		echo '<a href="'.get_permalink().'">';
		echo bevesi_product_image();
		echo '</a>';
	}
}

/*************************************************
## Sale Percentage
*************************************************/
function bevesi_sale_percentage(){
	global $product;

	$output = '';
	
	if(get_theme_mod('bevesi_product_badge_tab', 0) == 1){
		
		$product = wc_get_product(get_the_ID());
		$badgetext = $product->get_meta('_klb_product_badge_text');
		$badgetype = $product->get_meta('_klb_product_badge_type');
		$badgebg = $product->get_meta('_klb_product_badge_bg_color');
		$badgecolor = $product->get_meta('_klb_product_badge_text_color');
		$percentagecheck = $product->get_meta('_klb_product_percentage_check');
		$percentagetype = $product->get_meta('_klb_product_percentage_type');
		$percentagebg = $product->get_meta('_klb_product_percentage_bg_color');
		$percentagecolor = $product->get_meta('_klb_product_percentage_text_color');

		$badgecss = '';
		if($badgebg || $badgecolor){
			$badgecss .= 'style="';
			if($badgebg){
				$badgecss .= 'background: '.esc_attr($badgebg).';';
			}
			if($badgecolor){
				$badgecss .= 'color: '.esc_attr($badgecolor).';';
			}
			$badgecss .= '"';
		}
		
		$percentagecss = '';
		if($percentagebg || $percentagecolor){
			$percentagecss .= 'style="';
			if($percentagebg){
				$percentagecss .= 'background-color: '.esc_attr($percentagebg).';';
			}
			if($percentagecolor){
				$percentagecss .= 'color: '.esc_attr($percentagecolor).';';
			}
			$percentagecss .= '"';
		}
		
		if ( $product->is_on_sale() || $badgetext ){
			$output .= '<div class="thumbnail-badges product-badges">';
			
			if ( !$percentagecheck && $product->is_on_sale() && $product->is_type( 'variable' ) ) {
				$percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price( 'min' )) * 100);
				$output .= '<span class="badge red '.esc_attr($percentagetype).' sale" '.$percentagecss.'>'.$percentage.'%</span>';
			} elseif( !$percentagecheck && $product->is_on_sale() && $product->get_regular_price()  && !$product->is_type( 'grouped' )) {
				$percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
				$output .= '<span class="badge red '.esc_attr($percentagetype).' sale" '.$percentagecss.'>'.$percentage.'%</span>';
			}

			if($badgetext){
				$output .= '<span class="badge red'.esc_attr($badgetype).'" '.$badgecss.'>';
				if($badgetype == 'organic'){
					$output .= '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.29199 3.11798H0.666992C0.666992 6.25098 3.21499 8.79898 6.36099 8.79898V12.049C6.36099 12.517 6.72499 12.894 7.14099 12.894C7.55699 12.894 7.98599 12.517 7.98599 12.075V8.82498C7.98599 5.67898 5.43799 3.11798 2.29199 3.11798ZM12.042 1.50598C9.89699 1.50598 8.05099 2.68898 7.07599 4.44398C7.77799 5.19798 8.29799 6.13398 8.57099 7.17398C11.431 6.87498 13.667 4.45698 13.667 1.50598H12.042Z" fill="currentColor"/>
                                </svg>';
				}elseif($badgetype == 'cold-sale'){
					$output .= '<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.8937 10.042L11.4657 9.22995L12.6977 8.50195C12.9217 8.36195 13.0057 8.06795 12.8657 7.84395C12.7397 7.61995 12.4457 7.53595 12.2077 7.67595L10.5137 8.66995L7.95169 7.19995L10.5137 5.71595L12.2077 6.72395C12.2917 6.76595 12.3757 6.79395 12.4597 6.79395C12.6137 6.79395 12.7817 6.70995 12.8657 6.55595C13.0057 6.33195 12.9217 6.03795 12.6977 5.89795L11.4657 5.16995L12.8937 4.35795C13.1177 4.21795 13.1877 3.92395 13.0617 3.69995C12.9357 3.47595 12.6417 3.39195 12.4037 3.51795L10.9897 4.34395L10.9757 2.91595C10.9757 2.64995 10.7517 2.43995 10.4997 2.43995C10.2337 2.43995 10.0237 2.66395 10.0237 2.92995L10.0377 4.88995L7.47569 6.37395V3.41995L9.19769 2.45395C9.42169 2.31395 9.50569 2.01995 9.37969 1.79595C9.23969 1.57195 8.95969 1.48795 8.72169 1.61395L7.47569 2.31395V0.675951C7.47569 0.409951 7.26569 0.199951 6.99969 0.199951C6.73369 0.199951 6.52369 0.409951 6.52369 0.675951V2.31395L5.27769 1.61395C5.05369 1.48795 4.75969 1.57195 4.61969 1.79595C4.49369 2.01995 4.57769 2.31395 4.80169 2.45395L6.52369 3.41995V6.37395L3.96169 4.88995L3.97569 2.92995C3.98969 2.66395 3.76569 2.43995 3.51369 2.43995C3.49969 2.43995 3.49969 2.43995 3.49969 2.43995C3.24769 2.43995 3.02369 2.64995 3.02369 2.91595L3.00969 4.34395L1.59569 3.51795C1.35769 3.39195 1.06369 3.47595 0.93769 3.69995C0.81169 3.92395 0.88169 4.21795 1.11969 4.35795L2.53369 5.16995L1.30169 5.89795C1.07769 6.03795 0.99369 6.33195 1.13369 6.55595C1.21769 6.70995 1.38569 6.79395 1.53969 6.79395C1.62369 6.79395 1.70769 6.76595 1.79169 6.72395L3.48569 5.71595L6.04769 7.19995L3.48569 8.68395L1.79169 7.67595C1.55369 7.53595 1.27369 7.61995 1.13369 7.84395C0.99369 8.06795 1.07769 8.36195 1.30169 8.50195L2.53369 9.22995L1.11969 10.042C0.88169 10.182 0.81169 10.476 0.93769 10.7C1.02169 10.854 1.18969 10.938 1.35769 10.938C1.42769 10.938 1.51169 10.924 1.59569 10.868L3.00969 10.056L3.02369 11.484C3.02369 11.75 3.24769 11.96 3.49969 11.96C3.49969 11.96 3.49969 11.96 3.51369 11.96C3.76569 11.96 3.98969 11.736 3.97569 11.47L3.96169 9.50995L6.52369 8.02595V10.98L4.80169 11.946C4.57769 12.086 4.49369 12.38 4.61969 12.604C4.71769 12.758 4.87169 12.842 5.03969 12.842C5.12369 12.842 5.20769 12.828 5.27769 12.786L6.52369 12.086V13.724C6.52369 13.99 6.73369 14.2 6.99969 14.2C7.26569 14.2 7.47569 13.99 7.47569 13.724V12.086L8.72169 12.786C8.79169 12.828 8.87569 12.842 8.95969 12.842C9.12769 12.842 9.28169 12.758 9.37969 12.604C9.50569 12.38 9.42169 12.086 9.19769 11.946L7.47569 10.98V8.02595L10.0377 9.50995L10.0237 11.47C10.0237 11.736 10.2337 11.96 10.4857 11.96C10.4997 11.96 10.4997 11.96 10.4997 11.96C10.7657 11.96 10.9757 11.75 10.9757 11.484L10.9897 10.056L12.4037 10.868C12.4877 10.924 12.5717 10.938 12.6417 10.938C12.8097 10.938 12.9777 10.854 13.0617 10.7C13.1877 10.476 13.1177 10.182 12.8937 10.042Z" fill="currentColor"/>
                                </svg>';
				}
				$output .= esc_html($badgetext);
				$output .= '</span>';
			}
			
			
			
			$output .= '</div>';
		}
	}

	return $output;

}

/*************************************************
## Single Product Stock
*************************************************/
function bevesi_single_product_stock(){
	global $product;
	
	?>
	<div class="product-inventory-wrapper">
		<?php echo wc_get_stock_html( $product ); ?>
	</div>
	
	<?php
}
add_action( 'woocommerce_single_product_summary', 'bevesi_single_product_stock',25);

/*************************************************
## Vendor Name
*************************************************/
function bevesi_vendor_name(){
	if(class_exists('WeDevs_Dokan')){
		// Get the author ID (the vendor ID)
		$vendor_id = get_post_field( 'post_author', get_the_id() );
		
		$vendor                   = dokan()->vendor->get( $vendor_id );	
		$user_description 		  = get_the_author_meta( 'description', $vendor_id );
		$store_banner_id          = $vendor->get_banner_id();
		$store_name               = $vendor->get_shop_name();
		$store_url                = $vendor->get_shop_url();
		$store_rating             = $vendor->get_rating();			
		$is_store_featured        = $vendor->is_featured();
		
		if (isset($store_name) && $store_name) {
			$output = '';
			
			$output .= '<div class="product-vendor simple">';
			$output .= '<span>'.esc_html__('Store: ', 'bevesi').'</span>';
			$output .= '<a href="'.esc_url($store_url).'">'.esc_html($store_name).'</a>';
			$output .= '</div>';
			
			return $output;		
		}
	}
}

/*************************************************
## Single Vendor Name
*************************************************/
function bevesi_single_vendor_name(){
	if(class_exists('WeDevs_Dokan')){
		// Get the author ID (the vendor ID)
		$vendor_id = get_post_field( 'post_author', get_the_id() );
		
		$vendor                   = dokan()->vendor->get( $vendor_id );	
		$user_description 		  = get_the_author_meta( 'description', $vendor_id );
		$store_banner_id          = $vendor->get_banner_id();
		$store_name               = $vendor->get_shop_name();
		$store_url                = $vendor->get_shop_url();
		$store_rating             = $vendor->get_rating();			
		$is_store_featured        = $vendor->is_featured();
		
		if (isset($store_name) && $store_name) {
			$output = '';
			
			$output .= '<div class="product-vendor">';
			$output .= '<div class="vendor-brand">';
			$output .= '<a href="'.esc_url($store_url).'"><img src="'.esc_url( $vendor->get_avatar() ).'" alt="'.esc_attr($store_name).'"></a>';
			$output .= '</div><!-- vendor-brand -->';
			$output .= '<div class="vendor-detail">';
			$output .= '<span>'.esc_html__('Store:', 'bevesi').'</span>';
			$output .= '<h4 class="store-name"><a href="'.esc_url($store_url).'">'.esc_html($store_name).'</a></h4>';
			$output .= '</div><!-- vendor-detail -->';
			$output .= '<div class="vendor-rating">';
			$output .= '<div class="product-rating yellow">';
                     
			$output .= '<div class="rating-count">';
			if($store_rating['count'] > 0){
			$output .= wc_get_rating_html($store_rating['rating'], $store_rating['count'] );
			$output .= '<span class="count-text">'.esc_html($store_rating['count']).'</span>';
			}
			$output .= '</div><!-- rating-count -->';
			$output .= '</div><!-- product-rating --> ';             
			$output .= '</div><!-- vendor-rating -->';
			$output .= '</div>';
		
			return $output;		
		}
	}
}

if ( class_exists( 'woocommerce' ) ) {
add_theme_support( 'woocommerce' );
add_image_size('bevesi-woo-product', 450, 450, true);

// Remove woocommerce defauly styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// hide default shop title anasayfadaki title gizlemek için
add_filter('woocommerce_show_page_title', 'bevesi_override_page_title');
function bevesi_override_page_title() {
return false;
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); /*remove result count above products*/
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); //remove rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title',10);

add_action( 'woocommerce_before_shop_loop_item', 'bevesi_shop_box', 10);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 ); /*remove breadcrumb*/



remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'bevesi_related_products', 20);
function bevesi_related_products(){
	$related_column = get_theme_mod('bevesi_shop_related_post_column') ? get_theme_mod('bevesi_shop_related_post_column') : '4';
    woocommerce_related_products( array('posts_per_page' => $related_column, 'columns' => $related_column));
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 20);
add_filter( 'woocommerce_cross_sells_columns', 'bevesi_change_cross_sells_columns' );
function bevesi_change_cross_sells_columns( $columns ) {
	return 4;
}

/*----------------------------
  Single Share
 ----------------------------*/
if(!function_exists('bevesi_social_share')){
	function bevesi_social_share(){
		$socialshare = get_theme_mod( 'bevesi_shop_social_share', '0' );

		if($socialshare == '1'){
			wp_enqueue_script('jquery-socialshare');
			wp_enqueue_script('klb-social-share');
		 
			$single_share_multicheck = get_theme_mod('bevesi_shop_single_share',array( 'facebook', 'twitter', 'pinterest', 'linkedin'));
			
			echo'<div class="product-share social-container">';
			echo'<span>'.esc_html__('Share this product:', 'bevesi').'</span>';
			echo'<div class="site-social style-1">';
				echo'<ul>';
					if(in_array('facebook', $single_share_multicheck)){
						echo'<li><a href="#" class="filled social-color facebook"><i class="klb-social-icon-facebook"></i></a></li>';
					}
					if(in_array('twitter', $single_share_multicheck)){
						echo'<li><a href="#" class="filled social-color twitter"><i class="klb-social-icon-twitter"></i></a></li>';
					}
					if(in_array('pinterest', $single_share_multicheck)){	
						echo'<li><a href="#" class="filled social-color pinterest"><i class="klb-social-icon-pinterest"></i></a></li>';
					}
					if(in_array('linkedin', $single_share_multicheck)){	
						echo'<li><a href="#" class="filled social-color linkedin"><i class="klb-social-icon-linkedin"></i></a></li>';
					}	
				echo'</ul>';
				
			echo'</div><!-- site-social -->';
			echo'</div><!-- product-share -->';

		}
	}
}

/*-------------------------------------------
  Product Checklist
 --------------------------------------------*/
function bevesi_single_product_checklist(){
	$singlechecklist = get_theme_mod( 'bevesi_single_checklist', '0' );
 
	
	if($singlechecklist == '1'){
		echo '<div class="product-iconbox">';
        
		$singlechecklist = get_theme_mod('bevesi_single_products_checklist'); 
		foreach($singlechecklist as $f){ 
		
			echo '<div class="iconbox-item">';
			echo '<div class="iconbox-icon"><i class="'.esc_attr($f['checklist_icon']).'"></i></div>';
			echo '<div class="iconbox-message">'.bevesi_sanitize_data($f['checklist_title']).'</div>';
			echo '</div><!-- iconbox-item -->';
			
		}	
		
		echo '</div><!-- product-iconbox -->';
	}
}

/*-------------------------------------------
  Product Brand
 --------------------------------------------*/
function bevesi_single_product_brand(){
	global $product;	
		
		echo '<div class="product-category">';
		echo wc_get_product_category_list($product->get_id(), '');
		echo '</div>';
}

add_action( 'woocommerce_single_product_summary', 'bevesi_single_product_brand', 4);

/*************************************************
## Re-order WooCommerce Single Product Summary
*************************************************/
$reorder_single = get_theme_mod( 'bevesi_shop_single_reorder', 
	array( 
		'bevesi_single_product_brand', 
		'woocommerce_template_single_title', 
		'woocommerce_template_single_rating',
		'woocommerce_template_single_price', 
		'woocommerce_template_single_excerpt',		
		'woocommerce_template_single_add_to_cart', 
		'woocommerce_template_single_meta', 
		'bevesi_single_product_checklist', 
		
	) 
);

if($reorder_single){
	remove_action( 'woocommerce_single_product_summary', 'bevesi_single_product_brand', 4 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'bevesi_single_product_checklist', 45 );
	
	$count = 7;
	
	foreach ( $reorder_single as $single_part ) {
		
		add_action( 'woocommerce_single_product_summary', $single_part, $count );
		
		$count+=7;
	}
}

/*************************************************
## Bevesi Quickview
*************************************************/
function bevesi_quickview($type){
	global $product;
	
	$output = '';
	
	$quickview = get_theme_mod( 'bevesi_quick_view_button', '0' );
	
	if($quickview == '1'){				  
		if($type == 'quickview_type2'){	
			$output .= '<div class="product-button product-quickview quick-view-2">';
			$output .= '<a data-product_id="'.$product->get_id().'" class="quickview-button button size-xs black outline">'.esc_html__('QuickView', 'bevesi').'</a>';
			$output .= '</div>';
		} else {
			$output .= '<div class="product-button product-quickview quick-view-1">';
			$output .= '<a class="quickview-button" data-product_id="'.$product->get_id().'"><i class="klb-icon-eye"></i></a>';
			$output .= '</div>';
		}	
	}	


	return $output;
}

/*************************************************
## Shipping Class Name
*************************************************/
function bevesi_shipping_class_name($stockprogressbar = '', $stockstatus = '', $shippingclass = '') {
	if($shippingclass != 'true'){
		return;
	}
	
	global $product;
	if($product){
		$class_id = $product->get_shipping_class_id();
		if ( $class_id ) {
			$term = get_term_by( 'id', $class_id, 'product_shipping_class' );
			
			if ( $term && ! is_wp_error( $term ) ) {
				if(get_theme_mod('bevesi_product_box_shipping_class_type') == 'bordered'){
					echo '<div class="product-messages">';
					echo '<div class="product-message badge sky">'.esc_html($term->name).'</div>';
					echo '</div>';
				} else {
					echo '<div class="product-messages">';
					echo '<div class="product-message">'.esc_html($term->name).'</div>';
					echo '</div>';
				}
			}
			

		}
	}
}
add_action('bevesi_product_box_footer', 'bevesi_shipping_class_name', 10, 3);


/*************************************************
## Stock Status with Poor
*************************************************/
function bevesi_poor_stock_status($stockprogressbar = '', $stockstatus = ''){
	if($stockstatus != 'true'){
		return;
	}
	
	global $product;
	
	$output = '';
	
	$stock_status = $product->get_stock_status();
	$stock_text = $product->get_availability();
	
	$managestock = $product->managing_stock();
	$stock_quantity = $product->get_stock_quantity();
	$stock_format = esc_html__('Only %s left in stock','bevesi');

	if(get_theme_mod('bevesi_product_box_poor_stock') == '1' && $managestock && $stock_quantity < 10) {
		$output .= '<div class="product-stock text-red-600"><span class="text-11 fw-bold text-uppercase">'.sprintf($stock_format, $stock_quantity).'</span></div>';
	} else {
		if($stock_status == 'instock' && $stock_text['availability']){
			$output .= '<div class="product-stock text-green-600 in-stock"><span class="text-11 fw-bold text-uppercase"> '.$stock_text['availability'].'</span></div>';
		} elseif($stock_text['availability']) {
			$output .= '<div class="solded-product outof-stock"><span class="bordered text-red-900">'.$stock_text['availability'].'</span></div>';
		}
	}
	
	echo bevesi_sanitize_data($output);
}
add_action('bevesi_product_box_footer', 'bevesi_poor_stock_status', 15, 2);

/*----------------------------
  Add my owns Product Box
 ----------------------------*/
function bevesi_shop_box () {
	
	$postview  = isset( $_POST['shop_view'] ) ? $_POST['shop_view'] : '';
	
	$stockprogressbar = get_theme_mod('bevesi_product_box_stock_progress_bar') == 1 ? 'true' : '';
	$stockstatus = get_theme_mod('bevesi_product_box_stock_status') == 1 ? 'true' : '';
	$shippingclass = get_theme_mod('bevesi_product_box_shipping_class') == 1 ? 'true' : '';
	$countdown = get_theme_mod('bevesi_product_box_countdown') == 1 ? 'true' : '';

	if(bevesi_shop_view() == 'list_view' || $postview == 'list_view') {
		echo bevesi_product_type_list();
	} else if(get_theme_mod('bevesi_product_box_type') == 'type6'){
		echo bevesi_product_type6($stockprogressbar, $stockstatus, $shippingclass, $countdown);
	} else if(get_theme_mod('bevesi_product_box_type') == 'type5'){
		echo bevesi_product_type5($stockprogressbar, $stockstatus, $shippingclass, $countdown);
	} else if(get_theme_mod('bevesi_product_box_type') == 'type4'){
		echo bevesi_product_type4($stockprogressbar, $stockstatus, $shippingclass, $countdown);
	} else if(get_theme_mod('bevesi_product_box_type') == 'type3'){
		echo bevesi_product_type3($stockprogressbar, $stockstatus, $shippingclass, $countdown);
	} elseif (get_theme_mod('bevesi_product_box_type') == 'type2'){
		echo bevesi_product_type2($stockprogressbar, $stockstatus, $shippingclass, $countdown);
	} else {
		echo bevesi_product_type1($stockprogressbar, $stockstatus, $shippingclass, $countdown);
	}
}

/*************************************************
## Woo Cart Ajax
*************************************************/ 
add_filter('woocommerce_add_to_cart_fragments', 'bevesi_header_add_to_cart_fragment');
function bevesi_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
	<span class="quick-button-count cart-count count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'bevesi'), $woocommerce->cart->cart_contents_count);?></span>
	

	<?php
	$fragments['span.cart-count'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

    ob_start();
    ?>

    <div class="fl-mini-cart-content">
        <?php woocommerce_mini_cart(); ?>
    </div>

    <?php $fragments['div.fl-mini-cart-content'] = ob_get_clean();

    return $fragments;

} );

add_filter('woocommerce_add_to_cart_fragments', 'bevesi_header_add_to_cart_fragment_subtotal');
function bevesi_header_add_to_cart_fragment_subtotal( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
    <p class="cart-price price"><?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php $fragments['.cart-price'] = ob_get_clean();

	return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'bevesi_header_add_to_cart_fragment_cart_count_text');
function bevesi_header_add_to_cart_fragment_cart_count_text( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
    <div class="cart-count-text count-text"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'bevesi'), $woocommerce->cart->cart_contents_count);?></div>

    <?php $fragments['.cart-count-text'] = ob_get_clean();

	return $fragments;
}

/*************************************************
## Bevesi Woo Search Form
*************************************************/ 
add_filter( 'get_product_search_form' , 'bevesi_custom_product_searchform' );

function bevesi_custom_product_searchform( $form ) {

	$form = '<form action="' . esc_url( home_url( '/'  ) ) . '" class="search-form" role="search" method="get" id="searchform">
              <input type="search" value="' . get_search_query() . '" class="form-control search-input size-lg" name="palavra_chave" placeholder="'.esc_attr__('Procure os melhores serviços próximos à você','bevesi').'" autocomplete="off">
              <button type="submit" class="btn unset search-button color-black"><i class="klb-icon-search"></i></button>
		
            </form>';
			
	return $form;
}

function bevesi_header_product_search() {
	$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => true,
		'parent'    => 0,
	) );

	$form = '';
	
	
	$form .= '<form action="' . esc_url( home_url( '/busca'  ) ) . '" class="search-form" role="search" method="get" id="searchform">';
	$form .= '<div class="search-addon-dropdown">';
	$form .= '<div class="search-addon-input">';
	$form .= '<span class="search-addon-value">'.esc_html__('All', 'bevesi').'</span>';
	$form .= '<i class="klb-icon-chevron-down"></i>';
	$form .= '</div><!-- search-addon-input -->';
	$form .= '<div class="search-addon-dropdown-menu">';
	$form .= '<ul>';
	
	$form .= '<li data-value=""><p>'.esc_html__('All', 'bevesi').'</p></li>';

	foreach ( $terms as $term ) {
		if($term->count >= 1){
			$form .= '<li data-value="'.esc_attr($term->slug).'"><p>'.esc_html($term->name).'</p></li>';
		}
	}
	
	$form .= '</ul>';
	$form .= '</div><!-- search-addon-dropdown-menu -->';
	$form .= '</div><!-- search-addon-dropdown -->';
	$form .= '<input type="search" value="' . get_search_query() . '" class="form-control search-input size-lg" name="palavra_chave" placeholder="'.esc_attr__('Procure os melhores serviços próximos à você','bevesi').'" autocomplete="off">';
	$form .= '<button type="submit" class="btn unset search-button color-black"><i class="klb-icon-search"></i></button>';

	$form .= '</form>';
	
	
	if(function_exists('bevesi_get_most_popular_keywords') && bevesi_get_most_popular_keywords()){
		$form .= '<div class="search-result-tags">';
		$form .= '<span>'.esc_html__('Most searched:', 'bevesi').'</span>';
		$form .= bevesi_get_most_popular_keywords();
		$form .= '</div>';
	}
		
	return $form;
	
}

/*************************************************
## Bevesi Gallery Thumbnail Size
*************************************************/ 
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 90,
        'height' => 54,
        'crop' => 0,
    );
} );


/*************************************************
## Quick View Scripts
*************************************************/ 

function bevesi_quick_view_scripts() {
  	wp_enqueue_script( 'bevesi-quick-ajax', get_template_directory_uri() . '/assets/js/custom/quick_ajax.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bevesi-tab-ajax', get_template_directory_uri() . '/assets/js/custom/tab-ajax.js', array('jquery'), '1.0.0', true );
	wp_localize_script( 'bevesi-quick-ajax', 'MyAjax', array(
		'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
	));
  	wp_enqueue_script( 'bevesi-variationform', get_template_directory_uri() . '/assets/js/custom/variationform.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'wc-add-to-cart-variation' );
}
add_action( 'wp_enqueue_scripts', 'bevesi_quick_view_scripts' );

/*************************************************
## Quick View CallBack
*************************************************/
add_action( 'wp_ajax_nopriv_quick_view', 'bevesi_quick_view_callback' );
add_action( 'wp_ajax_quick_view', 'bevesi_quick_view_callback' );
function bevesi_quick_view_callback() {

	$id = intval( $_POST['id'] );
	$loop = new WP_Query( array(
		'post_type' => 'product',
		'p' => $id,
	  )
	);
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$product = new WC_Product(get_the_ID());
	
	$rating = wc_get_rating_html($product->get_average_rating());
	$price = $product->get_price_html();
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	$product_image_ids = $product->get_gallery_attachment_ids();

	$output = '';
	
		$output .= '<div class="site-quickview">';
		$output .= '<div class="quick-view-product-wrapper">';
		$output .= '<div class="product">';
		$output .= '<div class="single-product-wrapper style-1">';
		
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0];
			
			$output .= '<div class="column single-product-gallery">';
			$output .= '<div class="product-gallery-items">';
			$output .= '<div id="product-images" class="site-slider slider-style loader-default arrows-style-rounded arrows-white" data-items="1" data-itemslaptop="1" data-itemstablet="1" data-itemsmobile="1" data-itemsmobilexs="1" data-slidescroll="1" data-speed="700" data-arrows="true" data-arrowslaptop="true" data-arrowstablet="true" data-arrowsmobile="false" data-dots="false" data-dotslaptop="false" data-dotstablet="false" data-dotsmobile="false" data-draggable="true" data-infinite="false" data-centermode="false" data-autoplay="false" data-assfornav="#product-thumbnails">';
			$output .= '<div class="slider-item"><img src="'.esc_url($image_src).'" /></div><!-- slider-item -->';
		
			foreach( $product_image_ids as $product_image_id ){
			$image_url = wp_get_attachment_url( $product_image_id );
				$output .= '<div class="slider-item"><img src="'.esc_url($image_url).'" /></div>';
			} 	
			
			$output .= '</div><!-- site-slider -->';
			$output .= '</div><!-- product-gallery-items -->';
			
			if($product_image_ids){
				$output .= '<div class="product-thumbnail-items">';
				$output .= '<div id="product-thumbnails" class="site-slider carousel-style loader-default arrows-style-rounded arrows-white" data-items="8" data-itemslaptop="6" data-itemstablet="4" data-itemsmobile="4" data-itemsmobilexs="3" data-slidescroll="1" data-speed="700" data-arrows="false" data-arrowslaptop="false" data-arrowstablet="false" data-arrowsmobile="false" data-dots="false" data-dotslaptop="false" data-dotstablet="false" data-dotsmobile="false" data-infinite="false" data-centermode="false" data-autoplay="false" data-assfornav="#product-images" data-focusonselect="true">';
				$output .= '<div class="slider-item"><img src="'.esc_url($image_src).'" /></div>';
				
				foreach( $product_image_ids as $product_image_id ){	
				$image_url = wp_get_attachment_url( $product_image_id );	
					$output .= '<div class="slider-item"><img src="'.esc_url($image_url).'" /></div>';
				}
				
				$output .= '</div><!-- site-slider -->';
				$output .= '</div><!-- product-thumbnail-items -->';
			}
			
			$output .= '</div><!-- column -->';
		}
		
		$output .= '<div class="column single-product-detail">';
		$output .= '<div class="product-detail-inner">';
			ob_start();
			do_action( 'woocommerce_single_product_summary' );
			$output .= ob_get_clean();
		$output .= '</div><!-- product-detail-inner -->';
		$output .= '</div><!-- column -->';
		
		$output .= '</div><!-- single-product-wrapper -->';
		$output .= '</div><!-- product -->';
		$output .= '</div><!-- quick-view-product-wrapper -->';
		$output .= '</div><!-- site-quickview -->';
		

		endwhile; 
		wp_reset_postdata();

	 	$output_escaped = $output;
	 	echo $output_escaped;
		
		wp_die();
}


/*************************************************
## Bevesi Filter by Attribute
*************************************************/ 
function bevesi_woocommerce_layered_nav_term_html( $term_html, $term, $link, $count ) { 

	$attribute_label_name = wc_attribute_label($term->taxonomy);;
	$attribute_id = wc_attribute_taxonomy_id_by_name($attribute_label_name);
	$attr  = wc_get_attribute($attribute_id);
	$array = json_decode(json_encode($attr), true);

	if(!is_null($array) && $array['type'] == 'color'){		
		$color = get_term_meta( $term->term_id, 'product_attribute_color', true );
		$term_html = '<div class="type-color"><span class="color-box" style="background-color:'.esc_attr($color).';"></span>'.$term_html.'</div>';
	}
	
	if(!is_null($array) && $array['type'] == 'button'){
		$term_html = '<div class="type-button"><span class="button-box"></span>'.$term_html.'</div>';
	}

    return $term_html; 
}; 
         
add_filter( 'woocommerce_layered_nav_term_html', 'bevesi_woocommerce_layered_nav_term_html', 10, 4 ); 


/*************************************************
## Shop Width Body Classes
*************************************************/
function bevesi_body_classes( $classes ) {

	if( get_theme_mod('bevesi_shop_width') == 'wide' || bevesi_get_option() == 'wide' && is_shop()) { 
		$classes[] = 'shop-wide';
	}elseif( get_theme_mod('bevesi_single_full_width') == 1 || bevesi_get_option() == 'wide' && is_product()) { 
		$classes[] = 'shop-wide';
	} else {
		$classes[] = '';
	}
	
	return $classes;
}
add_filter( 'body_class', 'bevesi_body_classes' );

/*************************************************
## Stock Availability Translation
*************************************************/ 
if(get_theme_mod('bevesi_stock_quantity',0) != 1){
add_filter( 'woocommerce_get_availability', 'bevesi_custom_get_availability', 1, 2);
function bevesi_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = esc_html__('In Stock', 'bevesi');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = esc_html__('Out of stock', 'bevesi');
    }
    return $availability;
}
}

/*************************************************
## Archive Description After Content
*************************************************/
if(get_theme_mod('bevesi_category_description_after_content',0) == 1){
	remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
	remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
	add_action('bevesi_after_main_shop', 'woocommerce_taxonomy_archive_description', 5);
	add_action('bevesi_after_main_shop', 'woocommerce_product_archive_description', 5);
}

/*************************************************
## Catalog Mode - Disable Add to cart Button
*************************************************/
if(get_theme_mod('bevesi_catalog_mode', 0) == 1 || bevesi_get_option() == 'catalogmode'){ 
	add_filter( 'woocommerce_loop_add_to_cart_link', 'bevesi_remove_add_to_cart_buttons', 1 );
	function bevesi_remove_add_to_cart_buttons() {
		return false;
	}
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);
}

/*************************************************
## Related Products with Tags
*************************************************/
if(get_theme_mod('bevesi_related_by_tags',0) == 1){
	add_filter( 'woocommerce_product_related_posts_relate_by_category', '__return_false' );
}

/*************************************************
## Product Specification Tab
*************************************************/ 
add_filter( 'woocommerce_product_tabs', 'bevesi_product_specification_tab' );
function bevesi_product_specification_tab( $tabs ) {
	$specification = get_post_meta( get_the_ID(), 'klb_product_specification', true );
	
	// Adds the new tab
	if($specification){
		$tabs['specification'] = array(
			'title' 	=> esc_html__( 'Specification', 'bevesi' ),
			'priority' 	=> 15,
			'callback' 	=> 'bevesi_product_specification_tab_content'
		);
	}
	
	return $tabs;
}
function bevesi_product_specification_tab_content() {
	$specification = get_post_meta( get_the_ID(), 'klb_product_specification', true );
	echo '<div class="specification-content">'.bevesi_sanitize_data($specification).'</div>';
}
} // is woocommerce activated

?>