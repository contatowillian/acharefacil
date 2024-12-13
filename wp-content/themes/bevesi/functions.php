<?php
/**
 * functions.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0.7
 * 
 */

/*************************************************
## Get Theme Info
*************************************************/ 
if ( ! function_exists( 'bevesi_get_theme_info' ) ) {
	function bevesi_get_theme_info( $parameter ) {
		
		$theme_info = wp_get_theme( get_template() )->get( $parameter );
		
		return $theme_info;
	}
}

define( 'BEVESI_VERSION', bevesi_get_theme_info( 'Version' ) );

/*************************************************
## Admin style and scripts  
*************************************************/ 
function bevesi_admin_styles() {
	wp_enqueue_style('bevesi-klbtheme',     get_template_directory_uri() .'/assets/css/admin/klbtheme.css');
	wp_enqueue_script('bevesi-init', 	    get_template_directory_uri() .'/assets/js/init.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('bevesi-register',    get_template_directory_uri() .'/assets/js/admin/register.js', array('jquery'), BEVESI_VERSION, true);
	wp_register_style( 'bevesi-klbtheme-icons', 	get_template_directory_uri() .'/assets/css/klbtheme.css', false, BEVESI_VERSION);
	wp_register_style( 'bevesi-klbtheme-social', 	get_template_directory_uri() .'/assets/css/klbtheme-social.css', false, BEVESI_VERSION);
}
add_action('admin_enqueue_scripts', 'bevesi_admin_styles');

 /*************************************************
## Bevesi Fonts
*************************************************/
function bevesi_fonts_url() {
	$fonts_url = '';

	$allfont = array();
	
	$outfit 		= '"Outfit", sans-serif';

	$allfont[] = isset(get_theme_mod('bevesi_body_typography', [])['font-family']) ? get_theme_mod('bevesi_body_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_heading_typography', [])['font-family']) ? get_theme_mod('bevesi_heading_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_menu_typography', [])['font-family']) ? get_theme_mod('bevesi_menu_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_form_typography', [])['font-family']) ? get_theme_mod('bevesi_form_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_button_typography', [])['font-family']) ? get_theme_mod('bevesi_button_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_price_typography', [])['font-family']) ? get_theme_mod('bevesi_price_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_product_name_typography', [])['font-family']) ? get_theme_mod('bevesi_product_name_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('bevesi_topbar_typography', [])['font-family']) ? get_theme_mod('bevesi_topbar_typography', [])['font-family'] :'';
	
	$font_families = array();
	
	if(in_array($outfit, $allfont) || !array_filter($allfont)) {
		$font_families[] = 'Outfit:wght@100..900&display=swap';
	}
	
	if(in_array($outfit, $allfont) || !array_filter($allfont)) {
		$query_args = array( 
			'family' => rawurldecode( implode( '&family=', $font_families ) ), 
			'subset' => rawurldecode( 'latin,latin-ext' ), 
		); 
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css2' );
	}
	
	return esc_url_raw( $fonts_url );
}


/*************************************************
## Styles and Scripts
*************************************************/ 
define('BEVESI_INDEX_CSS', 	  get_template_directory_uri()  . '/assets/css');
define('BEVESI_INDEX_JS', 	  get_template_directory_uri()  . '/assets/js');

