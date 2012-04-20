<?php

/**
 * 企业数据表
 */
class Meeting_model extends CU_Model{
	
	protected $_name = 'vitime_meeting';
	
	protected $_primary = 'id';
	
	/**
	 * @param $id
	 */
	public function get($id){
		if(empty($id)){
			return array();
		}
		return $this->find($id);
		
	}
	/**
	 * 新增会议
	 * @param unknown_type $companyName
	 * @param unknown_type $companyMark
	 */
	public function newMeeting($cmpId,$userId,$title,$startTime,$endTime,$type,$state,$password,$usercount){
		if(empty($cmpId) || empty($userId) || empty($title)){
			return 0;
		}
		$data = array(
			'company_id'=>$cmpId,
			'user_id'=>$userId,
			'title'=>$title,
			'start_time'=>$startTime,
			'end_time'=>$endTime,
			'type'=>$type,
			'state'=>$state,
			'password'=>$password,
			'usercount'=>$usercount
		);
		return $this->insert($data);
	}
	
	
}