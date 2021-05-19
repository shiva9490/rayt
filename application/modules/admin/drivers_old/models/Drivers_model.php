<?php
class Drivers_model extends CI_Model{
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
      
		$direct = "upload/drivers";
        if (file_exists($direct)){
        }else{mkdir("upload/drivers");}
        $picture3= '';
		if(!empty($_FILES['driver_profile_image']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['driver_profile_image']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('driver_profile_image')){
				$uploadData = $this->upload->data();
				$picture3 = $uploadData['file_name'];
				$data = array('upload_data' => $this->upload->data());
				$img=$data['upload_data']['file_name'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = $direct.'/'.$img;
				$config['new_image'] = 'upload/';
				$config['maintain_ratio'] = TRUE;
				$config['width']    = 300;
				$config['height']   = 300;
				$this->load->library('image_lib', $config); 
				if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
				}
			}
		}
   
       
        $data = array( 
          
            'driver_name'                 => $this->input->post('driver_name'),
            'driver_name_a'                => $this->input->post('driver_name_a'),
            'driver_phone'                => $this->input->post('driver_phone'),
            'driver_email'                => $this->input->post('driver_email'), 
            'driver_dob'                     => $this->input->post('driver_dob'),        
            'driver_vehicle_number'       => $this->input->post('driver_vehicle_number'),
            'driver_address_a'            => $this->input->post('driver_address_a'),
            'driver_address'              => $this->input->post('driver_address'),
            'driver_countrycode'         => $this->input->post('driver_countrycode'),
            'driver_joining_date'         => $this->input->post('driver_joining_date'),
            'driver_experience'           => $this->input->post('driver_experience'),             
            'driver_status'				  => 'Active',
            'driver_open'				  => 1,
            "driver_created_on"           => date("Y-m-d h:i:s"),
            "driver_created_by"           => $this->session->userdata("login_id")
        );
        	//	echo '<pre>';print_r($data);exit;
        $mail_array = array('driver_email' => $this->input->post('driver_email'));
        if($mail_array){
	//	echo '<pre>';print_r($data);exit;
        $this->db->insert("drivers",$data);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $dat=array(
				"driver_id" 			=> $vsp."DRIVER",
				"driver_profile_image"		=> $picture3
			);	
			$id=$vsp;	
            $this->db->update("drivers",$dat,"driverid='".$vsp."'");			
			
            $total = count($_FILES['driver_files']['name']);
            // Loop through each file
            for( $i=0 ; $i < $total ; $i++ ) {
                //Get the temp file path
                $tmpFilePath = $_FILES['driver_files']['tmp_name'][$i];
                //Make sure we have a file path
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = $direct."/".$_FILES['driver_files']['name'][$i];
                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $data = array(
                            'driver_images_path'                 => $newFilePath,
                            'driver_images_status'				=> 'Active',
                            'driver_images_open'					=> 1,
                            "driver_images_created_on"           => date("Y-m-d h:i:s"),
                            "driver_images_created_by"           => $this->session->userdata("login_id")
                        );
                      //  print_r($data);exit;
                        $this->db->insert("drivers_images",$data);
                        $vsp   =    $this->db->insert_id();
                        if($vsp > 0){
                            $dat=array(
                                "driver_images_id" 				=> $vsp."DRIVERI",
                                "driver_id" 				        => $id."DRIVER"
                            );		
                            $this->db->update("drivers_images",$dat,"driver_imagesid ='".$vsp."'");
                        }
                    }
                }
            }
		
			return $vsp."DRIVER";
            return false;
	    }
     }
    }


    public function queryDriver($params = array()){
        $dt =   array(
            "driver_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("drivers")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(driver_name LIKE '%".$params["keywords"]."%' OR driver_phone LIKE '%".$params["keywords"]."%' OR driver_id LIKE '%".$params["keywords"]."%')");
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
    public function cntviewDriver($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryDriver($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getDriver($params = array()){
        return $this->queryDriver($params)->row_array();
    }
    public function viewDriver($params = array()){
        //print_r($params);exit;
        return $this->queryDriver($params)->result();
    }
    public function activedeactive($uri,$status){
       // echo "hi";exit;
        $dta    =   array(
            "driver_status"        =>      $status,
            "driver_updated_on"      =>      date("Y-m-d h:i:s"),
            "driver_updated_by"     =>      $this->session->userdata("login_id")
        );
        $this->db->update("drivers",$dta,array("driver_id" => $uri));
        if($this->db->affected_rows() >  0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_driver($uro){
        $dta    =   array(
            "driver_open"            =>  0, 
            "driver_updated_on"       =>  date("Y-m-d h:i:s"),
            "driver_updated_by"       =>  $this->session->userdata("login_id")
        );
        $this->db->update("drivers",$dta,array("driver_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;        
    }

    public function checkemail($fields,$username){  
        $params["whereCondition"]   =   'l.'.$fields.' LIKE "'.$username.'"';
        $rev        =   $this->queryDriver($params)->row_array();
        if(is_array($rev) && count($rev) > 0){ 
            return true; 
        }
        return false;
    }
    public function checkphone($fields,$username){  
        $params["whereCondition"]   =   'l.'.$fields.' LIKE "'.$username.'"';
        $rev        =   $this->queryDriver($params)->row_array();
        if(is_array($rev) && count($rev) > 0){ 
            return true; 
        }
        return false;
    }

    public function checkvalueemail($username){  
        $params["whereCondition"]   =   "driver_email='".$username."' ";
        $rev        =   $this->queryDriver($params)->row_array();
        if(is_array($rev) && count($rev) > 0){ 
            return true; 
        } 
        return false;
    }
    public function checkvaluephone($username){  
        $params["whereCondition"]   =   "driver_phone ='".$username."' ";
        $rev        =   $this->queryDriver($params)->row_array();
        if(is_array($rev) && count($rev) > 0){ 
            return true; 
        }
        return false;
    }
    public function checkmail($mail_array)
    {
        $this->db->where($array);
        $query = $this->db->get('drivers');
        $num = $query->num_rows();
        if ($num) {
            return true;
        } else {
            return false;
        }
    }

    public function update_driver($uri){        
		$direct = "upload/drivers";
        if (file_exists($direct)){
        }else{mkdir("upload/drivers");}
        $picture3= '';
		if(!empty($_FILES['driver_profile_image']['name'])){
			$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['driver_profile_image']['name']; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('driver_profile_image')){
				$uploadData = $this->upload->data();
				$picture3 = $uploadData['file_name'];
				$data = array('upload_data' => $this->upload->data());
				$img=$data['upload_data']['file_name'];
				$config['image_library'] = 'gd2';
				$config['source_image'] = $direct.'/'.$img;
				$config['new_image'] = 'upload/';
				$config['maintain_ratio'] = TRUE;
				$config['width']    = 300;
				$config['height']   = 300;
				$this->load->library('image_lib', $config); 
				if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
				}
			}
		}
   

        $data = array(          
            'driver_name'                 => $this->input->post('driver_name'),
            'driver_name_a'                => $this->input->post('driver_name_a'),
            'driver_phone'                => $this->input->post('driver_phone'),
            'driver_email'                => $this->input->post('driver_email'), 
            'driver_dob'                     => $this->input->post('driver_dob'),        
            'driver_vehicle_number'       => $this->input->post('driver_vehicle_number'),
            'driver_address_a'            => $this->input->post('driver_address_a'),
            'driver_address'              => $this->input->post('driver_address'),
            'driver_countrycode'         => $this->input->post('driver_countrycode'),
            'driver_joining_date'         => $this->input->post('driver_joining_date'),
            'driver_experience'           => $this->input->post('driver_experience'),       
            "driver_updated_on"           => date("Y-m-d h:i:s"),
            "driver_updated_by"           => $this->session->userdata("login_id")
        );
        if(!empty($_FILES['driver_profile_image']['name'])){
            $data['driver_profile_image'] = $picture3;
        }
        $vsp = $this->db->where('driver_id',$uri)->update("drivers",$data);
        if($vsp > 0){			
            $total = count($_FILES['driver_files']['name']);
            // Loop through each file
            for( $i=0 ; $i < $total ; $i++ ) {
                //Get the temp file path
                $tmpFilePath = $_FILES['driver_files']['tmp_name'][$i];
                //Make sure we have a file path
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = $direct."/".$_FILES['driver_files']['name'][$i];
                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $data = array(
                            'driver_images_path'                 => $newFilePath,
                            'driver_images_status'				=> 'Active',
                            'driver_images_open'				=> 1,
                            "driver_images_created_on"          => date("Y-m-d h:i:s"),
                            "driver_images_created_by"          => $this->session->userdata("login_id")
                        );
                      //  print_r($data);exit;
                        $this->db->insert("drivers_images",$data);
                        $vsp   =    $this->db->insert_id();
                        if($vsp > 0){
                            $dat=array(
                                "driver_images_id" 				=> $vsp."DRIVERI",
                                "driver_id" 				    => $uri
                            );		
                            $this->db->update("drivers_images",$dat,"driver_imagesid ='".$vsp."'");
                        }
                    }
                }
            }
			return $vsp."DRIVER";
	    }
        return true;
    }
	
}
?>