<?php 
/*************************************************
## Bevesi Typography
*************************************************/

function bevesi_rgba_selector($rgbacolor = ''){
	$explode = array_slice(explode(',',$rgbacolor), 0, -1);
	$implode = implode(',', $explode);

	return str_replace("rgba(", "",$implode);
}


function bevesi_custom_styling() { ?>

<style type="text/css">

<?php if (get_theme_mod( 'bevesi_mobile_sticky_header',0 ) == 1) { ?>
@media(max-width:64rem){
	header.site-header.sticky-header {
		position: relative;
		z-index: 99;
	}
	.sticky-header #header-main {
		position: fixed !important;
		width: 100%;
		top: 0;
		z-index: 10;
	}

	.sticky-header #header-main::before {
		content: "";
		position: absolute;
		width: 100%;
		height: 0.0625rem;
		bottom: 0;
		background-color: currentColor;
		opacity: 0.1;
	}
}
<?php } ?>

<?php if (get_theme_mod( 'bevesi_sticky_header',0 ) == 1) { ?>
@media(min-width:64rem){
	header.site-header.sticky-header {
		position: relative;
		z-index: 99;
	}
	.sticky-header #header-main {
		position: fixed !important;
		width: 100%;
		top: 0;
		z-index: 10;
	}

	.sticky-header #header-main::before {
		content: "";
		position: absolute;
		width: 100%;
		height: 0.0625rem;
		bottom: 0;
		background-color: currentColor;
		opacity: 0.1;
	}
}
<?php } ?>

<?php if (get_theme_mod( 'bevesi_mobile_single_sticky_cart',0 ) == 1) { ?>
@media(max-width:64rem){
	.single .product-type-simple form.cart {
	    position: fixed;
	    bottom: 0;
	    right: 0;
	    z-index: 10000000;
	    background: #fff;
	    margin-bottom: 0;
	    padding: 15px;
	    -webkit-box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    justify-content: space-between;
		width: 100%;
	}

	.single .woocommerce-variation-add-to-cart {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    position: fixed;
	    bottom: 0;
	    right: 0;
	    z-index: 10000000;
	    background: #fff;
	    margin-bottom: 0;
	    padding: 15px;
	    -webkit-box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    justify-content: space-between;
    	width: 100%;
		flex-wrap: wrap;
		width: 100%; 
		margin-bottom: 0px !important;
	}

	.single .site-footer .footer-row.footer-copyright {
	    margin-bottom: 79px;
	}

}
<?php } ?>

<?php if (get_theme_mod( 'bevesi_main_color' )) { ?>
:root {
    --site-primary-color: <?php echo esc_attr(bevesi_rgba_selector(get_theme_mod( 'bevesi_main_color' ))); ?>;
}
<?php } ?>


<?php if (get_theme_mod( 'bevesi_secondary_color' )) { ?>
:root {
    --site-secondary-color: <?php echo esc_attr(bevesi_rgba_selector(get_theme_mod( 'bevesi_secondary_color' ))); ?>;
}
<?php } ?>


