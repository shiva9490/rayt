<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Login extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function index(){
            if($this->session->userdata("login_id") != ''){
                redirect(sitedata("site_admin")."/Dashboard"); 
            }
            $darta  =   array(
                'title'     =>  "Login",
                "content"   =>  "login"
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("username","Email ID /Username","xss_clean|required|callback_checkemail");
                $this->form_validation->set_rules("password","Password","required|xss_clean|xss_clean|min_length[2]|max_length[50]");
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->login_model->checkLogin();
                    if($ins){
                        $this->session->set_flashdata("suc","Welcome to ".$this->session->userdata("login_name"));
                        redirect(sitedata("site_admin")."/Dashboard");
                    }else{
                        $this->session->set_flashdata("err","Login failed");
                        redirect(sitedata("site_admin")."/");
                    }
                }
            }
            $this->load->view("admin/outer_template",$darta);
        }
        public function checkusernameexist(){
                $emailid    =   $this->input->post("username");
                $vsap   =   $this->login_model->checkvalueemail($emailid);
                echo ($vsap)?"true":"false";
        }
        public function forgotpassword(){
            $darta  =   array(
                'title'     =>  "Forgot Password",
                "content"   =>  "forgotpassword"
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("email_user","Email ID Or User name","xss_clean|required|callback_checkemail"); 
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->login_model->sendpassword();
                    if($ins){
                        $this->session->set_flashdata("suc","A password has been sent to registered mail.Please check them and login.");
                        redirect(sitedata("site_admin")."/");
                    }else{
                        $this->session->set_flashdata("err","Password has been not sent to the registered mail.");
                        redirect(sitedata("site_admin")."/Forgot-Password");
                    }
                }
            }
            $this->load->view("admin/outer_template",$darta);
        }
        public function checkemail($str){
            $vsp    =   $this->login_model->checkvalueemail($str); 
            if(!$vsp){
                $this->form_validation->set_message("checkemail","Emaild ID /Username does not exists.");
                return FALSE;
            }	 
            return TRUE; 	
        }	
        public function lockscreen(){
             $uri = $this->session->userdata("login_id");
            if($uri != ''){
            $data  =   array(
                'title'     =>  "Lock Screen",
                "content"   =>  "lock_sccreen"
            );      
                if($this->input->post("submit")){  
                    $this->form_validation->set_rules("password","Password","xss_clean|required"); 
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->login_model->checkvaluepassword();
                        echo   $ins ;
                        if($ins){
                            $this->session->set_flashdata("suc","Welcome Back");
                            redirect(sitedata("site_admin")."/");
                        }else{
                            $this->session->set_flashdata("err","Your Password Doesn't Match");
                            redirect(sitedata("site_admin")."/Lock-Screen");
                        }
                    }
                }            
            $this->load->view("admin/outer_template",$data);
            }else{
            redirect(sitedata("site_admin")."/"); 
            }
        }
        public function logout(){
            $this->session->sess_destroy();
            redirect(sitedata("site_admin")."/");
        }
}