<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0
 * 
 */
 ?>
 
 
		</div><!-- main-content -->
		
		<?php bevesi_do_action( 'bevesi_before_main_footer'); ?>

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>
		
			<?php
			/**
			* Hook: bevesi_main_footer
			*
			* @hooked bevesi_main_footer_function - 10
			*/
			do_action( 'bevesi_main_footer' );
		
			?>
			
		<?php } ?>
		
		<?php bevesi_do_action( 'bevesi_after_main_footer'); ?>	
		
	</div><!-- page-content -->
  
	<?php wp_footer(); ?>
  
    </body>
    
    <div id="container">
        <a href="https://wa.me/5511993112353?text=Ol%C3%A1,%20vi%20seu%20an%C3%BAncio%20no%20site%20Achar%20%C3%A9%20F%C3%A1cil%20www.acharefacil.com.br%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es." target="_blank">
            <div class="corpo">
                <div class="painelvermelho"></div>
            </div>
        </a>
    </div>

</html>
<script src="/wp-content/themes/bevesi/assets/js/jquery.mask.js"></script>

<style>

@media screen and (min-width: 769px)  {
    .some_desk{
        display:none;
    }
    .page-id-3285 .imagem_anunciante_resultado{
        width: 184px !important;
        border-radius: 10px;
    }

}

@media screen and (min-width: 1024.1px) {
    .single-product-wrapper .column {
        width: 30%;
    }

    .page-id-3290 .single-product-wrapper .column {
        width: 46%;
    }
}
 .single-product-wrapper .linha_divisoria_detalhe{
    border: 2px solid #eee;
    float: left;
    background-color: #fff;
    width: 100% !important;
    padding: 1%;
    padding-left: 20px !important;
    margin-top: -2px;
}

.descricao_carrosel_anunciante{
    color: gray !important;
}

.imagem_carrosel_anunciantes{
    border-radius: 15px;
}

.single-product-wrapper .whatsapp_icon_resultado_detalhe{
    margin-top: 31px;
}

.site_linha_detalhe{
    padding-top: 18px !important
}


.page-id-3290 .main-content .single-product-wrapper .klb-post ul{
    padding-left: 0px !important;
}

.rede_social_padding{
    padding-left: 0px !important; 
    padding-bottom: 15px !important
}



.single-product-wrapper .linha_divisoria_detalhe:first{
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;

}

 .single-product-wrapper .woocommerce-product-details__short-description{
    margin-bottom:0px;
}



.home .e-con-full, .e-con>.e-con-inner{
     padding-block-start: 0px !important;
     padding-block-end: 0px !important;
}

.home .elementor-1134 .elementor-element.elementor-element-e486072 > .elementor-widget-container{
    margin: 10px 0px 0px 0px !important;
}

.home .elementor-1134 .elementor-element.elementor-element-6530e6e > .elementor-widget-container{
    margin: 51px 0px 0px 0px !important;
}
.cursor_link{
    cursor:pointer;
}
.input-escondido{
    display: none !important;
}

.site-header-main .site-header-inner .site-quick-button {
    display: none !important;
}

.page-id-3285 .info-secondary{
    padding-top: 25px;
}

.page-id-3285 .destaque_quadro_resultado{
  background-color: #f5f5f5;
  padding-left: 12px;
  padding-top: 0.2rem !important;
  margin-top:20px;
}

.page-id-3285 .page-wrapper{
    margin-top: 0rem !important;
    padding-top: 0rem !important;
    padding-bottom: 1.75rem;
}


.page-id-3285 .woocommerce-breadcrumb{
    margin-top: 0.5rem;
}

.page-id-3285 .info-secondary .locality{
 padding-bottom:15px;
}

.page-id-3285  .product + .product{
    padding-top: 0.75rem !important;
    padding-bottom: 0.75rem !important;
}

.page-id-3285 .phones{
    font-weight: bold;
    font-size: 16px;
}

.page-id-3285 .klb-post .woocommerce-pagination  ul li{
    list-style-type: none !important; 
}

.page-id-3285  .site-pagination ul li > *.current, .woocommerce-pagination ul li > *.current, .pagination-wrap ul li > *.current{
     color:  #aaa !important;
}

.page-id-3285 .phones .klb-icon-phone{
    font-size: 25px;
    margin-left: -3px;
}
.page-id-3285  .product .product-thumbnail-wrapper .product-buttons .product-button.product-wishlist a{
    display: none !important;
}

.page-id-3285 .klb-page-title{
  display: none !important;
}
.product-template-default #related-products .product{
    width: 67% !important; 
}
.product-template-default .telefone_detalhe_anuncio{
    font-size: 22px !important; 
}
.product-template-default .products .product{
    width: 27%;
}



.product-template-default .single-ajax{
    display: none !important;
}

.product-template-default .product-grid-style.grid-column-6{
    width: 20% !important;
}

.product-template-default .product-iconbox{
    display: none !important;
}

.product-template-default .wc-tabs-wrapper{
    display: none !important;
}
.product-template-default .product-price-wrapper{
    display: none !important;
}

.product-template-default .single-product-buttons{
    display: none !important; 
}

.page-id-3290 #related-products .product{
    width: 67% !important; 
}
.page-id-3290 .telefone_detalhe_anuncio{
    font-size: 22px !important; 
}
.page-id-3290 .products .product{
    width: 27%;
}

.page-id-3290 .endereco_detalhe_titulo{
    color: #000000;
    padding-bottom: 7px;
    display: block;
}
.page-id-3290 .detalhes_horario_funcionanemto li{
    list-style-type: initial !important; 
    font-size: 0.875rem;
    color: var(--color-slate-600);
}
.page-id-3290 .detalhes_horario_funcionanemto{
    display: block  !important; 
}

.page-id-3290 .klb-page-title{
    display: none !important;
}

.page-id-3290 .klb-post ul{
    list-style-type: none !important;
}

.page-id-3290 .klb-post .lista_rede_social ul li{
    list-style-type: none !important;
}

.page-id-3290 .whats_icone_detalhe{

float: left;
display: inline-grid;
margin-top: -20px;
}


.page-id-3290 .anuncios_semelhantes_bloco .product-content-footer{
    font-size: 13px;
    color: #575252;
}
.page-id-3290 .single-ajax{
    display: none !important;
}

.page-id-3290 .product-grid-style.grid-column-6{
    width: 20% !important;
}

.page-id-3290 .product-iconbox{
    display: none !important;
}

.page-id-3290 .wc-tabs-wrapper{
    display: none !important;
}
.page-id-3290 .product-price-wrapper{
    display: none !important;
}

.page-id-3290 .single-product-buttons{
    display: none !important; 
}

.linha_top_info_lista_imoveis{
    height: 25px;
}
.product .product-content-wrapper{
    gap: 0rem;
}
.icones_rede_social_lista_busca{
    width:200px;
    padding-top: 5px;
}

.info_extra_anunciante_busca{
  
    font-size: 0.8125rem;
    color: var(--color-slate-600);
}
.products:not(.slick-slider).product-listing-style .product-inner .product-content-wrapper .entry-description{
    padding-right: 17px;
 
}

.products:not(.slick-slider).product-listing-style .product-inner .product-content-wrapper .product-title{
    font-size: 1.1rem !important;
}

.linha_desc_anuncio_texto{
    vertical-align: top;
}
.coluna_info_anunciante_busca{
    
    font-size: 0.8125rem;
    color: var(--color-slate-600);
}
.coluna_info_anunciante_busca strong{
    color: var(--color-black);
}
.product .product-content-wrapper .product-content-body > *{
    display: ruby !important;
}
.products:not(.slick-slider).product-listing-style .product-inner .product-content-wrapper{
    flex-direction: column !important;
}
.limpa_linha{
    width:100%;
    clear:both;
}