<?php if(function_exists('dokan')){ ?>

	input[type='submit'].dokan-btn-theme,
	a.dokan-btn-theme,
	.dokan-btn-theme {
		background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
		border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	input[type='submit'].dokan-btn-theme .badge,
	a.dokan-btn-theme .badge,
	.dokan-btn-theme .badge {
		color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.dokan-announcement-uread {
		border: 1px solid <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?> !important;
	}
	.dokan-announcement-uread .dokan-annnouncement-date {
		background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?> !important;
	}
	.dokan-announcement-bg-uread {
		background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover {
		background: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover {
		background: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active {
		background: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.dokan-product-listing .dokan-product-listing-area table.product-listing-table td.post-status label.pending {
		background: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.product-edit-container .dokan-product-title-alert,
	.product-edit-container .dokan-product-cat-alert {
		color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.product-edit-container .dokan-product-less-price-alert {
		color: <?php echo esc_attr(get_theme_mod( 'bevesi_main_color' ) ); ?>;
	}
	.dokan-store-wrap {
	    margin-top: 3.5rem;
	}
	.dokan-widget-area ul {
	    list-style: none;
	    padding-left: 0;
	    font-size: .875rem;
	    font-weight: 400;
	}
	.dokan-widget-area ul li a {
	    text-decoration: none;
	    color: var(--color-text-lighter);
	    margin-bottom: .625rem;
	    display: inline-block;
	}
	form.dokan-store-products-ordeby:before, 
	form.dokan-store-products-ordeby:after {
		content: '';
		display: table;
		clear: both;
	}
	.dokan-store-products-filter-area .orderby-search {
	    width: auto;
	}
	input.search-store-products.dokan-btn-theme {
	    border-top-left-radius: 0;
	    border-bottom-left-radius: 0;
	}
	.dokan-pagination-container .dokan-pagination li a {
	    display: -webkit-inline-box;
	    display: -ms-inline-flexbox;
	    display: inline-flex;
	    -webkit-box-align: center;
	    -ms-flex-align: center;
	    align-items: center;
	    -webkit-box-pack: center;
	    -ms-flex-pack: center;
	    justify-content: center;
	    font-size: .875rem;
	    font-weight: 600;
	    width: 2.25rem;
	    height: 2.25rem;
	    border-radius: 50%;
	    color: currentColor;
	    text-decoration: none;
	    border: none;
	}
	.dokan-pagination-container .dokan-pagination li.active a {
	    color: #fff;
	    background-color: var(--color-secondary) !important;
	}
	.dokan-pagination-container .dokan-pagination li:last-child a, 
	.dokan-pagination-container .dokan-pagination li:first-child a {
	    width: auto;
	}

	.vendor-customer-registration label {
	    margin-right: 10px;
	}

	.woocommerce-mini-cart dl.variation {
	    display: none;
	}

	.product-name dl.variation {
	    display: none;
	}

	.seller-rating .star-rating span.width + span {
	    display: none;
	}
	
	.seller-rating .star-rating {width: 70px;display: block;}

<?php } ?>

<?php if (function_exists('get_wcmp_vendor_settings') && is_user_logged_in()) {
	if(is_vendor_dashboard()){	
} ?>

.woosc-popup, div#woosc-area {
    display: none;
}
	
.select-location {
    display: none;
}
	
<?php } ?>
:root {
    --site-logo-height-desktop: <?php echo esc_attr(get_theme_mod( 'bevesi_logo_size' ) ); ?>px;
}

:root {
    --site-logo-height-mobile: <?php echo esc_attr(get_theme_mod( 'bevesi_mobil_logo_size' ) ); ?>px;
}

.site-header.header-type1 .site-header-topbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_top_font_color' ) ); ?>;
}

.site-header.header-type1 .site-header-row.header-row-text-slate .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_top_font_color' ) ); ?>;
}

.site-header.header-type1 .site-header-row.header-row-text-slate .menu > li > a:hover,
.site-header.header-type1 .site-header-row.header-row-text-slate .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_top_font_hvrcolor' ) ); ?>;
}

.site-header.header-type1 .site-header-row.border-container .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_top_border_color' ) ); ?> !important;
}

.site-header.header-type1 .site-header-main{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_main_bg_color' ) ); ?>;
}

.site-header.header-type1 .site-header-main .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_main_border_color' ) ); ?> !important;
}

.site-header.header-type1 .site-header-main .site-header-inner .site-quick-button{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_main_icon_color' ) ); ?>;
}

.site-header.header-type1 .site-header-bottom{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_border_color' ) ); ?> !important;
}

.site-header.header-type1 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_font_color' ) ); ?>;
}

.site-header.header-type1 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_font_hvrcolor' ) ); ?>;	
}

.site-header.header-type1 .site-header-bottom .site-menu.horizontal.primary-menu .mega-menu > .sub-menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_submenu_header_font_color' ) ); ?>;
}

.site-header.header-type1 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_submenu_font_color' ) ); ?>;
}

.site-header.header-type1 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_submenu_font_hvrcolor' ) ); ?>;
	text-decoration-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header1_bottom_submenu_font_hvrcolor' ) ); ?>;
}

.site-header.header-type2 .site-header-topbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_top_font_color' ) ); ?>;
}

.site-header.header-type2 .site-header-row.header-row-text-slate .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_top_font_color' ) ); ?>;
}

