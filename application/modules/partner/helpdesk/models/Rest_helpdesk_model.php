<?php
class Rest_helpdesk_model extends CI_Model{
    
    public function create_helpdesk(){
     //echo "<pre>";print_r($this->input->post());exit;
            $direct = "upload/helpdesk";
            if (file_exists($direct)){
            }else{mkdir("upload/helpdesk");}
            $picture= '';
    	if(!empty($_FILES['image']['name'])){
    		$config['upload_path'] = $direct.'/';
    		$config['allowed_types'] = 'jpg|jpeg|png|gif';
    		$config['file_name'] = $_FILES['image']['name']; 
    		$config['encrypt_name'] = TRUE;
    		$this->load->library('upload',$config);
    		$this->upload->initialize($config);   
    		if($this->upload->do_upload('image')){
    			$uploadData = $this->upload->data();
    			$picture = $uploadData['file_name'];
    			$data = array('upload_data' => $this->upload->data());
    			 $img=$data['upload_data']['file_name'];
    			 $config['image_library'] = 'gd2';
    			 $config['source_image'] = $direct.'/'.$img;
    			 $config['new_image'] = 'upload/';
    			 $config['maintain_ratio'] = TRUE;
    			 $config['width']    = 100;
    			 $config['height']   = 100;
    			 $this->load->library('image_lib', $config); 
    			 if (!$this->image_lib->resize()) {
    				echo $this->image_lib->display_errors();
    			 }
    		}
    	}
            $dta    =   array(
                            "resturant_branch_name"           =>$this->input->post("resturant_branch_name"),
                             "resturant_email"       => $this->input->post("resturant_email"),  
                            "resturant_enquire_type"           => $this->input->post("resturant_enquire_type"),
                            "resturant_enquire_for"           => $this->input->post("resturant_enquire_for"),
                            "resturant_enquire_details"           => $this->input->post("resturant_enquire_details"),
                            "resturant_enquire_image"         =>($picture)??'',                       
                            "enquire_created_by"       => $this->session->userdata("restraint_id"),
                            "enquire_created_on"     =>  date("Y-m-d h:i:s"),
                            "resturant_enquire_open"         => '1',
                          
                          
                        );
                 // echo "<pre>";print_r($dta);exit;
            $this->db->insert("resturant_helpdesk",$dta);
            $vps    =   $this->db->insert_id();
            if($vps >  0){ 
                $this->db->update("resturant_helpdesk",array("helpdesk_id" =>"HELP".$vps),array("helpdeskid" => $vps));
                return TRUE;
            }
            return FALSE;
    }
    public function queryHelpenquireform($params = array()){
            $dt         =   array(
                                "resturant_enquire_open"      =>     '1'
                        );
            $sel        =   "*";
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("columns",$params)){
                $sel    =    $params["columns"];
            }
            $this->db->select($sel)
                        ->from("resturant_helpdesk as enq")
                        ->join("helpdesk_question_category as cat","cat.helpquecat_id = enq.resturant_enquire_type","inner")
                        ->join("helpdesk_question_sub_category as sub","sub.helpquesubcat_id = enq.resturant_enquire_for","inner")
                        ->where($dt);
          
            if(array_key_exists("whereCondition",$params)){
                $this->db->where($params["whereCondition"]);
            }
            if(array_key_exists("keywords",$params)){
                    $this->db->where("(resturant_branch_name LIKE '%".$params["keywords"]."%')");
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
    public function cntviewHelpenquireform($params  =    array()){
            $params["cnt"]      =   "1";
            $val    =   $this->queryHelpenquireform($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewHelpenquireform($params  =    array()){
            return  $this->queryHelpenquireform($params)->result();
    }
    public function get_Helpenquireform($params  =    array()){
            return  $this->queryHelpenquireform($params)->row_array();
    }
    
    
    public function delete_helpdesk($uri) {
            $dta    =   array( 
                                "category_open"            =>      '0',
                                "category_modify_date"     =>      date("Y-m-d h:i:s"),
                                "category_modify_by"     =>      $this->session->userdata("login_id")
                        );
            $this->db->update("category",$dta,array("category_id" => $uri));
            if($this->db->affected_rows() >  0){
    //                        $this->transaction_log->save_log("Deleted Variant","Variant","Delete","",$this->session->userdata("login_id"));
                    return TRUE;
            }
            return FALSE;
    }



}
?>