<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Variant extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function index(){ 
		$dta    =   array( 
							"title"     =>  "Variant",
							"content"   =>  "variant",
							"vtil"      =>  "",
							"limit"     =>  "1"
					); 
		if($this->input->post("submit")){
			$this->form_validation->set_rules("variant_name","Variant Name","required|callback_variant_name");
			$this->form_validation->set_rules("variant_description","Variant Name","required");
			if($this->form_validation->run() == TRUE){
				$bt     =   $this->variant_model->create_variant();
				if($bt > 0){
					$this->session->set_flashdata("suc","Created a Variant Successfully.");
					redirect(sitedata("site_admin")."/Variant");
				}else{
					$this->session->set_flashdata("err","Not Created a Variant.Please try again.");
					redirect(sitedata("site_admin")."/Variant");
				}
			}
		}  
		$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
		$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"variantid";  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $orderby;
			$dta['tipoOrderby']    =   $tipoOrderby; 
		} 
		$dta["urlvalue"]     =   adminurl('viewVariant/');
		$this->load->view("admin/inner_template",$dta);
}
public function variant_name($str){
	$vsp	=	$this->variant_model->check_unique_variant($str); 
	if($vsp){
		$this->form_validation->set_message("variant_name","Variant Name already exists.");
		return FALSE;
	}
	return TRUE;
}
public function delete_variant(){
		$vsp    =   "0";
		if($this->session->userdata("delete-variant") != '1'){
			$vsp    =   "0";
		}else {
			$uri    =   $this->uri->segment("3");
			$p['whereCondition'] = "variant_id = '".$uri."'";
			$vue    =   $this->variant_model->get_variant($p);
			if(count($vue) > 0){
				$bt     =   $this->variant_model->delete_variant($uri); 
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
		if($this->session->userdata("update-variant") != '1'){
				redirect(sitedata("site_admin")."/Dashboard");
		}
		$uri    =   $this->uri->segment("3"); 
		$p['whereCondition'] = "variant_id = '".$uri."'";
		$vue    =   $this->variant_model->get_variant($p);
		if(count($vue) > 0){
				$dt     =   array(
						"title"     =>  "Update Variant",
						"content"   =>  "up_variant",
						"icon"      =>  "mdi mdi-account",
						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Variant")."'>Variant</a></li>",
						"view"      =>  $vue
				); 
				if($this->input->post("submit")){
						$this->form_validation->set_rules("variant_name","Variant Name","required");
						$this->form_validation->set_rules("variant_description","Variant Name","required");
						if($this->form_validation->run() == TRUE){
								$bt     =   $this->variant_model->update_variant($uri);
								if($bt > 0){
										$this->session->set_flashdata("suc","Updated Variant Successfully.");
										redirect(sitedata("site_admin")."/Variant");
								}else{
										$this->session->set_flashdata("err","Not Updated Variant.Please try again.");
										redirect(sitedata("site_admin")."/Variant");
								}
						}
				}
				$this->load->view("admin/inner_template",$dt);
		}else{
				$this->session->set_flashdata("war","Variant does not exists."); 
				redirect(sitedata("site_admin")."/Variant");
		}
}
public function viewVariant(){ 
		$conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords'); 
		if(!empty($keywords)){
				$conditions['keywords'] = $keywords;
		}  
		$conditions['whereCondition'] =   "variant_id !='0'";
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"id";  
		$totalRec               =   $this->variant_model->cntview_variant($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		} 
		$config['base_url']     =   adminurl('viewVariant');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["urlvalue"]        =   adminurl('viewVariant/');
		$dta["limit"]           =   $offset+1;
		$dta["view"]            =   $this->variant_model->view_variant($conditions); 
		$this->load->view("ajax_variant",$dta);
}
public function activedeactive(){
		$vsp    =   "0";
		if($this->session->userdata("active-deactive-variant") != '1'){
			$vsp    =   "0";
		}else{
			$status     =   $this->input->post("status");
			$uri        =   $this->input->post("fields"); 
			$p['whereCondition'] = "variant_id = '".$uri."'";
			$vue    =   $this->variant_model->get_variant($p);
			if(is_array($vue) && count($vue) > 0){
					$bt     =   $this->variant_model->activedeactive($uri,$status); 
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