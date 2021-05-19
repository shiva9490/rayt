<?php
class Menus_model extends CI_Model{
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
	public function create($ids){
		$direct = "upload/resturants";
        if (file_exists($direct)){
        }else{mkdir("upload/resturants");}
        
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
            'resturant_given_Id'                => $ids,
            'resturant_contact'                 => $this->input->post('contact_person'),
            'resturant_position'                => $this->input->post('position'),
            'resturant_contact_a'               => $this->input->post('contact_person_a'),
            'resturant_position_a'              => $this->input->post('position_a'),
            'resturant_contact_no'              => $this->input->post('contact_no'),
            'resturant_area'                    => $this->input->post('area'),
            'resturant_block'                   => $this->input->post('block'),
            'resturant_street'                  => $this->input->post('street'),
            'resturant_jaada'                   => $this->input->post('jaada'),
            'resturant_house'                   => $this->input->post('house'),
            'resturant_building'                => $this->input->post('building'),
            'resturant_latitude'                => $this->input->post('latitude'),
            'resturant_longitude'               => $this->input->post('longitude'),
            'resturant_landmark'                => $this->input->post('landmark'),
            'resturant_area_a'                  => $this->input->post('area_a'),
            'resturant_block_a'                 => $this->input->post('block_a'),
            'resturant_street_a'                => $this->input->post('street_a'),
            'resturant_jaada_a'                 => $this->input->post('jaada_a'),
            'resturant_house_a'                 => $this->input->post('house_a'),
            'resturant_building_a'              => $this->input->post('building_a'),
            'resturant_landmark_a'              => $this->input->post('landmark_a'),
            'resturant_menu_hours'              => ($this->input->post('menu_hours'))?implode(',',$this->input->post('menu_hours')):'',
            'resturant_preparation'             => $this->input->post('preparation_time'),
            'resturant_delivery'                => $this->input->post('delivery_fee'),
            'resturant__discount'               => $this->input->post('discount'),
            'resturant_cuisine'                 => ($this->input->post('cusine'))?implode(',',$this->input->post('cusine')):'',
            'resturant_zone'                    => $this->input->post('zone'),
            'resturant_zone_time'               => $this->input->post('zone_time'),
            'resturant_subzone'                 => $this->input->post('sub_zone'),
            'resturant_subzone_time'            => $this->input->post('sub_zone_time'),
            'resturant_contract'                => $this->input->post('contact_date'),
            //'resturant_contract_doc'            => $picture,
            'resturant_commertial_license'      => $this->input->post('license_no'),
            'resturant_civil_id'                => $this->input->post('civil_id'),
            'resturant_percentage'              => $this->input->post('Percentage'),
            'resturant_signature'               => $picture1,
            'resturant_sales_person'            => $this->input->post('person_name'),
            'resturant_sales_person_a'          => $this->input->post('person_name_a'),
            'resturant_name_a'                  => $this->input->post('name_a'),
            'resturant_name'                    => ucfirst($this->input->post('name')),
            'resturant_status'					=> 'Active',
            'resturant_open'					=> 1,
            "resturant_created_on"              => date("Y-m-d h:i:s"),
            "resturant_created_by"              => $this->session->userdata("login_id")
        );
		//echo '<pre>';print_r($data);exit;
        $this->db->insert("resturant",$data);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $dat=array(
				"resturant_id" 			=> $vsp."RES",
				"resturant_image"		=> $picture3
			);	
			$id=$vsp;	
            $this->db->update("resturant",$dat,"resturantid='".$vsp."'");			
			$d = array(
				'restraint_id'		 		=> $vsp."RES",
				'restraint_login_username'	=> $ids,
				'restraint_login_password'	=> $this->input->post('password'),
				'restraint_login_type'		=> 'Admin',
				'restraint_login_add_by'	=> ($this->session->userdata("login_id") !="")?$this->session->userdata("login_id"):'',
				'restraint_login_add_date' 	=> date('Y-m-d H:i:s'),
			);
			$this->db->insert('restraint_login',$d);
			$login = $this->db->insert_id();
			$this->db->where('restraint_login',$login)->update('restraint_login',array('restraint_login_id'=> 'RestLOG'.$login));
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
            }
			$totals = count($_FILES['legal_doc']['name']);
            // Loop through each file
            for( $i=0 ; $i < $total ; $i++ ) {
                //Get the temp file path
                $tmpFilePath = $_FILES['legal_doc']['tmp_name'][$i];
                //Make sure we have a file path
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePaths = $direct."/".$_FILES['legal_doc']['name'][$i];
                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePaths)) {
                        $data = array(
                            'resturant_id'        		=> $vsp."RESI",
                            'resturant_legal_doc'        => $newFilePaths,
                            "resturant_legal_add_date"     => date("Y-m-d h:i:s"),
                            "resturant_legal_add_by"       => $this->session->userdata("login_id")
                        );
                        $this->db->insert(" resturant_legal_doc",$data);
                        $vsps   =    $this->db->insert_id();
                        if($vsps > 0){
							$dd = array(
								"resturant_legal_id" => $vsps."RestKLegal",
							);
                            $this->db->where('resturant_legal',$vsps)->update("resturant_legal_doc",$dd);
                        }
                    }
                }
            }
			return $vsp."RES";
            return false;
	    }
    }
	
	public function queryMenu($params = array()){
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
	public function queryCategory($params = array()){
        $dt =   array(
            "resturant_category_open"  	=> '1',
            "resturant_category_status" => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_category")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_category_name LIKE '%".$params["keywords"]."%')");
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
    //  $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
	
    public function cntviewCategory($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryCategory($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
	public function viewCategory($params = array()){
        return $this->queryCategory($params)->result();
    }
	public function querySubCategory($params = array()){
        $dt =   array(
            "resturant_subcategory_open"  	=> '1',
            "resturant_subcategory_status"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_subcategory")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_subcategory_name LIKE '%".$params["keywords"]."%')");
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
      //$this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
	
	public function viewItems($params = array()){
        return $this->queryItems($params)->result();
    }
    public function getItems($params = array()){
        return $this->queryItems($params)->result_array();
    }
	public function queryItems($params = array()){
        $dt =   array(
            "resturant_items_open"  	=> '1',
            "resturant_items_status"  	=> '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_items")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_items_name LIKE '%".$params["keywords"]."%')");
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
      //$this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
	
    public function cntviewItems($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryItems($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
	public function cntviewSubCategory($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->querySubCategory($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
	public function viewSubCategory($params = array()){
        return $this->querySubCategory($params)->result();
    }
	
	public function cntviewMenu($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryMenu($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
	
    public function getMenu($params = array()){
        return $this->queryMenu($params)->row_array();
    }
    public function viewMenu($params = array()){
        //print_r($params);exit;
        return $this->queryMenu($params)->result();
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
    public function activedeactiveitem($uri,$status){
        $dat=array(
			"resturant_items_abc"           => $status,
			"resturant_items_modify_by"     => $this->input->post("restrant_id"),
			"resturant_items_modify_date"   => date('Y-m-d H:i:s')
		);
        $this->db->where('resturant_items_id',$uri)->update("resturant_items",$dat);
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
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
                'resturant_contact_a'               =>$this->input->post('contact_person_a'),
                'resturant_position_a'              =>$this->input->post('position_a'),
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
                'resturant_area_a'                  =>$this->input->post('area_a'),
                'resturant_block_a'                 =>$this->input->post('block_a'),
                'resturant_street_a'                =>$this->input->post('street_a'),
                'resturant_jaada_a'                 =>$this->input->post('jaada_a'),
                'resturant_house_a'                 =>$this->input->post('house_a'),
                'resturant_building_a'              =>$this->input->post('building_a'),
                'resturant_landmark_a'              =>$this->input->post('landmark_a'),
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
                'resturant_commertial_license'      =>$this->input->post('license_no'),
                'resturant_civil_id'                =>$this->input->post('civil_id'),
                'resturant_percentage'              =>$this->input->post('Percentage'),
                'resturant_sales_person'            =>$this->input->post('person_name'),
                'resturant_sales_person_a'            =>$this->input->post('person_name_a'),
                'resturant_name_a'                  => $this->input->post('name_a'),
                'resturant_name'                    => ucfirst($this->input->post('name')),
                "resturant_update_on"              => date("Y-m-d h:i:s"),
                "resturant_update_by"              => $this->session->userdata("login_id")
            );
            if(!empty($picture3)){ 
                $data1= array(
                'resturant_image'               =>$picture3,
                );
            }else{
                $data1= array();
            }
            if(!empty($picture1)){ 
                $data2 = array(
                'resturant_signature'               =>$picture1,
                );
            }else{
                $data2= array();
            }
            if(!empty($picture)){ 
                $data3 = array(
                 'resturant_contract_doc'            =>$picture,
                );
            }else{
                $data3= array();
            }
            $data = array_merge_recursive($data,$data1,$data2,$data3);
                
             $this->db->update("resturant",$data,array("resturant_id" => $uro));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
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
										"resturant_id" 				        => $uro
								);		
							$this->db->update("resturant_images",$dat,"resturant_imagesid ='".$vsp."'");
						}
					}
				}
            } return true;
            return false;
	}
    }
    public function unique_id_resturant($str){
        $pms["whereCondition"]  =   "resturant_name = '".$str."'";
        $vsp    =   $this->getResturant($pms);
        if(is_array($vsp) && count($vsp) > 0){
            return true;
        }
        return false;
    }
    public function queryResImages($params = array()){
        $dt =   array(
            "resturant_images_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_images")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(resturant_id = '".$params["id"]."')");
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
    public function cntviewResImages($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryResImages($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getResImages($params = array()){
        return $this->queryResImages($params)->row_array();
    }
    public function viewResImages($params = array()){
        //print_r($params);exit;
        return $this->queryResImages($params)->result();
    }
    public function delete_resImages($uro){
        $this->db->delete("resturant_images",array("resturant_images_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
    public function additem(){
        $direct = "upload/resturants";
        $picture1 = '';
		if(!empty($_FILES['main_image']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['main_image']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('main_image')){
				$uploadData = $this->upload->data();
				$picture1 = $uploadData['file_name'];
				$data = array('upload_data' => $this->upload->data());
				 $img=$data['upload_data']['file_name'];
				 $config['image_library'] = 'gd2';
				 $config['source_image'] = $direct.'/'.$img;
				 $config['new_image'] = 'upload/';
				 $config['maintain_ratio'] = TRUE;
				 $config['width']    = 135;
				 $config['height']   = 135;
				 $this->load->library('image_lib', $config); 
				 if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
				 }
			}
		}
        $data  = array(
            'resturant_id'             => $this->session->userdata("restraint_id"),
            'resturant_temp_id'        => $this->input->post('tempid'),
            'resturant_category_id'    => $this->input->post('categoty'),
            'resturant_items_name'     => $this->input->post('itemname'),
            'resturant_items_name_a'   => $this->input->post('itemname_a'),
            'resturant_items_type'     => $this->input->post('veg_type'),
            'resturant_items_desc'     => $this->input->post('details'),
            'resturant_items_price'    => $this->input->post('item_price'),
            'resturant_items_packing'  => $this->input->post('final_amount'),
            'resturant_items_vat'      => $this->input->post('vat'),
            'resturant_items_add_by'   => ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):$this->session->userdata("login_type"),
            'resturant_items_add_date' => date('Y-m-d H:i:s'),
        );
        if(!empty($_FILES['main_image']['name'])){
            $data['resturant_items_image'] = $picture1;
        }
        $this->db->insert('resturant_items',$data);
        $id = $this->db->insert_id();
        $dat=array(
			"resturant_items_id" => "RESTITEM".$id,
		);
        $this->db->where('resturant_itemid',$id)->update("resturant_items",$dat);
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            if(!empty($this->input->post('timings'))){
                if($this->input->post('timings')!='alltime'){
                   $start   =    $this->input->post('strt_time');
                   $end     =    $this->input->post('end_time');$i=0;
                    foreach($start as $s){
                        $data  = array(
                            'resturant_timing_item_id'             => "RESTITEM".$id,
                            'resturant_timing_type'    => $this->input->post('timings'),
                            'resturant_timing_start'     => $s,
                            'resturant_timing_end'   => $end[$i],
                            'resturant_timing_cr_by'   => ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):$this->session->userdata("login_type"),
                            'resturant_timing_cr_on' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('resturant_timings',$data);
                        $id = $this->db->insert_id();
                        $dat=array(
                            "resturant_timing_id" => "RESTITEM".$id,
                        );
                        $this->db->where('resturant_timingid',$id)->update("resturant_timings",$dat);
                        $i++;
                    }
                }
            }
            $this->session->unset_userdata('tempid');
            return true;
        }
        return FALSE;
    }
    public function updateitem($id){
        $direct = "upload/resturants";
        $picture1 = '';
		if(!empty($_FILES['main_image']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['main_image']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('main_image')){
				$uploadData = $this->upload->data();
				$picture1 = $uploadData['file_name'];
				$data = array('upload_data' => $this->upload->data());
				 $img=$data['upload_data']['file_name'];
				 $config['image_library'] = 'gd2';
				 $config['source_image'] = $direct.'/'.$img;
				 $config['new_image'] = 'upload/';
				 $config['maintain_ratio'] = TRUE;
				 $config['width']    = 135;
				 $config['height']   = 135;
				 $this->load->library('image_lib', $config); 
				 if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
				 }
			}
		}
        $data  = array(
            'resturant_items_name'     => $this->input->post('itemname'),
            'resturant_items_name_a'   => $this->input->post('itemname_a'),
            'resturant_items_type'     => $this->input->post('veg_type'),
            'resturant_items_desc'     => $this->input->post('details'),
            'resturant_items_price'    => $this->input->post('item_price'),
            'resturant_items_packing'  => $this->input->post('final_amount'),
            'resturant_items_vat'      => $this->input->post('vat'),
            'resturant_items_add_by'   => ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):$this->session->userdata("login_type"),
            'resturant_items_add_date' => date('Y-m-d H:i:s'),
        );
        if(!empty($_FILES['main_image']['name'])){
            $data['resturant_items_image'] = $picture1;
        }
        $this->db->where('resturant_items_id',$id)->update('resturant_items',$data);
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    } 
    public function addcategory(){
        $data = array(
            'resturant_id'                => $this->session->userdata("restraint_id"),
            'resturant_category_name'     => $this->input->Post("category"),
            'resturant_category_name_a'   => $this->input->Post("category_a"),
            'resturant_category_key'      => $this->input->Post("category"),
            'resturant_category_add_by'   => $this->session->userdata("restraint_id"),
            'resturant_category_add_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('resturant_category',$data);
        $id  = $this->db->insert_id();
        $this->db->where('resturant_categoryid',$id)->update('resturant_category',array('resturant_category_id'=> "RESTCAT".$id));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
    public function checkcategory($username){
        $params["whereCondition"]   =   "resturant_category_name = '".$username."'";
        $rev        =   $this->queryCategory($params)->row_array();
        if(is_array($rev) && count($rev) > 0){
            return true; 
        }
        return false;
    }
    public function adding_variant(){
        //print_r($this->input->post());exit;
        if(is_array($this->input->post('addon_listid')) && count($this->input->post('addon_listid')) > 0){
            $da = array(
                'resturant_customisation'   => ($this->input->post("addonoption")!="")?$this->input->post("addonoption"):'',
                'resturant_addon_option'      => ($this->input->post("selection")!="")?$this->input->post("selection"):'',
                'resturant_addon_max'         => ($this->input->post("maxvalue")!="")?$this->input->post("maxvalue"):'',
                'resturant_addon_min'         => ($this->input->post("minselection")!="")?$this->input->post("minselection"):'',
                'resturant_addon_modify_by'   => ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):'',
                'resturant_addon_modify_date' => date('Y-m-d H:i:s'),
            );
            $this->db->where('resturant_addon_temp_id',$this->input->post('tempid'))->update('resturant_addon',$da);
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                foreach($this->input->post('addon_listid') as $key=>$r){
                    $d = array(
                        'resturant_addonitem'               => $this->input->post('addonitem')[$key],
                        'resturant_addonitem_amount'        => $this->input->post('addonitem_amount')[$key],
                        'resturant_addon_list_modify_by'    => $this->session->userdata("restraint_id"),
                        'resturant_addon_list_modify_date'  => date('Y-m-d H:i:s')
                    );
                    $this->db->where('resturant_addon_listid',$this->input->post('addon_listid')[$key])->update('resturant_addon_list',$d);
                }
                return true;
            }
            return false;
        }else{
            $da = array(
                'resturant_addon_temp_id'   => $this->input->post('tempid'),
                'resturant_id'              => ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):'',
                'resturant_addon_category'  => ($this->input->post("eve")!="")?$this->input->post("eve"):'',
                'resturant_customisation'   => ($this->input->post("addonoption")!="")?$this->input->post("addonoption"):'',
                'resturant_addon_option'    => ($this->input->post("selection")!="")?$this->input->post("selection"):'',
                'resturant_addon_max'       => ($this->input->post("maxvalue")!="")?$this->input->post("maxvalue"):'',
                'resturant_addon_min'       => ($this->input->post("minselection")!="")?$this->input->post("minselection"):'',
                'resturant_addon_add_by'    => ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):'',
                'resturant_addon_date'      => date('Y-m-d H:i:s'),
            );
            $this->db->insert('resturant_addon',$da);
            $id = $this->db->insert_id();
            $this->db->where('resturant_addonid',$id)->update('resturant_addon',array('resturant_addon_id'=> 'ADON'.$id));
            $vsp   =    $this->db->affected_rows();
            if($vsp > 0){
                foreach($this->input->post('addonitem') as $key=>$r){
                    $d = array(
                        'resturant_addon_id'            => 'ADON'.$id,
                        'resturant_addonitem'           => $this->input->post('addonitem')[$key],
                        'resturant_addonitem_amount'    => $this->input->post('addonitem_amount')[$key],
                        'resturant_addon_list_addby'    => $this->session->userdata("restraint_id"),
                        'resturant_addon_list_add_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('resturant_addon_list',$d);
                    $ids = $this->db->insert_id();
                    $this->db->where('resturant_addon_list_id',$ids)->update('resturant_addon_list',array('resturant_addon_listid'=> 'ADONITEM'.$ids));
                }
                return true;
            }
        }
        return FALSE;
    }
    public function adding_variants(){
       // print_r($this->input->post());exit;
        $i=0;
        foreach($this->input->post('addonoption') as $key=>$s){
            $defelat ='';
            if(isset($this->input->post("defelat")[$i])){
                if($this->input->post("defelat")[$i] == $i){
                    $defelat = "1";
                }
            }
            if($this->input->post('variantsid')[$i] != ""){
                $dat = array(
                    'resturant_variants_tempid'      => $this->input->post('tempid'),  
                    'resturant_id'                   => $this->session->userdata("restraint_id"),  
                    'resturant_variants_category'    => $this->input->post("eve"),  
                    'resturant_variants_title'       => ($this->input->post("customization")!="")?$this->input->post("customization"):'',
                    'resturant_variants'             => $this->input->post("addonoption")[$i],
                    'resturant_variants_veg'         => $this->input->post("veg")[$i],
                    'resturant_variants_price'       => $this->input->post("addprince")[$i],
                    'resturant_variants_defelat'     => $defelat,
                    'resturant_variants_modifyby'    => $this->session->userdata("restraint_id"),
                    'resturant_variants_modify_date' => date('Y-m-d H:i:s')
                );
                //print_r($dat);
                $this->db->where('resturant_variants_id',$this->input->post('variantsid')[$i])->update('resturant_variants',$dat); 
            }else{
                $dat = array(
                    'resturant_variants_tempid'     => $this->input->post('tempid'),  
                    'resturant_id'                  => $this->session->userdata("restraint_id"),  
                    'resturant_variants_category'   => $this->input->post("eve"),  
                    'resturant_variants_title'      => ($this->input->post("customization")!="")?$this->input->post("customization"):'',
                    'resturant_variants'            => $this->input->post("addonoption")[$i],
                    'resturant_variants_veg'        => $this->input->post("veg")[$i],
                    'resturant_variants_price'      => $this->input->post("addprince")[$i],
                    'resturant_variants_defelat'    => ($defelat!="")?$defelat:'',
                    'resturant_variants_add_by'     => $this->session->userdata("restraint_id"),
                    'resturant_variants_add_date'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('resturant_variants',$dat);
                $id = $this->db->insert_id();
                $this->db->where('resturant_variantsid',$id)->update('resturant_variants',array('resturant_variants_id'=>'VARI'.$id));
            }
            $i++;
        }
        return true;
    }
    /*
    public function viewVariants($params = array()){
        return $this->queryVariants($params)->result();
    }
    
    public function queryVariants($params = array()){
        $dt =   array(
            "resturant_variants_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_variants")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_variants LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(resturant_id = '".$params["id"]."')");
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
        if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                $this->db->order_by($params['tipoOrderby'],$params['order_by']);
        }
         $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
    */
    public function active_inactive_item($uri,$status){
        $dta    =   array(
            "resturant_items_abc"           =>  $status,
            "resturant_items_modify_date"   =>  date("Y-m-d h:i:s"),
            "resturant_items_modify_by"     =>  $this->session->userdata("login_id")
        );
        $this->db->update("resturant_items",$dta,array("resturant_items_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    
    public function getAddon($params = array()){
        return $this->queryAddon($params)->result_array();
    } 
    public function viewAddon($params = array()){
        return $this->queryAddon($params)->result();
    } 
    public function queryAddon($params = array()){
        $dt =   array(
            "resturant_addon_open"  => '1',
            "resturant_items_open"  => '1',
            "resturant_addon_list_open"  => '1',
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_addon as ra")
                    ->join("resturant_items as rt","ra.resturant_addon_temp_id =rt.resturant_temp_id","inner")
                    ->join("addon as an","an.addon_id = ra.resturant_addon_category","inner")
                    ->join("resturant_addon_list as ral","ra.resturant_addon_id =ral.resturant_addon_id","inner")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_addon_option LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(resturant_id = '".$params["id"]."')");
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
    
    public function viewVariants($params = array()){
        return $this->queryVariants($params)->result();
    } 
    public function getVariants($params = array()){
        return $this->queryVariants($params)->result_array();
    } 
    
    public function queryVariants($params = array()){
        $dt =   array(
            "variant_open"              => '1',
            "resturant_items_open"      => '1',
            "resturant_variants_open"   => '1',
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("resturant_variants as rv")
                    ->join("variant as vt","vt.variant_id = rv.resturant_variants_category","inner")
                    ->join("resturant_items as rt","rv.resturant_variants_tempid = rt.resturant_temp_id","inner")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(resturant_addon_option LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(resturant_id = '".$params["id"]."')");
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
}
?>