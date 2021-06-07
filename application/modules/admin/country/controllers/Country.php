<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Country extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")); 
		}
	}
	public function index(){
		$dta    =   array(
			"title"     =>  "Country",
			"content"  =>  'country',
			"urlvalue"	=>	adminurl('viewCountry/'),
		);
		$conditions=array();
		$dta["view"]            =   $this->country_model->viewCountry($conditions); 
		$this->load->view('admin/inner_template',$dta);
	}    
	public function viewCountry($str){
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
		//$conditions['whereCondition'] = "country_name LIKE 'Kuwait'";
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"countryid";  
		$totalRec               =   $this->country_model->cntviewCountry($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewCountry/');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   adminurl("viewCountry/");
		$dta["view"]            =   $this->country_model->viewCountry($conditions); 
		$this->load->view("ajax_country",$dta);
	}
	public function ajax_country_active(){
			$status     =   $this->input->post("status");
			$uri        =   $this->input->post("fields");
			$params["whereCondition"]   =   "country_id = '".$uri."'";
			$vue    =   $this->country_model->getCountry($params);
			if(is_array($vue) && count($vue) > 0){
				$bt     =   $this->country_model->activedeactive($uri,$status); 
				if($bt > 0){
					$vsp    =   1;
				}
			}else{
				$vsp    =   2;
			}
		echo $vsp;
	}
	public function delete_country(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "country_id = '".$uri."'";
		$vue    =   $this->country_model->getCountry($params);
		if(count($vue) > 0){
			$bt     =   $this->country_model->delete_country($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}
	
	
	public function coutry_isd(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://restcountries.eu/rest/v2/all',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Cookie: __cfduid=d006d1ad6e105656fdae487f9ab482c401617686363'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response,true);
        //echo '<pre>';print_r($res[0]['callingCodes'][0]);
        //echo '<pre>';print_r($res[0]['name']);
        if(is_array($res) && count($res) >0){
            foreach($res as $key=>$value){
                $par['whereCondition'] = 'country_name ='.'"'.$value['name'].'"';
                $c = $this->country_model->getCountry($par);
                if(is_array($c) && count($c) >0){
                   $this->db->where('country_id',$c['country_id'])->update('country',array('country_isd'=> $value['callingCodes'][0]));
                }
            }
        }
	}
	
	public function coutry_img($key){
	    $img_file='http://www.geognos.com/api/en/countries/flag/'.$key.'.png';
        $img_file=file_get_contents($img_file);
        $file_loc= $_SERVER['DOCUMENT_ROOT'].'/assets/images/country/'.$key.'.png';
        $file_handler=fopen($file_loc,'w');
        if(fwrite($file_handler,$img_file)==false){
            return 0;
        }else{
            return 1;
        }
        fclose($file_handler);
	}
	public function update($uri){
		$dta    =   array(
			"title"     =>  "Country",
			"content"  =>  'update_country',
			"urlvalue"	=>	adminurl('viewCountry/'),
		);
		if($this->input->post('update')){
			$this->form_validation->set_rules('name','Country Name','required');
			$this->form_validation->set_rules('symbol','Country Symbol','required');
			$this->form_validation->set_rules('currency','Country Currency','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->country_model->update_country($uri);     
                if($res == TRUE){
                    $this->session->set_flashdata("suc","Updated Country successfully.");
					redirect(adminurl('Country'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$params["whereCondition"]   =   "country_id = '".$uri."'";
		$dta['view']    =   $this->country_model->getCountry($params);
		$this->load->view('admin/inner_template',$dta);
	}    
	
}
?>