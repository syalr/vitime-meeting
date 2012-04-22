<?php
require_once SERVICE_DIR.'meeting/IMeetingManage.php';
require_once SERVICE_DIR.'UserSession.php';
/**
 * 会议相关类
 *  
 * @author gray.liu
 * @email gaoomei@gmail.com
 * @date 2012-4-22
 */
class MeetingManage implements IMeetingManage{

	/**
	 * @var CI_Controller
	 */
	public $CI;
	
	/**
	 * 实例
	 * @var MeetingManage
	 */
	private static $_instance;
	
	/**
	 * @var IUser
	 */
	private $_user;
	
	public function __construct(){
		$this->CI = &get_instance();
	}
	
	public static function getInstance(){
		if(self::$_instance instanceof MeetingManage){
			return self::$_instance;
		}else{
			return self::$_instance = new MeetingManage();
		}
	}
	
	public function getUser(){
		if(empty($this->_user)){
			return $this->_user = UserSession::getUser();
		}else{
			return $this->_user;
		}
	}
	
	/**
	 * 读取企业会议列表*
	 *
	 * @param int $page
	 * @param int $limit 
	 * @see ICompanyManage::listCmpMeeting()
	 */
	public function listCmpMeeting($page = 1,$limit = 10) {
		$company_id = $this->getUser()->company_id;
		$this->CI->load->model('meeting/Meeting_model','MeetingModel');
		return $this->CI->MeetingModel->getCompanyMeetingList($this->getUser()->id,$company_id,$page,$limit);
	}
	
	/**
	 * 读取会议参与人员
	 * @param unknown_type $meeting_id
	 */
	public function listCmpMeetingUser($meeting_id){
		$this->CI->load->model('meeting/Meetinguserlog_model','MeetingUserModel');
		return $this->CI->MeetingUserModel->getMeetingUserList($meeting_id);
		
	}

	/**
	 * 读取公共会议列表*
	 *
	 * @param int $page
	 * @param int $limit 
	 * @see ICompanyManage::listCmpMeeting()
	 */
	public function listPubMeeting($page = 1,$limit = 10) {
		$company_id = $this->getUser()->company_id;
		$this->CI->load->model('meeting/Meeting_model','MeetingModel');
		return $this->CI->MeetingModel->getCompanyMeetingList($this->getUser()->id,$company_id,$page,$limit);
	}

	/** 
	 * 发布企业会议
	 * @param array $postData
	 * @return 
	 */
	public function bookMeeting($postData) {
		$user_list = explode(',', $postData['user_list']);
		$start_time = strtotime($start_time);
		
		$meeting = new Meeting();	
		$meeting->title = $postData['title'];
		$meeting->user_id = $this->getUser()->id;
		$meeting->company_id = $this->getUser()->company_id;
		$start_time = $postData['start_time'].' '.$postData['hour'].':'.$postData['minutes'];
		
		$meeting->start_time = date('Y-m-d H:i:s',$start_time);
		$meeting->end_time = date('Y-m-d H:i:s',$start_time + (intval(minutes_length)*60 ));
		$meeting->type = 1;
		$meeting->state = 1;
		
		$meeting->usercount = count($user_list);
		
		$this->CI->load->model('meeting/Meeting_model','MeetingModel');
		//开启事务
		$this->CI->db->trans_begin();
		$meet_id = $this->CI->MeetingModel->newMeeting($meeting->toArray());
		if(empty($meet_id) || !is_numeric($meet_id)){
			$this->CI->db->trans_rollback();
			return "预约会议失败";
		}
		$this->CI->load->model('meeting/Meetinguserlog_model','MeetingUserModel');
		foreach($user_list as $userid){
			$data = array('meet_id'=>$meet_id,'user_id'=>$userid);
			$rs = $this->CI->MeetingUserModel->insert($data);
			if(empty($rs) || !is_numeric($rs)){
				$this->CI->db->trans_rollback();
				return "预约会议失败";
			}
		}
		$this->CI->db->trans_commit();
		return $meet_id;
	}

	/**
	 * 读取会议信息
	 * @param unknown_type $meeting_id
	 */
	public function getMeetingInfo($meeting_id){
		$this->CI->load->model('meeting/Meeting_model','MeetingModel');
		$meeting = $this->CI->MeetingModel->get($meeting_id);
		if(!empty($meeting)){
			$meeting['user_list'] = $this->listCmpMeetingUser($meeting_id);
		}
		return $meeting;
	}
/* *
	 *
	 * @see IMeetingManage::cancelMeeting()
	 */
	public function cancelMeeting($meeting_id) {
		// TODO Auto-generated method stub
		
	}

/* *
	 *
	 * @see IMeetingManage::changeMeeting()
	 */
	public function changeMeeting($meeting_id) {
		// TODO Auto-generated method stub
		
	}

/* *
	 *
	 * @see IMeetingManage::viewMeeting()
	 */
	public function viewMeeting($meeting_id) {
		// TODO Auto-generated method stub
		
	}

	
	
}

?>