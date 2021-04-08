<?php
class Orders extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function create(){
		$dta    =   array(
			"title"     =>  "Create Orders Form",
			"content"  =>  'create_orders'
		);
		if($this->input->post('publish')){
			$this->form_validation->set_rules('name','Orders Name','required');
			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
			$this->form_validation->set_rules('Percentage','Percentage','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->orders_model->create();     
                if($res == TRUE){
                    $this->session->set_flashdata("suc","Created Orders successfully.");
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/template',$dta);
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Orders",
			"content"  =>  'orders',
			"urlvalue"	=>	base_url('viewOrders')
		);
		$this->load->view('admin/template',$dta);
	}/*
	public function orders($str){
        //$vsp	=	$this->orders_model->unique_id_orders($str); 
        // if($vsp){
        //     $this->form_validation->set_message("orders","Orders Name already exists.");
        //     return FALSE;
        // }
        return TRUE; 
    }
	public function viewOrders($str){
	    $conditions =   array();
		$page       =   $this->uri->segment('2');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords');
		//$types      =   $this->input->post('types');
		//$status      =   $this->input->post('status');
		//$school_id  =    $this->session->userdata("login_types")?$this->session->userdata("login_types"):'';
		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"ordersid";  
		$totalRec               =   $this->orders_model->cntviewOrders($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   base_url('viewOrders');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   base_url("viewOrders/");
		$dta["view"]            =   $this->orders_model->viewOrders($conditions); 
		$this->load->view("orders/ajax_orders",$dta);
	}
	public function ajax_orders_active(){
			$status     =   $this->input->post("status");
			$uri        =   $this->input->post("fields");
			$params["whereCondition"]   =   "orders_id = '".$uri."'";
			$vue    =   $this->orders_model->getOrders($params);
			if(is_array($vue) && count($vue) > 0){
				$bt     =   $this->orders_model->activedeactive($uri,$status); 
				if($bt > 0){
					$vsp    =   1;
				}
			}else{
				$vsp    =   2;
			}
		echo $vsp;
	}
	
	public function update_orders($str){
        $pmrs["whereCondition"]  =   "orders_id LIKE  '".$str."'";
        $vsp	=	$this->orders_model->getOrders($pmrs);
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update orders",
    			"content"   =>  "orders/update_orders",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post('submit')){
			$this->form_validation->set_rules('Name','Orders Name','required');
                if($this->form_validation->run() == TRUE){
                    $res = $this->orders_model->update_orders($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Orders succfully.");
                        redirect(base_url('Admin/Orders'));
                    }else{
                        $this->session->set_flashdata("err","update Orders failed.");
                    }
    	        }
    	    }
		    $this->load->view("template",$dta); 
        }
	}
	public function delete_orders(){
		$uri    =   $this->uri->segment("2");
		$params["whereCondition"]   =   "orders_id = '".$uri."'";
		$vue    =   $this->orders_model->getOrders($params);
		if(count($vue) > 0){
			$bt     =   $this->orders_model->delete_orders($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}*/
	
}
?>