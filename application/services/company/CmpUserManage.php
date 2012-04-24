<?php

require_once SERVICE_DIR.'users/CmpUser.php';

class CmpUserManage {
	
	/**
	 * @var CI_Controller
	 */
	public $CI;
	
	/**
	 * @var CmpUser
	 */
	protected $cmp_user;
	
	/**
	 * 实例
	 * @var CmpUserManage
	 */
	private static $_instance;
	
	public function __construct(CmpUser $user = NULL){
		$this->cmp_user = $user;
		$this->CI = &get_instance();
	}
	
	public static function getInstance(CmpUser $user = NULL){
		if(self::$_instance instanceof CmpUserManage){
			return self::$_instance;
		}else{
			return self::$_instance = new CmpUserManage($user);
		}
	}
	
	public function getUser(){
		if(empty($this->cmp_user)){
			return $this->cmp_user = UserSession::getUser();
		}else{
			return $this->cmp_user;
		}
	}
	
	/**
	 * 登录
	 * @param array $postData
	 */
	public function login($postData){
		$username = $postData['username'];
		$password = $postData['password'];
		$companyMark = $postData['company_mark'];
		
		//加载数据库访问模型
		$this->CI->load->model('company/Company_model','CompanyModel');
		$company = $this->CI->CompanyModel->getCompanyByMark($companyMark);
		if(empty($company)){
			return "【{$companyMark}】企业不存在";
		}
		
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		$user = $this->CI->CompanyUserModel->getUser($username,$company['id']);
		
		if(empty($user)){
			return "用户不存在";
		}
		
		if(make_password($username, $password) != $user['password']){
			return "用户名或密码不对";
		}
		$this->cmp_user = new CmpUser($user); 
		$this->cmp_user->company = $company;
		UserSession::setUser($this->cmp_user);
		return true;
	}
	
	public function changePassword($oldPwd,$newPwd){
		$user = $this->getUser();
		if(make_password($user->username, $oldPwd)!= $user->password){
			return "旧密码不正确";
		}
		
		$newPwd = make_password($user->username, $newPwd);
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		$where = array('id'=>$user->id);
		$rs = $this->CI->CompanyUserModel->update(array('password'=>$newPwd),$where);
		if($rs == 1){
			return true;
		}
		return "修改密码失败";
	}
	
	/**
	 * 登出
	 */
	public function logout(){
		$this->cmp_user = null;
		UserSession::setUser(null);
	}
}

?>