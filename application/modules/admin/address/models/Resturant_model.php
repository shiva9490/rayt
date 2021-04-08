<?php
class Resturant_model extends CI_Model{
	public function jsonencodevalues($status,$status_message,$check = '1'){ 
		$json   =   array(
			"status"            =>  $status,
			"status_messsage"   =>  $status_message,
		);
		if($check == '0'){
			return $json;
		}
		return json_encode($json);
	}  
	public function create(){
		$direct = "upload/resturants";
        if (file_exists($direct)){
        }else{mkdir("upload/resturants");}
        $picture= '';
		if(!empty($_FILES['legal_doc']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['legal_doc']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('legal_doc')){
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
        $picture1= '';
		if(!empty($_FILES['sign']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['sign']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('sign')){
				$uploadData = $this->upload->data();
				$picture1 = $uploadData['file_name'];
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
        $picture3= '';
		if(!empty($_FILES['main_image']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['main_image']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('main_image')){
				$uploadData = $this->upload->data();
				$picture3 = $uploadData['file_name'];
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
            $data = array(
                'resturant_given_Id'                =>$this->input->post('id'),
                'resturant_password'                =>base64_encode ($this->input->post('password')),
                'resturant_contact'                 =>$this->input->post('contact_person'),
                'resturant_position'                =>$this->input->post('position'),
                'resturant_contact_no'              =>$this->input->post('contact_no'),
                'resturant_area'                    =>$this->input->post('area'),
                'resturant_block'                   =>$this->input->post('block'),
                'resturant_street'                  =>$this->input->post('street'),
                'resturant_jaada'                   =>$this->input->post('jaada'),
                'resturant_house'                   =>$this->input->post('house'),
                'resturant_building'                =>$this->input->post('building'),
                'resturant_latitude'                =>$this->input->post('latitude'),
                'resturant_longitude'               =>$this->input->post('longitude'),
                'resturant_landmark'                =>$this->input->post('landmark'),
                'resturant_menu_hours'              =>implode(',',$this->input->post('menu_hours')),
                'resturant_preparation'             =>$this->input->post('preparation_time'),
                'resturant_delivery'                =>$this->input->post('delivery_fee'),
                'resturant__discount'               =>$this->input->post('discount'),
                'resturant_cuisine'                 =>implode(',',$this->input->post('cusine')),
                'resturant_zone'                    =>$this->input->post('zone'),
                'resturant_zone_time'               =>$this->input->post('zone_time'),
                'resturant_subzone'                 =>$this->input->post('sub_zone'),
                'resturant_subzone_time'            =>$this->input->post('sub_zone_time'),
                'resturant_contract'                =>$this->input->post('contact_date'),
                'resturant_contract_doc'            =>$picture,
                'resturant_commertial_license'      =>$this->input->post('license_no'),
                'resturant_civil_id'                =>$this->input->post('civil_id'),
                'resturant_percentage'              =>$this->input->post('Percentage'),
                'resturant_signature'               =>$picture1,
                'resturant_sales_person'            =>$this->input->post('person_name'),
                'resturant_name'                    => ucfirst($this->input->post('name')),
                'resturant_status'					=> 'Active',
                'resturant_open'					=> 1,
                "resturant_created_on"              => date("Y-m-d h:i:s"),
                "resturant_created_by"              => $this->session->userdata("login_id")
            );
            $this->db->insert("resturant",$data);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $dat=array(
                            "resturant_id" 				=> $vsp."RES",
                            "resturant_image"		=> $picture3
                        );	$id=$vsp;	
                $this->db->update("resturant",$dat,"resturantid='".$vsp."'");	
                            //$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.
                            // Count # of uploaded files in array
                            $total = count($_FILES['files']['name']);
                            // Loop through each file
                            for( $i=0 ; $i < $total ; $i++ ) {
                            //Get the temp file path
                            $tmpFilePath = $_FILES['files']['tmp_name'][$i];
                            //Make sure we have a file path
                            if ($tmpFilePath != ""){
                                //Setup our new file path
                                $newFilePath = $direct."/".$_FILES['files']['name'][$i];
                                //Upload the file into the temp dir
                                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                                    $data = array(
                                        'resturant_images_path'                 => $newFilePath,
                                        'resturant_images_status'				=> 'Active',
                                        'resturant_images_open'					=> 1,
                                        "resturant_images_created_on"           => date("Y-m-d h:i:s"),
                                        "resturant_images_created_by"           => $this->session->userdata("login_id")
                            
                                    );
                                    $this->db->insert("resturant_images",$data);
                                    $vsp   =    $this->db->insert_id();
                                    if($vsp > 0){
                                        $dat=array(
                                                    "resturant_images_id" 				=> $vsp."RESI",
                                                    "resturant_id" 				        => $id."RES"
                                            );		
                                        $this->db->update("resturant_images",$dat,"resturant_imagesid ='".$vsp."'");

                                    }
                                }
                            }
                   
            } return true;
            return false;
	}
}
	public function queryResturant($params = array()){
        $dt =   array(
            "resturant_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("image_inactive",$params)){
                $this->db->where("(".$params["image_inactive"].")");
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
        if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                $this->db->order_by($params['tipoOrderby'],$params['order_by']);
        }
    //     $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
    public function cntviewResturant($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryResturant($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getResturant($params = array()){
        return $this->queryResturant($params)->row_array();
    }
    public function viewResturant($params = array()){
        //print_r($params);exit;
        return $this->queryResturant($params)->result();
    }
    public function activedeactive($uri,$status){
        $dta    =   array(
            "resturant_status"        =>      $status,
            "resturant_update_on"      =>      date("Y-m-d h:i:s"),
            "resturant_update_by"     =>      $this->session->userdata("login_id")
        );
        $this->db->update("resturant",$dta,array("resturant_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_resturant($uro){
        $dta    =   array(
            "resturant_open"            =>  0, 
            "resturant_update_on"       =>  date("Y-m-d h:i:s"),
            "resturant_update_by"       =>  $this->session->userdata("login_id")
        );
        $this->db->update("resturant",$dta,array("resturant_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
    public function update_resturant($uro){
        $direct = "upload/resturant";
        if (file_exists($direct)){
        }else{mkdir("upload/resturant");}
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
        if(!empty($picture)){
            $dat    =   array(
                "resturant_name"                =>  $this->input->post("Name"),
                "resturant_imagepath"           =>  $picture,
                "resturant_update_on"           =>  date("Y-m-d h:i:s"),
                "resturant_update_by"           =>  $this->session->userdata("login_id")
            );
            $this->db->update("resturant",$dat,array("resturant_id" => $uro));
            $vsp   =    $this->db->affected_rows();
        }else{
            $dat    =   array(
                "resturant_name"                =>  $this->input->post("Name"),
                "resturant_update_on"           =>  date("Y-m-d h:i:s"),
                "resturant_update_by"           =>  $this->session->userdata("login_id")
            );
            $this->db->update("resturant",$dat,array("resturant_id" => $uro));
            $vsp   =    $this->db->affected_rows();
        }
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
    public function unique_id_resturant($str){
        $pms["whereCondition"]  =   "resturant_name = '".$str."'";
        $vsp    =   $this->getResturant($pms);
        if(is_array($vsp) && count($vsp) > 0){
            return true;
        }
        return false;
    }

}
?>