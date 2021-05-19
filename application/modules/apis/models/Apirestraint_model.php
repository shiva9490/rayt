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
            $dta['distance']              = ($dista!="")?$dista:'';
            $dta['time']                  = ($time!="")?$time:'';
        }
        return $dta;
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
        $par['whereCondition'] ="resturant_id LIKE  '".$resturant_id."' AND resturant_category_id LIKE '".$category_id."' AND resturant_items_abc = 'Active'";
        $item = $this->menu_model->viewItems($par);
        $dta = array();
        if(is_array($item) && count($item) > 0 ){
            foreach($item as $key=>$c){
                $deflet = $this->apirestraint_model->item_variants($resturant_id,$c->resturant_items_id);
                $defprince='0';
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
        if(is_array($res) && count($res) >0){
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
        if(is_array($res) && count($res) >0){
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
        if(is_array($res) && count($res) >0){
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
        //print_r($conditions);exit;
        $data = array();
        if(is_array($res) && count($res) > 0){
            foreach($res as $key=>$r){
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
    public function viewneworder(){
        $par['whereCondition']  =  "or.order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$this->input->post("status")."'";
	    $par['group_by']        =  "ost.orderdetail_status";
	    $results = $this->order_model->viewOrderDetails($par);
	    $data = array();
	    if(is_array($results) && count($results) > 0){
	        foreach($results as $key=>$r){
	            $data['billing']['unique_id']            =  $r->order_unique_id;
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
                $data['order_details']                   =  $this->order_details();
                $data['order_status']                    =  $this->order_status($r->order_id);
	        }
	    }
	    return $data;
    }
    public function order_details(){
        $par['whereCondition']  =  "or.order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$this->input->post("status")."'";
	    $par['group_by'] = "ord.orderdetails_unique_id";
	    $results = $this->order_model->viewOrderDetails($par);
	    $data = array();
	    if(is_array($results) && count($results) > 0){
	        $total = '0';
	        foreach($results as $key=>$r){
	            $this->vieworder($r->orderdetails_id);
	            $add = explode(",",json_decode($r->orderdetail_addons));
                $addons = array();$addonss= '0';
                if(is_array($add) && count($add) > 0){
                    foreach($add as $k=>$add){
                        $adds = $this->common_config->clean($add);
                        $pars['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$adds."'";
                        $res = $this->order_model->getOrderasson($pars);
                        $addons['name'][$k] = $res['orderassons'];
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
                        $parss['whereCondition'] = "order_id Like '".$r->order_id."' AND order_details_id LIKE '".$r->orderdetails_id."' AND  orderassons_id LIKE '".$variantss."'";
                        $ress = $this->order_model->getOrderasson($parss);
                        $variantam = $variantam+$ress['orderassons_amount'];
                        $var['name'][$k] = $ress['orderassons'];
                    }
                }
                $total = $total+($r->orderdetail_quantity * $r->orderdetail_price)+$addonss+$variantam;
                $variants  = implode(",",$var['name']);
	            $data['order_list'][$key]['order_unique_id']          = $r->orderdetails_unique_id;
	            $data['order_list'][$key]['items_name']               = $r->resturant_items_name;
	            $data['order_list'][$key]['items_name_a']             = $r->resturant_items_name_a;
	            $data['order_list'][$key]['items_type']               = $r->resturant_items_type;
	            $data['order_list'][$key]['quantity']                 = $r->orderdetail_quantity;
	            $data['order_list'][$key]['price']                    = $r->orderdetail_price;
	            $data['order_list'][$key]['addons']                   = $addons;
	            $data['order_list'][$key]['variants']                 = $variants;
	            $data['order_payments']['total']                      = $total;
	            $data['order_payments']['delivery']                   = '0';
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
                    }
                }else{
                    $tim='';
                    if($oct === "Ready for pickup"){
                        $p['whereCondition'] ="ord.order_id LIKE '".$id."'";
                        $ress = $this->order_model->getOrderDetails($p);
                        //print_r($t);exit;
                        $tims = explode(" ",$ress['resturant_zone_time']);
                        
                        $tim = date("H:i:s", strtotime($t)+($tims[0]*60));
                    }
                    $ds[$oct]  = $tim;
                }
            }
        }
        return $ds;
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
        $par['whereCondition'] = "order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."' AND orderdetails_rest_staus LIKE '".$this->input->post("status")."'";
        $results = $this->order_model->viewOrderDetails($par);
        //echo '<pre>';print_r($results);exit;
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
            //print_r($results);exit;
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
        $par['whereCondition'] = "order_unique_id LIKE '".$this->input->post("unique_id")."' AND ord.orderdetail_restaurant_id LIKE '".$this->input->post("restrant_id")."'";
        $results = $this->order_model->viewOrderDetails($par);
        if(is_array($results) && count($results) > 0){
            return $this->order_model->order_accect();
        }
        return false;
    }
}