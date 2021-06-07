<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class time extends CI_Controller{
	public function __construct() {
		parent::__construct();
		//echo $this->session->userdata("restraint_id");exit;
		if($this->session->userdata("restraint_id") == ''){
			redirect(sitedata("site_partner")."/Login"); 
		}
	}
	
	public function index(){
		$restid = $this->session->userdata("restraint_id");
	//	echo $restid;exit;
	
        $pmrs["whereCondition"]  =   "resturant_id LIKE  '".$restid."'";
		$dta['resttime']=$this->resturant_model->viewResTime($pmrs); 

		$dta    =   array(
			"title"     =>  "time List",
			"content"  =>  'time',
			"urlvalue"		=>	partnerurl('viewtime/'),
			"resttime" =>$dta['resttime']		
		);
		
		$this->load->view('partner/inner_template',$dta);
	}
	public function regular_time(){
	
		$restid = $this->session->userdata("restraint_id");
		$pmrs["whereCondition"]  =   "resturant_id LIKE  '".$restid."'";
		$dta['resttime']=$this->resturant_model->viewResTime($pmrs); 
		//print_r($dta['resttime']);exit;
		$dta    =   array(
			"title"     =>  "Regular Timing",
			"content"  =>  'regular_time',
			"urlvalue"		=>	partnerurl('viewregulartime/'),
			"resttime" =>$dta['resttime']		
		
		);
		
			if($this->input->post("submit")){
		//print_r($_POST);exit;
				$restime = $this->resturant_model->update_Res_Time($restid);     
				if($restime){					
					$this->session->set_flashdata("suc","update Resturant Time succfully.");
					redirect(partnerurl('Regular-Time'));
				}else{
					$this->session->set_flashdata("err","update Resturant Time failed.");
				}
			}
		
		$this->load->view('partner/inner_template',$dta);

	}
	
	
}
?>