<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Id_proof extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-id-proof") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "ID Proof",
                                    "content"   =>  "id_proof",
                                    "limit"     =>  "1"
                            ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("idproof_name","ID Proof","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_id_proof_name");
                    if($this->form_validation->run() == TRUE){
                        $bt     =   $this->id_proof_model->createIdproof();
                        if($bt){
                            $this->session->set_flashdata("suc","Created a ID Proof Successfully.");
                            redirect(sitedata("site_admin")."/ID-Proof");
                        }else{
                            $this->session->set_flashdata("err","Not Created a ID Proof.Please try again.");
                            redirect(sitedata("site_admin")."/ID-Proof");
                        }
                    }
                }  
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"idproofid";  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $orderby;
                    $dta['tipoOrderby']    =   $tipoOrderby; 
                } 
                $dta["urlvalue"]    =   adminurl("viewProof/");
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_proof_name(){
                $str    =   $this->input->post("idproof_name");
                $vsp	=   $this->id_proof_model->unique_id_name($str); 
                echo ($vsp)?"false":"true";
        }
        public function check_id_proof_name($str){
                $vsp	=	$this->id_proof_model->unique_id_name($str); 
                if($vsp){
                        $this->form_validation->set_message("check_id_proof_name","Role Name already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function delete_id_proof(){
                $vsp    =   "0";
                if($this->session->userdata("delete-id-proof") != '1'){
                    $vsp    =   "0";
                }else {
                    $uri    =   $this->uri->segment("3");
                    $params["whereCondition"]   =   "idproof_id = '".$uri."'";
                    $vue    =   $this->id_proof_model->getIdproof($params);
                    if(count($vue) > 0){
                        $bt     =   $this->id_proof_model->delete_id_proof($uri); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function update_id_proof(){
                if($this->session->userdata("update-id-proof") != '1'){
                        redirect(sitedata("site_admin")."/Dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["whereCondition"]   =   "idproof_id = '".$uri."'";
                $vue    =   $this->id_proof_model->getIdproof($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update ID Proof",
                                "content"   =>  "up_idproof",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                            $this->form_validation->set_rules("proof_name","Role Name","required|xss_clean|trim|max_length[50]");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->id_proof_model->update_idproof($uri);
                                if($bt){
                                    $this->session->set_flashdata("suc","Updated ID Proof Successfully.");
                                    redirect(sitedata("site_admin")."/ID-Proof");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated ID Proof.Please try again.");
                                    redirect(sitedata("site_admin")."/ID-Proof");
                                }
                            }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","ID Proof does not exists."); 
                        redirect(sitedata("site_admin")."/ID-Proof");
                }
        }
        public function viewProof(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"idproofid";  
                $totalRec               =   $this->id_proof_model->cntviewIdproof($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   adminurl('viewProof');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                if($perpage != "all"){
                    $conditions['limit']    =   $perpage;
                }
                $dta["limit"]           =   $offset+1;
                $dta["urlvalue"]        =   adminurl("viewProof/");
                $dta["view"]            =   $this->id_proof_model->viewIdproof($conditions); 
                $this->load->view("ajax_idproof",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-id-proof") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $params["whereCondition"]   =   "idproof_id = '".$uri."'";
                    $vue    =   $this->id_proof_model->getIdproof($params);
                    if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->id_proof_model->activedeactive($uri,$status); 
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