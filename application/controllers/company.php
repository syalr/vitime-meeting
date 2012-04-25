<?php
require_once(SERVICE_DIR.'company/CmpAdminManage.php');
require_once(SERVICE_DIR.'company/CmpUserManage.php');
require_once SERVICE_DIR.'meeting/MeetingManage.php';

/**
 * 企业管理后台
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-21
 */
class Company extends CU_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->_needValidLogin(true);
	}
	
	/**
	 * 企业后台首页，默认显示用户列表
	 */
	public function index(){
		$this->_remap('company_meeting');
	}
	
	public function listuser(){
		$page = $this->input->get('page',true);
		$service = CmpAdminManage::getInstance();
		$userlist = $service->listCmpUser($page);
		$userlist['page'] = intval($page);
		$this->displayHtml($userlist);
	}
	
	/**
	 * 添加用户 
	 */
	public function adduser(){
		$this->displayHtml();
	}
	
	public function do_adduser(){
		if(empty($_POST)){
			$this->_redirect('adduser');
		}
		
		$postData = $this->input->post(NULL,TRUE);
		//去掉html标签
		foreach($postData as $k=>&$v){
			$v = trim(strip_tags($v));
		}
		
		if(empty($postData['username']) || empty($postData['password']) || empty($postData['mobile']) || empty($postData['email'])){
			return $this->displayHtml(array('errMsg'=>'请填写完整再提交'),'adduser');
		}
		$service = CmpAdminManage::getInstance();
		$loginMsg = $service->addCmpUser($postData);
		if($loginMsg === true){
			$_SESSION['adduser_success_data'] = $postData;
			$this->_redirect('adduser_success');
		}else{
			return $this->displayHtml(array('errMsg'=>'添加用户失败，'.$loginMsg),'adduser');
		}
	}
	
	public function adduser_success(){
		if(!empty($_SESSION['adduser_success_data'])){
			$userinfo = $_SESSION['adduser_success_data'];
			unset($_SESSION['adduser_success_data']);
			$this->displayHtml($userinfo);
		}else{
			$this->_redirect('adduser');
		}
		
	}
	
	public function do_delete_user(){
		if(!$this->input->is_post() && !$this->input->is_ajax_request()){
			$this->_redirect('listuser');
		}
		
		$user_id = $this->input->post('user_id',true);
		if(empty($user_id) || !is_numeric($user_id)){
			$errMsg = array('status'=>0,'msg'=>'参数错误');
			exit(json_encode($errMsg));
		}
		
		$rs = CmpAdminManage::getInstance()->deleteCmpUser($user_id);
		if($rs === true){
			$errMsg = array('status'=>1,'msg'=>'删除成功');
			exit(json_encode($errMsg));
		}else{
			$errMsg = array('status'=>0,'msg'=>'删除失败，'.$rs);
			exit(json_encode($errMsg));
		}
		
	}	
	
	/**
	 * 更新用户
	 * @param int $user_id
	 */
	public function update_user($user_id = null){
		if(!$this->input->is_post()){
			if(empty($user_id)){
				$this->_redirect('listuser');
			}else{
				$companyUser = CmpAdminManage::getInstance()->getUserInfo($user_id);
				return $this->displayHtml($companyUser);
			}
			return;
		}
		
		if(empty($_POST)){
			$this->_redirect('listuser');
		}
		
		$postData = $this->input->post(NULL,TRUE);
		$errMsg = '';
		
		//去掉html标签
		foreach($postData as $k=>&$v){
			$v = trim(strip_tags($v));
		}
		
		$errMsg = '';
		if(empty($postData['username'])){
			$errMsg .= $this->wrapErrorMsg("用户名必须填写");
		}
		
		if(empty($postData['mobile'])){
			$errMsg .= $this->wrapErrorMsg("手机号码必须填写");
		}
		
		if(empty($postData['email'])){
			$errMsg .= $this->wrapErrorMsg("邮箱必须填写");
		}
		
		if(!empty($errMsg)){
			$errMsg = "填写不完整：<br />{$errMsg}";
			return $this->displayHtml(array('errMsg'=>$errMsg));
		}
		
		$loginMsg = CmpAdminManage::getInstance()->updateCmpUser($postData);
		if($loginMsg === TRUE){
			$this->_redirect('update_user_success');
		}else{
			$companyUser = CmpAdminManage::getInstance()->getUserInfo($postData['user_id']);
			return $this->displayHtml(array_merge($companyUser,array('errMsg'=>"修改失败，$loginMsg")));
		}
		
	}
	
	public function update_user_success(){
		$this->displayHtml();
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
		$rs = CmpAdminManage::getInstance()->changePassword($postData['password'], $postData['newpassword']);
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
	
/**
	 * 进入会议
	 * @param unknown_type $meet_id
	 */
	public function enter_meeting($meet_id){
		if(empty($meet_id)){
			$this->back();
		}
		$meeting = MeetingManage::getInstance()->getMeetingInfo($meet_id);
		if(empty($meeting['password'])){
			$this->_redirect('meeting');
		}
		$meeting['_action'] = 'public_meeting';
		$this->displayHtml($meeting);
	}
	
	public function do_enter_meeting(){
		if(empty($_POST)){
			$this->back();
		}
		$meeting_id = $this->input->post('meet_id',true);
		$password = $this->input->post('password',TRUE);
		$meeting = MeetingManage::getInstance()->getMeetingInfo($meeting_id);
		if(empty($password)){
			$meeting['errMsg'] = '密码不能为空';
			$this->displayHtml($meeting,'enter_meeting');
		}else{
			if($password !=  $meeting['password']){
				$meeting['errMsg'] = '密码错误，请重新输入';
				$this->displayHtml($meeting,'enter_meeting');
			}else{
				$this->_redirect('meeting');
			}
		}
		
	}
	
	public function meeting(){
		exit('meeting');
	}
	
	private function back(){
		exit('<script>window.history.back()</script>');
	}
	
	/* 是否有权限
	 */
	protected function _has_permissions_do() {
		return !empty($this->_user) && $this->_user->isCmpAdmin();
	}

}