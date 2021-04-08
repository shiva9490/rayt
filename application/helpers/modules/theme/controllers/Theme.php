<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Theme extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function index(){
                $data   =   array(
                    "title"     =>  "Home",
                    "content"   =>  "home",
                    "desc"      =>  "home"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function register(){
                $data   =   array(
                    "title"     =>  "Register",
                    "content"   =>  "register",
                    "desc"  =>  "Register"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function ajax_register(){
                echo $this->api_model->insert_register();
        }
        public function ajax_login(){
                $vsg    =   $this->api_model->checklogin();
                echo $vsg;
        }
        public function login(){
                $data   =   array(
                    "title"     =>  "Login",
                    "content"   =>  "login",
                    "desc"  =>  "Login"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function logout(){
                $this->session->sess_destroy();
                redirect("/");
        }
        public function unique_emailname(){
                echo $this->api_model->unique_emailid("register_email",$this->input->post("emailid"));
        }
        public function unique_mobilenoname(){
                echo $this->api_model->unique_emailid("register_mobile",$this->input->post("mobileno"));
        }
        public function all_tutors(){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  "Tutors from all countries",
                    "content"   =>  "tutors",
                    "ctitle"    =>  str_replace("-","",$uri),
                    "urlvalue"  =>  base_url("viewTutorslist/0/"),
                    "desc"  =>  "for personal tutoring & assignment help. WhatsApp, message & call Economics teachers from 125 countries"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function all_onlinetutors(){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  "Tutors from all countries",
                    "ctitle"    =>  str_replace("-","",$uri),
                    "content"   =>  "tutors",
                    "urlvalue"  =>  base_url("viewTutorslist/1/"),
                    "desc"      =>  "for personal tutoring & assignment help. WhatsApp, message & call Economics teachers from 125 countries"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function viewTutorslist(){
                $conditions =   array();
                $uri        =   $this->uri->segment('2');
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                $locations  =   $this->input->post('locations'); 
                if(!empty($keywords)){
                    $conditions['whereCondition'] =  "concat(subject_alias_name) like '".$keywords."'"; 
                }
                if(!empty($locations)){
                    $conditions['keywords'] = $locations;
                }
                if($uri == 1){
                    $conditions['whereCondition']     =   "lower(tutor_online_teaching) = 'yes'";
                }
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"registerid";  
                if($keywords == ""){
                    $totalRec               =   $this->tutor_model->cntviewTutor($conditions);  
                }else{
                    $totalRec               =   $this->tutor_model->cntviewTutorSubjects($conditions);
                }
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   $dta["urlvalue"]    =   base_url('viewTutorslist/'.$uri.'/');
                $config['total_rows']   =   $totalRec;
                $config['uri_segment']  =   "3"; 
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                if($keywords == ""){
                    $dta["view"]            =   $this->tutor_model->viewTutor($conditions);
                }else{
                    $dta["view"]            =   $this->tutor_model->viewtutorSubjects($conditions);
                }
                $this->load->view("ajax_tutors",$dta);
        }
        public function all_subjectutors(){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  "Tutors from all countries",
                    "content"   =>  "tutors",
                    "ctitle"    =>  ucwords(str_replace("-"," ",$uri)),
                    "urlvalue"  =>  base_url("viewsubjectTutorslist/$uri/"),
                    "desc"      =>  "for personal tutoring & assignment help. WhatsApp, message & call Economics teachers from 125 countries"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function viewsubjectTutorslist(){
                $conditions =   array();
                $uri        =   $this->uri->segment('2');
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }
                $conditions['whereCondition']     =   "concat(subject_alias_name,'-Tutors') like '".$uri."'"; 
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"registerid";  
                $totalRec               =   $this->tutor_model->cntviewTutorSubjects($conditions);
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   $dta["urlvalue"]    =   base_url('viewTutorslist/'.$uri.'/');
                $config['total_rows']   =   $totalRec;
                $config['uri_segment']  =   "3"; 
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->tutor_model->viewtutorSubjects($conditions);
                $this->load->view("ajax_tutors",$dta);
        }
        public function tutorprofile(){
            $regidt     =   $this->uri->segment("2");
            $conditions['whereCondition']     =   "register_unique = '$regidt'";
            $dview       =   $this->tutor_model->getTutor($conditions);
            if(count($dview) == 0){
                $dview["title"]     =    $dview["desc"]      =   "No profile found";
                $dview["register_name"]    =   "No Profile found";
            }else{
                $dview['title'] =   $dview["register_name"].' '.$dview["tutor_speciality"];
                $dview['desc']  =   $dview["register_name"].' '.$dview["tutor_speciality"];
                $dview["register_name"]     =   $dview["register_name"];
            }
            $data   =   array(
                "title"     =>  $dview["title"],
                "content"   =>  "tutor_view",
                "desc"      =>  $dview["desc"],
                "ctitle"    =>  $dview["register_name"],
                "view"      =>  $dview
            );
            $this->load->view("theme/inner_template",$data);
        }
        public function studentprofile(){
            $regidt     =   $this->uri->segment("2");
            $conditions['whereCondition']     =   "student_unique = '$regidt'";
            $dview       =   $this->student_model->getStudent($conditions);
            if(count($dview) == 0){
                $dview["title"]     =    $dview["desc"]      =   "No profile found";
                $dview["register_name"]    =   "No Profile found";
            }else{
                $dview['title'] =   $dview["register_name"];
                $dview['desc']  =   $dview["register_name"];
                $dview["register_name"]     =   $dview["register_name"];
            }
            $data   =   array(
                "title"     =>  $dview["title"],
                "content"   =>  "teaching_view",
                "desc"      =>  $dview["desc"],
                "ctitle"    =>  $dview["register_name"],
                "view"      =>  $dview
            );
            $this->load->view("theme/inner_template",$data);
        }
        public function all_tutors_jobs(){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  "Get online tutor jobs & home tutor jobs",
                    "content"   =>  "teachings",
                    "ctitle"    =>  str_replace("-","",$uri),
                    "urlvalue"  =>  base_url("viewTeaching/0/"),
                    "desc"  =>  "Get online tutor jobs & home tutor jobs"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function viewTeaching(){
                $conditions =   array();
                $uri        =   $this->uri->segment('2');
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }
                if($uri == 1){
                    $conditions['whereCondition']     =   "lower(student_online) = '1'";
                }
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"registerid";  
                $totalRec               =   $this->student_model->cntviewStudent($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   $dta["urlvalue"]    =   base_url('viewTeaching/'.$uri.'/');
                $config['total_rows']   =   $totalRec;
                $config['uri_segment']  =   "3"; 
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->student_model->viewStudent($conditions);
                $this->load->view("teaching_ajax",$dta);
        }
        public function search(){
                $type       =   $this->input->get("type");
                $skills     =   $this->input->get("skills");
                $locations  =   $this->input->get("locations");
                if($type == "Teaching"){
                    $data["content"]    =   "teachings";
                    $data["urlvalue"]   =   base_url("viewsubjectTeachinglist/0/");
                }else{
                    $data["content"]    =   "tutors";
                    $data["urlvalue"]   =   base_url("viewsubjectTutorslist/0/");
                }
                $data["ctitle"]     =   $type. " Jobs";
                $data["desc"]       =   $type. " Jobs";
                $this->load->view("theme/inner_template",$data);
        }
        public function viewsubjectTeachinglist(){
                $conditions =   array();
                $pri        =   $this->uri->segment('2');
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                $uri        =   ($pri != "")?$pri:$this->input->get("skills");
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }
                $tions["columns"]           =   "subject_id";
                $tions['whereCondition']    =   "concat(subject_alias_name,'-Tutor-Jobs') like '".$uri."'"; 
                $smk    =   $this->subject_model->getSubject($tions);
                $subjecid       =   $smk["subject_id"];
                $conditions["whereCondition"]  =   "(FIND_IN_SET('$subjecid',student_subjects) > 0)";
                
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"registerid";  
                $totalRec               =   $this->student_model->cntviewStudent($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
                } 
                $config['base_url']     =   $dta["urlvalue"]    =   base_url('viewTutorslist/'.$uri.'/');
                $config['total_rows']   =   $totalRec;
                $config['uri_segment']  =   "3"; 
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->student_model->viewStudent($conditions);
                $this->load->view("teaching_ajax",$dta);
        }
        public function all_online_jobs(){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  "Tutors from all countries",
                    "ctitle"    =>  str_replace("-","",$uri),
                    "content"   =>  "teachings",
                    "urlvalue"  =>  base_url("viewTeaching/1/"),
                    "desc"      =>  "for personal tutoring & assignment help. WhatsApp, message & call Economics teachers from 125 countries"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function all_subject_jobs(){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  "Tutors from all countries",
                    "content"   =>  "teachings",
                    "ctitle"    =>  ucwords(str_replace("-"," ",$uri)),
                    "urlvalue"  =>  base_url("viewsubjectTeachinglist/$uri/"),
                    "desc"      =>  "for personal tutoring & assignment help. WhatsApp, message & call Economics teachers from 125 countries"
                );
                $this->load->view("theme/inner_template",$data);
        }
        public function __destruct() {
                $this->db->close();
        }
}