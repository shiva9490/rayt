<?php
class Drivers extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}

	public function create(){
	    $incre = $this->db->query('SELECT MAX(driver_login_username) as ids FROM `driver_login')->row_array();
	    if(isset($incre['ids']) && ($incre['ids']) != ""){
	        $number = (int)$incre['ids']+1;
	    }else{
	        $number ='1';
	    }
		$id = str_pad($number, 4, "0", STR_PAD_LEFT);
		$conditions['whereCondition']	="zone_abc = 'Active'";
		$zone            =   $this->zone_model->viewZones($conditions);
// 		echo "<pre>";print_r($zone );exit;
		$condition['whereCondition']	="resturant_status = 'Active'";
		$rest            =   $this->resturant_model->viewResturant($condition); 
		$dta    =   array(
			"title"     =>  "Create Drivers Form",
			"content"   =>  'create_driver',
			"zone"		=>	$zone,
			"id"		=>  $id,
			"rest"		=>  $rest
		);
		if($this->input->post('publish')){
		   // echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('driver_name','Driver Name','required');	
			$this->form_validation->set_rules('driver_name_last','Driver Last Name','required');				
			$this->form_validation->set_rules('driver_phone','Phone Number','required|numeric|min_length[8]');					
			$this->form_validation->set_rules('zone','Zone','required');
			$this->form_validation->set_rules('vehicle_type','Vehicle Type','required');
			$this->form_validation->set_rules('category','Category','required');
			$this->form_validation->set_rules('nationality','Nationality','required');
			$this->form_validation->set_rules('gender','Gender','required');
			$this->form_validation->set_rules('driver_dob','driver DOB','required');
			$this->form_validation->set_rules('driver_vehicle_number','Vehicle Number','required');
			$this->form_validation->set_rules('driver_address','Driver Address Name','required');
			$this->form_validation->set_rules('civil_id','Civil Id','required');
			$this->form_validation->set_rules('civil_expiry','Civil Expiry','required');
			$this->form_validation->set_rules('licence_no','Licence no.','required');
			$this->form_validation->set_rules('licence_expiry','Licence Expiry','required');
			$this->form_validation->set_rules('defther_expiry','Defther Expiry','required');
			$this->form_validation->set_rules('driver_joining_date','Joining Date','required');
			$this->form_validation->set_rules('driver_countrycode','Country Code','required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata("err","Some files required.");
			}else{
				$res = $this->drivers_model->create($id);
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
    public function driver_details(){
		$uri    =   $this->uri->segment("3"); 
		$p['whereCondition'] = "d.driver_id = '".$uri."'";
		$data            =   $this->drivers_model->getDriver($p); 
		//$driid = $this->input->post('der');
	    $par['columns']         =   "driver_address_latitude,driver_address_longitude";
        $par['whereCondition']  =   "d.driver_id LIKE '".$uri."'";
        $par['tipoOrderby']     =   "driver_addressid";
        $par['order_by']        =   "DESC";
        $point  = $this->drivers_model->getDriverupdate($par);
		$dta    =   array(
			"title"     =>  "Driver Details",
			"content"   =>  'driver_details',				
			"view"		=>  $data,			
			"point"		=>  $point,		
		);	
		$this->load->view('admin/inner_template',$dta);
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
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
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
		$p['whereCondition'] = "d.driver_id = '".$uri."'";
		$vue    =   $this->drivers_model->getDriver($p);
	//	echo "<pre>";print_r($vue);exit;
		if(count($vue) > 0){
			$conditions['whereCondition']	="zone_abc = 'Active'";
			$zone            =   $this->zone_model->viewZones($conditions); 
			$condition['whereCondition']	="resturant_status = 'Active'";
			$rest            =   $this->resturant_model->viewResturant($condition); 
				$dt     =   array(
						"title"     =>  "Update Driver",
						"content"   =>  "up_driver",
						"icon"      =>  "mdi mdi-account",
						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Drivers")."'>Drivers</a></li>",
						"view"      =>  $vue,
						"zone"		=>	$zone,
						"rest"		=>  $rest
				); 
				if($this->input->post("submit")){
			//	echo '<pre>';print_r($this->input->post());exit;	
						$this->form_validation->set_rules('driver_name','Driver Name','required');	
						$this->form_validation->set_rules('driver_name_last','Driver Last Name','required');				
						$this->form_validation->set_rules('driver_phone','Phone Number','required|numeric|min_length[8]');					
						$this->form_validation->set_rules('zone','Zone','required');
						$this->form_validation->set_rules('vehicle_type','Vehicle Type','required');
						$this->form_validation->set_rules('category','Category','required');
						$this->form_validation->set_rules('nationality','Nationality','required');
						$this->form_validation->set_rules('gender','Gender','required');
						$this->form_validation->set_rules('driver_dob','driver DOB','required');
						$this->form_validation->set_rules('driver_vehicle_number','Vehicle Number','required');
						$this->form_validation->set_rules('driver_address','Driver Address Name','required');
						$this->form_validation->set_rules('civil_id','Civil Id','required');
						$this->form_validation->set_rules('civil_expiry','Civil Expiry','required');
						$this->form_validation->set_rules('licence_no','Licence no.','required');
						$this->form_validation->set_rules('licence_expiry','Licence Expiry','required');
						$this->form_validation->set_rules('defther_expiry','Defther Expiry','required');
						$this->form_validation->set_rules('driver_joining_date','Joining Date','required');
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
				$conditionss=array();
				$conditionss['id']=$uri ;
				$dt['drivertime']=$this->drivers_model->viewDriverTime($conditionss);
				$this->load->view("admin/inner_template",$dt);
		}else{
				$this->session->set_flashdata("war","Driver does not exists."); 
				redirect(sitedata("site_admin")."/Drivers");
		}
}
public function update_driver_document($str){	
	if($this->session->userdata("update-driver") != '1'){
		redirect(sitedata("site_admin")."/Dashboard");
	}
	$str    =   $this->uri->segment("3"); 
	$pmrs["whereCondition"]  =   "driver_id LIKE  '".$str."'";
	$vsp	=	$this->drivers_model->getDriver($pmrs);
	//	echo '<pre>';print_r($vsp);exit;
	if($vsp){
		$dta    =   array(
			"title"     =>  "update driver documnet",
			"content"   =>  "update_driver_document",
			"view"      =>  $vsp
		);
		if($this->input->post("submit")){				
			if($this->form_validation->run() == TRUE){
				$res = $this->drivers_model->update_driver_doc($str);     
				if($res){
					$this->session->set_flashdata("suc","update Driver succfully.");
					redirect(adminurl('Driver'));
				}else{
					$this->session->set_flashdata("err","update Driver failed.");
				}
			}
		}
		$conditions=array();
		$conditions['id']=$str;
		$dta['images']=$this->drivers_model->viewDriImages($conditions); 		
		//echo '<pre>';print_r($dta['resttime']);exit;	
		$this->load->view("admin/inner_template",$dta); 
	}
}
public function update_dri_images(){	
	$str    =   $this->input->post('imageid');
	$pmrs["whereCondition"]  =   "driver_images_id LIKE  '".$str."'";
	$vsp['images']	=	$this->drivers_model->getDriImages($pmrs);
	//print_r($vsp['images']);exit;
	$this->load->view('update_driver_documents',$vsp);
}

public function update_dri_image_doc($str){	
	if($this->session->userdata("update-driver") != '1'){
		redirect(sitedata("site_admin")."/Dashboard");
		}
		$str    =   $this->uri->segment("3"); 
	
	$pmrs["whereCondition"]  =   "driver_images_id LIKE  '".$str."'";
	$vsp	=	$this->drivers_model->getDriImages($pmrs);
	if($vsp){
		$dta    =   array(
			"title"     =>  "update driver image documnet",
			"content"   =>  "update_dri_image_doc",
			"view"      =>  $vsp
		);	
		$res=$vsp['driver_id'];
		echo $res;	
		if($this->input->post("submit")){
			
			$ress = $this->drivers_model->update_Dri_Images($str);     
			if($ress){					
				$this->session->set_flashdata("suc","update Driver succfully.");
				redirect(adminurl('Update-Driver-Document/'.$res));
			}else{
				$this->session->set_flashdata("err","update Driver failed.");
			}
		
	}
	//print_r($vsp);exit;
	$this->load->view("admin/inner_template",$dta); 
	}
}
public function delete_dri_image_doc(){
	
	$uri    =   $this->uri->segment("3");
	$params["whereCondition"]   =   "driver_images_id = '".$uri."'";
	$vue    =   $this->drivers_model->getDriImages($params);
	if(count($vue) > 0){
		$res=$vue['driver_id'];
		$bt     =   $this->drivers_model->delete_driImages($uri); 
		unlink($vue['driver_images_path']);
		if($bt > 0){
			$this->session->set_flashdata("suc","image deleted sucessfully");
			redirect(adminurl('Update-Resturant-Document/'.$res));
		}
	}else{
		$this->session->set_flashdata("err","Unable to delete");
			redirect(adminurl('Resturant'));
	} 
	echo $vsp;
}

public function add_dri_image_doc($str){	
			
	if($this->session->userdata("update-driver") != '1'){
		redirect(sitedata("site_admin")."/Dashboard");
		}
		$str    =   $this->uri->segment("3"); 
		$pmrs["whereCondition"]  =   "driver_id LIKE  '".$str."'";
		$vsp	=	$this->drivers_model->getDriver($pmrs);
	if($vsp){
		$dta    =   array(
			"title"     =>  "Add Driver image documnet",
			"content"   =>  "add_dri_image_doc",
			"view"      =>  $vsp
		);	
		$res=$vsp['driver_id'];
	//	echo $res;	
		if($this->input->post("submit")){
			
			$ress = $this->drivers_model->add_Dri_Images($str);     
			if($ress){					
				$this->session->set_flashdata("suc","Added Driver images succfully.");
				redirect(adminurl('Update-Driver-Document/'.$res));
			}else{
				$this->session->set_flashdata("err","update Driver failed.");
			}			
		}

	$this->load->view("admin/inner_template",$dta); 
	}
}

public function ajax_res_list(){
	$zone	=	$this->input->post('zone');
	if($zone[0]!='' || $zone[1]!=''){
		$condition['whereCondition']	="resturant_status = 'Active'";
		$i=0;
		foreach($zone as $z){
			if($z!=''){
				if($i==0){
					$condition['whereCondition']	.="AND ";
				}else{
					$condition['whereCondition']	.="OR ";
				}
				$condition['whereCondition']	.="resturant_zone LIKE '%".$z."%' ";$i++;

			}
		}
		$dta['rest']	 =   $this->resturant_model->viewResturant($condition); 
		$this->load->view("ajax_rest_list",$dta);
	}else{
		echo 1;
	}
}
	
	public function update_drive_loc(){
	    $driid = $this->input->post('der');
	    $par['columns']         =   "driver_address_latitude,driver_address_longitude";
        $par['whereCondition']  =   "d.driver_id LIKE '".$driid."'";
        $par['tipoOrderby']     =   "driver_addressid";
        $par['order_by']        =   "DESC";
        $data['point']  = $this->drivers_model->getDriverupdate($par);
        $this->load->view('ajax_update_driver',$data);
	}
}
?>