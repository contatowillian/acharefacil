<?php

if(!defined( 'ABSPATH' )){
	exit;
}

class USIN_Pmpro_Query{

	protected $has_pmpro_field = false;
	protected $code_join_applied = false;
	protected $has_memberships_counter = 0;
	protected $levels;
	protected $countries;

	public function init(){
		$billing_keys = array('pmpro_bcountry', 'pmpro_bstate', 'pmpro_bcity');
		foreach ($billing_keys as $key ) {
			$query = new USIN_Meta_Query($key, 'text');
			$query->init();
		}

		add_filter('usin_db_map', array($this, 'filter_db_map'));
		add_filter('usin_query_join_table', array($this, 'filter_query_joins'), 10, 2);
		add_filter('usin_user_db_data', array($this, 'filter_user_db_data'));
		add_filter('usin_custom_select', array($this, 'filter_query_select'), 10, 2);
		add_filter('usin_db_aggregate_columns', array($this, 'filter_aggregate_columns'));
		add_filter('usin_custom_query_filter_pmpro_has_used_discount_code', array($this, 'apply_pmpro_has_used_discount_code'), 10, 2);
		add_filter('usin_custom_query_filter_pmpro_has_membership', array($this, 'apply_has_membership_filter'), 10, 2);
		add_filter('usin_custom_query_filter_pmpro_member_status', array($this, 'apply_member_status'), 10, 2);
	}


	public function filter_db_map($db_map){
		$db_map['pmpro_member_since'] = array('db_ref'=>'member_since', 'db_table'=>'pmpro_ms_dates', 'nulls_last'=>true);
		$db_map['pmpro_ltv'] = array('db_ref'=>'ltv', 'db_table'=>'pmpro_orders', 'null_to_zero'=>true, 'custom_select'=>true);
		$db_map['pmpro_payment_count'] = array('db_ref'=>'payment_count', 'db_table'=>'pmpro_orders', 'null_to_zero'=>true, 'custom_select'=>true);
		$db_map['pmpro_last_payment'] = array('db_ref'=>'last_payment', 'db_table'=>'pmpro_orders', 'nulls_last'=>true);
		$db_map['pmpro_has_used_discount_code'] = array('db_ref'=>'', 'db_table'=>'', 'no_select'=>true);

		// v3.0+ fields
		$db_map['pmpro_member_status'] = array('db_ref'=>'pmpro_member_status', 'db_table'=>'pmpro_active_memberships',
			'custom_select' => true, 'set_alias' => true, 'no_ref' => true);
		$db_map['pmpro_membership_num'] = array('db_ref' => 'pmpro_membership_num', 'db_table' => 'pmpro_memberships',
			'null_to_zero' => true, 'set_alias' => false, 'custom_select' => true, 'no_ref' => true);
		$db_map['pmpro_active_memberships'] = array('db_ref' => 'names', 'db_table' => 'pmpro_active_memberships', 'set_alias' => true);
		$db_map['pmpro_has_membership'] = array('db_ref' => '', 'db_table' => '', 'no_select' => true);

		// legacy fields
		$db_map['pmpro_level'] = array('db_ref'=>'membership_id', 'db_table'=>'pmpro_users', 'nulls_last'=>true);
		$db_map['pmpro_start_date'] = array('db_ref'=>'startdate', 'db_table'=>'pmpro_users', 'nulls_last'=>true);
		$db_map['pmpro_end_date'] = array('db_ref'=>'real_end_date', 'db_table'=>'pmpro_users', 'nulls_last'=>true);
		$db_map['pmpro_status'] = array('db_ref'=>'status', 'db_table'=>'pmpro_users', 'nulls_last'=>true);

		return $db_map;
	}

	public static function get_sucessful_order_condition(){
		return "status NOT IN ('refunded', 'review', 'token', 'error') AND total > 0";
	}


	public function filter_query_joins($query_joins, $table){
		global $wpdb;

		if($table == 'pmpro_users'){
			$subquery = "SELECT mu.user_id, mu.membership_id, mu.startdate, mu.enddate, mu.status, IF(mu.enddate = '0000-00-00', NULL, mu.enddate) AS real_end_date".
				" FROM $wpdb->pmpro_memberships_users mu".
				" LEFT JOIN $wpdb->pmpro_memberships_users mu2 ON mu.user_id = mu2.user_id AND mu.id < mu2.id".
				" WHERE mu2.id IS NULL GROUP BY mu.user_id";

			$query_joins .= " LEFT JOIN ($subquery) AS pmpro_users ON $wpdb->users.ID = pmpro_users.user_id";

			$this->has_pmpro_field = true;
		}elseif($table == 'pmpro_ms_dates'){
			$subquery = "SELECT user_id, MIN(startdate) AS member_since FROM $wpdb->pmpro_memberships_users mu GROUP BY user_id";
			$query_joins .= " LEFT JOIN ($subquery) AS pmpro_ms_dates ON $wpdb->users.ID = pmpro_ms_dates.user_id";
		}elseif($table == 'pmpro_orders'){
			$condition = self::get_sucessful_order_condition();
			$subquery = "SELECT SUM(total) AS ltv, COUNT(total) AS payment_count, MAX(timestamp) AS last_payment, user_id FROM $wpdb->pmpro_membership_orders".
				" WHERE $condition GROUP BY user_id";
			$query_joins .= " LEFT JOIN ($subquery) AS pmpro_orders ON $wpdb->users.ID = pmpro_orders.user_id";
		}elseif($table == 'pmpro_memberships'){
			$query_joins .= " LEFT JOIN $wpdb->pmpro_memberships_users AS pmpro_memberships ON $wpdb->users.ID = pmpro_memberships.user_id";
		}elseif($table == 'pmpro_active_memberships'){
			$subquery = "SELECT m.id, m.user_id, GROUP_CONCAT(l.name SEPARATOR ', ') AS names FROM $wpdb->pmpro_memberships_users m
				INNER JOIN $wpdb->pmpro_membership_levels AS l ON m.membership_id = l.id
				WHERE m.status = 'active'
				GROUP BY user_id";
			$query_joins .= " LEFT JOIN ($subquery) AS pmpro_active_memberships ON pmpro_active_memberships.user_id = $wpdb->users.ID";
		}

		return $query_joins;
	}

