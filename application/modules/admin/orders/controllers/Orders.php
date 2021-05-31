<?php
class Orders extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Orders",
			"content"   =>  'orders',
			"urlvalue"	=>	adminurl('viewOrders/')
		);
		if($this->input->get()){
			$keywords   =   $this->input->get('keywords');
			$ids        =   $this->input->get('category');
			if(!empty($keywords)){
				$conditions['keywords'] = $keywords;
			}
			$group  = "or.order_id";
			$ht = "or.order_status LIKE 'Active'";
			if($ids == "Today Orders"){
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%'";
			}elseif($ids == "Unassigned"){
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%' AND ord.orderdetails_rest_staus LIKE 'Order Placed'";
			}elseif($ids == "Pending"){
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%' AND ord.orderdetails_rest_staus LIKE 'Preparing'";
			}elseif($ids == "Received" || $ids == "Ready for Pickup"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'Ready for pickup'";
			}elseif($ids == "Completed Pickup"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'Completed Pickup'";
			}elseif($ids == "Arraived at customes"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'arrived order'";
			   //$group  = "or.order_id";
			}elseif($ids == "Delivered"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'Delivered'";
			}else{
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%'";
			}
			$date	= explode(" to ",$this->input->get('date'));
			if(count($date)>0){
				$ht	.=	" AND orderdetail_created_on >= '$date[0]' AND orderdetail_created_on <='$date[1]'";
			}
			$orderstatus = $this->config->item('orderstatus');
			$conditions['whereCondition']   = $ht;
			$conditions['group_by']         = $group;
			$orders   =   $this->input->get('orders');   
			$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
			$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";
			$conditions['columns']	=	'count(distinct order_unique_id) as cnt';
			$totalRec               =   count($this->order_model->viewOrders($conditions));
			$conditions['columns']	=	'';
			if(!empty($orderby) && !empty($tipoOrderby)){
				$dta['orderby']        =   $conditions['order_by']      =   $orderby;
				$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
			}
			if($this->input->get('excel') ){
				$this->session->set_flashdata("suc"," Check Downloads for Excel");
				$conditions['file_name']   =   'Orders Report ['.date("YmdHis").'].csv';
				$conditions['columns'] = "order_unique_id,customer_name,customer_mobile,order_type,order_amount,orderdetails_rest_staus,orderdetail_created_on";
				$this->order_model->download_autogen_excel($conditions);
			}
			if($this->input->get('pdf') ){
				$this->session->set_flashdata("suc"," Check Downloads for Excel");
				$conditions['file_name']   =   'Orders Report ['.date("YmdHis").'].pdf';
				$conditions['columns'] = "order_unique_id,customer_name,customer_mobile,order_type,order_amount,orderdetails_rest_staus,orderdetail_created_on";
				$this->order_model->download_pdf($conditions);
			}
			
		}
		$this->load->view("admin/inner_template",$dta);
	}
	public function viewOrders(){
	    $page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords');
		$ids        =   $this->input->post('category');
		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		$group  = "or.order_id";
		$ht = "or.order_status LIKE 'Active'";
		if($ids == "Today Orders"){
		    $ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%'";
		}elseif($ids == "Unassigned"){
		    $ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%' AND ord.orderdetails_rest_staus LIKE 'Order Placed'";
			$dta["delay"]	="1"; 
		}elseif($ids == "Pending"){
		    $ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%' AND ord.orderdetails_rest_staus LIKE 'Preparing'";
		}elseif($ids == "Received" || $ids == "Ready for Pickup"){
		    $ht  = "ord.orderdetails_rest_staus LIKE 'Ready for pickup'";
			$dta["delay"]	="1"; 
		}elseif($ids == "Completed Pickup"){
		    $ht  = "ord.orderdetails_rest_staus LIKE 'Completed Pickup'";
		}elseif($ids == "Arraived at customes"){
		    $ht  = "ord.orderdetails_rest_staus LIKE 'arrived order'";
			$dta["delay"]	="5"; 
		   //$group  = "or.order_id";
		}elseif($ids == "Delivered"){
		    $ht  = "ord.orderdetails_rest_staus LIKE 'Delivered'";
		}else{
		    $ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%'";
		}
		$date	= explode(" to ",$this->input->post('date'));
		if(count($date)>1){
			$ht	.=	" AND orderdetail_created_on >= '$date[0]' AND orderdetail_created_on <='$date[1]'";
		}
		$orderstatus = $this->config->item('orderstatus');
		$conditions['whereCondition']   = $ht;
		$conditions['group_by']         = $group;
		$orders   =   $this->input->post('orders');
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'30';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";
		$conditions['columns']	=	'count(distinct order_unique_id) as cnt';
		$totalRec               =   count($this->order_model->viewOrders($conditions));
		$conditions['columns']	=	'';
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewOrders');
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
		$dta["urlvalue"]        =   adminurl("viewOrders/");
		$dta["view"]            =   $this->order_model->viewOrders($conditions); 
		
		$this->load->view("ajax_orders",$dta);
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
            'merchant_id'=>'15304',
             'username' => 'test',
            'password'=>stripslashes('test'), 
            'api_key'=>'BlZr7kEXC597bxhjS3iEMQ6M242wvK01LMSGYOcd', // in sandbox request
             //'api_key' =>password_hash('jtest123',PASSWORD_BCRYPT), //In production mode, please pass
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
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/payment-request");
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
	public function counts(){
		$group  = "or.order_id";
		$ht = "or.order_status LIKE 'Active'";
		$i=0;
		$ids=array("Today Orders","Unassigned","Pending","Ready for Pickup","Completed Pickup","Arraived at customes","Delivered");
		foreach($ids as $ids){
			if($ids == "Today Orders"){
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%'";
			}elseif($ids == "Unassigned"){
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%' AND ord.orderdetails_rest_staus LIKE 'Order Placed'";
				$time	=	"-1 minutes";
				$datediff = date("Y-m-d H:i:s", strtotime($time));
				$ht		.=	" AND ost.orderstatus_add_date <= '".$datediff."'";
			}elseif($ids == "Pending"){
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%' AND ord.orderdetails_rest_staus LIKE 'Preparing'";
				//$ht		.=	" AND ost.orderstatus_add_date <= 'now() - interval 30 minute'";
			}elseif($ids == "Received" || $ids == "Ready for Pickup"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'Ready for pickup'";
				$time	=	"-1 minutes";
				$datediff = date("Y-m-d H:i:s", strtotime($time));
				$ht		.=	" AND ost.orderstatus_add_date <= '".$datediff."'";
			}elseif($ids == "Completed Pickup"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'Completed Pickup'";
			}elseif($ids == "Arraived at customes"){
				$ht  = "ord.orderdetails_rest_staus LIKE 'arrived order'";
				$time	=	"-5 minutes";
				$datediff = date("Y-m-d H:i:s", strtotime($time));
				$ht		.=	" AND ost.orderstatus_add_date <= '".$datediff."'";
			//$group  = "or.order_id";
			}else{
				$ht  = "or.order_created_by LIKE '%".date('Y-m-d')."%'";
			}
			$ht 	.= " AND ost.orderdetail_status = ord.orderdetails_rest_staus";
			$conditions['whereCondition']   = $ht;
			$conditions['group_by']         = $group;
			if($ids == "Pending"){
				$conditions['columns']	=	'res.resturant_preparation as time , ost.orderstatus_add_date as date';
				$view	= $this->order_model->viewOrderDetails($conditions);
				$totalRec[$i]=0;
				foreach($view as $v){
					$min = preg_replace('/[^0-9.]+/', '', $v->time);
					$time	=	"-".$min." minutes";
					$datediff = date("Y-m-d H:i:s", strtotime($time));
					//echo $min.'<br>'.$v->date.'<br>'.$datediff;
					if($v->date<= $datediff){
						$totalRec[$i]= $totalRec[$i]+1;
					}
				}
				$totalRec[$i]               =   count($this->order_model->viewOrderDetails($conditions));
			}else{
				$conditions['columns']	=	'count(distinct order_unique_id) as cnt';
				$totalRec[$i]               =   count($this->order_model->viewOrderDetails($conditions));
			}
			

			$i++;
		}
		$data =  $this->api_model->jsonencodevalues("1",$totalRec);
		echo ($data);
	}
	
}
?>