<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Id_proof_model extends CI_Model{
        public function createIdproof(){
            $dat    =   array(
                "idproof_name"       =>  $this->input->post("idproof_name"),
                "idproof_created_on" =>  date("Y-m-d H:i:s"),
                "idproof_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("idproof",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("idproof",array("idproof_id" => $vsp."DT"),array("idproofid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_idproof($uro){
            $dat    =   array(
                "idproof_name"       =>  $this->input->post("proof_name"),
                "idproof_modified_on" =>  date("Y-m-d H:i:s"),
                "idproof_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("idproof",$dat,array("idproof_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function delete_id_proof($uro){
            $dat    =   array(
                "idproof_open"       =>  0,
                "idproof_modified_on" =>  date("Y-m-d H:i:s"),
                "idproof_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("idproof",$dat,array("idproof_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "idproof_acde"            =>      $status,
                            "idproof_modified_on"     =>      date("Y-m-d h:i:s"),
                            "idproof_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("idproof",$dta,array("idproof_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function queryIdproof($params = array()){
            $dt         =   array(
                                "idproof_status"      =>     '1',
                                "idproof_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("idproof")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(idproof_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewIdproof($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryIdproof($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getIdproof($params = array()){
            return $this->queryIdproof($params)->row_array();
        }
        public function viewIdproof($params = array()){
            return $this->queryIdproof($params)->result();
        }
        public function unique_id_name($str){
            $pms["whereCondition"]  =   "idproof_name = '".$str."'";
            $vsp    =   $this->getIdproof($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}