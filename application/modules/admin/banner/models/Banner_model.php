<?php
class Banner_model extends CI_Model{
public function create_banner(){
        $direct = "upload/banner";
        if (file_exists($direct)){
        }else{mkdir("upload/banner");}
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
                        "banner_image_path"    =>      ($picture)??'',
                        "banner_created_on"     =>      date("Y-m-d h:i:s"),
                        "banner_created_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->insert("banner",$dta);
        $vps    =   $this->db->insert_id();
        if($vps >  0){ 
            $this->db->update("banner",array("banner_id" => $vps."UTPE"),array("bannerid" => $vps));
            return TRUE;
        }
        return FALSE;
}
public function query_banners($params = array()){
        $dt         =   array(
                            "banner_open"      =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("banner")
                    ->where($dt);
        if(array_key_exists("unique_banner",$params)){
                $this->db->where("(banner_name LIKE '".$params["unique_banner"]."')");
        }
        if(array_key_exists("whereCondition",$params)){
            $this->db->where($params["whereCondition"]);
        }
        if(array_key_exists("keywords",$params)){
                $this->db->where("(banner_name LIKE '%".$params["keywords"]."%')");
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
public function cntview_banner($params  =    array()){
        $params["cnt"]      =   "1";
        $val    =   $this->query_banners($params)->row_array();
        if(count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
}
public function view_banner($params  =    array()){
        return  $this->query_banners($params)->result();
}
public function get_banner($params=array()){
        return  $this->query_banners($params)->row_array();
}
public function update_banner($uri) {
        $direct = "upload/banner";
        if (file_exists($direct)){
        }else{mkdir("upload/banner");}
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
                            "banner_image_path"      =>      ($picture)??'',
                            "banner_modified_on"     =>      date("Y-m-d h:i:s"),
                            "banner_modified_by"     =>      $this->session->userdata("login_id")
                    );
        }        
        $this->db->update("banner",$dta,array("banner_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Updated Banner","Banner","Update","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}
public function activedeactive($uri,$status) {
        $dta    =   array( 
                            "banner_acde"            =>      $status,
                            "banner_modified_on"     =>      date("Y-m-d h:i:s"),
                            "banner_modified_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("banner",$dta,array("banner_id" => $uri));
        if($this->db->affected_rows() >  0){
//                        $this->transaction_log->save_log("Updated Banner","Banner","Update","",$this->session->userdata("login_id"));
                return TRUE;
        }
        return FALSE;
}
public function delete_banner($uri) {
        $dta    =   array( 
                        "banner_open"            =>      '0',
                        "banner_modified_on"     =>      date("Y-m-d h:i:s"),
                        "banner_modified_by"     =>      $this->session->userdata("login_id")
                    );
        $this->db->update("banner",$dta,array("banner_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
}
public function check_unique_banner($uri){
        $params["cnt"]              =   '1';
        $params["unique_banner"]      =   $uri;
        $params["ad_id"]            =   "1";
        $vsl        =   $this->query_banners($params)->row(); 
        if($vsl->cnt ==  0){
                return FALSE;
        }                       
        return TRUE;
}
}
?>