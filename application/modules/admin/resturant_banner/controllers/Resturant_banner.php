<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Resturant_banner extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function index(){ 
		$dta    =   array( 
							"title"     =>  "Resturant Banner",
							"content"   =>  "resturant_banner",
							"vtil"      =>  "",
							"limit"     =>  "1"
					); 
		if($this->input->post("submit")){   
			if (empty($_FILES['image']['name']))
			{
				$this->form_validation->set_rules('image', 'Image', 'required');
			}else{ 
				$res = $this->resturant_banner_model->create_resturant_banner();
				if($res == TRUE){
					$this->session->set_flashdata("suc","Created a Resturant_banner Successfully.");
					redirect(sitedata("site_admin")."/Resturant-Banner");
				}else{
					$this->session->set_flashdata("err","Not Created a Resturant_banner.Please try again.");
					redirect(sitedata("site_admin")."/Resturant-Banner");
				}
			}
		}  
		$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
		$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"resturant_bannerid";  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $orderby;
			$dta['tipoOrderby']    =   $tipoOrderby; 
		} 
		$dta["urlvalue"]     =   adminurl('viewResturant_banner/');
		$this->load->view("admin/inner_template",$dta);
}
public function resturant_banner_name($str){
	$vsp	=	$this->resturant_banner_model->check_unique_resturant_banner($str); 
	if($vsp){
		$this->form_validation->set_message("resturant_banner_name","Resturant_banner Name already exists.");
		return FALSE;
	}
	return TRUE;
}

public function delete_resturant_banner(){
		$vsp    =   "0";
		if($this->session->userdata("delete-resturant_banner") != '1'){
			$vsp    =   "0";
		}else {
			$uri    =   $this->uri->segment("3");
			$par['whereCondition'] = "resturant_banner_id LIKE '".$uri."'";
			$vue    =   $this->resturant_banner_model->get_resturant_banner($par);
			if(is_array($vue) && count($vue) > 0){
				$bt     =   $this->resturant_banner_model->delete_resturant_banner($uri); 
				if($bt > 0){
					$vsp    =   1;
				}
			}else{
				$vsp    =   2;
			} 
		} 
		echo $vsp;
}
public function update(){
		if($this->session->userdata("update-resturant_banner") != '1'){
				redirect(sitedata("site_admin")."/Dashboard");
		}
		$uri    =   $this->uri->segment("3"); 
		$p['whereCondition'] = "resturant_banner_id = '".$uri."'";
		$vue    =   $this->resturant_banner_model->get_resturant_banner($p);
		if(count($vue) > 0){
				$dt     =   array(
						"title"     =>  "Update Resturant_banner",
						"content"   =>  "up_resturant_banner",
						"icon"      =>  "mdi mdi-account",
						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Resturant_banner")."'>Resturant_banner</a></li>",
						"view"      =>  $vue
				); 
				if($this->input->post("submit")){
					if (empty($_FILES['image']['name']))
					{
						$this->form_validation->set_rules('image', 'Image', 'required');
					}else{ 		
						$bt     =   $this->resturant_banner_model->update_resturant_banner($uri);
						if($bt > 0){
								$this->session->set_flashdata("suc","Updated Resturant_banner Successfully.");
								redirect(sitedata("site_admin")."/Resturant-Banner");
						}else{
								$this->session->set_flashdata("err","Not Updated Resturant_banner.Please try again.");
								redirect(sitedata("site_admin")."/Resturant-Banner");
						}
					}
				}
				$this->load->view("admin/inner_template",$dt);
		}else{
				$this->session->set_flashdata("war","Resturant_banner does not exists."); 
				redirect(sitedata("site_admin")."/Resturant_banner");
		}
}
public function viewResturant_banner(){ 
		$conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords'); 
		if(!empty($keywords)){
				$conditions['keywords'] = $keywords;
		}  
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"id";  
		$totalRec               =   $this->resturant_banner_model->cntview_resturant_banner($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		} 
		$config['base_url']     =   adminurl('viewResturant_banner');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["urlvalue"]        =   adminurl('viewResturant_banner/');
		$dta["limit"]           =   $offset+1;
		$dta["view"]            =   $this->resturant_banner_model->view_resturant_banner($conditions); 
		$this->load->view("ajax_resturant_banner",$dta);
}
public function activedeactive(){
		$vsp    =   "0";
		if($this->session->userdata("active-deactive-resturant_banner") != '1'){
			$vsp    =   "0";
		}else{
			$status     =   $this->input->post("status");
			$uri        =   $this->input->post("fields"); 
			$p['whereCondition'] = "resturant_banner_id = '".$uri."'";
			$vue    =   $this->resturant_banner_model->get_resturant_banner($p);
			if(is_array($vue) && count($vue) > 0){
					$bt     =   $this->resturant_banner_model->activedeactive($uri,$status); 
					if($bt > 0){
						$vsp    =   1;
					}
			}else{
				$vsp    =   2;
			} 
		} 
		echo $vsp;
}
public function __destruct() {
		$this->db->close();
}
	
}
?>