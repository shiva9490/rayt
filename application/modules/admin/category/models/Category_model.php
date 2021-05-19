<?php
class Category_model extends CI_Model{
public function create_variant(){
        $direct = "upload/variant";
        if (file_exists($direct)){
        }else{mkdir("upload/variant");}
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
                        "variant_name"           =>      ucwords($this->input->post("variant_name")),
                        "variant_description"    =>      $this->input->post("variant_description"),
                        "variant_image_path"    =>      ($picture)??'',
                        "variant_created_on"     =>      date("Y-m-d h:i:s"),
                        "variant_created_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->insert("variant",$dta);
        $vps    =   $this->db->insert_id();
        if($vps >  0){ 
            $this->db->update("variant",array("variant_id" => $vps."VARI"),array("variantid" => $vps));
            return TRUE;
        }
        return FALSE;
}

public function create_category(){
   // echo "<pre>";print_r($this->input->post(($_FILES['image']['name'])));exit;
        $direct = "upload/category";
        if (file_exists($direct)){
        }else{mkdir("upload/category");}
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
                        "category_name"           => ucwords($this->input->post("category_name")),
                         "category_name_a"       => ucwords($this->input->post("category_name")),  
                        "category_key"           => ucwords($this->input->post("category_name")),
                        "category_image"         =>($picture)??'',
                        "category_abc"           =>"Active",
                        "category_add_by"       => $this->session->userdata("login_id"),
                        "category_add_date"     =>  date("Y-m-d h:i:s"),
                        "category_open"         => '1',
                        "category_status"       =>  '1'
                      
                    );
                  //  echo "<pre>";print_r($dta);exit;
        $this->db->insert("category",$dta);
        $vps    =   $this->db->insert_id();
        if($vps >  0){ 
            $this->db->update("category",array("category_id" =>"CATE".$vps),array("categoryid" => $vps));
            return TRUE;
        }
        return FALSE;
}
public function queryCategory($params = array()){
        $dt         =   array(
                            "category_open"      =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("category")
                    ->where($dt);
        if(array_key_exists("unique_category",$params)){
                $this->db->where("(category_name LIKE '".$params["unique_category"]."')");
        }
        if(array_key_exists("whereCondition",$params)){
            $this->db->where($params["whereCondition"]);
        }
        if(array_key_exists("keywords",$params)){
                $this->db->where("(category_name LIKE '%".$params["keywords"]."%')");
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
public function cntviewCategory($params  =    array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryCategory($params)->row_array();
        if(count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
}
public function viewCategory($params  =    array()){
        return  $this->queryCategory($params)->result();
}
public function getCategory($params  =    array()){
        return  $this->queryCategory($params)->row_array();
}
public function update_variant($uri) {
        $direct = "upload/variant";
        if (file_exists($direct)){
        }else{mkdir("upload/variant");}
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
	}if($picture!=''){
                $dta    =   array( 
                            "variant_name"            =>      ucwords($this->input->post("variant_name")),
                            "variant_description"    =>      $this->input->post("variant_description"),
                            "variant_image_path"      =>      ($picture)??'',
                            "variant_modified_on"     =>      date("Y-m-d h:i:s"),
                            "variant_modified_by"     =>      $this->session->userdata("login_id")
                    );
        }else{
                $dta    =   array( 
                        "variant_name"            =>      ucwords($this->input->post("variant_name")),
                        "variant_description"    =>      $this->input->post("variant_description"),
                        "variant_modified_on"     =>      date("Y-m-d h:i:s"),
                        "variant_modified_by"     =>      $this->session->userdata("login_id")
                );    
        }
        
        $this->db->update("variant",$dta,array("variant_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Updated Variant","Variant","Update","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}
// public function activedeactive($uri,$status) {
//         $dta    =   array( 
//                             "variant_acde"            =>      $status,
//                             "variant_modified_on"     =>      date("Y-m-d h:i:s"),
//                             "variant_modified_by"     =>      $this->session->userdata("login_id")
//                     );
//         $this->db->update("variant",$dta,array("variant_id" => $uri));
//         if($this->db->affected_rows() >  0){
// //                        $this->transaction_log->save_log("Updated Variant","Variant","Update","",$this->session->userdata("login_id"));
//                 return TRUE;
//         }
//         return FALSE;
// }
public function delete_variant($uri) {
        $dta    =   array( 
                            "variant_open"            =>      '0',
                            "variant_modified_on"     =>      date("Y-m-d h:i:s"),
                            "variant_modified_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("variant",$dta,array("variant_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Deleted Variant","Variant","Delete","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}
public function check_unique_variant($uri){
        $params["cnt"]              =   '1';
        $params["unique_variant"]      =   $uri;
        $params["ad_id"]            =   "1";
        $vsl        =   $this->query_variants($params)->row(); 
        if($vsl->cnt ==  0){
                return FALSE;
        }                       
        return TRUE;
}


public function update_category($uri) {
         // echo "<pre>";print_r($this->input->post());exit;
        $direct = "upload/category";
        if (file_exists($direct)){
        }else{mkdir("upload/category");}
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
	}if($picture!=''){
                $dta    =   array( 
                                "category_name"           => ucwords($this->input->post("category_name")),
                                "category_name_a"       => ucwords($this->input->post("category_name")),  
                                "category_key"           => ucwords($this->input->post("category_name")),
                                "category_image"         =>($picture)??'',
                                "category_abc"           =>"Active",                                
                                "category_open"         => '1',
                                "category_status"       =>  '1',
                                "category_modify_date"     =>      date("Y-m-d h:i:s"),
                                "category_modify_by"     =>      $this->session->userdata("login_id")
                    );
        }else{
                $dta    =   array( 
                        "category_name"           => ucwords($this->input->post("category_name")),
                        "category_name_a"       => ucwords($this->input->post("category_name")),  
                        "category_key"           => ucwords($this->input->post("category_name")),                    
                        "category_abc"           =>"Active",                                
                        "category_open"         => '1',
                        "category_status"       =>  '1',
                        "category_modify_date"     =>      date("Y-m-d h:i:s"),
                        "category_modify_by"     =>      $this->session->userdata("login_id")
                );    
        }
        
        $this->db->update("category",$dta,array("category_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Updated Variant","Variant","Update","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}

   public function activedeactive($uri,$status){
       // echo "hi";exit;
        $dta    =   array(
            "category_abc"        =>      $status,
            "category_modify_date"      =>      date("Y-m-d h:i:s"),
            "category_modify_by"     =>      $this->session->userdata("login_id")
        );
        $this->db->update("category",$dta,array("category_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
public function delete_category($uri) {
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

public function check_unique_category($uri){
        $params["cnt"]              =   '1';
        $params["unique_category"]      =   $uri;
        $params["ad_id"]            =   "1";
        $vsl        =   $this->queryCategory($params)->row(); 
        if($vsl->cnt ==  0){
                return FALSE;
        }                       
        return TRUE;
}
}
?>