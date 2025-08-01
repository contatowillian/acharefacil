<?php

if(!defined( 'ABSPATH' )){
	exit;
}


class USIN_WC_Subscriptions extends USIN_Plugin_Module{

	public $query;
	protected $module_name = 'wc-subscriptions';
	protected $plugin_path = 'woocommerce-subscriptions/woocommerce-subscriptions.php';
	protected $post_type = 'shop_subscription';
	protected static $statuses = null;

	
	protected function apply_module_actions(){
		add_filter('usin_exclude_post_types', array($this, 'exclude_post_types'));
	}
	

	public function init(){
		if(self::custom_order_tables_enabled()){
			$this->query = new USIN_WC_Subscriptions_Query($this->post_type);
		}else{
			$this->query = new USIN_WC_Subscriptions_Query_Legacy($this->post_type);
		}
		new USIN_WC_Subscriptions_User_Activity($this->post_type);
	}

	public static function custom_order_tables_enabled(){
		return USIN_Woocommerce::custom_order_tables_enabled();
	}

	public function register_module(){
		return array(
			'id' => $this->module_name,
			'name' => __('WooCommerce Subscriptions', 'usin'),
			'desc' => __('Retrieves and displays the data from the WooCommerce Subscriptions extension.', 'usin'),
			'allow_deactivate' => true,
			'buttons' => array(
				array('text'=> __('Learn More', 'usin'), 'link'=>'https://usersinsights.com/woocommerce-subscriptions-search-filter-user-data', 'target'=>'_blank')
			),
			'active' => false
		);
	}

	public function register_fields(){
		$fields = array();

		$product_search = new USIN_Post_Option_Search(USIN_Woocommerce::PRODUCT_POST_TYPE);
		$product_search_options = $product_search->get_options();
		$product_search_action = $product_search->get_search_action();

		$fields[]=array(
			'name' => __('Has a subscription', 'usin'),
			'id' => 'has_subscription',
			'order' => false,
			'show' => false,
			'hideOnTable' => true,
			'fieldType' => $this->module_name,
			'icon' => 'woocommerce',
			'filter' => array(
				'type' => 'combined',
				'items' => array(
					array('name' => __('Start date', 'usin'), 'id' => 'start_date', 'type' => 'date'),
					array('name' => __('End date', 'usin'), 'id' => 'end_date', 'type' => 'date'),
					array('name' => __('Status', 'usin'), 'id' => 'status', 'type' => 'select', 'options' => $this->get_status_options()),
					array('name' => __('Product', 'usin'), 'id' => 'product', 'type' => 'select', 'options' => $product_search_options, 'searchAction' => $product_search_action),
				),
				'disallow_null' => true
			),
			'module' => $this->module_name
		);
		
		$fields[]=array(
			'name' => __('Subscriptions', 'usin'),
			'id' => 'subscription_num',
			'order' => 'DESC',
			'show' => true,
			'fieldType' => $this->module_name,
			'icon' => 'woocommerce',
			'filter' => array(
				'type' => 'number',
				'disallow_null' => true
			),
			'module' => $this->module_name
		);

		$fields[]=array(
			'name' => __('Subscription statuses', 'usin'),
			'id' => 'subscripton_statuses',
			'order' => false,
			'show' => false,
			'fieldType' => $this->module_name,
			'icon' => 'woocommerce',
			'filter' => array(
				'type' => 'include_exclude',
				'options' => $this->get_status_options()
			),
			'module' => $this->module_name
		);
		
		$fields[]=array(
			'name' => __('Next payment', 'usin'),
			'id' => 'subscripton_next_payment',
			'order' => 'ASC',
			'show' => false,
			'fieldType' => $this->module_name,
			'icon' => 'woocommerce',
			'filter' => array(
				'type' => 'date',
				'nodaysago' => true
			),
			'module' => $this->module_name
		);

		return $fields;
	}
	
	public static function get_statuses(){
		if(self::$statuses === null){
			//load the statuses
			if(function_exists('wcs_get_subscription_statuses')){
				self::$statuses = wcs_get_subscription_statuses();
			}else{
				self::$statuses = array();
			}
		}
		return self::$statuses;
	}

	protected function get_status_options(){
		$status_options = array();
		
		$wc_statuses = self::get_statuses();
		foreach ($wc_statuses as $status_key => $status_name) {
			$status_options[]= array('key'=>$status_key, 'val'=>$status_name);
		}
			
		return $status_options;
	}

	public function exclude_post_types($exclude){
		return array_merge ($exclude,  array($this->post_type, 'scheduled-action'));
	}
	
	/**
	 * Check if the WooCommerce Subscriptions AND WooCommerce are active
	 * @return boolean [description]
	 */
	protected function is_plugin_active(){
		return parent::is_plugin_active() && USIN_Helper::is_plugin_activated('woocommerce/woocommerce.php'); 
	}
	
}

new USIN_WC_Subscriptions();