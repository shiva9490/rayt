<?php
class Login_model extends CI_Model{
        public function queryuser($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns",$params)){
                $sel    =   $params["columns"];
            }
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            $dta        =   array(
                "l.login_status"    =>  '1',
                "l.login_open"      =>  '1',
                "u.ut_open"         =>  '1',
                "u.ut_status"       =>  '1',
            );
            $this->db->select($sel)
                ->from("login as l")
                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                ->where($dta);
            $scholid 	=	$this->session->userdata("login_school");
            if($scholid  != ""){
                $this->db->where("(login_school LIKE '".$scholid."' AND ut_name NOT LIKE 'School')");
            }
            if(array_key_exists('keywords', $params)){
                $scholid    =   $params['keywords'];
                $this->db->where("(login_name LIKE '".$scholid."' OR login_email  LIKE '".$scholid."' OR ut_name  LIKE '".$scholid."')");
            }
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
            $password       =   base64_encode($this->input->post("password"));
            $emails         =   $this->input->post("username");
            $parms['whereCondition']    =   "(l.login_name='".$emails."' OR l.login_email ='".$emails."') AND"
                    . " l.login_password = '".($password)."' AND l.login_acde = 'Active'";
            $vsp    =    $this->queryuser($parms)->row_array();  
            if(count($vsp) > 0){ 
                $ins   =   $vsp;
                $this->session->set_userdata("login_id",$ins['login_id']);
                $this->session->set_userdata("login_name",$ins['login_name']);
                $this->session->set_userdata("login_type",$ins['login_type']);
                $this->session->set_userdata("login_users",$ins['ut_name']);
                $login_type    =    $this->session->userdata("login_type");
                $roles         =    $this->permission_model->get_permission($login_type);   
                if(count($roles) > 0){
                    foreach($roles  as $vp){
                        $this->session->set_userdata($vp->page_name,$vp->per_status);
                    }
                } 
                return TRUE;
            } 
        } 
        public function checkvalueemail($username){  
                $params["whereCondition"]   =   "l.login_name='".$username."' OR l.login_email ='".$username."'";
                $rev        =   $this->queryuser($params)->row_array();
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
                //echo "<pre>";print_r($this->input->post());exit;
                $email_user 	=	$this->input->post("email_user");  
                $params["whereCondition"]      =   "login_email LIKE '$email_user' OR login_name LIKE '$email_user'"; 
                $vsl        =   $this->queryuser($params)->row_array(); 
                // echo "<pre>";print_r($vsl);exit;
                $pass       =   base64_decode($vsl["login_password"]);  
                // $config['protocol']    	= 'smtp';
                // $config['smtp_host']    = sitedata('site_host');
                // $config['smtp_port']    = sitedata("site_port"); 
                // $config['smtp_user']    = sitedata("site_email");
                // $config['smtp_pass']    = sitedata("site_emailpassword");
                // $config['charset']    	= 'utf-8';
                // $config['newline']    	= "\r\n";
                // $config['mailtype'] 	= 'html'; // or html
                // $config['validation'] 	= TRUE;
                // $this->email->initialize($config);
                // $this->email->from(sitedata("site_email"), 'Administrator'); 
                $toemail = $vsl['login_email']; 
                $subject = 'Forgot Password';
                $message 	=	"Dear $email_user,<br/><br/>";
                $message	.=	"Please find the user credentials to login in to the portal.<br/>";
                $message	.=	"<a href='".adminurl("")."'>Click Here</a><br/>";
                $message	.=	"<b>Email Id / User name</b>:".$email_user."<br/>";
                $message	.=	"<b>Password</b>:".$pass;
                $message	.=	"<br/><br/>";
                $message	.=	"<b>Regards</b><br/>";
                $message	.=	"<b style='color:blue;'>".sitedata("site_name")."</b>";
                $result =  $this->common_config->configemail($toemail,$subject,$message);
                if($result){    
                  return TRUE;	
                }
                return FALSE; 
        }
         public function checkvaluepassword(){ 
            $userpass = base64_encode($this->input->post('password'));           
            $params["whereCondition"]   =   "l.login_password LIKE '".$userpass."' AND l.login_id LIKE '".$this->session->userdata("login_id")."' ";
            $vsl        =   $this->queryuser($params)->row_array();         
           // echo "<pre>";print_r($vsl );exit;
            if(is_array($vsl) && count($vsl) > 0){ 
                return true; 
            }
            return false;
         }
         public function checkpassword($fields,$userpass){  
            $params["whereCondition"]   =   'l.'.$fields.' LIKE "'.$userpass.'"';
            $rev        =   $this->queryuser($params)->row_array();
            if(is_array($rev) && count($rev) > 0){ 
                return true; 
            }
                return false;
         }
         public function updatePassword($userid){
         
            $dta    =   array(  
                            "login_password"  =>    base64_encode($this->input->post("new_password")),  
                            "login_md_on"     =>    date("Y-m-d h:i:s"),
                            "login_md_by"     =>    $this->session->userdata("login_id")
                        );
                       // echo "<pre>";print_r($dta);exit;
            $this->db->update("login",$dta,array("login_id" => $userid));  
            $vsp    =    $this->db->affected_rows();
            if($vsp > 0){  
                return TRUE;
            }
            return FALSE;
        }
}