.titulo_produto_busca{
    width:100%;
}

<?php if(isset($_GET['post_type']) and $_GET['post_type']=='product'){ ?>
.template-2403{
    display: none !important;
}
<?php } ?>

.before-shop-loop .product-views-buttons {
    display: none !important;

}

.woocommerce-form-register p:first{
    display: none !important;
}

input[type=checkbox], .woocommerce-form__input-checkbox{
    background-color: #aaa;
}
.header-type4  .site-header-custom-button>a{ 
    min-width: 209px;
    border-radius: 15px;
    height: 50px;
    min-width: 210px !important;
}


.site-footer .img-selo-seguro-rodape{
    width: 128px !important;
}

.site-search-form{

    width: 100%;
}

  #afreg_additionalshowhide_3226  .afreg_field_message{
 
    font-size: 13px;
    color: gray;

}

#afreg_additionalshowhide_3218 .afreg_field_message{
    font-size: 14px;
}
.afreg_extra_fields .input-text, .input-select {

    font-size: 14px !important;
}

.site-login .site-login-inner .site-login-overflow .login-form-container > *.login-form .lost-password p .woocommerce-form__label-for-checkbox input:checked + span::before{
    background-color: gray !important;
}
.page-id-2916 .cadastro-etapa-2{
    display: none !important;
}
.page-id-2916 .cadastro-etapa-3{
    display: none !important;
}
.page-id-2916 .site-login{
    padding:0px !important;
}


.page-id-3039 #ver-meu-anuncio-botao{
    padding: 15px 20px 15px 20px;
    background-color: #004711;
}


.page-id-10 .textarea_descricao_anuncio textarea{
    height: 80px !important;
    max-height: 80px !important;
    line-height: 18px !important;
}

.page-id-10 .klb-icon-timer{
    font-size: 23px;
    margin-top: -8px;
    display: block;
}

.page-id-10 #afreg_additionalshowhide_3227{
    margin-top: 16px;
}


.page-id-10 #afreg_additionalshowhide_3218{
    display:flex;
}

.page-id-10 #afreg_additionalshowhide_3218 label{
    display: none !important;
}
.page-id-10 #afreg_additionalshowhide_3218 label{
    display: none !important;
}


.page-id-10 .horario_atendimento{
    width: 43%;
    float: left;
    margin-right: 3%;
    display: grid;
}

.page-id-10 .woocommerce-my-account .my-account-inner .woocommerce-MyAccount-content p a{
    color:white !important;
}
.page-id-10 .woocommerce-my-account .my-account-inner .woocommerce-MyAccount-content p .afreg_field_message a{
    color: var(--color-blue-700) !important;
}


.page-id-10 .woocommerce-MyAccount-content .woocommerce-message{
    display: none !important;
}

.page-id-10  .vendor-customer-registration{
 display: none !important;
}

.page-id-10 .woocommerce-privacy-policy-text{
    display: none !important; 
}

.page-id-10  .site-login .site-login-inner .site-login-overflow .login-form-container > * button{
    background-color: #e5e7eb !important;
    color: #000 !important;
}

.page-id-10  #afreg_additionalshowhide_3212{
    margin-top: 160px;
}

.page-id-10  .mo-openid-app-icons:first-child{
    display: none !important;
}

.page-id-10  .site-page-header.style-1 {
    margin-top: 0rem !important;
}

.page-id-2916  .vendor-customer-registration{
 display: none !important;
}

.page-id-2916 .woocommerce-privacy-policy-text{
    display: none !important; 
}

.page-id-2916  .site-login .site-login-inner .site-login-overflow .login-form-container > * button{
    background-color: #e5e7eb !important;
    color: #000 !important;
}

.page-id-2916  .mo-openid-app-icons:first-child{
    display: none !important;
}

.page-id-2916  .site-page-header.style-1 {
    margin-top: 0rem !important;
    margin-bottom:0rem !important;
}

html .page-id-10 .form_cadastro_proximo{ 
    width:47% !important;
    float:left !important;
  
    margin-left: 3%;
}
html .page-id-10 .site-login .site-login-inner .site-login-overflow .login-form-container .form_cadastro_proximo{
    background-color: #444 !important;
    color:white !important;
}

.page-id-10 .form_cadastro_anterior{
    width:47% !important;
    float:left !important;
}

.page-id-10  .aviso_parabens{
    font-size: 18px !important;
}   
.page-id-10  .campo_escolhe_horaio_dia_semana{
    width:100% !important;
    display: flex !important;
    cursor:pointer;
    margin-top: 17px;
    margin-left: -7px;
}  


.page-id-2916 .class_reg_username{
    display: none !important;
}





.page-id-2916 .login-page-tab:first-child{
    display: none !important;
}
.page-id-2916 .login-form{
    display: none !important;
}
.page-id-2916 .site-login .site-login-inner .site-login-overflow .login-form-container > *.register-form{
    opacity: 1 !important;
}

.page-id-2916 .site-login .site-login-inner .site-login-overflow .login-form-container .woocommerce-form-register__submit{
  /*  width: 47% !important;
    float: right !important;
    margin-left: 3%; */
}
.page-id-2916 .site-login .site-login-inner .site-login-overflow .login-form-container{
    width:100% !important; 
}

.page-id-2916 #afreg_additionalshowhide_3218{
    display: none !important;  
}

.page-id-2916 #reg_username{
    display: none !important;
}

.page-id-10 .class_reg_username{
    display: none !important;
}
.page-id-10 #reg_username{
    display: none !important;
}
.page-id-10  .my-account-user{
    display: none !important;
}

<?php if(!isset($_GET['opcao_deslogar'])){ ?>
.page-id-10  .my-account-navigation{
    display: none !important;
}
<?php }else{ ?>

.page-id-10  .my-account-navigation{
    position: absolute;
}
.page-id-10  .my-account-navigation li{
    border: 1px solid black;
    padding-top: 0px;
    max-width: 118px;
    text-align: center;
    margin-top: 10px;
    border-radius: 5px;
    height: 42px;
    background-color: #444;
    color: white;
    padding-left: 5px;
}   

<?php } ?>

.page-id-10 .site-login{
    padding:0px !important;
}
.page-id-10 .textarea_descricao_anuncio{
    height: 80px !important;
    max-height: 80px !important;
    line-height: 18px !important;
}

.page-id-10 #criar_conta_li_item{
    display: none !important;
}

.page-id-10  .vendor-customer-registration{
 display: none !important;
}

.page-id-10 .woocommerce-privacy-policy-text{
    display: none !important; 
}

.page-id-10  .site-login .site-login-inner .site-login-overflow .login-form-container > * button{
    background-color: #e5e7eb !important;
    color: #000 !important;
}


.page-id-10  .register-form p:first-child{
    display: none !important; 
}


.page-id-10 .nsl-container-buttons{
    display: none !important;  
}

.page-id-10 #form_cadastro_anunco_wizard h3{
    display: none !important;
}

.search-results .shop-sorting-wrapper{
    display: none !important;
}

.contact-form-wrapper .wpcf7-form .wpcf7-submit{
    background-color: #27326F  !important;
}

body .site-header .site-header-row.header-row-bg-primary{
    background-color: #27326F  !important;
}


.elementor-element-ae0b646{
    margin-top: 3%;
}

.klb-icon-eye{
    display:none !important;
}
.quick-view-1{
    display:none !important;
}
    .product-compare{
    display:none !important;
}

.site-search-form .search-form button{
    background-color: #E8521F !important;
    color:white !important;
}
.elementor-1134 .page-header-image img{
    border-radius: 10px;
}

