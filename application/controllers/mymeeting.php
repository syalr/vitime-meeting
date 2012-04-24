<?php
require_once SERVICE_DIR.'company/CmpUserManage.php';
require_once SERVICE_DIR.'company/CmpAdminManage.php';
require_once SERVICE_DIR.'meeting/MeetingManage.php';

class Mymeeting extends CU_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->_needValidLogin(true);
	}
	
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
			}else{
				$postData['errMsg'] = $rs;
				$this->displayHtml($postData,'company_reservation');
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
	
	/**
	 * 预约公共会议
	 */
	public function public_reservation(){
		$this->displayHtml(array('_action'=>'public_meeting'));
	}
	
	public function do_public_reservation(){
		$postData = $this->input->post(NULL,TRUE);
		if(empty($postData)){
			$this->_redirect('public_reservation');
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
			$this->displayHtml($postData,'public_reservation');
		}else{
			$rs = MeetingManage::getInstance()->bookPublicMeeting($postData);
			if(is_numeric($rs) || $rs > 0){
				$_SESSION['public_meeting_success'] = $rs;
				$this->_redirect('public_reservation_success');
			}else{
				$postData['errMsg'] = $rs;
				$this->displayHtml($postData,'public_reservation');
			}
		}
	}
	/**
	 * 预约会议成功
	 */
	public function public_reservation_success(){
		$meet_id = $_SESSION['public_meeting_success'];
		unset($_SESSION['public_meeting_success']);
		if(empty($meet_id)){
			$this->_redirect('public_meeting');
		}
		$meeting = MeetingManage::getInstance()->getMeetingInfo($meet_id);
		$this->displayHtml($meeting);
	}
	
	/**
	 * 编辑企业会议
	 */
	public function edit_company_reservation($meet_id = null){
		if(empty($meet_id)){
			$this->_redirect('company_meeting');
		}
		$meeting = MeetingManage::getInstance()->getMeetingInfo($meet_id);
		$meeting['all_user_list'] = CmpAdminManage::getInstance()->listAllUser('name,username,id',0);
		if($meeting['state'] != 1){
			$this->displayHtml(array('errMsg'=>'该会议已经锁定，无法编辑','back_url'=>"{$this->_controller}/company_meeting"),'edit_failure');
		}else{
			$this->displayHtml($meeting);
		}
		
	}
	
	public function do_edit_company_reservation(){
		$postData = $this->input->post(NULL,TRUE);
		if(empty($postData)){
			$this->_redirect('company_meeting');
		}
		
		$errMsg = '';
		if(empty($postData['meet_id'])){
			$errMsg .='参数错误&nbsp;&nbsp;';
		}
		if(empty($postData['title'])){
			$errMsg .='会议主题必须填写&nbsp;&nbsp;';
		}
		
		if(empty($postData['start_time'])){
			$errMsg .="会议开始时间必须填写";
		}
		
		if(!empty($errMsg)){
			$postData['errMsg'] = $errMsg;
			$this->displayHtml($postData,'edit_company_reservation');
		}else{
			$rs = MeetingManage::getInstance()->changeMeeting($postData);
			if(is_numeric($rs) || $rs > 0){
				$_SESSION['company_meeting_success'] = $rs;
				$this->_redirect('company_reservation_success');
			}
		}
	}
	
	/**
	 * 编辑
	 */
	public function edit_public_reservation($meet_id = null){
		if(empty($meet_id)){
			$this->_redirect('public_meeting');
		}
		$meeting = MeetingManage::getInstance()->getMeetingInfo($meet_id);
		if($meeting['state'] != 1){
			$this->displayHtml(array('errMsg'=>'该会议已经锁定，无法编辑','back_url'=>"{$this->_controller}/public_meeting"),'edit_failure');
		}else{
			$this->displayHtml($meeting);
		}
		
	}
	
	public function do_edit_public_reservation(){
		$postData = $this->input->post(NULL,TRUE);
		if(empty($postData)){
			$this->_redirect('public_reservation');
		}
		
		$errMsg = '';
		if(empty($postData['meet_id'])){
			$errMsg .='参数错误&nbsp;&nbsp;';
		}
		if(empty($postData['title'])){
			$errMsg .='会议主题必须填写&nbsp;&nbsp;';
		}
		
		if(empty($postData['start_time'])){
			$errMsg .="会议开始时间必须填写";
		}
		
		if(!empty($errMsg)){
			$postData['errMsg'] = $errMsg;
			$this->displayHtml($postData,'edit_public_reservation');
		}else{
			$rs = MeetingManage::getInstance()->changePublicMeeting($postData);
			if(is_numeric($rs) || $rs > 0){
				$_SESSION['public_meeting_success'] = $rs;
				$this->_redirect('public_reservation_success');
			}
		}
	}
	
	public function delete_meeting(){
		if(!$this->input->is_post() && !$this->input->is_ajax_request()){
			$this->_redirect('company_meeting');
		}
		$meet_id = $this->input->post('meet_id',true);
		$meet_id = trim(strip_tags($meet_id));
		if(!is_numeric($meet_id)){
			exit(json_encode(array('status'=>0,'msg'=>'参数错误')));
		}
		
		$rs = MeetingManage::getInstance()->cancelMeeting($meet_id);
		if($rs == 1){
			exit(json_encode(array('status'=>1,'msg'=>'会议已经成功取消')));
		}else{
			exit(json_encode(array('status'=>0,'msg'=>'会议取消失败')));
		}
	}
	

	public function change_password(){
		$this->displayHtml();
	}
	
	public function do_change_password(){
		if(!$this->input->is_post() || empty($_POST)){
			$this->_redirect('change_password');
		}
		$postData = $this->input->post(NULL,TRUE);
		if(empty($postData['password']) || empty($postData['newpassword'])){
			$postData['errMsg'] = "密码不能为空，必须填写";
			$this->displayHtml($postData,'change_password');
		}
		$rs = CmpUserManage::getInstance()->changePassword($postData['password'], $postData['newpassword']);
		if($rs === true){
			$_SESSION['change_password_success'] = $rs;
			$this->_redirect('change_password_success');
		}else{
			$postData['errMsg'] = $rs;
			$this->displayHtml($postData,'change_password');
		}
	}
	
	public function change_password_success(){
		if(empty($_SESSION['change_password_success'])){
			$this->_redirect('change_password');
		}else{
			unset($_SESSION['change_password_success']);
			$this->displayHtml();
		}
	}
	
	protected function _has_permissions_do() {
		return $this->_user->isCmpUser();
	}
}

?>