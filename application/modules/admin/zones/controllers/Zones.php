<?php
class Zones extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Zones",
			"content"  =>  'zones'
		);
		$this->load->view('admin/template',$dta);
	}

	
}
?>