.site-page-header.style-2 .page-header-image::before{
    background-color: unset !important;
}
.site-drawer .site-brand a img {
    width: 136px !important;
}
.site-notification{
	display: none !important;
}

#header-top{
display: none !important;
}

.gray {
   background: #f4f4f747;
   padding-top: 50px;
}
.custom-background{
background-color: #27326F !important;
color: white !important;
}


.site-banner {
   --banner-desktop-height: 320px !important;
   --banner-laptop-height: 320px !important;
   --banner-tablet-height: 320px !important;
   --banner-mobile-height: 320px !important;
   --banner-color: #6D4D36;
   --custom-background-block: #F9F6F3;
}

.site-header.header-type2 .site-header-bottom .site-menu.horizontal.primary-menu .menu > li > a{
	color:white !important;
}

.criar_anuncio_botao_header{
	padding-left:10px;
	padding-right:10px
}

.site-header.header-type2 .site-header-main .site-header-inner .site-quick-button{
	color:white !important;
}

.site-header .site-header-main .site-brand img, .site-drawer .site-brand a img{
	width: 136px !important; 
}


.search-form .search-addon-dropdown .search-addon-input{
	display: none !important;
}
.klb-icon-repeat{
	display: none !important;	
}

.elementor-1134 .elementor-element.elementor-element-3db1157{
	display: none !important;	
}
#footer-iconboxes{
	display: none !important;	
}

.site-categories-button{
    display: none !important;	 
}


.site-menu.horizontal.primary-menu a{
font-weight: 300;
}
#masthead {
background-color: #27326F  !important;
}
.site-footer.footer-type2 #footer-widgets{
	background-color: #27326F  !important;
	color:white;
}

#footer-contact{
	background-color: #27326F  !important;
	color:white;
}

#footer-copyright{
	background-color: #27326F  !important;
	color:white;
}
.site-footer.footer-type2 #footer-newsletter{
	display: none !important;	
}
.site-header .site-header-row.header-row-bg-white{
	background-color: #27326F !important;
    border-bottom: 0.2px solid #c4c4
}

.site-footer.footer-type1 #footer-newsletter {
background-color: #27326F  !important;
}

.site-footer.footer-type1 #footer-widgets  {
   background-color: #27326F  !important;
}

.site-footer.footer-type1 #footer-contact {
   background-color: #27326F  !important;
}

.site-footer.footer-type1 #footer-copyright {
   background-color: #27326F  !important;
}
.elementor-1550 .elementor-element.elementor-element-0aefe4e:not(.elementor-motion-effects-element-type-background), .elementor-1550 .elementor-element.elementor-element-0aefe4e>.elementor-motion-effects-container>.elementor-motion-effects-layer{
display: none !important;
}
#header-main .style-3{
display: none !important;
}
#header-main {
    padding-bottom: 7px;
    padding-top: 7px;
}
.slick-track{
   margin-left: 3%;

}

.site-slider.arrows-style-long .slick-nav.slick-next{
   margin-top:-7%;
}

.site-slider.arrows-style-long .slick-nav.slick-prev{
   margin-top:-7%;
}

.product-progress{
   display: none !important;
}

.product-rating{
   display: none !important;
}

.product-thumbnail-gallery-dots{
   display: none !important;
}

.products .product-title {
   min-height: 20px !important;
   font-size: 13px !important;
   min-width: 400px;
   white-space: nowrap;
}

.price{
   font-size: 13px !important;
}

.product-cart-wrapper{
   display: none !important;
}

.elementor-1550 .elementor-element.elementor-element-68cf63c {
   display: none !important;
}

.elementor-element-20ca139{
   display: none !important;
}
.elementor-element-ee962d{
   display: none !important;
}

.elementor-1550 .elementor-element.elementor-element-ee962da {
   display: none !important;
}

