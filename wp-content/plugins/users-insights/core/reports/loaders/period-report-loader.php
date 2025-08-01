<?php

class USIN_Period_Report_Loader extends USIN_Report_Loader{

	public $options;
	protected $period_type;
	protected $periods;
	protected $page;

	protected function setup(){
		$this->page = $this->get_page();
		$this->period_type = $this->getSelectedFilter();
		$this->periods = $this->get_periods();
	}

	protected function get_period_start(){
		return $this->periods[0]['start'];
	}

	protected function get_period_end(){
		return $this->periods[sizeof($this->periods) - 1]['end'];
	}

	protected function get_period_group_by($column){
		switch($this->period_type){
			case USIN_Period_Report::PERIOD_DAILY:
				return sprintf('YEAR(%s), MONTH(%s), DAY(%s)', $column, $column, $column);
			case USIN_Period_Report::PERIOD_WEEKLY:
				return sprintf('YEAR(%s), WEEK(%s, 1)', $column, $column);
			case USIN_Period_Report::PERIOD_MONTHLY:
				return sprintf('YEAR(%s), MONTH(%s)', $column, $column);
			case USIN_Period_Report::PERIOD_YEARLY:
				return sprintf('YEAR(%s)', $column);
		}
	}

	protected function get_group_by(){
		return $this->get_period_group_by($this->label_col);
	}

	protected function format_data($data){
		$res = array();
		foreach($this->periods as $i => $period){
			$row = current(array_filter($data, array(new USIN_Period_Matcher($period['start'], $period['end']), 'is_between')));

			$res[]= (object)array(
				'label' => $period['name'],
				'total' => isset($row->total) ? $row->total : 0
			);
		}

		return $res;
	}

	protected function get_periods($num_periods = null){
		$current_time = current_time('timestamp');

		switch($this->period_type){
			case USIN_Period_Report::PERIOD_DAILY:
				return USIN_Report_Periods::daily($current_time, $num_periods, $this->page);
			case USIN_Period_Report::PERIOD_WEEKLY:
				return USIN_Report_Periods::weekly($current_time, $num_periods, $this->page);
			case USIN_Period_Report::PERIOD_MONTHLY:
				return USIN_Report_Periods::monthly($current_time, $num_periods, $this->page);
			case USIN_Period_Report::PERIOD_YEARLY:
				return USIN_Report_Periods::yearly($current_time, $num_periods, $this->page);
		}
	}

}


class USIN_Period_Matcher{
	private $start;
	private $end;

	public function __construct($start, $end){
		$this->start = strtotime($start);
		$this->end = strtotime($end);
	}

	public function is_between($row){
		$date = strtotime($row->label);
		return ($date >= $this->start && $date <= $this->end);
	}
}