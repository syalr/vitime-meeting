<?php

require_once (SERVICE_DIR.'company/ICompanyManage.php');
require_once SERVICE_DIR.'users/CmpAdmin.php';
require_once SERVICE_DIR.'users/CmpUser.php';

class CmpAdminManage implements ICompanyManage {
	
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
	}
	
	public static function getInstance(CmpAdmin $user = NULL){
		if(self::$_instance instanceof CmpAdminManage){
			return self::$_instance;
		}else{
			return self::$_instance = new CmpAdminManage($user);
		}
	}
	
	public function getUser(){
		return $this->cmp_admin_user;
	}
	
	/**
	 * 登录
	 * @param array $postData
	 */
	public function login($postData){
		$username = $postData['username'];
		$password = $postData['password'];
		$verifyCode = $postData['verifycode'];
	}
	
	/**
	 * 注册
	 * @param array $postData
	 */
	public function register($postData){
		
	}
	
	/**
	 * 登出
	 */
	public function logout(){
		
	}
	
	/**
	 * 新增企业普通员工
	 * @param CmpUser $user
	 */
	public function addCmpUser(CmpUser $user){}
	
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
	public function listCmpUser($page = 1,$limit = 10){}
	
	
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