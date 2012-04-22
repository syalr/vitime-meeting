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
	public function newMeeting($data){
		
		return $this->insert($data);
	}
	
	/**
	 * 读取会议列表
	 * @param int $company_id
	 * @param int $page
	 * @param int $limit
	 */
	public function getCompanyMeetingList($user_id,$company_id,$page = 1,$limit = 10){
		if(empty($company_id)){
			return array();
		}
		$page = max(intval($page),1);
		$offset = ($page - 1)*$limit;
		$where = array('company_id'=>$company_id,'type'=>1);
		return $this->selectByPage('*',$where,"(user_id={$user_id}) desc,start_time desc",$limit,$offset);
	}
	
	/**
	 * 读取公共会议列表
	 * @param int $page
	 * @param int $limit
	 */
	public function getPublicMeetingList($user_id,$page = 1,$limit = 10){
		$page = max(intval($page),1);
		$offset = ($page - 1)*$limit;
		$where = array('type'=>0);
		return $this->selectByPage('*',$where,"(user_id={$user_id}) desc,start_time desc",$limit,$offset);
	}
	
}