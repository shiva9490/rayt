<?php
class Apidriver_model extends CI_Model{
    public function login(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $dat    =   array(
            "driver_status_driver_id"   =>  $empid,
            "driver_status_on" 	        =>  date("Y-m-d H:i:s"),
            "driver_status_for" 	    =>  'Login'
        );
        $this->db->insert("driver_login_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $this->db->update("driver_login_status",array("driver_status_id" => $vsp."DRILS"),array("driver_statusid" => $vsp));
            $dat    =   array(
                "driver_address_driver_id"          =>  $empid,
                "driver_address_latitude" 	        =>  ($this->input->post("latitude")!="")?$this->input->post("latitude"):'',
                "driver_address_longitude" 	        =>  ($this->input->post("longitude")!="")?$this->input->post("longitude"):'',
                "driver_address_login_status_id"    =>  $vsp."DRILS",
                "driver_address_time" 	            =>  date("Y-m-d h:i:s")
            );
            $this->db->insert("driver_address_update",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
                if($this->db->affected_rows() > 0){
                    $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."' and driver_login_password = '".$this->input->post("password")."'";
                    $vsp    =   $this->drivers_model->getDriverLogin($par);
                    $details    =array(
                        'id'        =>  $vsp['driver_login_username'],
                        'name'      =>  $vsp['driver_name'],
                        'email'     =>  $vsp['driver_email'],
                        'mobile'    =>  $vsp['driver_phone'],
                        'zone'      =>  $vsp['zone_name'],
                        'image'     =>  base_url().'upload/drivers/'.$vsp['driver_profile_image'],
                        'status'    =>  $vsp['driver_login_abc'],
                        'deliv_type'=>  $this->apidrivertime(),
                    );
                    return $details;
                }
                return FALSE;
            }
        }
    }
    public function checkdriver(){
        $par['columns']         = 'd.driver_id,driver_name,driver_phone,driver_email,driver_login_username,driver_login_password';
        $par['whereCondition']  = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."'";
        $vsp    =   $this->drivers_model->getDriverLogin($par);
        if(is_array($vsp) && count($vsp) > 0){
            return $vsp;
        }
        return $vsp = array();
    }
    public function checkdriverlog(){
        $par['whereCondition'] = "lower(driver_login_username) LIKE '".strtolower($this->input->post("empid"))."' and driver_login_password = '".$this->input->post("password")."'";
        $vsp    =   $this->drivers_model->getDriverLogin($par);
        if(is_array($vsp) && count($vsp) > 0){
            return $vsp;
        }
        return $vsp = array();
    }
    public function saveToken(){
        $token_value        =   $this->input->post("token_value");
        $token_mobile       =   $this->input->post("userid");
        $par['whereCondition']      = "dl.driver_id LIKE '".$token_mobile."' OR driver_login_id LIKE '".$token_mobile."' OR driver_login_username LIKE '".$token_mobile."'";
        $parser['whereCondition']   = "resturant_given_Id LIKE '".$token_mobile."' OR resturant_id LIKE '".$token_mobile."'";
        $pars['whereCondition']     = "customer_token LIKE '".$token_mobile."' OR customer_id LIKE '".$token_mobile."' OR customer_mobile LIKE '".$token_mobile."'";
        $vspd               =   $this->drivers_model->getDriverLogin($par);
        $customers          =   $this->customers_model->getCustomers($pars);
        $resturant          =   $this->resturant_model->getResturant($parser);
        if(is_array($vspd) && count($vspd) > 0){
            $register_usertype  =   "Driver";
            $token_mobiles =  $vspd['driver_login_id'];
        }else if(is_array($customers) && count($customers) > 0){
            $register_usertype  =   "customers";
            $token_mobiles =  $customers['customer_id'];
        }else if(is_array($resturant) && count($resturant) > 0){
            $register_usertype  =   "Resturant";
            $token_mobiles =  $resturant['resturant_given_Id'];
        }
        $this->db->where("(token_mobile LIKE '".$token_mobiles."' OR token_name LIKE '".$token_value."') AND token_open = '1'");
        $vsp    =   $this->db->get("tokens")->row();
        $dta    =   array(
                        "token_mobile"  =>  $token_mobiles,
                        "token_type"    =>  $register_usertype,
                        'token_name'    =>  $token_value
                    );
        if(is_array($vspd) || is_array($customers) || is_array($resturant)){
            if(is_array($vsp) && count($vsp) > 0 || is_object($vsp) && count(get_object_vars($vsp)) > 0){
                $dta["token_update"] = date("Y-m-d H:i:s");
                $this->db->update("tokens",$dta,array("token_id" => $vsp->token_id));
                if($this->db->affected_rows() > 0){
                    return TRUE;
                }
            }else{
                $dta["token_date"]  =  date("Y-m-d H:i:s");
                $this->db->insert("tokens",$dta);
                if($this->db->insert_id() > 0){
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
    public function present_address_update(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $dat    =   array(
            "driver_address_driver_id"   =>  $empid,
            "driver_address_latitude" 	 =>  $this->input->post("latitude"),
            "driver_address_longitude" 	 =>  $this->input->post("longitude"),
            "driver_address_time" 	     =>  date("Y-m-d h:i:s")
        );
        $this->db->insert("driver_address_update",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
             $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
                return TRUE;
        }
        return FALSE;
    }
    public function logout($id){
        $dat    =   array(
            "driver_status_driver_id"   =>  $id,
            "driver_status_on" 	        =>  date("Y-m-d H:i:s"),
            "driver_status_for" 	    =>  'Logout'
        );
        $this->db->insert("driver_login_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $this->db->update("driver_login_status",array("driver_status_id" => $vsp."DRILS"),array("driver_statusid" => $vsp));
            if($this->db->affected_rows() > 0){
                $dat    =   array(
                    "driver_address_driver_id"          =>  $id,
                    "driver_address_latitude" 	        =>   $this->input->post("latitude"),
                    "driver_address_longitude" 	        =>  $this->input->post("longitude"),
                    "driver_address_login_status_id"    =>  $vsp."DRILS",
                    "driver_address_time" 	            =>  date("Y-m-d h:i:s")
                );
                $this->db->insert("driver_address_update",$dat);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
                }
                return TRUE;
            }
            return FALSE;
        }
    }
    public function activeInactive($id){
        if($this->input->post("status") == '0'){
            $status =   'Offline';
        }else if($this->input->post("status") == '1'){
            $status =   'Online';
        }
        $dat    =   array(
            "driver_status_driver_id"   =>  $id,
            "driver_status_on" 	        =>  date("Y-m-d H:i:s"),
            "driver_status_for" 	    =>  $status
        );
        $this->db->insert("driver_login_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $this->db->update("driver_login_status",array("driver_status_id" => $vsp."DRILS"),array("driver_statusid" => $vsp));
            $dat    =   array(
                "driver_address_driver_id"          =>  $id,
                "driver_address_latitude" 	        =>   $this->input->post("latitude"),
                "driver_address_longitude" 	        =>  $this->input->post("longitude"),
                "driver_address_login_status_id"    =>  $vsp."DRILS",
                "driver_address_time" 	            =>  date("Y-m-d h:i:s")
            );
            $this->db->insert("driver_address_update",$dat);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $this->db->update("driver_address_update",array("driver_address_id" => $vsp."DRIAU"),array("driver_addressid" => $vsp));
            }
            return TRUE;
        }
    }
    public function apidrivertime(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['whereCondition'] = "lower(driver_id) LIKE '".$empid."'";
        $vsp    =   $this->drivers_model->viewDriverTime($par);
        $dta = array();
        if(is_array($vsp) && count($vsp) > 0){
          	foreach($vsp as $key=>$d){ 
          	    $status='';
          	    if($d->driver_close_time == 1){
          	        $status = "Holyday";
          	    }
                $dta[$key]['weekly']      =  $d->driver_weekly;
                $dta[$key]['start_time']  =  $d->driver_start_time;
                $dta[$key]['end_time']    =  $d->driver_end_time;
                $dta[$key]['status_time'] =  $status;
			} 
        }
        return $dta;
    }
    public function unread_orders(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $hr = "AND (ord.orderdetails_rest_staus != 'Delivered' OR ord.orderdetails_rest_staus != 'Order Cancelled')";
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' AND drso.driver_view_order = '2' $hr";
       // print_r($par);exit;
        $orders = $this->order_model->cntviewOrderDetails($par);
        if($orders > 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function neworder(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['columns'] ="or.order_unique_id,or.order_type,or.order_amount,ord.orderdetail_customer_id,ord.orderdetails_rest_staus,drso.driver_view_order,res.resturant_id,res.resturant_name,res.resturant_image,res.resturant_logo_image,res.resturant_contact,
                        res.resturant_position,res.resturant_contact_no,res.resturant_area,res.resturant_block,res.resturant_street,res.resturant_jaada,res.resturant_house,res.resturant_building,res.resturant_landmark,res.resturant_latitude,res.resturant_longitude,
                        cadd.customeraddress_fullname,cadd.customeraddress_mobile,cadd.customeraddress_add_type,cadd.customeraddress_area,cadd.customeraddress_blockno,cadd.customeraddress_streetno,cadd.customeraddress_jadda,cadd.customeraddress_buildingno,cadd.customeraddress_floorno,cadd.customeraddress_landmark,cadd.customeraddress_current_loc,cadd.customeraddress_add_lat,cadd.customeraddress_add_lot";
        $hr = "AND (ord.orderdetails_rest_staus = 'Order Placed' OR ord.orderdetails_rest_staus = 'Preparing' OR ord.orderdetails_rest_staus = 'Ready for pickup' OR ord.orderdetails_rest_staus = 'Out for delivery' OR ord.orderdetails_rest_staus = 'arrived order')";
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' $hr";
        $par['tipoOrderby']     =  "drso.driverassignorderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.orderdetails_id";
        $orders = $this->order_model->viewOrderDetails($par);
        $data=array();
        if(is_array($orders) && count($orders) > 0){
            foreach($orders as $key=>$ord){
                $data[$key]['orderdetails']['order_unique_id']         = $ord->order_unique_id;
                $data[$key]['orderdetails']['orderdetail_customer_id'] = $ord->orderdetail_customer_id;
                $data[$key]['orderdetails']['orderdetail_status']      = $ord->orderdetails_rest_staus;
                $data[$key]['orderdetails']['order_type']              = $ord->order_type;
                $data[$key]['orderdetails']['order_amount']            = $ord->order_amount;
                $data[$key]['orderdetails']['driver_view_order']       = $ord->driver_view_order;
                $data[$key]['resturant']['resturant_id']               = $ord->resturant_id;
                $data[$key]['resturant']['resturant_name']             = $ord->resturant_name;
                $data[$key]['resturant']['resturant_image']            = base_url().'upload/resturants/'.$ord->resturant_image;
                $data[$key]['resturant']['resturant_logo_image']       = base_url().'upload/resturants/'.$ord->resturant_logo_image;
                $data[$key]['resturant']['resturant_contact']          = $ord->resturant_contact;
                $data[$key]['resturant']['resturant_position']         = $ord->resturant_position;
                $data[$key]['resturant']['resturant_contact_no']       = $ord->resturant_contact_no;
                $data[$key]['resturant']['resturant_area']             = $ord->resturant_area;
                $data[$key]['resturant']['resturant_block']            = $ord->resturant_block;
                $data[$key]['resturant']['resturant_street']           = $ord->resturant_street;
                $data[$key]['resturant']['resturant_jaada']            = $ord->resturant_jaada;
                $data[$key]['resturant']['resturant_house']            = $ord->resturant_house;
                $data[$key]['resturant']['resturant_building']         = $ord->resturant_building;
                $data[$key]['resturant']['resturant_landmark']         = $ord->resturant_landmark;
                $data[$key]['resturant']['resturant_latitude']         = $ord->resturant_latitude;
                $data[$key]['resturant']['resturant_longitude']        = $ord->resturant_longitude;
                $data[$key]['customeraddress']['fullname']             = $ord->customeraddress_fullname;
                $data[$key]['customeraddress']['mobile']               = $ord->customeraddress_mobile;
                $data[$key]['customeraddress']['add_type']             = $ord->customeraddress_add_type;
                $data[$key]['customeraddress']['area']                 = $ord->customeraddress_area;
                $data[$key]['customeraddress']['blockno']              = $ord->customeraddress_blockno;
                $data[$key]['customeraddress']['streetno']             = $ord->customeraddress_streetno;
                $data[$key]['customeraddress']['jadda']                = $ord->customeraddress_jadda;
                $data[$key]['customeraddress']['buildingno']           = $ord->customeraddress_buildingno;
                $data[$key]['customeraddress']['floorno']              = $ord->customeraddress_floorno;
                $data[$key]['customeraddress']['landmark']             = $ord->customeraddress_landmark;
                $data[$key]['customeraddress']['current_loc']          = $ord->customeraddress_current_loc;
                $data[$key]['customeraddress']['add_lat']              = $ord->customeraddress_add_lat;
                $data[$key]['customeraddress']['add_lot']              = $ord->customeraddress_add_lot;
            }
        }
        return $data;
    }
    public function restarent_details(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' and res.resturant_id LIKE '".$this->input->post('resturant_id')."'";
        $orders = $this->order_model->getOrderDetails($par);
        $data = array();
        if(is_array($orders) && count($orders) > 0){
            $this->update_order_status();
            foreach($orders as $key=>$ord){
                $data['orderdetails']['order_unique_id']         = $orders['order_unique_id'];
                $data['orderdetails']['orderdetail_customer_id'] = $orders['orderdetail_customer_id'];
                $data['orderdetails']['orderdetail_status']      = $orders['orderdetails_rest_staus'];
                $data['resturant']['resturant_id']               = $orders['resturant_id'];
                $data['resturant']['resturant_name']             = $orders['resturant_name'];
                $data['resturant']['resturant_image']            = base_url().'upload/resturants/'.$orders['resturant_image'];
                $data['resturant']['resturant_logo_image']       = base_url().'upload/resturants/'.$orders['resturant_logo_image'];
                $data['resturant']['resturant_contact']          = $orders['resturant_contact'];
                $data['resturant']['resturant_position']         = $orders['resturant_position'];
                $data['resturant']['resturant_contact_no']       = $orders['resturant_contact_no'];
                $data['resturant']['resturant_area']             = $orders['resturant_area'];
                $data['resturant']['resturant_block']            = $orders['resturant_block'];
                $data['resturant']['resturant_street']           = $orders['resturant_street'];
                $data['resturant']['resturant_jaada']            = $orders['resturant_jaada'];
                $data['resturant']['resturant_house']            = $orders['resturant_house'];
                $data['resturant']['resturant_building']         = $orders['resturant_building'];
                $data['resturant']['resturant_landmark']         = $orders['resturant_landmark'];
                $data['resturant']['resturant_longitude']        = $orders['resturant_longitude'];
                $data['resturant']['resturant_longitude']        = $orders['resturant_longitude'];
                $data['customeraddress']['customerid']           = $orders['customeraddress_customer'];
                $data['customeraddress']['fullname']             = $orders['customeraddress_fullname'];
                $data['customeraddress']['mobile']               = $orders['customeraddress_mobile'];
                $data['customeraddress']['add_type']             = $orders['customeraddress_add_type'];
                $data['customeraddress']['area']                 = $orders['customeraddress_area'];
                $data['customeraddress']['blockno']              = $orders['customeraddress_blockno'];
                $data['customeraddress']['streetno']             = $orders['customeraddress_streetno'];
                $data['customeraddress']['jadda']                = $orders['customeraddress_jadda'];
                $data['customeraddress']['buildingno']           = $orders['customeraddress_buildingno'];
                $data['customeraddress']['floorno']              = $orders['customeraddress_floorno'];
                $data['customeraddress']['landmark']             = $orders['customeraddress_landmark'];
                $data['customeraddress']['current_loc']          = $orders['customeraddress_current_loc'];
                $data['customeraddress']['add_lat']              = $orders['customeraddress_add_lat'];
                $data['customeraddress']['add_lot']              = $orders['customeraddress_add_lot'];
                $data['supportr']['number']                      = sitedata('site_support_number');
                $data['supportr']['email']                       = sitedata('site_email');
            }
        }
        return $data;
    }
    public function pickuporder(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['columns'] ="or.order_unique_id,or.order_type,or.order_amount,ord.orderdetail_customer_id,ord.orderdetails_rest_staus,drso.driver_view_order,res.resturant_id,res.resturant_name,res.resturant_image,res.resturant_logo_image,res.resturant_contact,
                        res.resturant_position,res.resturant_contact_no,res.resturant_area,res.resturant_block,res.resturant_street,res.resturant_jaada,res.resturant_house,res.resturant_building,res.resturant_landmark,res.resturant_latitude,res.resturant_longitude,
                        cadd.customeraddress_fullname,cadd.customeraddress_mobile,cadd.customeraddress_add_type,cadd.customeraddress_area,cadd.customeraddress_blockno,cadd.customeraddress_streetno,cadd.customeraddress_jadda,cadd.customeraddress_buildingno,cadd.customeraddress_floorno,cadd.customeraddress_landmark,cadd.customeraddress_current_loc,cadd.customeraddress_add_lat,cadd.customeraddress_add_lot";
        $hr = "AND (ord.orderdetails_rest_staus = 'Order Placed' OR ord.orderdetails_rest_staus = 'Preparing' OR ord.orderdetails_rest_staus = 'Ready for pickup' OR ord.orderdetails_rest_staus = 'Out for delivery' OR ord.orderdetails_rest_staus = 'arrived order')";
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' and res.resturant_id LIKE '".$this->input->post('resturant_id')."' $hr";
        $par['tipoOrderby']     =  "drso.driverassignorderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.orderdetails_id";
        $orders = $this->order_model->viewOrderDetails($par);
        $data = array();
        if(is_array($orders) && count($orders) > 0){
            $this->update_order_status();
            foreach($orders as $key=>$ord){
                $order = $this->apirestraint_model->order_details($ord->order_unique_id,$ord->orderdetails_rest_staus,$ord->resturant_id);
                $data[$key]['orderdetails']['order_unique_id']         = $ord->order_unique_id;
                $data[$key]['orderdetails']['orderdetail_customer_id'] = $ord->orderdetail_customer_id;
                $data[$key]['orderdetails']['orderdetail_status']      = $ord->orderdetails_rest_staus;
                $data[$key]['orderdetails']['order_type']              = $ord->order_type;
                $data[$key]['orderdetails']['order_amount']            = $ord->order_amount;
                $data[$key]['resturant']['resturant_name']             = $ord->resturant_name;
                $data[$key]['resturant']['resturant_image']            = base_url().'upload/resturants/'.$ord->resturant_image;
                $data[$key]['resturant']['resturant_logo_image']       = base_url().'upload/resturants/'.$ord->resturant_logo_image;
                $data[$key]['resturant']['resturant_contact']          = $ord->resturant_contact;
                $data[$key]['resturant']['resturant_position']         = $ord->resturant_position;
                $data[$key]['resturant']['resturant_contact_no']       = $ord->resturant_contact_no;
                $data[$key]['resturant']['resturant_area']             = $ord->resturant_area;
                $data[$key]['resturant']['resturant_block']            = $ord->resturant_block;
                $data[$key]['resturant']['resturant_street']           = $ord->resturant_street;
                $data[$key]['resturant']['resturant_jaada']            = $ord->resturant_jaada;
                $data[$key]['resturant']['resturant_house']            = $ord->resturant_house;
                $data[$key]['resturant']['resturant_building']         = $ord->resturant_building;
                $data[$key]['resturant']['resturant_landmark']         = $ord->resturant_landmark;
                $data[$key]['resturant']['resturant_latitude']         = $ord->resturant_latitude;
                $data[$key]['resturant']['resturant_longitude']        = $ord->resturant_longitude;
                //$data[$key]['customeraddress']['customerid']           = $ord->customeraddress_customer;
                $data[$key]['customeraddress']['fullname']             = $ord->customeraddress_fullname;
                $data[$key]['customeraddress']['mobile']               = $ord->customeraddress_mobile;
                $data[$key]['customeraddress']['add_type']             = $ord->customeraddress_add_type;
                $data[$key]['customeraddress']['area']                 = $ord->customeraddress_area;
                $data[$key]['customeraddress']['blockno']              = $ord->customeraddress_blockno;
                $data[$key]['customeraddress']['streetno']             = $ord->customeraddress_streetno;
                $data[$key]['customeraddress']['jadda']                = $ord->customeraddress_jadda;
                $data[$key]['customeraddress']['buildingno']           = $ord->customeraddress_buildingno;
                $data[$key]['customeraddress']['floorno']              = $ord->customeraddress_floorno;
                $data[$key]['customeraddress']['landmark']             = $ord->customeraddress_landmark;
                $data[$key]['customeraddress']['current_loc']          = $ord->customeraddress_current_loc;
                $data[$key]['customeraddress']['add_lat']              = $ord->customeraddress_add_lat;
                $data[$key]['customeraddress']['add_lot']              = $ord->customeraddress_add_lot;
                $data[$key]['orderslist']                              = $order;
            }
        }
        return $data;
    }
    public function takeitorder(){
        $emps  = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['columns'] ="ord.orderdetails_id,ord.order_id AS orderids,or.order_type,or.order_amount,or.order_unique_id,ord.orderdetail_customer_id,ord.orderdetails_rest_staus,drso.driver_view_order,res.resturant_id,res.resturant_name,res.resturant_image,res.resturant_logo_image,res.resturant_contact,
                        res.resturant_position,res.resturant_contact_no,res.resturant_area,res.resturant_block,res.resturant_street,res.resturant_jaada,res.resturant_house,res.resturant_building,res.resturant_landmark,res.resturant_latitude,res.resturant_longitude,
                        cadd.customeraddress_fullname,cadd.customeraddress_mobile,cadd.customeraddress_add_type,cadd.customeraddress_area,cadd.customeraddress_blockno,cadd.customeraddress_streetno,cadd.customeraddress_jadda,cadd.customeraddress_buildingno,cadd.customeraddress_floorno,cadd.customeraddress_landmark,cadd.customeraddress_current_loc,cadd.customeraddress_add_lat,cadd.customeraddress_add_lot";
        //$hr = "AND (ord.orderdetails_rest_staus != 'Completed Pickup' OR ord.orderdetails_rest_staus != 'Delivered' OR ord.orderdetails_rest_staus != 'Order Cancelled')";
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' and res.resturant_id LIKE '".$this->input->post('resturant_id')."' AND or.order_unique_id LIKE '".$this->input->post('order_unique_id')."' AND ord.orderdetails_rest_staus = 'Ready for pickup' OR ord.orderdetails_rest_staus LIKE 'Out for delivery' OR ord.orderdetails_rest_staus LIKE 'arrived order'";
        $par['tipoOrderby']     =  "drso.driverassignorderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.orderdetails_id";
        $orders = $this->order_model->viewOrderDetails($par);
        $data = array();
        if(is_array($orders) && count($orders) > 0){
            $changesta = $this->order_model->order_accect($orders);
            if($changesta == true){
                //return true;
                $orderstatus = $this->config->item('orderstatus');
                foreach($orders as $key=>$ord){
                    $ds = array();$k= 0;
                    foreach($orderstatus as $keys=>$oct){
                        if($oct == $ord->orderdetails_rest_staus){
                            $k  = $keys+1;
                            $ds = $orderstatus[$k];
                        }
                        $k++;
                    }
                    $data[$key]['orderdetails']['order_unique_id']         = $ord->order_unique_id;
                    $data[$key]['orderdetails']['orderdetail_customer_id'] = $ord->orderdetail_customer_id;
                    $data[$key]['orderdetails']['order_type']              = $ord->order_type;
                    $data[$key]['orderdetails']['order_amount']            = $ord->order_amount;
                    $data[$key]['orderdetails']['orderdetail_status']      = $ds;
                    $data[$key]['resturant']['resturant_name']             = $ord->resturant_name;
                    $data[$key]['resturant']['resturant_image']            = base_url().'upload/resturants/'.$ord->resturant_image;
                    $data[$key]['resturant']['resturant_logo_image']       = base_url().'upload/resturants/'.$ord->resturant_logo_image;
                    $data[$key]['resturant']['resturant_contact']          = $ord->resturant_contact;
                    $data[$key]['resturant']['resturant_position']         = $ord->resturant_position;
                    $data[$key]['resturant']['resturant_contact_no']       = $ord->resturant_contact_no;
                    $data[$key]['resturant']['resturant_area']             = $ord->resturant_area;
                    $data[$key]['resturant']['resturant_block']            = $ord->resturant_block;
                    $data[$key]['resturant']['resturant_street']           = $ord->resturant_street;
                    $data[$key]['resturant']['resturant_jaada']            = $ord->resturant_jaada;
                    $data[$key]['resturant']['resturant_house']            = $ord->resturant_house;
                    $data[$key]['resturant']['resturant_building']         = $ord->resturant_building;
                    $data[$key]['resturant']['resturant_landmark']         = $ord->resturant_landmark;
                    $data[$key]['resturant']['resturant_latitude']         = $ord->resturant_latitude;
                    $data[$key]['resturant']['resturant_longitude']        = $ord->resturant_longitude;
                    $data[$key]['customeraddress']['fullname']             = $ord->customeraddress_fullname;
                    $data[$key]['customeraddress']['mobile']               = $ord->customeraddress_mobile;
                    $data[$key]['customeraddress']['add_type']             = $ord->customeraddress_add_type;
                    $data[$key]['customeraddress']['area']                 = $ord->customeraddress_area;
                    $data[$key]['customeraddress']['blockno']              = $ord->customeraddress_blockno;
                    $data[$key]['customeraddress']['streetno']             = $ord->customeraddress_streetno;
                    $data[$key]['customeraddress']['jadda']                = $ord->customeraddress_jadda;
                    $data[$key]['customeraddress']['buildingno']           = $ord->customeraddress_buildingno;
                    $data[$key]['customeraddress']['floorno']              = $ord->customeraddress_floorno;
                    $data[$key]['customeraddress']['landmark']             = $ord->customeraddress_landmark;
                    $data[$key]['customeraddress']['current_loc']          = $ord->customeraddress_current_loc;
                    $data[$key]['customeraddress']['add_lat']              = $ord->customeraddress_add_lat;
                    $data[$key]['customeraddress']['add_lot']              = $ord->customeraddress_add_lot;
                }
            }
        }
        return $data;
    }
    public function deliveryorder(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['columns'] ="ord.orderdetails_id,ord.order_id AS orderids,or.order_unique_id,ord.orderdetail_customer_id,ord.orderdetails_rest_staus,drso.driver_view_order,res.resturant_id,res.resturant_name,res.resturant_image,res.resturant_logo_image,res.resturant_contact,
                        res.resturant_position,res.resturant_contact_no,res.resturant_area,res.resturant_block,res.resturant_street,res.resturant_jaada,res.resturant_house,res.resturant_building,res.resturant_landmark,res.resturant_latitude,res.resturant_longitude";
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' AND res.resturant_id LIKE '".$this->input->post('resturant_id')."' AND cs.customer_id LIKE '".$this->input->post('customerid')."' AND or.order_unique_id LIKE '".$this->input->post('order_unique_id')."' AND ord.orderdetails_rest_staus = 'arrived order'";
        $par['tipoOrderby']     =  "drso.driverassignorderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.orderdetails_id";
        $orders = $this->order_model->viewOrderDetails($par);
        if(is_array($orders) && count($orders) > 0){
            $changesta = $this->order_model->order_accect($orders);
            if($changesta == true){
                return true;
            }
        }
        return false;
    }
    
    public function zone_checks(){
        $par['group_by'] = "zones.zone_id";
        $zone_list = $this->zone_model->viewZones();
        if(is_array($zone_list) && count($zone_list)){
            //print_r($zone_list);exit;
            foreach($zone_list as $key=>$z){
                $p['whereCondition'] = "zone_id LIKE '".$z->zone_id."'";
                $ponts = $this->zone_model->viewZoneList($p);
                //print_r($ponts);exit;
                $s = array();
                foreach($ponts as $k=>$p){
                    $s[$k] = $p->zonelist_lat.' '.$p->zonelist_lng;
                }
                $point =array($this->input->post("latitude").' '.$this->input->post("longitude"));
                $longitude_x = $this->input->post("longitude");
                $latitude_y = $this->input->post("latitude");    
                $d = $this->api_model->pointInPolygon($point,$s);
                if($d == "inside"){
                    return $z->zone_id;
                }else{
                    return 'Outside Of Zone';
                }
            }
        }else{
            return 'Outside Of Zone';
        }
    }
    public function update_order_status(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        return $this->db->where('driver_id',$empid)->update('driver_assign_order',array('driver_view_order'=>1));
    }
    public function today_order_amount(){
        $emps = $this->checkdriver();
        $empid = $emps['driver_id'];
        $par['columns'] ="or.order_amount,ord.order_id,ost.orderstatus_add_date";
        $par['whereCondition']  =  "drso.driver_id LIKE '".$empid."' AND ord.orderdetails_rest_staus = 'Delivered' AND ost.orderstatus_add_date LIKE '%".date('Y-m-d')."%'";
        $par['group_by']        =  "ord.order_id";
        $orders = $this->order_model->viewOrderDetails($par);
        $data= 0;$das=array();
        if(is_array($orders) && count($orders) >0){
            foreach($orders as $key=>$ord){
                $data = $data+$ord->order_amount;
            }
            $das['amount'] =  number_format((float)$data, 3, '.', '');
        }
        return $das;
    }
    
}