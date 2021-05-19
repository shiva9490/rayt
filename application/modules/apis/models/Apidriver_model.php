<?php
class Apidriver_model extends CI_Model{
    public function login($id){
        $dat    =   array(
            "driver_status_driver_id"   =>  $id,
            "driver_status_on" 	        =>  date("Y-m-d H:i:s"),
            "driver_status_for" 	    =>  'Login'
        );
        $this->db->insert("driver_login_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $this->db->update("driver_login_status",array("driver_status_id" => $vsp."DRILS"),array("driver_statusid" => $vsp));
            //address update
            $dat    =   array(
                "driver_address_driver_id"          =>  $id,
                "driver_address_latitude" 	        =>   $this->input->post("latitude"),
                "driver_address_longitude" 	        =>  $this->input->post("longitude"),
                "driver_address_login_status_id"    => $vsp."DRILS",
                "driver_address_time" 	            =>  date("Y-m-d h:i:s")
            );
            $this->db->insert("driver_address_update",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
            
                //echo $this->db->last_query();exit;
                if($this->db->affected_rows() > 0){
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."' and driver_login_password = '".$this->input->post("password")."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                    $details    =array(
                        'id'    =>  $vsp['driver_login_username'],
                        'name'  =>  $vsp['driver_name'],
                        'email' =>  $vsp['driver_email'],
                        'mobile'=>  $vsp['driver_phone'],
                        'zone'  =>  $vsp['zone_name'],
                        'image'  =>  base_url().'upload/drivers/'.$vsp['driver_profile_image'],
                        'status' => $vsp['driver_login_abc']
                    );
                    return $details;
                }
                return FALSE;
            }
        }
        
    }
    public function present_address_update($id){
        $dat    =   array(
            "driver_address_driver_id"   =>  $id,
            "driver_address_latitude" 	 =>   $this->input->post("latitude"),
            "driver_address_longitude" 	 =>  $this->input->post("longitude"),
            "driver_address_time" 	     =>  date("Y-m-d h:i:s")
        );
        $this->db->insert("driver_address_update",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
             $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
                return TRUE;
        }
        return FALSE;
    }
    public function logout($id){
        $dat    =   array(
            "driver_status_driver_id"   =>  $id,
            "driver_status_on" 	        =>  date("Y-m-d H:i:s"),
            "driver_status_for" 	    =>  'Logout'
        );
        $this->db->insert("driver_login_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $this->db->update("driver_login_status",array("driver_status_id" => $vsp."DRILS"),array("driver_statusid" => $vsp));
            //echo $this->db->last_query();exit;
            if($this->db->affected_rows() > 0){
                //address update
                $dat    =   array(
                    "driver_address_driver_id"          =>  $id,
                    "driver_address_latitude" 	        =>   $this->input->post("latitude"),
                    "driver_address_longitude" 	        =>  $this->input->post("longitude"),
                    "driver_address_login_status_id"    =>  $vsp."DRILS",
                    "driver_address_time" 	            =>  date("Y-m-d h:i:s")
                );
                $this->db->insert("driver_address_update",$dat);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
                }
                return TRUE;
            }
            return FALSE;
        }
    }
    public function activeInactive($id){
        if($this->input->post("status")=='0'){
            $status =   'Offline';
        }else if($this->input->post("status")=='1'){
            $status =   'Online';
        }
        $dat    =   array(
            "driver_status_driver_id"   =>  $id,
            "driver_status_on" 	        =>  date("Y-m-d H:i:s"),
            "driver_status_for" 	    =>  $status
        );
        $this->db->insert("driver_login_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
             $this->db->update("driver_login_status",array("driver_status_id" => $vsp."DRILS"),array("driver_statusid" => $vsp));
                //address update
                $dat    =   array(
                    "driver_address_driver_id"          =>  $id,
                    "driver_address_latitude" 	        =>   $this->input->post("latitude"),
                    "driver_address_longitude" 	        =>  $this->input->post("longitude"),
                    "driver_address_login_status_id"    =>  $vsp."DRILS",
                    "driver_address_time" 	            =>  date("Y-m-d h:i:s")
                );
                $this->db->insert("driver_address_update",$dat);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
                }
                return TRUE;
            
        }
    }
}