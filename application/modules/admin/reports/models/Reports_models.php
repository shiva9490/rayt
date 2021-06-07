<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Report_model extends CI_Model{    
	public function queryorders($params = array()){
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
				"ct.order_open"      =>  "1", 
				"ct.order_status"      =>  "1",
				"cp.customer_open"      =>  "1",
				"cp.customer_status"      =>  "1",
			);
			$this->db->select("$sel")
					->from("orders as ct") 
					->join("customers as  cp","ct.order_customer_id = cp.customer_id","INNER") 
					->join("customer_address as cas","cas.customeraddress_customer = cp.customer_id and cas.customeraddress_id  = ct.order_address_id","LEFT") 
					->join("delivery_boys as bg","bg.delivery_id = ct.order_delivery_id AND bg.delivery_open = 1 AND bg.delivery_status= '1'","LEFT")
					->where($dta);
			if(array_key_exists("keywords", $params)){
				$this->db->where("(order_unique LIKE '%".$params["keywords"]."%' AND order_sub_total LIKE '%".$params["keywords"]."%' AND order_total LIKE '%".$params["keywords"]."%' AND order_payment_mode LIKE '%".$params["keywords"]."%')");
			}
			if(array_key_exists("whereCondition", $params)){
				$this->db->where("(".$params["whereCondition"].")");
			}
			if(array_key_exists("whereCondition1", $params)){
				$this->db->where("(".$params["whereCondition1"].")");
			}
			if(array_key_exists("whereCondition2", $params)){
				$this->db->where("(".$params["whereCondition2"].")");
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
//                $this->db->get();echo $this->db->last_query();exit;
			return $this->db->get();
	}
	public function cntvieworders($params  =    array()){
			$params["cnt"]      =   "1"; 
			$val    =   $this->queryorders($params)->row_array();
			if(isset($val)){
				return  $val['cnt'];
			}
			return "0";
	}
	public function vieworders($params = array()){
//                $this->queryorders($params);echo $this->db->last_query();exit;
			return $this->queryorders($params)->result();
	}
	public function getorders($params = array()){
			return $this->queryorders($params)->row_array();
	}
	public function queryCustomer($params = array()){
		$sel    =   "*";
			if(array_key_exists("columns", $params)){
					$sel    =   $params["columns"];
			}
			if(array_key_exists("cnt", $params)){
					$sel    =   "count(DISTINCT `order_customer_id`) as cnt";
			}
			if(array_key_exists("join_condition", $params)){
				$join    =   $params["join_condition"];
			}
			$dta    =   array( 
				"ct.order_open"      =>  "1", 
				"ct.order_status"      =>  "1",
				"cp.customer_open"      =>  "1",
				"cp.customer_status"      =>  "1",
			);
			$this->db->select("$sel")
					->from("orders as ct") 
					->join("customers as  cp","ct.order_customer_id = cp.customer_id","INNER") 
					->join("customer_address as cas","cas.customeraddress_customer = cp.customer_id and cas.customeraddress_id  = ct.order_address_id","LEFT") 
					->join("delivery_boys as bg","bg.delivery_id = ct.order_delivery_id AND bg.delivery_open = 1 AND bg.delivery_status= '1'","LEFT")
					->where($dta);
			if(array_key_exists("keywords", $params)){
				$this->db->where("(order_unique LIKE '%".$params["keywords"]."%' AND order_sub_total LIKE '%".$params["keywords"]."%' AND order_total LIKE '%".$params["keywords"]."%' AND order_payment_mode LIKE '%".$params["keywords"]."%')");
			}
			if(array_key_exists("whereCondition", $params)){
				$this->db->where("(".$params["whereCondition"].")");
			}
			if(array_key_exists("whereCondition1", $params)){
				$this->db->where("(".$params["whereCondition1"].")");
			}
			if(array_key_exists("whereCondition2", $params)){
				$this->db->where("(".$params["whereCondition2"].")");
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
            //    $this->db->get();echo $this->db->last_query();exit;
			return $this->db->get();
	}
	public function cntviewCustomer($params  =    array()){
			$params["cnt"]      =   "1"; 
			$val    =   $this->queryCustomer($params)->row_array();
			if(isset($val)){
				//print_r($val);exit();
				return  $val['cnt'];
			}
			return "0";
	}
	public function viewCustomer($params = array()){
//                $this->queryorders($params);echo $this->db->last_query();exit;
			return $this->queryCustomer($params)->result();
	}
	public function getCustomer($params = array()){
			return $this->queryCustomer($params)->row_array();
	}
	public function queryproduct($params = array()){
		$sel    =   "*";
			if(array_key_exists("columns", $params)){
					$sel    =   $params["columns"];
			}
			if(array_key_exists("cnt", $params)){
					$sel    =   "count(DISTINCT `product_id`) as cnt";
			}
			if(array_key_exists("join_condition", $params)){
				$join    =   $params["join_condition"];
			}
			$dta    =   array( 
				"ct.order_open"      =>  "1", 
				"ct.order_status"      =>  "1",
				"p.product_open"      =>  "1", 
				"p.product_status"      =>  "1",
			);
			$this->db->select("$sel")
					->from("products as  p") 
					->join("vendor_products as  vp","vp.vendorproduct_product = p.product_id","INNER") 
					->join("order_details as  cd","vp.vendorproduct_id = cd.orderdetail_vendorproduct_id","LEFT") 
					->join("orders as ct","cd.orderdetail_orderid = ct.order_id","LEFT") 
					->where($dta);
			if(array_key_exists("keywords", $params)){
				$this->db->where("(product_name LIKE '%".$params["keywords"]."%' AND order_sub_total LIKE '%".$params["keywords"]."%' AND order_total LIKE '%".$params["keywords"]."%' AND order_payment_mode LIKE '%".$params["keywords"]."%')");
			}
			if(array_key_exists("whereCondition", $params)){
				$this->db->where("(".$params["whereCondition"].")");
			}
			if(array_key_exists("whereCondition1", $params)){
				$this->db->where("(".$params["whereCondition1"].")");
			}
			if(array_key_exists("whereCondition2", $params)){
				$this->db->where("(".$params["whereCondition2"].")");
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
            //    $this->db->get();echo $this->db->last_query();exit;
			return $this->db->get();
	}
	public function cntviewproduct($params  =    array()){
			$params["cnt"]      =   "1"; 
			$val    =   $this->queryproduct($params)->row_array();
			if(isset($val)){
				return  $val['cnt'];
			}
			return "0";
	}
	public function viewproduct($params = array()){
//                $this->queryorders($params);echo $this->db->last_query();exit;
			return $this->queryproduct($params)->result();
	}
	public function getproduct($params = array()){
			return $this->queryproduct($params)->row_array();
	}
    public function download_autogen_excel($conditions = array()){
		$filename = $conditions['file_name'];
        $usersData = $this->report_model->vieworders($conditions);
        header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
		// file creation 
		//print_r($usersData);exit;
		$file = fopen('php://output','w');
		$header = array("Order Id","Mobile","Customer","Order Total","Order Date","Order Payment Mode","Status");
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){
            $line=  (array) $line;
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
    }
	public function download_pdf($conditions = array()){
		$filename = $conditions['file_name'];
        $usersData = $this->report_model->vieworders($conditions);
		$html_string="";
        if($usersData!=null)
		{
			$html_string ='<table border="1">';
                $html_string.='';
                $html_string.='
                        <tr  style=font-weight:bold>
                        <th>Order Id</th>
                        <th>Mobile</th>
                        <th>Customer</th>
						<th>Order Total</th>
                        <th>Order Date</th>
                        <th>Order Payment Mode</th>
                        <th>Status</th>
                        </tr>';
			foreach($usersData as $q)
			{
				$html_string .= '<tr>';
				$html_string .= '<td>'.$q->order_unique.'</td>';
				$html_string .= '<td>'.$q->customer_mobile.'</td>';
				$html_string .= '<td>'.$q->customer_name.'</td>';
				$html_string .= '<td>'.$q->order_total.'</td>';
				$html_string .= '<td>'.$q->order_date.'</td>';
				$html_string .= '<td>'.$q->order_payment_mode.'</td>';
				$html_string .= '<td>'.$q->order_acde.'</td>';
				$html_string .= '</tr>';
			}
			$html_string.='</table>';
		}
		else{
			$html_string="<p>No data available</p>";
		}
		//print_r($html_string);
		$mpdf = $this->mpdf->indexval();
		$html   =   $html_string;
		$logo_url	=base_url().'uploads/'.sitedata("site_logo");
		$mpdf->WriteHTML('<img src="'.$logo_url.'" height="50px"></img> <h2 style="text-align:center;">Order Reports</h2>');
		$mpdf->WriteHTML($html);
		$mpdf->Output($filename, 'D');
		exit; 
    }
	public function download_autogen_excel_customer($conditions = array()){
		$filename = $conditions['file_name'];
        $usersData = $this->report_model->viewCustomer($conditions);
        header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
		// file creation 
		//print_r($usersData);exit;
		$file = fopen('php://output','w');
		$header = array("Customer Id","Mobile","Customer","Order Total","Orders");
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){
            $line=  (array) $line;
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
    }
	public function download_pdf_customer($conditions = array()){
		$filename = $conditions['file_name'];
        $usersData = $this->report_model->viewCustomer($conditions);
		$html_string="";
        if($usersData!=null)
		{
			$html_string ='<table border="1">';
                $html_string.='';
                $html_string.='
                        <tr  style=font-weight:bold>
                        <th>Customer Id</th>
                        <th>Mobile</th>
                        <th>Customer</th>
						<th>Order Total</th>
                        <th>Orders</th>
                        </tr>';
			foreach($usersData as $q)
			{
				$html_string .= '<tr>';
				$html_string .= '<td>'.$q->customer_id.'</td>';
				$html_string .= '<td>'.$q->customer_mobile.'</td>';
				$html_string .= '<td>'.$q->customer_name.'</td>';
				$html_string .= '<td>'.$q->total.'</td>';
				$html_string .= '<td>'.$q->count.'</td>';
				$html_string .= '</tr>';
			}
			$html_string.='</table>';
		}
		else{
			$html_string="<p>No data available</p>";
		}
		//print_r($html_string);
		$mpdf = $this->mpdf->indexval();
		$html   =   $html_string;
		$logo_url	=base_url().'uploads/'.sitedata("site_logo");
		$mpdf->WriteHTML('<img src="'.$logo_url.'" height="50px"></img> <h2 style="text-align:center;">Customer Reports</h2>');
		$mpdf->WriteHTML($html);
		$mpdf->Output($filename, 'D');
		exit; 
    }
	public function download_autogen_excel_product($conditions = array()){
		$filename = $conditions['file_name'];
        $usersData = $this->report_model->viewproduct($conditions);
        header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
		// file creation 
		//print_r($usersData);exit;
		$file = fopen('php://output','w');
		$header = array("product Id","product Name","Orders Total","Orders");
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){
            $line=  (array) $line;
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
    }
	public function download_pdf_product($conditions = array()){
		$filename = $conditions['file_name'];
        $usersData = $this->report_model->viewproduct($conditions);
		$html_string="";
        if($usersData!=null)
		{
			$html_string ='<table border="1">';
                $html_string.='';
                $html_string.='
                        <tr  style=font-weight:bold>
                        <th>product Id</th>
                        <th>product Name</th>
						<th>Orders Total</th>
                        <th>Orders</th>
                        </tr>';
			foreach($usersData as $q)
			{
				$html_string .= '<tr>';
				$html_string .= '<td>'.$q->product_id.'</td>';
				$html_string .= '<td>'.$q->product_name.'</td>';
				$html_string .= '<td>'.$q->total.'</td>';
				$html_string .= '<td>'.$q->count.'</td>';
				$html_string .= '</tr>';
			}
			$html_string.='</table>';
		}
		else{
			$html_string="<p>No data available</p>";
		}
		//print_r($html_string);
		$mpdf = $this->mpdf->indexval();
		$html   =   $html_string;
		$logo_url	=base_url().'uploads/'.sitedata("site_logo");
		$mpdf->WriteHTML('<img src="'.$logo_url.'" height="50px"></img> <h2 style="text-align:center;">Product Reports</h2>');
		$mpdf->WriteHTML($html);
		$mpdf->Output($filename, 'D');
		exit; 
    }
	public function querycustomerdetails($params = array()){
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
				"dt.orderdetail_open"       =>  "1",
				"dt.orderdetail_status" =>  "1",
				"ct.order_open"      =>  "1", 
				"ct.order_status"      =>  "1", 
				"vp.vendorproduct_open"     =>  "1",
				"vp.vendorproduct_status"   =>  "1",
				"cp.customer_status"    =>  "1",
				"cp.customer_open"      =>  "1",
				"vd.vendor_open"    =>  "1",
				"vd.vendor_status"  =>  "1"
			);
			$this->db->select("$sel")
					->join("customers as  cp")
					->join("orders as ct","cp.customer_id = ct.order_customer_id","INNER") 
					->join("customer_address as  ca","ct.order_address_id = ca.customeraddress_id","LEFT")
					->join("vendor_products as vp","vp.vendorproduct_id = dt.orderdetail_vendorproduct_id","INNER") 
					->join("measures as  mhd","mhd.measure_id = vp.vendorproduct_measure","INNER") 
					->join("products as  pd","pd.product_id = vp.vendorproduct_product","INNER") 
					->join("category as sn","sn.category_id = vp.vendorproduct_category","INNER")  
					->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","INNER")  
					->join("vendor as  vd","vd.vendor_id = vp.vendorproduct_vendor_id","INNER")
					->join("(SELECT * FROM vendorproduct_images  WHERE vendorproductimg_open = '1' AND  vendorproductimg_status = '1' GROUP BY vendorproduct_productid) as vimp","vimp.vendorproduct_productid = vp.vendorproduct_id AND vp.vendorproduct_id = dt.orderdetail_vendorproduct_id","INNER")
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
//                $this->db->get();echo $this->db->last_query();exit;
			return $this->db->get();
	}
	public function cntvieworderdetails($params  =    array()){
			$params["cnt"]      =   "1"; 
			$val    =   $this->queryorderdetails($params)->row_array();
			if(isset($val)){
				return  $val['cnt'];
			}
			return "0";
	}
	public function vieworderdetails($params = array()){
//                $this->queryorderdetails($params);echo $this->db->last_query();exit;
			return $this->queryorderdetails($params)->result();
	}
	public function getorderdetails($params = array()){
			return $this->queryorderdetails($params)->row_array();
	}
}