.site-header.header-type2 .site-header-row.header-row-text-slate .menu > li > a:hover,
.site-header.header-type2 .site-header-row.header-row-text-slate .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_top_font_hvrcolor' ) ); ?>;
}

.site-header.header-type2 .site-header-main{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_main_bg_color' ) ); ?>;
}

.site-header.header-type2 .site-header-main .site-header-inner .site-quick-button{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_main_icon_color' ) ); ?>;
}

.site-header.header-type2 .site-header-bottom{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_border_color' ) ); ?> !important;
}

.site-header.header-type2 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_font_color' ) ); ?>;
}

.site-header.header-type2 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_font_hvrcolor' ) ); ?>;	
}

.site-header.header-type2 .site-header-bottom .site-menu.horizontal.primary-menu .mega-menu > .sub-menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_submenu_header_font_color' ) ); ?>;
}

.site-header.header-type2 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_submenu_font_color' ) ); ?>;
}

.site-header.header-type2 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_submenu_font_hvrcolor' ) ); ?>;
	text-decoration-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header2_bottom_submenu_font_hvrcolor' ) ); ?>;
}

.site-header.header-type3 .site-header-topbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_top_font_color' ) ); ?> !important;
}

.site-header.header-type3 .site-header-row.header-row-text-gray .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_top_font_color' ) ); ?> !important;
}
.site-header.header-type3 .site-header-row.header-row-text-gray .menu > li > a:hover,
.site-header.header-type3 .site-header-row.header-row-bg-black.header-row-text-gray .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_top_font_hvrcolor' ) ); ?> !important;
}

.site-header.header-type3 .site-header-topbar .site-header-row.border-container .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_top_border_color' ) ); ?> !important;
}

.site-header.header-type3 .site-header-main{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_main_bg_color' ) ); ?>;
}

.site-header.header-type3 .site-header-main .site-header-inner .site-quick-button{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_main_icon_color' ) ); ?>;
}

.site-header.header-type3 .site-header-bottom{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_border_color' ) ); ?> !important;
}

.site-header.header-type3 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_font_color' ) ); ?>;
}

.site-header.header-type3 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_font_hvrcolor' ) ); ?>;	
}

.site-header.header-type3 .site-header-bottom .site-menu.horizontal.primary-menu .mega-menu > .sub-menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_submenu_header_font_color' ) ); ?>;
}

.site-header.header-type3 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_submenu_font_color' ) ); ?>;
}

.site-header.header-type3 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_submenu_font_hvrcolor' ) ); ?>;
	text-decoration-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header3_bottom_submenu_font_hvrcolor' ) ); ?>;
}

.site-header.header-type4 .site-header-topbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_top_font_color' ) ); ?>;
}

.site-header.header-type4 .site-header-topbar .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_top_font_hvrcolor' ) ); ?>;
}

.site-header.header-type4 .site-header-row.border-container .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_top_border_color' ) ); ?> !important;
}

.site-header.header-type4 .site-header-main{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_main_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_main_border_color' ) ); ?> !important;
}

.site-header.header-type4 .site-header-main .site-header-inner .site-quick-button{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_main_icon_color' ) ); ?>;
}

.site-header.header-type4 .site-header-bottom{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_border_color' ) ); ?> !important;
}

.site-header.header-type4 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_font_color' ) ); ?>;
}

.site-header.header-type4 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_font_hvrcolor' ) ); ?>;	
}

.site-header.header-type4 .site-header-bottom .site-menu.horizontal.primary-menu .mega-menu > .sub-menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_submenu_header_font_color' ) ); ?>;
}

.site-header.header-type4 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_submenu_font_color' ) ); ?>;
}

.site-header.header-type4 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_submenu_font_hvrcolor' ) ); ?>;
	text-decoration-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header4_bottom_submenu_font_hvrcolor' ) ); ?>;
}

.site-header.header-type5 .site-header-topbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_top_font_color' ) ); ?>;
}

.site-header.header-type5 .site-header-row.header-row-text-slate .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_top_font_color' ) ); ?>;
}

.site-header.header-type5 .site-header-row.header-row-text-slate .menu > li > a:hover,
.site-header.header-type5 .site-header-row.header-row-text-slate .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_top_font_hvrcolor' ) ); ?>;
}

