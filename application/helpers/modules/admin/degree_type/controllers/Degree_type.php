<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Degree_type extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-degree-type") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Degree Type",
                                    "content"   =>  "degree_type",
                                    "limit"     =>  "1"
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("degree_name","Degree Type","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_degree_name");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->degree_model->createDegree();
                        if($bt){
                            $this->session->set_flashdata("suc","Created a Degree Type Successfully.");
                            redirect(sitedata("site_admin")."/Degree-Type");
                        }else{
                            $this->session->set_flashdata("err","Not Created a Degree Type.Please try again.");
                            redirect(sitedata("site_admin")."/Degree-Type");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"degreeid";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                } 
                $dta["urlvalue"]           =   adminurl('viewDegree/');
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_degree_name(){
                $str    =   $this->input->post("degree_name");
                $vsp	=   $this->degree_model->unique_degree_name($str); 
                echo ($vsp)?"false":"true";
        }
        public function check_degree_name($str){
                $vsp	=	$this->degree_model->unique_degree_name($str); 
                if($vsp){
                        $this->form_validation->set_message("check_degree_name","Degree type already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function delete_degree(){
                $vsp    =   "0";
                if($this->session->userdata("delete-degree-type") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $params["whereCondition"]   =   "degree_id = '".$uri."'";
                    $vue    =   $this->degree_model->getDegree($params);
                    if(count($vue) > 0){
                        $bt     =   $this->degree_model->delete_degree($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_degree(){
                if($this->session->userdata("update-degree-type") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["whereCondition"]   =   "degree_id = '".$uri."'";
                $vue    =   $this->degree_model->getDegree($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Degree",
                                "content"   =>  "up_degree",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("degreename","Degee Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->degree_model->update_degree($uri);
                                        if($bt){
                                            $this->session->set_flashdata("suc","Updated Degree Successfully.");
                                            redirect(sitedata("site_admin")."/Degree-Type");
                                        }else{
                                            $this->session->set_flashdata("err","Not Updated Degree.Please try again.");
                                            redirect(sitedata("site_admin")."/Degree-Type");
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Degree type does not exists."); 
                        redirect(sitedata("site_admin")."/Degree-Type");
                }
        }
        public function viewDegree(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"degreeid";  
                $totalRec               =   $this->degree_model->cntviewDegree($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewDegree');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                if($perpage != "all"){
                    $conditions['limit']    =   $perpage;
                }
                $dta["urlvalue"]           =   adminurl('viewDegree/');
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->degree_model->viewDegree($conditions); 
                $this->load->view("ajax_degree",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-degree-type") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $params["whereCondition"]   =   "degree_id = '".$uri."'";
                    $vue    =   $this->degree_model->getDegree($params);
                    if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->degree_model->activedeactive($uri,$status); 
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