<?php
class Discount_model extends CI_Model{
public function create(){
    $date   =   explode(' to ',$this->input->post('date'));
    $data = array(
        'discount_type'                     =>  $this->input->post('discount_type'), 
        'discount_min_value'                =>  $this->input->post('min_discount'),          
        'discount_discount'                 =>  $this->input->post('discount'),      
        'discount_cust_type'                =>  $this->input->post('typeofcust'),  
        'discount_applicable'               =>  $this->input->post('for_type'),      
        'discount_date_from'                =>  $date[0],          
        'discount_date_to'                  =>  $date[1],      
        'discount_time_from'                =>  $this->input->post('strt_time'),          
        'discount_time_to'                  =>  $this->input->post('end_time'),     
        'discount_cr_on'                    =>  date("Y-m-d h:i:s"),    
        'resturant_id'                      =>  $this->session->userdata("restraint_id"),
        'discount_cr_by'                    =>  $this->session->userdata("restraint_id"),     
        'discount_approve'                   =>  'Pending',
    );
	//echo '<pre>';print_r($data);exit;
    $this->db->insert("discount",$data);
    $vsp   =    $this->db->insert_id();
    if($vsp > 0){
        $dat=array(
			"discount_id" 			=> $vsp."DIS"
		);
		$id=$vsp;	
        $this->db->update("discount",$dat,"discountid='".$vsp."'");	
        if($this->input->post('for_type')=='Product Wise'){
            foreach($this->input->post('Prod') as $prodid)
            {   $restid = $this->session->userdata("restraint_id");
                $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$prodid."'";
                $par['columns']	    =   "resturant_category_id";
                $category           =   $this->menu_model->getItems($par);
                $data = array(
                    'discount_items_discount_id'        =>  $vsp."DIS",
                    'discount_items_category_id'        =>  $category['resturant_category_id'],         
                    'discount_items_item_id'            =>  $prodid,    
                    'resturant_id'                      =>  $restid,
                    'discount_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                    'discount_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                );
                $this->db->insert("discount_items",$data);
                $vs   =    $this->db->insert_id();
                if($vs > 0){
                    $dat=array(
                        "discount_items_id" 			=> $vs."DISI"
                    );
                    $this->db->update("discount_items",$dat,"discount_itemsid='".$vs."'");
                
                } 
            }
        }
        if($this->input->post('for_type')=='Category Wise'){
            foreach($this->input->post('cat') as $catid)
            { $restid = $this->session->userdata("restraint_id");
                $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_category_id = '".$catid."'";
                $par['columns']	="distinct(resturant_items_name),resturant_items_id ";
                $product           =   $this->menu_model->viewItems($par);
                foreach($product as $p){
                    $data = array(
                        'discount_items_discount_id'        =>  $vsp."DIS",
                        'discount_items_category_id'        =>  $catid,         
                        'discount_items_item_id'            =>  $p->resturant_items_id,    
                        'resturant_id'                      =>  $restid,  
                        'discount_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                        'discount_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                    );
                    $this->db->insert("discount_items",$data);
                    $vs  =    $this->db->insert_id();
                    if($vs > 0){
                        $dat=array(
                            "discount_items_id" 			=> $vs."DISI"
                        );
                        $this->db->update("discount_items",$dat,"discount_itemsid='".$vs."'");
                    
                    } 
                }
                
            }

		
		return TRUE;
       
    } 
    }
}
public function viewDiscount($params = array()){
    return $this->queryDiscount($params)->result();
}
public function getDiscount($params = array()){
    return $this->queryDiscount($params)->result_array();
}
public function queryDiscount($params = array()){
    $dt =   array(
        "discount_open"  	=> '1'
    );
    $sel        =   "*";
    if(array_key_exists("cnt",$params)){
        $sel    =   "count(*) as cnt";
    }
    if(array_key_exists("columns",$params)){
        $sel    =    $params["columns"];
    }
    $this->db->select($sel)
                ->from("discount")
                ->where($dt);
    if(array_key_exists("keywords",$params)){
            $this->db->where("(Discount_type LIKE '%".$params["keywords"]."%')");
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
  //$this->db->get();echo $this->db->last_query();exit;
    return  $this->db->get();
}

public function cntviewDiscount($params = array()){
    $params["cnt"]      =   "1";
    $val    =   $this->queryDiscount($params)->row_array();
    if(is_array($val) && count($val) > 0){
        return  $val['cnt'];
    }
    return "0";
}
public function activedeactive($uri,$status){
    $dat=array(
        "discount_abc"           => $status,
        "discount_md_by"     => $this->input->post("restrant_id"),
        "discount_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->where('discount_id',$uri)->update("discount",$dat);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function delete_discount($uro){
    $dta    =   array(
        "discount_open"            =>  0, 
        "discount_md_by"     => $this->input->post("restrant_id"),
        "discount_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->update("discount",$dta,array("discount_id" => $uro));
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function update_discount($id){
    $date   =   explode(' to ',$this->input->post('date'));
    $data  = array(
        'discount_type'                     =>  $this->input->post('discount_type'), 
        'discount_min_value'                =>  $this->input->post('min_discount'),          
        'discount_discount'                 =>  $this->input->post('discount'),      
        'discount_cust_type'                =>  $this->input->post('typeofcust'), 
        'discount_applicable'               =>  $this->input->post('for_type'),       
        'discount_date_from'                =>  $date[0],          
        'discount_date_to'                  =>  $date[1],      
        'discount_time_from'                =>  $this->input->post('strt_time'),          
        'discount_time_to'                  =>  $this->input->post('end_time'),          
        'discount_cr_on'                    =>  date("Y-m-d h:i:s"),    
    );
    $this->db->where('discount_id',$id)->update('discount',$data);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        $dtaaaa    =   array(
            "discount_items_open"    =>  0, 
            "discount_items_md_by"   => $this->session->userdata("restraint_id"),
            "discount_items_md_on"   => date('Y-m-d H:i:s')
        );
        $this->db->update("discount_items",$dtaaaa,array("discount_items_discount_id" => $id));
        if($this->input->post('for_type')=='Product Wise'){ 
            foreach($this->input->post('Prod') as $prodid)
            { 
                $restid = $this->session->userdata("restraint_id");
                $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$prodid."'";
                $par['columns']	    =   "resturant_category_id";
                $category           =   $this->menu_model->getItems($par);
                $paa['whereCondition']  =   "discount_items_discount_id = '".$id."'AND discount_items_category_id ='".$category[0]['resturant_category_id']."'  AND discount_items_item_id = '".$prodid."'";
                $vsss   = $this->discount_model->getDiscountItems($paa);
                if($vsss){
                    $dtaaa    =   array(
                        "discount_items_open"    =>  1, 
                        "discount_items_md_by"   => $this->session->userdata("restraint_id"),
                        "discount_items_md_on"   => date('Y-m-d H:i:s')
                    );
                    $this->db->update("discount_items",$dtaaa,array("discount_items_id" => $vsss[0]['discount_items_id']));
                }else{
                    $data = array(
                        'discount_items_discount_id'        =>  $id,
                        'discount_items_category_id'        =>  $category[0]['resturant_category_id'],         
                        'discount_items_item_id'            =>  $prodid,    
                        'discount_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                        'discount_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                    );
                    $this->db->insert("discount_items",$data);
                    $vs   =    $this->db->insert_id();
                    if($vs > 0){
                        $dat=array(
                            "discount_items_id" 			=> $vs."DISI"
                        );
                        $this->db->update("discount_items",$dat,"discount_itemsid='".$vs."'");
                    
                    } 
                }
                
            }
        }
        if($this->input->post('for_type')=='Category Wise'){
            foreach($this->input->post('cat') as $catid)
            { 
                $restid = $this->session->userdata("restraint_id");
                $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_category_id = '".$catid."'";
                $par['columns']	="distinct(resturant_items_name),resturant_items_id ";
                $product           =   $this->menu_model->viewItems($par);
                foreach($product as $p){
                    $paa['whereCondition']  =   "discount_items_discount_id = '".$id."'AND discount_items_category_id ='".$catid."'  AND discount_items_item_id = '".$p->resturant_items_id."'";
                    $vsss   = $this->discount_model->getDiscountItems($paa);
                    if($vsss){
                        $dtaaa    =   array(
                            "discount_items_open"    =>  1, 
                            "discount_items_md_by"   => $this->session->userdata("restraint_id"),
                            "discount_items_md_on"   => date('Y-m-d H:i:s')
                        );
                        $this->db->update("discount_items",$dtaaa,array("discount_items_id" => $vsss[0]['discount_items_id']));
                    }else{
                        $data = array(
                            'discount_items_discount_id'        =>  $id,
                            'discount_items_category_id'        =>  $catid,         
                            'discount_items_item_id'            =>  $p->resturant_items_id,    
                            'discount_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                            'discount_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                        );
                        $this->db->insert("discount_items",$data);
                        $vs  =    $this->db->insert_id();
                        if($vs > 0){
                            $dat=array(
                                "discount_items_id" 			=> $vs."DISI"
                            );
                            $this->db->update("discount_items",$dat,"discount_itemsid='".$vs."'");
                        
                        } 
                    }
                }
                
            }
        }
    }
    return TRUE;
} 
public function viewDiscountItems($params = array()){
    return $this->queryDiscountItems($params)->result();
}
public function getDiscountItems($params = array()){
    return $this->queryDiscountItems($params)->result_array();
}
public function queryDiscountItems($params = array()){
    $dt =   array(
    );
    $sel        =   "*";
    if(array_key_exists("cnt",$params)){
        $sel    =   "count(*) as cnt";
    }
    if(array_key_exists("columns",$params)){
        $sel    =    $params["columns"];
    }
    $this->db->select($sel)
                ->from("discount_items as di")
                ->join("resturant_items as ri",'ri.resturant_items_id=di.discount_items_item_id and ri.resturant_id = di.resturant_id','LEFT')
                ->join("resturant_category as rc",'rc.resturant_category_id=di.discount_items_category_id  and rc.resturant_id = di.resturant_id','LEFT')
                ->where($dt);
    if(array_key_exists("keywords",$params)){
            $this->db->where("(DiscountItems_type LIKE '%".$params["keywords"]."%')");
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
  //$this->db->get();echo $this->db->last_query();exit;
    return  $this->db->get();
}

public function cntviewDiscountItems($params = array()){
    $params["cnt"]      =   "1";
    $val    =   $this->queryDiscountItems($params)->row_array();
    if(is_array($val) && count($val) > 0){
        return  $val['cnt'];
    }
    return "0";
}
public function delete_discount_items($uro){
    $dta    =   array(
        "discount_items_open"            =>  0, 
        "discount_items_md_by"     => $this->session->userdata("restraint_id"),
        "discount_items_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->update("discount_items",$dta,array("discount_items_id" => $uro));
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function add_discount_item($id){
    foreach($this->input->post('items') as $itemid)
    {
        $restid = $this->session->userdata("restraint_id");
	    $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$itemid."'";
        $category		=  $this->menu_model->getItems($par);
        $cat    =    $category[0]['resturant_category_id'];
        $pars['whereCondition'] = "di.resturant_id = '".$restid."' AND discount_items_item_id = '".$itemid."'  AND discount_items_category_id = '".$cat."' AND discount_items_discount_id = '".$id."'";
        $vsp		=  $this->discount_model->getDiscountItems($pars);
        if($vsp){
            $dta    =   array(
                "discount_items_open"            =>  1, 
                "discount_items_md_by"     => $this->session->userdata("restraint_id"),
                "discount_items_md_on"   => date('Y-m-d H:i:s')
            );//echo '<pre>';print_r($dta);echo $vsp[0]['discount_items_id'];exit;
            $this->db->update("discount_items",$dta,array("discount_items_id" => $vsp[0]['discount_items_id'])); 
        }else{
            $data = array(
                'discount_items_discount_id'        =>  $id,
                'discount_items_category_id'        =>  $cat,         
                'discount_items_item_id'            =>  $itemid,  
                'resturant_id'                      =>  $this->session->userdata("restraint_id"),   
                'discount_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                'discount_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
            );
            $this->db->insert("discount_items",$data);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $dat=array(
                    "discount_items_id" 			=> $vsp."DISI"
                );	
                $this->db->update("discount_items",$dat,"discount_itemsid='".$vsp."'");
            
            } 
        }
        
    }return true;
}
public function add_discount_category($id){
    $str	= $this->input->post('category');
	$restid = $this->session->userdata("restraint_id");
	$par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_category_id = '".$str."'";
	$items = $this->menu_model->viewItems($par);
    if(count($items)>0){
        foreach($items as $itemid)
        { 
            $restid = $this->session->userdata("restraint_id");
            $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$itemid->resturant_items_id."'";
            $category		=  $this->menu_model->getItems($par);
            $cat    =    $category[0]['resturant_category_id'];
            $pars['whereCondition'] = "di.resturant_id = '".$restid."' AND discount_items_item_id = '".$itemid->resturant_items_id."'  AND discount_items_category_id = '".$cat."'";
            $vsp		=  $this->discount_model->getDiscountItems($pars);
            if($vsp){
                $dta    =   array(
                    "discount_items_open"            =>  1, 
                    "discount_items_md_by"     => $this->input->post("restrant_id"),
                    "discount_items_md_on"   => date('Y-m-d H:i:s')
                );
                $this->db->update("discount_items",$dta,array("discount_items_id" => $vsp[0]['discount_items_id'])); 
            }else{
                $data = array(
                    'discount_items_discount_id'        =>  $id,
                    'discount_items_category_id'        =>  $cat,         
                    'discount_items_item_id'            =>  $itemid->resturant_items_id,  
                    'resturant_id'                      =>  $this->session->userdata("restraint_id"),   
                    'discount_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                    'discount_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                );
                //echo '<pre>';print_r($data);exit;
                $this->db->insert("discount_items",$data);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $dat=array(
                        "discount_items_id" 			=> $vsp."DISI"
                    );	
                    $this->db->update("discount_items",$dat,"discount_itemsid='".$vsp."'");
                
                } 
            }
            
        }return true;
    }
    return false;
}
	
	

}
?>