<?php
class Common extends CI_Controller{
        public function pagenotfound(){
                $dta    =   array(
                    "title"     =>  "Page Not Found",
                    "content"   =>  "pagenotfound"
                );
                $this->load->view("admin/outer_template",$dta);
        }
        public function change_password(){
                if($this->session->userdata("login_id") == ""){
                    redirect(sitedata("site_admin")."/");
                }
                $dta    =   array(
                    "title"     =>  "Change Password",
                    "content"   =>  "changepassword"
                );
                $login_id   =   $this->session->userdata("loginid");
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("new_password","New Password","required|xss_clean|trim|min_length[3]|max_length[50]");
                    $this->form_validation->set_rules("con_password","Confirm Password","required|xss_clean|trim|min_length[3]|max_length[50]|matches[new_password]");
                    if($this->form_validation->run() == true){
                        $ins    =   $this->login_model->updatePassword($login_id);
                        if($ins){
                            $this->session->set_flashdata("suc","Password has been changed successfully"); 
                        }else{
                            $this->session->set_flashdata("err","Password has been not changed.Please try again"); 
                        }
                        redirect(sitedata("site_admin")."/Change-Password");
                    }
                }
                $this->load->view("admin/inner_template",$dta);
        }
        public function countryname(){
            $erm    =   $this->input->get("term");
            $params['whereCondition']  =   "country_name like '%".$erm."%'"; 
            $params['tipoOrderby']  =   "country_name"; 
            $params['order_by']     =   "ASC";
            $djon    =  array();
            $adjon   =  $this->common_model->viewCountries($params);
            foreach($adjon as $ky => $fer){
                $djon[$ky]["label"]   =   $fer->countryid;
                $djon[$ky]["value"]   =   $fer->country_name;
            }
            echo json_encode($djon);
        }
        public function ajaxsubjects(){
            $erm    =   $this->input->post("keywords");
            $params['whereCondition']   =   "subject_name like '%".$erm."%'"; 
            $params['tipoOrderby']      =   "subject_name,subject_id,subject_alias_name"; 
            $params['order_by']         =   "ASC";
            $djon    =  array();
            $adjon   =  $this->subject_model->viewSubject($params);
            foreach($adjon as $ky => $fer){
                $djon[$ky]["label"]   =   ucwords($fer->subject_name);
                $djon[$ky]["value"]   =   $fer->subject_alias_name;
                $djon[$ky]["subjecid"]   =   $fer->subject_id;
            }
            echo json_encode($djon);
        }
        public function approveemails(){
            $uri    =   $this->uri->segment("3");
            echo $this->tutor_model->approveemails($uri);
        }
        public function tutorprofile(){
            if($this->session->userdata("create-profile") != "1"){
                redirect(sitedata("site_admin")."/Dashboard");
            }
            $dta    =   array(
                "title"     =>  "Create Profile",
                "content"   =>  "create_profile"
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("fullname","Name","required|xss_clean|trim|min_length[3]|max_length[50]");
                if($this->input->post("emailid") != ""){
                    $this->form_validation->set_rules("emailid","Email Id","required|xss_clean|trim|valid_email|callback_check_email");
                }
                if($this->input->post("mobileno") != ""){
                    $this->form_validation->set_rules("mobileno","Mobile No.","callback_check_mobileno");
                }
                if($this->form_validation->run() == true){
                    $ins    =   $this->api_model->insertreg();
                    if($ins){
                        $this->session->set_flashdata("suc","Add Profile successfully"); 
                    }else{
                        $this->session->set_flashdata("err","Profile has been not added.Please try again"); 
                    }
                    redirect(sitedata("site_admin")."/Create-Profile");
                }
            }
            $this->load->view("admin/inner_template",$dta);
        }
        public function check_email($str){
                $vsp	=	$this->api_model->unique_emailid("register_email",$str); 
                if($vsp == "false"){
                        $this->form_validation->set_message("check_email","Email Id already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function check_mobileno($str){
                $vsp	=	$this->api_model->unique_emailid("register_mobile",$str); 
                if($vsp == "false"){
                        $this->form_validation->set_message("check_mobileno","Mobile No. already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function addpost(){
            if($this->session->userdata("add-post") != "1"){
                redirect(sitedata("site_admin")."/Dashboard");
            }
            $dta    =   array(
                "title"     =>  "Add Post",
                "content"   =>  "add_post"
            );
            if($this->input->post("submit")){
                // $this->form_validation->set_rules("student_location","Location","required");
                $this->form_validation->set_rules("student_subjects[]","Subjects","required");
                if($this->form_validation->run() == true){
                    $ins    =   $this->student_model->addrequirement();
                    if($ins){
                        $this->session->set_flashdata("suc","Added Post requirement successfully"); 
                    }else{
                        $this->session->set_flashdata("err","Post requirement has been not added.Please try again"); 
                    }
                    redirect(sitedata("site_admin")."/Add-Post");
                }
            }
            $this->load->view("admin/inner_template",$dta);
        }
        public function ajaxdegreetype(){
            $vsp    =   $this->api_model->degree_type();
            $vsvd   =   '<option value="">Select Specialization</option>';
            if(count($vsp)){
                foreach ($vsp as $ve){
                    $vsvd   .=  '<option value="'.$ve->degree_id.'">'.$ve->degree_name.'</option>';
                }
            }
            echo $vsvd;
        }
        public function __destruct(){
                $this->db->close();
        }
}