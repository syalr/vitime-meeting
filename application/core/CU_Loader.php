<?php
class CU_Loader extends CI_Loader{
	
	/**
	 * 视图文件夹
	 * @var string
	 */
	protected $_cu_view_folder='';
	
	/**
	 * 设置视图文件夹
	 * @param string $path 以‘/’结尾
	 * @return void
	 */
	function setViewFolder($path){
		if($path[strlen($path)-1]!=='/' && $path !=='' ){
			$path .='/'; 
		}
		$this->_cu_view_folder = trim($path);
	}
	
	/**
	 * 读取视图文件夹
	 * @return string
	 */
	function getViewFolder(){
		return $this->_cu_view_folder;
	} 
	
	/**
	 * 还原视图文件夹
	 * @return void
	 */
	function resetViewFolder(){
		$this->_cu_view_folder = '';
	}
	
	/**
	 * 加载视图
	 * @param string $view 视图文件
	 * @param array $vars 解析变量
	 * @param boolean $return 是否返回
	 */
	function view($view = '', $vars = array(), $return = FALSE){
		if($view == ''){
			$ci = &get_instance();
			$view = $this->_cu_view_folder.$ci->router->fetch_class().'/'.$ci->router->fetch_method();
		}else{
			$view = $this->_cu_view_folder.$view;
		}
		return parent::view($view,$vars,$return);
	}
	
	/**
	 * Model Loader
	 *
	 * This function lets users load and instantiate models.
	 *
	 * @access	public
	 * @param	string	the name of the class
	 * @param	string	name for the model
	 * @param	bool	database connection
	 * @return	void
	 */	
	function model($model, $name = '', $db_conn = FALSE)
	{		
		if (is_array($model))
		{
			foreach($model as $babe)
			{
				$this->model($babe);	
			}
			return;
		}

		if ($model == '')
		{
			return;
		}
	
		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (strpos($model, '/') === FALSE)
		{
			$path = '';
		}
		else
		{
			$x = explode('/', $model);
			$model = end($x);			
			unset($x[count($x)-1]);
			$path = implode('/', $x).'/';
		}
	
		if ($name == '')
		{
			$name = $model;
		}
		
		if (in_array($name, $this->_ci_models, TRUE))
		{
			return;
		}
		
		$CI =& get_instance();
		if (isset($CI->$name))
		{
			show_error('The model name you are loading is the name of a resource that is already being used: '.$name);
		}
	
		$model = strtolower($model);
		
		if ( ! file_exists(APPPATH.'models/'.$path.$model.EXT))
		{
			show_error('Unable to locate the model you have specified: '.$model);
		}
				
		if ($db_conn !== FALSE AND ! class_exists('CI_DB'))
		{
			if ($db_conn === TRUE)
				$db_conn = '';
		
			$CI->load->database($db_conn, FALSE, TRUE);
		}
	
		if ( ! class_exists('Model'))
		{
			load_class('Model','core');
		}

		require_once(APPPATH.'models/'.$path.$model.EXT);

		$model = ucfirst($model);
				
		$CI->$name = new $model();
		$CI->$name->_assign_libraries();
		$CI->$name->_afterConnect();
		$this->_ci_models[] = $name;	
	}
}