<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
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
			$this->form_validation->set_rules('name','Restaurant Name','required');
			$this->form_validation->set_rules('name_a','Restaurant Name in arabic','required');
			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
			$this->form_validation->set_rules('Percentage','Percentage','required');
			$this->form_validation->set_rules('Percentage','Percentage','required');
			$this->form_validation->set_rules('Percentage','Percentage','required');
			$this->form_validation->set_rules('strt_time[]','start Time','required');
			$this->form_validation->set_rules('end_time[]','End Time','required');
		
			if($this->form_validation->run() == TRUE){
				$res = $this->resturant_model->create($id);
                if($res != ''){
                    $this->session->set_flashdata("suc","Created Restaurant successfully."); //Update menu and items on bottom of the page
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
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination"); 
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
		if($this->session->userdata("update-resturant") != '1'){
			redirect(sitedata("site_admin")."/Dashboard");
	    }
	    $str    =   $this->uri->segment("3");
        $pmrs["whereCondition"]  =   "resturant_id LIKE  '".$str."'";
        $vsp	=	$this->resturant_model->getResturant($pmrs);
		//echo '<pre>';print_r($vsp);exit;
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update resturant",
    			"content"   =>  "update_resturant",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post("submit")){
				//echo '<pre>';print_r($this->input->post());exit;	
    			$this->form_validation->set_rules('name','Restaurant Name','required');
    			$this->form_validation->set_rules('name_a','Restaurant Name','required');
    			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
    			$this->form_validation->set_rules('Percentage','Percentage','required');
    			if($this->form_validation->run() == TRUE){
                    $res = $this->resturant_model->update_resturant($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Restaurant succfully.");
                        redirect(adminurl('Resturant'));
                    }else{
                        $this->session->set_flashdata("err","update Restaurant failed.");
                    }
    	        }
    	    }
    	    $conditions=array();
    	    $conditions['id']=$str;
			$dta['resttime']=$this->resturant_model->viewResTime($conditions); 
			//echo '<pre>';print_r($dta['resttime']);exit;	
		    $this->load->view("admin/inner_template",$dta); 
        }
	}
	public function update_resturant_document($str){	
		if($this->session->userdata("update-resturant") != '1'){
			redirect(sitedata("site_admin")."/Dashboard");
	}
	$str    =   $this->uri->segment("3"); 
        $pmrs["whereCondition"]  =   "resturant_id LIKE  '".$str."'";
        $vsp	=	$this->resturant_model->getResturant($pmrs);
		//	echo '<pre>';print_r($vsp);exit;
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update resturant documnet",
    			"content"   =>  "update_resturant_document",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post("submit")){				
    			if($this->form_validation->run() == TRUE){
                    $res = $this->resturant_model->update_resturant($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Restaurant succfully.");
                        redirect(adminurl('Resturant'));
                    }else{
                        $this->session->set_flashdata("err","update Restaurant failed.");
                    }
    	        }
    	    }
    	    $conditions=array();
    	    $conditions['id']=$str;
    	    $dta['images']=$this->resturant_model->viewResImages($conditions); 		
			//echo '<pre>';print_r($dta['resttime']);exit;	
		    $this->load->view("admin/inner_template",$dta); 
        }
	}
	public function update_res_image_doc($str){	
		if($this->session->userdata("update-resturant") != '1'){
			redirect(sitedata("site_admin")."/Dashboard");
			}
			$str    =   $this->uri->segment("3"); 
		
        $pmrs["whereCondition"]  =   "resturant_images_id LIKE  '".$str."'";
        $vsp	=	$this->resturant_model->getResImages($pmrs);
		if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update resturant image documnet",
    			"content"   =>  "update_res_image_doc",
    			"view"      =>  $vsp
    		);	
			$res=$vsp['resturant_id'];
			echo $res;	
			if($this->input->post("submit")){
				
				$ress = $this->resturant_model->update_Res_Images($str);     
				if($ress){					
					$this->session->set_flashdata("suc","update Restaurant succfully.");
					redirect(adminurl('Update-Resturant-Document/'.$res));
				}else{
					$this->session->set_flashdata("err","update Restaurant failed.");
				}
			
		}
		//print_r($vsp);exit;
		$this->load->view("admin/inner_template",$dta); 
		}
	}
	public function add_res_image_doc($str){
		if($this->session->userdata("update-resturant") != '1'){
			redirect(sitedata("site_admin")."/Dashboard");
			}
			$str    =   $this->uri->segment("3"); 
			$pmrs["whereCondition"]  =   "resturant_id LIKE  '".$str."'";
			$vsp	=	$this->resturant_model->getResturant($pmrs);
        // $pmrs["whereCondition"]  =   "resturant_images_id LIKE  '".$str."'";
        // $vsp	=	$this->resturant_model->getResImages($pmrs);
		if($vsp){
    	    $dta    =   array(
    			"title"     =>  "Add resturant image documnet",
    			"content"   =>  "add_res_image_doc",
    			"view"      =>  $vsp
    		);	
			$res=$vsp['resturant_id'];
		//	echo $res;	
			if($this->input->post("submit")){
				
				$ress = $this->resturant_model->add_Res_Images($str);     
				if($ress){					
					$this->session->set_flashdata("suc","Added Restaurant images succfully.");
					redirect(adminurl('Update-Resturant-Document/'.$res));
				}else{
					$this->session->set_flashdata("err","update Resturant failed.");
				}			
			}
	
		$this->load->view("admin/inner_template",$dta); 
		}
	}
	public function update_res_images(){	
		$str    =   $this->input->post('imageid');
        $pmrs["whereCondition"]  =   "resturant_images_id LIKE  '".$str."'";
        $vsp['images']	=	$this->resturant_model->getResImages($pmrs);
		//print_r($vsp['images']);exit;
		$this->load->view('update_resturant_documents',$vsp);
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
	public function delete_res_image_doc(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "resturant_images_id = '".$uri."'";
		$vue    =   $this->resturant_model->getResImages($params);
		if(count($vue) > 0){
		    $res=$vue['resturant_id'];
			$bt     =   $this->resturant_model->delete_resImages($uri); 
			unlink($vue['resturant_images_path']);
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
	public function resturant_details(){
	    if($this->input->post('eve')!=""){
	    	$restraint_id = $this->input->post('eve');
	        $par['whereCondition'] = "resturantid LIKE '".$this->input->post('eve')."' ";
	        //$par['group_by'] = "ord.orderdetail_restaurant_item_id";
	        $res = $this->resturant_model->getResturant($par);
	        $data = array(
	             'title' =>$this->input->post('eve'),
	             'data'  => $res,
	        );
	        $this->load->view('ajax_popup',$data);
	    }
	}
}
?>