function bevesi_scripts() {

	if ( is_admin_bar_showing() ) {
		wp_enqueue_style( 'bevesi-klbtheme', BEVESI_INDEX_CSS . '/admin/klbtheme.css', false, BEVESI_VERSION);    
	}	

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	wp_enqueue_style( 'bootstrap-grid', 				BEVESI_INDEX_CSS . '/bootstrap-grid.min.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bootstrap-reboot', 				BEVESI_INDEX_CSS . '/bootstrap-reboot.min.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bootstrap-utilities', 			BEVESI_INDEX_CSS . '/bootstrap-utilities.min.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'select2', 						BEVESI_INDEX_CSS . '/select2.min.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'slick', 							BEVESI_INDEX_CSS . '/slick.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'magnific-popup', 				BEVESI_INDEX_CSS . '/magnific-popup.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-form-input', 				BEVESI_INDEX_CSS . '/modules/form-input.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-form-select', 			BEVESI_INDEX_CSS . '/modules/form-select.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-form-select', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-form-button', 			BEVESI_INDEX_CSS . '/modules/form-button.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-drawer', 					BEVESI_INDEX_CSS . '/modules/drawer.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-categories-menu', 		BEVESI_INDEX_CSS . '/modules/categories-menu.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-categories-menu', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-badge', 					BEVESI_INDEX_CSS . '/modules/badge.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-banner', 					BEVESI_INDEX_CSS . '/modules/banner.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-slider', 					BEVESI_INDEX_CSS . '/modules/slider.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-slider', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-notifications', 			BEVESI_INDEX_CSS . '/modules/notifications.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-countdown', 				BEVESI_INDEX_CSS . '/modules/countdown.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-countdown', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-custom-box', 				BEVESI_INDEX_CSS . '/modules/custom-box.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-iconbox', 				BEVESI_INDEX_CSS . '/modules/iconbox.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-iconbox', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-woocommerce-global', 		BEVESI_INDEX_CSS . '/modules/woocommerce-global.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-woocommerce-global', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-woocommerce-products', 	BEVESI_INDEX_CSS . '/modules/woocommerce-products.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-woocommerce-product-box', BEVESI_INDEX_CSS . '/modules/woocommerce-product-box.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-woocommerce-product-box', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-woocommerce-cart', 		BEVESI_INDEX_CSS . '/modules/woocommerce-cart.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-woocommerce-my-account', 	BEVESI_INDEX_CSS . '/modules/woocommerce-my-account.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-woocommerce-single', 		BEVESI_INDEX_CSS . '/modules/woocommerce-single.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-vendor-box', 				BEVESI_INDEX_CSS . '/modules/vendor-box.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-category-box', 			BEVESI_INDEX_CSS . '/modules/category-box.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-blog-module', 			BEVESI_INDEX_CSS . '/modules/blog-module.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-sidebar', 				BEVESI_INDEX_CSS . '/modules/sidebar.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-sidebar', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-social-media', 			BEVESI_INDEX_CSS . '/modules/social-media.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-dokan-style', 			BEVESI_INDEX_CSS . '/modules/dokan-style.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-tailwind', 				BEVESI_INDEX_CSS . '/tailwind.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-helpers', 				BEVESI_INDEX_CSS . '/modules/helpers.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-klbtheme-icons', 			BEVESI_INDEX_CSS . '/klbtheme.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-klbtheme-social', 		BEVESI_INDEX_CSS . '/klbtheme-social.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-colors-min', 				BEVESI_INDEX_CSS . '/colors-min.css', false, BEVESI_VERSION);
	wp_enqueue_style( 'bevesi-base', 					BEVESI_INDEX_CSS . '/base.css', false, BEVESI_VERSION);
	wp_style_add_data( 'bevesi-base', 'rtl', 'replace' );
	wp_enqueue_style( 'bevesi-font-url',  					bevesi_fonts_url(), array(), null );
	wp_enqueue_style( 'bevesi-style',         	get_stylesheet_uri() );
	wp_style_add_data( 'bevesi-style', 'rtl', 'replace' );

	$mapkey = get_theme_mod('bevesi_mapapi');
	
	wp_enqueue_script( 'moment',    	    		  BEVESI_INDEX_JS . '/moment.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'moment-timezone',    	      BEVESI_INDEX_JS . '/moment-timezone.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'jquery-countdown',    	   	  BEVESI_INDEX_JS . '/jquery.countdown.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'Draggable',    	   			  BEVESI_INDEX_JS . '/Draggable.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'slick-min',    	    	 	  BEVESI_INDEX_JS . '/slick.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'gsap-min',    	    	 	  BEVESI_INDEX_JS . '/gsap.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'jquery-magnific-popup',    	  BEVESI_INDEX_JS . '/jquery.magnific-popup.min.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'select2-full',    			  BEVESI_INDEX_JS . '/select2.full.min.js', array('jquery'), BEVESI_VERSION, true);	
	wp_enqueue_script( 'bevesi-custom-select',        BEVESI_INDEX_JS . '/modules/custom-select.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-header-search',        BEVESI_INDEX_JS . '/modules/header-search.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-drawer',        		  BEVESI_INDEX_JS . '/modules/drawer.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-drawer-menu',          BEVESI_INDEX_JS . '/modules/drawer-menu.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-categories-button',    BEVESI_INDEX_JS . '/modules/categories-button.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-filter-products',      BEVESI_INDEX_JS . '/modules/filter-products.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-hover-gallery',        BEVESI_INDEX_JS . '/modules/hover-gallery.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-siteslider',    	 	  BEVESI_INDEX_JS . '/custom/siteslider.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-countdown',        	  BEVESI_INDEX_JS . '/custom/countdown.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-productquantity',      BEVESI_INDEX_JS . '/custom/productquantity.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-cartquantity',    	  BEVESI_INDEX_JS . '/custom/cartquantity.js', array('jquery'), BEVESI_VERSION, true);
	wp_register_script( 'bevesi-sidebarfilter',       BEVESI_INDEX_JS . '/custom/sidebarfilter.js', array('jquery'), BEVESI_VERSION, true);
	wp_register_script( 'bevesi-flex-thumbs',      	  BEVESI_INDEX_JS . '/custom/flex-thumbs.js', array('jquery'), BEVESI_VERSION, true);
	wp_register_script( 'bevesi-loginform',   		  BEVESI_INDEX_JS . '/custom/loginform.js', array('jquery'), BEVESI_VERSION, true);
	wp_register_script( 'bevesi-producttypequantity', BEVESI_INDEX_JS . '/custom/producttypequantity.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-producthover',      	  BEVESI_INDEX_JS . '/custom/producthover.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bevesi-productcontentfade',   BEVESI_INDEX_JS . '/custom/productcontentfade.js', array('jquery'), BEVESI_VERSION, true);
	wp_enqueue_script( 'bundle',    	    	 	  BEVESI_INDEX_JS . '/bundle.js', array('jquery'), BEVESI_VERSION, true);

	
}
add_action( 'wp_enqueue_scripts', 'bevesi_scripts' );

/*************************************************
## Theme Setup
*************************************************/ 

if ( ! isset( $content_width ) ) $content_width = 960;

function bevesi_theme_setup() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array('gallery', 'audio', 'video'));
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'woocommerce', array('gallery_thumbnail_image_width' => 99,) );
	load_theme_textdomain( 'bevesi', get_template_directory() . '/languages' );
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'bevesi_theme_setup' );

