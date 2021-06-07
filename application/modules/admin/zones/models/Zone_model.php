<?php
class Zone_model extends CI_Model{
    function add_zone(){
        $dta = array(
            'zone_name'      => $this->input->post('zoneName'),
            'zone_key_word'  => $this->common_config->cleanstr($this->input->post('zoneName')),
            'zone_add_by'    => $this->session->userdata("login_id"),
            'zone_add_date'  => date('Y-m-d H:i:s'),
        );
        $this->db->insert('zones',$dta);
        $id = $this->db->insert_id();
        if($id){
            $d = array(
                'zone_id' => "ZONE".$id,
            );
            $this->db->where('zoneid',$id)->update('zones',$d);
            return $this->addlag("ZONE".$id);
        }else{
            return false;
        }
    }
    public function addlag($id){
        $lat = $this->input->post('lat');
        if(is_array($lat) && count($lat) >0){
            foreach($lat as $i=>$l){
                $data = array(
                    'zone_id'           => $id,
                    'zonelist_lat'      => $this->input->post('lat')[$i],
                    'zonelist_lng'      => $this->input->post('lng')[$i],
                    'zonelist_add_by'   => $this->session->userdata("login_id"),
                    'zonelist_add_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('zone_list',$data);
                $ids = $this->db->insert_id();
                if($ids){
                    $d = array(
                        'zonelist_id' => "ZONELIST".$ids,
                    );
                    $this->db->where('zonelistid',$id)->update('zone_list',$d);
                }
            }
            return true;
        }else{
            return false;
        }
    }
    public function queryZones($params = array()){
        $dt =   array(
            "zone_open"     => '1',
            "zone_status"   => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("zones")
                    //->join("zone_list","zones.zone_id = zone_list.zone_id","INNER")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(zone_name LIKE '%".$params["keywords"]."%')");
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
    public function queryZoneList($params = array()){
        $dt =   array(
            "zonelist_open"     => '1',
            "zonelist_status"   => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("zone_list")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(zone_name LIKE '%".$params["keywords"]."%')");
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
    public function ViewoverzoneList($params = array()){
        return $this->queryoverzoneList($params)->result();
    }
    public function queryoverzoneList($params = array()){
        $dt =   array(
            "zl.zonelist_open"     => '1',
            "zl.zonelist_status"   => '1',
            "z.zone_open"       => '1',
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("zones as z")
                    ->join("zone_list as zl","z.zone_id = zl.zone_id","INNER")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(zone_name LIKE '%".$params["keywords"]."%')");
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
     public function cntviewZone($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryZones($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getZones($params = array()){
        return $this->queryZones($params)->row_array();
    }
    public function viewZones($params = array()){
        return $this->queryZones($params)->result();
    }
    public function viewZoneList($params = array()){
        return $this->queryZoneList($params)->result();
    }
    public function activedeactive($uri,$status){
        $dta    =   array(
            "zone_abc"           =>      $status,
            "zone_modify_date"   =>      date("Y-m-d h:i:s"),
            "zone_modify_by"     =>      $this->session->userdata("login_id")
        );
        $this->db->update("zones",$dta,array("zone_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_zones($uri){
        $dta    =   array(
            "zone_open"           =>      '0',
            "zone_modify_date"   =>      date("Y-m-d h:i:s"),
            "zone_modify_by"     =>      $this->session->userdata("login_id")
        );
        $this->db->update("zones",$dta,array("zone_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
}