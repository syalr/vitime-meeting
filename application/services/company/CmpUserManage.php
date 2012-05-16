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
	
	/**
	 * 
	 * @param CmpUser $user
	 * @return CmpUserManage
	 */
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
		
		if(empty($user['status']) ||$user['status'] < 1){
			return "您的帐号已经被删除或锁定，不允许登录";
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
	
	/**
	 * 更新企业管理员
	 * @param array $postData
	 */
	public function updateSelfInfo($postData){
		$user_id = $this->getUser()->id;
		$name = $postData['name'];
		$company_id = $this->getUser()->company_id;
		$mobile = $postData['mobile'];
		$email = $postData['email'];
		
		//加载数据库访问模型
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		
		//判断是否存在该用户
		$cmpUser = $this->CI->CompanyUserModel->getUserById($user_id,$company_id);
		if(empty($cmpUser)){
			return "参数错误";
		}
		
		//存储结果
		$rs = 1;
		
		$user = new CmpUser();
		$user->name = $name;
		$user->mobile = $mobile;
		$user->email = $email;
		
		 //检查是否有更改
		$userArr = $user->toArray();
		$isModify = false;
		foreach($userArr as $k=>$field){
			if($cmpUser[$k] != $field){
				$isModify = true;
				break;
			}
		}
		
		if($isModify){
			$where = array('id'=>$user_id,'company_id'=>$company_id);
			$rs = $this->CI->CompanyUserModel->update($user->toArray(),$where);
			if($rs == 1){
				return true;
			}else{
				return "更新员工资料失败";
			}
		}
		return $rs === 1;
	}
	
	public function reloadUserInfo(){
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		$user = $this->CI->CompanyUserModel->getUser($this->getUser()->username,$this->getUser()->company_id);
		$this->cmp_user = new CmpUser($user); 
		
		$this->CI->load->model('company/Company_model','CompanyModel');
		$company = $this->CI->CompanyModel->get($user['company_id']);
		$this->cmp_user->company = $company;
		UserSession::setUser($this->cmp_user);
	}
}

?>