.site-header.header-type5 .site-header-row.border-container .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_top_border_color' ) ); ?> !important;
}

.site-header.header-type5 .site-header-main{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_bg_color' ) ); ?>;
}

.site-header.header-type5 .site-header-main .site-menu.horizontal.primary-menu .menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_font_color' ) ); ?>;
}

.site-header.header-type5 .site-header-main .site-menu.horizontal.primary-menu .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_font_hvrcolor' ) ); ?>;
}

.site-header.header-type5 .site-header-main .site-menu.horizontal.primary-menu .mega-menu > .sub-menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_submenu_header_font_color' ) ); ?>;
}

.site-header.header-type5 .site-header-main.header-row-text-black .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_submenu_font_color' ) ); ?>;
}

.site-header.header-type5 .site-header-main.header-row-text-black .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_submenu_font_hvrcolor' ) ); ?>;
	text-decoration-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_submenu_font_hvrcolor' ) ); ?>;
}

.site-header.header-type5 .site-header-main .site-header-inner .site-quick-button{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_main_icon_color' ) ); ?>;
}

.site-header.header-type5 .site-header-bottom{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header5_bottom_border_color' ) ); ?> !important;
}

.site-header.header-type6 .site-header-topbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_top_font_color' ) ); ?>;
}

.site-header.header-type6 .site-header-row.header-row-text-slate .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_top_font_color' ) ); ?>;
}

.site-header.header-type6 .site-header-row.header-row-text-slate .menu > li > a:hover,
.site-header.header-type6 .site-header-row.header-row-text-slate .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_top_font_hvrcolor' ) ); ?>;
}

.site-header.header-type6 .site-header-row.border-container .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_top_border_color' ) ); ?> !important;
}

.site-header.header-type6 .site-header-main{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_main_bg_color' ) ); ?>;
}

.site-header.header-type6 .site-header-main .site-header-inner{
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_main_border_color' ) ); ?> !important;
}

.site-header.header-type6 .site-header-main .site-header-inner .site-quick-button{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_main_icon_color' ) ); ?>;
}

.site-header.header-type6 .site-header-bottom{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_border_color' ) ); ?> !important;
}

.site-header.header-type6 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_font_color' ) ); ?>;
}

.site-header.header-type6 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_font_hvrcolor' ) ); ?>;	
}

.site-header.header-type6 .site-header-bottom .site-menu.horizontal.primary-menu .mega-menu > .sub-menu > li > a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_submenu_header_font_color' ) ); ?>;
}

.site-header.header-type6 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_submenu_font_color' ) ); ?>;
}

.site-header.header-type6 .site-header-bottom .site-menu.horizontal.primary-menu .sub-menu a:hover{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_submenu_font_hvrcolor' ) ); ?>;
	text-decoration-color: <?php echo esc_attr(get_theme_mod( 'bevesi_header6_bottom_submenu_font_hvrcolor' ) ); ?>;
}

.klb-mobile-bottom.site-mobile-navbar .site-mobile-navbar-inner ul li a .mobile-navbar-label{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_mobile_bottom_menu_font_color' ) ); ?>;
}

.klb-mobile-bottom.site-mobile-navbar .site-mobile-navbar-inner ul li a i{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_mobile_bottom_menu_icon_color' ) ); ?>;
}

.klb-mobile-bottom.site-mobile-navbar{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_mobile_bottom_menu_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_mobile_bottom_menu_border_color' ) ); ?>;
}

.site-notification.site-notification-global{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_top_notification_bg_color' ) ); ?> !important;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_top_notification_font_color' ) ); ?> !important;
}

.site-notification.site-notification-global .site-notification-inner .button{
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_top_notification_button_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_top_notification_button_color' ) ); ?>;
}

.site-footer #footer-iconboxes {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_icon_box_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_icon_box_border_color' ) ); ?>;
}

.site-footer #footer-iconboxes .iconboxes-content h4,
.site-footer #footer-iconboxes .site-footer-inner .iconboxes .iconbox .content .entry-title{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_icon_box_title_color' ) ); ?>;
}

