<?php
class Common extends CI_Controller{
        public function pagenotfound(){
                $dta    =   array(
                    "title"     =>  "Page Not Found",
                    "content"   =>  "pagenotfound"
                );
                $this->load->view("admin/outer_template",$dta);
        }
         public function change_password(){
         
                if($this->session->userdata("login_id") == ""){
                    redirect(sitedata("site_admin")."/");
                }
                $dta    =   array(
                    "title"     =>  "Change Password",
                    "content"   =>  "change_password"
                );
                $login_id   =   $this->session->userdata("login_id");
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("old_password","Old Password","required|xss_clean|trim|min_length[3]|max_length[50]|callback_checkpassword");
                    $this->form_validation->set_rules("new_password","New Password","required|xss_clean|trim|min_length[3]|max_length[50]");
                    $this->form_validation->set_rules("con_password","Confirm Password","required|xss_clean|trim|min_length[3]|max_length[50]|matches[new_password]");
                    if($this->form_validation->run() == true){
                        $ins    =   $this->login_model->updatePassword($login_id);
                        if($ins){
                            $this->session->set_flashdata("suc","Password has been changed successfully"); 
                        }else{
                            $this->session->set_flashdata("err","Password has been not changed.Please try again"); 
                        }
                        redirect(sitedata("site_admin")."/Change-Password");
                    }
                }
                $this->load->view("admin/inner_template",$dta);
        }

        public function checkpassword($str){   
            $oldpass = base64_encode($str);         
            $vsp    =   $this->login_model->checkvaluepassword($oldpass); 
            if($vsp == false){
                $this->form_validation->set_message("checkpassword","Old password didn't match.");
                return FALSE;
            }	 
            return TRUE; 	
        }	
        public function countryname(){
            $erm    =   $this->input->get("term");
            $params['whereCondition']  =   "country_name like '%".$erm."%'"; 
            $params['tipoOrderby']  =   "country_name"; 
            $params['order_by']     =   "ASC";
            $djon    =  array();
            $adjon   =  $this->common_model->viewCountries($params);
            foreach($adjon as $ky => $fer){
                $djon[$ky]["label"]   =   $fer->countryid;
                $djon[$ky]["value"]   =   $fer->country_name;
            }
            echo json_encode($djon);
        }
        public function check_email($str){
                $vsp	=	$this->api_model->unique_emailid("register_email",$str); 
                if($vsp == "false"){
                        $this->form_validation->set_message("check_email","Email Id already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function check_mobileno($str){
                $vsp	=	$this->api_model->unique_emailid("register_mobile",$str); 
                if($vsp == "false"){
                        $this->form_validation->set_message("check_mobileno","Mobile No. already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function helpdesk_category_list(){
            $par['whereCondition'] ="sub.helpquecat_id LIKE '".$this->input->post('helpdeskcat')."'";
            $vsp    =   $this->helpdesk_model->viewHelpSubCategory($par);
            $vsvd   =   '<option value="">Select Specialization</option>';
            if(count($vsp)){
                foreach ($vsp as $ve){
                    $vsvd   .=  '<option value="'.$ve->helpquesubcat_id.'">'.$ve->helpdesk_ques_subcat.'</option>';
                }
            }
            echo $vsvd;
        }
        public function helpdesk_category(){      
            $dta    =   array(
                "title"     =>  "Helpdesk Enquire About",
                "content"   =>  "helpdesk_category"
            );  
            if($this->input->post("submit")){                   
                $this->form_validation->set_rules("helpdesk_ques_cat","Enquire About","required");
                
                if($this->form_validation->run() == TRUE){
                    $bt     =   $this->helpdesk_model->create_helpdeskcategory();
                    if($bt > 0){
                        $this->session->set_flashdata("suc","Created a Enquire  Successfully.");
                        redirect(sitedata("site_admin")."/Helpdesk-Category");
                    }else{
                        $this->session->set_flashdata("err","Not Created a Enquire.Please try again.");
                        redirect(sitedata("site_admin")."/Helpdesk-Category");
                    }
                }
            }     
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
    		$tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"helpquecatid";  
    		if(!empty($orderby) && !empty($tipoOrderby)){ 
    			$dta['orderby']        =   $orderby;
    			$dta['tipoOrderby']    =   $tipoOrderby; 
    		} 
    		$dta["urlvalue"]     =   adminurl('viewHelpcategory/'); 
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewHelpcategory(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
          
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"helpquecatid";            
            $totalRec               =   $this->helpdesk_model->cntviewHelpcategory($conditions);
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   adminurl('viewHelpCategory');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != "all"){
                $conditions['limit']    =   $perpage;
            }
            $dta["urlvalue"]        =   adminurl('viewHelpCategory/');
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =    $this->helpdesk_model->viewHelpCategory($conditions);
            $this->load->view("ajax_helpcategory",$dta);
        }
        public function helpcategory_activedeactive(){
    		$vsp    =   "0";
    		if($this->session->userdata("active-deactive-helpdesk-category") != '1'){
    			$vsp    =   "0";
    		}else{
    			$status     =   $this->input->post("status");
    			$uri        =   $this->input->post("fields"); 
    			$p['whereCondition'] = "helpquecat_id = '".$uri."'";
    			$vue    =   $this->helpdesk_model->getHelpCategory($p);
    			if(is_array($vue) && count($vue) > 0){
    					$bt     =   $this->helpdesk_model->activedeactive($uri,$status); 
    					if($bt > 0){
    						$vsp    =   1;
    					}
    			}else{
    				$vsp    =   2;
    			} 
    		} 
    		echo $vsp;
        }
        public function delete_helpcategory(){
            $vsp    =   "0";
            if($this->session->userdata("delete-helpdesk-category") != '1'){
                $vsp    =   "0";
            }else {
                $uri    =   $this->uri->segment("3");
                $p['whereCondition'] = "helpquecat_id = '".$uri."'";
                $vue    =   $this->helpdesk_model->getHelpCategory($p);
                if(count($vue) > 0){
                    $bt     =   $this->helpdesk_model->delete_HelpCategory($uri); 
                    if($bt > 0){
                        $vsp    =   1;
                    }
                }else{
                    $vsp    =   2;
                } 
            } 
            echo $vsp;
        }
        public function update_helpcategory(){
            if($this->session->userdata("update-helpdesk-category") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
            }
            $uri    =   $this->uri->segment("3"); 
            $p['whereCondition'] = "helpquecat_id = '".$uri."'";
            $vue    =   $this->helpdesk_model->getHelpCategory($p);
            if(count($vue) > 0){
                    $dt     =   array(
                            "title"     =>  "Update Enquire Category",
                            "content"   =>  "up_helpdesk_category",
                            "icon"      =>  "mdi mdi-account",
                            "vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Helpdesk-Category")."'>Helpdesk Category</a></li>",
                            "view"      =>  $vue
                    ); 
                    if($this->input->post("submit")){
                        $this->form_validation->set_rules("helpdesk_ques_cat","Enquire About","required");
                            if($this->form_validation->run() == TRUE){
                                    $bt     =   $this->helpdesk_model->updateHelpCategory($uri);
                                    if($bt > 0){
                                            $this->session->set_flashdata("suc","Updated Helpdesk Category Successfully.");
                                            redirect(sitedata("site_admin")."/Helpdesk-Category");
                                    }else{
                                            $this->session->set_flashdata("err","Not Updated Helpdesk Category.Please try again.");
                                            redirect(sitedata("site_admin")."/Helpdesk-Category");
                                    }
                            }
                    }
                    $this->load->view("admin/inner_template",$dt);
            }else{
                    $this->session->set_flashdata("war","Helpdesk Category does not exists."); 
                    redirect(sitedata("site_admin")."/Helpdesk-Category");
            }
        }
        public function helpdesk_subcategory(){      
                   
            $dta    =   array(
                "title"     =>  "Helpdesk Enquire About",
                "content"   =>  "helpdesk_subcategory"
            );  
            if($this->input->post("submit")){    
               // echo "<pre>";print_r($_POST);exit;               
                $this->form_validation->set_rules("resturant_enquire_type","Enquire About","required");
                $this->form_validation->set_rules("helpdesk_ques_subcat","Enquire Questions","required");
             
                if($this->form_validation->run() == TRUE){
                    $bt     =   $this->helpdesk_model->create_helpdesksubcategory();
                    if($bt > 0){
                        $this->session->set_flashdata("suc","Created a Enquire  Successfully.");
                        redirect(sitedata("site_admin")."/Helpdesk-Subcategory");
                    }else{
                        $this->session->set_flashdata("err","Not Created a Enquire.Please try again.");
                        redirect(sitedata("site_admin")."/Helpdesk-Subcategory");
                    }
                }
            }     
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"helpquesubcatid";  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $orderby;
                $dta['tipoOrderby']    =   $tipoOrderby; 
            } 
            $dta["urlvalue"]     =   adminurl('viewHelpsubcategory/');   
           // print_R($dta["urlvalue"] );exit;
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewHelpsubcategory(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
          
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"helpquesubcatid";            
            $totalRec               =   $this->helpdesk_model->cntviewHelpsubcategory($conditions);  
        
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   adminurl('viewHelpsubcategory');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != "all"){
                $conditions['limit']    =   $perpage;
            }
            $dta["urlvalue"]        =   adminurl('viewHelpsubcategory/');
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =    $this->helpdesk_model->viewHelpSubCategory($conditions); 
           // echo "<pre>";print_r($dta["view"]);exit;
            $this->load->view("ajax_helpsubcategory",$dta);
        }
        public function helpsubcategory_activedeactive(){
            $vsp    =   "0";
            if($this->session->userdata("active-deactive-helpdesk-sub-category") != '1'){
                $vsp    =   "0";
            }else{
                $status     =   $this->input->post("status");
                $uri        =   $this->input->post("fields"); 
                $p['whereCondition'] = "helpquesubcat_id = '".$uri."'";
                $vue    =   $this->helpdesk_model->getHelpSubCategory($p);
                if(is_array($vue) && count($vue) > 0){
                        $bt     =   $this->helpdesk_model->activedeactivesub($uri,$status); 
                        if($bt > 0){
                            $vsp    =   1;
                        }
                }else{
                    $vsp    =   2;
                } 
            } 
            echo $vsp;
        }
        public function delete_helpsubcategory(){
            $vsp    =   "0";
            if($this->session->userdata("delete-helpdesk-sub-category") != '1'){
            $vsp    =   "0";
            }else {
            $uri    =   $this->uri->segment("3");
            $p['whereCondition'] = "helpquesubcat_id = '".$uri."'";
            $vue    =   $this->helpdesk_model->getHelpSubCategory($p);
            //print_r($vue);exit;
            if(count($vue) > 0){
                $bt     =   $this->helpdesk_model->delete_HelpSubCategory($uri); 
                if($bt > 0){
                    $vsp    =   1;
                }
            }else{
                $vsp    =   2;
            } 
            } 
            echo $vsp;
        }
        
        public function update_helpsubcategory(){
            if($this->session->userdata("update-helpdesk-sub-category") != '1'){
                redirect(sitedata("site_admin")."/Dashboard");
            }
            $uri    =   $this->uri->segment("3"); 
            
            $p['whereCondition'] = "helpquesubcat_id = '".$uri."'";
            $vue    =   $this->helpdesk_model->getHelpSubCategory($p);
            
            if(count($vue) > 0){
                $dt     =   array(
                        "title"     =>  "Update Enquire Sub Category",
                        "content"   =>  "up_helpdesk_subcategory",
                        "icon"      =>  "mdi mdi-account",
                        "vtil"      =>  "<li class='breadcrumb-item'><a href='". adminurl("Helpdesk-Subcategory")."'>Helpdesk Category</a></li>",
                        "view"      =>  $vue
                ); 
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("resturant_enquire_type","Enquire About","required");
                    $this->form_validation->set_rules("helpdesk_ques_subcat","Enquire Questions","required");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->helpdesk_model->updateHelpSubCategory($uri);
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Updated Helpdesk Sub Category Successfully.");
                                        redirect(sitedata("site_admin")."/Helpdesk-Subcategory");
                                }else{
                                        $this->session->set_flashdata("err","Not Updated Helpdesk sub Category.Please try again.");
                                        redirect(sitedata("site_admin")."/Helpdesk-Subcategory");
                                }
                        }
                }
                $this->load->view("admin/inner_template",$dt);
            }else{
                $this->session->set_flashdata("war","Helpdesk Category does not exists."); 
                redirect(sitedata("site_admin")."/Helpdesk-Subcategory");
            }
        }
        
        public function helpdesk_enquire(){
            $dta    =   array(
                "title"     =>  "Helpdesk Enquire Form",
                "content"   =>  "helpdesk_enquire_form"
            );  
            
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"helpdesk_id";  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $orderby;
                $dta['tipoOrderby']    =   $tipoOrderby; 
            } 
            $dta["urlvalue"]     =   adminurl('viewHelpenquireform/');   
          // print_R($dta["urlvalue"] );exit;
            $this->load->view("admin/inner_template",$dta);
        }
        
        public function viewHelpenquireform(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
          
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"helpdesk_id";            
            $totalRec               =   $this->rest_helpdesk_model->cntviewHelpenquireform($conditions);
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   adminurl('viewHelpenquireform');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != "all"){
                $conditions['limit']    =   $perpage;
            }
            $dta["urlvalue"]        =   adminurl('viewHelpenquireform/');
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =    $this->rest_helpdesk_model->viewHelpenquireform($conditions); 
         // echo "<pre>";print_r($dta["view"]);exit;
            $this->load->view("ajax_helpenquireform",$dta);
        }
        public function __destruct(){
                $this->db->close();
        }
}