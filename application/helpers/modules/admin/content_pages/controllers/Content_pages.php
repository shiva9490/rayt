<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Content_pages extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-content-pages") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function create_content(){
                $data  = array(
                                "title"		=>	"Pages",
                                "content"	=>	"create_page",
                                "layouts"       =>      $this->pages_model->get_layouts(),
                                "contentform"   =>      $this->pages_model->get_contentform(),
                                "widgets"       =>      $this->widget_model->get_acwidgets(),
                );
                if($this->input->post("submit")){

                        $this->form_validation->set_rules("page_title","Page Title","required");
                        $this->form_validation->set_rules("cpage_content_from","Content Form","required");
                        if($this->input->post("cpage_content_from") != '1cfrom'){
                                $this->form_validation->set_rules("page_layout","Page Layout","required");
                        }else{
                                $this->form_validation->set_rules("post_url","Post URL","required");
                        } 
                        if($this->form_validation->run()){
                                $ins    = $this->pages_model->create_page();
                                if($ins){
                                    $this->session->set_flashdata("suc","Created Page Successfully.");
                                    redirect(sitedata("site_admin")."/create-content-page");
                                }else{
                                    $this->session->set_flashdata("err","Not Created Page.Please try again");
                                    redirect(sitedata("site_admin")."/create-content-page");
                                }
                        }                        
                }
                $this->load->view("admin/inner_template",$data);
        }
        public function index(){
                $data       =   array(
                        "limit" =>  '1',
                        "title" =>  "View Content Pages",
                        "content"   =>  "view_pages"
                );
                $conditions = array();
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"cpageid";  
                $totalRec               =   $this->pages_model->cntview_contentpages($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewContent');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $data["view"]            =   $this->pages_model->view_contentpages($conditions);
                $this->load->view("admin/inner_template",$data);
        }
        public function viewContent(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"cpageid";  
                $totalRec               =   $this->pages_model->cntview_contentpages($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewContent');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $data["limit"]           =   $offset+1;
                $data["view"]            =   $this->pages_model->view_contentpages($conditions);
                $this->load->view("ajax_pages",$data);
        }
        public function update_content_page(){
            if($this->session->userdata("update-content-page") != '1'){
                        redirect("admin");
                } 
                $uri    =   $this->uri->segment("3"); 
               $vue    =   $this->pages_model->get_page($uri);
               if($vue){
                     $data  = array(
                            "title"     =>  "Pages",
                            "content"   =>  "update_pages",
                            "layouts"       =>      $this->pages_model->get_layouts(),
                            "contentform"   =>      $this->pages_model->get_contentform(),
                            "widgets"       =>      $this->widget_model->get_acwidgets($vue),
                            "view"      =>  $vue
                    );    
                    if($this->input->post("submit")){
                        $this->form_validation->set_rules("page_title","Page Title","required");
                        $this->form_validation->set_rules("cpage_content_from","Content Form","required");
                        if($this->input->post("cpage_content_from") != '1cfrom'){
                                $this->form_validation->set_rules("page_layout","Page Layout","required");
                        }else{
                                $this->form_validation->set_rules("post_url","Post URL","required");
                        } 
                        if($this->form_validation->run() == TRUE){
                                $ins    = $this->pages_model->update_page($uri);
                                if($ins){
                                        $this->session->set_flashdata("suc","Updated page successfully");
                                        redirect(sitedata("site_admin")."/update-content-page/".$uri);
                                }
                                else{
                                        $this->session->set_flashdata("err","Not updated any page successfully");
                                        redirect(sitedata("site_admin")."/update-content-page/".$uri);
                                }
                        }
                    }
                    $this->load->view("admin/inner_template",$data);
                }else{
                        $this->session->set_flashdata("war","Page does not exists."); 
                        redirect(sitedata("site_admin")."/view-content-pages");
                }
                   

        }
        public function  delete_content_page(){
               if($this->session->userdata("delete-content-page") != '1'){
                        redirect("admin");
                } 
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->pages_model->get_page($uri);
                if(count($vue) > 0){         
                    $ins    = $this->pages_model->delete_page($uri);
                    if($ins){
                            $this->session->set_flashdata("suc","Deleted page successfully");
                        redirect(sitedata("site_admin")."/view-content-pages");
                    }
                    else{
                            $this->session->set_flashdata("err","Not deleted any page successfully"); 
                        redirect(sitedata("site_admin")."/view-content-pages");
                    }  
                }else{
                        $this->session->set_flashdata("war","Page does not exists."); 
                        redirect(sitedata("site_admin")."/view-content-pages");
                }
        }

}