.site-footer #footer-iconboxes .iconboxes-content p,
.site-footer #footer-iconboxes .site-footer-inner .iconboxes .iconbox .content p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_icon_box_subtitle_color' ) ); ?>;
}

.site-footer #footer-iconboxes .site-footer-inner .iconboxes .iconbox .icon{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_icon_box_icon_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-newsletter {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_top_title_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-widgets {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_main_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_main_border_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-widgets .widget .widget-title{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_main_title_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-widgets .site-footer-inner .widget .menu li a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_main_subtitle_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-contact {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_bottom_border_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-contact .site-footer-inner ul li a i{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_bottom_icon_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-contact .site-footer-inner ul li a p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_bottom_title_color' ) ); ?>;
}

.site-footer.footer-type1 #footer-copyright {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_copyright_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_copyright_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer1_copyright_border_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-newsletter {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_top_title_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-newsletter.footer-newsletter-style-2 .site-footer-newsletter-column .footer-newsletter-text p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_top_subtitle_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-widgets {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_main_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_main_border_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-widgets .widget .widget-title{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_main_title_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-widgets .site-footer-inner .widget .menu li a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_main_subtitle_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-contact {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_bottom_border_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-contact .site-footer-inner ul li a i{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_bottom_icon_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-contact .site-footer-inner ul li a p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_bottom_title_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-copyright {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_copyright_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_copyright_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_copyright_border_color' ) ); ?>;
}

.site-footer.footer-type2 #footer-copyright .site-footer-inner .site-copyright-content p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer2_copyright_title_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-newsletter {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_top_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_top_title_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-newsletter.footer-newsletter-style-1 .footer-newsletter-text p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_top_subtitle_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-widgets {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_main_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_main_border_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-widgets .widget .widget-title{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_main_title_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-widgets .site-footer-inner .widget .menu li a{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_main_subtitle_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-contact {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_bottom_bg_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_bottom_border_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-contact .site-footer-inner ul li a i{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_bottom_icon_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-contact .site-footer-inner ul li a p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_bottom_title_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-copyright {
	background-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_copyright_bg_color' ) ); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_copyright_color' ) ); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_copyright_border_color' ) ); ?>;
}

.site-footer.footer-type3 #footer-copyright .site-footer-inner .site-copyright-content p{
	color: <?php echo esc_attr(get_theme_mod( 'bevesi_footer3_copyright_title_color' ) ); ?>;
}

