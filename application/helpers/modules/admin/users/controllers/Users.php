<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends CI_Controller{
    public function __construct() {
            parent::__construct();
            if($this->session->userdata("manage-users") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
            }
        }
        public function index(){ 
            $dta    =   array( 
                                "title"     =>  "Users",
                                "content"   =>  "users",
                                "limit"     =>  "1"
                        ); 
            if($this->input->post("submit")){
                $this->form_validation->set_rules("user_name","User Name","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_user_name");
                $this->form_validation->set_rules("rolevalname","Role","required");
                $this->form_validation->set_rules("user_email","Email Id","required|valid_email|xss_clean|trim|min_length[3]|max_length[50]|callback_check_user_email");
                if($this->form_validation->run() == TRUE){
                    $bt     =   $this->login_model->create_login();
                    if($bt > 0){
                        $this->session->set_flashdata("suc","Created a User Successfully.");
                        redirect(sitedata("site_admin")."/Users");
                    }else{
                        $this->session->set_flashdata("err","Not Created a User.Please try again.");
                        redirect(sitedata("site_admin")."/Users");
                    }
                }
            }  
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"id";  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $orderby;
                $dta['tipoOrderby']    =   $tipoOrderby; 
            } 
            $ms['order_by']      =   "ASC";
            $ms['tipoOrderby']   =   "ut_name";
            $dta["urlvalue"]     =   adminurl('viewUser/');
            $dta['roles']        =   $this->role_model->view_role($ms);
            $this->load->view("admin/inner_template",$dta); 
    }
    public function check_user_email($str){ 
        $vsp	=	$this->login_model->check_unique_name("login_email",$str); 
        if($vsp){
            $this->form_validation->set_message("check_user_email","Email Id already exists.");
            return FALSE;
        }	
        return TRUE; 
    }
    public function unique_email_name(){
            echo $this->login_model->unique_values("login_email",$this->input->post("user_email"));
    }
    public function unique_role_name(){
            echo $this->login_model->unique_values("login_name",$this->input->post("user_name"));
    }
    public function check_user_name($str){ 
            $vsp	=	$this->login_model->check_unique_name("login_name",$str); 
            if($vsp){
                    $this->form_validation->set_message("check_user_name","User Name already exists.");
                    return FALSE;
            }	
            return TRUE; 
    }
    public function delete_role(){
            $vsp    =   "0";
            if($this->session->userdata("delete-role") != '1'){
                $vsp    =   "0";
            }else {
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->role_model->get_role($uri);
                if(count($vue) > 0){
                    $bt     =   $this->role_model->delete_role($uri); 
                    if($bt > 0){
                        $vsp    =   1;
                    }
                }else{
                    $vsp    =   2;
                } 
            } 
            echo $vsp;
    }
    public function update_user(){
            if($this->session->userdata("update-user") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
            }
            $uri    =   $this->uri->segment("3"); 
            $pms['whereCondition']  =   "login_id LIKE '$uri'";
            $vue    =   $this->login_model->getUser($pms);  
            if(count($vue) > 0){
                    $dt     =   array(
                            "title"     =>  "Update User",
                            "content"   =>  "update_user", 
                            "vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Users")."'>Users</a></li>",
                            "view"      =>  $vue
                    ); 
                    if($this->input->post("submit")){
                            $this->form_validation->set_rules("username","User Name","required|xss_clean|trim|max_length[50]");
                            $this->form_validation->set_rules("useremail","Email Id","required|xss_clean|trim|max_length[50]");
                            $this->form_validation->set_rules("rolevalname","Role","required");
                            if($this->form_validation->run() == TRUE){
                                    $bt     =   $this->login_model->update_user($uri);
                                    if($bt > 0){
                                            $this->session->set_flashdata("suc","Updated User Successfully.");
                                            redirect(sitedata("site_admin")."/Users");
                                    }else{
                                            $this->session->set_flashdata("err","Not Updated User.Please try again.");
                                            redirect(sitedata("site_admin")."/Users");
                                    }
                            }
                    }
                    $ms['order_by']      =   "ASC";
                    $ms['tipoOrderby']   =   "ut_name";
                    $dt['roles']       =   $this->role_model->view_role($ms);
                    $this->load->view("admin/inner_template",$dt);
            }else{
                    $this->session->set_flashdata("war","User does not exists."); 
                    redirect(sitedata("site_admin")."/Users");
            }
    }
    public function active_deactive(){
            $vsp    =   "0";
            if($this->session->userdata("active-deactive-user") != '1'){
                $vsp    =   "0";
            }else{
                $status     =   $this->input->post("status");
                $uri        =   $this->input->post("fields"); 
                $vue    =   $this->role_model->get_role($uri);
                if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->login_model->activedeactive($uri,$status); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                }else{
                    $vsp    =   2;
                } 
            } 
            echo $vsp;
    }
    public function viewUser(){ 
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            $conditions['ad_id'] = 2;
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"lid";  
            $totalRec               =   $this->login_model->cntviewUser($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   $urlvalue   =   adminurl('viewUser');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != "all"){
                $conditions['limit']    =   $perpage;
            }
            $dta["limit"]           =   $offset+1;
            $dta["urlvalue"]        =   $urlvalue."/";
            $dta["view"]            =   $this->login_model->viewUser($conditions); 
            $this->load->view("ajax_user",$dta);
    }
    public function __destruct() {
            $this->db->close();
    }
}