<?php
class Home extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Dashboard",
			"content"  =>  'home'
		);
		$this->load->view('admin/inner_template',$dta);
	}

	
}
?>