/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/ 

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bevesi_register_required_plugins' );

function bevesi_register_required_plugins() {

	$url = 'http://klbtheme.com/bevesi/plugins/';
	$mainurl = 'http://klbtheme.com/plugins/';

	$plugins = array(
		
        array(
            'name'                  => esc_html__('Meta Box','bevesi'),
            'slug'                  => 'meta-box',
        ),

        array(
            'name'                  => esc_html__('Contact Form 7','bevesi'),
            'slug'                  => 'contact-form-7',
        ),
		
        array(
            'name'                  => esc_html__('Kirki','bevesi'),
            'slug'                  => 'kirki',
        ),
		
		array(
            'name'                  => esc_html__('MailChimp Subscribe','bevesi'),
            'slug'                  => 'mailchimp-for-wp',
        ),
		
        array(
            'name'                  => esc_html__('Elementor','bevesi'),
            'slug'                  => 'elementor',
            'required'              => true,
        ),
		
        array(
            'name'                  => esc_html__('WooCommerce','bevesi'),
            'slug'                  => 'woocommerce',
            'required'              => true,
        ),

        array(
            'name'                  => esc_html__('Dokan Marketplace','bevesi'),
            'slug'                  => 'dokan-lite',
            'required'              => true,
        ),

        array(
            'name'                  => esc_html__('Bevesi Core','bevesi'),
            'slug'                  => 'bevesi-core',
            'source'                => $url . 'bevesi-core.zip',
            'required'              => true,
            'version'               => '1.0.7',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Envato Market','bevesi'),
            'slug'                  => 'envato-market',
            'source'                => $mainurl . 'envato-market.zip',
            'required'              => true,
            'version'               => '2.0.12',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),


	);

	$config = array(
		'id'           => 'bevesi',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}


/*************************************************
## Bevesi Register Menu 
*************************************************/

function bevesi_register_menus() {
	register_nav_menus( array( 'main-menu' 	   => esc_html__('Primary Navigation Menu','bevesi')) );
	
	$canvasbottommenu = get_theme_mod('bevesi_canvas_bottom_menu','0');
	$topleftmenu = get_theme_mod('bevesi_top_left_menu','0');
	$toprightmenu = get_theme_mod('bevesi_top_right_menu','0');
	$sidebarmenu = get_theme_mod('bevesi_header_sidebar','0');
	
	if($canvasbottommenu == '1'){
	register_nav_menus( array( 'canvas-bottom' 	   => esc_html__('Canvas Bottom Menu','bevesi')) );
	}
	
	if($topleftmenu == '1'){
		register_nav_menus( array( 'top-left-menu'     => esc_html__('Top Left Menu','bevesi')) );
	}
	
	if($toprightmenu == '1'){
		register_nav_menus( array( 'top-right-menu'     => esc_html__('Top Right Menu','bevesi')) );
	}
	
	if($sidebarmenu == '1'){
		register_nav_menus( array( 'sidebar-menu'       => esc_html__('Sidebar Menu','bevesi')) );
	}
	
}
add_action('init', 'bevesi_register_menus');

/*************************************************
## Excerpt More
*************************************************/ 

function bevesi_excerpt_more($more) {
  global $post;
  return '<div class="klb-readmore post-buttons"><a class="button black outline rounded-style size-sm" href="'. esc_url(get_permalink($post->ID)) . '">' . esc_html__('Read More', 'bevesi') . ' <i class="klbth-icon-right-arrow"></i></a></div>';
  }
 add_filter('excerpt_more', 'bevesi_excerpt_more');
 
/*************************************************
## Word Limiter
*************************************************/ 
function bevesi_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

/*************************************************
## Widgets
*************************************************/ 

function bevesi_widgets_init() {
	register_sidebar( array(
	  'name' => esc_html__( 'Blog Sidebar', 'bevesi' ),
	  'id' => 'blog-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Blog page.','bevesi' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Shop Sidebar', 'bevesi' ),
	  'id' => 'shop-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Shop.','bevesi' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer First Column', 'bevesi' ),
	  'id' => 'footer-1',
	  'description'   => esc_html__( 'These are widgets for the Footer.','bevesi' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Second Column', 'bevesi' ),
	  'id' => 'footer-2',
	  'description'   => esc_html__( 'These are widgets for the Footer.','bevesi' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Third Column', 'bevesi' ),
	  'id' => 'footer-3',
	  'description'   => esc_html__( 'These are widgets for the Footer.','bevesi' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Fourth Column', 'bevesi' ),
	  'id' => 'footer-4',
	  'description'   => esc_html__( 'These are widgets for the Footer.','bevesi' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
}
add_action( 'widgets_init', 'bevesi_widgets_init' );
 
/*************************************************
## Bevesi Comment
*************************************************/

if ( ! function_exists( 'bevesi_comment' ) ) :
 function bevesi_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>

   <article class="post pingback">
   <p><?php esc_html_e( 'Pingback:', 'bevesi' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'bevesi' ), ' ' ); ?></p>
  <?php
    break;
   default :
  ?>
	
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div id="div-comment-<?php comment_ID(); ?>">
			<article class="comment-body klb-comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<img src="<?php echo get_avatar_url( $comment, 90 ); ?>" alt="<?php comment_author(); ?>" class="avatar">
							<b class="fn"> <a class="url" href="#"><?php comment_author(); ?></a></b>
							<div class="comment-metadata"><a href="#">
							  <time><?php comment_date(); ?></time></a>
							</div>
						</div>
					</footer>
					<div class="comment-content">
						<div class="klb-post">
							<?php comment_text(); ?>
							<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'bevesi' ); ?></em>
							<?php endif; ?>
						</div>
					</div>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- reply -->
			</article>
	    </div>
	</li>
	

	
  <?php
    break;
  endswitch;
 }
endif;

/*************************************************
## Bevesi Widget Count Filter
 *************************************************/

function bevesi_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="catcount">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return bevesi_sanitize_data($links);
}
add_filter('wp_list_categories', 'bevesi_cat_count_span');
 
function bevesi_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="catcount">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return bevesi_sanitize_data($links);
}
add_filter( 'get_archives_link', 'bevesi_archive_count_span' );


/*************************************************
## Pingback url auto-discovery header for single posts, pages, or attachments
 *************************************************/
function bevesi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bevesi_pingback_header' );

/*************************************************
## Nav Description
 *************************************************/
function bevesi_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="badge ' . $item->description . '">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return bevesi_sanitize_data($item_output);
}
add_filter( 'walker_nav_menu_start_el', 'bevesi_nav_description', 10, 4 );

/************************************************************
## DATA CONTROL FROM PAGE METABOX OR ELEMENTOR PAGE SETTINGS
*************************************************************/
function bevesi_page_settings( $opt_id){
	
	if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
		// Get the current post id
		$post_id = get_the_ID();

		// Get the page settings manager
		$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

		// Get the settings model for current post
		$page_settings_model = $page_settings_manager->get_model( $post_id )->get_data('settings');

		// Retrieve the color we added before
		return isset($page_settings_model['bevesi_elementor_'.$opt_id]) ? $page_settings_model['bevesi_elementor_'.$opt_id] : false;


	}
}

