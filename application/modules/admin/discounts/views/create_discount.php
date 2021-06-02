<div class="row layout-top-spacing">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="container-fluid py-3 pt-4 bb-grey sticky">
					<div class="row">	
                        <div class="col-md-10 mx-auto box-shaow">	
                         <div class="row">					
                            <div class="col-md-6">
                                <h4><?php echo $title;?></h4>
                            </div>
                            <div class="col-md-6" align="right">
                                <a href="<?php echo partnerurl('Discount');?>" class="btn btn-danger"> Cancel</a>
                                <button type="submit" class="btn btn-primary" name="publish" value="Publish">publish</button>
                            </div>
                         </div>
                        </div>    
					</div>
				</div>
				<div class="container-fluid py-3 pt-4">
					<?php $this->load->view('admin/success_error');?>
					<div class="row">
						<div class="col-md-10 mx-auto box-shaow">			
					         <div class="">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                         <label >Type of Discount *</label>
                                         <select class="form-control" name="discount_type" id="exampleFormControlSelect1" required onchange="discType()">
											<option value="">Select Discount Type</option>
                                            <?php foreach($this->config->item('discountType') as $d){ ?>
                                                <option value="<?php echo $d; ?>" <?php if(set_value('discount_type')==$d){echo 'selected';}?> ><?php echo $d; ?></option>
                                            <?php }	 ?>										
										</select>
                                        <div class="invalid-feedback discc">
                                                        Please provide a valid discount type.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label > Discount *</label>
                                        <div class=" input-group b-grey">
                                            <input type="number" class="form-control" name="discount" placeholder="Enter Discount Amount" aria-label="notification" aria-describedby="basic-addon2"   value="<?php echo set_value('discount')?>" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-percent" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="invalid-feedback">
                                                        Please provide a valid discount.
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <label >MIN Discount Value *</label>
                                        <div class="form-group b-grey">
                                            <div class="d-flex">
                                               <h5 class="mt-3 mr-3"> KD</h5>
                                                <input type="number" class="form-control arabic_feild"  name="min_discount"  value="<?php echo set_value('discount')?>" required />
                                            </div>
                                            <div class="invalid-feedback">
                                                    Please provide a valid discount.
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                       
                                     </div>
                                    
                                    <div class="col-md-4">
                                         <div class="form-group b-grey">
                                         <label >Validity Period *</label>
                                         <input id="rangeCalendarFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" name="date" placeholder="Select Date.." value="<?php echo set_value('date')?>">
                                            <div class="invalid-feedback">
                                                Please provide a valid  Date.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 row">
                                        <div class="col-md-12">
                                        <label >Daily Time Slot *</label>
                                            </div>
                                        <div class="col-md-6">
                                         <div class="form-group b-grey">
                                         <input class="form-control" id="timepicker2" name="strt_time" value="<?php echo set_value('strt_time');?>" required />
                                            <div class="invalid-feedback">
                                                Please provide a valid Time.
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group b-grey">
                                                <input id="timepicker1" name="end_time" value="<?php echo set_value('end_time');?>"  class="form-control" required/>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid Time.
                                                    </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>    

                                 
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Type Of Customer *</label>                                       
                                     </div>                                    
                                    <div class="col-md-4">                                        
                                         <div class="form-group b-grey">
                                                
        										<input type="radio"  name="typeofcust" value="All" <?php if(set_value('typeofcust')=='All'){echo 'selected';}?>/>
        										<label >All</label>        									
                                        </div>
                                    </div>
                                    <div class="col-md-4">                                      
                                        <div class="form-group b-grey">
        										<input type="radio"  name="typeofcust" value="First Time Customer" <?php if(set_value('typeofcust')=='First Time Customer'){echo 'selected';}?>/>
        										<label >First Time Customer </label>        									
                                        </div>                                       
                                    </div>
                                </div>  
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Applicable Outlets *</label> 
                                        <select id="tyyy" name="for_type" class="form-control" onchange="typeee()" required>
                                            <option value="">Select Type</option>
                                            <?php foreach($this->config->item('discountBased') as $d){ ?>
                                                <option value="<?php echo $d; ?>" <?php if(set_value('for_type')==$d){echo 'selected';}?> ><?php echo $d; ?></option>
                                            <?php }	 ?>	
                                        </select>    <br><br>                    
                                     </div>                                    
                                    <div class="col-md-4" id="catt" style="display:none;"> 
                                        <ul class="file-tree">
                                            <?php 
                                            $cate = set_value('category_id');
                                            $ite = set_value('item_id');
                                            foreach($category as $c){?>
                                                <li class="file-tree-folder"><?php echo $c->resturant_category_name;?>
                                                    <input type="checkbox" class="<?php echo 'm'.$c->resturant_category_id;?>" name="cat[]" value="<?php echo $c->resturant_category_id;?>" onchange="checkall('<?php echo $c->resturant_category_id;?>')" <?php if( is_array($cate) && in_array($c->resturant_category_id,$cate)){echo 'checked';}?>>
                                                    <ul class="">
                                                        <?php $restid = $this->session->userdata("restraint_id");
		                                                    $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_category_id = '".$c->resturant_category_id."'";
                                                            $itemsa = $this->menu_model->viewItems($par);
                                                            foreach($itemsa as $i){ ?>
                                                                <li class="produc"><?php echo $i->resturant_items_name;?>
                                                                    <input type="checkbox" name="prod[]" value="<?php echo $i->resturant_items_id;?>" class="<?php echo $i->resturant_category_id;?>" <?php if( is_array($ite) && in_array($i->resturant_items_id,$ite)){echo 'checked';}?>>
                                                                </li>
                                                            <?php }?>
                                                    </ul>
                                                </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
