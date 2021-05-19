<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Helpdesk_model extends CI_Model{
    
public function create_helpdeskcategory(){
           $dta    =   array(                         
                           "helpdesk_ques_cat"          => $this->input->post("helpdesk_ques_cat"),                     
                           "helpdesk_abc"                    => "Active",
                           "helpdesk_open"                   => '1',
                           "helpdesk_status"                 =>  '1',
                           "helpdesk_ques_created_on"              =>  date("Y-m-d h:i:s"),  
                           "helpdesk_ques_created_by"              => $this->session->userdata("login_id"),                      
                         );
                //  echo "<pre>";print_r($dta);exit;
           $this->db->insert("helpdesk_question_category",$dta);
           $vps    =   $this->db->insert_id();
           if($vps >  0){ 
               $this->db->update("helpdesk_question_category",array("helpquecat_id" =>"HELPCAT".$vps),array("helpquecatid" => $vps));
               return TRUE;
           }
           return FALSE;
   }
   public function queryHelpCategory($params = array()){
           $dt         =   array(
                               "helpdesk_open"      =>     '1'
                       );
           $sel        =   "*";
           if(array_key_exists("cnt",$params)){
               $sel    =   "count(*) as cnt";
           }
           if(array_key_exists("columns",$params)){
               $sel    =    $params["columns"];
           }
           $this->db->select($sel)
                       ->from("helpdesk_question_category")
                       ->where($dt);
           if(array_key_exists("unique_helpdesk_ques_cat",$params)){
                   $this->db->where("(helpdesk_ques_cat LIKE '".$params["unique_helpdesk_ques_cat"]."')");
           }
           if(array_key_exists("whereCondition",$params)){
               $this->db->where($params["whereCondition"]);
           }
           if(array_key_exists("keywords",$params)){
                   $this->db->where("(helpdesk_ques_cat LIKE '%".$params["keywords"]."%')");
           }
           if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                   $this->db->limit($params['limit'],$params['start']);
           }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                   $this->db->limit($params['limit']);
           }
           if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                   $this->db->order_by($params['tipoOrderby'],$params['order_by']);
           } 
           if(array_key_exists("group_by",$params)){
            $this->db->group_by($params['group_by']);
    }
           // $this->db->get();echo $this->db->last_query();exit;
           return  $this->db->get();
   }
   public function cntviewHelpcategory($params  =    array()){
     
           $params["cnt"]      =   "1";
           $val =   $this->queryHelpCategory($params)->row_array();
    
           if(count($val) > 0){
               return  $val['cnt'];
           }
           return "0";
   }
   public function viewHelpCategory($params  =    array()){
     
           return  $this->queryHelpCategory($params)->result();
           
   }
   public function getHelpCategory($params  =    array()){
           return  $this->queryHelpCategory($params)->row_array();
   }
   public function updateHelpCategory($uri) {
          
                    $dta    =   array( 
                                "helpdesk_ques_cat"          => $this->input->post("helpdesk_ques_cat"),                     
                                "helpdesk_abc"                => "Active",
                                "helpdesk_open"               => '1',
                                "helpdesk_status"             =>  '1',
                                "helpdesk_ques_created_on"   =>  date("Y-m-d h:i:s"),  
                                "helpdesk_ques_modify_by"   => $this->session->userdata("login_id"),    
                                "helpdesk_ques_modify_on"     =>      date("Y-m-d h:i:s"),
                              
                        );
          
            $this->db->update("helpdesk_question_category",$dta,array("helpquecat_id" => $uri));
            if($this->db->affected_rows() >  0){

                    return TRUE;
            }
            return FALSE;
   }
   
   public function delete_HelpCategory($uri) {
           $dta    =   array( 
                               "helpdesk_open"            =>      '0',
                               "helpdesk_ques_created_on"     =>      date("Y-m-d h:i:s"),
                               "helpdesk_ques_modify_by"     =>      $this->session->userdata("login_id")
                       );
           $this->db->update("helpdesk_question_category",$dta,array("helpquecat_id" => $uri));
           if($this->db->affected_rows() >  0){
   //                        $this->transaction_log->save_log("Deleted Variant","Variant","Delete","",$this->session->userdata("login_id"));
                   return TRUE;
           }
           return FALSE;
   }
   public function activedeactive($uri,$status) {
        $dta    =   array( 
                            "helpdesk_abc"            =>      $status,
                            "helpdesk_ques_created_on"     =>      date("Y-m-d h:i:s"),
                            "helpdesk_ques_modify_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("helpdesk_question_category",$dta,array("helpquecat_id" => $uri));
        if($this->db->affected_rows() >  0){
                return TRUE;
        }
        return FALSE;
    }
   
   
    public function create_helpdesksubcategory(){
        $dta    =   array(                         
                        "helpdesk_ques_subcat"          => $this->input->post("helpdesk_ques_subcat"),
                        "helpquecat_id"                 => $this->input->post("resturant_enquire_type"),                     
                        "helpdesksub_abc"                  => "Active",
                        "helpdesksub_open"                 => '1',
                        "helpdesksub_status"               =>  '1',
                        "helpdesk_ques_created_on"      =>  date("Y-m-d h:i:s"),  
                        "helpdesk_ques_created_by"      => $this->session->userdata("login_id"),                      
                      );
        $this->db->insert("helpdesk_question_sub_category",$dta);
        $vps    =   $this->db->insert_id();
        if($vps >  0){ 
            $this->db->update("helpdesk_question_sub_category",array("helpquesubcat_id" =>"HELPSUBCAT".$vps),array("helpquesubcatid" => $vps));
            return TRUE;
        }
        return FALSE;
    }
    public function queryHelpSubCategory($params = array()){
        $dt         =   array(
                            "helpdesksub_open"      =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("helpdesk_question_sub_category as sub")
                    ->join("helpdesk_question_category as cat","cat.helpquecat_id = sub.helpquecat_id","inner")
                    ->where($dt);
        if(array_key_exists("helpdesk_ques_subcat",$params)){
                $this->db->where("(helpdesk_ques_subcat LIKE '".$params["unique_helpdesk_ques_subcat"]."')");
        }
        if(array_key_exists("whereCondition",$params)){
            $this->db->where($params["whereCondition"]);
        }
        if(array_key_exists("keywords",$params)){
                $this->db->where("(helpdesk_ques_subcat LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
        if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                $this->db->order_by($params['tipoOrderby'],$params['order_by']);
        } 
        if(array_key_exists("group_by",$params)){
         $this->db->group_by($params['group_by']);
    }
        // $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
    public function cntviewHelpsubcategory($params  =    array()){
    
        $params["cnt"]      =   "1";
        $val =   $this->queryHelpSubCategory($params)->row_array();
    
        if(count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function viewHelpSubCategory($params  =    array()){
        return  $this->queryHelpSubCategory($params)->result();
    }
    public function getHelpSubCategory($params  =    array()){
        return  $this->queryHelpSubCategory($params)->row_array();
    }
    public function updateHelpSubCategory($uri) {
                 $dta    =   array( 
                            "helpdesk_ques_subcat"          => $this->input->post("helpdesk_ques_subcat"),
                            "helpquecat_id"                 => $this->input->post("resturant_enquire_type"),                     
                         
                            "helpdesksub_open"                 => '1',
                            "helpdesksub_status"               =>  '1',                   
                             "helpdesk_ques_modify_by"   => $this->session->userdata("login_id"),    
                             "helpdesk_ques_modify_on"     =>      date("Y-m-d h:i:s"),
                           
                     );
       
         $this->db->update("helpdesk_question_sub_category",$dta,array("helpquesubcat_id" => $uri));
         if($this->db->affected_rows() >  0){
    
                 return TRUE;
         }
         return FALSE;
    }
    
    public function delete_HelpSubCategory($uri) {
        $dta    =   array( 
                            "helpdesksub_open"            =>      '0',
                            "helpdesk_ques_modify_on"      =>      date("Y-m-d h:i:s"),
                            "helpdesk_ques_modify_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("helpdesk_question_sub_category",$dta,array("helpquesubcat_id" => $uri));
        if($this->db->affected_rows() >  0){
    //                        $this->transaction_log->save_log("Deleted Variant","Variant","Delete","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
    }
    public function activedeactivesub($uri,$status) {
        $dta    =   array( 
                         "helpdesksub_abc"            =>      $status,
                         "helpdesk_ques_modify_on"     =>      date("Y-m-d h:i:s"),
                         "helpdesk_ques_modify_by"     =>      $this->session->userdata("login_id")
                 );
        $this->db->update("helpdesk_question_sub_category",$dta,array("helpquesubcat_id" => $uri));
        if($this->db->affected_rows() >  0){
        //                        $this->transaction_log->save_log("Updated Addon","Addon","Update","",$this->session->userdata("login_id"));
             return TRUE;
        }
        return FALSE;
    }
   

}