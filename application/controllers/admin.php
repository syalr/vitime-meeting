<?php
require_once SERVICE_DIR.'admin/AdminManage.php';
/**
 * 系统管理
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-21
 */
class Admin extends CU_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->_needValidLogin(true);
	}
	
	/**
	 * 首页 - 企业用户管理
	 */
	public function index(){
		$this->_remap('listcompany');
	}
	
	/**
	 * 列出企业用户
	 */
	public function listcompany(){
		$page = $this->input->get('page',TRUE);
		$service = AdminManage::getInstance();
		$companylist = $service->listCmpAdmin($page);
		$this->displayHtml($companylist);
	}
	
	public function update_company($cmp_admin_id = null,$cmp_id = null){
		if(!$this->input->is_post()){
			if(empty($cmp_admin_id)){
				$this->_redirect('listcompany');
			}else{
				$company_admin = AdminManage::getInstance()->getCompany($cmp_admin_id,$cmp_id);
				return $this->displayHtml($company_admin);
			}
			return;
		}
		
		if(empty($_POST)){
			redirect('/'.$this->_controller.'/listcompany','location');
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
		
		if(empty($postData['password'])){
			$errMsg .= $this->wrapErrorMsg("密码必须填写");
		}
		
		if(empty($postData['mobile'])){
			$errMsg .= $this->wrapErrorMsg("手机号码必须填写");
		}
		
		if(empty($postData['email'])){
			$errMsg .= $this->wrapErrorMsg("邮箱必须填写");
		}
		
		if(empty($postData['company_name'])){
			$errMsg .= $this->wrapErrorMsg("公司名称必须填写");
		}
		
		if(empty($postData['company_mark'])){
			$errMsg .= $this->wrapErrorMsg("企业标识必须填写");
		}
		
		if(!empty($errMsg)){
			$errMsg = "填写不完整：<br />{$errMsg}";
			return $this->displayHtml(array('errMsg'=>$errMsg));
		}
		
		$loginMsg = AdminManage::getInstance()->updateCmpAdmin($postData);
		if($loginMsg === TRUE){
			redirect("/{$this->_controller}/update_company_success/", 'location');
		}else{
			return $this->displayHtml(array('errMsg'=>"修改失败，$loginMsg"));
		}
		
	}
	
	
	/** 
	 * 是否有权限
	 */
	protected function _has_permissions_do() {
		return !empty($this->_user) && $this->_user->isSysAdmin();
	}
	
	private function wrapErrorMsg($msg){
		return "<span style='padding-left:19px;'>{$msg}</span><br />";
	}
}