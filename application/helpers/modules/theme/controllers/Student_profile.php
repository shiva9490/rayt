<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Student_profile extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function requesttutor(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $oms["whereCondition"]  =   "register_id = '".$regidt."'";
            $data   =   array(
                "title"     =>  "Request Tutor",
                "content"   =>  "requesttutor",
                "ctitle"    =>  "Request Tutor",
                "desc"      =>  "",
                "view"      =>  $this->api_model->getRegister($oms),
                "country"   =>  $this->api_model->countries()
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("student_requirements","Details","required");
                if($this->form_validation->run() == true){
                    $vsp    =   $this->student_model->addrequirement();
                    if($vsp){
                        $this->session->set_flashdata("suc","Profile has been updated successflly");
                        redirect("/My-Posts");
                    }else{
                        $this->session->set_flashdata("war","Profile has been not updated");
                        redirect("/My-Posts");
                    }
                }
            }
            $this->load->view("theme/inner_template",$data);
        }
        public function showsubjects(){
            $data[] =   array();
            $this->load->view("student_showsubjects",$data);
        }
        public function showpreference(){
            $data[] =   array();
            $this->load->view("student_showpreference",$data);
        }
        public function index(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $oms["whereCondition"]  =   "register_id = '".$regidt."'";
            $data   =   array(
                "title"     =>  "Profile",
                "content"   =>  "student_profile",
                "ctitle"    =>  "View Profile",
                "desc"      =>  "",
                "view"      =>  $this->api_model->getRegister($oms),
                "country"   =>  $this->api_model->countries()
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("register_name","Name","required|xss_clean|trim");
                $this->form_validation->set_rules("register_country","Country","required");
                if($this->form_validation->run() == true){
                    $vsp    =   $this->student_model->updateprofile($regidt);
                    if($vsp){
                        $this->session->set_flashdata("suc","Profile has been updated successflly");
                        redirect("/My-Profile");
                    }else{
                        $this->session->set_flashdata("war","Profile has been not updated");
                        redirect("/My-Profile");
                    }
                }
            }
            $this->load->view("theme/inner_template",$data);
        }
        public function balance(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $pms["whereCondition"]  =   "register_id = '".$regidt."'";
            $view   =   $this->api_model->getRegister($pms);
            $regwallet  =   $view["register_wallet"];
            $data   =   array(
                "title"     =>  "Balance",
                "content"   =>  "student_balance",
                "desc"      =>  "",
                "urlvalue"  =>  base_url("Students-View-Balance/"),
                "regwallet" =>  $regwallet
            );
            $this->load->view("theme/inner_template",$data);
        }
        public function viewBalance(){
            $regidt     =   $this->session->userdata("register_id");
            $conditions =   array();
            $page       =   $this->uri->segment('2');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] =   $keywords;
            }  
            $conditions["whereCondition"]   =   "studentbalance_student_id = '".$regidt."'";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"studentbalanceid";  
            $totalRec               =   $this->student_model->cntviewBalance($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   $dta["urlvalue"]    =   base_url('Students-View-Balance/');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']  =   "2"; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $conditions["columns"]  =   "rr.register_name,a.*,rr.register_unique";
            $dta["view"]            =   $this->student_model->viewBalance($conditions);
            $this->load->view("student_ajax_balance",$dta);
        }
        public function checkmessage(){
            $regidt                 =   $this->session->userdata("register_id");
            $data["studentid"]      =   $this->input->post("studentid");
            $this->load->view("student_message",$data);
        }
        public function checkwhatsapp(){
            $regidt                 =   $this->session->userdata("register_id");
            $vsi["columns"]         =     "register_wallet";
            $vsi["whereCondition"]  =     "register_id = '".$regidt."'";
            $ad     =   $this->api_model->getRegister($vsi);
            $rd     =   $ad["register_wallet"];
            $data["coins"]          =   $con        =   sitedata("site_studentcoins");
            $data["studentid"]      =   $stndti     =   $this->input->post("studentid");
            $data["cobna"]          =   "1";
            if($rd > $con){
                $pams["whereCondition"] =   "tutor_id = '".$stndti."'";
                $data["view"]           =    $this->tutor_model->getTutor($pams);
                $sthi   =   $this->student_model->stduentdeductions("Whatsapp",$con);
            }else{
                $data["view"]   =   array();
            }
            $this->load->view("student_contact",$data);
        }
        public function checkcontact(){
            $regidt                 =   $this->session->userdata("register_id");
            $vsi["columns"]         =     "register_wallet";
            $vsi["whereCondition"]  =     "register_id = '".$regidt."'";
            $ad     =   $this->api_model->getRegister($vsi);
            $rd     =   $ad["register_wallet"];
            $data["coins"]          =   $con        =   sitedata("site_studentcoins");
            $data["studentid"]      =   $stndti     =   $this->input->post("studentid");
            $data["cobna"]          =   "1";
            if($rd > $con){
                $pams["whereCondition"] =   "tutor_id = '".$stndti."'";
                $data["view"]           =    $this->tutor_model->getTutor($pams);
                $sthi                   =    $this->student_model->stduentdeductions("Contact",$con);
            }else{
                $data["view"]   =   array();
            }
            $this->load->view("student_contact",$data);
        }
        public function ajaxmessage(){
            $vsg    =   $this->student_model->checkmessage();
            echo $vsg;
        }
        public function transactions(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $data   =   array(
                "title"     =>  "Transactions",
                "content"   =>  "student_transactions",
                "desc"      =>  "",
                "urlvalue"  =>  base_url("Students-View-Transactions/")
            );
            $this->load->view("theme/inner_template",$data);
        }
        public function viewTransactions(){
            $regidt     =   $this->session->userdata("register_id");
            $conditions =   array();
            $page       =   $this->uri->segment('2');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $conditions["whereCondition"]   =   "register_id = '".$regidt."'";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"transid";  
            $totalRec       =   $this->tutor_model->cntviewStudentTransactions($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   $dta["urlvalue"]    =   base_url('Students-View-Transactions/');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']  =   "2"; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != "all"){
                $conditions['limit']    =   $perpage;
            }
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =   $this->tutor_model->viewStudentTransactions($conditions);
            $this->load->view("student_ajax_transaction",$dta);
        }
         public function myposts(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $pms["whereCondition"]  =   "register_id = '".$regidt."'";
            $view   =   $this->api_model->getRegister($pms);
            $regwallet  =   $view["register_wallet"];
            $data   =   array(
                "title"     =>  "Balance",
                "content"   =>  "student_posts",
                "desc"      =>  "",
                "urlvalue"  =>  base_url("Students-View-Posts/"),
                "regwallet" =>  $regwallet
            );
            $this->load->view("theme/inner_template",$data);
        }
        public function viewPosts(){
            $regidt     =   $this->session->userdata("register_id");
            $conditions =   array();
            $page       =   $this->uri->segment('2');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] =   $keywords;
            }  
            $conditions["whereCondition"]   =   "register_id = '".$regidt."'";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"studentid";  
            $totalRec               =   $this->student_model->cntviewStudent($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   $dta["urlvalue"]    =   base_url('Students-View-Posts/');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']  =   "2"; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =   $this->student_model->viewStudent($conditions);
            $this->load->view("student_ajax_posts",$dta);
        }
}