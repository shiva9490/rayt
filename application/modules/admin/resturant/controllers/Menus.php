<?php
class Menus extends CI_Controller{
	public function __construct(){
		parent::__construct();
	    if($this->session->userdata("login_id") == ""){
			redirect(base_url('Admin/Login'));
		}
	}
	public function index(){
		$restid = $this->uri->segment('3');
		$par['whereCondition'] = "resturant_id = '".$restid."'";
		$dta    =   array(
			"title"     	=>  "Menu",
			"content"  		=>  'menu',
			"urlvalue"		=>	adminurl('viewMenu/'),
			"category"		=>  $this->menu_model->viewCategory($par),
			"subcategory"	=>  $this->menu_model->viewSubCategory($par),
			"items"			=>  $this->menu_model->viewItems($par),
			"categoryid"    =>  ""
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
		$dta["view"]            =   $this->menu_model->viewItems($conditions); 
		$dta['urlvalue']		=   adminurl('ViewItems/'.$restid.'/');
		$this->load->view('admin/inner_template',$dta);
	}
	public function create(){
		$number = rand(111,999);
		$id = 'RAYT'.date('ym').$number;
		$dta    =   array(
			"title"     =>  "Create Resturant Form",
			"content"   =>  'create_resturant',
			"id"		=> $id,
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('name','Resturant Name','required');
			$this->form_validation->set_rules('name_a','Resturant Name in arabic','required');
			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
			$this->form_validation->set_rules('Percentage','Percentage','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->resturant_model->create($id);
                if($res != ''){
                    $this->session->set_flashdata("suc","Created Resturant successfully."); //Update menu and items on bottom of the page
                     redirect(adminurl('Resturant'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/inner_template',$dta);
	}
	
	public function ViewItems(){
		$conditions =   array();
		$page       =   $this->uri->segment('4');
		$offset     =   (!$page)?0:$page;
		$keywords   =   $this->input->post('keywords');
		$restid = $this->uri->segment('3');
		$par['whereCondition'] = "resturant_id = '".$restid."'";
		$cat = $this->menu_model->viewCategory($par);
		$c='';$b='';
		if(is_array($cat) && count($cat)>0){
		    $b= $cat[0];
		    $c= $cat[0]->resturant_category_id;
		}
		$category = ($this->input->post('category')!="")?$this->input->post('category'):$c;
		$restid = $this->uri->segment('3');
		if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
		}
		$hr = "resturant_id = '".$restid."'";
		if($category !=""){
			$hr .="AND resturant_category_id LIKE '".$category."'";
		}
		$conditions['whereCondition'] = $hr;
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"resturant_itemid";  
		$totalRec               =   $this->menu_model->cntviewItems($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$conditions['order_by']      =   $orderby;
			$conditions['tipoOrderby']   =   $tipoOrderby; 
			$conditions['limit']   		 =   $perpage; 
		}
		$dta["view"]                     =   $this->menu_model->viewItems($conditions); 
		$d='';
		if(is_array($dta["view"]) && count($dta["view"]) >0){
		    $d= $dta["view"][0]->resturant_category_id;
		}
		$dta["category"]                 =   ($category!="")?$category:$d;
		$dta["cate_id"]                  =   $b;
		$this->load->view('ajax_items_list',$dta);
	}
	public function resturant($str){
        //$vsp	=	$this->resturant_model->unique_id_resturant($str); 
        // if($vsp){
        //     $this->form_validation->set_message("resturant","Resturant Name already exists.");
        //     return FALSE;
        // }
        return TRUE; 
    }
    
	public function viewMenu($str){
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
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'5';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"resturantid";  
		$totalRec               =   $this->menu_model->cntviewMenu($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		}
		$config['base_url']     =   adminurl('viewMenu/');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		if($perpage != "all"){
			$conditions['limit']    =   $perpage;
		}
		$dta["limit"]           =   $offset+1;
		$dta["urlvalue"]        =   adminurl('viewMenu/');
		$dta["view"]            =   $this->menu_model->viewResturant($conditions); 
		$this->load->view("ajax_resturant",$dta);
	}
	
	public function ajax_resturant_active(){
		$status     =   $this->input->post("status");
		$uri        =   $this->input->post("fields");
		$params["whereCondition"]   =   "resturant_id = '".$uri."'";
		$vue    =   $this->menu_model->getResturant($params);
		if(is_array($vue) && count($vue) > 0){
			$bt     =   $this->menu_model->activedeactive($uri,$status); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		}
		echo $vsp;
	}
	
	public function update_resturant($str){
        $pmrs["whereCondition"]  =   "resturant_id LIKE  '".$str."'";
        $vsp	=	$this->menu_model->getResturant($pmrs);
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update resturant",
    			"content"   =>  "update_resturant",
    			"view"      =>  $vsp
    		);
    	    if($this->input->post('update')){
    			$this->form_validation->set_rules('name','Resturant Name','required');
    			$this->form_validation->set_rules('name_a','Resturant Name','required');
    			$this->form_validation->set_rules('preparation_time','Preparation Time','required');
    			$this->form_validation->set_rules('Percentage','Percentage','required');
    			if($this->form_validation->run() == TRUE){
                    $res = $this->menu_model->update_resturant($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Resturant succfully.");
                        redirect(adminurl('Resturant'));
                    }else{
                        $this->session->set_flashdata("err","update Resturant failed.");
                    }
    	        }
    	    }
    	    $conditions=array();
    	    $conditions['id']=$str;
    	    $dta['images']=$this->menu_model->viewResImages($conditions); 
		    $this->load->view("admin/inner_template",$dta); 
        }
	}
	public function delete_resturant(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "resturant_id = '".$uri."'";
		$vue    =   $this->menu_model->getResturant($params);
		if(count($vue) > 0){
			$bt     =   $this->menu_model->delete_resturant($uri); 
			if($bt > 0){
				$vsp    =   1;
			}
		}else{
			$vsp    =   2;
		} 
		echo $vsp;
	}
	
	public function delete_res_image(){
		$uri    =   $this->uri->segment("3");
		$params["whereCondition"]   =   "resturant_images_id = '".$uri."'";
		$vue    =   $this->menu_model->getResImages($params);
		if(count($vue) > 0){
		    $res=$vue['resturant_id'];
			$bt     =   $this->menu_model->delete_resImages($uri); 
			unlink($vue['resturant_images_path']);
			if($bt > 0){
			    $this->session->set_flashdata("suc","image deleted sucessfully");
				redirect(adminurl('Update-Resturant/'.$res));
			}
		}else{
			$this->session->set_flashdata("err","Unable to delete");
			redirect(adminurl('Resturant'));
		} 
		echo $vsp;
	}
	public function add_items($id){
	    if($this->session->userdata("tempid") != ""){
	        $t = $this->session->userdata("tempid");
	    }else{
	        $this->session->set_userdata("tempid",date('Ymdhis'));
	        $t = $this->session->userdata("tempid");
	    }
	    $dta    =   array(
			"title"     =>  "Add Item",
			"content"   =>  "add_item",
			"tempid"    =>  $t,
		);
		if($this->input->post('publish')){
		    $this->form_validation->set_rules('veg_type','Item Type','required');
			$this->form_validation->set_rules('itemname_a','Item Name','required');
			$this->form_validation->set_rules('itemname','Item Name English','required');
			$this->form_validation->set_rules('details','Basic Details','required');
			$this->form_validation->set_rules('item_price','Item Price','required');
			$this->form_validation->set_rules('final_amount','Final Amount','required');
			$this->form_validation->set_rules('timings','Item timings','required');
			$fname      =   $_FILES['main_image']['name'];
            if (empty($fname)){
                $this->form_validation->set_rules('main_image', 'Item Image', 'required');
            }
			if($this->form_validation->run() == TRUE){
                $res = $this->menu_model->additem();
                if($res){
                    $this->session->set_flashdata("suc","image deleted sucessfully");
				    redirect(adminurl('Update-Resturant/'.$res));
                }
			}
		}
		$this->load->view("admin/inner_template",$dta); 
	}
	public function Update_items($id){
	    $this->session->set_userdata("tempid",date('Ymdhis'));
		$parms['whereCondition'] = "resturant_items_id = '".$id."'";
		$vue	= $this->menu_model->getItems($parms);
		//print_r($vue[0]['resturant_id']);exit;
	    $dta    =   array(
			"title"     =>  "Update Item",
			"content"   =>  "update_item",
			"tempid"    =>  $this->session->userdata("tempid"),
			"view"		=>  $vue
		);
		if($this->input->post('publish')){
		     //print_r($this->input->post());exit;
		    $this->form_validation->set_rules('veg_type','Item Type','required');
			$this->form_validation->set_rules('itemname_a','Item Name','required');
			$this->form_validation->set_rules('itemname','Item Name English','required');
			$this->form_validation->set_rules('details','Basic Details','required');
			$this->form_validation->set_rules('item_price','Item Price','required');
			$this->form_validation->set_rules('final_amount','Final Amount','required');
			$this->form_validation->set_rules('timings','Item timings','required');
		    //$fname      =   $_FILES['main_image']['name'];
            /*if (empty($fname)){
                $this->form_validation->set_rules('main_image', 'Item Image', 'required');
            }*/
			if($this->form_validation->run() == TRUE){
                $res = $this->menu_model->updateitem($id);
                if($res){
                    $this->session->set_flashdata("suc","Resturant Item Updated");
				    redirect(adminurl('Menus/'.$vue[0]['resturant_id']));
                }
			}
		}
		$this->load->view("admin/inner_template",$dta); 
	}
	public function weely_avaliable(){
		$data = array(
			'eve'=>$this->input->post('eve'),
		);
		$this->load->view("weekly_available",$data); 
	}
	public function addon_model(){
	    $fr = "ra.resturant_id LIKE '".$this->session->userdata("restraint_id")."' AND ra.resturant_addon_temp_id LIKE '".$this->input->post('tempid')."'";
	    //if($this->input->post('ids') != "0"){
	    //    $fr .= "AND ra.resturant_addon_category LIKE '".$this->input->post('eve')."' OR ra.resturant_addon_category LIKE '".$this->input->post('eve')."'";
	    //}
	    $par['whereCondition'] = $fr;
	    $res = $this->menu_model->viewAddon($par);
		$data = array(
			'eve'   => $this->input->post('eve'),
			'title' => $this->input->post('title'),
			'total' => $this->input->post('total'),
			'tempid'=> $this->input->post('tempid'),
			'datas' => $res,
		);
		$this->load->view("variant_model",$data);
	}
	public function variant_model(){
	    $gr = "rv.resturant_id LIKE '".$this->session->userdata("restraint_id")."'";
	    $gr .= "AND rv.resturant_variants_tempid LIKE '".$this->input->post('tempid')."'";
	    if($this->input->post('ids') != "0"){
	        $gr .= "AND rv.resturant_variants_category LIKE '".$this->input->post('eve')."' OR rv.resturant_variants_category LIKE '".$this->input->post('eve')."'";
	    }
	    $par['whereCondition'] = $gr;
	    $datas = $this->menu_model->viewVariants($par);
		$data = array(
			'eve'   => $this->input->post('eve'),
			'title' => $this->input->post('title'),
			'total' => $this->input->post('total'),
			'tempid'=> $this->input->post('tempid'),
			'datas' => $datas
		);
		
		$this->load->view("addon_model",$data); 
	}
	public function veg_types(){
        $veg   =   $this->config->item("veg");
        $option='<option value="">Select Veg</option>';
	    foreach($veg as $key=>$veg){
            $option.="<option value=".$veg.">".$veg."</option>";
        }
        print_r($option);
	}
	public function min_selection(){
        $eve   =  $this->input->post('eve');
        $option="";
	    for($i=1; $i<=$eve; $i++ ){
            $option.="<option value=".$i.">".$i."</option>";
        }
        print_r($option);
	}
	public function add_category(){
	    $dat = array(
	        'title' =>$this->input->post('title'),
	    );
	    $this->load->view('add_category',$dat);
	}
	public function adding_category(){
	    
	    if($this->input->post()){
	        //$check = $this->checkcategory($this->input->post('category'));
	        //if($check)
			$res = $this->menu_model->addcategory();
            if($res != ''){
                echo "Created category successfully.";
            }else{
				echo "failed.";
            }
		}
	}
	
	public function checkcategory($str){
        $vsp    =   $this->menu_model->checkcategory($str); 
        if(!$vsp){
            $this->form_validation->set_message("category","Category Name does not exists.");
            return FALSE;
        }
        return TRUE;
    }
    public function adding_variant(){
        if($this->input->Post()!=""){
            $vsp = $this->menu_model->adding_variant();
            if($vsp){
                echo 1;
            }else{
                echo 2;
            }
        }
    }
    public function adding_variants(){
        if($this->input->Post()!=""){
            $vsp = $this->menu_model->adding_variants();
            if($vsp){
                echo 1;
            }else{
                echo 2;
            }
        }
    }
    public function active_inactive_item(){
        if($this->input->post()!=""){
            $status = $this->input->post('status');
            $uri = $this->input->post('eve');
            $par['whereCondition'] ="resturant_items_id LIKE '".$uri."'";
            $res = $this->menu_model->getItems($par);
            if(is_array($res) && count($res) >0){
                $vsp = $this->menu_model->active_inactive_item($uri,$status);
                if($vsp){
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                echo 2;
            }
        }
    }
}
?>