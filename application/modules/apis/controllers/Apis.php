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
        public function dashboard(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $json   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("lat") != "" && $this->input->post("long") != ""){
                    $data  = array(
                        'category'        => $this->api_model->dashboard_category(),
                        'featuredoffers'  => $this->api_model->featuredoffers(),
                        'myorder'         => $this->api_model->order_deatails(),
                    );
                    $json       =  $this->api_model->jsonencodevalues("2",$data); 
                }
            }
            echo ($json);
        }
        public function inner_dashboard(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $json   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $json   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("lat") != "" && $this->input->post("long") != ""){
                    $json   =   $this->api_model->jsonencodevalues("2","Restaurant not available in your area");
                    $zone = $this->api_model->zone_check();
                    //print_r($zone);exit;
                    if($zone){
                        $data  = array(
                            'restorent_count'   => $this->api_model->near_restorent_count($zone),
                            'baners'            => $this->api_model->inner_banners(),
                            'myorder'           => $this->api_model->order_deatails(),
                            'restorent'         => $this->api_model->near_restorent($zone),
                            'cart_data'         => $this->api_model->view_totalcart(),
                        );
                        $json       =  $this->api_model->jsonencodevalues("3",$data);
                    }
                }
            }
            echo ($json);
        }
        public function restraint_details(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("lat") && $this->input->post("long")){
                    $dat    = array(
                        'restraint_details'         => $this->apirestraint_model->restraint_details(),
                        'restraint_items'           => $this->apirestraint_model->restraint_menu(),
                        'restraint_menu_categotry'  => $this->apirestraint_model->restraint_menu_categotry(),
                        'cart_data'                 => $this->api_model->view_totalcart(),
                    );
                }
                $data = $this->api_model->jsonencodevalues("2",$dat);
            }
            echo $data;
        }
        public function item_details(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("item_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","currently not available items");
                    $par['whereCondition'] = "resturant_items_id LIKE '".$this->input->post("item_id")."' AND resturant_id LIKE '".$this->input->post("restrant_id")."' AND resturant_items_abc = 'Active'";
                    $res  = $this->menu_model->getItems($par);
                    if(is_array($res) && count($res) > 0){
                        $data   =   $this->api_model->jsonencodevalues("2","currently not available items");
                        if(isset($res[0]['resturant_items_abc']) &&  $res[0]['resturant_items_abc'] =="Active"){
                            $dat = array(
                                'item_details'      =>  $this->api_model->item_details(),
                                'item_variants'    =>  $this->apirestraint_model->item_variants(),
                                'item_addons'       =>  $this->apirestraint_model->item_addons(),
                                'cart_data'         =>  $this->api_model->view_totalcart(),
                            );
                            $data = $this->api_model->jsonencodevalues("3",$dat);
                        }
                    }
                }
            }
            echo $data;
        }
        public function item_details_ios(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("item_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","currently not available items");
                    $par['whereCondition'] = "resturant_items_id LIKE '".$this->input->post("item_id")."' AND resturant_id LIKE '".$this->input->post("restrant_id")."' AND resturant_items_abc = 'Active'";
                    $res  = $this->menu_model->getItems($par);
                    if(is_array($res) && count($res) > 0){
                        $data   =   $this->api_model->jsonencodevalues("2","currently not available items");
                        if(isset($res[0]['resturant_items_abc']) &&  $res[0]['resturant_items_abc'] =="Active"){
                            $dat = array(
                                'item_details'      =>  $this->api_model->item_details(),
                                'item_variants'    =>  $this->apirestraint_model->item_variants_ios(),
                                //'item_addons'       =>  $this->apirestraint_model->item_addons(),
                                'cart_data'         =>  $this->api_model->view_totalcart(),
                            );
                            $data = $this->api_model->jsonencodevalues("3",$dat);
                        }
                    }
                }
            }
            echo $data;
        }
        
        public function addtocart(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("item_id") && $this->input->post("customer_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("7","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues("3","currently not available items");
                            $par['whereCondition'] = "resturant_items_id LIKE '".$this->input->post("item_id")."' AND resturant_id LIKE '".$this->input->post("restrant_id")."' AND resturant_items_abc = 'Active'";
                            $res  = $this->menu_model->getItems($par);
                            if(is_array($res) && count($res) > 0){
                                $data   =   $this->api_model->jsonencodevalues("4","currently not available items");
                                if(isset($res[0]['resturant_items_abc']) &&  $res[0]['resturant_items_abc'] =="Active"){
                                    $res = $this->api_model->addtocart();
                                    if($res){
                                        $data = $this->api_model->jsonencodevalues("5","Added product to cart successfully");
                                    }else{
                                        $data = $this->api_model->jsonencodevalues("6","Not added any product to cart");
                                    }
                                }
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        public function update_cart(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post('cart_id')){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $dta    =   $this->order_model->update_cart();
                            if(($dta) > 0){
                                $d = array(
                                    'cart_data'     =>  $this->customer_model->view_cart(),
                                    'cart_total'    =>  $this->api_model->view_totalcart(),    
                                );
                                $dtsa    =   array(
                                    'status'            =>  '4',
                                    'status_messsage'   =>  $d
                                );
                                $data   = json_encode($dtsa); //$this->api_model->jsonencodevalues('5',$dtsa,'0');
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        public function delete_cart(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post('cart_id')){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues('4',"Delete Iteam Failed.");
                            $res = $this->order_model->delete_cart();
                            if($res){
                                $dta    =   $this->customer_model->view_cart();
                                if(count($dta) > 0){
                                    $d = array(
                                        'cart_data'     =>  $this->customer_model->view_cart(),
                                        'cart_total'    =>  $this->api_model->view_totalcart(),    
                                    );
                                    $dtsa    =   array(
                                        'status'            =>  '5',
                                        'status_messsage'   =>  $d
                                    );
                                    $data   = json_encode($dtsa); //$this->api_model->jsonencodevalues('5',$dtsa,'0');
                                }
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        
        public function addaddress(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post('address_type')){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues('4',"Not added any address.Please try again.");
                            $res = $this->customer_model->addaddress();
                            if($res){
                                $data = $this->api_model->jsonencodevalues("5","Added address successfully");
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        public function updateaddress(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post('address_type') && $this->input->post('address_id')){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues('4',"Don't existing address.");
                            $re = $this->api_model->checkaddress();
                            if($re){
                                $data   =   $this->api_model->jsonencodevalues('5',"Not Update any address.Please try again.");
                                $res    = $this->customer_model->updateaddress($this->input->post('address_id'));
                                if($res){
                                    $data = $this->api_model->jsonencodevalues("6","Update address successfully");
                                }
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        public function view_address(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $dta    =   $this->customer_model->viewcustomeraddresslist();
                            $data   =   $this->api_model->jsonencodevalues('4',"No address are available",'0');
                            if(is_array($dta) && count($dta) > 0){
                                $dtsa    =   array(
                                    'status'            =>  '5',
                                    'status_messsage'   =>  $dta,
                                );
                                $data   =   ($dtsa);//$this->api_model->jsonencodevalues('5',$dta,'0');
                            } 
                        }
                    }
                }
            }
            echo json_encode($data);
        } 
        public function delete_address(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post('address_id')){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $dta    =   $this->customer_model->delete_address($this->input->post('address_id'));
                            $data   =   $this->api_model->jsonencodevalues('4',"Not deleted any address.Please try again",'0');
                            if($dta > 0){
                                //$dtas    =   $this->customer_model->viewcustomeraddresslist();
                                $data   =   $this->api_model->jsonencodevalues("5","Deleted Address successfully");
                               //if(is_array($dtas) && count($dtas) > 0){
                               //    $dtsa    =   array(
                               //        'status'            =>  '5',
                               //        'status_messsage'   =>  $dtas,
                               //    );
                               //    $data   =   json_encode($dtsa);//$this->api_model->jsonencodevalues('5',$dta,'0');
                               //} 
                                //print_r($data);exit;
                            }
                        }
                    }
                }
            }
            echo ($data);
        } 
        public function view_cart(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues("4","Your cart empty");
                            $dta    =   $this->customer_model->view_cart();
                            if(count($dta) > 0){
                                $d = array(
                                    'cart_data'     =>  $this->customer_model->view_cart(),
                                    'cart_total'    =>  $this->api_model->view_totalcart(),    
                                );
                                $dtsa    =   array(
                                    'status'            =>  '5',
                                    'status_messsage'   =>  $d
                                );
                                $data   = json_encode($dtsa); //$this->api_model->jsonencodevalues('5',$dtsa,'0');
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        public function payment(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $d = array(
                                'cart_data'     =>  $this->customer_model->view_payment(),
                                'cart_total'    =>  $this->api_model->view_totalcart(),    
                            );
                            $dtsa    =   array(
                                'status'            =>  '4',
                                'status_messsage'   =>  $d
                            );
                            $data   = json_encode($dtsa);
                        }
                    }
                }
            }
            echo ($data);
        }
        public function checkout(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post('payment_type')&& $this->input->post('customeraddress_id')){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues("4","Order Placed failed...");
                            $dta    =   $this->order_model->checkout();
                            if($dta){
                                $data   =   $this->api_model->jsonencodevalues("5","Order Placed successfully");
                            }
                        }
                    }
                }
            }
            echo ($data);
        }
        public function order_history(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues("4","No orders placed in your account");
                            $orderhis = $this->api_model->order_history();
                            if($orderhis){
                                $data = $this->api_model->jsonencodevalues('5',$orderhis);
                            }
                        }
                    }
                }
            }
            echo $data;
        }
        public function order_details(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("customer_id") && $this->input->post("unique_id")){
                    $data   =   $this->api_model->jsonencodevalues("2","User Doesn't not exist");
                    $user = $this->api_model->checkcustomer();
                    if($user){
                        $data   =   $this->api_model->jsonencodevalues("3","Mobile No. has been blocked.Please contact administrators");
                        if($user['customer_abc'] == "Active"){
                            $data   =   $this->api_model->jsonencodevalues("4","No orders found");
                            $orderhis = $this->api_model->order_details();
                            if($orderhis){
                                $data = $this->api_model->jsonencodevalues('5',$orderhis);
                            }
                        }
                    }
                }
            }
            echo $data;
        }
}