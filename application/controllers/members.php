<?php
require_once SERVICE_DIR.'company/CmpUserManage.php';
require_once SERVICE_DIR.'company/CmpAdminManage.php';
require_once SERVICE_DIR.'admin/AdminManage.php';
require_once SERVICE_DIR.'UserSession.php';
/**
 * 管理登录界面
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-21
 */
class Members extends CI_Controller{
	
	const COOKIE_USER_NAME_TAG = 'l_u_name';
	const COOKIE_COMPANY_TAG = 'l_u_company_mark';
	const ADMIN_LOGIN_TEMPLATE = 'admin_login.php';
	const USER_LOGIN_TEMPLATE = 'login.php';
	const USER_REG_TEMPLATE = 'register.php';
	const CONTROLLER_NAME = '/members' ;
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		
		//如果已经登录则跳转到对应首页，如果没有登录则显示登录框
		if(UserSession::isLogin() && $this->router->fetch_method() != 'logout'){
			$user = UserSession::getUser();
			if($user->isSysAdmin()){
				redirect('/admin', 'location');
			}else if($user->isCmpAdmin()){
				redirect('/company', 'location');
			}else{
				redirect('/mymeeting', 'location');
			}
		}
	}
	
	/**
	 * 普通用户登录界面
	 */	
	public function index(){
		//读取cookie中的用户名
		$cookie_username = $_COOKIE[self::COOKIE_USER_NAME_TAG];
		$cookie_username = $this->encrypt->decode($cookie_username);
		
		$company_mark = $_COOKIE[self::COOKIE_COMPANY_TAG];
		$company_mark = $this->encrypt->decode($company_mark);
		$this->displayLoginHtml(array('username'=>$cookie_username,'company_mark'=>$company_mark),self::USER_LOGIN_TEMPLATE);
	}
	
	/**
	 * 普通用户登录处理
	 */
	public function do_login(){
		if(empty($_POST)){
			redirect(self::CONTROLLER_NAME,'location');
		}
		
		//获取提交参数
		$username = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		$companyMark = $this->input->post('company_mark',true);
		
		//判断参数完整性
		if(empty($username) || empty($password) || empty($companyMark)){
			$errMsg= "请填写完整再提交";
			$this->displayLoginHtml(array('errMsg'=>$errMsg),self::USER_LOGIN_TEMPLATE);
		}else{
			
			$cmpUserManage = CmpUserManage::getInstance();
			$postData = $this->input->post(NULL,TRUE);
			$loginMsg = $cmpUserManage->login($postData);
			if($loginMsg === true){
				//保存用户名到cookies中
				if($this->input->post('keepme') == '1'){
					$cookie_username = $this->encrypt->encode($postData['username']);
					$this->input->set_cookie(self::COOKIE_USER_NAME_TAG,$cookie_username,86400*365);
				}
				redirect('/mymeeting', 'location');
			}else{
				$this->displayLoginHtml(array('errMsg'=>"登录失败，{$loginMsg}"),self::USER_LOGIN_TEMPLATE);
			}
		}
	}

	/**
	 * 管理员登录界面
	 *
	 */
	public function admin_login(){
		//读取cookie中的用户名
		$cookie_username = $_COOKIE[self::COOKIE_USER_NAME_TAG];
		$cookie_username = $this->encrypt->decode($cookie_username);
		
		$company_mark = $_COOKIE[self::COOKIE_COMPANY_TAG];
		$company_mark = $this->encrypt->decode($company_mark);
		$this->displayLoginHtml(array('username'=>$cookie_username,'company_mark'=>$company_mark),self::USER_LOGIN_TEMPLATE);
	}
	
	/**
	 * 
	 * 登录处理
	 */
	public function do_admin_login(){
		if(empty($_POST)){
			redirect(self::CONTROLLER_NAME.'/admin_login','location');
		}
		
		//获取提交参数
		$username = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		$companyMark = $this->input->post('company_mark',true);
		$userType = $this->input->post('user_type',true);
		
		//判断参数完整性
		if(empty($username) || empty($password) || (empty($companyMark) && $userType=='company') || empty($userType)){
			$errMsg= "请填写完整再提交";
			$this->displayLoginHtml(array('errMsg'=>$errMsg));
		}else{
			//执行登录操作
			if($userType == 'company'){
				$this->cmpAdminLogin();
			}else{
				$this->adminLogin();
			}
		}
	}
	
	/**
	 * 企业管理员注册
	 */
	public function register(){
		$this->displayLoginHtml(array(),self::USER_REG_TEMPLATE,false);
	}
	
	public function do_register(){
		if(empty($_POST)){
			redirect(self::CONTROLLER_NAME.'/register','location');
		}
		
		$postData = $this->input->post(NULL,TRUE);
		$errMsg = '';
		
		//去掉html标签
		foreach($postData as $k=>&$v){
			$v = trim(strip_tags($v));
		}
		
		if(empty($postData['verifycode']) || (strtolower($postData['verifycode']) != $_SESSION['verify_code'])){
			return $this->displayLoginHtml(array('errMsg'=>'验证码不正确'),self::USER_REG_TEMPLATE,false);
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
			return $this->displayLoginHtml(array('errMsg'=>$errMsg),self::USER_REG_TEMPLATE,false);
		}
		
		$cmpAdminManager = CmpAdminManage::getInstance();
		$loginMsg = $cmpAdminManager->register($postData);
		if($loginMsg === TRUE){
			$_SESSION['register_success_id'] = $postData['username'];
			redirect(self::CONTROLLER_NAME.'/register_success', 'location');
		}else{
			return $this->displayLoginHtml(array('errMsg'=>"注册失败，$loginMsg"),self::USER_REG_TEMPLATE,false);
		}
	}
	
	/**
	 * 登录成功页面
	 */
	public function register_success(){
		$register_id = $_SESSION['register_success_id'];
		if(empty($register_id)){
			redirect('/','location');
		}
		unset($_SESSION['register_success_id']);
		$this->load->view('/header.php');
		$this->load->view(self::CONTROLLER_NAME.'/register_success.php',array('register_id'=>$register_id));
		$this->load->view('/footer.php');
	}
	
	public function logout(){
		unset($_SESSION);
		$user = UserSession::getUser();
		if(!empty($user)){
			if($user->isSysAdmin()){
				AdminManage::getInstance()->logout();
			}elseif ($user->isCmpAdmin()){
				CmpAdminManage::getInstance()->logout();
			}else{
				CmpUserManage::getInstance()->logout();
			}
		}
		session_destroy();
		redirect('/','location');
	}
	
	/**
	 * 系统管理员登录
	 */
	private function adminLogin(){
		$adminManager = AdminManage::getInstance();
		$postData = $this->input->post(NULL,true);
		$loginMsg = $adminManager->login($postData);
		if($loginMsg === true){
			//保存用户名到cookies中
			if($this->input->post('keepme') == '1'){
				$cookie_username = $this->encrypt->encode($postData['username']);
				$this->input->set_cookie(self::COOKIE_USER_NAME_TAG,$cookie_username,86400*365);
			}
			redirect('/admin', 'location');
		}else{
			$this->displayLoginHtml(array('errMsg'=>"登录失败，{$loginMsg}"));
		}
	}
	
	/**
	 * 企业管理员登录 
	 */
	private function cmpAdminLogin(){
		$cmpManage = CmpAdminManage::getInstance();
		$postData = $this->input->post(NULL,true);
		$loginMsg = $cmpManage->login($postData);
		if($loginMsg === true){
			//保存用户名到cookies中
			if($this->input->post('keepme') == '1'){
				$cookie_username = $this->encrypt->encode($postData['username']);
				$this->input->set_cookie(self::COOKIE_USER_NAME_TAG,$cookie_username,86400*365);
			}
			redirect('/company', 'location');
		}else{
			$this->displayLoginHtml(array('errMsg'=>"登录失败，{$loginMsg}"));
		}
	}
	
	/**
	 * 输出页面
	 * @param array $data
	 * @param string $template
	 */
	private function displayLoginHtml($data,$template = '',$renderTopAndBottom = true){
		$postData = $this->input->post(null,true);
		if(!is_array($postData)){
			$postData = array($postData);
		}
		$data = @array_merge($postData,$data);
		if(empty($template)){
			$template = self::ADMIN_LOGIN_TEMPLATE;
		}
		if($renderTopAndBottom){
			$this->load->view(self::CONTROLLER_NAME.'/login_header.php');
			$this->load->view(self::CONTROLLER_NAME.'/'.$template,$data);
			$this->load->view('/footer.php');
		}else{
			$this->load->view(self::CONTROLLER_NAME.'/'.$template,$data);
		}
	}
	
	private function wrapErrorMsg($msg){
		return "<span style='padding-left:19px;'>{$msg}</span><br />";
	}
}

?>