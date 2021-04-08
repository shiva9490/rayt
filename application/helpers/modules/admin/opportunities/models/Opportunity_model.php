<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Opportunity_model extends CI_Model{ 
        public function createOpportunity(){
            $dat    =   array(
                "opportunity_name"       =>  ucwords($this->input->post("opportunity_name")),
                "opportunity_created_on" =>  date("Y-m-d H:i:s"),
                "opportunity_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("opportunity",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("opportunity",array("opportunity_id" => $vsp."OT"),array("opportunityid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_opportunity($uro){
            $dat    =   array(
                "opportunity_name"       =>  ucwords($this->input->post("opportunityname")),
                "opportunity_modified_on" =>  date("Y-m-d H:i:s"),
                "opportunity_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("opportunity",$dat,array("opportunity_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function delete_opportunity($uro){
            $dat    =   array(
                "opportunity_open"       =>  0,
                "opportunity_modified_on" =>  date("Y-m-d H:i:s"),
                "opportunity_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("opportunity",$dat,array("opportunity_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "opportunity_acde"            =>      $status,
                            "opportunity_modified_on"     =>      date("Y-m-d h:i:s"),
                            "opportunity_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("opportunity",$dta,array("opportunity_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function queryOpportunity($params = array()){
            $dt         =   array(
                                "opportunity_status"      =>     '1',
                                "opportunity_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("opportunity")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(opportunity_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewOpportunity($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryOpportunity($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getOpportunity($params = array()){
            return $this->queryOpportunity($params)->row_array();
        }
        public function viewOpportunity($params = array()){
            return $this->queryOpportunity($params)->result();
        }
        public function unique_id_name($str){
            $pms["whereCondition"]  =   "opportunity_name = '".$str."'";
            $vsp    =   $this->getOpportunity($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}