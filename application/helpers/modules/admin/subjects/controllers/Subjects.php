<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Subjects extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-subjects") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Subject",
                                    "content"   =>  "subjects",
                                    "limit"     =>  "1"
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("subject_name","Subject","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_subject_name");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->subject_model->createSubject();
                        if($bt){
                            $this->session->set_flashdata("suc","Created a Subject Successfully.");
                            redirect(sitedata("site_admin")."/Subjects");
                        }else{
                            $this->session->set_flashdata("err","Not Created a Subject.Please try again.");
                            redirect(sitedata("site_admin")."/Subjects");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"subjectid";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                }
                $dta["urlvalue"]    =   adminurl('viewSubject/');
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_subject_name(){
                $str    =   $this->input->post("subject_name");
                $vsp	=   $this->subject_model->unique_subject_name($str); 
                echo ($vsp)?"false":"true";
        }
        public function check_subject_name($str){
                $vsp	=	$this->subject_model->unique_subject_name($str); 
                if($vsp){
                        $this->form_validation->set_message("check_subject_name","Subject Name already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function delete_subject(){
                $vsp    =   "0";
                if($this->session->userdata("delete-subject") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $params["whereCondition"]   =   "subject_id = '".$uri."'";
                    $vue    =   $this->subject_model->getSubject($params);
                    if(count($vue) > 0){
                        $bt     =   $this->subject_model->delete_subject($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_subject(){
                if($this->session->userdata("update-subject") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["whereCondition"]   =   "subject_id = '".$uri."'";
                $vue    =   $this->subject_model->getSubject($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Subject",
                                "content"   =>  "update_subject",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("subjectname","Subject Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->subject_model->update_subject($uri);
                                        if($bt){
                                            $this->session->set_flashdata("suc","Updated Subject Successfully.");
                                            redirect(sitedata("site_admin")."/Subjects");
                                        }else{
                                            $this->session->set_flashdata("err","Not Updated Subject.Please try again.");
                                            redirect(sitedata("site_admin")."/Subjects");
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Subject does not exists."); 
                        redirect(sitedata("site_admin")."/Subjects");
                }
        }
        public function viewSubject(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"subjectid";  
                $totalRec               =   $this->subject_model->cntviewSubject($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewSubject');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                if($perpage != ""){
                    $conditions['limit']    =   $perpage;
                }
                $dta["urlvalue"]    =   adminurl('viewSubject/');
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->subject_model->viewSubject($conditions); 
                $this->load->view("ajax_subject",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-subject") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $params["whereCondition"]   =   "subject_id = '".$uri."'";
                    $vue    =   $this->subject_model->getSubject($params);
                    if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->subject_model->activedeactive($uri,$status); 
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