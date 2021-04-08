<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Api_model extends CI_Model{
        public function checkAuthorizationvalid(){
            $default_status =   "0";
            $auth           =   sitedata('authorization');
            $getallheaders  =   getallheaders();		
            $authorization_key = '';
            if(isset($getallheaders) && is_array($getallheaders) && count($getallheaders) >0){
                if(isset($getallheaders['Authorization']) && $getallheaders['Authorization'] !='') { $authorization_key = $getallheaders['Authorization']; }
                if(isset($authorization_key) && $authorization_key !=''){
                    $authorization_key = str_replace("key=","",$authorization_key);
                    $authorization_key = str_replace('"',"",$authorization_key);
                    $authorization_key = str_replace("'","",$authorization_key);
                    $authorization_key = trim($authorization_key);
                    if($authorization_key == trim($auth) ) { $default_status = 1; }
                }
            }
            return $default_status;
	    }
        public function jsonencodevalues($status,$status_message,$check = '1'){ 
            $json   =   array(
                "status"            =>  $status,
                "status_messsage"   =>  $status_message,
            );
            if($check == '0'){
                return $json;
            }
            return json_encode($json);
        }  
        public function saveToken(){
            $token_value        =   $this->input->post("token_value");
            $token_mobile       =   $this->input->post("token_mobile");
            $this->db->where("(token_mobile LIKE '".$token_mobile."' OR token_name LIKE '".$token_value."') AND token_open = '1'");
            $vsp    =   $this->db->get("tokens")->row();
            $dta   =    array(
                            "token_mobile"  =>  $token_mobile,
                            'token_name'    =>  $token_value
                        );
            if($vsp != "" && count($vsp) > 0){
                $dta["token_update"] = date("Y-m-d H:i:s");
                $this->db->update("tokens",$dta,array("token_id" => $vsp->token_id));
                if($this->db->affected_rows() > 0){
                    return TRUE;
                }
            }else{ 
                $dta["token_date"]  =  date("Y-m-d H:i:s");
                $this->db->insert("tokens",$dta);
                if($this->db->insert_id() > 0){
                    return TRUE;
                }
            }
            return FALSE;
        }
        public function idproofs(){
            $params['columns']  =   "idproof_id,idproof_name"; 
            $params['tipoOrderby']  =   "idproof_name"; 
            $params['order_by']     =   "ASC";
            return $this->id_proof_model->viewIdproof($params);
        }
        public function subjects(){
            $params['columns']      =   "subject_id,subject_name"; 
            $params['tipoOrderby']  =   "subject_name"; 
            $params['order_by']     =   "ASC";
            return $this->subject_model->viewSubject($params);
        }
        public function levelsvalues(){
            $params['columns']  =   "level_name,level_id"; 
            $params['tipoOrderby']  =   "level_name"; 
            $params['order_by']     =   "ASC";
            return $this->level_model->viewLevel($params);
        }
        public function organization(){
            $params['columns']  =   "institution_id,institution_name"; 
            $params['tipoOrderby']  =   "institution_name"; 
            $params['order_by']     =   "ASC";
            return $this->organization_model->viewOrganization($params);
        }
        public function opportunities(){
            $params['columns']  =   "institution_id as opportunity_id,institution_name  as opportunity_name"; 
            $params['tipoOrderby']  =   "institution_name"; 
            $params['order_by']     =   "ASC";
            return $this->organization_model->viewOrganization($params);
        }
        public function degree_type(){
            $params['columns']      =   "degree_id,degree_name"; 
            $params['tipoOrderby']  =   "degree_name"; 
            $params['order_by']     =   "ASC";
            return $this->degree_model->viewDegree($params);
        } 
        public function associations(){
            $vso     =   array();
            $associations   =   $this->config->item("associations");
            foreach($associations as $ve){
                $vso[]["associations"]  =   $ve;
            }
            return $vso;
        } 
        public function budgets(){
            $vso     =   array();
            $budgets   =   $this->config->item("budget");
            foreach($budgets as $ve){
                $vso[]["budgets"]  =   $ve;
            }
            return $vso;
        } 
        public function gender_prefernce(){
            $vso     =   array();
            $associations   =   $this->config->item("gender_prefernce");
            foreach($associations as $ve){
                $vso[]["gender_prefernce"]  =   $ve;
            }
            return $vso;
        } 
        public function time_preference(){
            $vso     =   array();
            $associations   =   $this->config->item("time_preference");
            foreach($associations as $ve){
                $vso[]["time_preference"]  =   $ve;
            }
            return $vso;
        } 
        public function tutoring_i_want(){
            $vso     =   array();
            $associations   =   $this->config->item("tutoring_i_want");
            foreach($associations as $ve){
                $vso[]["tutoring_i_want"]  =   $ve;
            }
            return $vso;
        } 
        public function tutors_wanted(){
            $vso     =   array();
            $associations   =   $this->config->item("tutors_wanted");
            foreach($associations as $ve){
                $vso[]["tutors_wanted"]  =   $ve;
            }
            return $vso;
        } 
        public function countries(){
            $thisvs     =   $this->input->post("country_name");
            if($thisvs != ""){
                $params['whereCondition']      =   "country_name like '%".$thisvs."%'"; 
            }
            $params['columns']      =   "countryid,country_name"; 
            $params['tipoOrderby']  =   "country_name"; 
            $params['order_by']     =   "ASC";
            return $this->common_model->viewCountries($params);
        }
        public function insert_register(){
            $regco      =   $this->input->post("countryid");
            $emailid    =   $this->input->post("emailid");
            $mobileno   =   $this->input->post("mobileno");
            $usery      =   $this->input->post("usertype");
            $register_emailcode     =   $this->common_config->getString("8");
            $data   =   array(
                "register_name"     =>  $this->input->post("fullname"),
                "register_mobile"   =>  $mobileno,
                "register_email"    =>  $emailid,
                "register_usertype"     =>  $this->input->post("usertype"),
                "register_password"     =>  base64_encode($this->input->post("password")),
                "register_country"      =>  $regco,
                "register_emailcode"    =>  $register_emailcode
            );
            $this->db->insert("register",$data);
            $vsp    =   $this->db->insert_id();
            if($vsp > 0){
                $erid       =   $vsp."SD";
                $uniq       =   "TUR". str_pad($vsp, 6, "0", STR_PAD_LEFT); 
                $target_dir =   "resources/";
                $fname  =   "";
                if(count($_FILES) > 0){
                    $fname      =   $_FILES["register_picture"]["name"]; 
                    $tname      =   $_FILES["register_picture"]["tmp_name"]; 
                    if($fname != ''){ 
                        $dvsp        =   explode(".",$fname);
                        $ect        =   end($dvsp);  
                        $fname      =   $uniq.".".$ect; 
                        $uploadfile =   $target_dir . ($fname);
                        if (move_uploaded_file($tname, $uploadfile)) {
                            $pic  =   $fname;
                        }
                    }
                } 
                $this->db->update("register",array("register_picture" => $fname,"register_unique" => $uniq,"register_id" => $erid),array("registerid" => $vsp));
                if($usery == 'Teacher'){
                    $da     =   array(
                        "tutor_register_id"  =>     $erid
                    );
                    $this->db->insert("tutors",$da);
                    $tsp    =   $this->db->insert_id();
                    $this->db->update("tutors",array("tutor_id" => $tsp."TR"),array("tutorid" => $tsp));
                }
                if($regco  == sitedata("site_country")){
                    $vso    =   $this->sendotp($mobileno);
                }else{
                    $vso    =   $this->sendmailotp($emailid,$register_emailcode);
                }
                return true;
            }
            return false;
        }
        public function verifyemailcode($emailid,$verifcode){
            $this->db->update("register",array("reg_email_verified" => "1","register_modified_on" => date("Y-m-d H:i:s")),array("register_emailcode" => $verifcode,"register_email" => $emailid));
            if($this->db->affected_rows() > 0){
                return true;
            }
            return false;
        }
        public function resendemailcode($emailid){
            $register_emailcode     =   $this->common_config->getString("8");
            $this->db->update("register",array("register_emailcode" => $register_emailcode),array("register_email" => $emailid));
            if($this->db->affected_rows() > 0){
                return true;
            }
            return false;
        }
        public function sendmailotp($emailid,$register_emailcode){
            $msga   =   '<!doctype html>
                            <html>
                              <head>
                                <meta name="viewport" content="width=device-width" />
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>User Login Credentials</title>
                                <style>
                                  img {
                                        border: none;
                                        -ms-interpolation-mode: bicubic;
                                        max-width: 100%; 
                                  } 
                                  body {
                                    background-color: #f6f6f6;
                                    font-family: sans-serif;
                                    -webkit-font-smoothing: antialiased;
                                    font-size: 14px;
                                    line-height: 1.4;
                                    margin: 0;
                                    padding: 0;
                                    -ms-text-size-adjust: 100%;
                                    -webkit-text-size-adjust: 100%; 
                                  }

                                  table {
                                    border-collapse: separate;
                                    mso-table-lspace: 0pt;
                                    mso-table-rspace: 0pt;
                                    width: 100%; }
                                    table td {
                                      font-family: sans-serif;
                                      font-size: 14px;
                                      vertical-align: top; 
                                  }
                                  .body {
                                    background-color: #f6f6f6;
                                    width: 100%; 
                                  }
                                     .container {
                                    display: block;
                                    margin: 0 auto !important;
                                    max-width: 580px;
                                    padding: 10px;
                                    width: 580px; 
                                  } 
                                  .content {
                                    box-sizing: border-box;
                                    display: block;
                                    margin: 0 auto;
                                    max-width: 580px;
                                    padding: 10px; 
                                  }
                                  .main {
                                    background: #ffffff;
                                    border-radius: 3px;
                                    width: 100%; 
                                  }

                                  .wrapper {
                                    box-sizing: border-box;
                                    padding: 20px; 
                                  }

                                  .content-block {
                                    padding-bottom: 10px;
                                    padding-top: 10px;
                                  }

                                  .footer {
                                    clear: both;
                                    margin-top: 10px;
                                    text-align: center;
                                    width: 100%; 
                                  }
                                    .footer td,
                                    .footer p,
                                    .footer span,624
                                    .footer a {
                                      color: #999999;
                                      font-size: 12px;
                                      text-align: center; 
                                  }
                                  h1,
                                  h2,
                                  h3,
                                  h4 {
                                    color: #000000;
                                    font-family: sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    margin: 0;
                                    margin-bottom: 30px; 
                                  }

                                  h1 {
                                    font-size: 35px;
                                    font-weight: 300;
                                    text-align: center;
                                    text-transform: capitalize; 
                                  }

                                  p,
                                  ul,
                                  ol {
                                    font-family: sans-serif;
                                    font-size: 14px;
                                    font-weight: normal;
                                    margin: 0;
                                    margin-bottom: 15px; 
                                  }
                                    p li,
                                    ul li,
                                    ol li {
                                      list-style-position: inside;
                                      margin-left: 5px; 
                                  }

                                  a {
                                    color: #3498db;
                                    text-decoration: underline; 
                                  }
                                  .btn {
                                    box-sizing: border-box;
                                    width: 100%; }
                                    .btn > tbody > tr > td {
                                      padding-bottom: 15px; }
                                    .btn table {
                                      width: auto; 
                                  }
                                    .btn table td {
                                        background-color: #ffffff;
                                        border-radius: 5px;
                                        text-align: center; 
                                    }
                                    .btn a {
                                      background-color: #ffffff;
                                      border: solid 1px #3498db;
                                      border-radius: 5px;
                                      box-sizing: border-box;
                                      color: #3498db;
                                      cursor: pointer;
                                      display: inline-block;
                                      font-size: 14px;
                                      font-weight: bold;
                                      margin: 0;
                                      padding: 5px 20px;
                                      text-decoration: none;
                                      text-transform: capitalize; 
                                  }

                                  .btn-primary table td {
                                    background-color: #3498db; 
                                  }

                                  .btn-primary a {
                                    background-color: #3498db;
                                    border-color: #3498db;
                                    color: #ffffff; 
                                  }
                                  .last {
                                    margin-bottom: 0; 
                                  }

                                  .first {
                                    margin-top: 0; 
                                  }

                                  .align-center {
                                    text-align: center; 
                                  }

                                  .align-right {
                                    text-align: right; 
                                  }

                                  .align-left {
                                    text-align: left; 
                                  }

                                  .clear {
                                    clear: both; 
                                  }

                                  .mt0 {
                                    margin-top: 0; 
                                  }

                                  .mb0 {
                                    margin-bottom: 0; 
                                  }

                                  .preheader {
                                    color: transparent;
                                    display: none;
                                    height: 0;
                                    max-height: 0;
                                    max-width: 0;
                                    opacity: 0;
                                    overflow: hidden;
                                    mso-hide: all;
                                    visibility: hidden;
                                    width: 0; 
                                  }

                                  .powered-by a {
                                    text-decoration: none; 
                                  }

                                  hr {
                                    border: 0;
                                    border-bottom: 1px solid #f6f6f6;
                                    margin: 20px 0; 
                                  }
                                    .tablevalue tr td{
                                        padding:10px;
                                        font-size:15px;
                                    }
                                    .tablevalue tr td:first-child{
                                        color:green;
                                        font-weight:550;
                                    }
                                  @media only screen and (max-width: 620px) {
                                    table[class=body] h1 {
                                      font-size: 28px !important;
                                      margin-bottom: 10px !important; 
                                    }
                                    table[class=body] p,
                                    table[class=body] ul,
                                    table[class=body] ol,
                                    table[class=body] td,
                                    table[class=body] span,
                                    table[class=body] a {
                                      font-size: 16px !important; 
                                    }
                                    table[class=body] .wrapper,
                                    table[class=body] .article {
                                      padding: 10px !important; 
                                    }
                                    table[class=body] .content {
                                      padding: 0 !important; 
                                    }
                                    table[class=body] .container {
                                      padding: 0 !important;
                                      width: 100% !important; 
                                    }
                                    table[class=body] .main {
                                      border-left-width: 0 !important;
                                      border-radius: 0 !important;
                                      border-right-width: 0 !important; 
                                    }
                                    table[class=body] .btn table {
                                      width: 100% !important; 
                                    }
                                    table[class=body] .btn a {
                                      width: 100% !important; 
                                    }
                                    table[class=body] .img-responsive {
                                      height: auto !important;
                                      max-width: 100% !important;
                                      width: auto !important; 
                                    }
                                  }
                                  @media all {
                                    .ExternalClass {
                                      width: 100%; 
                                    }
                                    .ExternalClass,
                                    .ExternalClass p,
                                    .ExternalClass span,
                                    .ExternalClass font,
                                    .ExternalClass td,
                                    .ExternalClass div {
                                      line-height: 100%; 
                                    }
                                    .apple-link a {
                                      color: inherit !important;
                                      font-family: inherit !important;
                                      font-size: inherit !important;
                                      font-weight: inherit !important;
                                      line-height: inherit !important;
                                      text-decoration: none !important; 
                                    }
                                    #MessageViewBody a {
                                      color: inherit;
                                      text-decoration: none;
                                      font-size: inherit;
                                      font-family: inherit;
                                      font-weight: inherit;
                                      line-height: inherit;
                                    }
                                    .btn-primary table td:hover {
                                      background-color: #34495e !important; 
                                    }
                                    .btn-primary a:hover {
                                        background-color: #34495e !important;
                                        border-color: #34495e !important; 
                                    } 
                                  }
                                </style>
                              </head>
                              <body class="">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="container">
                                      <div class="content">
                                        <table role="presentation" class="main">
                                          <tr>
                                            <td class="wrapper">
                                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td style="border-radius:10px;background-color:rgba(12,106,167,0.8);padding:10px 5rem;">
                                                    <img src="'.$this->config->item('themeassets').'logo.png">             
                                                </td>
                                               </tr>
                                                <tr>
                                                  <td>
                                                    <p style="margin-top:10px;">Dear User,</p>
                                                    <p>Please click on the below URL</p>
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                                      <tbody>
                                                        <tr>
                                                          <td align="left">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                              <tbody>
                                                                <tr>
                                                                  <td> <button style="background-color:#efefef;">'.$register_emailcode.'</button> </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                    <b>Regards</b><br/>
                                                    <p>'.sitedata("site_name").'</p>
                                                  </td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                        <div class="footer">
                                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td class="content-block powered-by">
                                                Powered by <a href="'. base_url().'">'.sitedata("site_name").'</a>.
                                              </td>
                                            </tr>
                                          </table>
                                        </div>
                                      </div>
                                    </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
                              </body>
                            </html>';
            $datamsd    =   array(
                "email_to"    		=>  $emailid,
                "email_message"   	=>  $msga,
                "email_created_on"	=>  date("Y-m-d H:i:s")
            );
            $smslog     =   $this->db->insert("email_log",$datamsd);
            $ssm        =   $this->db->insert_id();
            $vsp    =   $this->common_config->configemail($emailid,"Verification Code",$msga);
            if($vsp){
              	$this->db->update("email_log",array("email_sent" => "1"),array("emailid" => $ssm));
            }
            return $msga;
        }
        public function sendotp($mobile){ 
            $otp_key    =   rand(0000,99999);
            $str        =   "Dear User,\nYour OTP verification key - Expires in 10 min\n"
                    . "$otp_key";
            $messge     =   urlencode($str);
            $vsp        =   $this->common_config->sendmessagemobile($mobile,$messge);
            if($vsp){
                $dta    =   array(
                    "otp_key"           =>  $otp_key,
                    "otp_mobile_no"     =>  $mobile,
                    "otp_sent_time"     =>  date("Y-m-d H:i:s")
                );
                $this->db->insert("otp_log",$dta);
                return TRUE;
            }
            return FALSE;
        } 
        public function verifyotp($mobile){
            $this->db->select('*')
                    ->from('otp_log')
                    ->where('otp_key',$this->input->post('otp_no'))
                    ->where('otp_mobile_no',$mobile)
                    ->where("TIMEDIFF(TIME(otp_sent_time), '".date("H:i:s")."') <= '10'")
                    ->where('otp_status','0'); 
            $response 	= 	$this->db->get();  
//            echo $this->db->last_query();exit;
            $result 	= 	$response->row_array();  
            if(is_array($result) && count($result)>0){
                $this->db->where('otpid', $result['otpid']);
                $this->db->update('otp_log',array('otp_status'=>'1')); 
                $this->db->update("register",array("reg_mobile_verified" => "1","register_modified_on" => date("Y-m-d H:i:s")),array("register_mobile" => $mobile));
                return TRUE;   
            }
            return FALSE;
        }
        public function checkmobilestatus(){
            $mobile     =   $this->input->post("mobile_no");
            $pms["whereCondition"]      =   "reg_mobile LIKE '".$mobile."'";
            $vsp        =   $this->getRegister($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return FALSE;
            }
            return TRUE; 
        }
        public function queryRegister($params = array()){
            $dt         =   array(
                                "register_status"      =>     '1',
                                "register_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("register")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(register_email like '%".$params["keywords"]."% or register_mobile like '%".$params["keywords"]."%' or register_name LIKE '%".$params["keywords"]."%')");
            }
            if(array_key_exists("whereCondition",$params)){
                    $this->db->where("(".$params["whereCondition"].")");
            }
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
            }
            if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                    $this->db->order_by($params['tipoOrderby'],$params['order_by']);
            } 
