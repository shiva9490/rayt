<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Customer extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
}
?>