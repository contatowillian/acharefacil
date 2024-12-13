<?php
/**
* Plugin Name: Bevesi Core
* Description: Premium & Advanced Essential Elements for Elementor
* Plugin URI:  http://themeforest.net/user/KlbTheme
* Version:     1.0.7
* Author:      KlbTheme
* Author URI:  http://themeforest.net/user/KlbTheme
*/


/*
* Exit if accessed directly.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

final class Bevesi_Elementor_Addons
{
    /**
    * Plugin Version
    *
    * @since 1.0
    *
    * @var string The plugin version.
    */
    const VERSION = '1.0.0';

    /**
    * Minimum Elementor Version
    *
    * @since 1.0
    *
    * @var string Minimum Elementor version required to run the plugin.
    */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
    * Minimum PHP Version
    *
    * @since 1.0
    *
    * @var string Minimum PHP version required to run the plugin.
    */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
    * Instance
    *
    * @since 1.0
    *
    * @access private
    * @static
    *
    * @var Bevesi_Elementor_Addons The single instance of the class.
    */
    private static $_instance = null;

    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.0
    *
    * @access public
    * @static
    *
    * @return Bevesi_Elementor_Addons An instance of the class.
    */
    public static function instance()
    {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Constructor
    *
    * @since 1.0
    *
    * @access public
    */
    public function __construct()
    {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Load Textdomain
    *
    * Load plugin localization files.
    *
    * Fired by `init` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function i18n()
    {
        load_plugin_textdomain( 'bevesi-core' );
    }
	
   /**
    * Initialize the plugin
    *
    * Load the plugin only after Elementor (and other plugins) are loaded.
    * Checks for basic plugin requirements, if one check fail don't continue,
    * if all check have passed load the files required to run the plugin.
    *
    * Fired by `plugins_loaded` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function init()
    {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'bevesi_admin_notice_missing_main_plugin' ] );
            return;
        }
        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'bevesi_admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'bevesi_admin_notice_minimum_php_version' ] );
            return;
        }
		
		// Categories registered
        add_action( 'elementor/elements/categories_registered', [ $this, 'bevesi_add_widget_category' ] );

		/* Init Include */
        require_once( __DIR__ . '/init.php' );

        /* Customizer Kirki */
        require_once( __DIR__ . '/inc/customizer.php' );

        /* Style php */
        require_once( __DIR__ . '/inc/style.php' );
		
		/* Aq Resizer Image Resize */
        require_once( __DIR__ . '/inc/aq_resizer.php' );
		
		/* Breadcrumb */
        require_once( __DIR__ . '/inc/breadcrumb.php' );

		/* Newsletter */
		if(get_theme_mod('bevesi_newsletter_popup_toggle',0) == 1){
			require_once( __DIR__ . '/inc/newsletter-popup/newsletter-main.php' );
		}

		/* GDPR */
		if(get_theme_mod('bevesi_gdpr_toggle',0) == 1){
			require_once( __DIR__ . '/inc/gdpr/gdpr-main.php' );
		}
		
		/* KLB Attribute Search Filter */
		require_once( __DIR__ . '/inc/klb-attribute-search/klb-attribute-search.php' );
		
		/* Post view for popular posts widget */
        require_once( __DIR__ . '/inc/post_view.php' );

        /* Popular Posts Widget */
        require_once( __DIR__ . '/widgets/widget-popular-posts.php' );

		/* Search Filter */
        require_once( __DIR__ . '/widgets/widget-search-filter.php' );
		
		/* Social Media */
        require_once( __DIR__ . '/widgets/widget-social-media.php' );
		
		/* WooCommerce Filter */
        require_once( __DIR__ . '/woocommerce-filter/woocommerce-filter.php' );
		
		/* Location Taxonomy */
		if(get_theme_mod('bevesi_location_filter',0) == 1){
			require_once( __DIR__ . '/taxonomy/location_taxonomy.php' );
		}
		
		/* Maintenance */
		if(get_theme_mod('bevesi_maintenance_toggle', 0) == 1 || bevesi_ft() == 'maintenance'){
			require_once( __DIR__ . '/inc/maintenance/maintenance.php' );
		}
		
		/* Menu Item Icon */
		require_once( __DIR__ . '/inc/menu-item-icon/menu-item-icon.php' );
		
		/* Menu Endpoints - Mega Menu*/
		require_once( __DIR__ . '/inc/menu-endpoints/menu-endpoints.php' );
		
        /* Custom plugin helper functions */
        require_once( __DIR__ . '/elementor/classes/class-helpers-functions.php' );
		
        /* Custom plugin helper functions */
        require_once( __DIR__ . '/elementor/classes/class-customizing-page-settings.php' );

        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );
		
		// Register Widget Editor Style
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'widget_editor_style' ] );

        // Register Widget Editor Scripts
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'widget_editor_scripts' ] );
		
        // Widgets registered
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
    }
	
    /**
    * Register Widgets Category
    *
    */
    public function bevesi_add_widget_category( $elements_manager )
    {
        $elements_manager->add_category( 'bevesi', ['title' => esc_html__( 'Bevesi Core', 'bevesi-core' )]);
    }	
	
    /**
    * Init Widgets
    *
    * Include widgets files and register them
    *
    * @since 1.0
    *
    * @access public
    */
    public function init_widgets()
    {	
		
		// Home Slider
		require_once( __DIR__ . '/elementor/widgets/bevesi-home-slider.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Home_Slider_Widget() );
		
		// Banner Box
		require_once( __DIR__ . '/elementor/widgets/bevesi-banner-box.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Banner_Box_Widget() );
		
		// Banner Box 2
		require_once( __DIR__ . '/elementor/widgets/bevesi-banner-box2.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Banner_Box2_Widget() );
		
		// Text Box
		require_once( __DIR__ . '/elementor/widgets/bevesi-text-box.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Text_Box_Widget() );
		
		// Icon Box 
		require_once( __DIR__ . '/elementor/widgets/bevesi-icon-box.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Icon_Box_Widget() );
		
		// Product Tab Carousel 
		require_once( __DIR__ . '/elementor/widgets/bevesi-product-tab-carousel.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Product_Tab_Carousel_Widget() );
		
		// Counter Banner
		require_once( __DIR__ . '/elementor/widgets/bevesi-counter-banner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Counter_Banner_Widget() );
		
		// Text Banner
		require_once( __DIR__ . '/elementor/widgets/bevesi-text-banner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Text_Banner_Widget() );
		
		// Text Banner 2
		require_once( __DIR__ . '/elementor/widgets/bevesi-text-banner2.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Text_Banner2_Widget() );
		
		// Page Banner
		require_once( __DIR__ . '/elementor/widgets/bevesi-page-banner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Page_Banner_Widget() );
		
		// Address Box
		require_once( __DIR__ . '/elementor/widgets/bevesi-address-box.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Address_Box_Widget() );
		
		// Bevesi Vendor Carousel
		if(class_exists('WeDevs_Dokan')){
			require_once( __DIR__ . '/elementor/widgets/bevesi-vendor-carousel.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Vendor_Carousel_Widget() );
		}
		
		// Product Banner
		require_once( __DIR__ . '/elementor/widgets/bevesi-product-banner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Product_Banner_Widget() );
		
		// Product Categories
		require_once( __DIR__ . '/elementor/widgets/bevesi-product-categories.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Product_Categories_Widget() );
		
		// Bevesi Category Banner
		require_once( __DIR__ . '/elementor/widgets/bevesi-category-banner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Category_Banner_Widget() );
		
		// Bevesi Category Banner 2
		require_once( __DIR__ . '/elementor/widgets/bevesi-category-banner2.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Category_Banner2_Widget() );
		
		// Product List
		require_once( __DIR__ . '/elementor/widgets/bevesi-product-list.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Product_List_Widget() );
		
		// Product Carousel
		require_once( __DIR__ . '/elementor/widgets/bevesi-product-carousel.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Product_Carousel_Widget() );
		
		// Product Grid
		require_once( __DIR__ . '/elementor/widgets/bevesi-product-grid.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Product_Grid_Widget() );
		
		// Lateste Posts
		require_once( __DIR__ . '/elementor/widgets/bevesi-latest-blog.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Latest_Blog_Widget() );
		
		// Custom Title
		require_once( __DIR__ . '/elementor/widgets/bevesi-custom-title.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Custom_Title_Widget() );
		
		// Client Carousel
		require_once( __DIR__ . '/elementor/widgets/bevesi-client-carousel.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Client_Carousel_Widget() );
		
		// Contact Form 7
		require_once( __DIR__ . '/elementor/widgets/bevesi-contact-form-7.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Bevesi_Contact_Form_7_Widget() );
	}
	
	
    /**
    * Admin notice
    *
    * Warning when the site doesn't have Elementor installed or activated.
    *
    * @since 1.0
    *
    * @access public
    */
    public function bevesi_admin_notice_missing_main_plugin()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '%1$s requires %2$s to be installed and activated.', 'bevesi-core' ),
            '<strong>' . esc_html__( 'Bevesi Core', 'bevesi-core' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'bevesi-core' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required Elementor version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function bevesi_admin_notice_minimum_elementor_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'bevesi-core' ),
            '<strong>' . esc_html__( 'Bevesi Core', 'bevesi-core' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'bevesi-core' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required PHP version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function bevesi_admin_notice_minimum_php_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'bevesi-core' ),
            '<strong>' . esc_html__( 'Bevesi Core', 'bevesi-core' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'bevesi-core' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
	
    public function widget_styles()
    {
    }

    public function widget_scripts()
    {


		if (is_admin ()){
			wp_enqueue_media ();
			wp_enqueue_script( 'widget-image', plugins_url( 'js/widget-image.js', __FILE__ ));
		}

        // custom-scripts
		if ( is_rtl() ) {
			wp_enqueue_script( 'bevesi-core-custom-scripts-rtl', plugins_url( 'elementor/custom-scripts-rtl.js', __FILE__ ), true );
		} else {
			wp_enqueue_script( 'bevesi-core-custom-scripts', plugins_url( 'elementor/custom-scripts.js', __FILE__ ), true );
		}
    }
	
    public function widget_editor_style(){
		wp_enqueue_style( 'klb-editor-style', plugins_url( 'elementor/editor-style.css', __FILE__ ), true );
    }

    public function widget_editor_scripts(){
		
		wp_enqueue_script( 'klb-editor-scripts', plugins_url( 'elementor/editor-scripts.js', __FILE__ ), true );

    }


} 
Bevesi_Elementor_Addons::instance();