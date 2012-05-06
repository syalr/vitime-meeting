<?php

class Welcome extends CI_Controller{
	
	public function index(){
//		$this->load->helper('url');
		redirect('/index.html','location','301');
	}
/* *
	 *
	 * @see CU_Controller::_has_permissions_do()
	 */
	protected function _has_permissions_do() {
		// TODO Auto-generated method stub
		
	}

}