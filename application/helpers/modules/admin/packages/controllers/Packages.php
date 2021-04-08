<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Packages extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-packages") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Package",
                                    "content"   =>  "packages",
                                    "limit"     =>  "1",
                                    "vsp"       =>  $this->config->item("package_type")
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("package_name","Package Name","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_package_name");
                    $this->form_validation->set_rules("package_price","Price","required|xss_clean|trim");
                    $this->form_validation->set_rules("package_type","Type","required");
                    $this->form_validation->set_rules("package_coins","Coins","required|xss_clean|trim");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->package_model->createPackage();
                        if($bt){
                            $this->session->set_flashdata("suc","Created a Package Successfully.");
                            redirect(sitedata("site_admin")."/Packages");
                        }else{
                            $this->session->set_flashdata("err","Not Created a Package.Please try again.");
                            redirect(sitedata("site_admin")."/Packages");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"packageid";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                } 
                $dta["urlvalue"]  =   adminurl('viewPackage/');
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_package_name(){
                $str    =   $this->input->post("package_name");
                $vsp	=   $this->package_model->unique_package_name($str); 
                echo ($vsp)?"false":"true";
        }
        public function check_package_name($str){
                $vsp	=	$this->package_model->unique_package_name($str); 
                if($vsp){
                        $this->form_validation->set_message("check_package_name","Package already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function delete_package(){
                $vsp    =   "0";
                if($this->session->userdata("delete-package") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $params["whereCondition"]   =   "package_id = '".$uri."'";
                    $vue    =   $this->package_model->getPackage($params);
                    if(count($vue) > 0){
                        $bt     =   $this->package_model->delete_package($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_package(){
                if($this->session->userdata("update-package") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["whereCondition"]   =   "package_id = '".$uri."'";
                $vue    =   $this->package_model->getPackage($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Package",
                                "content"   =>  "up_package",
                                "vsp"       =>  $this->config->item("package_type"),
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("package_type","Type","required");
                                $this->form_validation->set_rules("packagename","Package Name","required|xss_clean|trim|max_length[50]");
                                $this->form_validation->set_rules("package_price","Price","required|xss_clean|trim");
                                $this->form_validation->set_rules("package_coins","Coins","required|xss_clean|trim");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->package_model->update_package($uri);
                                        if($bt){
                                            $this->session->set_flashdata("suc","Updated Package Successfully.");
                                            redirect(sitedata("site_admin")."/Packages");
                                        }else{
                                            $this->session->set_flashdata("err","Not Updated Package.Please try again.");
                                            redirect(sitedata("site_admin")."/Packages");
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Package does not exists."); 
                        redirect(sitedata("site_admin")."/Packages");
                }
        }
        public function viewPackage(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"packageid";  
                $totalRec               =   $this->package_model->cntviewPackage($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewPackage');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                if($perpage != "all"){
                    $conditions['limit']    =   $perpage;
                }
                $dta["limit"]           =   $offset+1;
                $dta["urlvalue"]  =   adminurl('viewPackage/');
                $dta["view"]            =   $this->package_model->viewPackage($conditions); 
                $this->load->view("ajax_packages",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-package") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $params["whereCondition"]   =   "package_id = '".$uri."'";
                    $vue    =   $this->package_model->getPackage($params);
                    if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->package_model->activedeactive($uri,$status); 
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