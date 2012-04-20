<?php

require_once (SERVICE_DIR.'company/ICompanyManage.php');
require_once SERVICE_DIR.'users/CmpUser.php';

class CmpUserManage implements ICompanyManage {
	
	/**
	 * 
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
	}
	
	public static function getInstance(CmpUser $user = NULL){
		if(self::$_instance instanceof CmpUserManage){
			return self::$_instance;
		}else{
			return self::$_instance = new CmpUserManage($user);
		}
	}
	
	public function getUser(){
		return $this->cmp_user;
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