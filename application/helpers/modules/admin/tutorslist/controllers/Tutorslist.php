<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tutorslist extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-subjects") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
            $dta    =   array( 
                                "title"     =>  "Tutors",
                                "content"   =>  "admin/allpages",
                                "vitil" =>  "",
                                "limit"     =>  "1"
                        ); 
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"registerid";  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $orderby;
                $dta['tipoOrderby']    =   $tipoOrderby; 
            } 
            $dta["urlvalue"]    = adminurl("viewTutor/");
            $this->load->view("admin/inner_template",$dta); 
        }
        public function viewTutor(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"registerid";  
            $totalRec               =   $this->tutor_model->cntviewTutor($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   adminurl('viewTutor');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != 'all'){
                $conditions['limit']    =   $perpage;
            }
            $dta["limit"]           =   $offset+1;
            $dta["urlvalue"]        =   adminurl("viewTutor/");
            $dta["view"]            =   $this->tutor_model->viewTutor($conditions); 
            $this->load->view("ajax_tutors",$dta);
        }
        public function delete_tutor(){
            $vsp    =   "0";
            if($this->session->userdata("delete-tutor") != '1'){
                $vsp    =   "0";
            }else {
                $uri    =   $this->uri->segment("3");
                $params["whereCondition"]   =   "register_id = '".$uri."'";
                $vue    =   $this->api_model->getRegister($params);
                if(count($vue) > 0){
                    $bt     =   $this->tutor_model->delete_tutor($uri); 
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