/************************************************************
## Elementor Register Location
*************************************************************/
function bevesi_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
	$elementor_theme_manager->register_location( 'archive' );

}
add_action( 'elementor/theme/register_locations', 'bevesi_register_elementor_locations' );

/************************************************************
## Elementor Get Templates
*************************************************************/
function bevesi_get_elementor_template($template_id){
	if($template_id){

		$frontend = \Elementor\Plugin::instance()->frontend;
	    printf( '<div class="bevesi-elementor-template template-'.esc_attr($template_id).'">%1$s</div>', $frontend->get_builder_content_for_display( $template_id, true ) );	
	   
	   if ( class_exists( '\Elementor\Plugin' ) ) {
	        $elementor = \Elementor\Plugin::instance();
	        $elementor->frontend->enqueue_styles();
			$elementor->frontend->enqueue_scripts();
	    }
	
	    if ( class_exists( '\ElementorPro\Plugin' ) ) {
	        $elementor_pro = \ElementorPro\Plugin::instance();
	        $elementor_pro->enqueue_styles();
	    }

	}

}
add_action( 'bevesi_before_main_shop', 	 'bevesi_get_elementor_template', 10);
add_action( 'bevesi_after_main_shop', 	 'bevesi_get_elementor_template', 10);
add_action( 'bevesi_before_main_footer', 'bevesi_get_elementor_template', 10);
add_action( 'bevesi_after_main_footer',  'bevesi_get_elementor_template', 10);
add_action( 'bevesi_before_main_header', 'bevesi_get_elementor_template', 10);
add_action( 'bevesi_after_main_header',  'bevesi_get_elementor_template', 10);

