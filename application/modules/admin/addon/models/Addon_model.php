<?php
class Addon_model extends CI_Model{
public function create_addon(){
        $direct = "upload/addon";
        if (file_exists($direct)){
        }else{mkdir("upload/addon");}
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
                        "addon_name"           =>      ucwords($this->input->post("addon_name")),
                        "addon_description"    =>      $this->input->post("addon_description"),
                        "addon_image_path"    =>      ($picture)??'',
                        "addon_created_on"     =>      date("Y-m-d h:i:s"),
                        "addon_created_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->insert("addon",$dta);
        $vps    =   $this->db->insert_id();
        if($vps >  0){ 
            $this->db->update("addon",array("addon_id" => $vps."ADDO"),array("addonid" => $vps));
            return TRUE;
        }
        return FALSE;
}
public function query_addons($params = array()){
        $dt         =   array(
                            "addon_open"      =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("addon")
                    ->where($dt);
        if(array_key_exists("unique_addon",$params)){
                $this->db->where("(addon_name LIKE '".$params["unique_addon"]."')");
        }
        if(array_key_exists("whereCondition",$params)){
            $this->db->where($params["whereCondition"]);
        }
        if(array_key_exists("keywords",$params)){
                $this->db->where("(addon_name LIKE '%".$params["keywords"]."%')");
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
public function cntview_addon($params  =    array()){
        $params["cnt"]      =   "1";
        $val    =   $this->query_addons($params)->row_array();
        if(count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
}
public function view_addon($params  =    array()){
        return  $this->query_addons($params)->result();
}
public function get_addon($params  =    array()){
        return  $this->query_addons($params)->row_array();
}
public function update_addon($uri) {
        $direct = "upload/addon";
        if (file_exists($direct)){
        }else{mkdir("upload/addon");}
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
                            "addon_name"            =>      ucwords($this->input->post("addon_name")),
                            "addon_description"    =>      $this->input->post("addon_description"),
                            "addon_image_path"      =>      ($picture)??'',
                            "addon_modified_on"     =>      date("Y-m-d h:i:s"),
                            "addon_modified_by"     =>      $this->session->userdata("login_id")
                    );
        }else{
                $dta    =   array( 
                        "addon_name"            =>      ucwords($this->input->post("addon_name")),
                        "addon_description"    =>      $this->input->post("addon_description"),
                        "addon_modified_on"     =>      date("Y-m-d h:i:s"),
                        "addon_modified_by"     =>      $this->session->userdata("login_id")
                );    
        }
        
        $this->db->update("addon",$dta,array("addon_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Updated Addon","Addon","Update","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}
public function activedeactive($uri,$status) {
        $dta    =   array( 
                            "addon_acde"            =>      $status,
                            "addon_modified_on"     =>      date("Y-m-d h:i:s"),
                            "addon_modified_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("addon",$dta,array("addon_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Updated Addon","Addon","Update","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}
public function delete_addon($uri) {
        $dta    =   array( 
                            "addon_open"            =>      '0',
                            "addon_modified_on"     =>      date("Y-m-d h:i:s"),
                            "addon_modified_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("addon",$dta,array("addon_id" => $uri));
        if($this->db->affected_rows() >  0){
                return TRUE;
        }
        return FALSE;
}
public function check_unique_addon($uri){
        $params["cnt"]              =   '1';
        $params["unique_addon"]      =   $uri;
        $params["ad_id"]            =   "1";
        $vsl        =   $this->query_addons($params)->row(); 
        if($vsl->cnt ==  0){
                return FALSE;
        }                       
        return TRUE;
}
}
?>