.theme-cl {
    color: #27326F !important;
}
.ft-bold {
    font-weight: 600;
}
.Goodup-search-shadow {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
	flex-direction: column;
	flex-wrap: wrap;
    border-radius: 20px;
    background: #ffffff;
    box-shadow: 0 8px 16px rgb(146 152 198 / 8%);
	-webkit-box-shadow: 0 8px 16px rgb(146 152 198 / 8%);
    padding:2rem;
	margin-top:-60px;
	z-index:22;
}
.Goodup-search-shadow .main-search-wrap{
    margin:0;
	border:1px solid #eee;
}
.Goodup-top-cates {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.Goodup-top-cates ul {
    margin: 0;
    padding: 0;
	text-align: center;
    position: relative;
}
.Goodup-top-cates ul li {
    display: inline-block;
    padding: 0.5rem;
    list-style: none;
}
.Goodup-top-cates ul li a {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.1);
    width:110px;
    height:100px;
    border-radius: 6px;
    transition: all ease 0.4s;
}
.Goodup-top-cates ul li a .Goodup-tp-ico {
    font-size: 25px;
    color: #ffffff;
    line-height: 1;
    margin-bottom: 5px;
}
.Goodup-top-cates ul li a .Goodup-tp-title h5 {
    font-size: 13px;
    margin: 0;
    letter-spacing: 0.2px;
}
.Goodup-top-cates ul li a:hover, .Goodup-top-cates ul li a:focus, .Goodup-top-cates ul li a:active {
    background: #ffffff;
}
.Goodup-top-cates ul li a:hover .Goodup-tp-title h5, .Goodup-top-cates ul li a:focus .Goodup-tp-title h5, .Goodup-top-cates ul li a:active .Goodup-tp-title h5{
   color:#353535;
}
.Goodup-top-cates ul li a:hover .Goodup-tp-ico, .Goodup-top-cates ul li a:focus .Goodup-tp-ico, .Goodup-top-cates ul li a:active .Goodup-tp-ico{
    color:#27326F;
}
.Goodup-counter {
    position: relative;
    width: 100%;
}
.Goodup-counter ul {
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.Goodup-counter ul li {
    display: block;
    list-style: none;
    margin: 2rem 0;
}
.Goodup-counter ul li .Goodup-ylp-first h3 {
    font-size: 35px;
    font-weight: 600;
    margin: 0 0 5px;
}
.Goodup-counter ul li .Goodup-ylp-last span {
    font-size: 13px;
    font-weight: 500;
}
.Goodup-counter ul li .Goodup-ylp-first h3 span {
    margin-right:2px;
}
.Goodup-bnr-cats {
	display:block;
    padding:0rem;
}
.Goodup-bnr-cats ul {
    padding: 0;
    margin: 0;
	display: flex;
    flex-wrap:wrap;
	column-gap:12px;
	row-gap:8px;
    width: 100%;
    align-items: center;
    justify-content:start;
}
.Goodup-bnr-cats.center ul {
    justify-content:center;
}
.Goodup-bnr-cats ul li {
    display: inline-block;
    list-style: none;
	color: #ffffff;
	font-weight:500;
    position: relative;
}
.Goodup-bnr-cats ul li a {
	color: #ffffff;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
    font-weight: 500;
    font-size: 13px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 12px;
    text-transform: capitalize;
    transition: all ease 0.4s;
}
.Goodup-bnr-cats.dark ul li{
	color:#111111;
}
.Goodup-bnr-cats.dark ul li a{
	background:rgba(2,2,2,0.03);
	color:#252525;
}
.Goodup-bnr-cats.rounded ul li a {
    border-radius: 50px;
}
.Goodup-bnr-cats ul li a:hover, .Goodup-bnr-cats ul li a:focus, .Goodup-bnr-cats ul li a:active{
	color:#27326F;
	background:#ffffff;
}
.Goodup-bnr-cats.dark ul li a:hover, .Goodup-bnr-cats.dark ul li a:focus, .Goodup-bnr-cats.dark ul li a:active{
	color:#ffffff;
	background:#121212;
}
.Goodup-over-cats-sty {
    display: flex;
    align-items: self-start;
    flex-direction: column;
    flex-wrap: wrap;
    width: 100%;
	padding-top:2.5rem;
}
.Goodup-over-cats-sty ul{
    display: -webkit-flex;
    display: flex;
    overflow: hidden;
	margin:1rem 0 0 0;
	padding:0;
	padding-right:20px;
}
.Goodup-over-cats-sty ul li{
	display:inline-block;
	list-style:none;
}
.Goodup-over-cats-sty li a {
    height: 45px;
    width: 45px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 60px;
    margin-right: -15px;
    background: #252525;
    color: #ffffff;
	transition:all ease 0.4s;
}
.Goodup-over-cats-sty li a.bg-1 {
    background:#f44336;
}
.Goodup-over-cats-sty li a.bg-2{
    background:#03a9f4;
}
.Goodup-over-cats-sty li a.bg-3 {
    background:#8bc34a;
}
.Goodup-over-cats-sty li a.bg-4 {
    background:#ff9800;
}
.Goodup-over-cats-sty li a.bg-5 {
    background:#9558da;
}
.Goodup-over-cats-sty li a.bg-6 {
    background:#795548;
}
.Goodup-over-cats-sty li a.bg-7 {
    background:#607d8b;
}
.Goodup-over-cats-sty li a.bg-more{
    background:#009688;
}
.Goodup-over-cats-sty li a:hover, .Goodup-over-cats-sty li a:focus, .Goodup-over-cats-sty li a:active {
    margin:0;
}

/*----------------- Grid List Styles -----------------*/
.Goodup-grid-wrap {
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    border-radius: 6px;
    overflow: hidden;
	background:#ffffff;
}
.Goodup-grid-fl-wrap {
    float: left;
    width: 100%;
    position: relative;
    border: 1px solid #eeeeee;
    border-radius: 0 0 6px 6px;
    overflow: initial;
}
.Goodup-grid-upper {
    position: relative;
    width: 100%;
    display: block;
	overflow: hidden;
}
.Goodup-grid-thumb a {
    display: block;
    position: relative;
}
.Goodup-grid-thumb a img {
    position: relative;
    display: block;
    width: 100%;
	transition:all ease 0.5s;
}
.Goodup-grid-thumb a:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
	opacity:0.3;
    background:#202838;
    z-index:1;
}
.Goodup-author {
    position: absolute;
    right: 10px;
    top: -30px;
    width: 55px;
    height: 55px;
    object-fit: cover;
    border: 4px solid #ffffff;
    border-radius: 50%;
    z-index: 2;
}
.Goodup-author a{
    display:block;
	position:relative;
}
.Goodup-cates a {
    font-size: 11px;
    color: #27326F;
    font-weight: 500;
    text-transform: uppercase;
    margin-right: 5px;
}
.Goodup-caption {
    position: relative;
    display: flex;
    flex-direction: column;
}
.Goodup-middle-caption div {
    font-size: 14px;
    margin-bottom:10px;
    color: #6c717e;
}
.Goodup-middle-caption div i{
    margin-right:7px;
	opacity:0.8;
}
.Goodup-grid-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px dashed #eeeeee;
}
.Goodup-bookmark-btn {
    position: absolute;
    right: 15px;
    top: 10px;
	z-index:2;
}
.Goodup-bookmark-btn button {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: none;
    border: none;
    color: #ffffff;
    background: rgba(255,255,255,0.2);
    cursor: pointer;
}
.Goodup-grid-wrap:hover .Goodup-grid-thumb img {
    transform: scale(1.2);
}
.Goodup-pos {
    position: absolute;
    display: inline-flex;
    align-items: center;
	z-index:2;
}
.Goodup-featured-tag {
    position:relative;
    z-index: 3;
    background:#27326F;
	letter-spacing: 0.5px;
    padding:4px 12px;
	font-weight:500;
	text-transform:uppercase;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    font-size: 11px;
    color: #fff;
    -webkit-transform: translate3d(0,0,0);
}
.Goodup-featured-tag:before {
    border-top: 14px solid #27326F;
    border-right: 14px solid transparent;
    margin-right: -12px;
    margin-top: -4px;
}
.Goodup-featured-tag:after {
    border-bottom: 14px solid #27326F;
    border-right: 14px solid transparent;
    margin-right: -12px;
    margin-top:7px;
}
.Goodup-featured-tag:before, .Goodup-featured-tag:after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    right: 0;
}
.Goodup-status {
    font-size: 11px;
    font-weight: 500;
    color: #ffffff;
    background: #282525;
    padding:4px 12px;
    border-radius: 3px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.Goodup-status.open {
    background: #8bc34a;
}
.Goodup-status.close{
    background:#1683f4;
}
.Goodup-status.offer {
    background: #ff5018;
}
span.verified-badge {
    margin-left: 5px;
    position: relative;
    top: 2px;
    color: #0fb351;
}
.Goodup-ft-first {
    display: inline-flex;
    align-items: center;
    width: auto;
    position: relative;
}
.Goodup-rating {
    display: inline-flex;
    position: relative;
    margin-right: 10px;
	align-items: center;
}
.Goodup-pr-average {
    padding: 2px 8px;
    background: #323232;
    display: inline-flex;
    margin-right: 4px;
    border-radius: 2px;
	font-weight:500;
	color:#ffffff;
}
.Goodup-rates {
    font-size:9px;
    color: #ff9800;
}
.Goodup-price-range {
    font-size: 12px;
    color: #989bb1;
}
.Goodup-price-range .active{
    color:#41434c;
}
.Goodup-pr-average.high {
    background:#07a262;
}
.Goodup-pr-average.mid {
    background:#ff6e19;
}
.Goodup-pr-average.poor {
    background:#f22b2b;
}
.Goodup-rating.overlay {
    position: absolute;
    left: 10px;
    bottom: 15px;
    z-index: 2;
}
.Goodup-rating.overlay .Goodup-pr-average {
    padding: 7px 10px;
	border-radius:4px;
}
.Goodup-rating.overlay .Goodup-rates {
    font-size: 10px;
    color: #ff9d0c;
    letter-spacing: 1px;
}
.Goodup-aldeio {
    display: inline-block;
    margin-left: 5px;
}
.Goodup-all-review {
    line-height:1.4;
    color: #ffffff;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.4px;
}
.Goodup-cats-wrap {
    display: inline-flex;
    align-items: center;
    position: relative;
}
.Goodup-cats-wrap .cats-ico {
    width: 30px;
    height: 30px;
    display: inline-flex;
    border-radius: 50%;
    background: #323232;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 12px;
	margin-right:5px;
}
.Goodup-cats-wrap .cats-title {
    font-size: 13px;
    font-weight: 500;
}
.Goodup-inline .Goodup-bookmark-btn {
    position: relative;
    margin-left:8px;
	display:inline-block;
	right:0;
	top:0;
}
.Goodup-inline .Goodup-bookmark-btn button {
    background:#ffffff;
	border:1px solid #eeeeee;
    color: #707d9b;
}
.Goodup-ft-last, .Goodup-inline {
    display: inline-flex;
}
.Goodup-cates.multi .cats-1 {
    padding: 2px 7px;
    background: rgba(33, 150, 243,0.13);
    border-radius: 2px;
    color: #2196f3;
}
.Goodup-cates.multi .cats-2 {
    padding: 2px 7px;
    background: rgba(255, 87, 34,0.13);
    border-radius: 2px;
    color: #ff5722;
}
.Goodup-cates.multi a {
    padding: 2px 7px;
    background: #f0f2f7;
    border-radius: 2px;
    color: #6d7691;
}
.Goodup-facilities-wrap {
    display: inline-flex;
    width: auto;
    position: relative;
}
.Goodup-facilities-wrap ul {
    padding: 0;
    margin-left: 10px;
    width: auto;
    display: inline-flex;
	margin-bottom: 0;
}
.Goodup-facilities-wrap ul li {
    margin-right: 5px;
    color: #27326F;
}
.Goodup-facility-title {
    font-weight: 600;
    color: #172228 !important;
}
.Goodup-overlay-caps {
    position: absolute;
    bottom: 10px;
    left: 12px;
    z-index: 2;
}
.Goodup-distance {
    line-height: 1;
}
.Goodup-room-price {
    display: inline-flex;
    align-items: center;
    padding: 2px 10px;
    background: rgba(33, 150, 243,0.13);
    border-radius: 2px;
    color: #2196f3;
    max-width: 110px;
    font-weight:400;
    font-size: 13px;
}
.Goodup-room-price span{
    font-weight: 500;
	margin-right:5px;
}
.Goodup-facilities-wrap.Goodup-flx{
    width: 100%;
}
.Goodup-flx .Goodup-facility-list {
    width: 100%;
}
.Goodup-facilities-wrap.Goodup-flx ul {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 0;
    width: 100%;
    flex-grow: 1;
}
.Goodup-facilities-wrap.Goodup-flx ul li {
    color: #a6aab7;
    margin: 0;
    font-size: 17px;
}
.Goodup-btn-book {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 48px;
    background: #f4f4f7;
    border-radius: 50px;
    font-weight: 500;
    color: #252a36;
    margin-top: 0.5rem;
	transition:all ease 0.4s;
}
.Goodup-btn-book:hover, .Goodup-btn-book:focus, .Goodup-btn-book:active{
	background:#27326F;
	color:#ffffff;
}
span.Goodup-apr-rates {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 7px;
    padding: 0px 8px;
    background: rgb(255 87 34 / 12%);
    border-radius: 2px;
    font-weight: 500;
    color: #ff5722;
}
span.Goodup-apr-rates i{
    font-size:10px;
	margin-right:4px;
}
.Goodup-options-list ul {
    display: flex;
    align-items: start;
    justify-content: center;
    margin: 0;
    padding: 0;
    flex-flow: wrap;
}
.Goodup-options-list ul li {
    width: 50%;
    align-items: center;
    justify-content: flex-start;
    flex: 0 0 50%;
	padding:7px 0;
}
.Goodup-options-list ul li i {
    color:#a6aab7;
}
.Goodup-prt-price {
    display: inline-flex;
    align-items: center;
    font-size: 17px;
    font-weight: 500;
    color: #ffffff;
}
.Goodup-prt-price span {
    font-size: 25px;
    margin-left: 5px;
}
.Goodup-cats-wrap .cats-ico.bg-1{
	background:#545f57;
}
.Goodup-cats-wrap .cats-ico.bg-2{
	background:#764067;
}
.Goodup-cats-wrap .cats-ico.bg-3{
	background:#d86963;
}.Goodup-cats-wrap .cats-ico.bg-4{
	background:#eacc84;
}
.Goodup-cats-wrap .cats-ico.bg-5{
	background:#35bbcb;
}
.Goodup-cats-wrap .cats-ico.bg-6{
	background:#f8d910;
}
.Goodup-cats-wrap .cats-ico.bg-7{
	background:#0191b5;
}
.Goodup-cats-wrap .cats-ico.bg-8{
	background:#d4dd18;
}
.Goodup-cats-wrap .cats-ico.bg-9{
	background:#fe7a15;
}
.Goodup-cats-wrap .cats-ico.bg-10{
	background:#004e99;
}

/*--------------------- Goodup Category Style --------------*/
.Goodup-catg-wrap {
    position: relative;
    width: 100%;
    padding:2rem 1rem;
    height: auto;
    background: #ffffff;
    display: block;
    border-radius: 6px;
    margin-bottom: 30px;
	transition:all ease 0.4s;
}
.Goodup-catg-wrap:hover, .Goodup-catg-wrap:focus, .Goodup-catg-wrap:active{
	box-shadow:0 8px 16px rgb(146 152 198 / 8%);
	-webkit-box-shadow:0 8px 16px rgb(146 152 198 / 8%);
}
.Goodup-catg-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 10px auto;
    border-radius: 50%;
    background:rgb(244 27 59 / 7%);
    font-size: 28px;
	color: #27326F;
	transition:all ease 0.4s;
}
.Goodup-catg-city {
    position: absolute;
    top: 12px;
    left: 12px;
    font-size: 11px;
    font-weight: 500;
    padding: 1px 6px;
    background: rgb(0 150 136 / 10%);
    border-radius: 2px;
    color:#009688;
}
.Goodup-catg-wrap:hover .Goodup-catg-icon, .Goodup-catg-wrap:focus .Goodup-catg-icon, .Goodup-catg-wrap:active .Goodup-catg-icon{
	color:#ffffff;
	background:#27326F;
}
.Goodup-catg-wrap:hover .Goodup-catg-city, .Goodup-catg-wrap:focus .Goodup-catg-city, .Goodup-catg-wrap:active .Goodup-catg-city{
	color:#ffffff;
	background:#009688;
}
.Goodup-img-catg-wrap {
    position: relative;
    display: block;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #f4f4f7;
    margin-bottom: 30px;
    background: #ffffff;
	transition:all ease 0.4s;
}
.Goodup-img-catg-wrap:hover, .Goodup-img-catg-wrap:focus, .Goodup-img-catg-wrap:active{
	box-shadow:0 8px 16px rgb(146 152 198 / 8%);
	-webkit-box-shadow:0 8px 16px rgb(146 152 198 / 8%);
}
.Goodup-img-catg-thumb img {
    min-height: 200px;
    max-height: 200px;
    object-fit: cover !important;
    width: 100%;
}
.Goodup-img-catg-caption {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 0.8rem;
}
.Goodup-cat-arrow {
    width: 32px;
    height: 32px;
    align-items: center;
    justify-content: center;
    display: flex;
    background: #feeff1;
    border-radius: 50%;
    color: #27326F;
    transition: all ease 0.4s;
    border: 1px dashed rgb(244 27 59 / 30%);
}
.Goodup-img-catg-wrap .Goodup-catg-city {
    background: #27326F;
    color: #ffffff;
}
.Goodup-img-catg-wrap:hover .Goodup-cat-arrow, .Goodup-img-catg-wrap:focus .Goodup-cat-arrow, .Goodup-img-catg-wrap:active .Goodup-cat-arrow{
	color: #ffffff;
	background:#27326F;
	border: 1px dashed #27326F;
}

