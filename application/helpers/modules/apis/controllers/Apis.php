<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        public function mastersvalues(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $ppunt  =   array(
                    "countries"     =>  $this->api_model->countries(),
                    "levels"        =>  $this->api_model->levelsvalues(),
                    "degree"        =>  $this->api_model->degree_type(),
                    "opportunities"     =>  $this->api_model->opportunities(),
                    "institutions"      =>  $this->api_model->organization(),
                    "idproofs"          =>  $this->api_model->idproofs(),
                    "subjects"          =>  $this->api_model->subjects(),
                    "association"       =>  $this->api_model->associations(),
                    "tutoring_i_want"   =>  $this->api_model->tutoring_i_want(),
                    "budgets"           =>  $this->api_model->budgets(),
                    "gender_prefernce"  =>  $this->api_model->gender_prefernce(),
                    "time_preference"   =>  $this->api_model->time_preference(),
                    "tutors_wanted"     =>  $this->api_model->tutors_wanted(),
                );
                $json   =   $this->api_model->jsonencodevalues("1",$ppunt);
            }
            echo ($json);
        }
        public function tokens(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $token_value        =   $this->input->post("token_value");
                $token_mobile       =   $this->input->post("token_mobile");
                $json   =   $this->api_model->jsonencodevalues("1","Token and Mobile are required");
                if($token_mobile != "" &&$token_value != ""){
                    $vsp    =   $this->api_model->saveToken();
                    $json   =   $this->api_model->jsonencodevalues("3","Not saved any token");
                    if($vsp){
                        $json   =   $this->api_model->jsonencodevalues("2","Token has been saved successfully");
                    }
                }
            }
            echo ($json);
        }
        public function login(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $mobile     =   $this->input->post("username");
                $passd      =   $this->input->post("password");
                $json   =   $this->api_model->jsonencodevalues("1","Username and Password are required");
                if($mobile != "" && $passd != ""){
                    $vsp    =   $this->api_model->checkapilogin();
                    $json   =   $this->api_model->jsonencodevalues("2","Login Failed");
                    if(count($vsp) > 0){
                        $profil     =   array(
                            "profile"       =>  $vsp,
                            "htmlcontet"    =>  $this->api_model->appcontent(),
                        );
                        $json       =   $this->api_model->jsonencodevalues("3",$profil);
                        $rgcount    =   $vsp["register_country"];
                        $reg_mobile_verified    =   $vsp["reg_mobile_verified"];
                        $reg_email_verified     =   $vsp["reg_email_verified"];
                        if($rgcount == sitedata("site_country")){
                            if($reg_mobile_verified == "0"){
                                $json       =   $this->api_model->jsonencodevalues("4","Mobile No. has been not verified");
                            }
                        }else{
                            if($reg_email_verified == "0"){
                                $json       =   $this->api_model->jsonencodevalues("5","Email Id has been not verified");
                            }
                        } 
                    }
                }
            }
            echo ($json);
        }
        public function resendotp(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $mobile     =   $this->input->post("mobileno");
                $vsp        =   $this->api_model->sendotp($mobile);
                $json       =   $this->api_model->jsonencodevalues("1","OTP has been not sent");
                if($vsp){
                    $json   =   $this->api_model->jsonencodevalues("2","OTP has been sent");
                }
            }
            echo $json;
        }
        public function resendemailcode(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $mobile     =   $this->input->post("emailid");
                $vsp        =   $this->api_model->resendemailcode($mobile);
                $json       =   $this->api_model->jsonencodevalues("1","OTP has been not sent");
                if($vsp){
                    $json   =   $this->api_model->jsonencodevalues("2","OTP has been sent");
                }
            }
            echo $json;
        }
        public function verifyotp(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $otp_no     =   $this->input->post("otp_no");
                $mobile     =   $this->input->post("mobileno");
                $json       =   $this->api_model->jsonencodevalues("1","OTP and Mobile no are required");
                if($otp_no != "" && $mobile  != ""){
                    $vsp        =   $this->api_model->verifyotp($mobile);
                    $json       =   $this->api_model->jsonencodevalues("3","OTP has been not verified");
                    if($vsp){
                        $json   =   $this->api_model->jsonencodevalues("2","OTP has been verified");
                    }
                }
            }
            echo $json;
        }
        public function verifyemail(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $otp_no     =   $this->input->post("otp_no");
                $mobile     =   $this->input->post("emailid");
                $json       =   $this->api_model->jsonencodevalues("1","OTP and Email Id are required");
                if($otp_no != "" && $mobile  != ""){
                    $vsp        =   $this->api_model->verifyemailcode($mobile,$otp_no);
                    $json       =   $this->api_model->jsonencodevalues("3","OTP has been not verified");
                    if($vsp){
                        $json   =   $this->api_model->jsonencodevalues("2","OTP has been verified");
                    }
                }
            }
            echo $json;
        }
        public function register(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $tyee       =   $this->input->post("usertype");
                $fullname   =   $this->input->post("fullname");
                $email      =   $this->input->post("emailid");
                $mobile     =   $this->input->post("mobileno");
                $passd      =   $this->input->post("password");
                $cutnry     =   $this->input->post("countryid");
                $json       =   $this->api_model->jsonencodevalues("0","Some fields are required");
                if($tyee != "" &&  $fullname != "" && $email  != "" &&  $mobile != "" && $passd != "" && $cutnry != ""){
                    $vsp    =   $this->api_model->checkemailteacher($email);
                    $json       =   $this->api_model->jsonencodevalues("1","Email Id or Mobile No. already exists");
                    if(count($vsp) > 0){
                        $reg_mobile_verified    =   $vsp["reg_mobile_verified"];
                        $reg_email_verified     =   $vsp["reg_email_verified"];
                        $json       =   $this->api_model->jsonencodevalues("2",$vsp);
                        $rgcount    =   $vsp["register_country"];
                        if($rgcount == sitedata("site_country")){
                            if($reg_mobile_verified == "0"){
                                $json       =   $this->api_model->jsonencodevalues("5","Mobile No. has been not verified");
                            }
                        }else{
                            if($reg_email_verified == "0"){
                                $json       =   $this->api_model->jsonencodevalues("6","Email Id has been not verified");
                            }
                        } 
                    }else{
                        $json   =   $this->api_model->jsonencodevalues("3","Not registered User.");
                        $vsp    =   $this->api_model->insert_register();
                        if($vsp){
                            $json   =   $this->api_model->jsonencodevalues("4","Registered profile successfully");
                        }
                    }
                }
            }
            echo $json;
        }
        public function tutors(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    $son    =   array();
                    $vso        =   $this->api_model->checklogintype();
                    if($vso == "1"){
                        $json       =   $this->api_model->jsonencodevalues("2","Not approved by administrator");
                    }else{
                        $son       =   $this->api_model->alllist();
                    }
                    $json       =   $this->api_model->jsonencodevalues("3",$son);
                }
            }
            echo $json;
        }
        public function basicdetails(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    $basic      =   $this->api_model->getBasicdetails();   
                    $json       =   $this->api_model->jsonencodevalues("2",$basic);
                    $nsm    =   $this->input->post("register_name");
                    if($nsm != ""){
                        $vso        =   $this->tutor_model->updateBasic();
                    }
                }
            }
            echo $json;
        }
        public function updateaddress(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("tutor_address") != ""){
                        $dvso        =   $this->tutor_model->updateaddress();
                    }
                    $vso        =   $this->api_model->getaddrressdetails();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function updateteachningdetails(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("tutor_fee_charge") != ""){
                        $dvso        =   $this->tutor_model->updateteachingdetails();
                    }
                    $vso        =   $this->api_model->gettutordetails();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function updateprofile(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("tutor_description") != ""){
                        $dvso        =   $this->tutor_model->updateprofile();
                    }
                    $vso        =   $this->api_model->getprofiledetails();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function idproofs(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("tutor_idproof") != ""){
                        $dvso        =   $this->tutor_model->updateidprofile();
                    }
                    $vso        =   $this->api_model->getidproofs();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function addsubjects(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("to_level") != "" && $this->input->post("from_level") != "" && $this->input->post("subjectid") != ""){
                        $dvso        =   $this->tutor_model->addsubjects();
                    }
                    if($this->input->post("tutorsubject_id") != ""){
                        $tutorsubject_id     =   $this->input->post("tutorsubject_id");
                        $dvso       =   $this->tutor_model->deletesubjects($tutorsubject_id);
                    }
                    $vso        =   $this->api_model->getsubjectdetails();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function addexperience(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("experince_institution") != "" && $this->input->post("experince_degree_type") != ""){
                        $dvso        =   $this->tutor_model->addorganization();
                    }
                    if($this->input->post("experince_id") != ""){
                        $tutorsubject_id     =   $this->input->post("experince_id");
                        $dvso       =   $this->tutor_model->deleteorganization($tutorsubject_id);
                    }
                    $vso        =   $this->api_model->geteducationdetails();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function addteaching(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("teaching_organization") != "" && $this->input->post("teaching_designation") != ""){
                        $dvso        =   $this->tutor_model->addexperience();
                    }
                    if($this->input->post("teaching_id") != ""){
                        $tutorsubject_id     =   $this->input->post("teaching_id");
                        $dvso       =   $this->tutor_model->deleteteaching($tutorsubject_id);
                    }
                    $vso        =   $this->api_model->getteachingdetails();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function addrequirement(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("student_subjects")  != "" && $this->input->post("student_from_level") != ""){
                        $dvso        =   $this->student_model->addrequirement();
                    }
                    $vso        =   $this->api_model->getrequirementsvalue();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function updatesubjects(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("student_unique") != "" && $this->input->post("student_subjects")  != "" && $this->input->post("student_from_level") != ""){
                        $dvso        =   $this->student_model->updatrequirement();
                    }
                    $vso        =   $this->api_model->getrequirements();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function updatebudget(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    if($this->input->post("student_budget") != "" && $this->input->post("student_budgettype")  != "" 
                            && $this->input->post("student_wanted") != ""
                            && $this->input->post("student_preference") != ""){
                        $dvso        =   $this->student_model->updatebudget();
                    }
                    $vso        =   $this->api_model->getrequirementsvalue();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function myposts(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    $vso        =   $this->api_model->mysposts();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function logout(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    $vso        =   $this->session->sess_destroy();
                    $json       =   $this->api_model->jsonencodevalues("2","Logged out successfully");
                }
            }
            echo $json;
        }
        public function packages(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == "1"){
                $register_unique    =   $this->input->post("register_unique");
                $json               =   $this->api_model->jsonencodevalues("1","Unique Id is required");
                if($register_unique != ""){
                    $vso        =   $this->api_model->packages();
                    $json       =   $this->api_model->jsonencodevalues("2",$vso);
                }
            }
            echo $json;
        }
        public function __destruct() {
            $this->db->close();
        }
}