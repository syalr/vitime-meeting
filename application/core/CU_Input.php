<?php
/**
 * abstract CU_Input
 * @package libraries 
 * @desc Input类扩展
 * @version v1.0
 * @author Gray.Liu
 * @since 2010-9-9
 * @copyright gaoomei@foxmail.com 
 *
 */

class CU_Input extends CI_Input{
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * 获取参数：首先检查$_GET中是否有该参数，再检查URI地址栏
	 * @param string $index 参数索引名称
	 * @return mixed
	 */
	function get($index = '', $xss_clean = FALSE){
		$value = parent::get($index,$xss_clean);
		if($value !== FALSE){
			return $value;
		}
		$uri = &load_class('URI');
		$uri_array = $uri->ruri_to_assoc(3);
		$value_2 = $this->_fetch_from_array($uri_array, $index, $xss_clean);
		return $value_2;
	}
}
?>