/*--------------------- Goodup Location Designs --------------*/
.Goodup-img-location-wrap{
    position: relative;
    display: block;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #f4f4f7;
    margin-bottom: 30px;
    background: #ffffff;
    transition: all ease 0.4s;
}
.Goodup-img-location-caption {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.8rem 0.8rem;
    position: absolute;
    bottom: 20px;
    background: #ffffff;
    width: 90%;
    margin: 0 auto;
    left: 5%;
    border-radius: 4px;
}
.Goodup-img-location-wrap:hover .Goodup-cat-arrow, .Goodup-img-location-wrap:focus .Goodup-cat-arrow, .Goodup-img-location-wrap:active .Goodup-cat-arrow {
    color: #ffffff;
    background: #27326F;
    border: 1px dashed #27326F;
}
/*--------------------- Goodup Author Designs --------------*/
.Goodup-author-wrap{
    position: relative;
    display: block;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #f4f4f7;
    margin-bottom: 30px;
    background: #ffffff;
	text-align:center;
}
.Goodup-author-tag{
    position: absolute;
    top: 12px;
    left: 12px;
    font-size: 11px;
    font-weight: 500;
    color: #ffffff;
    background: #252525;
    padding: 4px 12px;
    border-radius: 50px;
}
.Goodup-author-tag.new {
    background:#4caf50;
}
.Goodup-author-tag.popular{
    background:#9e69fc;
}
.Goodup-author-tag.featured{
    background:#ff6922;
}
.Goodup-author-thumb {
    padding: 0.5rem;
    background: #ffffff;
    border: 2px dashed #ececf0;
    border-radius: 50%;
    margin: 3rem auto 0.5rem;
    width: 160px;
}
.Goodup-author-links {
    padding: 0;
    margin: 2rem auto 2.5rem;
}
.Goodup-author-links .Goodup-social {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
}
.Goodup-author-links .Goodup-social li {
    list-style: none;
    margin: 0;
    padding: 0 7px;
}
.Goodup-author-links .Goodup-social li a {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f4f4f7;
    border-radius: 50%;
    color: #838384;
	transition:all ease 0.4s;
}
.Goodup-author-links .Goodup-social li a:hover, .Goodup-author-links .Goodup-social li a:focus, .Goodup-author-links .Goodup-social li a:active{
	color:#ffffff;
	background:#27326F;
}
.Goodup-author-lists {
    position: absolute;
    right: 15px;
    top: 12px;
    padding: 2px 8px;
    background: rgb(244 27 59 / 10%);
    border-radius: 2px;
    color: #27326F;
}
.Goodup-author-links .Goodup-social.colored li a {
    color: #27326F;
    background: rgb(244 27 59 / 10%);
}

