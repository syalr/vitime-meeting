<?php
/**
 * abstract CU_Controller
 * @package libraries 
 * @desc Controller类扩展
 * @version v1.0
 * @author Gray.Liu
 * @since 2010-9-3
 * @copyright gaoomei@foxmail.com 
 *
 */
abstract class CU_Controller extends CI_Controller{
	/**
	 * @var CU_Loader
	 */
	public $load;

	/**
	 * @var CI_Calendar
	 */
	public $calendar;
	
	/**
	 * @var Email
	 */
	public $email;
	
	/**
	 * @var CI_Encrypt
	 */
	public $encrypt;
	
	/**
	 * @var CI_Ftp
	 */
	public $ftp;
	
	/**
	 * @var CI_Hooks
	 */
	public $hooks;
	
	/**
	 * @var CI_Image_lib
	 */
	public $image_lib;
	
	/**
	 * @var CI_Language
	 */
	public $language;
	
	/**
	 * @var CI_Log
	 */
	public $log;
	
	/**
	 * @var CI_Output
	 */
	public $output;
	
	/**
	 * @var CI_Pagination
	 */
	public $pagination;
	
	/**
	 * @var CI_Parser
	 */
	public $parser;
	
	/**
	 * @var CI_Session
	 */
	public $session;
	
	/**
	 * @var CI_Sha1
	 */
	public $sha1;
	
	/**
	 * @var CI_Table
	 */
	public $table;
	
	/**
	 * @var CI_Trackback
	 */
	public $trackback;
	
	/**
	 * @var CI_Unit_test
	 */
	public $unit;
	
	/**
	 * @var CI_Upload
	 */
	public $upload;
	
	/**
	 * @var CI_URI
	 */
	public $uri;
	
	/**
	 * @var CI_User_agent
	 */
	public $agent;
	
	/**
	 * @var CI_Validation
	 */
	public $validation;
	
	/**
	 * @var CI_Xmlrpc
	 */
	public $xmlrpc;
	
	/**
	 * @var CI_Zip
	 */
	public $zip;
	
	/**
	 * @var CI_Benchmark
	 */
	public $benchmark;
	
	/**
	 * @var CI_Cart
	 */
	public $cart;
	
	/**
	 * @var CI_Config
	 */
	public $config;
	
	/**
	 * @var CU_Input
	 */
	public $input;
	
	/**
	 * @var CI_Router
	 */
	public $router;
	
	/**
	 * 控制器名称
	 * @var string
	 */
	public $_controller;
	
	/**
	 * 方法名
	 * @var string
	 */
	public $_action;
	
	/**
	 * 是否自动加载视图
	 * @var boolean
	 */
	private $_autoLoadView = true;
	
	/**
	 * 构造函数，不可覆盖
	 */
	final function __construct(){
		parent::Controller();
		$this->_controller = $this->router->fetch_class();
		$this->_action = $this->router->fetch_method();
	}
	
	/**
	 * 初始化方法，全局调用，在子类中代替构造函数用
	 */
	protected abstract  function init();
	
	/**
	 * 取消自动加载视图
	 * @param boolean $boolean
	 * @return void
	 */
	protected function setNoRender($boolean = TRUE){
		$this->_autoLoadView = !$boolean;
	}
	
	/**
	 * 重写方法，将方法名重写为Action模式，不可覆盖
	 * @param string $method 方法名
	 */
	final function _remap($method){
		$this->init();
		if(in_array('_remap_action',get_class_methods($this))){
			call_user_func_array(array($this,'_remap_action'),NULL);
			return;
		}
		
		$method = strtolower($method).'Action'; 
		if ( ! in_array($method, get_class_methods($this)))
		{
			show_404("{$this->router->fetch_class()}/{$method}");
		}
		call_user_func_array(array($this,$method),NULL);
		if($this->_autoLoadView === TRUE){
			$this->load->view();
		}
	}
	
}
?>