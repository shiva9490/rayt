<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Zones extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Zones List",
			"content"  =>  'zone'
		);
		$orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
		$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"zoneid";  
		if(!empty($orderby) && !empty($tipoOrderby)){ 
			$dta['orderby']        =   $orderby;
			$dta['tipoOrderby']    =   $tipoOrderby; 
		} 
		$dta["urlvalue"]     =   adminurl('viewZones/');
		$this->load->view('admin/inner_template',$dta);
	}
	public function new_zone(){
		$dta    =   array(
			"title"     =>  "Add Zones",
			"content"  =>  'add_zones'
		);
		if($this->input->post('publish')){
		    //print_r($this->input->post());exit;
		    $this->form_validation->set_rules('zoneName', 'zname', 'required|is_unique[zones.zone_name]');
		    $this->form_validation->set_rules('lat[]', 'lat', 'required');
		    $this->form_validation->set_rules('lng[]', 'lng', 'required');
            if($this->form_validation->run() == true){
    		    $d= $this->zone_model->add_zone();
    		    if($d > 0){
    				$this->session->set_flashdata("suc","Created a Zones Successfully.");
    				redirect(sitedata("site_admin")."/Zones");
    			}else{
    				$this->session->set_flashdata("err","Not Created a Zones.Please try again.");
    			}
            }
		}
		$this->load->view('admin/inner_template',$dta);
	}
	public function update_zones(){
	    $par['whereCondition'] = "zone_id LIKE '".$this->uri->segment('3')."'";
	    $uve = $this->zone_model->getZones($par);
	    $p['whereCondition'] ="zone_id LIKE '".$this->uri->segment('3')."'";
	    $zonelist = $this->zone_model->viewZoneList($p);
	    if(is_array($uve) && count($uve) >0){
    		$dta    =   array(
    			"title"     =>  "Add Zones",
    			"content"   =>  'update_zones',
    			"view"      =>  $uve,
    			"zone_list" =>  $zonelist
    		);
    		$this->load->view('admin/inner_template',$dta);
	    }
	}
	public function add_zone(){
	    $lat = $this->input ->post('lat');
	    $lng = $this->input ->post('lng');
	    $zon = $this->input ->post('zon');
	    if($lat !="" && $lng !="" && $zon !=""){
    	    $res = $this->zone_model->add_zone();
    	    if($res > 0){
    	        //$this->zone_model->addlag($res);
    	        echo 1;
    	    }else{
    	        echo 0;
    	    }
	    }else{
	        echo 0;
	    }
	}
	
    public function viewZones(){ 
    		$conditions =   array();
    		$page       =   $this->uri->segment('3');
    		$offset     =   (!$page)?"0":$page;
    		$keywords   =   $this->input->post('keywords'); 
    		if(!empty($keywords)){
    				$conditions['keywords'] = $keywords;
    		}  
    		$conditions['group_by'] = "zones.zone_name";
    		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
    		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
    		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"zoneid";  
    		$totalRec               =   $this->zone_model->cntviewZone($conditions);  
    		if(!empty($orderby) && !empty($tipoOrderby)){ 
    			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
    			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
    		} 
    		$config['base_url']     =   adminurl('viewZones');
    		$config['total_rows']   =   $totalRec;
    		$config['per_page']     =   $perpage; 
    		$config['link_func']    =   'searchFilter';
    		$this->ajax_pagination->initialize($config);
    		$conditions['start']    =   $offset;
    		if($perpage != "all"){
    			$conditions['limit']    =   $perpage;
    		}
    		$dta["urlvalue"]        =   adminurl('viewZones/');
    		$dta["limit"]           =   $offset+1;
    		$dta["view"]            =   $this->zone_model->viewZones($conditions); 
    		$this->load->view("ajax_zones",$dta);
    }
	public function activedeactive(){
    		$vsp    =   "0";
    		if($this->session->userdata("active-deactive-zone") != '1'){
    			$vsp    =   "0";
    		}else{
    			$status     =   $this->input->post("status");
    			$uri        =   $this->input->post("fields"); 
    			$p['whereCondition'] = "zone_id = '".$uri."'";
    			$vue    =   $this->zone_model->getZones($p);
    			if(is_array($vue) && count($vue) > 0){
    					$bt     =   $this->zone_model->activedeactive($uri,$status); 
    					if($bt > 0){
    						$vsp    =   1;
    					}
    			}else{
    				$vsp    =   2;
    			} 
    		} 
    		echo $vsp;
    }
    public function delete_zones(){
		$vsp    =   "0";
		if($this->session->userdata("delete-zone") != '1'){
			$vsp    =   "0";
		}else {
			$uri  =   $this->uri->segment("3"); 
			$p['whereCondition'] = "zone_id = '".$uri."'";
			$vue    =   $this->zone_model->getZones($p);
			if(is_array($vue) && count($vue) > 0){
				$bt     =   $this->zone_model->delete_zones($uri); 
				if($bt > 0){
					$vsp    =   1;
				}
			}else{
				$vsp    =   2;
			} 
		} 
		echo $vsp;
    }
    public function validation_name(){
        $this->form_validation->set_rules('zname', 'zname', 'required|is_unique[zones.zone_name]');
        if($this->form_validation->run() == true){
            echo 0;
        }else{
            echo 1;
        }
    }
}?>