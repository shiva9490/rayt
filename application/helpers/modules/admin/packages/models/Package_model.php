<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Package_model extends CI_Model{
        public function createPackage(){
            $dat    =   array(
                "package_type"       =>  $this->input->post("package_type"),
                "package_price"      =>  $this->input->post("package_price"),
                "package_coins"      =>  $this->input->post("package_coins"),
                "package_name"       =>  $this->input->post("package_name"),
                "package_created_on" =>  date("Y-m-d H:i:s"),
                "package_created_by" =>  $this->session->userdata("login_id")
            );
            $this->db->insert("packages",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("packages",array("package_id" => $vsp."PKG"),array("packageid" => $vsp));
                return true;
            }
            return false;
        }
        public function update_package($uro){
            $dat    =   array(
                "package_type"       =>  $this->input->post("package_type"),
                "package_price"      =>  $this->input->post("package_price"),
                "package_coins"      =>  $this->input->post("package_coins"),
                "package_name"       =>  $this->input->post("packagename"),
                "package_modified_on" =>  date("Y-m-d H:i:s"),
                "package_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("packages",$dat,array("package_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function deletePackage($uro){
            $dat    =   array(
                "package_open"        =>  0,
                "package_modified_on" =>  date("Y-m-d H:i:s"),
                "package_modified_by" =>  $this->session->userdata("login_id")
            );
            $this->db->update("packages",$dat,array("package_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                return true;
            }
            return FALSE;
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "package_acde"            =>      $status,
                            "package_modified_on"     =>      date("Y-m-d h:i:s"),
                            "package_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("packages",$dta,array("package_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function queryPackage($params = array()){
            $dt         =   array(
                                "package_status"      =>     '1',
                                "package_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("packages")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(package_price LIKE '%".$params["keywords"]."%' or package_coins LIKE '%".$params["keywords"]."%' or package_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewPackage($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryPackage($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function getPackage($params = array()){
            return $this->queryPackage($params)->row_array();
        }
        public function viewPackage($params = array()){
            return $this->queryPackage($params)->result();
        }
        public function unique_package_name($str){
            $pms["whereCondition"]  =   "package_name = '".$str."'";
            $vsp    =   $this->getPackage($pms);
            if(is_array($vsp) && count($vsp) > 0){
                return true;
            }
            return false;
        }
}