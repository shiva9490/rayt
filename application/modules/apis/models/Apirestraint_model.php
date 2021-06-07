<?php
class Apirestraint_model extends CI_Model{
    public function restraint_details(){
        $par['whereCondition'] ="resturant_id LIKE  '".$this->input->post("restrant_id")."'";
        $details = $this->resturant_model->getResturant($par);
       // print_r($details);exit;
        $dta = array();
        if(is_array($details) && count($details) > 0 ){
            $distance = $this->common_config->GetDrivingDistance($this->input->post("lat"),$details['resturant_latitude'],$this->input->post("long"),$details['resturant_longitude']);
            $dista='';$time='';
            if(is_array($distance)){
                $dista = $distance['distance'];
                $time  = $distance['time'];
            }
            $imsg =   base_url()."upload/favrayt.png";
            $target_dir =   base_url()."upload/resturants/".$details['resturant_logo_image'];
            if(@getimagesize($target_dir)){
                $imsg   =   $target_dir;
            }
            $cuisine = explode(",",$details['resturant_cuisine']);
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
            $dta['resturant_name']        = $details['resturant_name'];
            $dta['resturant_image']       = base_url().'upload/resturants/'.$details['resturant_image'];
            $dta['resturant_logo']        = $imsg;
            $dta['resturant_latitude']    = $details['resturant_latitude'];
            $dta['resturant_longitude']   = $details['resturant_longitude'];
            $dta['resturant_area']        = $details['resturant_area'];
            $dta['resturant_block']       = $details['resturant_block'];
            $dta['resturant_street']      = $details['resturant_street'];
            $dta['resturant_jaada']       = $details['resturant_jaada'];
            $dta['resturant_house']       = $details['resturant_house'];
            $dta['resturant_building']    = $details['resturant_building'];
            $dta['resturant_landmark']    = $details['resturant_landmark'];
            $dta['resturant_area_a']      = $details['resturant_area_a'];
            $dta['resturant_block_a']     = $details['resturant_block_a'];
            $dta['resturant_street_a']    = $details['resturant_street_a'];
            $dta['resturant_jaada_a']     = $details['resturant_jaada_a'];
            $dta['resturant_house_a']     = $details['resturant_house_a'];
            $dta['resturant_building_a']  = $details['resturant_building_a'];
            $dta['resturant_landmark_a']  = $details['resturant_landmark_a'];
            $dta['resturant_zone_time']   = $details['resturant_zone_time'];
            $dta['resturant_openclose']   = $details['resturant_openclose'];
            $dta['resturant_rating']      = $details['resturant_rating'];
            $dta['resturant_cuisine']     = implode(",",$datas);
            $dta['resturant_delivery']    = number_format((float)$details['resturant_delivery'], 3, '.', '');
            $dta['resturant_minorder']    = number_format((float)$details['resturant_minorder'], 3, '.', '');
            $dta['distance']              = ($dista!="")?$dista:'';
            $dta['time']                  = ($time!="")?$time:'';
            $dta['resturant_working']     = $this->resttimes($details['resturant_id']);
        }
        return $dta;
    }
    public function resttimes($id){
        $par['whereCondition'] = "resturant_id LIKE '".$id."'";
        $res = $this->resturant_model->viewResTime($par);
        $da=array();
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$r){
                if($r->resturant_close_time==1){$stat =  'Close';}else{$stat= 'Open';}
                $da[$key]['week']         = $r->resturant_weekly;
                $da[$key]['start_time']   = $r->resturant_start_time;
                $da[$key]['end_time']     = $r->resturant_end_time;
                $da[$key]['status']       = $stat;
            }
        }
        return $da;
    }
    public function restraint_menu(){
        $par['whereCondition'] ="resturant_id LIKE  '".$this->input->post("restrant_id")."'";
        $cat = $this->menu_model->viewCategory($par);
        $dta = array();
        if(is_array($cat) && count($cat) >0 ){
            foreach($cat as $key=>$c){
                $dta[$key]['category']         =  $c->resturant_category_id;
                $dta[$key]['category_name']    =  $c->resturant_category_name;
                $dta[$key]['category_name_a']  =  $c->resturant_category_name_a;
                $dta[$key]['item_list']        =  $this->menu_items($this->input->post("restrant_id"),$c->resturant_category_id);
            }
        }
        return $dta;
    }
    public function restraint_menu_categotry(){
        $par['whereCondition'] ="resturant_id LIKE  '".$this->input->post("restrant_id")."'";
        $cat = $this->menu_model->viewCategory($par);
        $dta = array();
        if(is_array($cat) && count($cat) >0 ){
            foreach($cat as $key=>$c){
                $dta[$key]['category']         =  $c->resturant_category_id;
                $dta[$key]['category_name']    =  $c->resturant_category_name;
                $dta[$key]['category_name_a']  =  $c->resturant_category_name_a;
                $dta[$key]['items_count']      =  $this->menu_items_count($this->input->post("restrant_id"),$c->resturant_category_id);
            }
        }
        return $dta;
    }
    public function menu_items_count($resturant_id,$category_id){
        $par['whereCondition'] ="resturant_id LIKE  '".$resturant_id."' AND resturant_category_id LIKE '".$category_id."' AND resturant_items_abc = 'Active'";
        $item = $this->menu_model->viewItems($par);
        $dta = '0';
        if(is_array($item) && count($item) > 0 ){
            $dta =  strval(count($item));
        }
        return $dta;
    }
    public function menu_items($resturant_id,$category_id){
        $par['whereCondition'] ="resturant_id LIKE  '".$resturant_id."' AND resturant_category_id LIKE '".$category_id."' AND resturant_items_abc LIKE 'Active'";
        $item = $this->menu_model->viewItems($par);
        $dta = array();
        if(is_array($item) && count($item) > 0 ){
            foreach($item as $key=>$c){
                $deflet = $this->apirestraint_model->item_variants($resturant_id,$c->resturant_items_id);
                $defprince='0';
                if(is_array($deflet) && count($deflet) > 0){
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
                $prince = $c->resturant_items_price+$defprince;
                $tot = ($c->resturant_items_price *$c->resturant_items_vat)/100;
                $total = $tot+$c->resturant_items_packing+$c->resturant_items_price;
                $dta[$key]['items_id']              =   $c->resturant_items_id;
                $dta[$key]['items_name']            =   $c->resturant_items_name;
                $dta[$key]['items_name_a']          =   $c->resturant_items_name_a;
                $dta[$key]['items_image']           =   base_url().'upload/resturants/'.$c->resturant_items_image;
                $dta[$key]['items_type']            =   $c->resturant_items_type;
                $dta[$key]['items_desc']            =   $c->resturant_items_desc;
                $dta[$key]['items_price']           =   number_format((float)$c->resturant_items_price, 3, '.', '');
                $dta[$key]['items_packing']         =   $c->resturant_items_packing;
                $dta[$key]['items_vat']             =   $c->resturant_items_vat;
                $dta[$key]['items_total']           =   number_format((float)$total, 3, '.', '');
                $dta[$key]['items_abc']             =   $c->resturant_items_abc;
            }
        }
        return $dta;
    }
    public function item_addons(){
        $par['whereCondition'] = "rt.resturant_id LIKE '".$this->input->post('restrant_id')."' AND  rt.resturant_items_id LIKE '".$this->input->post('item_id')."'";
        $par['group_by'] ="ra.resturant_addon_id";
        $res = $this->menu_model->viewAddon($par);
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data[$key]['addon_name']           = ($r->addon_name!="")?$r->addon_name:$r->resturant_customisation;
                $data[$key]['addon_option']         = $r->resturant_addon_option;
                $data[$key]['addon_min']            = $r->resturant_addon_min;
                $data[$key]['addon_max']            = $r->resturant_addon_max;
                $data[$key]['addon_type']           = "checkbox";
                $data[$key]['addon_option_list']    = $this->addonlist($r->resturant_addon_id);
            }
        }
        return $data;
    }
    public function addonlist($addon){
        $par['whereCondition'] = "rt.resturant_id LIKE '".$this->input->post('restrant_id')."' AND  rt.resturant_items_id LIKE '".$this->input->post('item_id')."' AND ral.resturant_addon_id  LIKE '".$addon."'";
        //$par['group_by'] ="ra.resturant_addon_temp_id";
        $res = $this->menu_model->viewAddon($par);
        //print_r($res);exit;
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data[$key]['addon_listid']     = $r->resturant_addon_listid;
                $data[$key]['addonitem']        = $r->resturant_addonitem;
                $data[$key]['addonitem_amount'] = number_format((float)$r->resturant_addonitem_amount, 3, '.', '');
            }
        }
        return $data;
    }
    public function addonlistios($addon){
        $par['whereCondition'] = "rt.resturant_id LIKE '".$this->input->post('restrant_id')."' AND  rt.resturant_items_id LIKE '".$this->input->post('item_id')."'";
        //$par['group_by'] ="ra.resturant_addon_temp_id";
        $res = $this->menu_model->viewAddon($par);
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data[$key]['variants_id']     = $r->resturant_addon_listid;
                $data[$key]['variants']        = $r->resturant_addonitem;
                $data[$key]['variants_price'] = number_format((float)$r->resturant_addonitem_amount, 3, '.', '');
            }
        }
        return $data;
    }
    public function getaddon($restrant_id,$item_id,$adds){
        $par['whereCondition'] = "rt.resturant_id LIKE '".$restrant_id."' AND  rt.resturant_items_id LIKE '".$item_id."' AND ral.resturant_addon_listid LIKE '".$adds."' ";
        $res = $this->menu_model->getAddon($par);
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data['addon_listid']     = $r['resturant_addon_listid'];
                $data['addonitem']        = $r['resturant_addonitem'];
                $data['addonitem_amount'] = $r['resturant_addonitem_amount'];
            }
        }
        return $data;
    }
    public function item_variants($resturant_id=null,$resturant_items_id=null){
        $resid = ($this->input->post('restrant_id')!="")?$this->input->post('restrant_id'):$resturant_id;
        $itemid = ($this->input->post('item_id')!="")?$this->input->post('item_id'):$resturant_items_id;
        $par['whereCondition'] = "rt.resturant_id LIKE '".$resid."' AND  rt.resturant_items_id LIKE '".$itemid."'";
        $par['group_by'] = "resturant_variants_category";
        $res = $this->menu_model->viewVariants($par);
        //print_r($res);exit;
        $data = array();
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$r){
                $data[$key]['variant_id']           = $r->variant_id;
                $data[$key]['variant_name']         = ($r->variant_name!="")?$r->variant_name:$r->resturant_variants_title;
                $data[$key]['variant_max']          = '1';
                $data[$key]['variant_type']         = "Radiobutton";
                $data[$key]['variant_description']  = ($r->variant_description!="")?$r->variant_description:'0';
                $data[$key]['variant_list']         = $this->item_variants_list($r->resturant_variants_category);
            }
        }
        return $data;
    }
    public function item_variants_ios(){
        $par['whereCondition'] = "rt.resturant_id LIKE '".$this->input->post('restrant_id')."' AND  rt.resturant_items_id LIKE '".$this->input->post('item_id')."'";
        $par['group_by'] = "resturant_variants_category";
        $res = $this->menu_model->viewVariants($par);
        
        /*--------------------------*/
        $pars['whereCondition'] = "rt.resturant_id LIKE '".$this->input->post('restrant_id')."' AND  rt.resturant_items_id LIKE '".$this->input->post('item_id')."'";
        $pars['group_by'] ="ra.resturant_addon_temp_id";
        $ress = $this->menu_model->viewAddon($pars);
        /*--------------------------*/
        //print_r($ress);exit;
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data[$key]['variant_id']           = $r->variant_id;
                $data[$key]['variant_name']         = ($r->variant_name!="")?$r->variant_name:$r->resturant_variants_title;
                $data[$key]['variant_max']          = '1';
                $data[$key]['variant_type']         = "Radiobutton";
                $data[$key]['variant_description']  = $r->variant_description;
                $data[$key]['variant_list']         = $this->item_variants_list($r->resturant_variants_category);
            }
        }
        $i = count($res);
        if(is_array($ress) && count($ress) > 0){
            foreach($ress as $rs){
                $data[$i]['variant_id']      = $rs->addon_id;
                $data[$i]['variant_name']    = $rs->addon_name;
                $data[$i]['variant_option']  = $rs->resturant_addon_option;
                $data[$i]['variant_min']     = $rs->resturant_addon_min;
                $data[$i]['variant_max']     = $rs->resturant_addon_max;
                $data[$i]['variant_type']    = "checkbox";
                $data[$i]['variant_list']    = $this->addonlistios($rs->resturant_addon_id);
            $i++;}
        }
        return $data;
    }
    public function item_variants_list($va){
        $par['whereCondition'] = "rt.resturant_id LIKE '".$this->input->post('restrant_id')."' AND  rt.resturant_items_id LIKE '".$this->input->post('item_id')."' AND rv.resturant_variants_category  LIKE '".$va."'";
        //$par['group_by'] = "resturant_variants_category";
        $res = $this->menu_model->viewVariants($par);
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                $data[$key]['variants_id']        = $r->resturant_variants_id;
                $data[$key]['variants']           = $r->resturant_variants;
                $data[$key]['variants_veg']       = $r->resturant_variants_veg;
                $data[$key]['variants_defelat']   = ($r->resturant_variants_defelat!="")?$r->resturant_variants_defelat:'0';
                $data[$key]['variants_price']     = number_format((float)$r->resturant_variants_price, 3, '.', '');
            }
        }
        return $data;
    }
    public function neworders($ids = null){
        if(!empty($ids)){
			$status  = $ids;
		}else{
		    $status  = "Order Placed";
		}
		$conditions['whereCondition']   = "ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$status."'";
        $conditions['tipoOrderby']      = "ord.orderdetails_unique_id";
        $conditions['order_by']         = "DESC";
        $conditions['limit']            = sitedata("site_pagination");
        $conditions['group_by']         = "or.order_unique_id";
        $res = $this->order_model->viewOrderDetails($conditions);
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
                //print_r($r->order_created_by);exit;
                $data[$key]['unique_id']            = $r->order_unique_id;
                $data[$key]['status']               = $r->orderdetails_rest_staus;
                $data[$key]['customer_id']          = $r->customer_id;
                $data[$key]['customer_name']        = $r->customer_name;
                $data[$key]['customer_email_id']    = $r->customer_email_id;
                $data[$key]['order_type']           = $r->order_type;
                $data[$key]['order_item_count']     = $r->order_item_count;
                $data[$key]['orderdetails_view']    = $r->orderdetails_view;
                $data[$key]['order_placed_date']    = date("d-M-Y", strtotime($r->order_created_by));
                $data[$key]['order_placed_time']    = date("H:i:s a", strtotime($r->order_created_by));
            }
        }
        return $data;
    }
    public function viewneworder($unique_id = null,$status =null){
        $usn = $this->input->post("unique_id");
        if($unique_id!=""){
            $usn = $unique_id;
        }
        $statu = $this->input->post("status");
        if($status !=""){
            $statu = $status;
        }
        $par['columns'] ="or.order_id,or.order_unique_id,or.order_created_by,or.order_type,or.order_amount,ord.orderdetail_customer_id,ord.orderdetails_rest_staus,drso.driver_view_order,res.resturant_id,res.resturant_name,res.resturant_image,res.resturant_logo_image,res.resturant_contact,
                        res.resturant_position,res.resturant_contact_no,res.resturant_area,res.resturant_block,res.resturant_street,res.resturant_jaada,res.resturant_house,res.resturant_building,res.resturant_landmark,res.resturant_latitude,res.resturant_longitude,
                        cadd.customeraddress_fullname,cadd.customeraddress_mobile,cadd.customeraddress_add_type,cadd.customeraddress_area,cadd.customeraddress_blockno,cadd.customeraddress_streetno,cadd.customeraddress_jadda,cadd.customeraddress_buildingno,cadd.customeraddress_floorno,
                        cadd.customeraddress_landmark,cadd.customeraddress_current_loc,cadd.customeraddress_add_lat,cadd.customeraddress_add_lot,cadd.customeraddress_landline";
        $par['whereCondition']  =  "or.order_unique_id LIKE '".$usn."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$statu."'";
	    $par['group_by']        =  "ost.orderdetail_status";
	    $results = $this->order_model->viewOrderDetails($par);
	    $data = array();
	    if(is_array($results) && count($results) > 0){
	        foreach($results as $key=>$r){
	            $data['billing']['unique_id']            =  $r->order_unique_id;
	            $data['billing']['order_type']           =  $r->order_type;
	            $data['billing']['status']               =  $r->orderdetails_rest_staus;
	            $data['billing']['order_placed_date']    =  date("d-M-Y", strtotime($r->order_created_by));
	            $data['billing']['order_placed_time']    =  date("H:i:s a", strtotime($r->order_created_by));
                $data['customeraddress']['fullname']     =  $r->customeraddress_fullname;
                $data['customeraddress']['mobile']       =  $r->customeraddress_mobile;
                $data['customeraddress']['landline']     =  $r->customeraddress_landline;
                $data['customeraddress']['add_type']     =  $r->customeraddress_add_type;
                $data['customeraddress']['area']         =  $r->customeraddress_area;
                $data['customeraddress']['blockno']      =  $r->customeraddress_blockno;
                $data['customeraddress']['streetno']     =  $r->customeraddress_streetno;
                $data['customeraddress']['jadda']        =  $r->customeraddress_jadda;
                $data['customeraddress']['buildingno']   =  $r->customeraddress_buildingno;
                $data['customeraddress']['floorno']      =  $r->customeraddress_floorno;
                $data['customeraddress']['landmark']     =  $r->customeraddress_landmark;
                $data['customeraddress']['current_loc']  =  $r->customeraddress_current_loc;
                $data['customeraddress']['add_lat']      =  $r->customeraddress_add_lat;
                $data['customeraddress']['add_lot']      =  $r->customeraddress_add_lot;
                $data['order_details']                   =  $this->order_details($usn,$statu);
                $data['order_status']                    =  $this->order_status($r->order_id);
                $data['drivery_details']                 =  $this->driver_details($usn,$statu);
	        }
	    }
	    return $data;
    }
    public function order_details($usn= null,$status= null,$resturant_id=null){
        $unique_id = $this->input->post("unique_id");
        if($usn!=""){
            $unique_id = $usn;
        }
        $statu = $this->input->post("status");
        if($status !=""){
            $statu = $status;
        }
        $resturantid = $this->input->post("restrant_id");
        if($resturant_id !=""){
            $resturantid = $resturant_id;
        }
        $par['whereCondition']  =  "or.order_unique_id LIKE '".$unique_id."' AND ord.orderdetail_restaurant_id LIKE '".$resturantid."' AND orderdetails_rest_staus LIKE '".$status."'";
	    $par['group_by'] = "ord.orderdetails_unique_id";
	    $results = $this->order_model->viewOrderDetails($par);
	    $data = array();
	    if(is_array($results) && count($results) > 0){
	        $total = '0';
	        foreach($results as $key=>$r){
	            $this->vieworder($r->orderdetails_id);
	            $add = explode(",",json_decode($r->orderdetail_addons));
	            //print_r($add);exit;
                $addons = array();$addonss= '0';
                if(is_array($add) && count($add) > 0){
                    foreach($add as $k=>$add){
                        $adds = $this->common_config->clean($add);
                        $pars['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$adds."'";
                        $res = $this->order_model->getOrderasson($pars);
                        $addons['name'][$k] = $res['orderassons'];
                        $addonss = $addonss+$res['orderassons_amount'];
                    }
                    $addons = implode(",",$addons['name']);
                }
	            $variants = explode(",",json_decode($r->orderdetail_variants));
                $var = array();
                $variantam = '0';
                if(is_array($variants) && count($variants) > 0){
                    foreach($variants as $variant){
                        $variantss = $this->common_config->clean($variant);
                        $parss['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$variantss."'";
                        $ress = $this->order_model->getOrderasson($parss);
                        $variantam = $variantam+$ress['orderassons_amount'];
                        $var['name'][$k] = $ress['orderassons'];
                    }
                    $var  = implode(",",$var['name']);
                }
                
                $total = $total+($r->orderdetail_quantity * ($r->orderdetail_price+$addonss+$variantam));
	            $data['order_list'][$key]['order_unique_id']   = $r->orderdetails_unique_id;
	            $data['order_list'][$key]['items_name']        = $r->resturant_items_name;
	            $data['order_list'][$key]['items_name_a']      = $r->resturant_items_name_a;
	            $data['order_list'][$key]['items_type']        = $r->resturant_items_type;
	            $data['order_list'][$key]['quantity']          = $r->orderdetail_quantity;
	            $data['order_list'][$key]['price']             = $r->orderdetail_price;
	            $data['order_list'][$key]['addons']            = $addons;
	            $data['order_list'][$key]['variants']          = $var;
	            $data['order_payments']['total']               = $total;
	            $data['order_payments']['delivery']            = '0';
	        }
	    }
	    return $data;
    }
    public function order_status($id){
        $orderstatus = $this->config->item('orderstatus');
        $ds = array();$t='';
        foreach($orderstatus as $key=>$oct){
            if($key < 3){
                $par['whereCondition']  =   "order_id LIKE '".$id."' AND orderdetail_status LIKE '".$oct."'";
                $par['group_by']        =   "orderdetail_status";
                $res = $this->order_model->getOrderStatus($par);
                if(is_array($res) && count($res) > 0){
                    foreach($res as $r){
                        $ds[$oct] = date("H:i:s a", strtotime($r['orderstatus_add_date']));
                        $t = ($r['orderstatus_add_date']!="")?$r['orderstatus_add_date']:'';
                        $st = date("H:i:s", strtotime($r['orderstatus_add_date']));
                    }
                }else{
                    $tim='';
                    if($oct === "Ready for pickup"){
                        $p['whereCondition'] ="ord.order_id LIKE '".$id."'";
                        $ress = $this->order_model->getOrderDetails($p);
                        $tims = explode(" ",($ress['resturant_zone_time']!="")?$ress['resturant_zone_time']:$ress['resturant_subzone_time']);
                        if(isset($st) && $st!=""){
                            $tim = date("H:i:s a", strtotime($st)+($tims[0]*60));
                        }
                    }
                    $ds[$oct]  = $tim;
                }
            }
        }
        return $ds;
    }
    public function driver_details($usn= null,$status= null,$resturant_id = null){
        $unique_id = $this->input->post("unique_id");
        if($usn!=""){
            $unique_id = $usn;
        }
        $statu = $this->input->post("status");
        if($status !=""){
            $statu = $status;
        }
        $resturantid = $this->input->post("restrant_id");
        if($resturant_id !=""){
            $resturantid = $resturant_id;
        }
        $par['columns']         =   "dr.driver_id,driver_name,driver_name_last,driver_name_a,driver_name_a_last,driver_phone,driver_email,driver_gender,driver_vehicle_number,driver_vehicle_type,driver_profile_image,driver_address_a,driver_address";
        $par['whereCondition']  =   "or.order_unique_id LIKE '".$unique_id."' AND ord.orderdetail_restaurant_id LIKE '".$resturantid."' AND orderdetails_rest_staus LIKE '".$status."'";
	    $results = $this->order_model->getOrderDetails($par);
	    $da = array();
	    if(is_array($results) && count($results) > 0){
	        foreach($results as $d){
	            $pa['whereCondition'] = "dau.driver_address_driver_id LIKE '".$results['driver_id']."'";
	            $da['driver_name']              = $results['driver_name'];
	            $da['driver_name_last']         = $results['driver_name_last'];
	            $da['driver_name_a']            = $results['driver_name_a'];
	            $da['driver_name_a_last']       = $results['driver_name_a_last'];
	            $da['driver_gender']            = $results['driver_gender'];
	            $da['driver_phone']             = $results['driver_phone'];
	            $da['driver_email']             = $results['driver_email'];
	            $da['driver_address']           = $results['driver_address'];
	            $da['driver_address_a']         = $results['driver_address_a'];
	            $da['driver_vehicle_number']    = $results['driver_vehicle_number'];
	            $da['driver_vehicle_type']      = $results['driver_vehicle_type'];
	            $da['driver_profile_image']     = base_url().'upload/drivers/'.$results['driver_profile_image'];
	        }
            $la = $this->db->query("SELECT driver_address_latitude,driver_address_longitude FROM driver_address_update WHERE driver_address_driver_id = '".$results['driver_id']."' ORDER BY `driver_addressid` DESC LIMIT 1")->row_array();
            if(is_array($la) && count($la) >0){
                $da['driver_lat']               = ($la['driver_address_latitude']!="")?$la['driver_address_latitude']:'';
                $da['driver_lon']               = ($la['driver_address_longitude']!="")?$la['driver_address_longitude']:'';
            }else{
                 $da['driver_lat']  ='';
                 $da['driver_lon']  ='';
            }
	        
	    }
        return $da;
    }
    public function vieworder($id){
        $par['whereCondition'] = "orderdetails_id LIKE '".$id."'";
        $results = $this->order_model->viewOrderDetails($par);
        if(is_array($results) && count($results) > 0){
            $data = array(
                'orderdetails_view' => '1',
                'orderdetail_modified_on' => date('Y-m-d H:i:s'),
                'orderdetail_modified_by' => $this->input->post("restrant_id"),
            );
            return $this->db->where('orderdetails_id',$id)->update('order_details',$data);
        }
    }
    public function change_action(){
        $par['columns']          =  "ord.order_id AS orderids,or.*,ord.*,rt.*,res.*,cs.*,ost.*,cadd.*,drso.*,dr.*";
        $par['whereCondition']   =  "order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$this->input->post("status")."'";
        $results = $this->order_model->viewOrderDetails($par);
        if(is_array($results) && count($results) > 0){
	        $res = $this->order_model->order_accect($results);
	        if($res >0){
	            return 1;
	        }else{
	            return 0;
	        }
        }
    }
    public function change_action_rejected(){
        $par['whereCondition'] = "order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$this->input->post("status")."'";
        $results = $this->order_model->viewOrderDetails($par);
        if(is_array($results) && count($results) > 0){
	        $res = $this->order_model->order_accect($results);
	        if($res >0){
	            return 1;
	        }else{
	            return 0;
	        }
        }
    }
    public function cancel_status(){
        $cancel_order = $this->config->item('cancleorderstatus');
        $d = array();
        if(is_array($cancel_order) && count($cancel_order) > 0){
            foreach($cancel_order as $ky=>$c){
                $d[$ky]['message'] = $c;
            }
        }
        return $d;
    }
    public function cancel_order(){
        $par['columns']       =   "ord.order_id AS orderids,or.*,ord.*,rt.*,res.*,cs.*,ost.*,cadd.*,drso.*,dr.*";
        $hr ="AND (ord.orderdetails_rest_staus = 'Order Placed' OR ord.orderdetails_rest_staus = 'Preparing' OR ord.orderdetails_rest_staus = 'Ready for pickup')";
        $par['whereCondition'] = "or.order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' $hr";
        $results = $this->order_model->viewOrderDetails($par);
        if(is_array($results) && count($results) > 0){
            //print_r($results);exit;
            return $this->order_model->order_accect($results);
        }
        return false;
    }
    public function online_offline(){
        if($this->input->post("status")=='1'){
            $status = 'Active';
        }else if($this->input->post("status")=='2'){
            $status = 'Inactive';
        }
        $data = array(
            'resturant_openclose' => $status,
        );
        $this->db->where('resturant_id',$this->input->post("restrant_id"))->update('resturant',$data);
        $dat    =   array(
            "resturant_id"               =>  $this->input->post("restrant_id"),
            "resturant_status_status" 	 =>  $status,
            "resturant_status_cr_by" 	 =>  $this->input->post("restrant_id"),
            "resturant_status_cr_on" 	 =>  date("Y-m-d h:i:s")
        );
        $this->db->insert("resturant_status",$dat);
        $vsp   =    $this->db->insert_id();
        if($vsp > 0){
            $this->db->update("resturant_status",array("resturant_status_id" => $vsp."RESHIS"),array("resturant_statusid" => $vsp));
            return TRUE;
        }
        return false;
    }
    public function vieworderss(){
        $vues =array();
        $limit  = ($this->input->post('limit')!="")?$this->input->post('limit'):'0';
        $conditions['whereCondition']   = "ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."'  AND orderdetails_rest_staus LIKE 'Delivered' OR orderdetails_rest_staus LIKE 'Order Cancelled'";
        $conditions['order_by']         = "DESC";
        $conditions['tipoOrderby']      = "order_unique_id";
        $conditions['start']            = ($limit!="")?$limit:'0';
        $conditions['limit']            = sitedata("site_pagination")+$limit;
        $conditions['group_by']         = "order_unique_id";
        $vue    =   $this->order_model->viewOrders($conditions);
        foreach($vue as $key=>$vu){
            $vues[$key] = $this->viewneworder($vu->order_unique_id,$vu->orderdetails_rest_staus);
        }
        return $vues;
    }
    public function delay_order(){
        $dat = array();
        $orderstatus = $this->config->item('orderstatus');
        $conditions['whereCondition']   = "ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND or.order_unique_id LIKE '".$this->input->post("unique_id")."' AND (ord.orderdetails_rest_staus LIKE '".$orderstatus[1]."')";
        $vue    =   $this->order_model->getOrders($conditions);
        if(is_array($vue) && count($vue) > 0){
            $orderstat= array(
                'order_id'                  => $vue['order_id'],
                'orderdetail_restaurant_id' => $vue['orderdetails_id'],
                'orderdetail_status'        => "Dely Order",
                'orderdetail_dely_time'     => $this->input->post('delay_time'),
                'orderstatus_add_by'        => $this->input->post('restrant_id'),
                'orderstatus_add_date'      => date('Y-m-d H:i:s')
            );
            $this->db->insert('order_status',$orderstat);
            $ifd = $this->db->insert_id();
            return $this->db->where('orderstatus_id',$ifd)->update('order_status',array('orderstatusid'=>'ORDSTA'.$ifd));
        }
        return false;
    }
}