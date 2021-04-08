<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tutor_model extends CI_Model{
        public function updateBasic(){
                $uniq   =   $this->input->post("register_unique");
                $pms['whereCondition']  =   "register_unique = '".$uniq."'";
                $reg    =   $this->api_model->getRegister($pms);
                $regid  =   $reg["register_id"];
                $dta    =   array(
                    "register_name"     =>  $this->input->post("register_name"),
                    'register_email'    =>  $this->input->post("email_id"),
                    "register_mobile"      =>  $this->input->post("mobile_no"),
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
                $this->db->update("register",$dta,array("register_unique" => $uniq));
                if($this->db->affected_rows() > 0){
                    return true;
                }
                return false;
        }
        public function getRegid(){
            $uniq   =   $this->input->post("register_unique");
            $pms['columns']         =   "register_id";
            $pms['whereCondition']  =   "register_unique = '".$uniq."'";
            $reg    =   $this->api_model->getRegister($pms);
            $regid  =   $reg["register_id"];
            return $regid;
        }
        public function delete_tutor($regid){
                $mod    =   date("Y-m-d H:i:s");
                $ros    =   $this->session->userdata("login_id");
                $ata    =   array(
                    "register_open"           =>  "0",
                    "register_modified_on"    =>  $mod,
                    "register_modified_by"    =>  $ros
                );
                $this->db->update("register",$ata,array("register_id" => $regid));
                $rata   =   array(
                    "tutorsubject_open"           =>  "0",
                    "tutorsubject_modified_on"    =>  $mod,
                    "tutorsubject_modified_by"    =>  $ros
                );
                $this->db->update("tutor_subjects",$rata,array("tutorsubject_register_id" => $regid));
                $dta   =   array(
                    "tutor_open"           =>  "0",
                    "tutor_modified_on"    =>  $mod,
                    "tutor_modified_by"    =>  $ros
                );
                $this->db->update("tutors",$dta,array("tutor_register_id" => $regid));
                $eata   =   array(
                    "experince_open"           =>  "0",
                    "experince_modified_on"    =>  $mod,
                    "experince_modified_by"    =>  $ros
                );
                $this->db->update("tutor_education_experience",$eata,array("experince_tutor_id" => $regid));
                $tata   =   array(
                    "teaching_open"           =>  "0",
                    "teaching_modified_on"    =>  $mod,
                    "teaching_modified_by"    =>  $ros
                );
                $this->db->update("tutor_teaching_experience",$tata,array("teaching_tutor_id" => $regid));
                return true;
        }
        public function updateaddress(){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ''){
                    $dta    =   array(
                        "tutor_latitude"    =>  $this->input->post("tutor_latitude"),
                        "tutor_longitude"   =>  $this->input->post("tutor_longitude"),
                        "tutor_address"     =>  $this->input->post("tutor_address"),
                        "tutor_pincode"     =>  $this->input->post("tutor_pincode"),
                        "tutor_state"       =>  $this->input->post("tutor_state"),
                        "tutor_street"      =>  $this->input->post("tutor_street"),
                        "tutor_modified_on"    =>  date("Y-m-d H:i:s"),
                        "tutor_modified_by"    =>  $regid
                    );
                    $this->db->update("tutors",$dta,array("tutor_register_id" => $regid));
                    if($this->db->affected_rows() > 0){
                        return true;
                    }
                }
                return false;
        }
        public function updateteachingdetails(){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ''){
                    $dta    =   array(
                        "tutor_fee_charge"    =>  $this->input->post("tutor_fee_charge"),
                        "tutor_minimum_fee"   =>  $this->input->post("tutor_minimum_fee"),
                        "tutor_maximum_fee"     =>  $this->input->post("tutor_maximum_fee"),
                        "tutor_fee_details"     =>  $this->input->post("tutor_fee_details"),
                        "tutor_years_experience"    =>  $this->input->post("tutor_years_experience"),
                        "tutor_teaching_experience" =>  $this->input->post("tutor_teaching_experience"),
                        "tutor_online_experience"   =>  $this->input->post("tutor_online_experience"),
                        "tutor_willing"             =>  $this->input->post("tutor_willing"),
                        "tutor_travel_distance"     =>  $this->input->post("tutor_travel_distance"),
                        "tutor_online_teaching"     =>  $this->input->post("tutor_online_teaching"),
                        "tutor_digital_pen"    =>  $this->input->post("tutor_digital_pen"),
                        "tutor_homework"       =>  $this->input->post("tutor_homework"),
                        "tutor_opportunities"  =>  $this->input->post("tutor_opportunities"),
                        "tutor_employed"       =>  $this->input->post("tutor_employed"),
                        "tutor_modified_on"    =>  date("Y-m-d H:i:s"),
                        "tutor_modified_by"    =>  $regid
                    );
                    $this->db->update("tutors",$dta,array("tutor_register_id" => $regid));
                    if($this->db->affected_rows() > 0){
                        return true;
                    }
                }
                return false;
        }
        public function updateprofile(){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ''){
                    $dta    =   array(
                        "tutor_description"    =>  $this->input->post("tutor_description"),
                        "tutor_modified_on"    =>  date("Y-m-d H:i:s"),
                        "tutor_modified_by"    =>  $regid
                    );
                    $this->db->update("tutors",$dta,array("tutor_register_id" => $regid));
                    if($this->db->affected_rows() > 0){
                        return true;
                    }
                }
                return false;
        }
        public function updateidprofile(){
                $regid  =   $this->tutor_model->getRegid();
                $dta    =   array(
                    "tutor_idproof"    =>  $this->input->post("tutor_idproof"),
                    "tutor_modified_on"    =>  date("Y-m-d H:i:s"),
                    "tutor_modified_by"    =>  $regid
                );
                $dire   =   "resources/";
                if(count($_FILES)){
                    $ybb    =   array();
                    $files      =   $_FILES["tutor_upload"];
                    $countfiles =   count($files["name"]); 
                    if($countfiles > 0){
                        for($i=0;$i<$countfiles;$i++){ 
                            $filval         =   "tutor_upload";
                            $filename       =   $_FILES[$filval]['name'][$i];  
                            if($filename != '' && $filename != 'noname'){
                                $pah        =   $dire."/".$filename;
                                $vspl       =   move_uploaded_file($_FILES[$filval]['tmp_name'][$i],$pah); 
                                if($vspl){
                                    $ybb[]  =   $filename;
                                }
                            }
                        } 
                    }
                    $dta["tutor_upload"]    = serialize($ybb);
                }
                $this->db->update("tutors",$dta,array("tutor_register_id" => $regid));
                if($this->db->affected_rows() > 0){
                    return true;
                }
                return false;
        }
        public function addsubjects(){
                $regid  =   $this->tutor_model->getRegid();
                $data   =   array(
                    "tutorsubject_from_level"   =>  $this->input->post("from_level"),
                    "tutorsubject_to_level"     =>  $this->input->post("to_level"),
                    "tutorsubject_subjectid"    =>  $this->input->post("subjectid"),
                    "tutorsubject_register_id"  =>  $regid,
                    "tutorsubject_created_on"   =>  date("Y-m-d H:i:s"),
                    "tutorsubject_modified_on"  =>  date("Y-m-d H:i:s"),
                    "tutorsubject_created_by"   =>  $regid,
                    "tutorsubject_modified_by"   =>  $regid
                );
                $this->db->insert("tutor_subjects",$data); 
                $vsp    =   $this->db->insert_id();
                if($vsp > 0){
                    $usd    =   $vsp."SJ";
                    $this->db->update("tutor_subjects",array("tutorsubject_id" => $usd),array("tutorsubjectid" => $vsp));
                    //echo $this->db->last_query();exit;
                    return true;
                }
                return false;
        }
        public function deletesubjects($usd){
                $uniq   =   $this->input->post("register_unique");
                if($uniq != ""){
                    $regid  =   $this->tutor_model->getRegid();
                }else{
                    $regid  =   $this->session->userdata("register_id");
                }
                $data   =   array(
                    "tutorsubject_open"         =>  "0",
                    "tutorsubject_modified_on"  =>  date("Y-m-d H:i:s"),
                    "tutorsubject_modified_by"  =>  $regid
                );
                $this->db->update("tutor_subjects",$data,array("tutorsubject_id" => $usd));
                $vsp    =   $this->db->affected_rows();
                if($vsp > 0){
                    return true;
                }
                return false;
        }
        public function addorganization(){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ''){
                    $data   =   array(
                        "experince_institution" =>  $this->input->post("experince_institution"),
                        "experince_degree_type" =>  $this->input->post("experince_degree_type"),
                        "experince_start_year"  =>  date("Y-m-d",strtotime($this->input->post("experince_start_year"))), 
                        "experince_end_year"    =>  date("Y-m-d",strtotime($this->input->post("experince_end_year"))),
                        "experince_assoication" =>  ($this->input->post("experince_assoication") != "")?$this->input->post("experince_assoication"):"",
                        "experince_speciality"  =>  ($this->input->post("experince_speciality") != "")?$this->input->post("experince_speciality"):"",
                        "experince_tutor_id"    =>  $regid,
                        "experince_score"       =>  ($this->input->post("experince_score") != "")?$this->input->post("experince_score"):"",
                        "experince_created_on"  =>  date("Y-m-d H:i:s"),
                        "experince_created_by"  =>  $regid
                    );
                    $this->db->insert("tutor_education_experience",$data);
                    $vsp    =   $this->db->insert_id();
                    if($vsp > 0){
                        $usd    =   $vsp."TX";
                        $this->db->update("tutor_education_experience",array("experince_id" => $usd),array("experinceid " => $usd));
                        return true;
                    }
                }
                return false;
        }
        public function deleteorganization($usd){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ""){
                    $data   =   array(
                        "experince_open"       =>  0,
                        "experince_created_on"  =>  date("Y-m-d H:i:s"),
                        "experince_created_by"  =>  $regid
                    );
                    $this->db->update("tutor_education_experience",$data,array("experince_id" => $usd));
                    $vsp    =   $this->db->affected_rows();
                    if($vsp > 0){
                        return true;
                    }
                }
                return false;
        }
        public function addexperience(){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ""){
                    $data   =   array(
                        "teaching_organization" =>  $this->input->post("teaching_organization"),
                        "teaching_tutor_id"     =>  $regid,
                        "teaching_designation"  =>  ($this->input->post("teaching_designation") != "")?$this->input->post("teaching_designation"):"",
                        "teaching_start_year"   =>  date("Y-m-d",strtotime($this->input->post("teaching_start_year"))),
                        "teaching_end_year"     =>  date("Y-m-d",strtotime($this->input->post("teaching_end_year"))),
                        "teaching_association"  =>  ($this->input->post("teaching_association") != "")?$this->input->post("teaching_association"):"",
                        "teaching_description"  =>  ($this->input->post("teaching_description") != "")?$this->input->post("teaching_description"):"",
                        "teaching_created_on"  =>  date("Y-m-d H:i:s"),
                        "teaching_created_by"  =>  $regid
                    );
                    $this->db->insert("tutor_teaching_experience",$data);
                    $vsp    =   $this->db->insert_id();
                    if($vsp > 0){
                        $usd    =   $vsp."TE";
                        $this->db->update("tutor_teaching_experience",array("teaching_id" => $usd),array("teachingid " => $usd));
                        return true;
                    }
                }
                return false;
        }
        public function deleteteaching($usd){
                $uniq   =   $this->input->post("register_unique");
                $regid  =   ($uniq != "")?$this->tutor_model->getRegid():$this->session->userdata("register_id");
                if($regid != ""){
                    $data   =   array(
                        "teaching_open"         =>  "0",
                        "teaching_modified_on"  =>  date("Y-m-d H:i:s"),
                        "teaching_modified_by"  =>  $regid
                    );
                    $this->db->update("tutor_teaching_experience",$data,array("teaching_id" => $usd));
                    $vsp    =   $this->db->affected_rows();
                    if($vsp > 0){
                        return true;
                    }
                }
                return false;
        }
        public function queryTutor($params = array()){
            $dt         =   array(
                                "tutor_status"    =>     '1',
                                "tutor_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutors as t")
                        ->join("register as r","r.register_id = t.tutor_register_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("idproof as ifd","ifd.idproof_id  = t.tutor_idproof","left")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(tutor_type like '%".$params["keywords"]."% or tutor_speciality LIKE '%".$params["keywords"]."%'"
                            . " or tutor_dob LIKE '%".$params["keywords"]."%' or tutor_longitude LIKE '%".$params["keywords"]."%'"
                            .  " or tutor_latitude LIKE '%".$params["keywords"]."%' or tutor_address LIKE '%".$params["keywords"]."%' or tutor_fee_charge LIKE '%".$params["keywords"]."%' or tutor_minimum_fee LIKE '%".$params["keywords"]."%' or tutor_maximum_fee LIKE '%".$params["keywords"]."%' or tutor_fee_details  LIKE '%".$params["keywords"]."%' or tutor_years_experience LIKE '%".$params["keywords"]."%'"
                            .  " or tutor_teaching_experience LIKE '%".$params["keywords"]."%' or tutor_online_experience LIKE '%".$params["keywords"]."%' or tutor_willing LIKE '%".$params["keywords"]."%' or tutor_online_teaching LIKE '%".$params["keywords"]."%'"
                            .  " or tutor_digital_pen LIKE '%".$params["keywords"]."%' or tutor_homework LIKE '%".$params["keywords"]."%'"
                            .  " or tutor_employed LIKE '%".$params["keywords"]."%' or tutor_opportunities LIKE '%".$params["keywords"]."%'"
                            .  " or tutor_travel_distance LIKE '%".$params["keywords"]."%' or tutor_description LIKE '%".$params["keywords"]."%' or idproof_name LIKE '%".$params["keywords"]."%' or tutor_pincode LIKE '%".$params["keywords"]."%')");
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
        public function cntviewTutor($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryTutor($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewTutor($params = array()){
            return $this->tutor_model->queryTutor($params)->result();
        }
        public function getTutor($params = array()){
            return $this->tutor_model->queryTutor($params)->row_array();
        }
        public function queryTutorsubjects($params = array()){
            $dt         =   array(
                                "tutorsubject_open"      =>     '1',
                                "tutorsubject_status"    =>     '1',
                                "tutor_status"    =>     '1',
                                "tutor_open"      =>     '1'
                        );
            $sel        =   "*,fdr.level_name as tolevel,fr.level_name as fromlevel";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutor_subjects as a")
                        ->join("subjects as s","s.subject_open = 1 and s.subject_status = 1 and s.subject_id = a.tutorsubject_subjectid","inner")
                        ->join("levels as fr","fr.level_id = a.tutorsubject_from_level and fr.level_status = 1 and fr.level_open = 1","INNER")
                        ->join("levels as fdr","fdr.level_id = a.tutorsubject_to_level and fdr.level_status = 1 and fdr.level_open = 1","INNER")
                        ->join("register as r","r.register_id = a.tutorsubject_register_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("tutors as t","r.register_id = t.tutor_register_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("idproof as ifd","ifd.idproof_id  = t.tutor_idproof","left")
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
            //   $this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get(); 
        }
        public function cntviewTutorSubjects($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryTutorsubjects($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewtutorSubjects($params = array()){
            return $this->queryTutorsubjects($params)->result();
        }
        public function gettutorSubjects($params = array()){
            return $this->queryTutorsubjects($params)->row_array();
        }
        public function viewtutorEducation($params = array()){
            return $this->queryTutoreducation($params)->result();
        }
        public function viewtutorTeachexperience($params = array()){
            return $this->queryTutorteach($params)->result();
        }
        public function queryTutorteach($params = array()){
            $dt         =   array(
                                "teaching_open"    =>     '1',
                                "teaching_status"  =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutor_teaching_experience as a")
                        ->join("register as r","r.register_id = a.teaching_tutor_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("tutors as t","r.register_id = t.tutor_register_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(teaching_organization like '%".$params["keywords"]."%' or "
                            . "teaching_designation  LIKE '%".$params["keywords"]."%' or teaching_start_year LIKE '%".$params["keywords"]."%' "
                            . "or teaching_end_year LIKE '%".$params["keywords"]."%' "
                            . "teaching_association  LIKE '%".$params["keywords"]."%'  or teaching_description LIKE '%".$params["keywords"]."%')");
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
        public function queryTutoreducation($params = array()){
            $dt         =   array(
                                "experince_open"    =>     '1',
                                "experince_status"  =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutor_education_experience as a")
                        ->join("institution as ir","ir.institution_open = 1 and ir.institution_status = 1 and ir.institution_id = a.experince_institution","inner")
                        ->join("degree_type as d","d.degree_id = a.experince_degree_type and d.degree_open = 1 and d.degree_status = 1","inner")
                        ->join("register as r","r.register_id = a.experince_tutor_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("tutors as t","r.register_id = t.tutor_register_id and t.tutor_open = 1 and t.tutor_status = 1","inner")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(experince_degree_name like '%".$params["keywords"]."%' or LIKE '%".$params["keywords"]."%' or "
                            . "experince_start_year  LIKE '%".$params["keywords"]."%' or experince_speciality  LIKE '%".$params["keywords"]."%' or experince_score LIKE '%".$params["keywords"]."%' "
                            . "experince_end_year  LIKE '%".$params["keywords"]."%'  or experince_assoication  LIKE '%".$params["keywords"]."%' "
                            . "institution_name LIKE '%".$params["keywords"]."%')");
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
            // $this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get(); 
        }
        public function queryTutortransactions($params = array()){
            $dt         =   array(
                                "tutor_status"    =>     '1',
                                "tutor_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutor_transactions as tr")
                        ->join("tutors as t","t.tutor_register_id = tr.trans_registerid","inner")
                        ->join("packages as p","p.package_id = tr.trans_package_id and p.package_open = 1 and p.package_status = 1","inner")
                        ->join("register as r","r.register_id = t.tutor_register_id and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("idproof as ifd","ifd.idproof_id  = t.tutor_idproof","left")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(package_name LIKE '%".$params["keywords"]."%' or  package_coins LIKE '%".$params["keywords"]."%' or trans_paystatus LIKE '%".$params["keywords"]."%' or trans_transaction_id LIKE '%".$params["keywords"]."%' or package_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewTransactions($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryTutortransactions($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewTransactions($params = array()){
            return $this->tutor_model->queryTutortransactions($params)->result();
        }
        public function getTransactions($params = array()){
            return $this->tutor_model->queryTutortransactions($params)->row_array();
        }
        public function queryStudenttransactions($params = array()){
            $dt         =   array(
                                "trans_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutor_transactions as tr")
                        ->join("register as r","r.register_id = tr.trans_registerid  and r.register_open = 1 and r.register_status = 1","inner")
                        ->join("packages as p","p.package_id = tr.trans_package_id and p.package_open = 1 and p.package_status = 1","inner")
                        ->where($dt);
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(package_name LIKE '%".$params["keywords"]."%' or  package_coins LIKE '%".$params["keywords"]."%' or trans_paystatus LIKE '%".$params["keywords"]."%' or trans_transaction_id LIKE '%".$params["keywords"]."%' or package_name LIKE '%".$params["keywords"]."%')");
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
        public function cntviewStudentTransactions($params = array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryStudenttransactions($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewStudentTransactions($params = array()){
            return $this->tutor_model->queryStudenttransactions($params)->result();
        }
        public function getStudentTransactions($params = array()){
            return $this->tutor_model->queryStudenttransactions($params)->row_array();
        }
        public function allprofilelist(){
            $vsp     =   array();
            $pms["tipoOrderby"]    =   "registerid";
            $pms["order_by"]    =   "DESC";
            $dvsp    =   $this->tutor_model->viewTutor($pms);
            foreach ($dvsp  as $kye => $ve){
                $pms["columns"]     =   "group_concat(subject_name) as subjects";
                $subjects           =   $this->tutor_model->gettutorSubjects($pms);
                $pic    =   $ve->register_picture;
                $imh    =   $this->common_config->getvalueImagesize($pic);
                $msk    = is_array($subjects)?$subjects["subjects"]:"";
                $vsp[$kye]["register_unique"]     =   $ve->register_unique;
                $vsp[$kye]["register_name"]     =   $ve->register_name;
                $vsp[$kye]["subjects"]          =   $msk;
                $vsp[$kye]["tutor_pincode"]     =   $ve->tutor_pincode;
                $vsp[$kye]["tutor_speciality"]  =   $ve->tutor_speciality;
                $vsp[$kye]["tutor_state"]       =   $ve->tutor_state;
                $vsp[$kye]["tutor_fee_charge"]       =   $ve->tutor_fee_charge;
                $vsp[$kye]["register_picture"]       =   $imh;
                $vsp[$kye]["tutor_years_experience"] =   $ve->tutor_years_experience;
            }
            return $vsp;
        }
        public function inserttransactions($txnid){
            $regdt      =   $this->session->userdata("register_id");
            $regidt     =   $this->session->userdata("register_type");
            $ridt       =   $this->input->get("package");
            $data    =    array(
                "trans_transaction_id"            =>  $txnid,
                "trans_register_type" =>  $regidt,
                "trans_registerid"    =>  $regdt,
                "trans_package_id"    =>  $ridt,
                "trans_created_on"    =>  date("Y-m-d H:i:s"),
                "trans_created_by"    =>  $regdt
            );
            $this->db->insert("tutor_transactions",$data);
            $trans_id   =   $this->db->insert_id();
            if($trans_id > 0){
                $this->db->update("tutor_transactions",array("trans_id" => $trans_id."TS"),array("transid" => $trans_id)); 
                return true;
            }
            return false;
        }
        public function updatepaystatus(){
            $txnid  =  $_POST["txnid"];
            $regdt      =   $this->session->userdata("register_id");
            $data   =    array(
                "trans_response"    =>  serialize($_POST),
                "trans_mihpayid"    =>  isset($_POST["mihpayid"])?$_POST["mihpayid"]:"",
                "trans_cardnum"     =>  isset($_POST["cardnum"])?$_POST["cardnum"]:"",
                "trans_cardname"    =>  isset($_POST["name_on_card"])?$_POST["name_on_card"]:"",
                "trans_payumoneyid"   =>  isset($_POST["payuMoneyId"])?$_POST["payuMoneyId"]:"",
                "trans_paystatus"     =>  isset($_POST["status"])?$_POST["status"]:"",
                "trans_modified_on"   =>  date("Y-m-d H:i:s"),
                "trans_modified_by"   =>  $regdt
            );
            $this->db->update("tutor_transactions",$data,array("trans_transaction_id" => $txnid)); 
            if($this->db->affected_rows() > 0){
                return true;
            }
            return false;
        }
        public function updatecoins($txnid){
            $regdt     =   $this->session->userdata("register_id");
            $regidt    =   $this->session->userdata("register_type");
            $pams["columns"]            =   "register_wallet,package_coins";
            $pams["whereCondition"]     =   "trans_transaction_id = '".$txnid."'";
            if($regidt != "Student"){
                $vdf    =   $this->tutor_model->getTransactions($pams);
            }else{
                $vdf    =   $this->tutor_model->getStudentTransactions($pams);
            }
            if(count($vdf) > 0){
                $package_coins     =   $vdf["package_coins"];
                $register_wallet   =   $vdf["register_wallet"];
                $pkgid      =   $register_wallet+$package_coins;
                $vsf        =   $this->tutor_model->updatewallet($pkgid,$regdt);
                return $vsf;
            }
            return false;
        }
        public function updatewallet($pkgid,$regdt){
            $data       =   array(
                "register_wallet"        =>  $pkgid,
                "register_modified_on"   =>  date("Y-m-d H:i:s"),
                "register_modified_by"   =>  $regdt
            );
            $this->db->update("register",$data,array("register_id" => $regdt)); 
            if($this->db->affected_rows() > 0){
                return true;
            }
            return false;
        }
        public function queryBalance($params = array()){
            $dt         =   array(
                                "tutorbalance_open"    =>     '1',
                                "tutorbalance_status"  =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("tutor_balance as a")
                        ->join("student as s","s.student_id = a.tutorbalance_student_id and student_open = 1 and student_status = 1","LEFT")
                        ->join("register as r","r.register_id = s.student_register and r.register_open = 1 and r.register_status = 1","LEFT")
                        ->join("levels as fr","fr.level_id = s.student_from_level and fr.level_status = 1 and fr.level_open = 1","LEFT")
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
            $val    =   $this->tutor_model->queryBalance($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
        }
        public function viewBalance($params = array()){
            return $this->tutor_model->queryBalance($params)->result();
        }
        public function getBalance($params = array()){
            return $this->tutor_model->queryBalance($params)->row_array();
        }
        public function checkmessage(){
            $studentid      =   $this->input->post("studentid");
            $message        =   $this->input->post("message");
            $data   =   array(
                "studentmessage_studentid"     =>  $studentid,
                "studentmessage_message"       =>  $message,
                "studentmessage_tutorid"       =>  $this->session->userdata("register_id"),
                "studentmessage_created_on"    =>  date("Y-m-d H:i:s"),
                "studentmessage_created_by"    =>  $this->session->userdata("register_id")
            );
            $this->db->insert("student_message",$data);
            $tvp    =   $this->db->insert_id();
            if($tvp > 0){
                $this->db->update("student_message",array("studentmessage_id" => $tvp."STV"),array('studentmessageid' => $tvp));
                return true;
            }
            return false;
        }
        public function deductions($wht,$con){
            $regidt             =   $this->session->userdata("register_id");
            $stndti             =   $this->input->post("studentid");
            $pams["columns"]        =    "register_wallet";
            $pams["whereCondition"] =    "register_id = '".$regidt."'";
            $viww           =    $this->api_model->getRegister($pams);
            if(count($viww) > 0){
                $oms["columns"]         =    "tutorbalance_for";
                $oms["whereCondition"]  =    "tutorbalance_for = '".$wht."' and register_id = '".$regidt."' and tutorbalance_student_id = '".$stndti."'";
                $getBalance             =   $this->tutor_model->getBalance($oms);
                if(empty($getBalance)){ 
                    $data   =   array(
                        "tutorbalance_student_id"   =>  ($stndti != "")?$stndti:"",
                        "tutorbalance_tutor_id"     =>  $regidt,
                        "tutorbalance_type"         =>  "Credit",
                        "tutorbalance_by"           =>  "Student",
                        "tutorbalance_for"          =>  $wht,
                        "tutorbalance_balance"      =>  $con,
                        "tutorbalance_created_on"   =>  date("Y-m-d H:i:s"),
                        "tutorbalance_created_by"   =>  $regidt
                    );
                    $this->db->insert('tutor_balance',$data);
                    $sdf    =   $this->db->insert_id();
                    if($sdf > 0){
                        $this->db->update("tutor_balance",array("tutorbalance_id" => $sdf."RB"),array("tutorbalanceid" => $sdf));
                        $vrg    =   $viww["register_wallet"];
                        $cons   =   $vrg-$con;
                        $sd     =   $this->tutor_model->updatewallet($cons,$regidt);
                        return true;
                    }
                }
            }
            return false;
        }
        public function insertsubject(){
                $regid  =   $this->session->userdata('register_id');
                $data   =   array(
                    "tutorsubject_from_level"   =>  $this->input->post("formlevel"),
                    "tutorsubject_to_level"     =>  $this->input->post("tolevel"),
                    "tutorsubject_subjectid"    =>  $this->input->post("subjectid"),
                    "tutorsubject_register_id"  =>  $regid,
                    "tutorsubject_created_on"   =>  date("Y-m-d H:i:s"),
                    "tutorsubject_modified_on"  =>  date("Y-m-d H:i:s"),
                    "tutorsubject_created_by"   =>  $regid,
                    "tutorsubject_modified_by"  =>  $regid
                );
                $this->db->insert("tutor_subjects",$data); 
                $vsp    =   $this->db->insert_id();
                if($vsp > 0){
                    $usd    =   $vsp."SJ";
                    $this->db->update("tutor_subjects",array("tutorsubject_id" => $usd),array("tutorsubjectid" => $vsp));
                    return true;
                }
                return false;
        }
}