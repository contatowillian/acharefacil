<?php 
/*************************************************
* Catalog Ordering
*************************************************/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); 
add_action( 'klb_catalog_ordering', 'woocommerce_catalog_ordering', 30 ); 

add_action( 'woocommerce_before_shop_loop', 'bevesi_catalog_ordering_start', 30 );
function bevesi_catalog_ordering_start(){
?>
	
	<div class="before-shop-loop">
		<div class="column left">
			<?php if( get_theme_mod( 'bevesi_shop_layout' ) == 'full-width' || bevesi_get_option() == 'full-width') { ?>
				  <div class="filter-wide-button dropdown d-none d-lg-inline-flex align-items-center">
					<a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"><i class="klb-icon-filter"></i>
					  
					 <?php esc_html_e('Filter Products','bevesi-core'); ?>
					</a>
					<div class="dropdown-menu">
					  <div class="filter-products-wrapper">
						<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'shop-sidebar' ); ?>
						<?php } ?>
					  </div><!-- filter-holder-wrapper -->
					</div><!-- filter-holder -->
				  </div><!-- filter-wide-button -->
			<?php } ?>
			
				<a href="#" class="filter-button"><i class="klb-icon-filter"></i> <?php esc_html_e('Filter', 'bevesi-core'); ?></a>
				<?php add_action( 'bevesi_result_count', 'woocommerce_result_count', 20 ); ?>
			<?php do_action('bevesi_result_count'); ?>
		</div><!-- column -->
	
		<div class="column right">
			<div class="shop-sorting-wrapper">
				<!-- For get orderby from loop -->
				<?php do_action('klb_catalog_ordering'); ?>
			
				<!-- For perpage option-->
				<?php if(get_theme_mod('bevesi_perpage_view','0') == '1'){ ?>
					<?php $perpage = isset($_GET['perpage']) ? $_GET['perpage'] : ''; ?>
					<?php $defaultperpage = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page(); ?>
					<?php $options = array($defaultperpage,$defaultperpage*2,$defaultperpage*3,$defaultperpage*4); ?>
					<div class="sorting-per-page">
					  <span><?php esc_html_e('Show:','bevesi-core'); ?></span>
					  <form class="woocommerce-ordering product-filter products-per-page" method="get">
						<?php if (bevesi_get_body_class('bevesi-ajax-shop-on')) { ?>
							<select name="perpage" class="perpage orderby filterSelect " data-class="select-filter-perpage">
						<?php } else { ?>
							<select name="perpage" class="perpage orderby filterSelect " data-class="select-filter-perpage" onchange="this.form.submit()">
						<?php } ?>
							<?php for( $i=0; $i<count($options); $i++ ) { ?>
							<option value="<?php echo esc_attr($options[$i]); ?>" <?php echo esc_attr($perpage == $options[$i] ? 'selected="selected"' : ''); ?>><?php echo esc_html($options[$i]); ?> <?php esc_html_e('Items','bevesi-core'); ?></option>
							<?php } ?>
						</select>
						<?php wc_query_string_form_fields( null, array( 'perpage', 'submit', 'paged', 'product-page' ) ); ?>		
					  </form>
					</div>
				<?php } ?>
			</div><!-- shop-sorting-wrapper -->
		 
			<?php if(get_theme_mod('bevesi_grid_list_view','0') == '1'){ ?>
				<div class="product-views-buttons hide-below-992">
					<?php if(bevesi_shop_view() == 'list_view') { ?>
						<a href="<?php echo esc_url(add_query_arg('shop_view','grid_view')); ?>" class="grid-view" data-bs-toggle="tooltip" data-bs-placement="top" title="Grid Products">
							<i class="klb-icon-layout-grid"></i>                     
						</a>
					
						<a href="<?php echo esc_url(add_query_arg('shop_view','list_view')); ?>" class="list-view active" data-bs-toggle="tooltip" data-bs-placement="top" title="List Products">
							<i class="klb-icon-layout-list"></i>                   
						</a>
					<?php } else { ?>
						<a href="<?php echo esc_url(add_query_arg('shop_view','grid_view')); ?>" class="grid-view active" data-bs-toggle="tooltip" data-bs-placement="top" title="Grid Products">
							<i class="klb-icon-layout-grid"></i>                        
						</a>
					
						<a href="<?php echo esc_url(add_query_arg('shop_view','list_view')); ?>" class="list-view" data-bs-toggle="tooltip" data-bs-placement="top" title="List Products">
							<i class="klb-icon-layout-list"></i>                     
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div><!-- column -->
	</div>
	
<?php

}