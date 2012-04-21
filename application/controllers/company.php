<?php
require_once(SERVICE_DIR.'company/CmpAdminManage.php');
require_once(SERVICE_DIR.'company/CmpUserManage.php');

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
		$this->_remap('listuser');
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
	
	/* 是否有权限
	 */
	protected function _has_permissions_do() {
		return !empty($this->_user) && $this->_user->isCmpAdmin();
	}

}