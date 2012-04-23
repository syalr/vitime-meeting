<?php
require_once SERVICE_DIR.'company/CmpUserManage.php';
require_once SERVICE_DIR.'company/CmpAdminManage.php';
require_once SERVICE_DIR.'meeting/MeetingManage.php';

class Mymeeting extends CU_Controller {
	
	public function index(){
		$this->_redirect('company_meeting');
	}
	

	/**
	 * 企业会议列表
	 */
	public function company_meeting(){
		$page = $this->input->get('page',true);
		
		$meetingList = MeetingManage::getInstance()->listCmpMeeting($page);
		$this->displayHtml($meetingList);
	}
	
	/**
	 * 公共会议列表
	 */
	public function public_meeting(){
		$page = $this->input->get('page',true);
		
		$meetingList = MeetingManage::getInstance()->listPubMeeting($page);
		$this->displayHtml($meetingList);
	}
	
	/**
	 * 读取参与会议的人员
	 * @param int $meeting_id
	 */
	public function get_meeting_user_list($meeting_id = null){
		if(empty($meeting_id) || !is_numeric($meeting_id)){
			exit('[]');
		}
		$list = MeetingManage::getInstance()->listCmpMeetingUser($meeting_id);
		if(empty($list)){
			exit('[]');
		}else{
			exit(json_encode($list));
		}
	}
	
	/**
	 * 预约企业会议
	 */
	public function company_reservation(){
		$user_list = CmpAdminManage::getInstance()->listAllUser('name,username,id',0);
		$this->displayHtml(array('_action'=>'company_meeting','user_list'=>$user_list));
	}
	
	/**
	 * 发布会议
	 */
	public function do_company_reservation(){
		$postData = $this->input->post(NULL,TRUE);
		if(empty($postData)){
			$this->_redirect('company_reservation');
		}
		
		$errMsg = '';
		if(empty($postData['title'])){
			$errMsg .='会议主题必须填写&nbsp;&nbsp;';
		}
		
		if(empty($postData['start_time'])){
			$errMsg .="会议开始时间必须填写";
		}
		
		if(!empty($errMsg)){
			$postData['errMsg'] = $errMsg;
			$this->displayHtml($postData,'company_reservation');
		}else{
			$rs = MeetingManage::getInstance()->bookMeeting($postData);
			if(is_numeric($rs) || $rs > 0){
				$_SESSION['company_meeting_success'] = $rs;
				$this->_redirect('company_reservation_success');
			}
		}
	}
	
	/**
	 * 预约会议成功
	 */
	public function company_reservation_success(){
		$meet_id = $_SESSION['company_meeting_success'];
		unset($_SESSION['company_meeting_success']);
		if(empty($meet_id)){
			$this->_redirect('company_meeting');
		}
		$meeting = MeetingManage::getInstance()->getMeetingInfo($meet_id);
		$this->displayHtml($meeting);
	}
	
	public function public_reservation(){
		
	}
	
	protected function _has_permissions_do() {
		return $this->_user->isCmpUser();
	}
}

?>