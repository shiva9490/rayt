<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Role extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-roles") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Roles",
                                    "content"   =>  "role",
                                    "vtil"      =>  "",
                                    "limit"     =>  "1"
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("role_name","Role Name","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_role_name");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->role_model->create_role();
                        if($bt > 0){
                            $this->session->set_flashdata("suc","Created a Role Successfully.");
                            redirect(sitedata("site_admin")."/Roles");
                        }else{
                            $this->session->set_flashdata("err","Not Created a Role.Please try again.");
                            redirect(sitedata("site_admin")."/Roles");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"id";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                } 
                $dta["urlvalue"]     =   adminurl('viewRole/');
                $this->load->view("admin/inner_template",$dta);
        }
        public function unique_role_name(){
                echo $this->role_model->unique_role($this->input->post("role_name"));
        }
        public function check_role_name($str){ 
                $vsp	=	$this->role_model->check_unique_role($str); 
                if($vsp){
                        $this->form_validation->set_message("check_role_name","Role Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function delete_role(){
                $vsp    =   "0";
                if($this->session->userdata("delete-role") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $vue    =   $this->role_model->get_role($uri);
                    if(count($vue) > 0){
                        $bt     =   $this->role_model->delete_role($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_role(){
                if($this->session->userdata("update-role") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->role_model->get_role($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Role",
                                "content"   =>  "up_role",
                                "icon"      =>  "mdi mdi-account",
                                "vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Roles")."'>Roles</a></li>",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("rolename","Role Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->role_model->update_role($uri);
                                        if($bt > 0){
                                                $this->session->set_flashdata("suc","Updated Role Successfully.");
                                                redirect(sitedata("site_admin")."/Roles");
                                        }else{
                                                $this->session->set_flashdata("err","Not Updated Role.Please try again.");
                                                redirect(sitedata("site_admin")."/Roles");
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Role does not exists."); 
                        redirect(sitedata("site_admin")."/Roles");
                }
        }
        public function viewRole(){ 
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
                $totalRec               =   $this->role_model->cntview_role($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewRole');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                if($perpage != "all"){
                    $conditions['limit']    =   $perpage;
                }
                $dta["urlvalue"]        =   adminurl('viewRole/');
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->role_model->view_role($conditions); 
                $this->load->view("ajax_role",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-role") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $vue    =   $this->role_model->get_role($uri);
                    if(is_array($vue) && count($vue) > 0){
                            $bt     =   $this->role_model->activedeactive($uri,$status); 
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