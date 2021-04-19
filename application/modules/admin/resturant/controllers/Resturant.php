<?php
class Resturant extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function create(){
		$number = rand(111,999);
		$id = 'RAYT'.date('ym').$number;
		$dta    =   array(
			"title"     =>  "Create Resturant Form",
			"content"  =>  'create_resturant',
			"id"		=> $id,
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('name','Resturant Name','required');
			$this->form_validation->set_rules('name_a','Resturant Name in arabic','required');
			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
			$this->form_validation->set_rules('Percentage','Percentage','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->resturant_model->create($id);
                if($res != ''){
                    $this->session->set_flashdata("suc","Created Resturant successfully."); //Update menu and items on bottom of the page
                     redirect(adminurl('Resturant'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/inner_template',$dta);
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Resturants",
			"content"  =>  'resturant',
			"urlvalue"	=>	adminurl('viewResturant/'),
			"create"    => 'Create-Resturant/',
		);
		$conditions=array();
		$dta["view"]            =   $this->resturant_model->viewResturant($conditions); 
		$this->load->view('admin/inner_template',$dta);
	}
	public function resturant($str){
        //$vsp	=	$this->resturant_model->unique_id_resturant($str); 
        // if($vsp){
        //     $this->form_validation->set_message("resturant","Resturant Name already exists.");
        //     return FALSE;
        // }
        return TRUE; 
    }
    
	public function viewResturant($str){
	    $conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?0:$page;
		$keywords   =   $this->input->post('keywords');
		//$types      =   $this->input->post('types');
		//$status      =   $this->input->post('status');
		//$school_id  =    $this->session->userdata("login_types")?$this->session->userdata("login_types"):'';
		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"resturantid";  
		$totalRec               =   $this->resturant_model->cntviewResturant($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewResturant/');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   adminurl("viewResturant/");
		$dta["view"]            =   $this->resturant_model->viewResturant($conditions); 
		$this->load->view("ajax_resturant",$dta);
	}
	public function ajax_resturant_active(){
		$status     =   $this->input->post("status");
		$uri        =   $this->input->post("fields");
		$params["whereCondition"]   =   "resturant_id = '".$uri."'";
		$vue    =   $this->resturant_model->getResturant($params);
		if(is_array($vue) && count($vue) > 0){
			$bt     =   $this->resturant_model->activedeactive($uri,$status); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		}
		echo $vsp;
	}
	
	public function update_resturant($str){
        $pmrs["whereCondition"]  =   "resturant_id LIKE  '".$str."'";
        $vsp	=	$this->resturant_model->getResturant($pmrs);
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update resturant",
    			"content"   =>  "update_resturant",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post('update')){
    			$this->form_validation->set_rules('name','Resturant Name','required');
    			$this->form_validation->set_rules('name_a','Resturant Name','required');
    			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
    			$this->form_validation->set_rules('Percentage','Percentage','required');
    			if($this->form_validation->run() == TRUE){
                    $res = $this->resturant_model->update_resturant($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Resturant succfully.");
                        redirect(adminurl('Resturant'));
                    }else{
                        $this->session->set_flashdata("err","update Resturant failed.");
                    }
    	        }
    	    }
    	    $conditions=array();
    	    $conditions['id']=$str;
    	    $dta['images']=$this->resturant_model->viewResImages($conditions); 
		    $this->load->view("admin/inner_template",$dta); 
        }
	}
	public function delete_resturant(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "resturant_id = '".$uri."'";
		$vue    =   $this->resturant_model->getResturant($params);
		if(count($vue) > 0){
			$bt     =   $this->resturant_model->delete_resturant($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}
	
	public function delete_res_image(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "resturant_images_id = '".$uri."'";
		$vue    =   $this->resturant_model->getResImages($params);
		if(count($vue) > 0){
		    $res=$vue['resturant_id'];
			$bt     =   $this->resturant_model->delete_resImages($uri); 
			unlink($vue['resturant_images_path']);
			if($bt > 0){
			    $this->session->set_flashdata("suc","image deleted sucessfully");
				redirect(adminurl('Update-Resturant/'.$res));
			}
		}else{
			$this->session->set_flashdata("err","Unable to delete");
				redirect(adminurl('Resturant'));
		} 
		echo $vsp;
	}
	
}
?>