	public function filter_query_select($query_select, $field){
		if($field == 'pmpro_ltv'){
			$query_select='CAST(IFNULL(pmpro_orders.ltv, 0) AS DECIMAL(18,2))';
		}elseif($field == 'pmpro_payment_count'){
			$query_select = 'CAST(IFNULL(pmpro_orders.payment_count, 0) AS DECIMAL)';
		}elseif($field == 'pmpro_member_status'){
			$query_select = "IF(pmpro_active_memberships.user_id IS NULL, 'inactive', 'active')";
		}elseif($field == 'pmpro_membership_num'){
			$query_select = 'COUNT(DISTINCT pmpro_memberships.id) AS pmpro_membership_num';
		}
		return $query_select;
	}

	public function filter_aggregate_columns($columns) {
		$columns[] = 'pmpro_membership_num';
		return $columns;
	}

	public function apply_has_membership_filter($custom_query_data, $filter) {
		global $wpdb;
		$joins = array();

		$cond_builder = new USIN_Combined_Filter_Condition_Builder();

		foreach ($filter->condition as $condition) {
			switch ($condition->id) {
				case 'level':
					$cond_builder->add_number_condition('membership_id', $condition->val, false, false);
					break;
				case 'status':
					$cond_builder->add_text_condition('status', $condition->val);
					break;
				case 'start_date':
					$cond_builder->add_date_range_condition('startdate', $condition->val);
					break;
				case 'end_date':
					$cond_builder->add_date_range_condition('enddate', $condition->val, true);
					break;
			}
		}

		$table_name = "has_memberships_" . $this->has_memberships_counter++;

		$custom_query_data['joins'] .= " INNER JOIN (" .
			" SELECT memberships.user_id FROM $wpdb->pmpro_memberships_users AS memberships " .
			implode(" ", $joins) . " WHERE 1=1" . $cond_builder->build(true) .
			") AS $table_name ON $wpdb->users.ID = $table_name.user_id";
		
		return $custom_query_data;
	}

	public function apply_member_status($custom_query_data, $filter){
		$operator = $filter->condition == 'active' ? 'IS NOT' : 'IS';
		$custom_query_data['where'] = " AND pmpro_active_memberships.user_id $operator NULL";
		return $custom_query_data;
	}

	public function filter_user_db_data($user_data){
		
		if(property_exists($user_data, 'pmpro_level') && !empty($user_data->pmpro_level)){
			$levels = $this->get_levels();
			if(isset($levels[$user_data->pmpro_level])){
				$user_data->pmpro_level = $levels[$user_data->pmpro_level];
			}
		}

		if(property_exists($user_data, 'pmpro_bcountry') && !empty($user_data->pmpro_bcountry)){
			$countries = $this->get_countries();
			if(isset($countries[$user_data->pmpro_bcountry])){
				$user_data->pmpro_bcountry = $countries[$user_data->pmpro_bcountry];
			}
		}

		if(property_exists($user_data, 'pmpro_member_status') && !empty($user_data->pmpro_member_status)){
			$is_export = isset($user_data->is_exported) && $user_data->is_exported;
			if(!$is_export){
				$tag_status = $user_data->pmpro_member_status == 'active' ? 'active' : null;
				$user_data->pmpro_member_status = USIN_Html::tag($user_data->pmpro_member_status, $tag_status);
			}
		}
		
		return $user_data;
	}

	protected function get_levels(){
		if(!isset($this->levels)){
			$this->levels = USIN_Pmpro::get_levels(true);
		}
		return $this->levels;
	}

	protected function get_countries(){
		if(!isset($this->countries)){
			$this->countries = USIN_Pmpro::get_countries(true);
		}
		return $this->countries;
	}

	public function apply_pmpro_has_used_discount_code($custom_query_data, $filter){
		global $wpdb;

		if(!$this->code_join_applied){
			$custom_query_data['joins'] .=
				" INNER JOIN $wpdb->pmpro_discount_codes_uses AS pmpro_dcu ON $wpdb->users.ID = pmpro_dcu.user_id";
			$this->code_join_applied = true;
		}

		$custom_query_data['having'] = $wpdb->prepare(" AND SUM(pmpro_dcu.code_id = %d) > 0", $filter->condition);

		return $custom_query_data;
	}
}