/*----------------- Goodup Price Box ----------------*/
.Goodup-price-wrap{
    padding: 40px;
	margin-bottom:30px;
	border-radius:10px;
    background: #ffffff;
    box-shadow: 0 8px 16px rgb(146 152 198 / 8%);
    transition: 0.3s;
    text-align: left;
    position: relative;
    z-index: 1;
}
.Goodup-price-wrap:hover, .Goodup-price-wrap:focus, .Goodup-price-wrap:active{
	transform: translateY(-5px);
}
.Goodup-price-currency .Goodup-new-price {
    margin-right: 15px;
}
.Goodup-price-currency .Goodup-new-price {
    font-size: 15px;
    font-weight: 500;
}
.Goodup-price-currency .Goodup-new-price del {
    font-size: 50px;
    text-decoration: none;
    margin-left: 4px;
}
.Goodup-price-currency .Goodup-old-price {
    font-size: 15px;
    font-weight: 500;
    opacity: 0.3;
}
.Goodup-price-currency .Goodup-old-price del {
    font-size: 35px;
    text-decoration: none;
}
.Goodup-price-title {
    display: flex;
    align-items: center;
	margin-bottom:10px;
}
.Goodup-price-title .Goodup-price-tlt h4 {
    font-size: 22px;
    font-weight: 400;
    margin: 0;
}
.Goodup-price-ribbon .Goodup-ribbon-offer {
    margin-left: 10px;
    padding: 3px 8px;
    background: rgb(0 150 136 / 10%);
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    color: #009688;
}
.Goodup-price-ribbon .Goodup-ribbon-offer.all {
    background: rgb(255 152 0 / 10%);
    color: #ff9800;
}
.Goodup-price-subtitle {
    font-size: 16px;
    color: #333c56;
}
.Goodup-price-body {
    margin: 1rem 0;
    border-top: 1px solid #efeff4;
    padding: 1rem 0;
}
.Goodup-price-body ul {
    padding: 0;
    width: 100%;
    margin: 0;
}
.Goodup-price-body ul li {
    display: block;
    list-style: none;
    padding: 10px 0;
}
.Goodup-price-body ul li:last-child{
    padding-bottom:0;
}
.Goodup-price-body ul li i{
	margin-right:5px;
	color:#27326F;
}
.Goodup-price-btn {
    position: relative;
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: center;
    height: 56px;
    border: 2px dashed #ececf0;
    border-radius: 50px;
    font-weight: 500;
	transition:all ease 0.4s;
}
.Goodup-price-btn i{
    margin-right:7px;
}
.Goodup-price-btn:hover, .Goodup-price-btn:focus, .Goodup-price-btn:active, .Goodup-price-btn.active{
	color:#ffffff;
	background:#27326F;
	border:2px dashed #27326F;
}
.Goodup-price-wrap.dark-price{
    border: 1px solid #304450;
    box-shadow: none;
    background: transparent;
}

.Goodup-all-drp {
    display: inline-flex;
    align-items: center;
    width: auto;
}
.Goodup-all-drp .Goodup-single-drp {
    margin-right: 10px;
    display: inline-flex;
    width: auto;
    position: relative;
}
.Goodup-all-drp .Goodup-single-drp .btn-group>.btn, .btn-group>.btn {
    box-shadow: none !important;
    border: 1px solid #e5e6e8;
    background: white;
    color: #2f363e;
}
.Goodup-all-drp .Goodup-single-drp.small .btn-group>.btn {
    padding:6px 15px 6px 15px;
    border-radius: 50px;
    font-size: 13px;
}
.Goodup-all-drp .Goodup-single-drp.small .btn-group>.btn.dropdown-toggle {
    padding:6px 25px 6px 15px;
}
.Goodup-all-drp .dropdown-toggle:after {
    position: absolute;
    top: 12px;
    right: auto;
    border-left: none;
    border-bottom: 0;
    border-right: none;
    border-top: none;
    margin: 0 !important;
    vertical-align: 0 !important;
    margin-left:5px !important;
    height: 6px;
    width: 6px;
    border-style: double;
    border-width: 0 2px 2px 0;
    border-color: transparent #172228 #172228 transparent;
    -ms-transform: rotate(45deg);
    transform: rotate( 45deg);
    transition: border .3s;
}
.Goodup-all-drp .dropdown-toggle.active:after {
    border-color: transparent #27326F #27326F transparent;
}
.Goodup-all-drp .dropdown-menu {
    min-width: 300px;
    padding: 12px;
}
.Goodup-all-drp .dropdown-menu li {
    display: inline-flex;
    width: 50%;
    float: left;
    align-items: center;
}
.Goodup-all-drp .dropdown-menu li a {
    font-size: 14px;
    padding: 10px 15px;
    font-weight: 500;
    display: flex;
    align-items: center;
    line-height: 1;
}
.Goodup-all-drp .dropdown-menu li a:hover, .Goodup-all-drp .dropdown-menu li a:focus, .Goodup-all-drp .dropdown-menu li a:active {
    color:#1e2125;
    background: #eeeeee;
}
.Goodup-all-drp .dropdown-menu li a img{
	margin-right:10px;
}
.Goodup-all-drp .Goodup-single-drp.small .btn-group>.btn.active {
    color: #27326F;
    background: rgba(244, 27, 59,0.1);
    border-color: rgba(244, 27, 59,0.1);
}

