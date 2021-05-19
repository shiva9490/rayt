<?php
class Api_driver extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function loginapi(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("password") != "" && $this->input->post("latitude") != "" && $this->input->post("longitude") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid username and password");
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."' and driver_login_password = '".$this->input->post("password")."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                   // echo '<pre>';print_r($vsp);exit;
                    if($vsp){
                        $vd =   $this->apidriver_model->login($vsp['driver_login_id']);
                        if($vd){
                            $driver_login_abc    =   $vd["status"];
                            if($driver_login_abc != "Active"){
                                $data = $this->api_model->jsonencodevalues("4","Your account is locked! Please contact system administrator!");
                            }else if($driver_login_abc == "Active" ){
                                $data   =   $this->api_model->jsonencodevalues("3",$vd);
                            }
                        }
                    }
                }
            }
            echo ($data);
        }
        public function forget(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" ){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $par['columns']  ='driver_name,driver_phone,driver_email,driver_login_username,driver_login_password';
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                    //echo '<pre>';print_r($vsp);exit;
                    if($vsp){
                        $email  =$vsp['driver_email'];
                        $phone  =   $vsp['driver_phone'];
                        $msg = "Dear ".$vsp['driver_name']." Your Password is ".$vsp['driver_login_password']." for username   ".$vsp['driver_login_username']." ";
                        //echo $msg.$email.$phone;
                        $data   =   $this->api_model->jsonencodevalues("3","Check Your registered email for password");
                    }
                }
            }
            echo ($data);
        }
        public function present_address_update(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("latitude") != "" && $this->input->post("longitude") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $par['columns']  ='driver_login_id';
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                    //echo '<pre>';print_r($vsp);exit;
                    if($vsp){
                        $vd =   $this->apidriver_model->present_address_update($vsp['driver_login_id']);
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3","present location updated");
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","failed");
                        }
                    }
                } 
            }
            echo ($data);
        }
        public function ActiveInactive(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("status") != "" && $this->input->post("latitude") != "" && $this->input->post("longitude") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $par['columns']  ='driver_login_id';
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                    //echo '<pre>';print_r($vsp);exit;
                    if($vsp){
                        $vd =   $this->apidriver_model->activeInactive($vsp['driver_login_id']);
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3","updated in database");
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","failed");
                        }
                    }
                } 
            }
            echo ($data);
        }
        public function logout(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("latitude") != "" && $this->input->post("longitude") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                    if($vsp){
                        $vd =   $this->apidriver_model->logout($vsp['driver_login_id']);
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3","Logout Successfull");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function support(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1",array('mobile_no'=>sitedata('site_support_number')));
            }
            echo ($data);
        }
        
}