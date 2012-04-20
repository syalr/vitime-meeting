<?php
/**
 * 企业用户操作接口
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-20
 */
interface ICompanyManage {
	
	public function listCmpMeeting();
	
	public function listPubMeeting();
	
	public function bookMeeting();
	
	public function cancelMeeting();
	
	public function changeMeeting();
	
	public function viewMeeting();
	
	
}

?>