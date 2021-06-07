<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Category extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function index(){ 
		$dta    =   array( 
							"title"     =>  "Category",
							"content"   =>  "category",
							"vtil"      =>  "",
							"limit"     =>  "1"
					); 
    		if($this->input->post("submit")){
    			$this->form_validation->set_rules("category_name","category Name","required|callback_category_name");
    			if($this->form_validation->run() == TRUE){
    				$bt     =   $this->category_model->create_category();
    				if($bt > 0){
    					$this->session->set_flashdata("suc","Created a category Successfully.");
    					redirect(sitedata("site_admin")."/Category");
    				}else{
    					$this->session->set_flashdata("err","Not Created a category.Please try again.");
    					redirect(sitedata("site_admin")."/Category");
    				}
    			}
    		}  
    		$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
    		$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"categoryid";  
    		if(!empty($orderby) && !empty($tipoOrderby)){ 
    			$dta['orderby']        =   $orderby;
    			$dta['tipoOrderby']    =   $tipoOrderby; 
    		} 
    		$dta["urlvalue"]     =   adminurl('viewcategory/');
    		$this->load->view("admin/inner_template",$dta);
        }
        public function category_name($str){
        	$vsp	=	$this->category_model->check_unique_category($str); 
        	if($vsp){
        		$this->form_validation->set_message("category_name","category Name already exists.");
        		return FALSE;
        	}
        	return TRUE;
        }
       public function delete_category(){
        		$vsp    =   "0";
        		if($this->session->userdata("delete-category") != '1'){
        			$vsp    =   "0";
        		}else {
        			$uri    =   $this->uri->segment("3");
        			$p['whereCondition'] = "category_id = '".$uri."'";
        			$vue    =   $this->category_model->getCategory($p);
        			if(count($vue) > 0){
        				$bt     =   $this->category_model->delete_category($uri); 
        				if($bt > 0){
        					$vsp    =   1;
        				}
        			}else{
        				$vsp    =   2;
        			} 
        		} 
        		echo $vsp;
        }
        public function update_category(){
        		if($this->session->userdata("update-category") != '1'){
        				redirect(sitedata("site_admin")."/Dashboard");
        		}
        		$uri    =   $this->uri->segment("3"); 
        		$p['whereCondition'] = "category_id = '".$uri."'";
        		$vue    =   $this->category_model->getCategory($p);
        		if(count($vue) > 0){
        				$dt     =   array(
        						"title"     =>  "Update category",
        						"content"   =>  "up_category",
        						"icon"      =>  "mdi mdi-account",
        						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("category")."'>category</a></li>",
        						"view"      =>  $vue
        				); 
        				if($this->input->post("submit")){
							//	echo "<pre>"; print_r($_POST);exit;
        						$this->form_validation->set_rules("category_name","category Name","required");
        						$this->form_validation->set_rules("category_name_a","category Arabic Name","required");
        						if($this->form_validation->run() == TRUE){
        								$bt     =   $this->category_model->update_category($uri);
        								if($bt > 0){
        										$this->session->set_flashdata("suc","Updated category Successfully.");
        										redirect(sitedata("site_admin")."/Category");
        								}else{
        										$this->session->set_flashdata("err","Not Updated category.Please try again.");
        										redirect(sitedata("site_admin")."/Category");
        								}
        						}
        				}
        				$this->load->view("admin/inner_template",$dt);
        		}else{
        				$this->session->set_flashdata("war","category does not exists."); 
        				redirect(sitedata("site_admin")."/category");
        		}
        }
        public function update(){
        		if($this->session->userdata("update-category") != '1'){
        				redirect(sitedata("site_admin")."/Dashboard");
        		}
        		$uri    =   $this->uri->segment("3"); 
        		$p['whereCondition'] = "category_id = '".$uri."'";
        		$vue    =   $this->category_model->get_category($p);
        		if(count($vue) > 0){
        				$dt     =   array(
        						"title"     =>  "Update category",
        						"content"   =>  "up_category",
        						"icon"      =>  "mdi mdi-account",
        						"vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("category")."'>category</a></li>",
        						"view"      =>  $vue
        				); 
        				if($this->input->post("submit")){
        						$this->form_validation->set_rules("category_name","category Name","required");
        						$this->form_validation->set_rules("category_description","category Name","required");
        						if($this->form_validation->run() == TRUE){
        								$bt     =   $this->category_model->update_category($uri);
        								if($bt > 0){
        										$this->session->set_flashdata("suc","Updated category Successfully.");
        										redirect(sitedata("site_admin")."/category");
        								}else{
        										$this->session->set_flashdata("err","Not Updated category.Please try again.");
        										redirect(sitedata("site_admin")."/category");
        								}
        						}
        				}
        				$this->load->view("admin/inner_template",$dt);
        		}else{
        				$this->session->set_flashdata("war","category does not exists."); 
        				redirect(sitedata("site_admin")."/category");
        		}
        }
        public function viewcategory(){ 
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
        		$totalRec               =   $this->category_model->cntviewCategory($conditions);  
        		if(!empty($orderby) && !empty($tipoOrderby)){ 
        			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
        			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
        		} 
        		$config['base_url']     =   adminurl('viewcategory');
        		$config['total_rows']   =   $totalRec;
        		$config['per_page']     =   $perpage; 
        		$config['link_func']    =   'searchFilter';
        		$this->ajax_pagination->initialize($config);
        		$conditions['start']    =   $offset;
        		if($perpage != "all"){
        			$conditions['limit']    =   $perpage;
        		}
        		$dta["urlvalue"]        =   adminurl('viewcategory/');
        		$dta["limit"]           =   $offset+1;
        		$dta["view"]            =   $this->category_model->viewCategory($conditions); 
        		$this->load->view("ajax_category",$dta);
        }
        public function activedeactive(){
        		$vsp    =   "0";
        		if($this->session->userdata("active-deactive-category") != '1'){
        			$vsp    =   "0";
        		}else{
        			$status     =   $this->input->post("status");
        			$uri        =   $this->input->post("fields"); 
        			$p['whereCondition'] = "category_id = '".$uri."'";
        			$vue    =   $this->category_model->get_category($p);
        			if(is_array($vue) && count($vue) > 0){
        					$bt     =   $this->category_model->activedeactive($uri,$status); 
        					if($bt > 0){
        						$vsp    =   1;
        					}
        			}else{
        				$vsp    =   2;
        			} 
        		} 
        		echo $vsp;
        }
        public function ajax_category_active(){
		$status     =   $this->input->post("status");
		$uri        =   $this->input->post("fields");
		$params["whereCondition"]   =   "category_id = '".$uri."'";
		$vue    =   $this->category_model->getCategory($params);
		if(is_array($vue) && count($vue) > 0){
			$bt     =   $this->category_model->activedeactive($uri,$status); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		}
		echo $vsp;
    	}
       
        public function __destruct() {
        		$this->db->close();
        }
	
}
?>