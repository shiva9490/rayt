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
        public function __destruct(){
                $this->db->close();
        }
}