//                $this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get(); 
        }
        public function cntviewRegister($params  = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryRegister($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewRegister($params  = array()){
            return  $this->queryRegister($params)->result();
        }
        public function getRegister($params  = array()){
            return  $this->queryRegister($params)->row_array();
        }
        public function checklogin(){
            $usern  =   $this->input->post("mobileno");
            $pass   =   $this->input->post("password");
            $ash    =   base64_encode($pass);
            $psm["whereCondition"]  =   "(register_email = '".$usern."' or register_mobile = '".$usern."') and register_password ='".$ash."'";
            $vsp    =   $this->getRegister($psm);
            if(is_array($vsp) && count($vsp) > 0){
                $this->session->set_userdata("register_id",$vsp["register_id"]);
                $this->session->set_userdata("register_type",$vsp["register_usertype"]);
                return "1";
            }
            return "0";
        }
        public function unique_emailid($mobile,$uri){
                $params["cnt"]              =   '1';
                $params['whereCondition']     =   "($mobile like '".$uri."')";
                $vsl        =    $this->queryRegister($params)->row_array();
                if($vsl["cnt"] > 0){
                    return "false";
                }
                return "true";
        }
        public function checkemailteacher($emaild){
            $pmsd['whereCondition']     =   "(register_email like '".$emaild."' or register_mobile like '".$emaild."')";
            $vsop    =   $this->api_model->getRegister($pmsd);
            if(is_array($vsop) && count($vsop) > 0){
                return $vsop;
            }
            return array();
        }
        public function checkapilogin(){
            $usern  =   $this->input->post("username");
            $pass   =   $this->input->post("password");
            $ash    =   base64_encode($pass);
            $vsp    =   $this->config->item("resources");
            $psm["columns"]         =   "reg_email_verified,reg_mobile_verified,register_country,concat('".$vsp."',register_picture) as register_picture,register_unique,register_name,register_mobile,register_email,register_gender,register_iswhatsapp,register_whatsapp,register_language,register_usertype";
            $psm["whereCondition"]  =   "(register_email = '".$usern."' or register_mobile = '".$usern."') and register_password ='".$ash."'";
            $vsp    =   $this->api_model->getRegister($psm);
            if(is_array($vsp) && count($vsp) > 0){
                return $vsp;
            }
            return array();
        }
        public function appcontent(){
            $pms["columns"]         =   "cpage_app_name,cpage_content";
            $pms["whereCondition"]  =   "cpage_app = 1";
            $vsp    =   $this->pages_model->view_contentpages($pms);
            $vsv    =   array();
            foreach($vsp as $ve){
                $vsv[$ve->cpage_app_name]    =   $ve->cpage_content;
            }
            return $vsv;
        }
        public function checklogintype(){
            $usern  =   $this->input->post("register_unique");
            $psm["columns"]         =   "register_usertype,register_admin";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->api_model->getRegister($psm);
            $register_admin         =   $vsp["register_admin"];
            $vsregister_usertype    =   $vsp["register_usertype"];
            if($vsregister_usertype == "Teacher"){
                if($register_admin == "0"){
                    return 1;
                }
            }
            return 0;
        }
        public function getBasicdetails(){
            $usern  =   $this->input->post("register_unique"); 
            $vsp    =   $this->config->item("resources");
            $psm["columns"]         =   "register_unique,register_name,register_mobile,register_email,register_gender,register_iswhatsapp,register_whatsapp,register_language,register_usertype,register_wallet,register_designation,register_experience,reg_email_verified,reg_mobile_verified,register_country,concat('".$vsp."',register_picture) as register_picture";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->api_model->getRegister($psm); 
            return $vsp;
        }
        public function getaddrressdetails(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "tutor_state,tutor_street,tutor_latitude,tutor_longitude,tutor_address,tutor_pincode";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->getTutor($psm); 
            return $vsp;
        }
        public function gettutordetails(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "tutor_fee_charge,tutor_minimum_fee,tutor_maximum_fee,tutor_fee_details,tutor_years_experience,tutor_teaching_experience,tutor_online_experience,tutor_willing,tutor_travel_distance,tutor_online_teaching,tutor_digital_pen,tutor_homework,tutor_opportunities,tutor_employed";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->getTutor($psm); 
            return $vsp;
        }
        public function getprofiledetails(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "tutor_description";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->getTutor($psm); 
            return $vsp;
        }
        public function getsubjectdetails(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "tutorsubject_id,subject_name,fdr.level_name as tolevel,fr.level_name as fromlevel";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->viewtutorSubjects($psm); 
            return $vsp;
        }
        public function geteducationdetails(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "experince_id,institution_name,degree_name,experince_start_year,experince_end_year,experince_assoication,experince_speciality,experince_score";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->viewtutorEducation($psm); 
            return $vsp;
        }
        public function getteachingdetails(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "a.*";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->viewtutorTeachexperience($psm); 
            return $vsp;
        }
        public function getidproofs(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "tutor_idproof,idproof_name,tutor_upload";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->tutor_model->getTutor($psm); 
            if(is_array($vsp) && count($vsp) > 0){
                $vsptutor_upload    =   $vsp["tutor_upload"];
                $ssp    =   ($vsptutor_upload != "")?array_filter(unserialize($vsptutor_upload)):array();
                $sfer    =   array();
                if(count($ssp) > 0){
                    foreach($ssp as $kye => $fer){
                        $sfer[$kye]["images"]    =   $this->config->item("resources").$fer;
                    }
                }
                $vsp    =   array(
                    "tutor_idproof"  =>  $vsp["tutor_idproof"],
                    "idproof_name"   =>  $vsp["idproof_name"],
                    "tutor_idupload" =>  $sfer
                );
                return $vsp;
            }
            return array();
        }
        public function alllist(){
            $usern  =   $this->input->post("register_unique");
            $psm["columns"]         =   "register_usertype,register_admin";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->api_model->getRegister($psm); 
            $vsregister_usertype    =   $vsp["register_usertype"];
            if($vsregister_usertype == "Teacher"){
                return $this->tutor_model->allviewlist();
            }else{
                return $this->tutor_model->allprofilelist();
            }
            return array();
        }
        public function getrequirements(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "s.student_unique";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $psm["tipoOrderby"] =   "studentid";
            $psm["order_by"]    =   "DESC";
            $vsp                =   $this->student_model->getStudent($psm); 
            return $vsp["student_unique"];
        }
        public function getrequirementsvalue(){
//            $student_unique     =   $this->input->post("student_unique");
            $usern              =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "s.*";
//            $psm["whereCondition"]  =   "(register_unique = '".$usern."') and student_unique = '".$student_unique."'";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $psm["tipoOrderby"] =   "studentid";
            $psm["order_by"]    =   "DESC";
            $vsp                =   $this->student_model->getStudent($psm);
            return $vsp;
        }
        public function mysposts(){
            $usern  =   $this->input->post("register_unique"); 
            $psm["columns"]         =   "s.*,level_name";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $psm["tipoOrderby"] =   "studentid";
            $psm["order_by"]    =   "DESC";
            $vsp                =   $this->student_model->viewStudent($psm); 
            $vspp   =   array();
            if(count($vsp) > 0){
                foreach($vsp as $ve){
                    $stud   =   array();
                    $vspp   =   $ve;
                    $sub    =   $ve->student_subjects; 
                    $lo         =   $stud       =   $msh    =   array();
                    $cpic       =   $ve->student_myplace;
                    $lpic       =   $ve->student_online;
                    $mpic       =   $ve->student_tutor;
                    $loc        =   $ve->location;
                    if($cpic == "1"){
                        $lo[]     =    "Home";
                    }
                    if($lpic   ==  "1"){
                        $lo[]   =   "Online";
                    }
                    if($mpic   ==  "1"){
                        $lo[]   =   "Traveling";
                    }
                    $ksl    =   "0";
                    $lcpic  =   ($sub != "")?array_filter(explode(",",$sub)):array();
                    if(count($lcpic) > 0){
                        foreach($lcpic as $ev){
                            $ksl++;
                            $params["whereCondition"]  =   "subject_id = '".$ev."'";
                            $vdp        =   $this->subject_model->getSubject($params);
                            $mks        =   $vdp["subject_name"];
                            if($ksl < 2){
                                $msh[]    =   $mks;
                            }
                            $stud[]     =   $mks;
                        }
                    }
                    $vspp       =   $ve;
                    $msg        =   " tutor required in ".$loc;
                    $vspp->student_title    =   implode(" | ",$lo)." ".implode(",",$msh).$msg;
                    $vspp->subjects         =   implode(",",$stud);
                }
            }
            return $vspp;
        }
        public function packages(){
            $usern  =   $this->input->post("register_unique");
            $psm["columns"]         =   "register_usertype,register_admin";
            $psm["whereCondition"]  =   "(register_unique = '".$usern."')";
            $vsp                    =   $this->api_model->getRegister($psm); 
            $vsregister_usertype    =   $vsp["register_usertype"];
            
            $pms["columns"]         =   "package_id,package_name,package_price,package_coins";
            $pms["tipoOrderby"]     =   "packageid";
            $pms["order_by"]        =   "desc";
            $pms["whereCondition"]  =   "package_type = '".$vsregister_usertype."'";
            
            $view   =   $this->package_model->viewPackage($pms);
            return $view;
        }
}