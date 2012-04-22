<?php
/**
 * 会议相关控制器
 */

class Meeting extends CU_Controller{
	
	public function index(){
		echo 'meeting';
	}
/* *
	 *
	 * @see CU_Controller::_has_permissions_do()
	 */
	protected function _has_permissions_do() {
		return true;
	}

}