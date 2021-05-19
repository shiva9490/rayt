<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Order_model extends CI_Model{
        public function addtocart($dtas=array()){
            $view           =   $this->api_model->checkcustomer($this->input->post('customer_id'));
            $customer_id    =   $view["customer_id"];
            $par['whereCondition'] = "ct.cart_customer_id LIKE '".$customer_id."' AND ct.cart_resturant_id LIKE '".$this->input->post("restrant_id")."' AND ct.cart_resturant_item_id LIKE '".$this->input->post("item_id")."' AND ct.cart_acde LIKE '0'";
            $res = $this->viewcartproducts($par);
            //print_r(($res));exit;
            if(is_array($res) && count($res) > 0 ){
                foreach($res as $r){
                    $addons = $this->input->post('addons');
                    $add = explode(",",$addons);
                    $cartadd = explode(",",$r->cart_addons);
                    $i=0;
                    foreach($add as $key=>$adds){
                        if(array_key_exists($key,$cartadd)){
                            $i++;
                        }
                    }
                    $variants = $this->input->post('variants');
                    $var      = explode(",",$variants);
                    $cartvar  = explode(",",$r->cart_variants);
                    $j=0;
                    foreach($var as $key=>$vars){
                        if(array_key_exists($key,$cartvar)){
                            $j++;
                        }
                    }
                    if(($i == count($add))){
                        if(count($add) == count($cartadd)){
                            if($j == count($var)){
                                if(count($var) == count($cartvar)){
                                    $d = array('cart_quantity'=> $r->cart_quantity+ $this->input->post('quantity'),'cart_modified_on'=>$customer_id,'cart_modified_by'=>date('Y-m-d H:i:s'));
                                    return $this->db->where('cart_id',$r->cart_id)->update('cart_details',$d);
                                }else{
                                    return $this->inset($dtas);
                                }
                            }else{
                                return $this->inset($dtas);
                            }
                        }else{
                            return $this->inset($dtas);
                        }
                    }else{
                        return $this->inset($dtas);
                    }
                }
                return false;
            }else{
                return $this->inset($dtas);
            }
            return FALSE;
        }
        public function inset($dtas){
            $this->db->insert("cart_details",$dtas);
            if($this->db->insert_id() > 0){
                $this->db->where('cartid',$this->db->insert_id())->update('cart_details',array('cart_id'=>'CART'.$this->db->insert_id()));
                return TRUE;
            }
        }
        
        public function delete_cart(){
            $view           =   $this->api_model->checkcustomer();
            $customer_id    =   $view["customer_id"];
            $prms["whereCondition"]   =   "cart_acde = '0' AND cs.customer_id LIKE '".$customer_id."' OR cs.customer_token LIKE '".$customer_id."' AND rt.resturant_items_abc LIKE 'Active'";
            $dta  = $this->order_model->getcartproduct($prms);
            if(is_array($dta) && count($dta) > 0){
                $data  =    array(
                    'cart_open'         => '0',
                    'cart_acde'         => '1',
                    'cart_modified_by'  => date('Y-m-d H:i:s'),
                    'cart_modified_on'  => $customer_id,
                );
                return $this->db->where('cart_id',$this->input->post('cart_id'))->update('cart_details',$data);
            }else{
                return false;
            }
        }
        public function update_cart(){
            $view           =   $this->api_model->checkcustomer();
            $customer_id    =   $view["customer_id"];
            $prms["whereCondition"]   =   "cart_acde = '0' AND cs.customer_id LIKE '".$customer_id."' OR cs.customer_token LIKE '".$customer_id."' AND ct.cart_quantity LIKE '".$this->input->post('cart_id')."'";
            $dta  = $this->order_model->getcartproduct($prms);
           
            if(is_array($dta) && count($dta) >0){
                $data  =    array(
                    'cart_quantity'     => $this->input->post('qty'),
                    'cart_modified_by'  => date('Y-m-d H:i:s'),
                    'cart_modified_on'  => $customer_id,
                );
                return $this->db->where('cart_id',$this->input->post('cart_id'))->update('cart_details',$data);
            }else{
                return false;
            }
        }
        
        public function querycartproduct($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array( 
                    "ct.cart_open"      =>  "1",
                    "ct.cart_status"    =>  "1",
                );
                $this->db->select("$sel")
                        ->from("cart_details as ct")
                        ->join("customers as cs","ct.cart_customer_id = cs.customer_id","INNER")
                        ->join("resturant as rs","ct.cart_resturant_id = rs.resturant_id","INNER")
                        ->join("resturant_items as rt","ct.cart_resturant_item_id = rt.resturant_items_id","INNER")
                        ->join("resturant_category as rc","rt.resturant_category_id = rc.resturant_category_id","INNER")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(cart_quantity LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
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
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        public function cntviewcartproducts($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->querycartproduct($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewcartproducts($params = array()){
                return $this->querycartproduct($params)->result();
        }
        public function getcartproduct($params = array()){
                return $this->querycartproduct($params)->row_array();
        }
        public function checkout(){
            $view           =   $this->api_model->checkcustomer();
            $customer_id    =   $view["customer_id"];
            $res = $this->api_model->view_totalcart();
            $orders = array(
                'customer_id'        =>  $customer_id,
                'customeraddress_id' =>  $this->input->post('customeraddress_id'),
                'order_amount'       =>  ($res[0]['cart_pay_total']!="")?$res[0]['cart_pay_total']:$this->input->post('pay_total'),
                'order_item_count'   =>  ($res[0]['cart_quantity']!="")?$res[0]['cart_quantity']:$this->input->post('quantity'),
                'order_paymentid'    =>  ($this->input->post('payementid') !="")?$this->input->post('payementid'):'',
                'order_created_on'   =>  $customer_id,
                'order_created_by'   =>  date('Y-m-d H:i:s'),
                'order_status'       =>  'Active',
                'order_open'         =>  '1'
            );
            if($this->input->post('payment_type') == "COD"){
                $orders['order_type'] = 'COD';
            }else{
                $orders['order_type'] = 'Online Payment';
            }
            //print_r($orders);exit;
            $this->db->insert('orders',$orders);
            $ids = $this->db->insert_id();
            $uniq   =   'RAY'. str_pad($ids, 6, "0", STR_PAD_LEFT); 
            $this->db->where('orderid',$ids)->update('orders',array('order_id'=>'RAY'.$ids,'order_unique_id'=>$uniq));
            if($this->db->affected_rows() > 0){
                return $this->order_details('RAY'.$ids);
            }
            return FALSE;
        }
        public function order_details($id){
            $view           =   $this->api_model->checkcustomer();
            $customer_id    =   $view["customer_id"];
            $prms["whereCondition"]   =   "cart_acde = '0' AND cs.customer_id LIKE '".$customer_id."' OR cs.customer_token LIKE '".$customer_id."' AND rt.resturant_items_abc LIKE 'Active'";
            $res  = $this->order_model->viewcartproducts($prms);
            if(is_array($res) && count($res) > 0){
                foreach($res as $r){
                    $dat =  array(
                        'order_id'                       => $id,
                        'orderdetail_customer_id'        => $customer_id,
                        'orderdetail_restaurant_id'      => $r->cart_resturant_id,
                        'orderdetail_restaurant_item_id' => $r->cart_resturant_item_id,
                        'orderdetail_quantity'           => $r->cart_quantity,
                        'orderdetail_price'              => $r->cart_total,
                        'orderdetail_addons'             => $r->cart_addons,
                        'orderdetail_variants'           => $r->cart_variants,
                        'orderdetail_created_on'         => date('Y-m-d H:i:s'),
                        'orderdetail_created_by'         => $customer_id,
                    );
                    $this->db->insert('order_details',$dat);
                    $ids = $this->db->insert_id();
                    $uniq   =   'RAYORD'. str_pad($ids, 6, "0", STR_PAD_LEFT);
                    $this->db->where('orderdetailsid',$ids)->update('order_details',array('orderdetails_id'=> 'RATORD'.$ids,'orderdetails_unique_id'=>$uniq));
                    $addons     = explode(",",$r->cart_addons);
                    if(is_array($addons) && count($addons) > 0){
                        foreach($addons as $a){
                            $adds = $this->common_config->clean($a);
                            $par['whereCondition'] = "rt.resturant_id LIKE '".$r->cart_resturant_id."' AND  rt.resturant_items_id LIKE '".$r->cart_resturant_item_id."' AND ral.resturant_addon_listid LIKE '".$adds."' ";
                            $res = $this->menu_model->getAddon($par);
                            if(is_array($res) && count($res) > 0){
                                foreach($res as $res){
                                    $dds = array(
                                        'order_id'            => $id,
                                        'order_details_id'    => 'RATORD'.$ids,
                                        'orderassons_type'    => 'Addon',
                                        'orderassons_id'      => $res['resturant_addon_listid'],
                                        'orderassons'         => $res['resturant_addonitem'],
                                        'orderassons_amount'  => $res['resturant_addonitem_amount'],
                                    );
                                    $this->db->insert('orderassons',$dds);
                                    $ifd = $this->db->insert_id();
                                    $this->db->where('orderassonid',$ifd)->update('orderassons',array('orderasson_id'=>'ORDADDON'.$ifd));
                                }
                            }
                        }
                    }
                    $variants     = explode(",",$r->cart_variants);
                    if(is_array($variants) && count($variants) > 0){
                        foreach($variants as $v){
                            $vans = $this->common_config->clean($v);
                            $pars['whereCondition'] = "rv.resturant_id LIKE '".$r->cart_resturant_id."' AND  rv.resturant_variants_id LIKE '".$vans."'";
                            $ress = $this->menu_model->getVariants($pars);
                            if(is_array($ress) && count($ress) > 0){
                                foreach($ress as $ress){
                                    $ddse = array(
                                        'order_id'            => $id,
                                        'order_details_id'    => 'RATORD'.$ids,
                                        'orderassons_type'    => 'Variants',
                                        'orderassons_id'      => $ress['resturant_variants_id'],
                                        'orderassons'         => $ress['resturant_variants'],
                                        'orderassons_amount'  => $ress['resturant_variants_price'],
                                    );
                                    $this->db->insert('orderassons',$ddse);
                                    $ifd = $this->db->insert_id();
                                    $this->db->where('orderassonid',$ifd)->update('orderassons',array('orderasson_id'=>'ORDADDON'.$ifd));
                                }
                            }
                        }
                    }
                    $parse['whereCondition'] = "ost.order_id LIKE '".$id."'";
                    $ordst = $this->getOrderDetails($parse);
                    if(is_array($ordst)&& count($ordst) > 0){
                    }else{
                        $orderstatus = $this->config->item('orderstatus');
                        $orderstat= array(
                            'order_id'                  => $id,
                            'orderdetail_restaurant_id' => 'RATORD'.$ids,
                            'orderdetail_status'        => $orderstatus[0],
                            'orderstatus_add_by'        => $customer_id,
                            'orderstatus_add_date'      => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('order_status',$orderstat);
                        $shi = $this->db->insert_id();
                        $this->db->where('orderstatus_id',$shi)->update('order_status',array('orderstatusid'=>'ORDSTA'.$shi));
                    }
                    /*----------Delete cart-----------*/
                    $data  =    array(
                        'cart_acde'         => '1',
                        'cart_modified_by'  => date('Y-m-d H:i:s'),
                        'cart_modified_on'  => $customer_id,
                    );
                    $this->db->where('cart_id',$r->cart_id)->update('cart_details',$data);
                    /*----------Delete cart-----------*/
                }
                return true;
            }else{
                return false;
            }
            
        }
        
        /*----------------------Oredr Data------------------------*/
        public function queryOrders($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array(
                    "order_open"        =>  "1",
                    "orderdetail_open"  =>  "1",
                );
                $this->db->select("$sel")
                        ->from("orders as or")
                        ->join("order_details as ord","ord.order_id = or.order_id","INNER")
                        ->join("resturant as rt","ord.orderdetail_restaurant_id = rt.resturant_id","INNER")
                        ->join("customers as cs","cs.customer_id = or.customer_id","INNER")
                        ->join("customer_address as cadd","cadd.customeraddress_id = or.customeraddress_id","INNER")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(orders LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
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
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        public function cntviewOrders($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryOrders($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewOrders($params = array()){
                return $this->queryOrders($params)->result();
        }
        public function getOrders($params = array()){
                return $this->queryOrders($params)->row_array();
        }
        public function viewOrderDetails($params = array()){
                return $this->queryOrderDetails($params)->result();
        }
        public function getOrderDetails($params = array()){
                return $this->queryOrderDetails($params)->row_array();
        }
        public function queryOrderDetails($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array(
                    "order_open"        =>  "1",
                    "orderdetail_open"  =>  "1",
                );
                $this->db->select("$sel")
                        ->from("order_details as ord")
                        ->join("orders as or","ord.order_id = or.order_id","INNER")
                        ->join("resturant_items as rt","ord.orderdetail_restaurant_item_id = rt.resturant_items_id","INNER")
                        ->join("resturant as res","res.resturant_id = rt.resturant_id","INNER")
                        ->join("customers as cs","cs.customer_id = or.customer_id","INNER")
                        ->join("order_status as ost","ost.order_id = ord.order_id","Left")
                        ->join("customer_address as cadd","cadd.customeraddress_id = or.customeraddress_id","INNER")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(orders LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
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
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        public function order_accect($param = array()){
            $orderstatus = $this->config->item('orderstatus');
            $ds = array();
            $k= 0;
            foreach($orderstatus as $key=>$oct){
                if($oct == $this->input->post('status')){
                    $k = $key+1;
                    $ds = $orderstatus[$k];
                }
                $k++;
            }
            if($this->input->post("accepted")!="" && $this->input->post("accepted") == "rejected" || $this->input->post('Cancle')){
                $d = "Order Cancelled";
            }else{
                $d = $ds;
            }
            //print_r($d);exit;
            if(is_array($param) && count($param) > 0){
                foreach($param as $ord){
                    //echo '<pre>';print_r($ord);exit;
                    $data = array(
                        'orderdetails_rest_staus' => $d,
                        'orderdetail_modified_on' => date('Y-m-d H:i:s'),
                        'orderdetail_modified_by' => ($this->input->post("restrant_id")!="")?$this->input->post("restrant_id"):$this->session->userdata("restraint_id"),
                    );
                    $this->db->where('orderdetails_id',$ord->orderdetails_id)->update('order_details',$data);
                    
                    /*=========================================*/
                    $parse['whereCondition'] = "ost.order_id LIKE '".$ord->order_id."' AND ost.orderdetail_status LIKE '".$d."' AND ord.orderdetail_restaurant_id LIKE '".$this->session->userdata("restraint_id")."'";
                    $ordst = $this->getOrderDetails($parse);
                    if(is_array($ordst)&& count($ordst) > 0){
                    }else{
                        $orderstat= array(
                            'order_id'                  => $ord->order_id,
                            'orderdetail_restaurant_id' => $ord->orderdetails_id,
                            'orderdetail_status'        => $d,
                            'orderstatus_add_by'        => ($this->input->post("restrant_id")!="")?$this->input->post("restrant_id"):$this->session->userdata("restraint_id"),
                            'orderstatus_add_date'      => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('order_status',$orderstat);
                        $ifd = $this->db->insert_id();
                        $this->db->where('orderstatus_id',$ifd)->update('order_status',array('orderstatusid'=>'ORDSTA'.$ifd));
                    }
                    /*=========================================*/
                }
                return true;
            }else{
                return false;
            }
        }
        /*----------------------/Oredr Data------------------------*/
        /*----------------------/orderassons ------------------------*/
        public function cntviewOrderasson($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryOrderasson($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewOrderasson($params = array()){
                return $this->queryOrderasson($params)->result();
        }
        public function getOrderasson($params = array()){
                return $this->queryOrderasson($params)->row_array();
        }
        
        public function queryOrderasson($params = array()){
                $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array(
                    "orderassons_open"      =>  "1",
                    "orderassons_status"    =>  "1",
                );
                $this->db->select("$sel")
                        ->from("orderassons")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(orderasson_id LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
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
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        
        public function viewOrderStatus($params = array()){
                return $this->queryOrderStatus($params)->result();
        }
        public function getOrderStatus($params = array()){
                return $this->queryOrderStatus($params)->result_array();
        }
        public function queryOrderStatus($params = array()){
                $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array(
                    "orderstatus_open"      =>  "1",
                    "orderstatus_status"    =>  "1",
                );
                $this->db->select("$sel")
                        ->from("order_status")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(orderdetails_unique_id LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
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
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        
        /*----------------------/orderassons ------------------------*/
}