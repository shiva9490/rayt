<?php
class discount extends CI_Controller{
	public function __construct() {
		parent::__construct();
		//echo $this->session->userdata("restraint_id");exit;
		if($this->session->userdata("restraint_id") == ''){
			redirect(sitedata("site_partner")."/Login"); 
		}
	}
	public function create(){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
		$dta    =   array(
			"title"     =>  "Create Discount Form",
			"content"  =>  'create_discount',
			"category"		=>  $this->menu_model->viewCategory($par),
			"subcategory"	=>  $this->menu_model->viewSubCategory($par),
			"items"			=>  $this->menu_model->viewItems($par),
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('discount_type','Discount Type','required');
			$this->form_validation->set_rules('date','Valid Date','required');
			$this->form_validation->set_rules('min_discount','Minimum Discount Amount','required');
			$this->form_validation->set_rules('discount','Discount','required');
			$this->form_validation->set_rules('typeofcust','Type of customer','required');
			$this->form_validation->set_rules('strt_time','Start Time','required');
			$this->form_validation->set_rules('end_time','End Time','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->discount_model->create();
                if($res != ''){
                    $this->session->set_flashdata("suc","Created Discount successfully."); //Update menu and items on bottom of the page
                     redirect(base_url('Partner-Admin/Discount'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('partner/inner_template',$dta);
	}
	/*public function index(){
		//echo "hi";exit;
		$restid = $this->session->userdata("restraint_id");
	
		$dta    =   array(
			"title"     =>  "Discount List",
			"content"  =>  'discount',
			"urlvalue"		=>	partnerurl('viewDiscount/'),
		);
		
		$this->load->view('partner/inner_template',$dta);
	}*/
	public function index(){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
		$dta    =   array(
			"title"     	=>  "Discount List",
			"content"  		=>  'discount',
			"urlvalue"		=>	partnerurl('viewDiscount/'),
		);
		$conditions=array();
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"discountid";  
		$totalRec               =   $this->discount_model->cntviewDiscount($conditions);
		if(!empty($orderby) && !empty($tipoOrderby)){
			$conditions['order_by']      =   $orderby;
			$conditions['tipoOrderby']   =   $tipoOrderby; 
			$conditions['limit']   		 =   $perpage; 
		}
		$dta["view"]            =   $this->discount_model->viewDiscount($conditions); 
		$dta['urlvalue']		=   partnerurl('ViewDiscount/');
		$this->load->view('partner/inner_template',$dta);
	}
	public function update_discount($str){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
        $pmrs["whereCondition"]  =   "discount_id LIKE  '".$str."'";
        $vsp	=	$this->discount_model->getDiscount($pmrs);
		$con['whereCondition'] = "discount_items_discount_id ='".$vsp[0]['discount_id']."' AND discount_items_open = '1'";
        $cate  =   $this->discount_model->viewDiscountItems($con); 
        $catt=array();$prod=array();
        foreach($cate as $ct){
            if(!in_array($ct->discount_items_category_id, $catt, true)){
                array_push($catt, $ct->discount_items_category_id);
            }
            array_push($prod, $ct->discount_items_item_id);
        }
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update discount",
    			"content"   =>  "update_discount",
    			"view"      =>  $vsp[0],
				"catt"		=> 	$catt,
				"prod"		=> 	$prod,
				"category"		=>  $this->menu_model->viewCategory($par),
    		);
    	    if($this->input->post('update')){
				//echo '<pre>';print_r($this->input->post());exit;
				$this->form_validation->set_rules('discount_type','Discount Type','required');
				$this->form_validation->set_rules('date','Valid Date','required');
				$this->form_validation->set_rules('min_discount','Minimum Discount Amount','required');
				$this->form_validation->set_rules('discount','Discount','required');
				$this->form_validation->set_rules('typeofcust','Type of customer','required');
				$this->form_validation->set_rules('strt_time','Start Time','required');
				$this->form_validation->set_rules('end_time','End Time','required');
    			if($this->form_validation->run() == TRUE){
                    $res = $this->discount_model->update_discount($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Discount succfully.");
                        redirect(base_url('Partner-Admin/Discount'));
                    }else{
                        $this->session->set_flashdata("err","update Discount failed.");
                    }
    	        }
    	    }
		    $this->load->view("partner/inner_template",$dta); 
        }
	}
	
	
public function viewDiscount(){ 
	$conditions =   array();
	$page       =   $this->uri->segment('3');
	$offset     =   (!$page)?"0":$page;
	$keywords   =   $this->input->post('keywords'); 
	if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
	}
	$restid = $this->session->userdata("restraint_id");
	$par['whereCondition'] = "resturant_id = '".$restid."'";
	$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
	$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
	$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"discountid";  
	$totalRec               =   $this->discount_model->cntviewDiscount($conditions);  
	if(!empty($orderby) && !empty($tipoOrderby)){ 
		$dta['orderby']        =   $conditions['order_by']      =   $orderby;
		$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
	} 
	$config['base_url']     =   partnerurl('ViewDiscount/');
	$config['total_rows']   =   $totalRec;
	$config['per_page']     =   $perpage; 
	$config['link_func']    =   'searchFilter';
	$this->ajax_pagination->initialize($config);
	$conditions['start']    =   $offset;
	if($perpage != "all"){
		$conditions['limit']    =   $perpage;
	}
	$dta["urlvalue"]        =   partnerurl('ViewDiscount/');
	$dta["limit"]           =   $offset+1;
	$dta["view"]            =   $this->discount_model->viewDiscount($conditions); 
	$this->load->view("ajax_discount",$dta);
}
public function ajax_discount_active(){
	$status     =   $this->input->post("status");
	$uri        =   $this->input->post("fields");
	$params["whereCondition"]   =   "discount_id = '".$uri."'";
	$vue    =   $this->discount_model->getDiscount($params);
	if(is_array($vue) && count($vue) > 0){
		$bt     =   $this->discount_model->activedeactive($uri,$status); 
		if($bt > 0){
			$vsp    =   1;
		}
	}else{
		$vsp    =   2;
	}
	echo $vsp;
}
public function delete_discount(){
	$uri    =   $this->uri->segment("3");
	$params["whereCondition"]   =   "discount_id = '".$uri."'";
	$vue    =   $this->discount_model->getDiscount($params);
	if(count($vue) > 0){
		$bt     =   $this->discount_model->delete_discount($uri); 
		if($bt > 0){
			$vsp    =   1;
		}
	}else{
		$vsp    =   2;
	} 
	echo $vsp;
}


}
?>