<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Student_model extends CI_Model{
        public function addsubject(){
                $regid  =   $this->tutor_model->getRegid();
                $data   =   array(
                    "studentsubject_from_level"   =>  $this->input->post("studentsubject_from_level"),
                    "studentsubject_registerid"   =>  $regid,
                    "studentsubject_subjectid"    =>  $this->input->post("studentsubject_subjectid"),
                    "studentsubject_online"     =>  $this->input->post("studentsubject_online"),
                    "studentsubject_myplace"    =>  $this->input->post("studentsubject_myplace"),
                    "studentsubject_travel"     =>  $this->input->post("studentsubject_travel"),
                    "studentsubject_travelkms"    =>  $this->input->post("studentsubject_travelkms"),
                    "studentsubject_created_on"   =>  date("Y-m-d H:i:s"),
                    "studentsubject_created_by"   =>  $regid
                );
                $vsp    =   $this->db->insert_id("student_subjects",$data);
                if($vsp > 0){
                    $usd    =   $vsp."SJ";
                    $this->db->update("student_subjects",array("studentsubject_id" => $usd),array("studentsubjectid" => $usd));
                    return true;
                }
                return false;
        }
        public function queryStudent($params = array()){
            $dt         =   array(
                                "student_open"     =>     '1',
                                "student_status"   =>     '1',
                                "register_open" =>  "1",
                                "register_status" =>  "1"
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("student as s")
                        ->join("register as r","r.register_id = s.student_register","inner")
                        ->join("levels as fr","fr.level_id = s.student_from_level and fr.level_status = 1 and fr.level_open = 1","LEFT")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(register_email like '%".$params["keywords"]."% or register_mobile like '%".$params["keywords"]."%' or register_name LIKE '%".$params["keywords"]."%')");
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
//            $this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get(); 
        }
        public function activedeactive($uri,$status) {
            $dta    =   array( 
                            "register_acde"            =>      $status,
                            "register_modified_on"     =>      date("Y-m-d h:i:s"),
                            "register_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("register",$dta,array("register_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function cntviewStudent($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryStudent($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewStudent($params = array()){
            return $this->student_model->queryStudent($params)->result();
        }
        public function getStudent($params = array()){
            return $this->student_model->queryStudent($params)->row_array();
        }
        public function delete_student($uri){
            $dta    =   array( 
                            "register_open"            =>     "0",
                            "register_modified_on"     =>      date("Y-m-d h:i:s"),
                            "register_modified_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("register",$dta,array("register_id" => $uri));
            if($this->db->affected_rows() >  0){
                return TRUE;
            }
            return FALSE;
        }
        public function addrequirement(){
            $uniq   =   $this->input->post("register_unique");
            $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
            if($regid != ""){
                $data   =   array(
                    "student_requirements"  =>  ($this->input->post("student_requirements") != "")?$this->input->post("student_requirements"):"",
                    "student_register"      =>  $regid,
                    "student_from_level"    =>  $this->input->post("student_from_level"),
                    "student_online"        =>  ($this->input->post("student_online") != "")?$this->input->post("student_online"):"0",
                    "student_myplace"       =>  ($this->input->post("student_myplace") != "")?$this->input->post("student_myplace"):"0",
                    "student_tutor"         =>  ($this->input->post("student_tutor") != "")?$this->input->post("student_tutor"):"0",
                    "student_travelkms"     =>  $this->input->post("student_travelkms"),
                    "student_want"          =>  $this->input->post("student_want"),
                    "student_subjects"      =>  $this->input->post("student_subjects"),
                    "student_budget"       =>  $this->input->post("student_budget"),
                    "student_budgettype"   =>  $this->input->post("student_budgettype"),
                    "student_preference"   =>  $this->input->post("student_preference"),
                    "student_wanted"       =>  $this->input->post("student_wanted"),
                    "student_due_date"     =>  date("Y-m-d",strtotime($this->input->post("student_due_date"))),
                    "student_need_time"    =>  $this->input->post("student_need_time"),
                    "student_created_on"  =>  date("Y-m-d H:i:s"),
                    "student_created_by"  =>  $regid
                );
                $this->db->insert("student",$data);
                $vsp    =   $this->db->insert_id();
                if($vsp > 0){
                    $usd    =   $vsp."ST";
                    $uniq       =   "TRJ". str_pad($vsp, 6, "0", STR_PAD_LEFT); 
                    $this->db->update("student",array("student_id" => $usd,"student_unique" => $uniq),array("studentid " => $usd));
                    
                    $psm["whereCondition"]  =   "(register_id = '".$regid."') and student_unique = '".$uniq."'";
                    $psm["tipoOrderby"] =   "studentid";
                    $psm["order_by"]    =   "DESC";
                    $vsp                =   $this->student_model->getStudent($psm);
                    if(count($vsp) > 0){
                        $lo         =   $stud       =   array();
                        $cpic       =   $vsp["student_myplace"];
                        $lpic       =   $vsp["student_online"];
                        $mpic       =   $vsp["student_tutor"];
                        $usb        =   $vsp["student_subjects"];
                        if($cpic == "1"){
                            $lo[]     =    "Home";
                        }
                        if($lpic   ==  "1"){
                            $lo[]   =   "Online";
                        }
                        if($mpic   ==  "1"){
                            $lo[]   =   "Traveling";
                        }
                        $ksl     =   "0";
                        $lcpic   =   ($usb != "")?array_filter(explode(",",$usb)):array();
                        if(count($lcpic) > 0){
                            foreach($lcpic as $ev){
                                $ksl++;
                                $params["whereCondition"]  =   "subject_id = '".$ev."'";
                                $vdp        =   $this->subject_model->getSubject($params);
                                $mks        =   $vdp["subject_name"];
                                if($ksl < 2){
                                    $stud[]    =   $mks;
                                }
                            }
                        } 
                        $loc        =   $vsp["location"];
                        $msg        =   " tutor required in ".$loc;
                        $dta["student_title"]  =   implode(" | ",$lo)." ".implode(",",$stud).$msg;
                        $this->db->update("student",$dta,array("student_unique" => $uniq));
                    }
                    return true;
                }
            }
            return false;
        }
        public function updatrequirement(){
                $regid  =   $this->tutor_model->getRegid();
                $usd    =   $this->input->post("student_unique");
                $data   =   array(
                    "student_from_level"    =>  $this->input->post("student_from_level"),
                    "student_online"        =>  $this->input->post("student_online"),
                    "student_myplace"       =>  $this->input->post("student_myplace"),
                    "student_travelkms"     =>  $this->input->post("student_travelkms"),
                    "student_tutor"         =>  $this->input->post("student_tutor"),
                    "student_want"          =>  $this->input->post("student_want"),
                    "student_subjects"      =>  $this->input->post("student_subjects"),
                    "student_modified_on"  =>  date("Y-m-d H:i:s"),
                    "student_modified_by"  =>  $regid
                );
                $this->db->update("student",$data,array("student_unique" => $usd));
                if($this->db->affected_rows() > 0){
                    $student_unique     =   $usd;
                    $usern              =   $this->input->post("register_unique"); 
                    $psm["columns"]         =   "s.*";
                    $psm["whereCondition"]  =   "(register_unique = '".$usern."') and student_unique = '".$student_unique."'";
                    $psm["tipoOrderby"] =   "studentid";
                    $psm["order_by"]    =   "DESC";
                    $vsp                =   $this->student_model->getStudent($psm);
                    if(count($vsp) > 0){
                        $lo         =   $stud       =   array();
                        $cpic       =   $vsp["student_myplace"];
                        $lpic       =   $vsp["student_online"];
                        $mpic       =   $vsp["student_tutor"];
                        $usb        =   $vsp["student_subjects"];
                        if($cpic == "1"){
                            $lo[]     =    "Home";
                        }
                        if($lpic   ==  "1"){
                            $lo[]   =   "Online";
                        }
                        if($mpic   ==  "1"){
                            $lo[]   =   "Traveling";
                        }
                        $ksl     =   "0";
                        $lcpic   =   ($usb != "")?array_filter(explode(",",$usb)):array();
                        if(count($lcpic) > 0){
                            foreach($lcpic as $ev){
                                $ksl++;
                                $params["whereCondition"]  =   "subject_id = '".$ev."'";
                                $vdp        =   $this->subject_model->getSubject($params);
                                $mks        =   $vdp["subject_name"];
                                if($ksl < 2){
                                    $stud[]    =   $mks;
                                }
                            }
                        }
                        $vspp       =   $vsp;
                        $loc        =   $vsp["location"];
                        $msg        =   " tutor required in ".$loc;
                        $dta["student_title"]  =   implode(" | ",$lo)." ".implode(",",$stud).$msg;
                        $this->db->update("student",$dta,array("student_unique" => $usd));
                    }
                    return true;
                }
                return false;
        }
        public function updatebudget(){
                $regid  =   $this->tutor_model->getRegid();
                $usd    =   $this->input->post("student_unique");
                $data   =   array(
                    "student_budget"    =>  $this->input->post("student_budget"),
                    "student_budgettype"   =>  $this->input->post("student_budgettype"),
                    "student_preference"   =>  $this->input->post("student_preference"),
                    "student_wanted"       =>  $this->input->post("student_wanted"),
                    "student_due_date"     =>  date("Y-m-d",strtotime($this->input->post("student_due_date"))),
                    "student_need_time"    =>  $this->input->post("student_need_time"),
                    "student_modified_on"  =>  date("Y-m-d H:i:s"),
                    "student_modified_by"  =>  $regid
                ); 
                $this->db->update("student",$data,array("student_unique" => $usd));
                if($this->db->affected_rows() > 0){
                    return true;
                }
                return false;
        }
        public function updateprofile($regid){
                $dta    =   array(
                    "register_name"     =>  $this->input->post("register_name"),
                    "register_iswhatsapp"   =>  $this->input->post("is_whatsapp"),
                    "register_whatsapp"     =>  $this->input->post("whatsapp_no"),
                    "register_gender"       =>  $this->input->post("gender"),
                    "register_designation"    =>  $this->input->post("register_designation"),
                    "register_experience"     =>  $this->input->post("register_experience"),
                    "register_dob"          =>  date("Y-m-d",strtotime($this->input->post("register_dob"))),
                    "register_language"     =>  $this->input->post("languages"),
                    "register_modified_on"  =>  date("Y-m-d H:i:s"),
                    "register_modified_by"  =>  $regid   
                );
                if($this->input->post("email_id") != ""){
                    $dta["register_email"]    =   $this->input->post("email_id");
                }
                if($this->input->post("mobile_no") != ""){
                    $dta["register_mobile"]    =   $this->input->post("mobile_no");
                }
                $target_dir =   "resources/";
                $fname  =   "";
                if(count($_FILES) > 0){
                    $fname      =   $_FILES["register_picture"]["name"]; 
                    $tname      =   $_FILES["register_picture"]["tmp_name"]; 
                    if($fname != ''){ 
                        $dvsp       =   explode(".",$fname);
                        $ect        =   end($dvsp);  
                        $fname      =   md5($regid).".".$ect; 
                        $uploadfile =   $target_dir . ($fname);
                        if (move_uploaded_file($tname, $uploadfile)) {
                            $pic  =   $fname;
                            $dta["register_picture"]     =   $pic;
                        }
                    }
                }
                $this->db->update("register",$dta,array("register_id" => $regid));
                if($this->db->affected_rows() > 0){
                    return true;
                }
                return false;
        }
        public function checkmessage(){
            $studentid      =   $this->input->post("studentid");
            $message        =   $this->input->post("message");
            $data   =   array(
                "tutormessage_tutorid"     =>  $studentid,
                "tutormessage_message"     =>  $message,
                "tutormessage_studentid"   =>  $this->session->userdata("register_id"),
                "tutormessage_created_on"  =>  date("Y-m-d H:i:s"),
                "tutormessage_created_by"  =>  $this->session->userdata("register_id")
            );
            $this->db->insert("tutor_message",$data);
            $tvp    =   $this->db->insert_id();
            if($tvp > 0){
                $this->db->update("tutor_message",array("tutormessage_id" => $tvp."MTV"),array('tutormessageid' => $tvp));
                return true;
            }
            return false;
        }
        
        public function stduentdeductions($wht,$con){
            $regidt             =   $this->session->userdata("register_id");
            $stndti             =   $this->input->post("studentid");
            $pams["columns"]        =    "register_wallet";
            $pams["whereCondition"] =    "register_id = '".$regidt."'";
            $viww           =    $this->api_model->getRegister($pams);
            if(count($viww) > 0){
                $oms["columns"]         =    "studentbalance_for";
                $oms["whereCondition"]  =    "studentbalance_for = '".$wht."' and register_id = '".$regidt."' and studentbalance_student_id = '".$stndti."'";
                $getBalance             =   $this->student_model->getBalance($oms);
                if(empty($getBalance)){ 
                    $data   =   array(
                        "studentbalance_tutor_id"   =>  ($stndti != "")?$stndti:"",
                        "studentbalance_student_id"   =>  $regidt,
                        "studentbalance_type"         =>  "Credit",
                        "studentbalance_by"           =>  "Tutor",
                        "studentbalance_for"          =>  $wht,
                        "studentbalance_balance"      =>  $con,
                        "studentbalance_created_on"   =>  date("Y-m-d H:i:s"),
                        "studentbalance_created_by"   =>  $regidt
                    );
                    $this->db->insert('student_balance',$data);
                    $sdf    =   $this->db->insert_id();
                    if($sdf > 0){
                        $this->db->update("student_balance",array("studentbalance_id" => $sdf."RB"),array("studentbalanceid" => $sdf));
                        $vrg    =   $viww["register_wallet"];
                        $cons   =   $vrg-$con;
                        $sd     =   $this->tutor_model->updatewallet($cons,$regidt);
                        return true;
                    }
                }
            }
            return false;
        }
        public function queryBalance($params = array()){
            $dt         =   array(
                                "studentbalance_open"    =>     '1',
                                "studentbalance_status"  =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("student_balance as a")
//                        ->join("student as s","s.student_register = a.studentbalance_student_id and student_open = 1 and student_status = 1","INNER")
//                        ->join("register as r","r.register_id = s.student_register and r.register_open = 1 and r.register_status = 1","INNER")
//                        ->join("levels as fr","fr.level_id = s.student_from_level and fr.level_status = 1 and fr.level_open = 1","INNER")
                        ->join("tutors as t","t.tutor_id = a.studentbalance_tutor_id and tutor_status = 1 and tutor_open = 1","INNER")
                        ->join("register as rr","t.tutor_register_id = rr.register_id and rr.register_status = 1 and rr.register_open = 1","INNER")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(wallet_balance LIKE '%".$params["keywords"]."%')");
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
        public function cntviewBalance($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->student_model->queryBalance($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewBalance($params = array()){
            $this->student_model->queryBalance($params);
//            echo $this->db->last_query();exit;
            return $this->student_model->queryBalance($params)->result();
        }
        public function getBalance($params = array()){
            return $this->student_model->queryBalance($params)->row_array();
        }
}