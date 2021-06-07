<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Addon extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function index(){ 
		$dta    =   array( 
							"title"     =>  "Addon",
							"content"   =>  "addon",
							"vtil"      =>  "",
							"limit"     =>  "1"
					); 
		if($this->input->post("submit")){
			$this->form_validation->set_rules("addon_name","Addon Name","required|callback_addon_name");
			$this->form_validation->set_rules("addon_description","Addon Name","required");
			if($this->form_validation->run() == TRUE){
				$bt     =   $this->addon_model->create_addon();
				if($bt > 0){
					$this->session->set_flashdata("suc","Created a Addon Successfully.");
					redirect(sitedata("site_admin")."/Addon");
				}else{
					$this->session->set_flashdata("err","Not Created a Addon.Please try again.");
					redirect(sitedata("site_admin")."/Addon");
				}
			}
		}  
		$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
		$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"addonid";  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $orderby;
			$dta['tipoOrderby']    =   $tipoOrderby; 
		} 
		$dta["urlvalue"]     =   adminurl('viewAddon/');
		$this->load->view("admin/inner_template",$dta);
}
public function addon_name($str){
	$vsp	=	$this->addon_model->check_unique_addon($str); 
	if($vsp){
		$this->form_validation->set_message("addon_name","Addon Name already exists.");
		return FALSE;
	}
	return TRUE;
}
public function delete_addon(){
		$vsp    =   "0";
		if($this->session->userdata("delete-addon") != '1'){
			$vsp    =   "0";
		}else {
			$uri    =   $this->uri->segment("3");
			$p['whereCondition'] = "addon_id = '".$uri."'";
			$vue    =   $this->addon_model->get_addon($p);
			//print_r($vue);exit;
			if(count($vue) > 0){
				$bt     =   $this->addon_model->delete_addon($uri); 
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
		if($this->session->userdata("update-addon") != '1'){
				redirect(sitedata("site_admin")."/Dashboard");
		}
		$uri    =   $this->uri->segment("3"); 
		$p['whereCondition'] = "addon_id = '".$uri."'";
		$vue    =   $this->addon_model->get_addon($p);
		if(count($vue) > 0){
				$dt     =   array(
						"title"     =>  "Update Addon",
						"content"   =>  "up_addon",
						"icon"      =>  "mdi mdi-account",
						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Addon")."'>Addon</a></li>",
						"view"      =>  $vue
				); 
				if($this->input->post("submit")){
						$this->form_validation->set_rules("addon_name","Addon Name","required");
						$this->form_validation->set_rules("addon_description","Addon Name","required");
						if($this->form_validation->run() == TRUE){
								$bt     =   $this->addon_model->update_addon($uri);
								if($bt > 0){
										$this->session->set_flashdata("suc","Updated Addon Successfully.");
										redirect(sitedata("site_admin")."/Addon");
								}else{
										$this->session->set_flashdata("err","Not Updated Addon.Please try again.");
										redirect(sitedata("site_admin")."/Addon");
								}
						}
				}
				$this->load->view("admin/inner_template",$dt);
		}else{
				$this->session->set_flashdata("war","Addon does not exists."); 
				redirect(sitedata("site_admin")."/Addon");
		}
}
public function viewAddon(){ 
		$conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords'); 
		if(!empty($keywords)){
				$conditions['keywords'] = $keywords;
		}
		$conditions['whereCondition'] = "addon_id !='0'";
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"id";  
		$totalRec               =   $this->addon_model->cntview_addon($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		} 
		$config['base_url']     =   adminurl('viewAddon');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["urlvalue"]        =   adminurl('viewAddon/');
		$dta["limit"]           =   $offset+1;
		$dta["view"]            =   $this->addon_model->view_addon($conditions); 
		$this->load->view("ajax_addon",$dta);
}
public function activedeactive(){
		$vsp    =   "0";
		if($this->session->userdata("active-deactive-addon") != '1'){
			$vsp    =   "0";
		}else{
			$status     =   $this->input->post("status");
			$uri        =   $this->input->post("fields"); 
			$p['whereCondition'] = "addon_id = '".$uri."'";
			$vue    =   $this->addon_model->get_addon($p);
			if(is_array($vue) && count($vue) > 0){
					$bt     =   $this->addon_model->activedeactive($uri,$status); 
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