<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Opportunities extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-opportunity") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Opportunity",
                                    "content"   =>  "opportunity",
                                    "limit"     =>  "1"
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("opportunity_name","Opportunity","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_opportunity_name");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->opportunity_model->createOpportunity();
                        if($bt){
                            $this->session->set_flashdata("suc","Created a Opportunity Successfully.");
                            redirect(sitedata("site_admin")."/Opportunities");
                        }else{
                            $this->session->set_flashdata("err","Not Created a Opportunity.Please try again.");
                            redirect(sitedata("site_admin")."/Opportunities");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"opportunityid";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                } 
                $dta["urlvalue"]        =   adminurl('viewOpportunity/');
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_proof_name(){
                $str    =   $this->input->post("opportunity_name");
                $vsp	=   $this->opportunity_model->unique_id_name($str); 
                echo ($vsp)?"false":"true";
        }
        public function check_opportunity_name($str){
                $vsp	=	$this->opportunity_model->unique_id_name($str); 
                if($vsp){
                        $this->form_validation->set_message("check_opportunity_name","Role Name already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function delete_opportunity(){
                $vsp    =   "0";
                if($this->session->userdata("delete-opportunity") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $params["whereCondition"]   =   "opportunity_id = '".$uri."'";
                    $vue    =   $this->opportunity_model->getOpportunity($params);
                    if(count($vue) > 0){
                        $bt     =   $this->opportunity_model->delete_opportunity($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_opportunity(){
                if($this->session->userdata("update-opportunity") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["whereCondition"]   =   "opportunity_id = '".$uri."'";
                $vue    =   $this->opportunity_model->getOpportunity($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Opportunity",
                                "content"   =>  "up_opportunity",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                            $this->form_validation->set_rules("opportunityname","Opportunity Name","required|xss_clean|trim|max_length[50]");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->opportunity_model->update_opportunity($uri);
                                if($bt){
                                    $this->session->set_flashdata("suc","Updated Opportunity Successfully.");
                                    redirect(sitedata("site_admin")."/Opportunities");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated Opportunity.Please try again.");
                                    redirect(sitedata("site_admin")."/Opportunities");
                                }
                            }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Opportunity does not exists."); 
                        redirect(sitedata("site_admin")."/Opportunities");
                }
        }
        public function viewOpportunity(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"opportunityid";  
                $totalRec               =   $this->opportunity_model->cntviewOpportunity($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewOpportunity');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                if($perpage != "all"){
                    $conditions['start']    =   $offset;
                    $conditions['limit']    =   $perpage;
                }
                $dta["limit"]           =   $offset+1;
                $dta["urlvalue"]        =   adminurl('viewOpportunity/');
                $dta["view"]            =   $this->opportunity_model->viewOpportunity($conditions); 
                $this->load->view("ajax_opportunity",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-opportunity") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $params["whereCondition"]   =   "opportunity_id = '".$uri."'";
                    $vue    =   $this->opportunity_model->getOpportunity($params);
                    if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->opportunity_model->activedeactive($uri,$status); 
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