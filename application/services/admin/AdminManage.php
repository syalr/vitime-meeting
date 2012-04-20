<?php
require_once SERVICE_DIR.'users/SysAdmin.php';
/**
 * 系统管理类
 * 主要工作：
 * 1. 管理系统
 * 2. 管理企业用户
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-20
 */
class AdminManage {

	/**
	 * 系统管理员
	 * @var SysAdmin
	 */
	protected $admin_user;
	
	/**
	 * 实例
	 * @var AdminManage
	 */
	private static $_instance;
	
	public function __construct(SysAdmin $user = NULL){
		$this->admin_user = $user;
	}
	
	public static function getInstance(SysAdmin $user = NULL){
		if(self::$_instance instanceof AdminManage){
			return self::$_instance;
		}else{
			return self::$_instance = new AdminManage($user);
		}
	}
	
	public function getUser(){
		return $this->admin_user;
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
	 * 新增企业管理员
	 * @param CmpAdmin $user
	 */
	public function addCmpAdmin(CmpAdmin $user){}
	
	/**
	 * 更新企业管理员
	 * @param CmpAdmin $user
	 */
	public function updateCmpAdmin(CmpAdmin $user){}
	
	/**
	 * 删除企业管理员
	 * @param CmpAdmin $user
	 */
	public function deleteCmpAdmin(CmpAdmin $user){}
	
	/**
	 * 企业管理员列表
	 * @param int $page
	 * @param int $limit
	 */
	public function listCmpAdmin($page = 1,$limit = 10){}
	
}

?>