:root {
<?php
	// Body Typography
    $bodyfont = get_theme_mod('bevesi_body_typography', []); 
	
	if ( isset( $bodyfont['font-family'] ) ) {
		echo '--site-body-font: '.$bodyfont['font-family'].';'; 
	}
	
	if ( isset( $bodyfont['font-size'] ) ) {
		echo '--site-body-font-size: '.$bodyfont['font-size'].';'; 
	}
	
	if ( isset( $bodyfont['variant'] ) ) {
		echo '--site-body-font-weight: '.$bodyfont['variant'].';'; 
	}
	
	if ( isset( $bodyfont['letter-spacing'] ) ) {
		echo '--site-body-letter-spacing: '.$bodyfont['letter-spacing'].';'; 
	}
	
	if ( isset( $bodyfont['line-height'] ) ) {
		echo '--site-body-line-height: '.$bodyfont['line-height'].';'; 
	}
	
	// Heading Typography
    $headingfont = get_theme_mod('bevesi_heading_typography', []); 
	
	if ( isset( $headingfont['font-family'] ) ) {
		echo '--site-heading-font: '.$headingfont['font-family'].';'; 
	}
	
	if ( isset( $headingfont['variant'] ) ) {
		echo '--site-heading-font-weight: '.$headingfont['variant'].';'; 
	}
	
	if ( isset( $headingfont['letter-spacing'] ) ) {
		echo '--site-heading-letter-spacing: '.$headingfont['letter-spacing'].';'; 
	}
	
	// Main Menu Typography
    $menufont = get_theme_mod('bevesi_menu_typography', []); 
	
	if ( isset( $menufont['font-family'] ) ) {
		echo '--site-main-menu-font: '.$menufont['font-family'].';'; 
	}
	
	if ( isset( $menufont['font-size'] ) ) {
		echo '--site-main-menu-font-size: '.$menufont['font-size'].';'; 
	}
	
	if ( isset( $menufont['variant'] ) ) {
		echo '--site-main-menu-font-weight: '.$menufont['variant'].';'; 
	}
	
	if ( isset( $menufont['letter-spacing'] ) ) {
		echo '--site-main-menu-letter-spacing: '.$menufont['letter-spacing'].';'; 
	}
	
	if ( isset( $menufont['text-transform'] ) ) {
		echo '--site-main-menu-transform: '.$menufont['text-transform'].';'; 
	}
	
	// Form Typography
    $formfont = get_theme_mod('bevesi_form_typography', []); 
	
	if ( isset( $formfont['font-family'] ) ) {
		echo '--site-form-input-font: '.$formfont['font-family'].';'; 
	}
	
	if ( isset( $formfont['variant'] ) ) {
		echo '--site-form-input-font-weight: '.$formfont['variant'].';'; 
	}
	
	if ( isset( $formfont['font-size'] ) ) {
		echo '--site-form-input-font-size: '.$formfont['font-size'].';'; 
	}
	
	if ( isset( $formfont['letter-spacing'] ) ) {
		echo '--site-form-input-letter-spacing: '.$formfont['letter-spacing'].';'; 
	}

	// Button Typography
    $buttonfont = get_theme_mod('bevesi_button_typography', []); 
	
	if ( isset( $buttonfont['font-family'] ) ) {
		echo '--site-form-button-font: '.$buttonfont['font-family'].';'; 
	}
	
	if ( isset( $buttonfont['variant'] ) ) {
		echo '--site-form-button-weight: '.$buttonfont['variant'].';'; 
	}
	
	if ( isset( $buttonfont['font-size'] ) ) {
		echo '--site-form-button-font-size: '.$buttonfont['font-size'].';'; 
	}
	
	if ( isset( $buttonfont['letter-spacing'] ) ) {
		echo '--site-form-button-letter-spacing: '.$buttonfont['letter-spacing'].';'; 
	}
	
	// Price Typography
    $pricefont = get_theme_mod('bevesi_price_typography', []); 
	
	if ( isset( $pricefont['font-family'] ) ) {
		echo '--site-product-price-font: '.$pricefont['font-family'].';'; 
	}
	
	if ( isset( $pricefont['variant'] ) ) {
		echo '--site-product-price-weight: '.$pricefont['variant'].';'; 
	}
	
	if ( isset( $pricefont['font-size'] ) ) {
		echo '--site-product-price-font-size-base: '.$pricefont['font-size'].';'; 
	}
	
	if ( isset( $buttonfont['letter-spacing'] ) ) {
		echo '--site-product-price-letter-spacing: '.$buttonfont['letter-spacing'].';'; 
	}
	
	
	// Product Name Typography
    $productnamefont = get_theme_mod('bevesi_product_name_typography', []); 
	
	if ( isset( $productnamefont['font-family'] ) ) {
		echo '--site-product-name-font: '.$productnamefont['font-family'].';'; 
	}
	
	if ( isset( $productnamefont['variant'] ) ) {
		echo '--site-product-name-weight: '.$productnamefont['variant'].';'; 
	}
	
	if ( isset( $productnamefont['font-size'] ) ) {
		echo '--site-product-name-font-size-base: '.$productnamefont['font-size'].';'; 
	}
	
	if ( isset( $buttonfont['letter-spacing'] ) ) {
		echo '--site-product-name-letter-spacing: '.$buttonfont['letter-spacing'].';'; 
	}

	
	// Border Radius
	if ( get_theme_mod('bevesi_border_radius') ) {
		echo '--site-site-radius-default: '.get_theme_mod('bevesi_border_radius').';'; 
	}
	
	if ( get_theme_mod('bevesi_site_width') ) {
		echo '--site-site-width: '.get_theme_mod('bevesi_site_width').';'; 
	}
	
	if ( get_theme_mod('bevesi_site_gutter') ) {
		echo '--site-site-gutter: '.get_theme_mod('bevesi_site_gutter').';'; 
	}
	
?>
}

</style>
<?php }
add_action('wp_head','bevesi_custom_styling');

?>