.Goodup-09kjh {
    display: block;
    width: 100%;
    position: relative;
    padding:2rem 0;
}
.Goodup-09kjh ul {
    display: inline-block;
    padding: 0;
    margin: 0;
}
.Goodup-09kjh ul li {
    display: inline-block;
    list-style: none;
    padding: 1px 12px;
	font-weight:500;
	color:#252525;
    border-right: 1px solid #eceef2;
}
.Goodup-09kjh ul li:first-child{
    padding-left:0;
}
.Goodup-09kjh ul li:last-child{
    border-right:none;
}
.Goodup-09kjh ul li span{
	font-weight:400;
	margin-left:4px;
}
.Goodup-boo-space-foot {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    padding: 0.5rem 0rem 0;
    width: 100%;
}
.Goodup-boo-space-left {
    flex: 1;
    font-weight:600;
    font-size: 13px;
    color: #2D3954;
}
.Goodup-agent-blocks {
    display: block;
    text-align: center;
    margin: 0 auto;
}
.Goodup-agent-thumb {
    padding: 5px;
    border-radius: 50%;
    border: 3px solid #efefef;
    height: 106px;
    width: 106px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.2rem;
}
.Goodup-iuky {
    display: block;
    width: 100%;
    padding: 2rem 0;
}
.Goodup-iuky ul {
    padding: 0 0.5rem;
    margin: 0;
	display:flex;
}
.Goodup-iuky ul li {
    display: inline-block;
    list-style: none;
    font-weight: 600;
    color: #1e2738;
    font-size: 13px;
	width:33.333333%;
	flex:0 0 33.333333%;
	font-size:18px;
	text-align:center;
}
.Goodup-iuky ul li span {
    display: block;
    font-weight: 500;
    font-size: 12px;
    color: #7a7a7a;
}
.Goodup-sng-menu {
    position: relative;
    display: block;
    overflow: initial;
}
.Goodup-sng-menu-thumb {
    position: relative;
    border-radius: 6px 6px 0px 0px;
    overflow: hidden;
}
.Goodup-sng-menu-caption {
    padding: 6px 10px;
    border: 1px solid #e9e9e9;
    border-radius: 0 0px 6px 6px;
    border-top: none;
}
.Goodup-sng-menu-caption h4 {
    margin: 0;
    line-height: 1.2;
}

.Goodup-all-features-list {
    display: block;
    width: 100%;
    position: relative;
}
.Goodup-all-features-list ul {
    margin: 0;
    padding: 0;
    display: flex;
    width: 100%;
    flex-wrap: wrap;
}
.Goodup-all-features-list ul li {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    list-style: none;
    flex: 0 0 33.333333%;
    width: 33.333333%;
	padding: 10px 0;
	font-weight:500;
}
.Goodup-all-features-list ul li i, .Goodup-all-features-list ul li img{
	max-width:18px;
	margin-right:10px;
}
.Goodup-afl-pace {
	font-size:14px;
	color:#323a4e;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.Goodup-afl-pace.deactive {
    opacity: 0.3;
}
.Goodup-ops-bhri {
    display: block;
    position: absolute;
    bottom: 10%;
    left: 7%;
}
.Goodup-ops-bhri .Goodup-price-range .active {
    color: #ffffff;
}

.custom-button-holder{
   display: none !important;
}

.chat-jacqueline {
    background-repeat: no-repeat;
    right: 1vw;
    margin-right: 1vw;
    width: auto;
    height: 7vh !important;
    float: right;
    background-size: contain;
    width: 3.5vw !important;
    background-image: url('/wp-content/themes/bevesi/assets/img/icone_whats.webp');
    color: rgb(217, 160, 0);
    cursor: pointer;
    height: 100px;
    position: fixed;
    right: 22px;
    width: 173px;
    z-index: 999;
    content: "▲";
    display: flex;
    justify-content: center;
    padding-left: 1px;
    padding-top: 10px;
    background-position: center center;
}

.whatsapp_icon_search{
    display: ruby;
}
.corpo img {
position: absolute;
width:100%;
}
.corpo{
height:100%;
}
.painelvermelho {
width: 51px;
height: 51px;
position: fixed;
cursor: pointer;
bottom: 8%;
background-image: url('/wp-content/themes/bevesi/assets/img/icone_whats.webp');
z-index: 9999;
background-size: cover;
margin-left:15px;
right: 8px;
}

.busca_usuario_anunciantes .klb-icon-star{
   color: #cccc09
}

.whatsapp_icon_resultado_busca{
    width: 31px;
    height: 34px;
    cursor: pointer;
    background-image: url(/wp-content/themes/bevesi/assets/img/icone_whats.webp);
    background-size: 30px;
    margin-top: 0px;
    margin-right: 2px;
    background-repeat: no-repeat;
    vertical-align: middle;
    
}

.whats_telefone_texto{
    padding-bottom: 15px;
}

.whatsapp_icon_resultado_detalhe{
    width: 28px;
    height: 28px;
    cursor: pointer;
    background-image: url('/wp-content/themes/bevesi/assets/img/icone_whats.webp');
    background-size: cover;
    margin-top: 20px;
    margin-right: 4px;
}


.site-header .site-header-custom-button>a{
background-color: white;
color: #27326F !important;
padding-right: 11px !important;
border-radius: 11px !important;
margin: 6px !important;
height:35px !important;

}


.home .elementor-1134  .im {
    font-size: 56px;

}



@media (max-width: 600px) {

    .page-id-3285 .klb-post img{
        width: 75vw;
        border-radius: 10px;
    }
    .page-id-3285  .single-product-wrapper .product_title{
        font-size: 5.2vw;
        font-weight: 600;
        width: 99%;
        padding-left: 9px;
    }
  
    

    .form_cadastro_divulgue_seu_negocio{
    width: 60%;
    margin:0px auto;
    }
    .site-header .site-header-custom-button>a{
    margin: 0px !important;
    }
    .site-banner .site-banner-image img{
    object-fit: none !important;
    }
    .some_mobile{
        display:none;
    }

    .page-id-3285 .imagem_produto_lista_mobile{
        margin-left: 4%;
        width: 71%;
        border-radius: 10px;
    }

    .products:not(.slick-slider).product-listing-style .product-inner{
        gap:0px !important;
    }
    .linha_desc_anuncio_texto .padding-right{
        padding-left: 5%;
    }
    .products:not(.slick-slider).product-listing-style .product-inner .product-content-wrapper .entry-description {
        padding-right: 24%;
    }
  
} 




</style>


<?php if(isset($_GET['etapa_cadastro'])){ ?>

<script>





jQuery( document ).ready(function( $ ) {

    $(".campo_telefone input").mask('(00) 00000-0009', {clearIfNotMatch: true});
    $(".horario_atendimento input").mask('00:00', {clearIfNotMatch: true});

    <?php if($_GET['etapa_cadastro']==2){ ?>
        $("#afreg_additional_3224").on("keyup change", function(e) {

            let valor = $(this).val();
            $("#account_first_name").val(valor);
            $("#account_last_name").val(valor);
        })
    <?php } ?>


    <?php if($_GET['etapa_cadastro']==3){ ?>

        
        cria_preenche_horario_funcionamento(3246,3263,'Segunda-Feira');
        cria_preenche_horario_funcionamento(3248,3264,'Terça-Feira');
        cria_preenche_horario_funcionamento(3249,3266,'Quarta-Feira');
        cria_preenche_horario_funcionamento(3250,3267,'Quinta-Feira');
        cria_preenche_horario_funcionamento(3247,3268 ,'Sexta-Feira');
        cria_preenche_horario_funcionamento(3252,3270,'Sabado');
        cria_preenche_horario_funcionamento(3251,3272,'Domingo');

        $("#afreg_additional_3255").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        }) 

        $("#afreg_additional_3216").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })

        $("#afreg_additional_3217").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })

        $("#afreg_additional_3217").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })
        $("#afreg_additional_3234").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })

        
       
    <?php } ?>



        function cria_preenche_horario_funcionamento(id_campo,id_campo_2,dia){

            $('#afreg_additionalshowhide_'+id_campo).before('<div class="clear campo_escolhe_horaio_dia_semana" id="'+id_campo+'__'+id_campo_2+'"  ><p class="af-dependable-field form-row  form-row-wide" >'+
                                                    '<div ><input type="checkbox"></i></div> <label for="afreg_additional_'+id_campo+'">'+
                                                    'Preencher horário de Funcionamento - '+dia+							
                                                    '</label>'+
                                                    '</p><br></div>');

            $('#afreg_additionalshowhide_'+id_campo).hide();
            $('#afreg_additionalshowhide_'+id_campo_2).hide();

            $(".campo_escolhe_horaio_dia_semana").on("click", function(e) {
               console.log(this.id);

               var id_div = this.id;

               const pega_ids_campos_horarios = id_div.split("__");

                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[0]).show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[0]+' label').show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[0]+' input').show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[1]).show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[1]+' label').show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[1]+' input').show();
            })
                                                    
        }

       


});


