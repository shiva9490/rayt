<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Users extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function create(){	
		$dta    =   array(
			"title"     =>  "Create Users",
			"content"  =>  'create_user',			
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('user_name','Restaurant Name','required');
			$this->form_validation->set_rules('user_password','user Password','required');
			$this->form_validation->set_rules('user_email','Email','required');
			$this->form_validation->set_rules('user_phone','user phone','required');
			$this->form_validation->set_rules('user_joining','Joining date','required');
			$this->form_validation->set_rules('user_role','role','required');
			$this->form_validation->set_rules('user_experience','Experience','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->users_model->create();
                if($res != ''){
                    $this->session->set_flashdata("suc","Created user successfully.");
                     redirect(adminurl('Users'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/inner_template',$dta);
	}
	public function index(){
     
		$dta    =   array(
			"title"     =>  "Users",
			"content"  =>  'users',
			"urlvalue"	=>	adminurl('viewUsers/'),
			"create"    => 'Create-Users/',
		);
		$conditions=array();
		$dta["view"]            =   $this->users_model->viewUsers($conditions); 
      
		$this->load->view('admin/inner_template',$dta);
	}
    
	public function viewUsers($str){
	    $conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?0:$page;
		$keywords   =   $this->input->post('keywords');	
		if(($keywords)!=""){
			$conditions['keywords'] = $keywords;
		}
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination"); 
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"userid";  
		$totalRec               =   $this->users_model->cntviewUsers($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewUsers/');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   adminurl("viewUsers/");
		$dta["view"]            =   $this->users_model->viewUsers($conditions); 
// echo '<pre>';print_r($dta["view"]);exit;
		$this->load->view("ajax_users",$dta);
	}
	public function ajax_users_active(){
		$status     =   $this->input->post("status");
		$uri        =   $this->input->post("fields");
		$params["whereCondition"]   =   "user_id = '".$uri."'";
		$vue    =   $this->users_model->getUsers($params);
		if(is_array($vue) && count($vue) > 0){
			$bt     =   $this->users_model->activedeactive($uri,$status); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		}
		echo $vsp;
	}
	
	public function update_users($str){
// 		if($this->session->userdata("update-users") != '1'){
// 			redirect(sitedata("site_admin")."/Dashboard");
// 	    }
	    $str    =   $this->uri->segment("3");
        $pmrs["whereCondition"]  =   "user_id LIKE  '".$str."'";
        $vsp	=	$this->users_model->getUsers($pmrs);
	//echo '<pre>';print_r($vsp);exit;
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update Users",
    			"content"   =>  "update_users",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post("publish")){
				//echo '<pre>';print_r($this->input->post());exit;	
                $this->form_validation->set_rules('user_name','Restaurant Name','required');
                $this->form_validation->set_rules('user_password','user Password','required');
                $this->form_validation->set_rules('user_email','Email','required');
                $this->form_validation->set_rules('user_phone','user phone','required');
                $this->form_validation->set_rules('user_joining','Joining date','required');
                $this->form_validation->set_rules('user_role','role','required');
                $this->form_validation->set_rules('user_experience','Experience','required');
                if($this->form_validation->run() == TRUE){
                    
                    $res = $this->users_model->update_users($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Users succfully.");
                        redirect(adminurl('Users'));
                    }else{
                        $this->session->set_flashdata("err","update Users failed.");
                    }
    	        }
    	    }			
		    $this->load->view("admin/inner_template",$dta); 
        }
	}

	public function delete_users(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "user_id = '".$uri."'";
		$vue    =   $this->users_model->getUsers($params);
		if(count($vue) > 0){
			$bt     =   $this->users_model->delete_users($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}	

	
}
?>