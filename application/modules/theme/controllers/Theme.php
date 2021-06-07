<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Theme extends CI_Controller{
	public function __construct() {
		parent::__construct();
	}
	public function index(){
	    $this->load->view('home');
	}
}
?>