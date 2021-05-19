<?php
class Api_model extends CI_Model{
	public function checkAuthorizationvalid(){
        $default_status =   "0";
        $auth           =   sitedata('site_authorization');
        $getallheaders  =   getallheaders();
        $authorization_key = '';
        if(isset($getallheaders) && is_array($getallheaders) && count($getallheaders) >0){
            if(isset($getallheaders['Authorization']) && $getallheaders['Authorization'] !='') { $authorization_key = $getallheaders['Authorization']; }
            if(isset($authorization_key) && $authorization_key !=''){
                $authorization_key = str_replace("key=","",$authorization_key);
                $authorization_key = str_replace('"',"",$authorization_key);
                $authorization_key = str_replace("'","",$authorization_key);
                $authorization_key = trim($authorization_key);
                if($authorization_key == trim($auth) ) { $default_status = 1; }
            }
        }
        return $default_status;
    }
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

    public function zone_check(){
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
                $point =array($this->input->post("lat").' '.$this->input->post("long"));
                $longitude_x = $this->input->post("long");
                $latitude_y = $this->input->post("lat");    
                $d = $this->pointInPolygon($point,$s);
                if($d == "inside"){
                    return $z->zone_id;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
    
    function pointInPolygon($point, $polygon, $pointOnVertex = true){
        $this->pointOnVertex = $pointOnVertex;

        // Transform string coordinates into arrays with x and y values
        $point = $this->pointStringToCoordinates($point);
        $vertices = array(); 
        foreach ($polygon as $vertex) {
            $coordinates = explode(" ", $vertex);
            $r =  array("x" => $coordinates[0], "y" => $coordinates[1]);
            $vertices[] = $r;//$this->pointStringToCoordinates($vertex); 
        }

        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "inside";
        }

        // Check if the point is inside the polygon or on the boundary
        $intersections = 0; 
        $vertices_count = count($vertices);

        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return "inside";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return "inside";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++; 
                }
            } 
        } 
        // If the number of edges we passed through is odd, then it's in the polygon. 
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }
    }

    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
    }

    function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString[0]);
        //print_r($coordinates[1]);exit;
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }
    
    
    public function countries(){
        $imgpth =   base_url().'assets/images/country/';
        $thisvs     =   $this->input->post("country_name");
        $f = "country_abc LIKE 'Active'";
        if($thisvs != ""){
              $f .= "AND country_name like '%".$thisvs."%'"; 
        }
        $params['whereCondition']      = $f;
        $params['columns']      =   "country_id,country_name,country_flag,country_isd,country_currencie"; 
        $params['tipoOrderby']  =   "country_name"; 
        $params['order_by']     =   "ASC";
        $country =  $this->country_model->viewCountry($params);
        $data = array();
        if(is_array($country) && count($country) > 0){
            foreach($country as $key=>$coun){
                $imsg   =  $imgpth.'Dummy_flag.png';//$coun->country_flag;
                $target_dir =  $imgpth.$coun->country_flag;
                if(@getimagesize($target_dir)){
                    $imsg   =   $target_dir;
                }
                $data[$key]['country_id']        = $coun->country_id;
                $data[$key]['country_name']      = $coun->country_name;
                $data[$key]['country_flag']      = $imsg;
                $data[$key]['country_isd']       = '+'.$coun->country_isd;
                $data[$key]['country_currencie'] = $coun->country_currencie;
            }
        }
        return $data;
    }
    public function loginemailsapi(){
            $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR  lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."' AND customer_password = '".$this->input->post("password")."'";
            $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
            if(is_array($vsp) && count($vsp) > 0){
                return $vsp;
            }
            return false;
    }
    public function verifyotp($otpno,$mobile,$verify = 0){
        $this->db->select('*')
                ->from('otp_log')
                ->where('otp_key',$otpno)
                ->where('otp_mobile_no',$mobile)
                //->where("TIMEDIFF(TIME(otp_sent_time), CURTIME()) <= '120'")
                ->where('otp_status','1');
        $response 	= 	$this->db->get();  
        $result 	= 	$response->row_array();
        if(isset($result) && count($result) > 0){
            $this->db->where('otp_id', $result['otp_id']);
            $this->db->update('otp_log',array('otp_status'=>'0')); 
            if($this->db->affected_rows() > 0){
                $check      =   $this->customer_model->checkmobilestatus($mobile);
                return TRUE; 
            }
        }
        return FALSE;
    }
    public function getprofile(){
        $params["whereCondition"] =   "lower(customer_token) LIKE '".strtolower($this->input->post("customer_token"))."'";
        $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
        if(is_array($vsp) && count($vsp) > 0){
            $data = array();
            foreach($vsp as $v){
                $data['customer_id']        = $vsp['customer_id']; 
                $data['customer_name']      = $vsp['customer_name'];
                $data['customer_email_id']  = $vsp['customer_email_id'];
                $data['customer_mobile']    = $vsp['customer_mobile'];
                $data['customer_token']     = $vsp['customer_token'];
            }
            return $data;
        }
        return false;
    }
    
    /*----------------Dash board--------------------*/
    public function checkcustomer(){
        $prms["whereCondition"]   =   "customer_id LIKE '".$this->input->post("customer_id")."' OR customer_token LIKE '".$this->input->post("customer_id")."' AND customer_abc LIKE 'Active'";
        $dta    =   $this->customer_model->getCustomer($prms);
        if(is_array($dta) && count($dta) >0){
            return $dta;
        }else{
            return false;
        }
    }
    public function featuredoffers(){
        $res = $this->banner_model->view_banner();
        $data=array();
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$r){
                $data[$key]['image'] = base_url().'upload/banner/'.$r->banner_image_path;
            }
        }
        return $data;
    }
    public function dashboard_category(){
        $res = $this->category_model->viewCategory();
        $data=array();
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$r){
                $data[$key]['category_id']          = $r->category_id;
                $data[$key]['category_name']        = $r->category_name;
                $data[$key]['category_name_a']      = $r->category_name_a;
                $data[$key]['image']                = base_url().'upload/category/'.$r->category_image;
            }
        }
        return $data;
    }
    public function order_deatails(){
        $data =  (object)[];
        if($this->input->post('customer_id')!=""){
            $par['whereCondition'] ="cs.customer_id LIKE '".$this->input->post('customer_id')."' AND orderdetails_rest_staus !='Delivered' OR orderdetails_rest_staus!='Order Cancelled'";
            $res = $this->order_model->viewOrders($par);
            $data = array();
            if(is_array($res) && count($res) > 0){
                foreach($res as $key=>$r){
                    $par['whereCondition'] ="order_details_id LIKE '".$r->orderdetails_id."'";
                    $res  = $this->order_model->viewOrderasson($par);
                    $variantsamount ='0';
                    if(is_array($res) && count($res) > 0){
                        $d = array();
                        foreach($res as $key=>$rs){
                            $variantsamount = $variantsamount+$rs->orderassons_amount;
                        }
                    }
                    $data['orderid']        = $r->orderdetails_id;
                    $data['order_staus']    = $r->orderdetails_rest_staus;
                    $data['order_amount']   = number_format((float)$variantsamount+$r->orderdetail_price, 3, '.', '');
                }
            }
        }
        return $data;
    }
    
    public function inner_banners(){
        $res = $this->resturant_banner_model->view_resturant_banner();
        $data=array();
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$r){
                $data[$key]['banner_id']    = $r->resturant_banner_id;
                $data[$key]['image']        = base_url().'upload/resturant_banner/'.$r->resturant_banner_image_path;
            }
        }
        return $data;
    }
    public function near_restorent_count($zone){
        $par['whereCondition'] ="resturant_zone LIKE '".$zone."'";
        $res = $this->resturant_model->viewResturant($par);
        $data = array();
        if(is_array($res) && count($res) > 0){
            return (string)count($res);
        }
        return '0';
    }
    public function near_restorent($zone){
        $par['whereCondition'] ="resturant_zone LIKE '".$zone."'";
        $res = $this->resturant_model->viewResturant($par);
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $distance = $this->common_config->GetDrivingDistance($this->input->post("lat"),$r->resturant_latitude,$this->input->post("long"),$r->resturant_longitude);
                //$data[$key]['dis'] = $distance;
                $dista='';$time='';
                if(is_array($distance)){
                    $dista = $distance['distance'];
                    $time  = $distance['time'];
                }
                $data[$key]['resturant_id']         = $r->resturant_id;
                $data[$key]['resturant_given_Id']   = $r->resturant_given_Id;
                $data[$key]['resturant_name']       = $r->resturant_name;
                $data[$key]['resturant_name_a']     = $r->resturant_name_a;
                $data[$key]['image']                = base_url().'upload/resturants/'.$r->resturant_image;
                $data[$key]['zone_time']            = $r->resturant_zone_time;
                $data[$key]['openclose']            = $r->resturant_openclose;
                $data[$key]['distance']             = ($dista!="")?$dista:'';
                $data[$key]['time']                 = ($time!="")?$time:'';
            }
        }
        return $data;
    }
    /*----------------End Dash board--------------------*/
    public function addtocart(){
        $restrant_id    =   $this->input->post("restrant_id");
        $item_id        =   $this->input->post('item_id');
        $customer_id    =   $this->input->post("customer_id");
        $view           =   $this->checkcustomer();
        $customer_id    =   $view["customer_id"];
        $par['whereCondition'] = "resturant_items_id LIKE '".$item_id."' AND resturant_id LIKE '".$restrant_id."' AND resturant_items_abc = 'Active'";
        $dta  = $this->menu_model->getItems($par);
        if(isset($dta) && count($dta)  > 0){
            $dtas    =   array(
                "cart_customer_id"          =>  $customer_id,
                "cart_resturant_id"         =>  $restrant_id,
                "cart_resturant_item_id"    =>  $dta[0]['resturant_items_id'],
                "cart_quantity"             =>  $this->input->post('quantity'),
                "cart_price"                =>  $dta[0]['resturant_items_price'],
                "cart_items_packing"        =>  $dta[0]['resturant_items_packing'],
                "cart_items_vat"            =>  $dta[0]['resturant_items_vat'],
                "cart_total"                =>  $this->input->post('total'),
                "cart_addons"               =>  json_encode($this->input->post('addons')),
                "cart_variants"             =>  json_encode($this->input->post('variants')),
                "cart_date"                 =>  $this->input->post('date'),
                "cart_created_on"           =>  date("Y-m-d H:i:s"),
                "cart_created_by"           =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
            );
            $ins    =  $this->order_model->addtocart($dtas);
            if($ins){
                return 1;
            }
        }
        return 0;
    } 
    
    public function view_totalcart(){
        $view           =   $this->checkcustomer();
        $customer_id    =   $view["customer_id"];
        $total ='0';
        $prms =array();
        $view           =   $this->api_model->checkcustomer(); 
        $customer_id    =   $view["customer_id"];
        $prms["whereCondition"]   =   "cart_acde = '0' AND cs.customer_id LIKE '".$customer_id."' OR cs.customer_token LIKE '".$customer_id."' AND rt.resturant_items_abc LIKE 'Active'";
        $dta  = $this->order_model->viewcartproducts($prms);
        $ds = array();
        if(is_array($dta) && count($dta) >0){
            $i=0;foreach($dta as $d){
                $addons     = explode(",",$d->cart_addons);
                $variants     = explode(",",$d->cart_variants);
                $addonsamount = "0";
                $data = array();$j=0;
                foreach($addons as $a){
                    $adds = $this->common_config->clean($a);
                    $par['whereCondition'] = "rt.resturant_id LIKE '".$d->cart_resturant_id."' AND  rt.resturant_items_id LIKE '".$d->cart_resturant_item_id."' AND ral.resturant_addon_listid LIKE '".$adds."' ";
                    $res = $this->menu_model->getAddon($par);
                    if(is_array($res) && count($res) > 0){
                        foreach($res as $res){
                            $addonsamount = $addonsamount+$res['resturant_addonitem_amount'];
                        }
                    }
                $j++;}
                $variantsamount = "0";
                $datas = array();$k=0;
                foreach($variants as $v){
                    $vans = $this->common_config->clean($v);
                    $pars['whereCondition'] = "rv.resturant_id LIKE '".$d->cart_resturant_id."' AND  rv.resturant_variants_id LIKE '".$vans."'";
                    $ress = $this->menu_model->getVariants($pars);
                    if(is_array($ress) && count($ress) > 0){
                        foreach($ress as $ress){
                            $variantsamount = $variantsamount+$ress['resturant_variants_price'];
                        }
                    }
                $k++;}
                $vat = ($d->resturant_items_price*$d->resturant_items_vat)/100;
                $total = ($total+$d->resturant_items_price+$d->resturant_items_packing+$vat+$addonsamount+$variantsamount)*$d->cart_quantity;
            }
        }
        $ds[0]['cart_quantity']     = count($dta);
        $ds[0]['cart_service']      = '0.000';
        $ds[0]['cart_descount']     = '0.000';
        $ds[0]['cart_delivery']     = '0.000';
        $ds[0]['cart_total']        = number_format((float)$total, 3, '.', '');
        $ds[0]['cart_pay_total']    = number_format((float)$total, 3, '.', '');
        return $ds;
    }
    public function deletecart(){
        $cart_id          =   $this->input->post("cart_id"); 
        $prms["whereCondition"]   =   "cart_id LIKE '".$cart_id."'";
        $dta    =   $this->order_model->getcartproduct($prms);
        if(isset($dta)){
            if(count($dta) > 0){
                $ins    =   $this->order_model->deletefromcart($cart_id,$dta['cart_customer_id']);
                if($ins){
                    return 1;
                }
            }
            return 2;
        }
        return 0;
    }
    public function checkout(){
        $view           =   $this->view_profile(); 
        $customer_id    =   $view["customer_id"];
        $msh    =   $this->order_model->checkout($customer_id);
        return $msh;
    }
    public function item_details(){
        $par['whereCondition'] = "resturant_items_id LIKE '".$this->input->post("item_id")."' AND resturant_id LIKE '".$this->input->post("restrant_id")."' AND resturant_items_abc LIKE 'Active'";
        $res  = $this->menu_model->getItems($par);
        $dat = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $d){
                $defprince='0';
                $deflet = $this->apirestraint_model->item_variants();
                if(is_array($deflet) && count($deflet) >0){
                    foreach($deflet as $de){
                        if(is_array($de) && count($de)){
                            foreach($de['variant_list'] as $dss){
                                if($dss['variants_defelat'] == '1'){
                                    $defprince = $defprince+$dss['variants_price'];
                                }
                            }
                        }
                    }
                }
                //print_r($defprince);exit;
                $prodprince = $d['resturant_items_price']+$defprince;
                $vat  = ($d['resturant_items_price']*$d['resturant_items_vat'])/100;
                $dat['items_id']           =  $d['resturant_items_id'];
                $dat['resturant_id']       =  $d['resturant_id'];
                $dat['category_id']        =  $d['resturant_category_id'];
                $dat['items_image']        =  base_url().'upload/resturants/'.$d['resturant_items_image'];
                $dat['items_name']         =  $d['resturant_items_name'];
                $dat['items_name_a']       =  $d['resturant_items_name_a'];
                $dat['items_type']         =  $d['resturant_items_type'];
                $dat['items_desc']         =  $d['resturant_items_desc'];
                $dat['items_price']        =  number_format((float)$d['resturant_items_price'], 3, '.', '');
                $dat['items_packing']      =  number_format((float)$d['resturant_items_packing'], 3, '.', '');
                $dat['items_total']        =  number_format((float)$vat+$d['resturant_items_price']+$d['resturant_items_packing'], 3, '.', '');
                $dat['items_abc']          =  $d['resturant_items_abc'];
            }
        }
        return $dat;
    }
    public function order_history(){
        $view           =   $this->checkcustomer();
        $customer_id    =   $view["customer_id"];
        //"Order Placed","Preparing","Ready for pickup","Out for delivery",
        //"Delivered",
        //"Order Cancelled"
        $data = array();
        $type = $this->input->post('type');
        $orderstatus = $this->config->item('orderstatus');
        /*if($type == $orderstatus[4]){
            $sts = "Delivered";
        }elseif($type == "Order Cancelled"){
            $sts = "Cancelled";
        }else{
            $sts = "New Order";
        }*/
        $data['New Order'] = array();
        $data['Delivered'] = array();
        $data['Cancelled'] = array();
        foreach($orderstatus as $k=>$ordst){
            if($ordst == "Delivered"){
                $st = "Delivered";
            }elseif($ordst == "Order Cancelled"){
                $st = "Cancelled";
            }else{
                $st = "New Order";
            }
            $par['whereCondition']  =  "or.customer_id LIKE '".$customer_id."' AND ord.orderdetails_rest_staus LIKE '".$ordst."'";
            //$par['tipoOrderby']     =  "or.orderid";
            //$par['order_by']        =  "DESC";
            //$par['start']           =  "0";
            //$par['limit']           =  $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");
            //$par['group_by']        =  "ord.order_id";
            $res = $this->order_model->viewOrders($par);
            if(is_array($res) && count($res) > 0){
                foreach($res as $key=>$r){
                    $data[$st][$key]['unique_id']        =  $r->order_unique_id;
                    $data[$st][$key]['resturant_name']   =  $r->resturant_name;
                    $data[$st][$key]['resturant_name_a'] =  $r->resturant_name_a;
                    $data[$st][$key]['order_type']       =  $r->order_type;
                    $data[$st][$key]['order_amount']     =  $r->order_amount;
                    $data[$st][$key]['order_placed']     =  $r->order_created_by;
                    $data[$st][$key]['quantity']         =  $r->orderdetail_quantity;
                }
            }
            
        }
        return $data;
    }
    public function order_details(){
        $view                   =   $this->checkcustomer();
        $customer_id            =   $view["customer_id"];
        $par['whereCondition']  = "or.customer_id LIKE '".$customer_id."' AND or.order_unique_id LIKE '".$this->input->post('unique_id')."'";
        $par['group_by']        = "ord.orderdetails_unique_id";
        $results = $this->order_model->viewOrderDetails($par);
        //print_r($results);exit;
        $data = array();$d = array();
	    if(is_array($results) && count($results) > 0){
	        $total = '0';
	        foreach($results as $key=>$r){
	            $this->apirestraint_model->vieworder($r->orderdetails_id);
	            $add = explode(",",json_decode($r->orderdetail_addons));
                $addons = array();$addonss= '0';
                if(is_array($add) && count($add) > 0){
                    foreach($add as $k=>$add){
                        $adds = $this->common_config->clean($add);
                        $pars['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$adds."'";
                        $res = $this->order_model->getOrderasson($pars);
                        $addons['name'][$k] = $res['orderassons'];
                        $addons['amount'][$k] = $res['orderassons_amount'];
                        $addonss = $addonss+$res['orderassons_amount'];
                    }
                }
                $addons = implode(",",$addons['name']);
	            $variants = explode(",",json_decode($r->orderdetail_variants));
                $var = array();
                $variantam = '0';
                if(is_array($variants) && count($variants) > 0){
                    foreach($variants as $variant){
                        $variantss = $this->common_config->clean($variant);
                        $pare['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$variantss."'";
                        $ress = $this->order_model->getOrderasson($pare);
                        $variantam = $variantam+$ress['orderassons_amount'];
                        $var['name'][$k] = $ress['orderassons'];
                        $var['amount'][$k] = $ress['orderassons_amount'];
                    }
                }
                $variants  = implode(",",$var['name']);
                $total = $total+($r->orderdetail_quantity * $r->orderdetail_price)+$addonss+$variantam;
	            $data[$key]['resturant_name']           = $r->resturant_name;
	            $data[$key]['resturant_name_a']         = $r->resturant_name_a;
	            $data[$key]['order_unique_id']          = $r->orderdetails_unique_id;
	            $data[$key]['items_name']               = $r->resturant_items_name;
	            $data[$key]['items_name_a']             = $r->resturant_items_name_a;
	            $data[$key]['items_type']               = $r->resturant_items_type;
	            $data[$key]['quantity']                 = $r->orderdetail_quantity;
	            $data[$key]['price']                    = $r->orderdetail_price;
	            $data[$key]['addons']                   = $addons;
	            $data[$key]['variants']                 = $variants;
	            
	        }
	        $r = array(
	            'total'     =>  $total,
	            'delivery'  =>  '0'
	        );
	        $d = array(
	            'order_status'  => $this->order_status($results[0]->order_id),
	            'address'       => $this->order_address(),
	            'address_ios'   => $this->order_address_ios(),
	            'order_list'    => $data,
	            'order_amount'  => $r,
	        );
	    }
	    return $d;
    }
    public function order_address(){
        $view           =   $this->checkcustomer();
        $customer_id    =   $view["customer_id"];
        $par['whereCondition'] = "or.customer_id LIKE '".$customer_id."' AND or.order_unique_id LIKE '".$this->input->post('unique_id')."'";
        $par['group_by'] = "or.order_unique_id";
        $results = $this->order_model->viewOrderDetails($par);
        $data = array();
        if(is_array($results) && count($results) > 0){
	        foreach($results as $key=>$r){
                $data['fullname']      = $r->customeraddress_fullname;
                $data['mobile']        = $r->customeraddress_mobile;
                $data['landline']      = $r->customeraddress_landline;
                $data['add_type']      = $r->customeraddress_add_type;
                $data['area']          = $r->customeraddress_area;
                $data['blockno']       = $r->customeraddress_blockno;
                $data['streetno']      = $r->customeraddress_streetno;
                $data['jadda']         = $r->customeraddress_jadda;
                $data['buildingno']    = $r->customeraddress_buildingno;
                $data['floorno']       = $r->customeraddress_floorno;
                $data['landmark']      = $r->customeraddress_landmark;
                $data['current_loc']   = $r->customeraddress_current_loc;
                $data['add_lat']       = $r->customeraddress_add_lat;
                $data['add_lot']       = $r->customeraddress_add_lot;
	        }
	    }
	    return $data;
    }
    public function order_address_ios(){
        $view           =   $this->checkcustomer();
        $customer_id    =   $view["customer_id"];
        $par['whereCondition'] = "or.customer_id LIKE '".$customer_id."' AND or.order_unique_id LIKE '".$this->input->post('unique_id')."'";
        $par['group_by'] = "or.order_unique_id";
        $results = $this->order_model->viewOrderDetails($par);
        $data = array();
        if(is_array($results) && count($results) > 0){
	        foreach($results as $key=>$r){
                $data['fullname']      = $r->customeraddress_fullname;
                $data['mobile']        = $r->customeraddress_mobile;
                $data['add_type']      = $r->customeraddress_add_type;
                $data['landline']      = $r->customeraddress_landline;
                $data['adress']        = 'area : '.$r->customeraddress_area.', '.
                                         'blockno : '.$r->customeraddress_blockno.', '.
                                         'streetno : '.$r->customeraddress_streetno.', '.
                                         'jadda : '.$r->customeraddress_jadda.', '.
                                         'buildingno : '.$r->customeraddress_buildingno.', '.
                                         'floorno : '.$r->customeraddress_floorno;
                /*$data['blockno']       = $r->customeraddress_blockno;
                $data['streetno']      = $r->customeraddress_streetno;
                $data['jadda']         = $r->customeraddress_jadda;
                $data['buildingno']    = $r->customeraddress_buildingno;
                $data['floorno']       = $r->customeraddress_floorno;*/
                $data['landmark']      = $r->customeraddress_landmark;
                $data['current_loc']   = $r->customeraddress_current_loc;
                $data['add_lat']       = $r->customeraddress_add_lat;
                $data['add_lot']       = $r->customeraddress_add_lot;
	        }
	    }
	    return $data;
    }
    public function order_status($orderid){
        $par['whereCondition'] ="order_id LIKE '".$orderid."'";
        $par['group_by'] ="orderdetail_status";
        $res = $this->order_model->viewOrderStatus($par);
        $da = array();
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$r){
                $da[$key]['status'] = $r->orderdetail_status;
                $da[$key]['time']   = date("H:i:s a", strtotime($r->orderstatus_add_date));
                $da[$key]['date']   = date("D-m-Y", strtotime($r->orderstatus_add_date));
            }
        }
        return $da;
    }
 
}