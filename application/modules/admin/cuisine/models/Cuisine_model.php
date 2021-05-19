<?php
class Cuisine_model extends CI_Model{
    public function create_cuisine(){
            $dta    =   array(
                            "cuisine_name"           =>  ucwords($this->input->post("cuisine_name")),
                            "cuisine_created_on"     =>  date("Y-m-d h:i:s"),
                            "cuisine_created_by"     =>  $this->session->userdata("login_id")
                        );
            $this->db->insert("cuisine",$dta);
            $vps    =   $this->db->insert_id();
            if($vps >  0){ 
                $this->db->update("cuisine",array("cuisine_id" => $vps."CUI"),array("cuisineid" => $vps));
                return TRUE;
            }
            return FALSE;
    }
    public function query_cuisines($params = array()){
            $dt         =   array(
                                "cuisine_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("cuisine")
                        ->where($dt);
            if(array_key_exists("unique_cuisine",$params)){
                    $this->db->where("(cuisine_name LIKE '".$params["unique_cuisine"]."')");
            }
            if(array_key_exists("whereCondition",$params)){
                $this->db->where($params["whereCondition"]);
            }
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(cuisine_name LIKE '%".$params["keywords"]."%')");
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
    public function cntview_cuisine($params  =    array()){
            $params["cnt"]      =   "1";
            $val    =   $this->query_cuisines($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function view_cuisine($params  =    array()){
            return  $this->query_cuisines($params)->result();
    }
    public function get_cuisine($params  =    array()){
            return  $this->query_cuisines($params)->result();
    }
    public function update_cuisine($uri) {
            $dta    =   array( 
                    "cuisine_name"            =>      ucwords($this->input->post("cuisine_name")),
                    "cuisine_modified_on"     =>      date("Y-m-d h:i:s"),
                    "cuisine_modified_by"     =>      $this->session->userdata("login_id")
            );    
            $this->db->update("cuisine",$dta,array("cuisine_id" => $uri));
            if($this->db->affected_rows() >  0){
                    return TRUE;
            }
            return FALSE;
    }
    public function activedeactive($uri,$status) {
            $dta    =   array( 
                                "cuisine_acde"            =>      $status,
                                "cuisine_modified_on"     =>      date("Y-m-d h:i:s"),
                                "cuisine_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("cuisine",$dta,array("cuisine_id" => $uri));
            if($this->db->affected_rows() >  0){
                    return TRUE;
            }
            return FALSE;
    }
    public function delete_cuisine($uri) {
            $dta    =   array( 
                            "cuisine_open"            =>      '0',
                            "cuisine_modified_on"     =>      date("Y-m-d h:i:s"),
                            "cuisine_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("cuisine",$dta,array("cuisine_id" => $uri));
            if($this->db->affected_rows() >  0){
                return $this->db->affected_rows();
            }
            return FALSE;
    }
    public function check_unique_cuisine($uri){
            $params["cnt"]              =   '1';
            $params["unique_cuisine"]      =   $uri;
            $params["ad_id"]            =   "1";
            $vsl        =   $this->query_cuisines($params)->row(); 
            if($vsl->cnt ==  0){
                    return FALSE;
            }                       
            return TRUE;
    }
}
?>