function abre_dia_semana(id_campo,id_campo_2){

    document.getElementById("afreg_additionalshowhide_"+id_campo).style.display = 'grid';
    document.getElementById("afreg_additionalshowhide_"+id_campo_2).style.display = 'grid';
}

function limpa_campos_etapa(numero_etapa){
    var divsToHide = document.getElementsByClassName("cadastro-etapa-"+numero_etapa); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }

    if(numero_etapa==2){
               
    }
}


window.onload = function() {
    document.getElementById("form_cadastro_anterior").style.display = 'none';
    document.getElementById("botao_salvar").style.display = 'none';
    document.getElementById("controle_wizard").style.display = 'block';

    var divsToHide = document.getElementsByClassName("cadastro-etapa-1"); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }

    <?php if($_GET['etapa_cadastro']==2){ ?>

    document.getElementById("afreg_additional_3239").required = true;
    document.getElementById("afreg_additional_3224").required = true;
    document.getElementById("afreg_additional_3213").required = true;
    document.getElementById("afreg_additional_3214").required = true;
    document.getElementById("afreg_additional_3226").required = true;

    document.getElementById("afreg_additional_3240").required = true;
    document.getElementById("afreg_additional_3243").required = true;
    document.getElementById("afreg_additional_3244").required = true;
    document.getElementById("afreg_additional_3245").required = true;
    document.getElementById("afreg_additional_3218").required = true;

    document.getElementById("afreg_additional_3218").click();
    

    setInterval(function() { limpa_campos_etapa(3); }, 200);
    
    <?php } ?>

    <?php if($_GET['etapa_cadastro']==3){ ?>

        <?php 
            if (strpos($_SERVER['HTTP_REFERER'], '?etapa_cadastro=3') !== false) { ?>
                window.location=('/lista_planos');
        <?php }  ?>

    setInterval(function() { limpa_campos_etapa(2); }, 200);

    document.getElementById("form_cadastro_proximo").style.display = 'none';
    document.getElementById("form_cadastro_anterior").style.display = 'block';
    document.getElementById("form_cadastro_anterior").innerHTML = 'Finalizar';
    document.getElementById("form_cadastro_proximo").innerHTML = 'Finalizar';
    document.getElementById("form_cadastro_proximo").innerHTML = "<a href='/lista_planos'>Destacar Meu Negócio</a>";
    document.getElementById("form_cadastro_proximo").style.backgroundColor = "#18864B";
    document.getElementById("form_cadastro_proximo").style.color = "#fff";
    document.getElementById("controle_etapa_cadastro").value = 3;


    window.scrollTo({ top: 0, behavior: 'smooth' });

    var divsToShow = document.getElementsByClassName("page-title"); //divsToHide is an array
    for(var i = 0; i < divsToShow.length; i++){
        console.log('mostra_etapa'+i)
        divsToShow[i].innerHTML= "Parabéns ! <br>  <p class='aviso_parabens'>Você agora faz parte do time Achar é Fácil !</p>"; // depending on what you're doing
    }
    
    document.querySelector(".site-page-header-inner .entry-description p").innerHTML = "Você pode incrementar o anúncio com informações importantes, isso ajudará no desempenho do seu anúncio.<br> Você também pode destacar seu Negócio assinado um de nossos planos "; // depending on what you're doing

    <?php } ?> 

    var divsToHide = document.getElementsByClassName("woocommerce-form-register__submit"); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }
}



jQuery( document ).ready(function( $ ) {

$("#afreg_additional_3239").mask('00000-000', {clearIfNotMatch: true});




    $("#afreg_additional_3239").keyup(function(){
       if($("#afreg_additional_3239").val() == ""){
           $('#afreg_additional_3240').val("");
            $('#afreg_additional_3243').val("");
            $('#afreg_additional_3244').val("");
            $('#estado').val("");
       }
       var conta =  $(this).val();
       var conta2 = conta.length;
       if(conta2==9){
             $('#afreg_additional_3240').val("");
             $('#afreg_additional_3243').val("");
             $('#afreg_additional_3244').val("");
             $('#estado').val("");
             $('#status_busca_cep').show();
             $('#status_busca_cep').html("Carregando...");

        
           var site = "https://viacep.com.br/ws/"+conta+"/json";

           $.ajax({
                type: "GET",
                url: site,
                dataType: "json",
                success: function(json){
        
                         $('#afreg_additional_3240').val(json.logradouro);
                         $('#afreg_additional_3243').val(json.bairro);
                         $('#afreg_additional_3244').val(json.localidade);
                         $('#afreg_additional_3245').val(json.uf);
                         $('#afreg_additional_3240').removeAttr("readonly");
                        
                         $('#afreg_additional_3244').removeAttr("readonly");
                         $('#afreg_additional_3245').removeAttr("readonly");

                         var divsToHide = document.getElementsByClassName("cadastro-etapa-3"); //divsToHide is an array
                        for(var i = 0; i < divsToHide.length; i++){
                            divsToHide[i].style.display = "none"; // depending on what you're doing
                        }
                                
                },
                error: function(data) { 
                    $('#status_busca_cep').show();
                    $('#status_busca_cep').html("Cep não encontrado");
                }
                
            });			
       }
   });
});
</script>
<?php } ?>


<?php if(is_page('my-acoount') or is_page('edit-acoount') or is_page('criar-anuncio')){ ?>
<script>

    jQuery( document ).ready(function( $ ) {

        $(".campo_telefone input").mask('(00) 000000009', {clearIfNotMatch: true});
        
        $(".horario_atendimento input").mask('00:00', {clearIfNotMatch: true});

        $("#reg_email").on("keyup change", function(e) {

        let valor = $(this).val();
        $("#reg_username").val(removerCaracteresEspeciais(valor)+generatePassword());

        })


        $("#afreg_additional_3224").on("keyup change", function(e) {

            let valor = $(this).val();
            $("#reg_username").val(removerCaracteresEspeciais(valor)+generatePassword());
            
        })

       /* $("#afreg_additional_3232").change(function(){
            
            let valor = $(this).val();  

            $("#afreg_additionalshowhide_3234").css("display", "none");
            $("#afreg_additionalshowhide_3216").css("display", "none");
            $("#afreg_additionalshowhide_3217").css("display", "none");
            $("#afreg_additional_3234").css("display", "none");
            $("#afreg_additional_3216").css("display", "none");
            $("#afreg_additional_3217").css("display", "none");
                
            if(valor=='Linkedin'){
                $("#afreg_additionalshowhide_3234").css("display", "block");
                $("#afreg_additional_3234").css("display", "block");
                
            }
            if(valor=='Facebook'){
                $("#afreg_additionalshowhide_3217").css("display", "block");
                $("#afreg_additional_3217").css("display", "block");
                
            }
            if(valor=='Instagram'){
                $("#afreg_additional_3216").css("display", "block");
                $("#afreg_additionalshowhide_3216").css("display", "block");
            }

        })*/

    });


    function removerCaracteresEspeciais(string) {
        return string.replace(/[^a-zA-Z0-9]/g, "");
    }


    function generatePassword() {
        var length = 15,
            charset = "abcdefghijklmnopqrstuvwxyz0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }
</script>
<?php }?>

<div class="alert alert-primary col-md-16" role="alert" id='status_busca_cep'> </div>

