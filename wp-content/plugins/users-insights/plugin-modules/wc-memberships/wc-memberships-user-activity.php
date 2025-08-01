<?php

class USIN_WC_Memberships_User_Activity{

	protected $post_type;

	public function __construct($post_type){
		$this->post_type = $post_type;
		$this->init();
	}

	public function init(){
		add_filter('usin_user_activity', array($this, 'add_memberships_to_user_activity'), 10, 2);
		add_action('pre_get_posts', array($this, 'admin_memberships_filter'));
	}
	
	public function add_memberships_to_user_activity($activities, $user_id){
		
		if(function_exists('wc_memberships_get_user_memberships')){
			
			$memberships = wc_memberships_get_user_memberships($user_id);
			$count = sizeof($memberships);
			
			if(!empty($memberships)){
				$list = array();
				
				foreach ($memberships as $membership) {
					$title = $membership->plan->name;
					$details = array();
					
					if(function_exists('wc_memberships_get_user_membership_status_name')){
						$title.= USIN_Html::tag(wc_memberships_get_user_membership_status_name($membership->status), $membership->status);
					}
					
					if(method_exists($membership, 'get_local_start_date')){
						$start_date = $membership->get_local_start_date();
						if($start_date !== null){
							$details []= USIN_Html::activity_label(__('Start Date', 'usin'), USIN_Helper::format_date( $start_date ));
						}
					}
					if(method_exists($membership, 'get_local_end_date')){
						$end_date = $membership->get_local_end_date();
						if($end_date !== null){
							$details []= USIN_Html::activity_label(__('Expiry Date', 'usin'), USIN_Helper::format_date( $end_date ));
						}
					}
					if(method_exists($membership, 'get_local_cancelled_date')){
						$cancelled_date = $membership->get_local_cancelled_date();
						if($cancelled_date !== null){
							$details []= USIN_Html::activity_label(__('Cancelled Date', 'usin'), USIN_Helper::format_date( $cancelled_date ));
						}
					}
					
					$membership_info = array('title'=>$title, 'link'=>get_edit_post_link($membership->id, 'usin'));
					if(!empty($details)){
						$membership_info['details'] = $details;
					}
					
					$list[]=$membership_info;
				}
				
				$activities[]=array(
					'type' => 'wc_memberships',
					'list' => $list,
					'label' => _n('Membership', 'Memberships', $count, 'usin'),
					'count' => $count,
					'link' => admin_url('edit.php?post_type='.$this->post_type.'&usin_customer='.$user_id),
					'icon' => 'woocommerce'
				);
				
			}
			
		}
		
		return $activities;
	}
	
	public function admin_memberships_filter($query){
		if( is_admin() && isset($_GET['usin_customer']) && $query->get('post_type') == $this->post_type){
			$user_id = intval($_GET['usin_customer']);

			if($user_id){
				$query->set('author', $user_id);
			}
		}
	}
	
	
}