<?php

/*

Human Friendly dates by Invent Partners
We hope you enjoy using this free class.
Remember us next time you need some software expertise!
http://www.inventpartners.com

modified by: RCWD roberto@cantarano.com
- added language support (for PO file);
- added time to some dates (optional)
*/

class nggDateHumanRelativeDate{

	private $current_timestamp;
	private $current_timestamp_day;
	private $event_timestamp;
	private $event_timestamp_day;
	private $calc_time 		= false;
	private $show_time 		= true;
	private $string 		= 'now';
	private $magic_5_mins 	= 300;
	private $magic_15_mins 	= 900;
	private $magic_30_mins 	= 1800;
	private $magic_1_hour 	= 3600;
	private $magic_1_day 	= 86400;
	private $magic_1_week 	= 604800;
	
	public function __construct(){
	
		$this->current_timestamp = current_time('timestamp', $gmt=0);
		$this->current_timestamp_day = mktime(0,  0 ,  0 , $month = date_i18n("n") , $day = date_i18n("j") , date_i18n("Y"));
	
	}
	
	public function getTextForSQLDate($sql_date, $settings = array( 'show_time' => true, 'show_minute_until_60' => true ) ){
		$this->show_time 			= $settings['show_time'];
		$this->show_minute_until_60	= $settings['show_minute_until_60'];
		// Split SQL date into date / time
		@list($date , $time) = explode(' ' , $sql_date);
		// Split date in Y,m,d
		@list($Y,$m,$d) = explode('-' , $date);
		// Check that this is actually a valid date!
		if(@checkdate($m , $d , $Y)){
			// If we have a time, then we can show relative time calcs!
			if(isset($time) && $time){
				$this->calc_time = true;
				// Split tim in H,i,s
				@list($H,$i,$s) = explode(':' , $time);
			} else {
				$this->calc_time = false;
				$H=12;
				$i=0;
				$s=0;
			}
			// Set the event timestamp
			$this->event_timestamp = mktime($H, $i , $s , $m , $d , $Y);
			$this->event_timestamp_day = mktime(0 , 0 , 0 , $m , $d , $Y);
			
			//Get the string
			$this->getString();
		} else {
			$this->string = __('invalid date', 'nggdate');
		}
		
		return $this->string;
		
	}
	
	public function getString(){
		
		// Is this today
		if($this->event_timestamp_day == $this->current_timestamp_day){
			if($this->calc_time){
				$this->calcTimeDiffString();
				return true;
			} else {
				$this->string = __('today', 'nggdate');
				return true;
			}
		} else {
			$this->calcDateDiffString();
			return true;
		}
	
	}

	protected function calcTimeDiffString(){
	
		$diff = $this->event_timestamp - $this->current_timestamp;
		// Future events
		if($diff > 0){
			if($diff < $this->magic_5_mins){
				$this->string = __('now', 'nggdate');
			} else if ($diff < $this->magic_15_mins){
				$this->string = __('in the next minutes', 'nggdate');
			} else if ($diff < $this->magic_30_mins){
				$this->string = __('in the next half hour', 'nggdate');
			} else if ($diff < $this->magic_1_hour){
				$this->string = __('in the next hour', 'nggdate');
			} else {
				$this->string = sprintf( __('today at %s', 'nggdate'), date_i18n('H:i' , $this->event_timestamp) );
			}
		}
		// Past Events
		else {
			$diff = abs($diff);
			if($diff < $this->magic_5_mins){
				$this->string = __('just now', 'nggdate');
			} else if ($diff < $this->magic_15_mins){
				$this->string = __('a few minutes ago', 'nggdate');
			} else if ($diff < $this->magic_30_mins){
				$this->string = __('in the last half hour', 'nggdate');
			} else if ($diff < $this->magic_1_hour){
				$this->string = __('in the last hour', 'nggdate');
			} else  if ($diff < ($this->magic_1_hour * 2)){
				$this->string = __('1 hour ago', 'nggdate');
			} else {
				$this->string = floor($diff / $this->magic_1_hour).' '. __('hours ago', 'nggdate');
				//$this->string = 'today at ' . date_i18n('H:i' , $this->event_timestamp);
			}
		
		}
	
	}
	
