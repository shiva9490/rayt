<?php
class Api_model extends CI_Model{
	public function checkAuthorizationvalid(){
        $default_status =   "0";
        $auth           =   sitedata('site_authorization');
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
    public function countries(){
        $imgpth =   base_url().'assets/images/country/';
        $thisvs     =   $this->input->post("country_name");
        if($thisvs != ""){
            $params['whereCondition']      =   "country_name like '%".$thisvs."%'"; 
        }
        $params['columns']      =   "country_id,country_name,country_flag,country_isd,country_currencie"; 
        $params['tipoOrderby']  =   "country_name"; 
        $params['order_by']     =   "ASC";
        $country =  $this->country_model->viewCountry($params);
        $data = array();
        if(is_array($country) && count($country) > 0){
            foreach($country as $key=>$coun){
                $imsg   =  $imgpth.'Dummy_flag.png';//$coun->country_flag;
                $target_dir =  $imgpth.$coun->country_flag;
                if(@getimagesize($target_dir)){
                    $imsg   =   $target_dir;
                }
                $data[$key]['country_id']        = $coun->country_id;
                $data[$key]['country_name']      = $coun->country_name;
                $data[$key]['country_flag']      = $imsg;
                $data[$key]['country_isd']       = '+'.$coun->country_isd;
                $data[$key]['country_currencie'] = $coun->country_currencie;
            }
        }
        return $data;
    }
    public function loginemailsapi(){
            $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR  lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."' AND customer_password = '".$this->input->post("password")."'";
            $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
            if(is_array($vsp) && count($vsp) > 0){
                return $vsp;
            }
            return false;
    }
    public function verifyotp($otpno,$mobile,$verify = 0){
        $this->db->select('*')
                ->from('otp_log')
                ->where('otp_key',$otpno)
                ->where('otp_mobile_no',$mobile)
                //->where("TIMEDIFF(TIME(otp_sent_time), CURTIME()) <= '120'")
                ->where('otp_status','1');
        $response 	= 	$this->db->get();  
        $result 	= 	$response->row_array();
        if(isset($result) && count($result) > 0){
            $this->db->where('otp_id', $result['otp_id']);
            $this->db->update('otp_log',array('otp_status'=>'0')); 
            if($this->db->affected_rows() > 0){
                $check      =   $this->customer_model->checkmobilestatus($mobile);
                return TRUE; 
            }
        }
        return FALSE;
    }
    public function getprofile(){
        $params["whereCondition"] =   "lower(customer_token) LIKE '".strtolower($this->input->post("customer_token"))."'";
        $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
        if(is_array($vsp) && count($vsp) > 0){
            $data = array();
            foreach($vsp as $v){
                $data['customer_id']        = $vsp['customer_id']; 
                $data['customer_name']      = $vsp['customer_name'];
                $data['customer_email_id']  = $vsp['customer_email_id'];
                $data['customer_mobile']    = $vsp['customer_mobile'];
                $data['customer_token']     = $vsp['customer_token'];
            }
            return $data;
        }
        return false;
    }
    
}
?>