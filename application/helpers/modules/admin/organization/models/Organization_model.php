<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Organization_model extends CI_Model{
        public function createOrganization(){
            $dat    =   array(
                "institution_name"       =>  $this->input->post("organization_name"),
                "institution_created_on" =>  date("Y-m-d H:i:s"),
                "institution_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("institution",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("institution",array("institution_id" => $vsp."DT"),array("institutionid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_organization($uro){
            $dat    =   array(
                "institution_name"       =>  $this->input->post("institutionname"),
                "institution_modified_on" =>  date("Y-m-d H:i:s"),
                "institution_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("institution",$dat,array("institution_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function delete_organization($uro){
            $dat    =   array(
                "institution_open"       =>  0,
                "institution_modified_on" =>  date("Y-m-d H:i:s"),
                "institution_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("institution",$dat,array("institution_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "institution_acde"            =>      $status,
                            "institution_modified_on"     =>      date("Y-m-d h:i:s"),
                            "institution_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("institution",$dta,array("institution_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function queryOrganization($params = array()){
            $dt         =   array(
                                "institution_status"      =>     '1',
                                "institution_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("institution")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(institution_name LIKE '%".$params["keywords"]."%')");
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
//                $this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get();    
        }
        public function cntviewOrganization($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryOrganization($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getOrganization($params = array()){
            return $this->queryOrganization($params)->row_array();
        }
        public function viewOrganization($params = array()){
            return $this->queryOrganization($params)->result();
        }
        public function unique_organization_name($str){
            $pms["whereCondition"]  =   "institution_name = '".$str."'";
            $vsp    =   $this->getOrganization($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}