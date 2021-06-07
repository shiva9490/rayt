<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Content_pages extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("login_id") == ""){
			//redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$dta    =   array(
                    "title"     =>  "View Content Pages",
                    "content"   =>  "view_content",
                    "urlvalue"	=>	adminurl('viewContent/'),
                );
        $conditions = array();
        $dta["view"] =   $this->pages_model->viewpages($conditions); 
		$this->load->view('admin/inner_template',$dta);
	}
	public function add_content(){
		$dta    =   array(
                        "title"		=>	"Pages",
                        "content"	=>	"create_content",    
		);		 
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("page_title","Page Title","required|is_unique[content_pages.cpage_title]");
                        $this->form_validation->set_rules("page_description","Description","required");                       
                        if($this->form_validation->run()){
                                $ins    = $this->pages_model->create_page();
                                if($ins){
                                        $this->session->set_flashdata("suc","Created Page Successfully.");
                                        redirect(sitedata("site_admin")."/Content-Pages");
                                }else{
                                        $this->session->set_flashdata("err","Not Created Page.Please try again");
                                        redirect(sitedata("site_admin")."/Content-Pages");
                                }
                        }                        
                }
                $this->load->view("admin/inner_template",$dta);
	}
	public function update_content(){
         $uri =$this->uri->segment('3');
	    $par['whereCondition'] = "cpage_id LIKE '".$uri."'";
	    $uve = $this->pages_model->getpages($par);	  
	    if(is_array($uve) && count($uve) >0){
        		$dta    =   array(
        			"title"     =>  "Add Zones",
        			"content"   =>  'update_content',
        			"view"      =>  $uve,    			
        		);
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("page_title","Page Title","required");
                    $this->form_validation->set_rules("page_description","Description","required"); 
                    if($this->form_validation->run() == TRUE){
                        $ins    = $this->pages_model->update_page($uri);
                        if($ins){
                            $this->session->set_flashdata("suc","Updated page successfully");
                            redirect(sitedata("site_admin")."/Content-Pages/");
                        }else{
                            $this->session->set_flashdata("err","Not updated any page successfully");
                            redirect(sitedata("site_admin")."/Update-Content/".$uri);
                        }
                    }
                }
                $this->load->view("admin/inner_template",$dta);
            }else{
                $this->session->set_flashdata("war","Page does not exists."); 
                redirect(sitedata("site_admin")."/Content-Pages");
            }
    	}
         public function viewContent(){ 
    		$conditions =   array();
    		$page       =   $this->uri->segment('3');
    		$offset     =   (!$page)?"0":$page;
    		$keywords   =   $this->input->post('keywords'); 
    		if(!empty($keywords)){
    				$conditions['keywords'] = $keywords;
    		}      		
    		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
    		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
    		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"cpageid";  
    		$totalRec               =   $this->pages_model->cntviewpages($conditions);  
    		if(!empty($orderby) && !empty($tipoOrderby)){ 
    			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
    			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
    		} 
    		$config['base_url']     =   adminurl('viewContent');
    		$config['total_rows']   =   $totalRec;
    		$config['per_page']     =   $perpage; 
    		$config['link_func']    =   'searchFilter';
    		$this->ajax_pagination->initialize($config);
    		$conditions['start']    =   $offset;
    		if($perpage != "all"){
    			$conditions['limit']    =   $perpage;
    		}
    		$dta["urlvalue"]        =   adminurl('viewContent/');
    		$dta["limit"]           =   $offset+1;
    		$dta["view"]            =   $this->pages_model->viewpages($conditions); 
    		$this->load->view("ajax_content",$dta);
    }
	public function activedeactive(){
    	
    			$status     =   $this->input->post("status");
    			$uri        =   $this->input->post("fields"); 
    			$p['whereCondition'] = "cpage_id = '".$uri."'";
    			$vue    =   $this->pages_model->getpages($p);
    			if(is_array($vue) && count($vue) > 0){
    					$bt     =   $this->pages_model->activedeactive($uri,$status); 
    					if($bt > 0){
    						$vsp    =   1;
    					}
    			}else{
    				$vsp    =   2;
    			} 
    	
    		echo $vsp;
    }
    public function delete_content(){
	
        $uri  =   $this->uri->segment("3"); 
        $p['whereCondition'] = "cpage_id = '".$uri."'";
        $vue    =   $this->pages_model->getpages($p);
        if(is_array($vue) && count($vue) > 0){
                $bt     =   $this->pages_model->delete_pages($uri); 
                if($bt > 0){
                        $vsp    =   1;
                }
        }else{
                $vsp    =   2;
        }         
        echo $vsp;
    }
    public function validation_name(){
        $this->form_validation->set_rules('cpage_title', 'Content page', 'required|is_unique[content_pages.cpage_title]');
        if($this->form_validation->run() == true){
            echo 0;
        }else{
            echo 1;
        }
    }
}?>