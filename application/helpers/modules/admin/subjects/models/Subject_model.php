<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Subject_model extends CI_Model{
        public function createSubject(){
            $sub        =   $this->input->post("subject_name");
            $resclean   =   $this->common_config->resclean(ucwords($sub));
            $dat    =   array(
                "subject_name"       =>  ucwords($sub),
                "subject_alias_name" =>  $resclean,
                "subject_created_on" =>  date("Y-m-d H:i:s"),
                "subject_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("subjects",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("subjects",array("subject_id" => $vsp."SB"),array("subjectid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_subject($uro){
            $sub        =   $this->input->post("subjectname");
            $resclean   =   $this->common_config->resclean(ucwords($sub));
            $dat    =   array(
                "subject_name"          =>  ucwords($sub),
                "subject_alias_name"    =>  $resclean,
                "subject_modified_on" =>  date("Y-m-d H:i:s"),
                "subject_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("subjects",$dat,array("subject_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function deleteSubject($uro){
            $dat    =   array(
                "subject_open"        =>  0,
                "subject_modified_on" =>  date("Y-m-d H:i:s"),
                "subject_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("subjects",$dat,array("subject_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "subject_acde"            =>      $status,
                            "subject_modified_on"     =>      date("Y-m-d h:i:s"),
                            "subject_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("subjects",$dta,array("subject_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function querySubject($params = array()){
            $dt         =   array(
                                "subject_status"      =>     '1',
                                "subject_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("subjects")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(subject_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewSubject($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->querySubject($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getSubject($params = array()){
            return $this->querySubject($params)->row_array();
        }
        public function viewSubject($params = array()){
            return $this->querySubject($params)->result();
        }
        public function unique_subject_name($str){
            $pms["whereCondition"]  =   "subject_name = '".$str."'";
            $vsp    =   $this->getSubject($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}