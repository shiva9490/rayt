<?php
class Api_restaurant extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function login_restraint(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("username") != "" && $this->input->post("password") != ""){
                    $data   =   $this->api_model->jsonencodevalues("3","Invalid username and password");
                    $temps = base_url().'upload/resturants/';
                    $par['whereCondition'] = "lower(restraint_login_username) LIKE '".strtolower($this->input->post("username"))."' and restraint_login_password = '".$this->input->post("password")."'";
                    $par['columns']        = "resturant_id,resturant_given_Id as RestrantId,resturant_name,resturant_name_a,concat('".$temps."',resturant_image) as resturant_image,resturant_latitude,resturant_longitude,restraint_login_abc,resturant_status";
                    $vsp    =   $this->resturant_model->getResturant($par);
                    if(is_array($vsp) && count($vsp) > 0){
                        $restraint_login_abc    =   $vsp["restraint_login_abc"];
                        $resturant_status       =   $vsp["resturant_status"];
                        if($restraint_login_abc != "Active"){
                            $data = $this->api_model->jsonencodevalues("4","Your account is locked! Please contact system administrator!");
                        }else if($resturant_status != "Active"){
                            $data =  $this->api_model->jsonencodevalues("5","Your Resturant is locked! Please contact system administrator!");
                        }else if($restraint_login_abc == "Active" || $resturant_status == "Active"){
                            $vsp['support_email'] = sitedata("site_email"); 
                            $vsp['support_phone'] = sitedata("site_support_number"); 
                            $data =  $this->api_model->jsonencodevalues("2",$vsp);
                        }
                    }
                }
            }
            echo ($data);
        }
        public function restraint_menu(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != ""){
                    $vsp = $this->apirestraint_model->restraint_menu();
                    if($vsp){
                        $data =  $this->api_model->jsonencodevalues("2",$vsp);
                    }
                }
            }
            echo ($data);
        }
        public function activedeactiveitem(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != ""  && $this->input->post("item_id") && $this->input->post("status")){
                    $data   =   $this->api_model->jsonencodevalues("2","Item id does not exstig.");
                    $par['whereCondition'] = "resturant_id LIKE '".$this->input->post("restrant_id")."' AND resturant_items_id LIKE '".$this->input->post("item_id")."'";
                    $check = $this->menu_model->getItems($par);
                    if($check){
                        $data   =   $this->api_model->jsonencodevalues("3","Item update failed.");
                        $vsps = $this->menu_model->activedeactiveitem($this->input->post("item_id"),$this->input->post("status"));
                        if($vsps){
                            $vsp = $this->apirestraint_model->restraint_menu();
                            if($vsp){
                                $data =  $this->api_model->jsonencodevalues("4",$vsp);
                            }
                        }
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
                if($this->input->post("restrant_id") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","No Orders Neworder");
                    $vsp = $this->apirestraint_model->neworders();
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3",$vsp);
                    }
                }
            }
            echo ($data);
        }
        public function preparing(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != ""){
                    $orderstatus = $this->config->item('orderstatus');
                    $data   =   $this->api_model->jsonencodevalues("2","No Orders in preparing");
                    $vsp = $this->apirestraint_model->neworders($orderstatus[1]);
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3",$vsp);
                    }
                }
            }
            echo ($data);
        }
        public function ready_for_oder(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != ""){
                    $orderstatus = $this->config->item('orderstatus');
                    $data   =   $this->api_model->jsonencodevalues("2","no Orders in Ready for oder");
                    $vsp = $this->apirestraint_model->neworders($orderstatus[2]);
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3",$vsp);
                    }
                }
            }
            echo ($data);
        }
        public function out_for_delivery(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != ""){
                    $orderstatus = $this->config->item('orderstatus');
                    $data   =   $this->api_model->jsonencodevalues("2","no Orders in out for delivery");
                    $vsp = $this->apirestraint_model->neworders($orderstatus[3]);
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3",$vsp);
                    }
                }
            }
            echo ($data);
        }
        public function viewneworder(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("unique_id") != "" && $this->input->post("status") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Data could not be matched");
                    $vsp = $this->apirestraint_model->viewneworder();
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3",$vsp);
                    }
                }
            }
            echo ($data);
        }
        public function change_action(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("unique_id") != "" && $this->input->post("status") != "" && $this->input->post("accepted") != ""){
                    if($this->input->post("accepted") == "accepted"){
                        $data   =   $this->api_model->jsonencodevalues("2","Status Updated Failed.");
                        $vsp = $this->apirestraint_model->change_action();
                        if($vsp){
                            $data   =   $this->api_model->jsonencodevalues("3","Status Updated Successfully");
                        }
                    }else if($this->input->post("accepted") == "rejected"){
                        $data   =   $this->api_model->jsonencodevalues("4","Status rejected Failed.");
                        $vsp = $this->apirestraint_model->change_action_rejected();
                        if($vsp){
                            $data   =   $this->api_model->jsonencodevalues("5","Status rejected Successfully");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function cancel_order(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("unique_id") != "" && ($this->input->post("canceled_desc") != "" || $this->input->post("canceled_option") != "") && $this->input->post("Cancle")){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid resturant Id");
                    $par['whereCondition'] = "lower(resturant_id) LIKE '".strtolower($this->input->post("restrant_id"))."'";
                    $vsp    =   $this->resturant_model->getResturant($par);
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3","Order cancelled failed.");
                        $vsps = $this->apirestraint_model->cancel_order();
                        if($vsps){
                            $data   =   $this->api_model->jsonencodevalues("4","Order cancelled Successfully");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function online_offline(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("status") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid resturant Id");
                    $par['whereCondition'] = "lower(resturant_id) LIKE '".strtolower($this->input->post("restrant_id"))."'";
                    $vsp    =   $this->resturant_model->getResturant($par);
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3","failed status");
                        $vue = $this->apirestraint_model->online_offline();
                        if($vue){
                            if($this->input->post("status")=='1'){
                                $status = 'Active';
                            }else if($this->input->post("status")=='2'){
                                $status = 'Inactive';
                            }
                            $data   =   $this->api_model->jsonencodevalues("4",$status." Updated status");
                        }
                    }
                }
            }
            echo ($data);
        }
        public function vieworders(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid resturant Id");
                    $par['whereCondition'] = "lower(resturant_id) LIKE '".strtolower($this->input->post("restrant_id"))."'";
                    $vsp    =   $this->resturant_model->getResturant($par);
                    if($vsp){
                        $data   =   $this->api_model->jsonencodevalues("3","No Orders Available");
                        $vue    =   $this->apirestraint_model->vieworderss();
                        if($vue){
                            $data   =   $this->api_model->jsonencodevalues("4",$vue);
                        }
                    }
                }
            }
            echo ($data);
        }
        public function delay_order(){
            $sv     =   $this->api_model->checkAuthorizationvalid();
            $data   =   $this->api_model->jsonencodevalues("0","Authorization key Invalid");
            if($sv == 1){
                $data   =   $this->api_model->jsonencodevalues("1","Some Fileds are required");
                if($this->input->post("restrant_id") != "" && $this->input->post("unique_id") != "" && $this->input->post("delay_time") != ""){
                    $data   =   $this->api_model->jsonencodevalues("2","Invalid resturant Id");
                    $par['whereCondition'] = "lower(resturant_id) LIKE '".strtolower($this->input->post("restrant_id"))."'";
                    $vsp    =   $this->resturant_model->getResturant($par);
                    if($vsp){
                        $data   =  $this->api_model->jsonencodevalues("3","Daily Status updated failed");
                        $vue    =  $this->apirestraint_model->delay_order();
                        if($vue){
                            $data   =   $this->api_model->jsonencodevalues("4","Daily Status updated successfully");
                        }
                    }
                }
            }
            echo ($data);
        }
}