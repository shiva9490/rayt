<?php
class Country_model extends CI_Model{
	public function queryCountry($params = array()){
        $dt =   array(
            "country_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("country")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(country_name LIKE '%".$params["keywords"]."%')");
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
    public function getCountry($params = array()){
        return $this->queryCountry($params)->row_array();
    }
    public function viewCountry($params = array()){
        return $this->queryCountry($params)->result();
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
    
    public function delete_country($uro){
        $dta    =   array(
            "country_open"            =>  0, 
            "country_modify_by"     =>      date("Y-m-d h:i:s"),
            "country_modified_by"   =>      $this->session->userdata("login_id")
        );
        $this->db->update("country",$dta,array("country_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
}
?>