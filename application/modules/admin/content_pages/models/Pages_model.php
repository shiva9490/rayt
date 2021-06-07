<?php
class Pages_model extends CI_Model{
    public function create_page(){      
        $ft     =   array(                                                        
                         "cpage_title"            =>  $this->input->post("page_title"),
                         "cpage_key"       =>  str_replace(' ', '-', $this->input->post("page_title")),
                         "cpage_content"          => $this->input->post("page_description"), 
                         "cpage_created_on"       => date("Y-m-d h:i:s"),
                         "cpage_created_by"       => $this->session->userdata("login_id"),
                         "cpage_ac_de"            => 'Active',
                         'cpage_open'	         =>  1,
                         'cpage_status'		 =>  1,
                ); 
         $this->db->insert("content_pages",$ft);
         $vps    =   $this->db->insert_id();
         if($vps >  0){ 
             $this->db->update("content_pages",array("cpage_id" =>"CPAGE".$vps),array("cpageid" => $vps));
             return TRUE;
         }
         return FALSE;
    }
       
    public function querypages($params = array()){
        $dt =   array(
                "cpage_open"     =>  "1",
                "cpage_status"   =>  "1", 
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("content_pages")                 
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(cpage_title LIKE '%".$params["keywords"]."%')");
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
        if(array_key_exists("group_by",$params)){
                $this->db->group_by($params['group_by']);
        }
    //     $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
   
     public function cntviewpages($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->querypages($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getpages($params = array()){
        return $this->querypages($params)->row_array();
    }
    public function viewpages($params = array()){
        return $this->querypages($params)->result();
    }
    public function update_page($uri) {
        
        $ft     =   array( 
                "cpage_key"       =>  str_replace(' ', '-', $this->input->post("page_title")),
                "cpage_content"          => $this->input->post("page_description"),              
                "cpage_modified_on"       =>    date("Y-m-d h:i:s"),
                "cpage_modified_by"       =>    $this->session->userdata("user_id") 
        );    
       // echo "<pre>";print_r($ft);exit;
        $this->db->update("content_pages",$ft,array("cpage_id" => $uri));
        return $this->db->affected_rows();
    }       

  
    public function activedeactive($uri,$status){
        $dta    =   array(
                "cpage_ac_de"        =>      $status,
                "cpage_modified_on"      =>      date("Y-m-d h:i:s"),
                "cpage_modified_by"     =>      $this->session->userdata("login_id")
        );
        $this->db->update("content_pages",$dta,array("cpage_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_pages($uri){
        $dta    =   array(
                "cpage_open"            =>  0, 
                "cpage_modified_on"       =>  date("Y-m-d h:i:s"),
                "cpage_modified_by"       =>  $this->session->userdata("login_id")
        );
        $this->db->update("content_pages",$dta,array("cpage_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
}