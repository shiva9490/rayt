<?php
class Api_model extends CI_Model{
	public function checkAuthorizationvalid(){
	    $default_status =   "0";
        $auth           =   sitedata('site_authorization');
        $getallheaders  =   getallheaders();
        $authorization_key = '';
        if(isset($getallheaders) && is_array($getallheaders) && count($getallheaders) > 0){
            if(isset($getallheaders['Authorization']) && $getallheaders['Authorization'] !='') { $authorization_key = $getallheaders['Authorization']; }
            if(isset($authorization_key) && $authorization_key !=''){
                $authorization_key = str_replace("key=","",$authorization_key);
                $authorization_key = str_replace('"',"",$authorization_key);
                $authorization_key = str_replace("'","",$authorization_key);
                $authorization_key = trim($authorization_key);
                if($authorization_key == trim($auth)){
                    $default_status = 1;
                }
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
            foreach($zone_list as $key=>$z){
                $pss['whereCondition'] = "zone_id LIKE '".$z->zone_id."'";
                $ponts = $this->zone_model->viewZoneList($pss);
                //print_r($ponts);exit;
                $s = array();
                foreach($ponts as $k=>$p){
                    $s[$k] = $p->zonelist_lat.' '.$p->zonelist_lng;
                }
                $point       = array($this->input->post("lat").' '.$this->input->post("long"));
                $longitude_x = $this->input->post("long");
                $latitude_y  = $this->input->post("lat");
                $d           = $this->pointInPolygon($point,$s);
                if($d == "inside"){
                    return $z->zone_id;
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
    public function getprofile($id=null){
        if($this->input->post("customer_token")!=""){
            $idas = $this->input->post("customer_token");
        }else{
            $idas = $id;
        }
        $params["whereCondition"] =   "lower(customer_token) LIKE '".strtolower($idas)."' OR customer_mobile LIKE '".strtolower($idas)."' OR customer_email_id LIKE '".strtolower($idas)."'";
        $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
        if(is_array($vsp) && count($vsp) > 0){
            $data = array();
            foreach($vsp as $v){
                $data['customer_id']        = $vsp['customer_id']; 
                $data['customer_name']      = $vsp['customer_name'];
                $data['customer_email_id']  = $vsp['customer_email_id'];
                $data['customer_mobile']    = $vsp['customer_mobile'];
                $data['customer_wallet']    = number_format((float)$vsp['customer_wallet'], 3, '.', '');
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
            $par['whereCondition'] ="cs.customer_id LIKE '".$this->input->post('customer_id')."' OR cs.customer_token LIKE '".$this->input->post('customer_id')."' AND (orderdetails_rest_staus !='Delivered' OR orderdetails_rest_staus!='Order Cancelled')";
            $res = $this->order_model->viewOrders($par);
            if(is_array($res) && count($res) > 0){
                $data = array();
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
                    $data['orderid']        = $r->order_unique_id;
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
        $par['start'] = ($this->input->post('limit')!="")?$this->input->post('limit'):'0';
        $par['limit'] = ($this->input->post('limit')!="")?$this->input->post('limit'):sitedata('site_pagination');
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
                $imsg   =  base_url().'upload/favrayt.png';
                $target_dir =  base_url().'upload/resturants/'.$r->resturant_logo_image;
                if(@getimagesize($target_dir)){
                    $imsg   =   $target_dir;
                }
                $cuisine = explode(",",$r->resturant_cuisine);
                $datas = [];
                if(is_array($cuisine) && count($cuisine) > 0){
                    foreach($cuisine as $keys=>$ce){
                        if($keys >= 3){
                            $p['whereCondition'] = "cuisine_id LIKE '".$ce."' AND cuisine_acde LIKE 'Active'";
                            $cuisines = $this->cuisine_model->get_cuisine($p);
                            $datas[$keys] = $cuisines[0]->cuisine_name;
                        }
                    }
                }
                $data[$key]['resturant_id']         = $r->resturant_id;
                $data[$key]['resturant_given_Id']   = $r->resturant_given_Id;
                $data[$key]['resturant_name']       = $r->resturant_name;
                $data[$key]['resturant_name_a']     = $r->resturant_name_a;
                $data[$key]['logo']                 = $imsg;
                $data[$key]['image']                = base_url().'upload/resturants/'.$r->resturant_image;
                $data[$key]['zone_time']            = $r->resturant_zone_time;
                $data[$key]['openclose']            = $r->resturant_openclose;
                $data[$key]['rating']               = $r->resturant_rating;
                $data[$key]['delivery_change']      = number_format((float)$r->resturant_delivery, 3, '.', '');
                $data[$key]['minorder']             = number_format((float)$r->resturant_minorder, 3, '.', '');
                $data[$key]['cuisines']             = implode(",",$datas);
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
                "cart_addmore"              =>  ($this->input->post('addmore')!="")?$this->input->post('addmore'):'',
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
        $total ='0';$ds = array();$count='0';
        if(is_array($view) && count($view) > 0){
            $customer_id    =   $view["customer_id"];
            $prms =array();
            $prms["whereCondition"]   =   "cart_acde = '0' AND cs.customer_id LIKE '".$customer_id."' OR cs.customer_token LIKE '".$customer_id."' AND rt.resturant_items_abc LIKE 'Active'";
            $dta  = $this->order_model->viewcartproducts($prms);
            $count = count($dta);
            if(is_array($dta) && count($dta) > 0){
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
                    $total = $total+($d->resturant_items_price+$d->resturant_items_packing+$vat+$addonsamount+$variantsamount)*$d->cart_quantity;
                }
            }
        }
        $ds[0]['cart_quantity']     = $count;
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
        /*----------------New Orders--------------------*/
        $data['New Order'] = array();
        //"Order Placed","Preparing","Ready for pickup","Out for delivery","arrived order","Delivered","Order Cancelled"
        $par['whereCondition']  =  "or.customer_id LIKE '".$customer_id."' AND (ord.orderdetails_rest_staus = 'Order Placed' OR ord.orderdetails_rest_staus = 'Preparing' OR ord.orderdetails_rest_staus = 'Ready for pickup' OR ord.orderdetails_rest_staus = 'Out for delivery' OR ord.orderdetails_rest_staus = 'arrived order' )";
        $par['tipoOrderby']     =  "or.orderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.order_id";
        $res = $this->order_model->viewOrders($par);
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data['New Order'][$key]['unique_id']        =  $r->order_unique_id;
                $data['New Order'][$key]['resturant_name']   =  $r->resturant_name;
                $data['New Order'][$key]['resturant_name_a'] =  $r->resturant_name_a;
                $data['New Order'][$key]['order_type']       =  $r->order_type;
                $data['New Order'][$key]['order_amount']     =  $r->order_amount;
                $data['New Order'][$key]['quantity']         =  $r->orderdetail_quantity;
                $data['New Order'][$key]['status']           =  $r->orderdetails_rest_staus;
                $data['New Order'][$key]['order_placed']     =  date("d-m-y H:i:s a", strtotime($r->order_created_by));
            }
        }
        /*----------------New Orders--------------------*/
        /*----------------Delivered--------------------*/
        $data['Delivered'] = array();
        $par['whereCondition']  =  "or.customer_id LIKE '".$customer_id."' AND ord.orderdetails_rest_staus = 'Delivered'";
        $par['tipoOrderby']     =  "or.orderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.order_id";
        $res = $this->order_model->viewOrders($par);
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data['Delivered'][$key]['unique_id']        =  $r->order_unique_id;
                $data['Delivered'][$key]['resturant_name']   =  $r->resturant_name;
                $data['Delivered'][$key]['resturant_name_a'] =  $r->resturant_name_a;
                $data['Delivered'][$key]['order_type']       =  $r->order_type;
                $data['Delivered'][$key]['order_amount']     =  $r->order_amount;
                $data['Delivered'][$key]['quantity']         =  $r->orderdetail_quantity;
                $data['Delivered'][$key]['status']           =  $r->orderdetails_rest_staus;
                $data['Delivered'][$key]['order_placed']     =  date("d-M H:i:s a", strtotime($r->order_created_by));
            }
        }
        /*----------------Delivered--------------------*/
        /*----------------Order Cancelled--------------------*/
        $data['Cancelled'] = array();
        $par['whereCondition']  =  "or.customer_id LIKE '".$customer_id."' AND ord.orderdetails_rest_staus = 'Order Cancelled'";
        $par['tipoOrderby']     =  "or.orderid";
        $par['order_by']        =  "DESC";
        $par['group_by']        =  "ord.order_id";
        $res = $this->order_model->viewOrders($par);
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data['Cancelled'][$key]['unique_id']        = $r->order_unique_id;
                $data['Cancelled'][$key]['resturant_name']   = $r->resturant_name;
                $data['Cancelled'][$key]['resturant_name_a'] = $r->resturant_name_a;
                $data['Cancelled'][$key]['order_type']       = $r->order_type;
                $data['Cancelled'][$key]['order_amount']     = $r->order_amount;
                $data['Cancelled'][$key]['quantity']         = $r->orderdetail_quantity;
                $data['Cancelled'][$key]['status']           = $r->orderdetails_rest_staus;
                $data['Cancelled'][$key]['order_placed']     = date("d-M H:i:s a", strtotime($r->order_created_by));
            }
        }
        /*----------------Order Cancelled--------------------*/
        return $data;
    }
    public function order_details(){
        $view                   =   $this->checkcustomer();
        $customer_id            =   $view["customer_id"];
        $par['whereCondition']  = "or.customer_id LIKE '".$customer_id."' AND or.order_unique_id LIKE '".$this->input->post('unique_id')."'";
        $par['group_by']        = "ord.orderdetails_id";
        $results = $this->order_model->viewOrderDetails($par);
        $data = array();$d = array();$drive = array();$resturant = array();
	    if(is_array($results) && count($results) > 0){
	        $total = '0';
	        foreach($results as $key=>$r){
	            $this->apirestraint_model->vieworder($r->orderdetails_id);
	            $add = explode(",",json_decode($r->orderdetail_addons));
                $addons = array();$addonss= '0';$addonsw='';
                if(is_array($add) && count($add) > 3){
                    foreach($add as $k=>$add){
                        $adds = $this->common_config->clean($add);
                        $pars['columns'] = "orderassons as ordername,orderassons.*";
                        $pars['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$adds."'";
                        $res = $this->order_model->getOrderasson($pars);
                        $ordamount=0;
                        $addons['name'][$k]     = ($res['ordername']!="")?$res['ordername']:'';
                        $addons['amount'][$k]   = ($res['orderassons_amount']!="")?$res['orderassons_amount']:'';
                        $ordamount = $res['orderassons_amount'];
                        $addonss = $addonss+$ordamount;
                    }
                    $addonsw = implode(",",$addons['name']);
                }
	            $variants = explode(",",json_decode($r->orderdetail_variants));
                $var = array();$variantam = '0';$variantsss='';
                if(is_array($variants) && count($variants) > 3){
                    foreach($variants as $ks=>$variant){
                        $variantss = $this->common_config->clean($variant);
                        $pare['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$variantss."'";
                        $ress = $this->order_model->getOrderasson($pare);
                        $variantam = $variantam+$ress['orderassons_amount'];
                        $var['name'][$ks] = ($ress['orderassons']!="")?$ress['orderassons']:'';
                        $var['amount'][$ks] = ($ress['orderassons_amount']!="")?$ress['orderassons_amount']:'0';
                    }
                    $variantsss  = implode(",",$var['name']);
                }
                $total = $total+($r->orderdetail_quantity * $r->orderdetail_price)+$addonss+$variantam;
	            $data[$key]['resturant_name']                    = $r->resturant_name;
	            $data[$key]['resturant_name_a']                  = $r->resturant_name_a;
	            $data[$key]['order_id']                          = $r->order_unique_id;
	            $data[$key]['items_name']                        = $r->resturant_items_name;
	            $data[$key]['items_name_a']                      = $r->resturant_items_name_a;
	            $data[$key]['items_type']                        = $r->resturant_items_type;
	            $data[$key]['quantity']                          = $r->orderdetail_quantity;
	            $data[$key]['price']                             = number_format((float)($r->orderdetail_price+$variantam), 3, '.', '');
	            $data[$key]['addons']                            = $addonsw;
	            $data[$key]['addons_amount']                     = number_format((float)$addonss, 3, '.', '');
	            $data[$key]['variants']                          = $variantsss;
	            $data[$key]['variants_total']                    = number_format((float)$variantam, 3, '.', '');
	            $drive['driver_name']                            = ($r->driver_name!="")?$r->driver_name:'';
	            $drive['driver_name_a']                          = ($r->driver_name_a!="")?$r->driver_name_a:'';
	            $drive['driver_name_last']                       = ($r->driver_name_last!="")?$r->driver_name_last:'';
	            $drive['driver_phone']                           = ($r->driver_phone!="")?$r->driver_phone:'';
	            $drive['driver_email']                           = ($r->driver_email!="")?$r->driver_email:'';
	            $drive['driver_profile_image']                   = ($r->driver_profile_image!="")?$r->driver_profile_image:'';
	            $drive['driver_vehicle_number']                  = ($r->driver_vehicle_number!="")?$r->driver_vehicle_number:'';
	            $drive['driver_vehicle_type']                    = ($r->driver_vehicle_type!="")?$r->driver_vehicle_type:'';
	            $drive['driver_gender']                          = ($r->driver_gender!="")?$r->driver_gender:'';
                $resturant['resturant_name']                     = ($r->resturant_name!="")?$r->resturant_name:'';
	            $resturant['resturant_name_a']                   = ($r->resturant_name_a!="")?$r->resturant_name_a:'';
	            $resturant['resturant_image']                    = ($r->resturant_image!="")?$r->resturant_image:'';
	            $resturant['resturant_logo_image']               = ($r->resturant_logo_image!="")?$r->resturant_logo_image:'';
	            $resturant['resturant_contact']                  = ($r->resturant_contact!="")?$r->resturant_contact:'';
	            $resturant['resturant_contact_no']               = ($r->resturant_contact_no!="")?$r->resturant_contact_no:'';
	            $resturant['resturant_area']                     = ($r->resturant_area!="")?$r->resturant_area:'';
	            $resturant['resturant_block']                    = ($r->resturant_block!="")?$r->resturant_block:'';
	            $resturant['resturant_street']                   = ($r->resturant_street!="")?$r->resturant_street:'';
	            $resturant['resturant_jaada']                    = ($r->resturant_jaada!="")?$r->resturant_jaada:'';
	            $resturant['resturant_house']                    = ($r->resturant_house!="")?$r->resturant_house:'';
	            $resturant['resturant_building']                 = ($r->resturant_building!="")?$r->resturant_building:'';
	            $resturant['resturant_latitude']                 = ($r->resturant_latitude!="")?$r->resturant_latitude:'';
	            $resturant['resturant_longitude']                = ($r->resturant_longitude!="")?$r->resturant_longitude:'';
	            $resturant['resturant_preparation']              = $r->resturant_preparation.' Mins';
	            $la = $this->db->query("SELECT driver_address_latitude,driver_address_longitude FROM driver_address_update WHERE driver_address_driver_id = '".$r->driver_id."' ORDER BY `driver_addressid` DESC LIMIT 1")->row_array();
                if(is_array($la) && count($la) >0){
                    $drive['driver_lat']                             = ($la['driver_address_latitude']!="")?$la['driver_address_latitude']:'';
	                $drive['driver_long']                            = ($la['driver_address_longitude']!="")?$la['driver_address_longitude']:'';
                }else{
                    $drive['driver_lat']='';
	                $drive['driver_long']='';
                }
	        }
	        $r = array(
	            'total'     =>  $total,
	            'delivery'  =>  '0'
	        );
	        $orderstatus = $this->config->item('orderstatus');
	        $d = array(
	            'order_id'                  => ($results[0]->order_unique_id)?$results[0]->order_unique_id:'',
	            'order_count'               => count($results),
	            'order_date_time'           => date("d-M-Y", strtotime($results[0]->orderstatus_add_date)),
	            'order_time'                => date("H:i:s a", strtotime($results[0]->orderstatus_add_date)),
	            'orderdetails_rest_staus'   => ($results[0]->orderdetails_rest_staus)?$results[0]->orderdetails_rest_staus:'',
	            'resturant_preparation'     => $results[0]->resturant_preparation. 'Mins',
	            'support_number'            => sitedata('site_support_number'),
	            'support_email'             => sitedata('site_email'),
	            'order_status'              => $this->order_status($results[0]->orderdetails_id),
	            'address'                   => $this->order_address(),
	            'address_ios'               => $this->order_address_ios(),
	            'order_list'                => $data,
	            'driver_details'            => $drive,
	            'resturant_details'         => $resturant,
	            'order_amount'              => $r,
	        );
	        if(isset($results[0]->orderdetails_rest_staus) && $results[0]->orderdetails_rest_staus == $orderstatus[3] || $results[0]->orderdetails_rest_staus == $orderstatus[4]){
	            $distance = $this->common_config->GetDrivingDistance(($la['driver_address_latitude']!="")?$la['driver_address_latitude']:'',$results[0]->resturant_latitude,($la['driver_address_longitude']!="")?$la['driver_address_longitude']:'',$results[0]->resturant_longitude);
                //$data[$key]['dis'] = $distance;
                $dista='';$time='';
                if(is_array($distance)){
                    $dista = $distance['distance'];
                    $time  = $distance['time'];
                }
	            $d['around_time']       = $time;
	            $d['around_distance']   = $dista;
	        }
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
        $par['whereCondition']  = "orderdetail_restaurant_id LIKE '".$orderid."' AND (orderdetail_status = 'Order Placed' OR orderdetail_status = 'Preparing' OR orderdetail_status = 'Ready for pickup' OR orderdetail_status = 'Out for delivery' OR orderdetail_status = 'Delivered' OR orderdetail_status = 'Order Cancelled')";
        $par['tipoOrderby']     = "orderstatus_id";
        $par['order_by']        = "ASC";
        $par['group_by']        = "orderdetail_status";
        $res = $this->order_model->viewOrderStatus($par);
        $da = array();
        $sta =array('Order Placed','Food Preparing','Completed Pickup','Deliverd','Order Cancelled');
        if(is_array($res) && count($res) > 0){
           // print_r($res);exit;
            $k=0;$dsitem ='';
            $i=0;foreach($res as $key=>$r){
                if("Order Cancelled" == $r->orderdetail_status){
                    $da[$i]['status'] = 'Cancel Order';
                    $da[$i]['time']   = date("H:i:s a", strtotime($r->orderstatus_add_date));
                    $da[$i]['date']   = date("d-M-Y", strtotime($r->orderstatus_add_date));
                    $dsitem           = 'Cancel Order';
                    $k = 1;
                    $i++;
                }elseif($r->orderdetail_status == "Order Placed" ){
                    $da[$i]['order_status'] = '1';
                    $da[$i]['status']       = 'Order Placed';
                    $da[$i]['time']         = date("H:i:s a", strtotime($r->orderstatus_add_date));
                    $da[$i]['date']         = date("d-M-Y", strtotime($r->orderstatus_add_date));
                    $dsitem                 = 'Order Placed';$i++;
                }elseif(("Preparing" == $r->orderdetail_status || "Ready for pickup" == $r->orderdetail_status || "Dely Order" == $r->orderdetail_status)){
                    if($dsitem != 'Food Preparing'){
                        $da[$i]['order_status'] = '1';
                        $da[$i]['status']       = 'Food Preparing';
                        $da[$i]['time']         = date("H:i:s a", strtotime($r->orderstatus_add_date));
                        $da[$i]['date']         = date("d-M-Y", strtotime($r->orderstatus_add_date));
                        $dsitem                 = 'Food Preparing';$i++;
                    }
                }elseif(("Out for delivery" == $r->orderdetail_status || "arrived order" == $r->orderdetail_status)){
                    $da[$i]['order_status'] = '1';
                    $da[$i]['status']       = 'Completed Pickup';
                    $da[$i]['time']         = date("H:i:s a", strtotime($r->orderstatus_add_date));
                    $da[$i]['date']         = date("d-M-Y", strtotime($r->orderstatus_add_date));
                    $dsitem                 = 'Completed Pickup';$i++;
                }elseif("Delivered" == $r->orderdetail_status){
                    $da[$i]['order_status'] = '1';
                    $da[$i]['status']       = 'Deliverd';
                    $da[$i]['time']         = date("H:i:s a", strtotime($r->orderstatus_add_date));
                    $da[$i]['date']         = date("d-M-Y", strtotime($r->orderstatus_add_date));
                    $dsitem                 = 'Deliverd';$i++;
                }elseif("Order Cancelled" == $r->orderdetail_status){
                    $da[$i]['order_status'] = '1';
                    $da[$i]['status']       = 'Cancel Order';
                    $da[$i]['time']         = date("H:i:s a", strtotime($r->orderstatus_add_date));
                    $da[$i]['date']         = date("d-M-Y", strtotime($r->orderstatus_add_date));
                    $dsitem                 = 'Cancel Order';$i++;
                }else{
                    $da[$i]['order_status'] = '0';
                    $da[$i]['status']       = $sta[$i];
                    $da[$i]['time']         = '';
                    $da[$i]['date']         = '';
                    $i++;
                }
                
            }
        }
        //print_r($da);exit;
        $ds=array();
        if($k == 0){
            $ds[0]['order_status']      = '0';
            $ds[0]['order_status_name'] = 'Order Placed';
            $ds[0]['time']              = '';
            $ds[0]['date']              = '';
            
            $ds[1]['order_status']      = '0';
            $ds[1]['order_status_name'] = 'Food Preparing';
            $ds[1]['time']              = '';
            $ds[1]['date']              = '';
            
            $ds[2]['order_status']      = '0';
            $ds[2]['order_status_name'] = 'Completed Pickup';
            $ds[2]['time']              = '';
            $ds[2]['date']              = '';
            
            $ds[3]['order_status']      = '0';
            $ds[3]['order_status_name'] = 'Deliverd';
            $ds[3]['time']              = '';
            $ds[3]['date']              = '';
        }
        $temp       = array_unique(array_column($da, 'status'));
        $unique_arr = array_intersect_key($da, $temp);
        $dsty = '';
        foreach($da as $key=>$dd){
            $ds[$key]['order_status']       = '1';
            $ds[$key]['order_status_name']  = $dd['status'];
            $ds[$key]['time']               = $dd['time'];
            $ds[$key]['date']               = $dd['date'];
        }
        return $ds;
    }
    public function privacy_policy(){
        $data = array();
        $par['whereCondition']     = "page_name LIKE 'Privacy policy'";
        $res = $this->common_model->getPages($par);
        if(is_array($res) && count($res) > 0){
            foreach($res as $r){
                $data['name']       = $res['page_name'];
                $data['page_desc']  = $res['page_desc'];
            }
        }
        return $data;
    }
}