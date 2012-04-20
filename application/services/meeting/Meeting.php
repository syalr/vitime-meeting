<?php
/**
 * 会议
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-20
 */
class Meeting {

	protected $meeting_info = array();
	
	public function __get($key){
		return $this->meeting_info[$key];
	}
	
	public function __set($key,$value){
		$this->meeting_info[$key] = $value;
	}
	
	/**
	 * 是否公开会议
	 */
	public function isPublic(){
		
	} 
	
	/**
	 * 是否正在会议中
	 */
	public function isMeeting(){}
	
	/**
	 * 是否结束 
	 */
	public function isOver(){}
	
	/**
	 * 是否已经取消
	 */
	public function isCancel(){}
	
	/**
	 * 读取参与会议人员列表
	 */
	public function getPartner(){
		if(empty($this->meeting_info['partners'])){
			//@todo 读取与会者
		}
		
		return $this->meeting_info['partners'];
	}
}

?>