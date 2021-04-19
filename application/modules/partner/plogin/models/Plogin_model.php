<?php
class Plogin_model extends CI_Model{
        public function queryrestraintlogin($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns",$params)){
                $sel    =   $params["columns"];
            }
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            $dta        =   array(
                "restraint_login_open"      =>  '1',
                "restraint_login_status"    =>  '1',
            );
            $this->db->select($sel)
                ->from("restraint_login")
				->join("resturant","restraint_login.restraint_id = resturant.resturant_id","inner")
                ->where($dta);
            if(array_key_exists('whereCondition', $params)){
                $this->db->where("(".$params['whereCondition'].")");
            }
            if(array_key_exists("ad_id",$params)){
                    $this->db->where("id > ",$params["ad_id"]);
            }
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                    $this->db->order_by($params['tipoOrderby'],$params['order_by']);
            } 
//            $this->db->get();echo $this->db->last_query();exit;
            return $this->db->get();
        }
        public function checkLogin(){ 
            $password       =   $this->input->post("password");
            $emails         =   $this->input->post("username");
            $parms['whereCondition']    =   "restraint_login_username ='".$emails."' AND
                    restraint_login_password = '".($password)."' AND restraint_login_abc = 'Active'";
            $vsp    =    $this->queryrestraintlogin($parms)->row_array();
			//print_r($vsp);exit;
            if(count($vsp) > 0){
                $ins   =   $vsp;
                $this->session->set_userdata("restraint_id",$ins['restraint_id']);
                $this->session->set_userdata("resturant_name",$ins['resturant_name']);
                $this->session->set_userdata("resturant_type",$ins['restraint_login_type']);
                $login_type = $ins['restraint_logintype'];
                $roles         =    $this->permission_model->get_permission($login_type);   
                if(count($roles) > 0){
                    foreach($roles  as $vp){
                        $this->session->set_userdata($vp->page_name,$vp->per_status);
                    }
                }
				//echo 	exit;
                return TRUE;
            } 
        } 
        public function checkvalueemail($username){
                $params["whereCondition"]   =   "restraint_login_username='".$username."'";
                $rev        =   $this->queryrestraintlogin($params)->row_array();
                if(is_array($rev) && count($rev) > 0){
                    return true; 
                }
                return false;
        }
        public function checkemail($fields,$username){  
                $params["whereCondition"]   =   'l.'.$fields.' LIKE "'.$username.'"';
                $rev        =   $this->queryuser($params)->row_array();
                if(is_array($rev) && count($rev) > 0){ 
                    return true; 
                }
                return false;
        }
        public function unique_values($fields,$uri){
                $params["cnt"]              =   '1';
                $params["whereCondition"]   =   "$fields LIKE '$uri'"; 
                $vsl        =   $this->queryuser($params)->row_array(); 
                if($vsl['cnt'] >  0){
                    return "false";
                }
                return "true";
        }
        public function check_unique_name($fields,$uri){
                $params["cnt"]              =   '1';
                $params["whereCondition"]      =   "$fields LIKE '$uri'"; 
                $vsl        =   $this->queryuser($params)->row_array(); 
                if($vsl['cnt'] ==  0){
                        return FALSE;
                }                       
                return TRUE;
        }
        public function cntviewUser($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryuser($params)->row_array();
                if(is_array($val) && count($val) > 0){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewUser($params  =    array()){ 
                return  $this->queryuser($params)->result();
        }
        public function getUser($params  =    array()){ 
                return  $this->queryuser($params)->row_array();
        }
        public function create_login(){
                $dta    =   array( 
                                "login_name"      =>    ucwords($this->input->post("user_name")),
                                "login_email"     =>    ($this->input->post("user_email")),
                                "login_password"  =>    base64_encode($this->input->post("password")),
                                "login_type"      =>    ($this->input->post("rolevalname")),
                                "login_cr_on"     =>    date("Y-m-d h:i:s"),
                                "login_cr_by"     =>    $this->session->userdata("login_id")
                            );
                $this->db->insert("login",$dta); 
                $vsp    =    $this->db->insert_id();
                if($vsp > 0){ 
                    $suplid     =   "LOGN".$vsp;
                    $vsp    =    $this->db->update("login",array("login_id" => $suplid),array("lid" => $vsp)); 
                    return TRUE;
                }
                return FALSE;
        }
        public function updatePassword($suplid){
                $dta    =   array(  
                                "login_password"  =>    base64_encode($this->input->post("new_password")),  
                                "login_md_on"     =>    date("Y-m-d h:i:s"),
                                "login_md_by"     =>    $this->session->userdata("login_id")
                            );
                $this->db->update("login",$dta,array("login_id" => $suplid));  
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function update_user($loginid){
                $dta    =   array( 
                                "login_name"      =>    ucwords($this->input->post("username")),
                                "login_email"     =>    ($this->input->post("useremail")), 
                                "login_type"      =>    ($this->input->post("rolevalname")),
                                "login_md_on"     =>    date("Y-m-d h:i:s"),
                                "login_password"  =>    base64_encode(($this->input->post("password"))),
                                "login_md_by"     =>    $this->session->userdata("login_id")
                            );
                $target_dir =   "uploads/";
                if(count($_FILES) > 0){
                    $fname      =   $_FILES["userfile"]["name"]; 
                    if($fname != ''){
                        $filename   =   $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$fname;
                        $vsp        =   explode(".",$fname);
                        $ect        =   end($vsp);  
                        if (file_exists($filename)) {
                            $fname      =   basename($fname,".".$ect)."_".date("YmdHis").".".$ect;
                        }
                        $uploadfile =   $target_dir . ($fname);
                        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                            $pic =  $fname;
                            $dta['login_image']  =   $fname;
                        }
                    }
                }
                $this->db->update("login",$dta,array("login_id" => $loginid)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function delete_user($loginid){
                $dta    =   array( 
                                "login_open"      =>    0,
                                "login_md_on"     =>    date("Y-m-d h:i:s"),
                                "login_md_by"     =>    $this->session->userdata("login_id")
                            );
                $this->db->update("login",$dta,array("login_id" => $loginid)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function activedeactive($uri,$status){
                $dta    =   array( 
                                "login_acde"      =>    $status,
                                "login_md_on"     =>    date("Y-m-d h:i:s"),
                                "login_md_by"     =>    $this->session->userdata("login_id")
                            );
                $this->db->update("login",$dta,array("login_id" => $uri)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function sendpassword(){
                $emailid 	=	$this->input->post("emailid");  
                $params["whereCondition"]      =   "login_email LIKE '$emailid'"; 
                $vsl        =   $this->queryuser($params)->row_array(); 
                $pass       =   base64_decode($vsl["login_password"]);  
                $config['protocol']    	= 'smtp';
                $config['smtp_host']    = sitedata('site_host');
                $config['smtp_port']    = sitedata("site_port"); 
                $config['smtp_user']    = sitedata("site_email");
                $config['smtp_pass']    = sitedata("site_emailpassword");
                $config['charset']    	= 'utf-8';
                $config['newline']    	= "\r\n";
                $config['mailtype'] 	= 'html'; // or html
                $config['validation'] 	= TRUE;
                $this->email->initialize($config);
                $this->email->from(sitedata("site_email"), 'Administrator'); 
                $this->email->to($emailid); 
                $this->email->subject('Forgot Password');
                $message 	=	"Dear User,<br/><br/>";
                $message	.=	"Please find the user credentials to login in to the portal.<br/>";
                $message	.=	"<a href='".adminurl("")."'>Click Here</a><br/>";
                $message	.=	"<b>Email Id</b>:".$emailid."<br/>";
                $message	.=	"<b>Password</b>:".$pass;
                $message	.=	"<br/><br/>";
                $message	.=	"<b>Regards</b><br/>";
                $message	.=	"<b style='color:blue;'>".sitedata("site_name")."</b>";
                $this->email->message($message);
                $result =  $this->email->send();
                //print_r($this->email->print_debugger());exit;
                if($result){    
                  return TRUE;	
                }
                return FALSE; 
        }
}