<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$thumb_type = get_theme_mod( 'bevesi_single_gallery_type' ) == 'vertical' ? 'vertical' : ''; 

?>

<?php if( get_theme_mod( 'bevesi_single_type' ) == 'type2') { ?>	
	<?php $single_type = 'style-2'; ?>
<?php } else { ?>
	<?php $single_type = 'style-1'; ?>
<?php } ?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product', $product ); ?>>
			
	<div class="single-product-wrapper <?php echo esc_attr($single_type); ?>">
		<div class="column single-product-gallery <?php echo esc_attr($thumb_type); ?>">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
		</div>
		
		<div class="column single-product-detail segunda_coluna_detalhes_anuncio">			
			<div class="product-detail-inner">			
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div>

		<div class="column single-product-detail">			
			<div class="product-detail-inner">
			<div class="product-category"><a href="http://acharefacil.test/product-category/auto-escola/" rel="tag">Informações</a><a href="http://acharefacil.test/product-category/automotivo/" rel="tag">Automotivo</a><a href="http://acharefacil.test/product-category/toys-video-games/" rel="tag">Brinquedos</a><a href="http://acharefacil.test/product-category/cosmeticos/" rel="tag">Cosmeticos</a><a href="http://acharefacil.test/product-category/eletronicos/" rel="tag">Eletrônicos</a><a href="http://acharefacil.test/product-category/imobiliarias/" rel="tag">Imobiliarias</a><a href="http://acharefacil.test/product-category/lavanderias/" rel="tag">Lavanderias</a><a href="http://acharefacil.test/product-category/moda-accessorios/" rel="tag">Moda &amp; Acessorios</a><a href="http://acharefacil.test/product-category/sorveterias/" rel="tag">Sorveterias</a></div>
			<h1 class="product_title entry-title telefone_detalhe_anuncio"><i class="klb-icon-phone"></i>(11)9878-52654</h1>
			<div class="product-meta">
			</div>
			<div class="woocommerce-product-details__short-description">
				<p><i class="klb-icon-home"></i>Av. Paulista, 80 - São Paulo,SP</p>
			</div>
			
			<div class="woocommerce-product-details__short-description">
				<p><i class="klb-icon-www"></i>www.textexpto.com.br</p>
			</div>
			<?php bevesi_social_share();?>
		
			<!-- product-share -->			
			</div>
		</div>
	
		
		<?php do_action('bevesi_single_side_inner'); ?>
	</div>	
	<div class="single-product-tabs-wrapper style-1">	
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>

	
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>