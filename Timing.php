<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
|
| Timing Class
|
|
|	@package	Date and Timing Operations
|	@subpackage	Libraries
|	@category	DateTime 
|	@author		KRISHNAKUMAR M
|
|
**/

class Timing {
    
	/**
	|
	|	This Function Used to get dates between two days
	|	Params
	|	@ start_date 
	|	@ end_date
	|	@ steps used to get result based on intervels
	|	@ ouput_format used to get result in user needed format
	|
	**/ 
    
	public function createDateRangeArray($start_date , $end_date , $step = '+1 day', $output_format = 'Y-m-d' ) {
		$dates = array();
		$current = strtotime($start_date);
		$last = strtotime($end_date);
		while( $current <= $last ) {
			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}
		return $dates;
	}
	
	/**
	|
	|	This Function Used check given time Occurs between from and to time
	|	 @ $FromTime is starting timee
	|	 @ $end Time is Finishing time
	|	 @ $timetocheck is to  check occurance 
	|
	**/
	
	function CheckTimeBetween($FromTime, $ToTime, $TimeToCheck) {
		$FromTime = +str_replace(":", "", $FromTime);
		$ToTime = +str_replace(":", "", $ToTime);
		$TimeToCheck = +str_replace(":", "", $TimeToCheck);
		if ($ToTime >= $FromTime) {
			return $FromTime <= $TimeToCheck && $TimeToCheck <= $ToTime;
		}else{
			return ! ($ToTime <= $TimeToCheck && $TimeToCheck <= $FromTime);
		}
	}
	
	/**
	|
	|	This Function Used Sort multi dimentional array by columnkey
	|	 
	|	 
	|
	**/
	
	public function sortBycolumnkey($FirstArray, $SecondArray, $columnkey) { 
		$t1 = strtotime($FirstArray[$columnkey]);
		$t2 = strtotime($SecondArray[$columnkey]);
		return $t1 - $t2;
	}
	
	/**
	|
	|	This Function Used to get time difference between twodate and times
	|	 
	|	 
	|
	**/
	
	public function gettimediff($FromDateTime , $ToDateTime){
		$datetime1 = new DateTime($FromDateTime);
		$datetime2 = new DateTime($ToDateTime);
		$interval1 = $datetime1->diff($datetime2);

		return array('hour'=>$interval1->format('%h'),'min'=>$interval1->format('%i'));
	}
	
	/**
	|
	|	This Function Used to get time to minutes
	|	if time 01:30 means return 90 mins
	|	 
	|
	**/
	
	public function time_to_minutes($time){
		$time_array = explode(':',$time);
		if(count($time_array) == 2){
			$total_minutes = ($time_array[0]*60)+$time_array[1];
		}else{
			$total_minutes = $time;
		}
		return $total_minutes;
	}
	
	/**
	|
	|	This Function Used to find difference between two time and add it to new time and return time
	|	
	|	 
	|
	**/
	
	public function addtimediff($FromTime , $ToTime , $NewTime , $output_format = 'Y-m-d H:i:s'){
		$datetime1 = new DateTime($FromTime);
		$datetime2 = new DateTime($ToTime);
		$interval1 = $datetime1->diff($datetime2);
		$diffhour = $interval1->format('%h');
		$diffmin = $interval1->format('%i');
		
		$job_from_datetime = $NewTime
		
		$DiffTime = new DateTime($job_current_from_time);
		$DiffTime->modify('+'.$diffhour.' hours');
		$DiffTime->modify('+'.$diffmin.' minutes');
		return  $DiffTime->format($output_format);
	}
    
}