/************************************************************
## Do Action for Templates and Product Categories
*************************************************************/
function bevesi_do_action($hook){
	
	if ( !class_exists( 'woocommerce' ) ) {
		return;
	}

	$categorytemplate = get_theme_mod('bevesi_elementor_template_each_shop_category');
	if(is_product_category()){
		if($categorytemplate && array_search(get_queried_object()->term_id, array_column($categorytemplate, 'category_id')) !== false){
			foreach($categorytemplate as $c){
				if($c['category_id'] == get_queried_object()->term_id){
					do_action( $hook, $c[$hook.'_elementor_template_category']);
				}
			}
		} else {
			do_action( $hook, get_theme_mod($hook.'_elementor_template'));
		}
	} else {
		do_action( $hook, get_theme_mod($hook.'_elementor_template'));
	}
	
}

/*************************************************
## Bevesi Get Image
*************************************************/
function bevesi_get_image($image){
	$app_image = ! wp_attachment_is_image($image) ? $image : wp_get_attachment_url($image);
	
	return esc_html($app_image);
}

/*************************************************
## Bevesi Get options
*************************************************/
function bevesi_get_option(){	
	$getopt  = isset( $_GET['opt'] ) ? $_GET['opt'] : '';

	return esc_html($getopt);
}

/*************************************************
## Bevesi Body Class
*************************************************/ 
function bevesi_body_input_class( $classes ) {
	
	if(get_theme_mod('bevesi_body_input_type') == 'filled') {
		$classes[] = 'input-variation-filled';
	} else {
		$classes[] = 'input-variation-default';
	}	
	
	return $classes;
}
add_filter('body_class', 'bevesi_body_input_class');
	
/*************************************************
## Bevesi Theme options
*************************************************/
	require_once get_template_directory() . '/includes/metaboxes.php';
	require_once get_template_directory() . '/includes/woocommerce.php';
	require_once get_template_directory() . '/includes/woocommerce-filter.php';
	require_once get_template_directory() . '/includes/pjax/filter-functions.php';
	require_once get_template_directory() . '/includes/sanitize.php';
	require_once get_template_directory() . '/includes/merlin/theme-register.php';
	require_once get_template_directory() . '/includes/merlin/setup-wizard.php';
	require_once get_template_directory() . '/includes/header/main-header.php';
	require_once get_template_directory() . '/includes/footer/main_footer.php';
	require_once get_template_directory() . '/includes/woocommerce/tab-ajax.php';
	