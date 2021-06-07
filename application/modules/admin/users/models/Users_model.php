<?php
class users_model extends CI_Model{
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
	public function create(){ 
        $d = array(		
            'login_name'	    =>  $this->input->post('user_name'),
            'login_password'	=>  base64_encode($this->input->post('user_password')),
            'login_email'		=>  $this->input->post('user_email'),
            'login_type'		=>  $this->input->post('user_role'),
            'login_acde'        =>  'Active',
            'login_open'        =>  1,
            'login_status'      =>  1,
            'login_cr_by'	    =>  ($this->session->userdata("login_id") !="")?$this->session->userdata("login_id"):'',
            'login_cr_on' 	    =>  date('Y-m-d H:i:s'),
        );
     
        $this->db->insert('login',$d);
        $login = $this->db->insert_id();   
        if($login > 0){ 
            $suplid     =    $login."login";
            $vsps    =    $this->db->where('lid',$login)->update("login",array("login_id" => $suplid)); 
          
            $data = array(        
                'user_id'                   => $login."login",
                'user_name'                 => $this->input->post('user_name'),
                'user_email'                => $this->input->post('user_email'),
                'user_phone'                => $this->input->post('user_phone'),
                'user_joining'              => $this->input->post('user_joining'),
                'user_role'                 => $this->input->post('user_role'),
                'user_experience'           => $this->input->post('user_experience'),           
                'user_status'				=> 'Active',
                'user_open'					=> 1,
                "user_created_by"           => date("Y-m-d h:i:s"),
                "user_created_on"           => $this->session->userdata("login_id")
            );   
            $this->db->insert("users_details",$data);
            $vsps   =    $this->db->insert_id();
            return true;       
	    }
        return TRUE;
    }
	public function queryUsers($params = array()){
        $dt =   array(
            "user_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("users_details as ud")
                    ->join("login  as l","ud.user_id = l.login_id","inner")
                    ->join('usertype as uty',"uty.ut_id= l.login_type","inner")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(user_name LIKE '%".$params["keywords"]."%')");
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
    //     $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
    public function cntviewUsers($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryUsers($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getUsers($params = array()){
        return $this->queryUsers($params)->row_array();
    }
    public function viewUsers($params = array()){
        //print_r($params);exit;
        return $this->queryUsers($params)->result();
    }
    public function activedeactive($uri,$status){
        $dta    =   array(
            "user_status"            =>      $status,
            "user_updated_on"        =>      date("Y-m-d h:i:s"),
            "user_updated_by"        =>      $this->session->userdata("login_id")
        );
        $this->db->update("users_details",$dta,array("user_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_Users($uro){
        $dta    =   array(
            "user_open"            =>  0, 
            "user_updated_on"       =>  date("Y-m-d h:i:s"),
            "user_updated_by"       =>  $this->session->userdata("login_id")
        );
        $this->db->update("users_details",$dta,array("user_id" => $uro));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function update_users($uro){
        $d = array(		
            'login_name'	    =>  $this->input->post('user_name'),
            'login_password'	=>  base64_encode($this->input->post('user_password')),
            'login_email'		=>  $this->input->post('user_email'),
            'login_type'		=>  $this->input->post('user_role'),
            'login_cr_by'	    =>  ($this->session->userdata("login_id") !="")?$this->session->userdata("login_id"):'',
            'login_cr_on' 	    =>  date('Y-m-d H:i:s'),
        );
        $this->db->where('login_id',$uro)->update("login",$d);
        $vsp = $this->db->affected_rows();         
      
        if($vsp > 0){           
          
            $data = array(
                'user_name'              => $this->input->post('user_name'),
                'user_email'             => $this->input->post('user_email'),
                'user_phone'             => $this->input->post('user_phone'),
                'user_joining'           => $this->input->post('user_joining'),
                'user_role'              => $this->input->post('user_role'),
                'user_experience'        => $this->input->post('user_experience'),           
                "user_updated_on"         => date("Y-m-d h:i:s"),
                "user_updated_by"         => $this->session->userdata("login_id")
            );               
            $this->db->update("users_details",$data,array("user_id" => $uro));
            $vsps   =    $this->db->affected_rows();              
            return true;
        }else{
            return false;    
        }
    }
    
 
}
?>