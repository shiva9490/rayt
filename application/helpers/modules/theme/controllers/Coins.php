<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Coins extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
        public function buycoins(){
            $regdt     =   $this->session->userdata("register_id");
            $regidt    =   $this->session->userdata("register_type");
            $pms["whereCondition"]  =   "package_type = '".$regidt."'";
            $data   =   array(
                "title"     =>  "Buy Coins",
                "content"   =>  "buy_coins",
                "ctitle"    =>  "Buy Coins",
                "desc"      =>  "",
                "view"      =>  $this->package_model->viewPackage($pms)
            );
            if($this->input->post("submit")){
                $packageid  =   $this->input->post("packageid");
                redirect("/buy?package=".$packageid);
            }
            $this->load->view("theme/inner_template",$data);
        }
        public function buy(){
            $regdt      =   $this->session->userdata("register_id");
            $ridt       =   $this->input->get("package");
            $pms["whereCondition"]  =   "package_id = '".$ridt."'";
            $data['pkg']            =   $pkg    =   $this->package_model->getPackage($pms);
            $dms["whereCondition"]  =   "register_id = '".$regdt."'";
            $data['view']           =   $view   =   $this->api_model->getRegister($dms);
            $data['surl']           =   base_url("Pay-Success");
            $data['furl']           =   base_url("Pay-Failure");
            $data['pkgpackage_price']  =   $pkg["package_price"];
            $data['pkgin']      =   $pkg["package_name"];
            $data['merch']      =   $this->config->item("merchant_key");
            $data['payu_paisa'] =   "payu_paisa";
            if(empty($_POST['txnid'])) {
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            } else {
                $txnid = $_POST['txnid'];
            }
            $vsp    =   $this->tutor_model->inserttransactions($txnid);
            $data['txnid']      =   $txnid;
            $data['register_name']      =   $view["register_name"];
            $data['register_email']     =   $view["register_email"];
            $data['register_mobile']    =   $view["register_mobile"];
            $data["title"]              =   "pay";
            $data["desc"]               =   "pay";
            $data["content"]            =   "pay";
            $this->load->view("theme/inner_template",$data);
        }
        public function cancel(){
            $this->session->set_userdata("war","Payment has been cancelled");
            redirect("/Buy-Coins");
        }
        public function failure(){
            $data["ctitle"]   =   "Payments";
            $data["title"]    =   "Payment failed";
            $data["desc"]     =   "Payment failed";
            $data["content"]  =   "payfail";
            
            $status     =   $data["status"] =   $_POST["status"];
            $firstname  =   $_POST["firstname"];
            $amount     =   $data["amount"] =   $_POST["amount"];
            $txnid      =   $data["txnid"]  =   $_POST["txnid"];
            $posted_hash    =   $_POST["hash"];
            $key            =   $_POST["key"];
            $productinfo    =   $_POST["productinfo"];
            $email          =   $_POST["email"];
            $salt   =   $this->config->item("saltkey");
            If (isset($_POST["additionalCharges"])) {
                $additionalCharges   =   $_POST["additionalCharges"];
                $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
            } else {
                $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
            }
            $hash = hash("sha512", $retHashSeq);
            if ($hash != $posted_hash) {
                $data["war"]    =   "Invalid Transaction. Please try again";
            }
            $dat    =   $this->tutor_model->updatepaystatus();
            $this->load->view("theme/inner_template",$data);
        }
        public function success(){
            $data["ctitle"]   =   "Payments";
            $data["title"]    =   "Payment Successfully done";
            $data["desc"]     =   "Payment Successfully done";
            $data["content"]  =   "paysuccess";
            $status     =   $data["status"] =   $_POST["status"];
            $firstname  =   $_POST["firstname"];
            $amount     =   $data["amount"] =   $_POST["amount"];
            $txnid      =   $data["txnid"]  =   $_POST["txnid"];
            $posted_hash    =   $_POST["hash"];
            $key            =   $_POST["key"];
            $productinfo    =   $_POST["productinfo"];
            $email          =   $_POST["email"];
            $salt   =   $this->config->item("saltkey");
            If (isset($_POST["additionalCharges"])) {
                $additionalCharges   =   $_POST["additionalCharges"];
                $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
            } else {
                $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
            }
            $hash = hash("sha512", $retHashSeq);
            if ($hash != $posted_hash) {
                $data["war"]    =   "Invalid Transaction. Please try again";
            }
            $dat    =   $this->tutor_model->updatepaystatus();
            $dat    =   $this->tutor_model->updatecoins($txnid);
            $this->load->view("theme/inner_template",$data);
        }
}