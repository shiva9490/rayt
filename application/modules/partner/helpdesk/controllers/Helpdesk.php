<?php
class Helpdesk extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("restraint_id") == '' && $this->session->userdata("manage-helpdesk") =="1"){
			redirect(sitedata("site_partner")."/Login"); 
		}
	}
	
	public function index(){
	
		$restid = $this->session->userdata("restraint_id");
		$pmrs["whereCondition"]  =   "resturant_id LIKE  '".$restid."'";
		$resturant = $this->resturant_model->getResturant($pmrs);
		$dta    =   array(
			"title"     =>  "Helpdesk",
			"content"  =>  'helpdesk',	
			"view" =>	$resturant,		
		);
		if($this->input->post("submit")){
			//echo "<pre>"; print_r($_POST);exit;
    			$this->form_validation->set_rules("resturant_branch_name","resturant branch name ","required");
				$this->form_validation->set_rules("resturant_email","resturant email","required");
				$this->form_validation->set_rules("resturant_enquire_type","resturant enquire type","required");
				$this->form_validation->set_rules("resturant_enquire_for","resturant enquire for","required");
				$this->form_validation->set_rules("resturant_enquire_details","resturant enquire details","required");
    			if($this->form_validation->run() == TRUE){
    				$bt     =   $this->rest_helpdesk_model->create_helpdesk();
    				if($bt > 0){
    					$this->session->set_flashdata("suc","Enquiry send Successfully.");
    					redirect(sitedata("site_partner")."/Helpdesk");
    				}else{
    					$this->session->set_flashdata("err","Enquiry Not Send.Please try again.");
    					redirect(sitedata("site_partner")."/Helpdesk");
    				}
    			}    	
			}
		$this->load->view('partner/inner_template',$dta);
	}
	 public function helpdesk_category(){
	 	echo "hi";exit;

	// 	$par['whereCondition'] ="helpquecat_id LIkE '".$this->input->post('helpdeskcat')."'";
	// 	print_r($par);exit;
	// 	$sub = $this->common_model->viewHelpSubCategory($par);
    //     $option='<option value="">Select Veg</option>';
	//     foreach($sub as $key=>$sub){
    //         $option.="<option value=".$sub->helpquesubcat_id.">".$sub->helpdesk_ques_subcat."</option>";
    //     }
    //     print_r($option);

	}
	
}