<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class discount extends CI_Controller{
	public function __construct() {
		parent::__construct();
		//echo $this->session->userdata("restraint_id");exit;
		if($this->session->userdata("restraint_id") == ''){
			redirect(sitedata("site_partner")."/Login"); 
		}
	}
	public function create(){
	
		$dta    =   array(
			"title"     =>  "Create Discount Form",
			"content"  =>  'create_discount',
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
		
		}
		$this->load->view('partner/inner_template',$dta);
	}
	public function index(){
		//echo "hi";exit;
		$restid = $this->session->userdata("restraint_id");
	
		$dta    =   array(
			"title"     =>  "Discount List",
			"content"  =>  'discount',
			"urlvalue"		=>	partnerurl('viewDiscount/'),
		
		);
		
		$this->load->view('partner/inner_template',$dta);
	}
	
}
?>