<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Dashboard extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function index(){
                if($this->session->userdata("login_id") == ""){
                    redirect(sitedata("site_admin")."/");
                }
                $data   =   array(
                    "title"     =>  "Dashboard",
                    "content"   =>  "dashboard"
                );
                $this->load->view("admin/inner_template",$data);
        }
        public function ajax_dash(){
                $this->load->view("ajax_dash");
        }
        public function __destruct() {
                $this->db->close();
        }
}