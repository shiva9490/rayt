<?php
class Customers_model extends CI_Model{
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
	
	public function queryCustomers($params = array()){
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
    public function cntviewCustomers($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryCustomers($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getCustomers($params = array()){
        return $this->queryCustomers($params)->row_array();
    }
    public function viewCustomers($params = array()){
        //print_r($params);exit;
        return $this->queryCustomers($params)->result();
    }
    public function activedeactive($uri,$status){
        $dta    =   array(
            "customer_abc"              =>      $status,
            "customer_modified_on"     =>      date("Y-m-d h:i:s"),
            "customer_modified_by"   =>      $this->session->userdata("login_id")
        );
        $this->db->update("customers",$dta,array("customer_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_customers($uro){
        $dta    =   array(
            "customer_open"            =>  0, 
            "customer_modified_on"     =>      date("Y-m-d h:i:s"),
            "customer_modified_by"   =>      $this->session->userdata("login_id")
        );
        $this->db->update("customers",$dta,array("customer_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }

}
?>