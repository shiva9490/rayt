<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tutor_profile extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function viewprofile(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $vsi["whereCondition"]  =     "register_id = '".$regidt."'";
            $ad     =   $this->tutor_model->getTutor($vsi);
            $data   =   array(
                "title"     =>  "Profile",
                "content"   =>  "tutor_viewprofile",
                "ctitle"    =>  "View Profile",
                "desc"      =>  "",
                "view"      =>  $ad,
                "country"   =>  $this->api_model->countries(),
                "opportunities" => $this->api_model->opportunities(),
                "tutor_fee_charge" =>  $this->api_model->budgets()
            );
            if($this->input->post("saveregister")){
                $this->form_validation->set_rules("register_name","Name","required|xss_clean|trim");
                $this->form_validation->set_rules("register_country","Country","required");
                if($this->form_validation->run() == true){
                    $vsp    =   $this->student_model->updateprofile($regidt);
                    if($vsp){
                        $this->session->set_flashdata("suc","Profile has been updated successflly");
                        redirect("/View-Profile");
                    }else{
                        $this->session->set_flashdata("war","Profile has been not updated");
                        redirect("/View-Profile");
                    }
                }
            }
            if($this->input->post("saveaddress")){
                $this->form_validation->set_rules("tutor_street","Street","required|xss_clean|trim");
                $this->form_validation->set_rules("tutor_state","State","required");
                if($this->form_validation->run() == true){
                    $vsp    =   $this->tutor_model->updateaddress();
                    $asp    =   $this->tutor_model->updateprofile();
                    if($vsp || $asp){
                        $this->session->set_flashdata("suc","Address has been updated successflly");
                        redirect("/View-Profile");
                    }else{
                        $this->session->set_flashdata("war","Address has been not updated");
                        redirect("/View-Profile");
                    }
                }
            }
            if($this->input->post("saveteaching")){
                $this->form_validation->set_rules("tutor_fee_charge","Fee Charge","required");
                $this->form_validation->set_rules("tutor_minimum_fee","Minimum Fee","required");
                $this->form_validation->set_rules("tutor_maximum_fee","Maximum Fee","required");
                if($this->form_validation->run() == true){
                    $vsp    =   $this->tutor_model->updateteachingdetails();
                    if($vsp){
                        $this->session->set_flashdata("suc","Teaching Details has been updated successflly");
                        redirect("/View-Profile");
                    }else{
                        $this->session->set_flashdata("war","Teaching Details has been not updated");
                        redirect("/View-Profile");
                    }
                }
            }
            $this->load->view("theme/inner_template",$data);
        }
        public function checkmessage(){
            $regidt                 =   $this->session->userdata("register_id");
            $data["studentid"]      =   $this->input->post("studentid");
            $this->load->view("tutor_message",$data);
        }
        public function checkwhatsapp(){
            $regidt                 =   $this->session->userdata("register_id");
            $vsi["columns"]         =     "register_wallet";
            $vsi["whereCondition"]  =     "register_id = '".$regidt."'";
            $ad     =   $this->api_model->getRegister($vsi);
            $rd     =   $ad["register_wallet"];
            $data["coins"]  =   $con    =   sitedata("site_teachercoins");
            $data["studentid"]      =   $stndti     =   $this->input->post("studentid");
            $data["cobna"]          =   "1";
            if($rd > $con){
                $pams["whereCondition"] =   "student_id = '".$stndti."'";
                $data["view"]           =    $this->student_model->getStudent($pams);
                $sthi   =   $this->tutor_model->deductions("Whatsapp",$con);
            }else{
                $data["view"]   =   array();
            }
            $this->load->view("tutor_contact",$data);
        }
        public function checkcontact(){
            $regidt                 =   $this->session->userdata("register_id");
            $vsi["columns"]         =     "register_wallet";
            $vsi["whereCondition"]  =     "register_id = '".$regidt."'";
            $ad     =   $this->api_model->getRegister($vsi);
            $rd     =   $ad["register_wallet"];
            $con    =   sitedata("site_teachercoins");
            $data["studentid"]      =   $stndti     =   $this->input->post("studentid");
            $data["cobna"]          =   "1";
            if($rd > $con){
                $pams["whereCondition"] =   "student_id = '".$stndti."'";
                $data["view"]           =    $this->student_model->getStudent($pams);
                $sthi                   =    $this->tutor_model->deductions("Contact",$con);
            }else{
                $data["view"]   =   array();
            }
            $this->load->view("tutor_contact",$data);
        }
        public function ajaxmessage(){
            $vsg    =   $this->tutor_model->checkmessage();
            echo $vsg;
        }
        public function profile(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $data   =   array(
                "title"     =>  "Profile",
                "content"   =>  "tutor_profile",
                "desc"      =>  ""
            );
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
                "content"   =>  "tutor_balance",
                "desc"      =>  "",
                "urlvalue"  =>  base_url("Tutors-View-Balance/"),
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
            $conditions["whereCondition"]   =   "tutorbalance_tutor_id = '".$regidt."'";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"tutorbalanceid";  
            $totalRec               =   $this->tutor_model->cntviewBalance($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   $dta["urlvalue"]    =   base_url('Tutors-View-Balance/');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']  =   "2"; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =   $this->tutor_model->viewBalance($conditions);
            $this->load->view("tutor_ajax_balance",$dta);
        }
        public function transactions(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $data   =   array(
                "title"     =>  "Transactions",
                "content"   =>  "tutor_transactions",
                "desc"      =>  "",
                "urlvalue"  =>  base_url("Tutors-View-Transactions/")
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
            $totalRec       =   $this->tutor_model->cntviewTransactions($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   $dta["urlvalue"]    =   base_url('Tutors-View-Balance/');
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
            $dta["view"]            =   $this->tutor_model->viewTransactions($conditions);
            $this->load->view("tutor_ajax_transaction",$dta);
        }
        public function  viewsubjects(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $data   =   array(
                "title"     =>  "Subjects",
                "content"   =>  "tutor_subjects",
                "desc"      =>  "",
                "limit"     =>  '1',
                "ctitle"    =>  "My Subjects",
                "vcu"       =>  $this->api_model->levelsvalues()
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("subjectid","Subject","required");
                $this->form_validation->set_rules("formlevel","From Level","required");
                $this->form_validation->set_rules("tolevel","To Level","required");
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->tutor_model->insertsubject();
                    if($ins){
                        $this->session->set_flashdata("suc","Added Subject successfully");
                    }else{
                        $this->session->set_flashdata("err","Not added any subject");
                    }
                    redirect('/View-Subjects');
                }
            }
            $psm["columns"]         =   "tutorsubject_id,subject_alias_name,subject_name,fdr.level_name as tolevel,fr.level_name as fromlevel";
            $psm["tipoOrderby"]     =   "tutorsubjectid";
            $psm["order_by"]        =   "DESC";
            $psm["whereCondition"]  =   "(register_id = '".$regidt."')";
            $vsp                    =   $this->tutor_model->viewtutorSubjects($psm); 
            $data["view"]   =   $vsp;
            $this->load->view("theme/inner_template",$data);
        }
        public function deletetutorsubect(){
            $tutorsubject_id    =   $this->input->post("reid");
            $dvso               =   $this->tutor_model->deletesubjects($tutorsubject_id);
            echo $dvso;
        }
        public function deletetutoreducation(){
            $tutorsubject_id    =   $this->input->post("reid");
            $dvso               =   $this->tutor_model->deleteorganization($tutorsubject_id);
            echo $dvso;
        }
        public function deleteteaching(){
            $tutorsubject_id    =   $this->input->post("reid");
            $dvso               =   $this->tutor_model->deleteteaching($tutorsubject_id);
            echo $dvso;
        }
        public function  vieweducation(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $data   =   array(
                "title"     =>  "Education",
                "content"   =>  "tutor_education",
                "desc"      =>  "",
                "limit"     =>  1,
                "ctitle"    =>  "My Education",
                "insit"     =>  $this->api_model->organization(),
                "degree"        =>  $this->api_model->degree_type(),
                "association"   =>  $this->api_model->associations(),
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("experince_institution","Institution","required");
                $this->form_validation->set_rules("experince_degree_type","Degree Type","required");
                $this->form_validation->set_rules("experince_start_year","Start Year","required");
                $this->form_validation->set_rules("experince_end_year","End Year","required"); 
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->tutor_model->addorganization();
                    if($ins){
                        $this->session->set_flashdata("suc","Added Education successfully");
                    }else{
                        $this->session->set_flashdata("err","Not added any Education");
                    }
                    redirect('/View-Education');
                }
            }
            $psm["columns"]         =   "experince_id,institution_name,degree_name,experince_start_year,experince_end_year,experince_assoication,experince_speciality,experince_score";
            $psm["whereCondition"]  =   "(register_id = '".$regidt."')";
            $vsp                    =   $this->tutor_model->viewtutorEducation($psm); 
            $data["view"]       =   $vsp;
            $this->load->view("theme/inner_template",$data);
        }
        public function  viewexperience(){
            $regidt     =   $this->session->userdata("register_id");
            if($regidt == ""){
                redirect("/");
            }
            $data   =   array(
                "title"     =>  "Experience",
                "content"   =>  "tutor_experience",
                "desc"      =>  "",
                "limit"     =>  1,
                "ctitle"    =>  "My Education",
                "insit"     =>  $this->api_model->organization(),
                "degree"        =>  $this->api_model->degree_type(),
                "association"   =>  $this->api_model->associations(),
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("teaching_organization","Organization","required");
                $this->form_validation->set_rules("teaching_start_year","Start Year","required");
                $this->form_validation->set_rules("teaching_end_year","End Year","required"); 
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->tutor_model->addexperience();
                    if($ins){
                        $this->session->set_flashdata("suc","Added Experience successfully");
                    }else{
                        $this->session->set_flashdata("err","Not added any Experience");
                    }
                    redirect('/View-Experience');
                }
            }
            $psm["columns"]         =   "a.*";
            $psm["whereCondition"]  =   "(register_id = '".$regidt."')";
            $vsp                    =   $this->tutor_model->viewtutorTeachexperience($psm); 
            $data["view"]       =   $vsp;
            $this->load->view("theme/inner_template",$data);
        }
        public function __destruct() {
                $this->db->close();
        }
}