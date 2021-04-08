<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Studentslist extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-students") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
            $dta    =   array( 
                                "title"     =>  "Students",
                                "content"   =>  "admin/allpages",
                                "vitil"     =>  "",
                                "limit"     =>  "1"
                        ); 
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"registerid";  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $orderby;
                $dta['tipoOrderby']    =   $tipoOrderby; 
            } 
            $dta["urlvalue"]        =   adminurl('viewStudent/');
            $this->load->view("admin/inner_template",$dta); 
        }
        public function viewStudent(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $conditions["whereCondition"]   =   "register_usertype = 'Student'";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"registerid";  
            $totalRec               =   $this->api_model->cntviewRegister($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   adminurl('viewStudent');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != "all"){
                $conditions['limit']    =   $perpage;
            }
            $dta["limit"]           =   $offset+1;
            $dta["urlvalue"]        =   adminurl('viewStudent/');
            $dta["view"]            =   $this->api_model->viewRegister($conditions); 
            $this->load->view("ajax_student",$dta);
        }
        public function delete_student(){
                $vsp    =   "0";
                if($this->session->userdata("delete-student") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $psm['whereCondition']  =   "register_id = '".$uri."'";
                    $vue    =   $this->api_model->getRegister($psm);
                    if(count($vue) > 0){
                        $bt     =   $this->student_model->delete_student($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-student") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $psm['whereCondition']  =   "register_id = '".$uri."'";
                    $vue    =   $this->api_model->getRegister($psm);
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