	protected function calcDateDiffString(){
	
		$diff 		= $this->event_timestamp_day - $this->current_timestamp_day;
		$at_time	= __( '%1$s, at %2$s', 'nggdate' );
		// Future events
		if($diff > 0){
			//Tomorrow
			if($diff >= $this->magic_1_day && $diff < ($this->magic_1_day * 2)){
				$this->string = __('tomorrow', 'nggdate'); 
				if($this->show_time == true){
					$this->string = sprintf( $at_time, $this->string, date_i18n( get_option('time_format'), $this->event_timestamp ) );
				}				
				return true;
			} else if($diff <= $this->magic_1_week){
				// Find out if this date is this week or next!
				$current_day = date_i18n('w' , $this->current_timestamp_day);
				if($current_day == 0){
					$current_day = 7;
				}
				$event_day = date_i18n('w' , $this->event_timestamp_day);
				if($event_day == 0){
					$event_day = 7;
				}
				if($event_day > $current_day){
					$this->string = sprintf( __( 'this %s', 'nggdate' ), date_i18n('l' , $this->event_timestamp_day) );
					if($this->show_time == true){
						$this->string = sprintf( $at_time, $this->string, date_i18n( get_option('time_format'), $this->event_timestamp ) );
					}					
				} else {
					$this->string = sprintf( __( 'next %s', 'nggdate' ), date_i18n('l' , $this->event_timestamp_day) );
				}
			} else if($diff <= ($this->magic_1_week * 2) ) {
				$this->string = sprintf( __('a week of %s', 'nggdate'), date_i18n('l' , $this->event_timestamp_day) );
			} else {
				$month_diff = $this->calcMonthDiff();
				if($month_diff == 0){
					$this->string = __('by the end of this month', 'nggdate');
				} else if($month_diff == 1){
					$this->string = __('next month', 'nggdate');
				} else {
					$this->string = sprintf( __( 'in %s months', 'nggdate' ), $month_diff );
				}
			}
		} 
		// Historical events
		else {
			$diff = abs($diff);
			//Tomorrow
			if($diff >= $this->magic_1_day && $diff < ($this->magic_1_day * 2)){
				$this->string =  __( 'yesterday', 'nggdate' ); 
				if($this->show_time == true){
					$this->string = sprintf( $at_time, $this->string, date_i18n( get_option('time_format'), $this->event_timestamp ) );
				}				
				return true;
			} else if($diff <= $this->magic_1_week){
				$this->string = sprintf( __( 'last %s', 'nggdate' ), date_i18n('l' , $this->event_timestamp) );
				if($this->show_time == true){
					$this->string = sprintf( $at_time, $this->string, date_i18n( get_option('time_format'), $this->event_timestamp ) );
				}
			} else if($diff <= ($this->magic_1_week * 2) ) {
				$this->string = __( 'more than a week ago', 'nggdate' );
			} else {
				$month_diff = $this->calcMonthDiff();
				if($month_diff == 0){
					$this->string = __( 'earlier this month', 'nggdate' );
				} else if($month_diff == 1){
					$this->string = __( 'last month', 'nggdate' );
				} else {
					if($month_diff > 12){
						$this->string = __( 'more than a year ago', 'nggdate' );
					} else {
						$this->string = sprintf( __( '%s months ago', 'nggdate' ), $month_diff );
					}
				}
			}
			
		}
	
	}
	
	protected function calcMonthDiff(){
		$event_month = intval( (date_i18n('Y' , $this->event_timestamp_day) * 12) + date_i18n('m' , $this->event_timestamp_day));
		$current_month = intval( (date_i18n('Y' , $this->current_timestamp_day) * 12) + date_i18n('m' , $this->current_timestamp_day));
		$month_diff = abs($event_month - $current_month);
		return $month_diff;
	}

}

function rcwd_nggdate_since($date){
	if($date == '') return false;
	global $nggDateHumanRelativeDate;
	if(!isset($nggDateHumanRelativeDate)) $nggDateHumanRelativeDate = new nggDateHumanRelativeDate();
	return $nggDateHumanRelativeDate->getTextForSQLDate($date);	
}
?>