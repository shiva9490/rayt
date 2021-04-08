<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Organization extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-institution") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Institutions",
                                    "content"   =>  "organization_type",
                                    "limit"     =>  "1"
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("organization_name","Institution","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_organization_name");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->organization_model->createOrganization();
                        if($bt){
                            $this->session->set_flashdata("suc","Created a Institution Successfully.");
                            redirect(sitedata("site_admin")."/Institution");
                        }else{
                            $this->session->set_flashdata("err","Not Created a Organization.Please try again.");
                            redirect(sitedata("site_admin")."/Institution");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"institutionid";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                } 
                $dta["urlvalue"]  =   adminurl('viewOrganization/');
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_organization_name(){
                $str    =   $this->input->post("organization_name");
                $vsp	=   $this->organization_model->unique_organization_name($str); 
                echo ($vsp)?"false":"true";
        }
        public function check_organization_name($str){
                $vsp	=	$this->organization_model->unique_organization_name($str); 
                if($vsp){
                        $this->form_validation->set_message("check_organization_name","Institution Name already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function delete_organization(){
                $vsp    =   "0";
                if($this->session->userdata("delete-institution") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $params["whereCondition"]   =   "institution_id = '".$uri."'";
                    $vue    =   $this->organization_model->getOrganization($params);
                    if(count($vue) > 0){
                        $bt     =   $this->organization_model->delete_organization($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_organization(){
                if($this->session->userdata("update-institution") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["whereCondition"]   =   "institution_id = '".$uri."'";
                $vue    =   $this->organization_model->getOrganization($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Institution",
                                "content"   =>  "up_organization",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("institutionname","Institution Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->organization_model->update_organization($uri);
                                        if($bt){
                                            $this->session->set_flashdata("suc","Updated Institution Successfully.");
                                            redirect(sitedata("site_admin")."/Institution");
                                        }else{
                                            $this->session->set_flashdata("err","Not Updated Institution.Please try again.");
                                            redirect(sitedata("site_admin")."/Institution");
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Institution does not exists."); 
                        redirect(sitedata("site_admin")."/Institutions");
                }
        }
        public function viewOrganization(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"institutionid";  
                $totalRec               =   $this->organization_model->cntviewOrganization($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewOrganization');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                if($perpage != "all"){
                    $conditions['limit']    =   $perpage;
                }
                $dta["urlvalue"]  =   adminurl('viewOrganization/');
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->organization_model->viewOrganization($conditions); 
                $this->load->view("ajax_organization",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-institution") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $params["whereCondition"]   =   "institution_id = '".$uri."'";
                    $vue    =   $this->organization_model->getOrganization($params);
                    if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->organization_model->activedeactive($uri,$status); 
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