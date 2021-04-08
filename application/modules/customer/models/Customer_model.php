<?php
class Customer_model extends CI_Model{
	public function queryCustomer($params = array()){
        $dt =   array(
            "customer_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("customers")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(customer_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("image_inactive",$params)){
                $this->db->where("(".$params["image_inactive"].")");
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
        if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                $this->db->order_by($params['tipoOrderby'],$params['order_by']);
        }
    //     $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
    public function cntviewCountry($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryCountry($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getCustomer($params = array()){
        return $this->queryCustomer($params)->row_array();
    }
    public function viewCustomer($params = array()){
        return $this->queryCustomer($params)->result();
    }
    public function activedeactive($uri,$status){
        $dta    =   array(
            "country_abc"           =>      $status,
            "country_modify_by"     =>      date("Y-m-d h:i:s"),
            "country_modified_by"   =>      $this->session->userdata("login_id")
        );
        $this->db->update("country",$dta,array("country_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    
    public function createregister(){
        $mobile     =   $this->input->post("customer_mobile");
        $char = "bcdfghjkmnpqrstvzBCDFGHJKLMNPQRSTVWXZaeiouyAEIOUY";
        $token = '';
        for($i = 0; $i < 47; $i++)
        $token .= $char[(rand() % strlen($char))];
        $dta    =   array(
            "customer_name"         =>  $this->input->post("fname"),
            "customer_mobile"       =>  $this->input->post("mobile"),
            "customer_email_id"     =>  $this->input->post("email"),
            "customer_password"     =>  $this->input->post("password"),
            "customer_cpassword"    =>  $this->input->post("cpassword"),
            "customer_country"      =>  $this->input->post("country"),
            "customer_token"        =>  $token,
            "customer_created_on"   =>  date("Y-m-d H:i:s"),
            "customer_created_by"   =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
        );
        $this->db->insert("customers",$dta);
        if($this->db->insert_id() > 0){
            $this->db->where('customerid',$this->db->insert_id())->update('customers',array('customer_id'=>"CUST".$this->db->insert_id()));
            return TRUE;
        }
        return FALSE;
    }
    public function sendotp($mobile,$key = 0){
        if($this->input->post("email") !=""){
            $customer_mobile = $this->input->post("email");
        }else{
            $customer_mobile = $mobile;
        }
        $params["whereCondition"] =   "customer_mobile LIKE '".$customer_mobile."' OR customer_email_id LIKE '".$customer_mobile."'";
        $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
        if(is_array($vsp) && count($vsp) > 0){
            $rgcount    =   $vsp["customer_country"];
            $otp_key    =   1234;//rand(11111,99999);
            if($rgcount == sitedata("site_country")){
                $str        =   "Dear Customer,\nYour OTP verification key : ".$otp_key." for Minikart which expires in 10 mins\n";
                if($key == "0"){
                    $str        =   "Dear Vendor,\nYour OTP verification key : ".$otp_key." which expires in 10 mins\n";
                }
                $messge     =   urlencode($str);
                $vsp        =   1; //$this->mobile_otp->sendmobilemessage($mobile,$messge);
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
            }else{
                $dta    =   array(
                    "otp_key"           =>  $otp_key,
                    "otp_mobile_no"     =>  $mobile,
                    "otp_sent_time"     =>  date("Y-m-d H:i:s")
                );
                $this->db->insert("otp_log",$dta);
                
                $subject= "Profile Verficartion OTP Code";
                $toemail= $vsp['customer_email_id'];
                $messge= "<p>Dear ".$vsp['customer_name'].",</p>
                        <p>Greetings from Rayt</p>
                        <p>OTP : ".$otp_key."</p>
                        <p>Please feel free to write to us at support@rayt.com for any further assistance and clarification.</p>
                        <p>Best Regards,</p>
                        <p>Rayt Team</p>
                        '".sitedata("site_name")."'";
                    return $this->common_config->configemail($toemail,$subject,$messge);
                    
            }
        }else{
            return false;
        }
    }
    public function checkmobilestatus($mobile){
        $params["whereCondition"] =   "customer_mobile LIKE '".$mobile."' OR customer_email_id LIKE '".$mobile."'";
        $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
        if(is_array($vsp) && count($vsp) > 0){
            $d = array(
                'customer_email_verified' => 1,
                'customer_verified'       => 1,
                'customer_modified_by'    => $vsp['customer_id'],
                'customer_modified_on'    => date('Y-m-d H:i:s'),
            );
            return $this->db->where('customer_id',$vsp['customer_id'])->update('customers',$d);
        }else{
            return false;
        }
    }
    public function update_verification(){
        $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_email_id LIKE '".$this->input->post("customer_mobile")."'";
        $vsp    =   $this->queryCustomer($params)->row_array();
        if(isset($vsp)){
            if($this->input->post("customer_mobile") ==$vsp['customer_mobile']){
                $da = array('customer_verified_mobile'=>1,'customer_verified'=>1);
            }elseif($this->input->post("customer_mobile") == $vsp['customer_email_id']){
                $da = array('customer_email_verified'=>1,'customer_verified'=>1);
            }
            return $this->db->where('customer_mobile',$vsp['customer_mobile'])->update('customers',$da);
        }
    }
    public function update_customer($customer_id=null){
        $dta    =   array( 
            "customer_name"         =>  ucwords($this->input->post("fname")), 
            "customer_email_id"     =>  $this->input->post("email"),
            "customer_mobile"       =>  $this->input->post("mobile"),
            "customer_modified_on"  =>  date("Y-m-d H:i:s"),
            "customer_modified_by"  =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
        ); 
         if(count($_FILES) > 0){
            $target_dir =   $this->config->item("uploads_path")."customer-uploads/";
            $fname      =   $_FILES["customer_profile"]["name"];
            if($fname != "" && $fname != "noname"){
                $vsp        =   explode(".",$fname);
                $fname      =   $this->input->post("customer_mobile").".".$vsp['1'];
                $uploadfile =   $target_dir . basename($fname);
                $vsp 	=	move_uploaded_file($_FILES['customer_profile']['tmp_name'], $uploadfile); 
                if($vsp){
                    $dta['customer_profile'] =   $fname;
                }
            }
        }
        
        if($this->input->post("customer_token") !=""){
            $h  = "lower(customer_token) LIKE '".strtolower($this->input->post("customer_token"))."'";
        }if($customer_id !=""){
            $h = "customer_id LIKE '".$customer_id."'";
        }
        $params["whereCondition"] = $h;
        $vsp        =   $this->customer_model->queryCustomer($params)->row_array();
        $this->db->update("customers",$dta,array("customer_id"   =>  $vsp['customer_id']));
        if($this->db->affected_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
    public function forgotpassword($customer_id){
            $par['whereCondition'] = "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."'";
            $vsp    =   $this->customer_model->getCustomer($par);
            if(is_array($vsp) && count($vsp) > 0){
                $reg_mobile_verified    =   $vsp["customer_email_verified"];
                $reg_email_verified     =   $vsp["customer_verified_mobile"];
                $rgcount                =   $vsp["customer_country"];
                $toemail                 =   $vsp["customer_email_id"];
                $customer_name                 =   $vsp["customer_name"];
                $subject = "Rayt Reset Password link";
                $messge  = '<head>
                              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                              <meta name="viewport" content="width=device-width, initial-scale=1">
                              <style>
                                @media screen and (max-width: 720px) {
                                  body .c-v84rpm {
                                    width: 100% !important;
                                    max-width: 720px !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-1c86scm {
                                    display: none !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-pekv9n .c-1qv5bbj,
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-1c9o9ex .c-1qv5bbj,
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-90qmnj .c-1qv5bbj {
                                    border-width: 1px 0 0 !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-183lp8j .c-1qv5bbj {
                                    border-width: 1px 0 !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-pekv9n .c-1qv5bbj {
                                    padding-left: 12px !important;
                                    padding-right: 12px !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-1c9o9ex .c-1qv5bbj,
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-90qmnj .c-1qv5bbj {
                                    padding-left: 8px !important;
                                    padding-right: 8px !important;
                                  }
                                  body .c-v84rpm .c-ry4gth .c-1dhsbqv {
                                    display: none !important;
                                  }
                                }
                                @media screen and (max-width: 720px) {
                                  body .c-v84rpm .c-ry4gth .c-1vld4cz {
                                    padding-bottom: 10px !important;
                                  }
                                }
                              </style>
                              <title>Recover your Crisp password</title>
                            </head>
                            
                            <body style="margin: 0; padding: 0; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-stretch: normal; font-size: 14px; letter-spacing: .35px; background: #EFF3F6; color: #333333;">
                              <table border="1" cellpadding="0" cellspacing="0" align="center" class="c-v84rpm" style="border: 0 none; border-collapse: separate; width: 720px;" width="720">
                                <tbody>
                                  <tr class="c-1syf3pb" style="border: 0 none; border-collapse: separate; height: 114px;">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate;">
                                        <tbody>
                                          <tr align="center" class="c-1p7a68j" style="border: 0 none; border-collapse: separate; padding: 16px 0 15px;">
                                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle"><img alt="" src="'.base_url().'assets/images/logo.png" class="c-1shuxio" style="border: 0 none; line-height: 100%; outline: none; text-decoration: none; height: 33px; width: 120px;" width="120" height="33"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr class="c-7bgiy1" style="border: 0 none; border-collapse: separate; -webkit-box-shadow: 0 3px 5px rgba(0,0,0,0.04); -moz-box-shadow: 0 3px 5px rgba(0,0,0,0.04); box-shadow: 0 3px 5px rgba(0,0,0,0.04);">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate; width: 100%;" width="100%">
                                        <tbody>
                                          <tr class="c-pekv9n" style="border: 0 none; border-collapse: separate; text-align: center;" align="center">
                                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                              <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1qv5bbj" style="border: 0 none; border-collapse: separate; border-color: #E3E3E3; border-style: solid; width: 100%; border-width: 1px 1px 0; background: #FBFCFC; padding: 40px 54px 42px;">
                                                <tbody>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-1m9emfx c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; color: #1D2531; font-size: 25.45455px;"
                                                      valign="middle">'.$customer_name.', recover your password.</td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-46vhq4 c-4w6eli" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Roman&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Regular&quot;,&quot;HelveticaNeueRegular&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 400; color: #7F8FA4; font-size: 15.45455px; padding-top: 20px;"
                                                      valign="middle">Looks like you lost your password?</td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-eitm3s c-16v5f34" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; padding-top: 12px;"
                                                      valign="middle">We’re here to help. Click on the button below to change your password.</td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-rdekwa" style="border: 0 none; border-collapse: separate; vertical-align: middle; padding-top: 38px;" valign="middle">
                                                        <a href="'.base_url().'Update-password/'.base64_encode($toemail).'" target="_blank" class="c-1eb43lc c-1sypu9p c-16v5f34" style="color: #000000; -webkit-border-radius: 4px; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; line-height: 15px; display: inline-block; letter-spacing: .7px; text-decoration: none; -moz-border-radius: 4px; -ms-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; background-color: #288BD5; background-image: url(&quot;https://mail.crisp.chat/images/linear-gradient(-1deg,#137ECE2%,#288BD598%)&quot; );color: #ffffff; padding: 12px 24px;">Recover my password</a>
                                                    </td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-ryskht c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-size: 12.72727px; font-style: italic; padding-top: 52px;"
                                                      valign="middle">If you didn’t ask to recover your password, please ignore this email.</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                          
                                    <tr class="c-183lp8j" style="border: 0 none; border-collapse: separate;">
                                      <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                        <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1qv5bbj" style="border: 0 none; border-collapse: separate; border-color: #E3E3E3; border-style: solid; width: 100%; background: #FFFFFF; border-width: 1px; font-size: 11.81818px; text-align: center; padding: 18px 40px 20px;"
                                          align="center">
                                          <tbody>
                                            <tr style="border: 0 none; border-collapse: separate;">
                                              <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle"><span class="c-1w4lcwx">You receive this email because you or someone initiated a password recovery operation on your Crisp account.</span></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    </td>
                                  </tr>
                                  <tr class="c-ry4gth" style="border: 0 none; border-collapse: separate;">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1vld4cz" style="border: 0 none; border-collapse: separate; padding-bottom: 26px;">
                                        <tbody>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                              
                                              <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-15u37ze" style="border: 0 none; border-collapse: separate; font-size: 10.90909px; text-align: center; color: #7F8FA4; padding-top: 15px;" align="center">
                                                <tbody>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">© 2021 Minikart</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                            
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </body>';
                            //print_r($messge);exit;
                return $this->common_config->configemail($toemail,$subject,$messge);
                
            }
        }
}
?>