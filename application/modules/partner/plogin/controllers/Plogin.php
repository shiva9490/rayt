<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Plogin extends CI_Controller{
        public function __construct(){
                parent::__construct();
        }
        public function index(){
            if($this->session->userdata("restraint_id") != ''){
				redirect(sitedata("site_partner")."/Dashboard"); 
			}
            $darta  =   array(
                'title'     =>  "Login",
                "content"   =>  "login"
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("username","Restraint ID","xss_clean|required|callback_checkemail");
                $this->form_validation->set_rules("password","Password","required|xss_clean|xss_clean|min_length[2]|max_length[50]");
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->plogin_model->checkLogin();
                    if($ins){
                        $this->session->set_flashdata("suc","Welcome to ".$this->session->userdata("login_name"));
                        redirect(sitedata("site_partner")."/Dashboard");
                    }else{
                        $this->session->set_flashdata("err","Login failed");
                        redirect(sitedata("site_partner")."/");
                    }
                }
            }
            $this->load->view("partner/outer_template",$darta);
        }
        public function checkusernameexist(){
                $emailid    =   $this->input->post("username");
                $vsap   =   $this->plogin_model->checkvalueemail($emailid);
                echo ($vsap)?"true":"false";
        }
        public function forgotpassword(){
            $darta  =   array(
                'title'     =>  "Forgot Password",
                "content"   =>  "forgotpassword"
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("emailid","Email ID","valid_email|xss_clean|required|callback_checkemail"); 
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->plogin_model->sendpassword();
                    if($ins){
                        $this->session->set_flashdata("suc","A password has been sent to registered mail.Please check them and login.");
                        redirect(sitedata("site_partner")."/");
                    }else{
                        $this->session->set_flashdata("err","Password has been not sent to the registered mail.");
                        redirect(sitedata("site_partner")."/Forgot-Password");
                    }
                }
            }
            $this->load->view("admin/outer_template",$darta);
        }
        public function checkemail($str){
            $vsp    =   $this->plogin_model->checkvalueemail($str); 
            if(!$vsp){
                $this->form_validation->set_message("checkemail","Restraint ID does not exists.");
                return FALSE;
            }	 
            return TRUE; 	
        }	
        public function logout(){
			$this->clear_cache();
			$this->session->sess_destroy();
			if($this->session->userdata("restraint_id") == ""){
				redirect(sitedata("site_partner")."/","refresh");
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			}
        }
		function clear_cache()
		{
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
		}
}