<?php
class Customers extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Customers",
			"content"  =>  'customers',
			"urlvalue"	=>	adminurl('viewCustomers/'),
		);
		$conditions=array();
		$dta["view"]            =   $this->customers_model->viewCustomers($conditions); 
		$this->load->view('admin/inner_template',$dta);
	}    
	public function viewCustomers($str){
	    $conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?0:$page;
		$keywords   =   $this->input->post('keywords');
		//$types      =   $this->input->post('types');
		//$status      =   $this->input->post('status');
		//$school_id  =    $this->session->userdata("login_types")?$this->session->userdata("login_types"):'';
		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"customerid";  
		$totalRec               =   $this->customers_model->cntviewCustomers($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewCustomers/');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   adminurl("viewCustomers/");
		$dta["view"]            =   $this->customers_model->viewCustomers($conditions); 
		$this->load->view("ajax_customers",$dta);
	}
	public function ajax_customers_active(){
			$status     =   $this->input->post("status");
			$uri        =   $this->input->post("fields");
			$params["whereCondition"]   =   "customer_id = '".$uri."'";
			$vue    =   $this->customers_model->getCustomers($params);
			if(is_array($vue) && count($vue) > 0){
				$bt     =   $this->customers_model->activedeactive($uri,$status); 
				if($bt > 0){
					$vsp    =   1;
				}
			}else{
				$vsp    =   2;
			}
		echo $vsp;
	}
	public function delete_customers(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "customer_id = '".$uri."'";
		$vue    =   $this->customers_model->getCustomers($params);
		if(count($vue) > 0){
			$bt     =   $this->customers_model->delete_customers($uri); 
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