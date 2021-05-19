<?php
class reviews extends CI_Controller{
	public function __construct() {
		parent::__construct();
		//echo $this->session->userdata("restraint_id");exit;
		if($this->session->userdata("restraint_id") == ''){
			redirect(sitedata("site_partner")."/Login"); 
		}
	}
	
	public function index(){
	//	echo "hi";exit;
		$restid = $this->session->userdata("restraint_id");
	
		$dta    =   array(
			"title"     =>  "Reviews",
			"content"  =>  'reviews',
		
		
		);
		
		$this->load->view('partner/inner_template',$dta);
	}
	public function review_summary(){
	//echo "hi";exit;
			$restid = $this->session->userdata("restraint_id");
		
			$dta    =   array(
				"title"     =>  "Reviews summary",
				"content"  =>  'review_summary',
			
			
			);
			
			$this->load->view('partner/inner_template',$dta);
		}
		
	
}
?>