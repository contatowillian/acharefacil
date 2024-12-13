<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>

<div class="product-meta">
		
	<?php if ( $rating_count > 0 ) : ?>	
		<div class="product-rating black">
			<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
				<?php if ( comments_open() ) : ?>
				<?php //phpcs:disable ?>
				<div class="rating-count">
					<span class="count-text"><?php echo esc_html( $review_count ); ?></span>
				</div><!-- rating-count -->
				<?php // phpcs:enable ?>
			<?php endif ?>
		</div><!-- product-rating -->            
	<?php endif; ?>
	
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>	
		<div class="product-sku">
			<span><?php esc_html_e( 'SKU:', 'bevesi' ); ?></span>
			<span class="sku"><?php echo ( bevesi_sanitize_data($sku = $product->get_sku() )) ? $sku : esc_html__( 'N/A', 'bevesi' ); ?></span>
		</div><!-- product-sku -->
	<?php endif; ?>
</div>
	