<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Level_model extends CI_Model{
        public function createLevel(){
            $dat    =   array(
                "level_name"       =>  $this->input->post("level_name"),
                "level_created_on" =>  date("Y-m-d H:i:s"),
                "level_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("levels",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("levels",array("level_id" => $vsp."DT"),array("levelid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_level($uro){
            $dat    =   array(
                "level_name"       =>  $this->input->post("levelname"),
                "level_modified_on" =>  date("Y-m-d H:i:s"),
                "level_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("levels",$dat,array("level_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function deleteLevel($uro){
            $dat    =   array(
                "level_open"       =>  0,
                "level_modified_on" =>  date("Y-m-d H:i:s"),
                "level_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("levels",$dat,array("level_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "level_acde"            =>      $status,
                            "level_modified_on"     =>      date("Y-m-d h:i:s"),
                            "level_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("levels",$dta,array("level_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function queryLevel($params = array()){
            $dt         =   array(
                                "level_status"      =>     '1',
                                "level_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("levels")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(level_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewLevel($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryLevel($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getLevel($params = array()){
            return $this->queryLevel($params)->row_array();
        }
        public function viewLevel($params = array()){
            return $this->queryLevel($params)->result();
        }
        public function unique_level_name($str){
            $pms["whereCondition"]  =   "level_name = '".$str."'";
            $vsp    =   $this->getLevel($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}