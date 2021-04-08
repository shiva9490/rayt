<?php
class Apis extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function countries(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $ppunt  =   array(
                    "countries"     =>  $this->api_model->countries()
                );
                $json   =   $this->api_model->jsonencodevalues("1",$ppunt);
            }
            echo ($json);
        }
        
        public function register(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if(
                    $this->input->post("fname") != "" && 
                    $this->input->post("email") != "" && 
                    $this->input->post("mobile") != "" && 
                    $this->input->post("password") != "" && 
                    $this->input->post("cpassword") != "" &&
                    $this->input->post("country") != ""
                ){
                    $par['whereCondition'] = "customer_email_id like '".$this->input->post("email")."' OR  customer_mobile Like '".$this->input->post("mobile")."'";
                    $vsp    =   $this->customer_model->getCustomer($par);
                    if(is_array($vsp) && count($vsp) > 0){
                        $reg_email_verified     =   $vsp["customer_email_verified"];
                        $reg_mobile_verified    =   $vsp["customer_verified_mobile"];
                        if($reg_mobile_verified == "0" || $reg_mobile_verified == "0"){
                            if($reg_mobile_verified == "0"){
                                $data       =   $this->api_model->jsonencodevalues("6","Mobile No. already exists");
                            }
                            if($reg_email_verified == "0"){
                                $data       =   $this->api_model->jsonencodevalues("5","Email Id. already exists");
                            }
                        }else{
                            $data       =   $this->api_model->jsonencodevalues("4","Email Id/Mobile NO. already exists");
                        }
                        
                    }else{
                        $data   =   $this->api_model->jsonencodevalues("3","Not registered User.");
                        $vsp    =   $this->customer_model->createregister();
                        if($vsp){
                            $this->customer_model->sendotp($this->input->post("email"));
                            $data   =   $this->api_model->jsonencodevalues("2","Registered profile successfully,OTP Send to registered Email Id");
                        }
                    }
                }
            }
            echo ($data);
        }
        
        public function loginapi(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("email") != "" && $this->input->post("password") != "" ){
                    $data   =   $this->api_model->jsonencodevalues("3","Invalid username and password");
                    $par['whereCondition'] = "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."' and customer_password = '".$this->input->post("password")."'";
                    $vsp    =   $this->customer_model->getCustomer($par);
                    //echo '<pre>';print_r($vsp);exit;
                    if(is_array($vsp) && count($vsp) > 0){
                        $reg_mobile_verified    =   $vsp["customer_email_verified"];
                        $reg_email_verified     =   $vsp["customer_verified_mobile"];
                        $rgcount                =   $vsp["customer_country"];
                        if($rgcount == sitedata("site_country")){
                            if($reg_mobile_verified == 0){
                                $this->customer_model->sendotp($this->input->post("email"));
                                $data = $this->api_model->jsonencodevalues("4","Mobile No. has been not verified");
                            }
                        }else{
                            if($reg_email_verified == 0){
                                $this->customer_model->sendotp($this->input->post("email"));
                                $data =  $this->api_model->jsonencodevalues("5","Email Id has been not verified");
                            }
                        }
                        if($reg_mobile_verified == 1 || $reg_email_verified == 1){
                            $vsp = $this->api_model->loginemailsapi();
                            if($vsp){
                                $data =  $this->api_model->jsonencodevalues("2",$vsp);
                            }
                        }
                    }
                }
            }
            echo ($data);
        }
        public function verify_otp(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data       =   $this->api_model->jsonencodevalues("1","Email\Mobile No. and OTP No are required");
                $mobile     =   $this->input->post("email");
                $otpno      =   $this->input->post("otp");
                if($mobile != "" && $otpno != ""){
                    $data       =   $this->api_model->jsonencodevalues("2", "OTP has been not verified.Please try again");
                    $jon        =   $this->api_model->verifyotp($otpno,$mobile,"1");
                    if($jon){
                        $jon = $this->customer_model->update_verification();
                        $data   =   $this->api_model->jsonencodevalues("3","OTP has been verified successfully");
                    }
                }
            }
            echo ($data);
        }
        public function view_profile(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data       =   $this->api_model->jsonencodevalues("0","Some Fileds are required",'0');
                $mobile     =   $this->input->post("customer_token");
                if($mobile != ""){
                    $jon        =   $this->api_model->getprofile();
                    $data       =   $this->api_model->jsonencodevalues('1', $jon);
                }
            }
            echo ($data);
        }
        public function update_profile(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $json       =   $this->api_model->jsonencodevalues("1","Some fields are required",'0');
                $mobile     =   $this->input->post("customer_token");
                if($mobile != "" && $this->input->post("mobile") !="" && $this->input->post("fname") != "" && $this->input->post("email") != "" ){
                    $check      =   $this->api_model->getprofile();
                    $json       =   $this->api_model->jsonencodevalues("2","Token does not exists",'0'); 
                    if($check){
                        $ins    =   $this->customer_model->update_customer();
                        $json   =   $this->api_model->jsonencodevalues("4","Customer details has been not updated.Please try again.",'0');
                        if($ins){
                            $json   =   $this->api_model->jsonencodevalues("3","Customer details has been updated succcesfully",'0');
                        }
                    }
                }
            }
            echo json_encode($json);
        }
        
        public function forgotpassword(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("email") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid Emailid /Mobile NO");
                    $par['whereCondition'] = "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."'";
                    $vsp    =   $this->customer_model->getCustomer($par);
                    if(is_array($vsp) && count($vsp) > 0){
                        $reg_mobile_verified    =   $vsp["customer_email_verified"];
                        $reg_email_verified     =   $vsp["customer_verified_mobile"];
                        $rgcount                =   $vsp["customer_country"];
                        if($rgcount == sitedata("site_country")){
                            if($reg_mobile_verified == 0){
                                $data = $this->api_model->jsonencodevalues("3","Mobile No. has been not verified");
                            }
                        }else{
                            if($reg_email_verified == 0){
                                $data =  $this->api_model->jsonencodevalues("4","Email Id has been not verified");
                            }
                        }
                        if($reg_mobile_verified == 1 || $reg_email_verified == 1){
                            $data = $this->api_model->jsonencodevalues("5","password reset link has been sent to your email");
                            $this->customer_model->forgotpassword($vsp['customer_id']);
                        }
                    }
                }
            }
            echo ($data);
        }
}
?>