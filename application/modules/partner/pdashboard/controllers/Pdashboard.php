<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Pdashboard extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function index(){
                if($this->session->userdata("restraint_id") == ''){
					redirect(sitedata("site_partner")."/Login"); 
				}
                $data   =   array(
                    "title"     =>  "Dashboard",
                    "content"   =>  "dashboard"
                );
                $this->load->view("partner/inner_template",$data);
        }
        public function ajax_dash(){
                $this->load->view("ajax_dash");
        }
        public function __destruct() {
                $this->db->close();
        }
}	