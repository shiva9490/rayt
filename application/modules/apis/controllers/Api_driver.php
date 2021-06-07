<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
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
                    $vsp    = $this->apidriver_model->checkdriverlog();
                    if($vsp){
                        $data = $this->api_model->jsonencodevalues("4","Your account is locked! Please contact system administrator!");
                        $vd =   $this->apidriver_model->login();
                        if($vd){
                            $driver_login_abc    =   $vd["status"];
                            if($driver_login_abc != "Active"){
                                $data = $this->api_model->jsonencodevalues("4","Your account is locked! Please contact system administrator!");
                            }else if($driver_login_abc == "Active"){
                                $data   =   $this->api_model->jsonencodevalues("3",$vd);
                            }
                        }
                    }
                }
            }
            echo ($data);
        }
        public function tokens(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $token_value        =   $this->input->post("token_value");
                $token_mobile       =   $this->input->post("userid");
                $json   =   $this->api_model->jsonencodevalues("1","Token and Unique are required");
                if($token_mobile != "" && $token_value != ""){
                    $vsp    =   $this->apidriver_model->saveToken();
                    $json   =   $this->api_model->jsonencodevalues("3","Not saved any token");
                    if($vsp){
                        $json   =   $this->api_model->jsonencodevalues("2","Token has been saved successfully");
                    }
                }
            }
            echo ($json);
        }
        public function forget(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    /*$par['columns']  ='driver_name,driver_phone,driver_email,driver_login_username,driver_login_password';
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);*/
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $email  =   $vsp['driver_email'];
                        $phone  =   $vsp['driver_phone'];
                        $msg    =   "Dear ".$vsp['driver_name']." Your Password is ".$vsp['driver_login_password']." for username   ".$vsp['driver_login_username']." ";
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
                    $vsp    = $this->apidriver_model->checkdriver();
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
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =  $this->apidriver_model->activeInactive($vsp['driver_login_id']);
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3","updated in database");
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","New orders are empty");
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
                    $vsp    =   $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->logout();
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
                $data   =   $this->api_model->jsonencodevalues("1",array('mobile_no'=>sitedata('site_support_number'),'email'=>sitedata('site_email')));
            }
            echo ($data);
        }
        public function drivertime(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" ){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $datas  =   $this->apidriver_model->apidrivertime();
                        $data   =   $this->api_model->jsonencodevalues("3",$datas);
                    }
                }
            }
            echo ($data);
        }
        public function neworder(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("latitude") != "" && $this->input->post("longitude") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $this->apidriver_model->present_address_update();
                        $vd =   $this->apidriver_model->neworder();
                        if($vd){
                            $d = array(
                                'Order_details' => $vd,
                            );
                            $d['unread_orders']['number'] = $this->apidriver_model->unread_orders();
                            $d['supportr']['number']  = sitedata('site_support_number');
                            $d['supportr']['email']   = sitedata('site_email');
                            $d['zone']['mainzone']    = $this->apidriver_model->zone_checks();
                            $data   =   $this->api_model->jsonencodevalues("3",$d);
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","No new orders received");
                        }
                    }
                } 
            }
            echo ($data);
        }
        public function check_view_orders(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->update_order_status();
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3","View order updated successfully");
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","View order updated failed");
                        }
                    }
                } 
            }
            echo ($data);
        }
        public function restarent_details(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("resturant_id") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->restarent_details();
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3",$vd);
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","No new orders received");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function pickuporder(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("resturant_id") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->pickuporder();
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3",$vd);
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","No new orders received");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function takeitorder(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("resturant_id") != "" && $this->input->post("order_unique_id") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->takeitorder();
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3",$vd);
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","Order status cannot be changed");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function deliveryorder(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != "" && $this->input->post("resturant_id") && $this->input->post("customerid") != "" && $this->input->post("order_unique_id") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->deliveryorder();
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3","Order Delivered successfully.");
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","Order status cannot be exseted");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function today_order_amount(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("empid") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Employee Id");
                    $vsp    = $this->apidriver_model->checkdriver();
                    if($vsp){
                        $vd =   $this->apidriver_model->today_order_amount();
                        if($vd){
                            $data   =   $this->api_model->jsonencodevalues("3",$vd);
                        }else{
                            $data   =   $this->api_model->jsonencodevalues("4","Delivery amount Null");
                        }
                    }
                }
            }
            echo ($data);
        }
}