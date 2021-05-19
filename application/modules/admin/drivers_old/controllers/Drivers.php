<?php
class Drivers extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}

	public function create(){
	
		$dta    =   array(
			"title"     =>  "Create Drivers Form",
			"content"  =>  'create_driver',
		
		);
		if($this->input->post('publish')){
		//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('driver_name','Driver Name','required');
			$this->form_validation->set_rules('driver_name_a','driver Name in arabic','required');
			$this->form_validation->set_rules('driver_phone','Phone Number','required|numeric|min_length[8]');
			$this->form_validation->set_rules('driver_email','Email','required|is_unique[drivers.driver_email]');
			$this->form_validation->set_rules('driver_dob','driver DOB','required');
			$this->form_validation->set_rules('driver_vehicle_number','Vehicle Number','required');
			$this->form_validation->set_rules('driver_address','Driver Address Name','required');
			$this->form_validation->set_rules('driver_address_a','Driver Address in arabic','required');
			$this->form_validation->set_rules('driver_joining_date','Joining Date','required');	
			$this->form_validation->set_rules('driver_experience','Experience Number','required');
			// $this->form_validation->set_rules('driver_profile_image','Driver Profile Image','required');
			//$this->form_validation->set_rules('driver_files','Documents','required');
			$this->form_validation->set_rules('driver_countrycode','Country Code','required');
			$this->form_validation->set_message('is_unique', 'The %s is already taken');
			
			if ($this->form_validation->run() == FALSE){
				//echo 'The email is already taken.';
			}
			else{
				$res = $this->drivers_model->create();
                if($res != ''){
                    $this->session->set_flashdata("suc","Added Deiver successfully.");
                     redirect(adminurl('Drivers'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/inner_template',$dta);
	}
	
	public function index(){
	
		$dta    =   array(
			"title"     =>  "Drivers",
			"content"  =>  'drivers',
			"urlvalue"	=>	adminurl('viewDriver/'),
			"create"    => 'create-driver/'
		);
		$conditions=array();
		$dta["view"]            =   $this->drivers_model->viewDriver($conditions); 
		$this->load->view('admin/inner_template',$dta);
	}

	public function drivers($str){
        //$vsp	=	$this->resturant_model->unique_id_resturant($str); 
        // if($vsp){
        //     $this->form_validation->set_message("resturant","Resturant Name already exists.");
        //     return FALSE;
        // }
        return TRUE; 
    }
	public function viewDriver($str){
	
	    $conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?0:$page;
		$keywords   =   $this->input->post('keywords');

		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"driverid";  
	
		$totalRec               =   $this->drivers_model->cntviewDriver($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewDriver/');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   adminurl("viewDriver/");
		$dta["view"]            =   $this->drivers_model->viewDriver($conditions); 
		// echo "<pre>";
		// print_r($dta["view"]);
		// exit;
		$this->load->view("ajax_drivers",$dta);
	}
	public function ajax_driver_active(){
		$status     =   $this->input->post("status");
		$uri        =   $this->input->post("fields");
		$params["whereCondition"]   =   "driver_id = '".$uri."'";
		$vue    =   $this->drivers_model->getDriver($params);
		if(is_array($vue) && count($vue) > 0){
			$bt     =   $this->drivers_model->activedeactive($uri,$status); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		}
		echo $vsp;
	}
	public function delete_driver(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "driver_id = '".$uri."'";
		$vue    =   $this->drivers_model->getDriver($params);
		if(count($vue) > 0){
			$bt     =   $this->drivers_model->delete_driver($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}
	public function checkemail($str){
		$vsp    =   $this->drivers_model->checkvalueemail($str); 
		if(!$vsp){
			$this->form_validation->set_message("checkemail","Emaild ID does not exists.");
			return FALSE;
		}	 
		return TRUE; 	
	}	
	public function checkphone($str){
		$vsps    =   $this->drivers_model->checkvaluephone($str); 
		if(!$vsps){
			$this->form_validation->set_message("checkphone","Phone Number does not exists.");
			return FALSE;
		}	 
		return TRUE; 	
	}	
	public function update_driver(){

		if($this->session->userdata("update-driver") != '1'){
				redirect(sitedata("site_admin")."/Dashboard");
		}
		$uri    =   $this->uri->segment("3"); 
		$p['whereCondition'] = "driver_id = '".$uri."'";
		$vue    =   $this->drivers_model->getDriver($p);
	//	echo "<pre>";print_r($vue);exit;
		if(count($vue) > 0){
				$dt     =   array(
						"title"     =>  "Update Driver",
						"content"   =>  "up_driver",
						"icon"      =>  "mdi mdi-account",
						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Drivers")."'>Drivers</a></li>",
						"view"      =>  $vue
				); 
				if($this->input->post("submit")){
						//echo '<pre>';print_r($this->input->post());exit;	
						$this->form_validation->set_rules('driver_name','Driver Name','required');
						$this->form_validation->set_rules('driver_name_a','driver Name in arabic','required');
						$this->form_validation->set_rules('driver_phone','Phone Number','required|numeric|min_length[8]');
						$this->form_validation->set_rules('driver_email','Email','required');
						$this->form_validation->set_rules('driver_dob','driver DOB','required');
						$this->form_validation->set_rules('driver_vehicle_number','Vehicle Number','required');
						$this->form_validation->set_rules('driver_address','Driver Address Name','required');
						$this->form_validation->set_rules('driver_address_a','Driver Address in arabic','required');
						$this->form_validation->set_rules('driver_joining_date','Joining Date','required');	
						$this->form_validation->set_rules('driver_experience','Experience Number','required');					
						$this->form_validation->set_rules('driver_countrycode','Country Code','required');
						// print_r($this->form_validation->run());exit();
						if($this->form_validation->run() == TRUE){
								$bt     =   $this->drivers_model->update_driver($uri);
								if($bt > 0){
										$this->session->set_flashdata("suc","Updated Driver Successfully.");
										redirect(sitedata("site_admin")."/Drivers");
								}else{
										$this->session->set_flashdata("err","Not Updated Driver.Please try again.");
										redirect(sitedata("site_admin")."/Drivers");
								}
						}
				}
				$this->load->view("admin/inner_template",$dt);
		}else{
				$this->session->set_flashdata("war","Driver does not exists."); 
				redirect(sitedata("site_admin")."/Drivers");
		}
}
	
}
?>