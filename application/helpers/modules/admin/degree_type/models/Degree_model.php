<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Degree_model extends CI_Model{
        public function createDegree(){
            $dat    =   array(
                "degree_name"       =>  $this->input->post("degree_name"),
                "degree_created_on" =>  date("Y-m-d H:i:s"),
                "degree_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("degree_type",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("degree_type",array("degree_id" => $vsp."DT"),array("degreeid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_degree($uro){
            $dat    =   array(
                "degree_name"       =>  $this->input->post("degreename"),
                "degree_modified_on" =>  date("Y-m-d H:i:s"),
                "degree_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("degree_type",$dat,array("degree_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function deleteDegree($uro){
            $dat    =   array(
                "degree_open"       =>  0,
                "degree_modified_on" =>  date("Y-m-d H:i:s"),
                "degree_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("degree_type",$dat,array("degree_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "degree_acde"            =>      $status,
                            "degree_modified_on"     =>      date("Y-m-d h:i:s"),
                            "degree_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("degree_type",$dta,array("degree_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function queryDegree($params = array()){
            $dt         =   array(
                                "degree_status"      =>     '1',
                                "degree_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("degree_type")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(degree_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewDegree($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryDegree($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getDegree($params = array()){
            return $this->queryDegree($params)->row_array();
        }
        public function viewDegree($params = array()){
            return $this->queryDegree($params)->result();
        }
        public function unique_degree_name($str){
            $pms["whereCondition"]  =   "degree_name = '".$str."'";
            $vsp    =   $this->getDegree($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}