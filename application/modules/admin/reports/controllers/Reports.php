<?php
class Reports extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}

	public function index(){
		$dta    =   array(
            "title"     =>  "Today Reports",
			"content"   =>  'reports',
			"urlvalue"	=>	adminurl('viewReports/')
		);
		if($this->input->get()){
			$group 		= "ord.orderdetail_restaurant_id";
			$ht 		= "or.order_status LIKE 'Active'";
			$fromDate   =   $this->input->get('fromDate');
			$toDate   	=   $this->input->get('toDate');
			$status     =   $this->input->get('status');
			$restaurant = $this->input->get('restaurant'); 
			$keywords = $this->input->get('keywords'); 
			
			$ht = "order_status LIKE 'Active'";
			if(!empty($keywords)){
				$conditions['keywords'] = $keywords;
			}
			if(!empty($status)){
				$ht .= " AND orderdetails_rest_staus LIKE '".$status."'";
			} 
			if(!empty($pay_mode)){
				$ht.= "AND order_type LIKE '".$pay_mode."'";
			}
			if(!empty($restaurant)){
				$ht.= "AND ord.orderdetail_restaurant_id LIKE '".$restaurant."'";
			} 
			if(!empty($fromDate) && !empty($toDate)){
				$ht.= "AND order_created_by >= '".$fromDate."' AND order_created_by <= '".$toDate."'";
			}
			$conditions['whereCondition']   = $ht;
			$conditions['group_by']         = $group;
			$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
			$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"orderid";
			$conditions['columns']	=	'count(distinct order_unique_id) as cnt';
			$conditions['total']  =   count($this->order_model->viewOrders($conditions));
			$conditions['columns']	=	'resturant_name,SUM(CASE WHEN or.order_type like"COD" THEN order_amount ELSE 0 END) as cod ,SUM(CASE WHEN or.order_type LIKE "Online Payment" THEN order_amount ELSE 0 END) as online'; 
			if(!empty($orderby) && !empty($tipoOrderby)){
				$conditions['order_by']      =   $orderby;
				$conditions['tipoOrderby']   =   $tipoOrderby; 
			}
			if($this->input->get('excel')){
				$this->session->set_flashdata("suc"," Check Downloads for Excel");
				$conditions['file_name']   =   'Orders Report ['.date("YmdHis").'].csv';
				$conditions['columns']	=	'resturant_name,,SUM(CASE WHEN or.order_type like"COD" THEN order_amount ELSE 0 END) as cod ,SUM(CASE WHEN or.order_type LIKE "Online Payment" THEN order_amount ELSE 0 END) as online,SUM(order_amount) as total'; 
				$this->reports_model->download_autogen_excel($conditions);
			}
			if($this->input->get('pdf') ){
				$this->session->set_flashdata("suc"," Check Downloads for Excel");
				$conditions['file_name']   =   'Orders Report ['.date("YmdHis").'].pdf';
				$conditions['columns']	=	'resturant_name,,SUM(CASE WHEN or.order_type like"COD" THEN order_amount ELSE 0 END) as cod ,SUM(CASE WHEN or.order_type LIKE "Online Payment" THEN order_amount ELSE 0 END) as online,SUM(order_amount) as total'; 
				$this->reports_model->download_pdf($conditions);
			}
		}
		$this->load->view("admin/inner_template",$dta);
	}

	public function viewReports(){     
	    $page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;	
		$group 		= "ord.orderdetail_restaurant_id";
        $ht 		= "or.order_status LIKE 'Active'";
        $fromDate   =   $this->input->post('fromdate');
        $toDate   	=   $this->input->post('todate');
        $status     =   $this->input->post('status');
        $pay_mode   =   $this->input->post('pay_mode'); 
        $restaurant = $this->input->post('restaurant'); 
        $keywords = $this->input->post('keywords'); 
        
        $ht = "order_status LIKE 'Active'";
        if(!empty($keywords)){
            $conditions['keywords'] = $keywords;
        }
        if(!empty($status)){
            $ht = "orderdetails_rest_staus LIKE '".$status."'";
        } 
        if(!empty($pay_mode)){
            $ht.= "AND order_type LIKE '".$pay_mode."'";
        }
        if(!empty($restaurant)){
            $ht.= "AND ord.orderdetail_restaurant_id LIKE '".$restaurant."'";
        } 
        if(!empty($fromDate) && !empty($toDate)){
            $ht.= "AND order_created_by >= '".$fromDate."' AND order_created_by <= '".$toDate."'";
        }
     //  print_r($ht);exit;
		$orderstatus = $this->config->item('orderstatus');
		$conditions['whereCondition']   = $ht;
		$conditions['group_by']         = $group;
		$orders                 =   $this->input->post('orders');
		$perpage                =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'30';    
		$orderby                =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby            =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";
		$conditions['columns']	=	'count(distinct order_unique_id) as cnt';
		$totalRec               =   count($this->order_model->viewOrders($conditions));   
		$conditions['columns']	=	'resturant_name,,SUM(CASE WHEN or.order_type like"COD" THEN order_amount ELSE 0 END) as cod ,SUM(CASE WHEN or.order_type LIKE "Online Payment" THEN order_amount ELSE 0 END) as online'; 
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewReports');
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
		$dta["urlvalue"]        =   adminurl("viewReports/");
		$dta["view"]            =   $this->order_model->viewOrders($conditions); 
		//echo "<pre>";print_r($dta["view"]);exit; 
		$dta['totalRec']  = $totalRec;
		$this->load->view("ajax_reports",$dta);		
	}
	public function salesreport(){
		$dta    =   array(
            "title"     =>  "Sales Reports",
			"content"   =>  'sales_reports',
			"urlvalue"	=>	adminurl('viewsalesReports/')
		);
		if($this->input->get()){	
		
			$group  = "or.order_id";         
			$ht = "or.order_status LIKE 'Active'";
            $keywords   =   $this->input->get('keywords'); 
            $fromDate   =   $this->input->get('fromDate');
            $toDate     =   $this->input->get('toDate');
            $dta["status"]      = $status     =   $this->input->get('status');
            $dta["pay_mode"]    = $pay_mode   =   $this->input->get('pay_mode');
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }
            if(!empty($status)){
                $ht = "orderdetails_rest_staus LIKE '".$status."'";
            } 
            if(!empty($pay_mode)){
                $ht = "order_payment_mode LIKE '".$pay_mode."'";
            } 
            if(!empty($fromDate) && !empty($toDate) ){
                if($fromDate <= $toDate){
                    $conditions['whereCondition'] = "order_created_by >= '".$fromDate."' AND order_created_by <= '".$toDate."'";
                    $this->session->set_flashdata("suc"," Generated Successfully");
                }
                else{
                    $this->session->set_flashdata("err"," 'From Date' is less then 'To Date' and also not empty.");
                }
            }
		
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
	public function viewsalesReports(){     
	    $page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;	
		$group  = "or.order_id";
        $ht = "or.order_status LIKE 'Active'";
        $fromDate   =   $this->input->post('fromdate');
        $toDate   =   $this->input->post('todate');
        $status     =   $this->input->post('status');
        $pay_mode   =   $this->input->post('pay_mode'); 
        $restaurant = $this->input->post('restaurant'); 
        $keywords = $this->input->post('keywords'); 
        
        $ht = "order_status LIKE 'Active'";
        if(!empty($keywords)){
            $conditions['keywords'] = $keywords;
        }
        if(!empty($status)){
            $ht = "orderdetails_rest_staus LIKE '".$status."'";
        } 
        if(!empty($pay_mode)){
            $ht.= "AND order_type LIKE '".$pay_mode."'";
        }
        if(!empty($restaurant)){
            $ht.= "AND ord.orderdetail_restaurant_id LIKE '".$restaurant."'";
        } 
        if(!empty($fromDate) && !empty($toDate)){
            $ht.= "AND order_created_by >= '".$fromDate."' AND order_created_by <= '".$toDate."'";
        }
        //print_r($ht);exit;
		$orderstatus = $this->config->item('orderstatus');
		$conditions['whereCondition']   = $ht;
		$conditions['group_by']         = $group;
		$orders                 =   $this->input->post('orders');
		$perpage                =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'30';    
		$orderby                =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby            =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";
		$conditions['columns']	=	'count(distinct order_unique_id) as cnt';
		$totalRec               =   count($this->order_model->viewOrders($conditions));   
		$conditions['columns']	=	'';
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewsalesReports');
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
		$dta["urlvalue"]        =   adminurl("viewsalesReports/");
		$dta["view"]            =   $this->order_model->viewOrders($conditions);      
		$this->load->view("ajax_sales_reports",$dta);
	}
}
?>