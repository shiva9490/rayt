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
	public function create($ids){
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
           'driver_given_id'            => $this->input->post('given_id'),  
            'driver_company'            => $this->input->post('company') , 
            'driver_zone'               => $this->input->post('zone'),
            'driver_sub_zone'           => $this->input->post('sub_zone'),
            'driver_vehicle_type'       => $this->input->post('vehicle_type') , 
            'driver_category'           => $this->input->post('category') , 
            'driver_nationality'        => $this->input->post('nationality'),      
            'driver_gender'             => $this->input->post('gender'),
            'driver_name'               => $this->input->post('driver_name'),
            'driver_name_last'          => $this->input->post('driver_name_last'),
            'driver_name_a_last'        => $this->input->post('driver_name_a'),
            'driver_name_a'             => $this->input->post('driver_name_a_last'),
            'driver_phone'              => $this->input->post('driver_phone'),
            'driver_email'              => $this->input->post('driver_email'), 
            'driver_dob'                => $this->input->post('driver_dob'),        
            'driver_vehicle_number'     => $this->input->post('driver_vehicle_number'),
            'driver_address_a'          => $this->input->post('driver_address_a'),
            'driver_address'            => $this->input->post('driver_address'),
            'driver_civil_id'           => $this->input->post('civil_id'),
            'driver_civil_expiry'       => $this->input->post('civil_expiry'),
            'driver_licence_no'         => $this->input->post('licence_no'),
            'driver_licence_expiry'     => $this->input->post('licence_expiry'),
            'driver_defther_expiry'     => $this->input->post('defther_expiry'),
            'driver_countrycode'        => $this->input->post('driver_countrycode'),
            'driver_joining_date'       => $this->input->post('driver_joining_date'),
            'driver_experience'         => $this->input->post('driver_experience'),  
            'driver_status'				=> 'Active',
            'driver_open'				=> 1,
            "driver_created_on"         => date("Y-m-d h:i:s"),
            "driver_created_by"         => $this->session->userdata("login_id")
        );
        if($this->input->post('alloc_res')!=""){
            $data['driver_resturant_alloc']      = implode(',',$this->input->post('alloc_res')); 
        }
        $mail_array = array('driver_email' => $this->input->post('driver_email'));
        if($mail_array){
            $this->db->insert("drivers",$data);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $id=$vsp;
                foreach ($this->input->post('driver_weekly') as $key=>$week){
                    $starttime = $this->input->post('strt_time');
                    $endtime = $this->input->post('end_time');                  
                    $weekly = $this->input->post('driver_weekly');   
                    $close = $this->input->post('working_hours');
                    $close ="0";
                    if(isset($close[$key]) && $close[$key]==$key){
                        $close = "1";
                    }               
                    $drivertimedata = array(                     
                        'driver_weekly'          => $weekly[$key],
                        'driver_start_time'  	=> $starttime[$key],
                        'driver_end_time'	    => $endtime[$key],   
                        'driver_close_time'		=>  $close,                  
                        'drivertime_acde'     	=> 'Active',	
                        'drivertime_open'		=> 1,		
                        'drivertime_add_by'  	=> ($this->session->userdata("login_id") !="")?$this->session->userdata("login_id"):'',
                        'drivertime_add_on' 	    => date('Y-m-d H:i:s'),
                    );                   
                $this->db->insert('driver_time',$drivertimedata);            
                $drivertime = $this->db->insert_id();
                    if($drivertime > 0){
                        $dat= array(
                                "drivertime_id" => $drivertime."DRITIME",
                                "driver_id"        => $id."DRIVER"
                            );	                     
                       $this->db->where('drivertimeid',$drivertime)->update("driver_time",$dat);                      
                    }
                 }
                $dat=array(
    				"driver_id" 			=> $vsp."DRIVER",
    				"driver_profile_image"	=> $picture3
    			);
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
                $d = array(
    				'driver_id'		 		=> $id."DRIVER",
    				'driver_login_username'	=> $this->input->post('given_id'),
    				'driver_login_password'	=> $this->input->post('pass'),
    				'driver_login_type'		=> 'Admin',
    				'driver_login_add_by'	=> ($this->session->userdata("login_id") !="")?$this->session->userdata("login_id"):'',
    				'driver_login_add_date' 	=> date('Y-m-d H:i:s'),
    			);
    			$this->db->insert('driver_login',$d);
    			$login = $this->db->insert_id();
                $this->db->where('driver_login',$login)->update('driver_login',array('driver_login_id'=> 'DRIVLOG'.$login));
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
                    ->from("drivers d")
                    ->join('driver_login as dl','d.driver_id=dl.driver_id','INNER')
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
    //echo '<pre>';print_r($this->input->post());exit;
         $id=$uri;
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
            'driver_company'              => $this->input->post('company') , 
            'driver_zone'                 => $this->input->post('zone'),
            'driver_sub_zone'             => $this->input->post('sub_zone'),
            'driver_vehicle_type'         => $this->input->post('vehicle_type') , 
            'driver_category'             => $this->input->post('category') , 
            'driver_nationality'          => $this->input->post('nationality'),      
            'driver_gender'               => $this->input->post('gender'),
            'driver_name'                 => $this->input->post('driver_name'),
            'driver_name_last'            => $this->input->post('driver_name_last'),
            'driver_name_a_last'          => $this->input->post('driver_name_a'),
            'driver_name_a'               => $this->input->post('driver_name_a_last'),
            'driver_phone'                => $this->input->post('driver_phone'),
            'driver_email'                => $this->input->post('driver_email'), 
            'driver_dob'                  => $this->input->post('driver_dob'),        
            'driver_vehicle_number'       => $this->input->post('driver_vehicle_number'),
            'driver_address_a'            => $this->input->post('driver_address_a'),
            'driver_address'              => $this->input->post('driver_address'),
            'driver_civil_id'             => $this->input->post('civil_id'),
            'driver_civil_expiry'         => $this->input->post('civil_expiry'),
            'driver_licence_no'           => $this->input->post('licence_no'),
            'driver_licence_expiry'       => $this->input->post('licence_expiry'),
            'driver_defther_expiry'       => $this->input->post('defther_expiry'),
            'driver_countrycode'          => $this->input->post('driver_countrycode'),
            'driver_joining_date'         => $this->input->post('driver_joining_date'),
            'driver_experience'           => $this->input->post('driver_experience'), 
            "driver_updated_on"           => date("Y-m-d h:i:s"),
            "driver_updated_by"           => $this->session->userdata("login_id")
        );
         if($this->input->post('alloc_res')!=""){
            $data['driver_resturant_alloc']      = implode(',',$this->input->post('alloc_res')); 
        }
        if(!empty($_FILES['driver_profile_image']['name'])){
            $data['driver_profile_image'] = $picture3;
        }
        $vsp = $this->db->where('driver_id',$uri)->update("drivers",$data);
        if($vsp > 0){
              $i=0;
            foreach ($this->input->post('driver_weekly') as $key=>$week){
                $starttime = $this->input->post('strt_time');
                $endtime = $this->input->post('end_time');                  
                $weekly = $this->input->post('driver_weekly');   
                $drivertime_id = $this->input->post('drivertime_id');  
                $close = $this->input->post('working_hours');
                $close ="0";
                if(isset($close[$key]) && $close[$key]==$key){
                    $close = "1";
                }
                  
                $drivertimedata = array(                     
                    'driver_weekly'          => $weekly[$key],
                    'driver_start_time'  	=> $starttime[$key],
                    'driver_end_time'	    => $endtime[$key],    
                    'driver_close_time'		=>  ($close[$i]) ?? 1 ,              
                    'drivertime_acde'     	=> 'Active',	
                    'drivertime_open'		=> 1,		
                    'drivertime_update_by'  	=> ($this->session->userdata("login_id") !="")?$this->session->userdata("login_id"):'',
                    'drivertime_update_on' 	    => date('Y-m-d H:i:s'),
                );   
         //echo "<pre>";print_r($drivertimedata);exit;  
             if($drivertime_id){
                $this->db->where('drivertime_id',$drivertime_id[$i])->update("driver_time",$drivertimedata);
            }else{
                 $this->db->insert('driver_time',$drivertimedata);            
                $drivertime = $this->db->insert_id();
                    if($drivertime > 0){
                        $dat= array(
                                "drivertime_id" => $drivertime."DRITIME",
                                "driver_id"        => $id
                            );	                     
                       $this->db->where('drivertimeid',$drivertime)->update("driver_time",$dat);                      
                    }
                
            }
                $vspss   =    $this->db->affected_rows();  
                $i++;
            }
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
    
    public function queryDriImages($params = array()){
        $dt =   array(
            "driver_images_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("drivers_images")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(driver_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(driver_id = '".$params["id"]."')");
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
    public function cntviewDriImages($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryDriImages($params)->row_array();
     
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getDriImages($params = array()){
        return $this->queryDriImages($params)->row_array();
    }
    public function viewDriImages($params = array()){
       // print_r($params);exit;
        return $this->queryDriImages($params)->result();
    }

    public function update_Dri_Images($uro){
       // echo $uro;exit;
        $direct = "upload/drivers";
        if (file_exists($direct)){
        }
        else{mkdir("upload/drivers")
            ;}	
       
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
                        'driver_images_path'                 => $newFilePath,
                        'driver_images_status'				=> 'Active',
                        'driver_images_open'					=> 1,
                        "driver_images_update_on"           => date("Y-m-d h:i:s"),
                        "driver_images_update_by"           => $this->session->userdata("login_id")
                    );
                    //echo "<pre>";print_r($data);exit;
                    $this->db->where('driver_images_id',$uro)->update("drivers_images",$data);
                    // $this->db->insert("resturant_images",$data);
                    $vsp   =    $this->db->affected_rows();
                }
            }
        }
        return true;       
    }

    public function add_Dri_Images($uri){
       $id = $uri;
        // echo $id;exit;
		$direct = "upload/drivers";
        if (file_exists($direct)){
        }else{mkdir("upload/drivers");} 

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
                            'driver_images_path'                 => $newFilePath,
                            'driver_images_status'				=> 'Active',
                            'driver_images_open'					=> 1,
                            "driver_images_created_on"           => date("Y-m-d h:i:s"),
                            "driver_images_created_by"           => $this->session->userdata("login_id")
                        );
                      
                        $this->db->insert("drivers_images",$data);
                        $vsp   =    $this->db->insert_id();
                        if($vsp > 0){
                            $dat=array(
                                "driver_images_id" 				=> $vsp."DRIVERI",
                                "driver_id" 				        => $id
                            );	
                            //print_r($dat);exit;	
                            $this->db->update("drivers_images",$dat,"driver_imagesid ='".$vsp."'");
                        }
                    }
                }
            }
			
			return $vsp."RES";
            return false;
	   
    }
    public function delete_driImages($uro){
        $this->db->delete("drivers_images",array("driver_images_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
    
    /*-------------------Naresh--------------------------*/
    public function queryDriverLogin($params = array()){
        $dt =   array(
            "driver_login_open"  => '1',
            "driver_login_status"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("driver_login as dl")
                    ->join('drivers as d','dl.driver_id=d.driver_id','LEFT')
                    ->join('zones as z','z.zone_id=d.driver_zone','LEFT')
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(driver_login_username LIKE '%".$params["keywords"]."%')");
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
    //     $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    }
    public function cntviewDriverLogin($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryDriverLogin($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getDriverLogin($params = array()){
        return $this->queryDriverLogin($params)->row_array();
    }
    public function viewDriverLogin($params = array()){
        return $this->queryDriverLogin($params)->result();
    }
    /*-------------------Naresh--------------------------*/
    public function queryDrivertime($params = array()){
        $dt =   array(
            "drivertime_open"  => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("driver_time")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(driver_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(driver_id = '".$params["id"]."')");
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
    public function cntviewDriverTime($params = array()){
        $params["cnt"]      =   "1";
        $val    =   $this->queryResTime($params)->row_array();
        if(is_array($val) && count($val) > 0){
            return  $val['cnt'];
        }
        return "0";
    }
    public function getDriverTime($params = array()){
        return $this->queryResTime($params)->row_array();
    }
    public function viewDriverTime($params = array()){
         //print_r($params);exit;
         return $this->queryDriverTime($params)->result();
    }
    public function delete_DriverTime($uro){
        $this->db->delete("driver_time",array("drivertime_id" => $uro));
        $vsp   =    $this->db->affected_rows();
        if($vsp > 0){
            return true;
        }
        return FALSE;
    }
    public function getDriverupdate($params = array()){
        return $this->queryDriverupdate($params)->row_array();
    }
    public function queryDriverupdate($params = array()){
        $dt =   array(
            "driver_open"  => '1',
            "driver_login_open" => '1'
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("driver_address_update as dau")
                    ->join("drivers as d","dau.driver_address_driver_id =d.driver_id","inner")
                    ->join("driver_login as dl","dl.driver_id =d.driver_id","inner")
                    ->where($dt);
        if(array_key_exists("keywords",$params)){
                $this->db->where("(driver_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
        }
        if(array_key_exists("id",$params)){
                $this->db->where("(driver_id = '".$params["id"]."')");
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
}
?>