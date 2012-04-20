<?php

/**
 * 会议记录
 */
class Meetinguserlog_model extends CU_Model{
	
	protected $_name = 'vitime_meeting_userlog';
	
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
	 * 新增记录
	 * @param $meet_id
	 * @param $user_id
	 * @param $date
	 */
	public function newLog($meet_id,$user_id,$date){
		if(empty($meet_id) || empty($user_id)){
			return 0;
		}
		$data = array(
			'meet_id'=>$meet_id,
			'user_id'=>$user_id,
			'date'=>$date
		);
		return $this->insert($data);
	}
	
	
}