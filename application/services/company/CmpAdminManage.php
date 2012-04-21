<?php

require_once (SERVICE_DIR.'company/ICompanyManage.php');
require_once SERVICE_DIR.'users/CmpAdmin.php';
require_once SERVICE_DIR.'users/CmpUser.php';

class CmpAdminManage implements ICompanyManage {
	
	/**
	 * @var CI_Controller
	 */
	public $CI;
	
	/**
	 * 
	 * @var CmpAdmin
	 */
	protected $cmp_admin_user;
	
	/**
	 * 实例
	 * @var CmpAdminManage
	 */
	private static $_instance;
	
	public function __construct(CmpAdmin $user = NULL){
		$this->cmp_admin_user = $user;
		$this->CI = &get_instance();
	}
	
	public static function getInstance(CmpAdmin $user = NULL){
		if(self::$_instance instanceof CmpAdminManage){
			return self::$_instance;
		}else{
			return self::$_instance = new CmpAdminManage($user);
		}
	}
	
	public function getUser(){
		if(empty($this->cmp_admin_user)){
			return $this->cmp_admin_user = UserSession::getUser();
		}else{
			return $this->cmp_admin_user;
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
		$this->cmp_admin_user = new CmpAdmin($user); 
		$this->cmp_admin_user->company = $company;
		UserSession::setUser($this->cmp_admin_user);
		return true;
	}
	
	/**
	 * 注册
	 * @param array $postData
	 */
	public function register($postData){
		$username = $postData['username'];
		$password = $postData['password'];
		$mobile = $postData['mobile'];
		$email = $postData['email'];
		$companyName = $postData['company_name'];
		$companyMark = $postData['company_mark'];
		
		//加载数据库访问模型
		$this->CI->load->model('company/Company_model','CompanyModel');
		$company = $this->CI->CompanyModel->getCompanyByMark($companyMark);
		if(!empty($company) && $company['id'] > 0){
			return "{$companyMark} 企业标识已经存在";
		}
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		$user = $this->CI->CompanyUserModel->getUserByName($username);
		if(!empty($user)){
			return "该用户名已经被注册";
		}
		
		//开启事务
		$this->CI->db->trans_begin();
		$companyId = $this->CI->CompanyModel->newCompany($companyName,$companyMark);
		if(empty($companyId) || $companyId <=0 ){
			$this->CI->db->trans_rollback();
			return "注册企业失败";
		}
		
		
		$admin = new CmpAdmin();
		$admin->username = $username;
		$admin->password = make_password($username, $password);
		$admin->company_id = $companyId;
		$admin->mobile = $mobile;
		$admin->email = $email;
		$admin->create_time = time();
		$admin->priority = 1;
				
		$user_id = $this->CI->CompanyUserModel->newUser($admin);
		if($user_id > 0){
			$this->CI->db->trans_commit();
			return true;
		}else{
			$this->CI->db->trans_rollback();
			return "注册失败";
		}
				
	}
	
	/**
	 * 登出
	 */
	public function logout(){
		$this->cmp_admin_user = null;
		UserSession::setUser(null);
	}
	
	/**
	 * 新增企业普通员工
	 * @param array $postData
	 * @return string | boolean
	 */
	public function addCmpUser($postData){
		$name = $postData['name'];
		$username = $postData['username'];
		$password = $postData['password'];
		$mobile = $postData['mobile'];
		$email = $postData['email'];
		
		//加载数据库访问模型
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		$user = $this->CI->CompanyUserModel->getUserByName($username);
		if(!empty($user)){
			$user = null;
			return "该用户名已经被注册";
		}
		
		$user = new CmpUser();
		$user->name = $name;
		$user->username = $username;
		$user->password = make_password($username, $password);
		$company_id = $this->getUser()->company_id;
		$user->company_id = $company_id;
		$user->mobile = $mobile;
		$user->email = $email;
		$user->create_time = time();
		$user->priority = 2;
		
		if(empty($company_id)){
			return "数据错误，注册失败";
		}
				
		$user_id = $this->CI->CompanyUserModel->newUser($user);
		if($user_id > 0){
			return true;
		}else{
			return "注册失败";
		}
	}
	
	/**
	 * 更新企业管理员
	 * @param CmpUser $user
	 */
	public function updateCmpUser(CmpUser $user){}
	
	/**
	 * 删除企业管理员
	 * @param CmpUser $user
	 */
	public function deleteCmpUser(CmpUser $user){}
	
	/**
	 * 企业管理员列表
	 * @param int $page
	 * @param int $limit
	 */
	public function listCmpUser($page = 1,$limit = 10){
		$cmpId = $this->getUser()->company_id;
		$this->CI->load->model('company/Company_user_model','CompanyUserModel');
		$userlist = $this->CI->CompanyUserModel->getUserListByCmpId($cmpId,$page,$limit);
		return $userlist;
	}
	
	
	/* (non-PHPdoc)
	 * @see ICompanyManage::listCmpMeeting()
	 */
	public function listCmpMeeting() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see ICompanyManage::listPubMeeting()
	 */
	public function listPubMeeting() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see ICompanyManage::bookMeeting()
	 */
	public function bookMeeting() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see ICompanyManage::cancelMeeting()
	 */
	public function cancelMeeting() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see ICompanyManage::changeMeeting()
	 */
	public function changeMeeting() {
		// TODO Auto-generated method stub
		
	}
	
	public function viewMeeting(){}
}

?>