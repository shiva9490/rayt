<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Order extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("restraint_id") == ''){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Orders History",
			"content"  =>  'order_history',
			"urlvalue"	=>	partnerurl('viewOrders')
		);
		$conditions=array();
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"resturant_itemid";  
		$totalRec               =   $this->menu_model->cntviewItems($conditions);
		if(!empty($orderby) && !empty($tipoOrderby)){
			$conditions['order_by']      =   $orderby;
			$conditions['tipoOrderby']   =   $tipoOrderby; 
			$conditions['limit']   		 =   $perpage; 
		}
		$dta['urlvalue']		=   partnerurl('ViewOrders/');
		$this->load->view('partner/inner_template',$dta);
	}
	public function order_list(){
		$dta    =   array(
			"title"     =>  "Order LIST",
			"content"  =>  'order_list',
			"urlvalue"	=>	partnerurl('viewOrders')
		);
		$conditions=array();
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"resturant_itemid";  
		$totalRec               =   $this->menu_model->cntviewItems($conditions);
		if(!empty($orderby) && !empty($tipoOrderby)){
			$conditions['order_by']      =   $orderby;
			$conditions['tipoOrderby']   =   $tipoOrderby; 
			$conditions['limit']   		 =   $perpage; 
		}
		$dta['urlvalue']		=   partnerurl('ViewOrders/');
		$this->load->view('partner/inner_template',$dta);
	}
	public function ViewOrders($str){
	    $conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords');
		$ids        =   $this->input->post('category');
		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		if(!empty($ids)){
			$status  = $ids;
		}else{
		    $status  = "Order Placed";
		}
		$orderstatus = $this->config->item('orderstatus');
		$conditions['whereCondition'] = "orderdetail_restaurant_id LIKE '".$this->session->userdata("restraint_id")."' AND orderdetails_rest_staus LIKE '".$status."'";
		$orders   =   $this->input->post('orders');
		$conditions['group_by'] = "order_unique_id";
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'30';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";
		$totalRec       =   $this->order_model->cntviewOrders($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   partnerurl('ViewOrders');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["orders"]          =   $this->input->post('orders')?$this->input->post('orders'):'';
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   partnerurl("ViewOrders/");
		$dta["view"]            =   $this->order_model->viewOrders($conditions);
		$this->load->view("ajax_orders",$dta);
	}
	
	public function update_orders($str){
        $pmrs["whereCondition"]  =   "orders_id LIKE  '".$str."'";
        $vsp	=	$this->order_model->getOrders($pmrs);
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update orders",
    			"content"   =>  "orders/update_orders",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post('submit')){
			$this->form_validation->set_rules('Name','Orders Name','required');
                if($this->form_validation->run() == TRUE){
                    $res = $this->order_model->update_orders($str);     
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
		$vue    =   $this->order_model->getOrders($params);
		if(count($vue) > 0){
			$bt     =   $this->order_model->delete_orders($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}
	
	public function order_details(){
	    //print_r($this->input->post());exit;
	    if($this->input->post('eve')!=""){
	        if($this->input->post('restraint_id')!=""){
	           $restraint_id = $this->input->post('restraint_id');
	        }else{
	            $restraint_id = $this->session->userdata("restraint_id");
	        }
	       $par['whereCondition'] = "order_unique_id LIKE '".$this->input->post('eve')."' AND ord.orderdetail_restaurant_id LIKE '".$restraint_id."'";
	       $par['group_by'] = "ord.orderdetail_restaurant_item_id";
	       $res = $this->order_model->viewOrderDetails($par);
	       //print_r($res);exit;
	       $data = array(
	            'title' =>$this->input->post('eve'),
	            'types' =>$this->input->post('types'),
	            'status' =>$this->input->post('status'),
	            'data'  => $res,
	       );
	    }
	    $this->load->view('ajax_popup',$data);
	}
	public function order_accect(){
	    if($this->input->post()!=""){
	        $eve = $this->input->post('eve');
	        $status = $this->input->post('status');
	        $restid = $this->input->post('restid');
	        $par['columns']        =   "ord.order_id AS orderids,or.*,ord.*,rt.*,res.*,cs.*,ost.*,cadd.*,drso.*,dr.*";
	        $he = ($this->session->userdata("restraint_id")!="")?$this->session->userdata("restraint_id"):$restid;
	        $par['whereCondition'] = "order_unique_id LIKE '".$this->input->post('eve')."' AND ord.orderdetail_restaurant_id LIKE '".$he."' AND orderdetails_rest_staus LIKE '".$status."'";
	        $results = $this->order_model->viewOrderDetails($par);
	        //echo '<pre>';print_r($results);exit;
	        if(is_array($results) && count($results) > 0){
    	        $res = $this->order_model->order_accect($results);
    	        if($res){
    	            echo 1;
    	        }else{
    	            echo 0;
    	        }
	        }
	    }else{
	        echo 2;
	    }
	}
	public function payment(){
	    $extraMerchantsData = array(
                            'amounts' => array(10,20),
                            'charges' => array(1,5),
                            'chargeType' => array('percentage','percentage'),
                            'cc_charges' => array(1,5),
                            'cc_chargeType' => array('percentage','percentage'),
                            'ibans' => array('iban_number_of_vendor_1','iban_number_of_vendor_2')
                        );
	    
	    $fields = array(
            'merchant_id'=>'1201',
             'username' => 'test',
            'password'=>stripslashes('test'), 'api_key'=>'jtest123', // in sandbox request
             //'api_key' =>password_hash('API_KEY',PASSWORD_BCRYPT), //In production mode, please pass
            //API_KEY with BCRYPT function
            'order_id'=>time(), // MIN 30 characters with strong unique function (like hashing function with time)
            'total_price'=>'10',
            'CurrencyCode'=>'KWD',//only works in production mode
            'CstFName'=>'Test Name',
            'CstEmail'=>'test@test.com',
            'CstMobile'=>'12345678',
            'success_url'=> base_url().'.success.html',
            'error_url'=> base_url().'error.html',
            'test_mode'=>1, // test mode enabled
            'whitelabled'=>true, // only accept in live credentials (it will not work in test)
            'payment_gateway'=>'knet',// only works in production mode
            'ProductName'=>json_encode(['computer','television']),
            'ProductQty'=>json_encode([2,1]),
            'ProductPrice'=>json_encode([150,1500]),
            'reference'=>'Ref00001', // Reference that you want to show in invoice in ref column
            'ExtraMerchantsData'=>json_encode($extraMerchantsData)
        );
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output,true);
        print_r($server_output);exit;
        ?>
        <script>
            window.location.href= <?php $server_output['paymentURL']; ?> // javascript
        </script>
        <?php 
        header('Location:'.$server_output['paymentURL']); // PHP
	}
	
}
?>