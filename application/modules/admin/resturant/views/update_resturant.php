       
<?php
$sr     =   $this->session->userdata("active-deactive-resturant");
$cr     =   $this->session->userdata("create-resturant");
$ur     =   $this->session->userdata("update-resturant");
$dr     =   $this->session->userdata("delete-resturant");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   
    <?php } ?>
    <div class="col-lg-12">
      <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">Resturant update</div>
                   
                </div>
            </div>
         <div class="card-body">
                    <!--  BEGIN CONTENT AREA  -->
            <div  class="main-content">
                <div class="layout-px-spacing">                
                        
                    <div class="account-settings-container layout-top-spacing">

                        <div class="account-content">
                            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">                                   
                                        <div  class="section general-info mb-4">
                                          <div class="info">
                                              <h6 class="">General Information</h6>
                                              <div class="row">                                              
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-md-12 m-3">
                                							        <label for="Resturantname" >Resturant Logo *</label>
                                									<div class="row">
                                										<div class="upload col-md-12">
                                                                            <input type="file" name="restlogo" id="input-file-max-fs" class="dropify" data-default-file="<?php echo base_url().'upload/resturants/'.$view['resturant_logo_image'];?>" data-max-file-size="2M" />
                                                                            <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Logo</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 m-3">
                                									<label for="Resturantname" >Resturant Name *</label>
                                									<div class="row">
                                										<div class="col-md-12">
                                											<div class="form-group b-grey">
                                											    <input type="text" class="form-control arabic_feild width-100"  name="name_a" value="<?php echo $view['resturant_name_a'];?>" placeholder="أدخل اسم المطعم" required>	
                                												<div class="invalid-feedback">
                                													Please provide a valid Resturant Arabic Name.
                                												</div>
                                												<input type="text" class="form-control width-100"  id="Resturantname" name="name" value="<?php echo $view['resturant_name'];?>" placeholder="Enter Resturant Name" required>
                                												<div class="invalid-feedback">
                                													Please provide a valid Resturant Name.
                                												</div>
                                											</div>								
                                										</div>
                                									</div>
                                									<span class="text-danger"><?php echo form_error('name_a'); ?></span>
                                									<span class="text-danger"><?php echo form_error('name'); ?></span>
                                								</div>
                                                            </div>  
                                                        </div>
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-md-12 m-3">
                                                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                                                        <label>Resturant Main Image (Single File)  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                                        <label class="custom-file-container__custom-file" >
                                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input"  name="main_image" accept="image/*">
                                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                            <div class="invalid-feedback">
                                                                                Please provide a valid Resturant Main Image.
                                                                            </div>
                                                                        </label>                                                                       
                                                                        <div class="custom-file-container__image-preview"> <img src="<?php echo base_url().'upload/resturants/'.$view['resturant_image']?>" />  </div>
                                                                      
                                                                    </div>
                                                                </div>                                                               
                                                            </div> 
                                                        </div>

                                                        <!-- <div class="form">
                                                            <div class="row">
                                                                 <div class="col-md-12 m-3">
                                                                    <div class="custom-file-container" data-upload-id="mySecondImage">
                                                                        <label>Resturant Images (Allow Multiple) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                                        <label class="custom-file-container__custom-file" >
                                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="files[]" multiple required>
                                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                            <div class="invalid-feedback">
                                                                                Please provide a valid Resturant Images.
                                                                            </div>
                                                                        </label>
                                                                        <?php foreach($images as $i){
                                                                            if($i->resturant_images_path){?>                                                                            
                                                                            <img src="<?php echo base_url($i->resturant_images_path);?>" width="200px"/>
                                                                            <?php }else{ ?>
                                                                                <div class="custom-file-container__image-preview"></div>                                                                           </div>
                                                                        <?php } }?>
                                                                    </div>						  
                                                                </div>                                                                                                                           
                                                            </div> 
                                                        </div> -->
                                                    </div>                                                       
                                              </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div id="about" class="section about">
                                            <div class="info">
                                                <h5 class="">Contact Person</h5>
                                                <div class="row">
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label for="fullName">Contact Person</label>
                                                                    <input type="text" class="form-control  arabic_feild" name="contact_person_a" value="<?php echo $view['resturant_contact_a'];?>" placeholder="أدخأدخل اسم جهة الاتصال" required/>
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Contact Person Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control" name="contact_person" placeholder="Enter Contact Person Name" value="<?php echo $view['resturant_contact'];?>" required/>
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Contact Person.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Position </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="position_a" value="<?php echo $view['resturant_position_a'];?>" placeholder="أدخل الوظيفة"  required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Position Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="position" value="<?php echo $view['resturant_position'];?>" placeholder="Enter Position" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Position.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>
                                                          
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Contact No</label>
                                                                    <input type="text" class="form-control"  name="contact_no" value="<?php echo $view['resturant_contact_no'];?>" placeholder="Enter Contact number" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Contact No.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Area </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="area_a" value="<?php echo $view['resturant_area_a'];?>" placeholder="أدخل المنطقة"  required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Area Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="area" value="<?php echo $view['resturant_area'];?>" placeholder="Enter Area" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Area.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Block No </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="block_a" value="<?php echo $view['resturant_block_a'];?>" placeholder="أدخل الكتلة"  required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Block No Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="block" value="<?php echo $view['resturant_block'];?>" placeholder="Enter block" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Block No.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Street </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="street_a" value="<?php echo $view['resturant_street_a'];?>"  placeholder="أدخل الشارع" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Street Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="street"  value="<?php echo $view['resturant_street'];?>" placeholder="Enter street" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Street.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Jaada </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="jaada_a" value="<?php echo $view['resturant_jaada_a'];?>" placeholder="أدخل الجادة" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Jaada Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="jaada" value="<?php echo $view['resturant_jaada'];?>" placeholder="Enter jaada" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Jaada.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">House No </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="house_a" value="<?php echo $view['resturant_house_a'];?>" placeholder="ادخل المنزل" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant House No Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="house" value="<?php echo $view['resturant_house'];?>" placeholder="Enter house" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant House No.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Building No </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="building_a" value="<?php echo $view['resturant_building_a'];?>"  placeholder="أدخل المبنى" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Building No Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="building" value="<?php echo $view['resturant_building'];?>"  placeholder="Enter building" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Building No.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Lattitude </label>
                                                                    <input type="text" class="form-control"  name="latitude" value="<?php echo $view['resturant_latitude'];?>"  placeholder="Enter latitude" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Lattitude.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Longitude </label>
                                                                    <input type="text" class="form-control"  name="longitude" value="<?php echo $view['resturant_longitude'];?>" placeholder="Enter longitude" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Longitude.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-4">
                                                                    <label class="dob-input">Landmark </label>
                                                                    <input type="text" class="form-control arabic_feild"  name="landmark_a"  value="<?php echo $view['resturant_landmark_a'];?>" placeholder="أدخل المَعلم" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Landmark Arabic.
                                                                    </div>
                                                                    <input type="text" class="form-control"  name="landmark" value="<?php echo $view['resturant_landmark'];?>" placeholder="Enter landmark" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Landmark.
                                                                    </div>
                                                                </div>                                                                                                                                           
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                 

                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div id="contact" class="section contact">
                                            <div class="info">
                                                <h5 class="">Menu hours</h5>
                                                <div class="row">
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                        <div class="col-md-12 m-3">   
                                                                                                        
                                                            <?php 
                                                          // print_r($resttime[0]->resturant_start_time);exit;
                                                              $menu   =   $this->config->item("menu_hours");
                                                            //   $mm   = explode(',',$view['resturant_menu_hours']);
                                                              
                                                            //   $mstart   = explode(',',$resttime[0]->resturant_start_time);
                                                            //   $mend   = explode(',',$resttime[0]->resturant_end_time);
                                                             // print_r($mstart);exit;

                                                           $j=1; foreach($resttime as $key=>$i){
                                                               // echo "<pre>";print_r($i);exit;
                                                            ?>
                                                            <div class="form-group b-grey">
                                                              <div class="row">
                                                                <div class="col-md-2">
                                                                <label><?php echo $i->resturant_weekly;?> -
												                <input type="hidden"  name="resturant_weekly[]" value="<?php echo $i->resturant_weekly;?>"  />
                                                                </div>
                                                                <div class="col-md-4">
                                                                <input class="form-control" type="hidden" name="resturanttime_id[]" value="<?php echo $i->resturanttime_id;?>" required />
                                                                  <input class="form-control" id="timepicker<?php echo $j;?>" name="strt_time[]" value="<?php echo $i->resturant_start_time;?>" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <input id="timepicker1<?php echo $j;?>" name="end_time[]" value="<?php echo $i->resturant_end_time;?>"  class="form-control"/>
                                                                </div>
                                                               
                                                                <div class="col-md-2">		
                                                                <input type="checkbox" class="" name="menu_hours[<?php echo $key; ?>]" value="0" id="<?php echo $i->resturant_close_time;?>" 
                                                                <?php if($i->resturant_close_time == '0'){echo 'checked';}?>/>
                                                                <?php if($i->resturant_close_time == '0'){?>
                                                                    <label >Open</label>	
                                                                <?php } else{?>  <label >closed</label>	 <?php }?>
                                                               							
                                                                
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <?php 
                                                             $j++;
                                                              }
                                                            
                                                            ?>
                                                          </div>
                                                          
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-4">
                                                                    <label >Preparation Time *</label> 
                                                                    <input type="text" class="form-control"  name="preparation_time" value="<?php echo $view['resturant_preparation'];?>"  placeholder="Enter Preparation Time" required >
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Preparation Time.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-4">
                                                                    <label >Delivery Fee</label>
                                                                    <input type="text" class="form-control"  name="delivery_fee" value="<?php echo $view['resturant_delivery'];?>" placeholder="Enter Delivery Fee"/>
                                                                    <div class="invalid-feedback">
                                                                        Please provide a Delivery Fee.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-4">
                                                                    <label >Discount</label>
                                                                    <input type="text" class="form-control"  name="discount" value="<?php echo $view['resturant__discount'];?>" placeholder="Enter Discount" required />
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Discount.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                            									<div class="form-group mb-4">
                            										<label >Min Order</label>
                            										<input type="text" class="form-control"  name="minorder" value="<?php echo $view['resturant_minorder'];?>" placeholder="Enter Min Order" required />
                            										<div class="invalid-feedback">
                            											Please provide a valid Min Order.
                            										</div>
                            									</div>
                            								</div>
                                                            <div class="col-md-12">
                            									<div class="form-group mb-4">
                            										<label for="exampleFormControlSelect1">Rating *</label>
                            										<select class="form-control" name="rating" id="exampleFormControlSelect1"required >
                            											<option value="">Select Rating</option>
                            											<?php 
                            												$rating   =   $this->config->item("rating");
                            												foreach($rating as $ra){
                            											?>
                            											<option value="<?php echo $ra;?>" <?php if($view['resturant_rating'] == $ra){echo 'selected';} ?>><?php echo $ra;?></option>
                            											<?php } ?>
                            										</select>
                            										<div class="invalid-feedback">
                            											Please provide a valid Zone.
                            										</div>
                            									</div>
                            								</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div id="contact" class="section contact">
                                            <div class="info">
                                                <h5 class="">Cuisine </h5>
                                                <div class="row">
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-md-12 m-3">                                                                                                     
                                                          
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid Resturant Main Image.
                                                                    </div>
                                                                    <?php
                                                                        $cuisines   = explode(',',$view['resturant_cuisine']);
                                                                        //print_r($cuisines);exit;
                                                                        $par['whereCondition']="cuisine_acde LIKE 'Active'";
                                                                        $cuisine = $this->cuisine_model->view_cuisine($par);
                                                                        if(is_array($cuisine) && count($cuisine) >0){
                                                                            // echo '<pre>';print_r($cuisine);exit;
                                                                            foreach($cuisine as $cui){
                                                                    ?>     
                                                                            <div class="form-group b-grey">
                                                                                <input type="checkbox" id="8" name="cusine[]" value="<?php echo $cui->cuisine_id;?>" <?php if(in_array($cui->cuisine_id,$cuisines)){echo 'checked';}?>/>
                                                                                <label for="8"><?php echo $cui->cuisine_name;?></label>
                                                                            </div>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                          </div>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                       <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div class="section contact">
                                            <div class="info">
                                                <h5 class="">Zone Information </h5>
                                                <div class="row">
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="row">                                                          
                                                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group  mb-4">
                                                                        <label >Zone*</label>
                                                                         <select class="form-control" name="zone" id="exampleFormControlSelect1"required >
                                                                            
                                                                            <?php 
                                                                                $pars['group_by']       = "zones.zone_name";
                                                                                $pars['whereCondition'] = "zone_abc LIKE 'Active'";
                                                                                $zone   =   $this->zone_model->viewZones($pars);
                                                                              $i=0;foreach($zone as $z){
                                                                            ?>
                                                                            <option value="<?php echo $z->zone_id;?>" <?php if($view['resturant_zone'] == $z->zone_id){echo 'selected';} ?>><?php echo $z->zone_name;?></option>
                                                                            <?php } ?>
                                                                          </select>
                                                                          <div class="invalid-feedback">
                                                                            Please provide a valid Zone.
                                                                          </div>                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-4">
                                                                            <label >Set delivery time for Zone *</label>
                                                                            <select class="form-control" name="zone_time" id="exampleFormControlSelect1" required>
                                                                              <option value="">Select delivery time for Zone</option>
                                                                              <?php 
                                                                                $zone   =   $this->config->item("subzone");
                                                                                $i=0;foreach($zone as $sz){
                                                                              ?>
                                                                              <option value="<?php echo $sz;?>" <?php if($view['resturant_zone_time'] == $sz){echo 'selected';} ?>><?php echo $sz;?></option>
                                                                              <?php } ?>
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                              Please provide a valid Set delivery time for Zone.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-4">
                                                                          <label for="exampleFormControlSelect1">Sub Zone *</label>
                                                                          <select class="form-control" name="sub_zone" id="exampleFormControlSelect1" required >                                                                          
                                                                            <?php 
                                                                                $pars['group_by']       = "zones.zone_name";
                                                                                $pars['whereCondition'] = "zone_abc LIKE 'Active'";
                                                                              $zones   =   $this->zone_model->viewZones($pars);
                                                                              foreach($zones as $z){
                                                                            ?>
                                                                            <option value="<?php echo $z->zone_id;?>" <?php if($view['resturant_subzone'] == $z->zone_id){echo 'selected';} ?>><?php echo $z->zone_name;?></option>
                                                                            <?php } ?>
                                                                          </select>
                                                                          <div class="invalid-feedback">
                                                                            Please provide a valid Sub Zone.
                                                                          </div>
                                                                        </div>
                                                                    </div>     

                                                                     <div class="col-md-12">
                                                                        <div class="form-group mb-4">
                                                                          <label for="exampleFormControlSelect1">Set delivery time for subzone *</label>
                                                                          <select class="form-control" name="sub_zone_time" id="exampleFormControlSelect1" required>                                                                             
                                                                            <?php 
                                                                              $zone   =   $this->config->item("subzone");
                                                                              $i=0;foreach($zone as $sz){
                                                                            ?>
                                                                            <option value="<?php echo $sz;?>" <?php if($view['resturant_subzone_time'] == $sz){echo 'selected';} ?>><?php echo $sz;?></option>
                                                                            <?php } ?>
                                                                          </select>
                                                                          <div class="invalid-feedback">
                                                                            Please provide a valid Set delivery time for subzone.
                                                                          </div>
                                                                        </div>
                                                                    </div>                                 
                                                                                                                        
                                                                </div>
                                                            </div>
                                                         </div>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div class="section contact">
                                            <div class="info">
                                                <h5 class="">Legal Information </h5>
                                                <div class="row">
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="row">                                                           
                                                            <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-4">
                                                                            <label >Contract Date *</label>
                                                                            <input id="basicFlatpickr" value="<?php echo $view['resturant_contract'];?>" class="form-control flatpickr flatpickr-input active" type="text" name="contact_date" required />
                                                                            <div class="invalid-feedback">
                                                                                Please provide a valid Contract Date.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-4">
                                                                        <label >Commercial License Number *</label>
                                                                            <input type="number" class="form-control"  name="license_no" value="<?php echo $view['resturant_commertial_license'];?>" placeholder="Enter License Number" required />
                                                                            <div class="invalid-feedback">
                                                                                Please provide a valid Commercial License Number .
                                                                            </div>
                                                                        </div>
                                                                    </div>                                 
                                                                                                                        
                                                                </div>
                                                            </div>
                                                         </div>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                   
                                     <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div id="edu-experience" class="section edu-experience">
                                            <div class="info">
                                                <h5 class="">Signature Authority</h5>
                                                <div class="row">                                                   
                                                    <div class="col-md-11 mx-auto">
                                                        <div class="edu-section">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-4">
                                                                        <label >Civil Id *</label>
                                                                        <input type="text" class="form-control" placeholder="owner civil id"  name="civil_id" value="<?php echo $view['resturant_civil_id'];?>" required />
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid Civil Id .
                                                                        </div>
                                                                    </div>
                                                                </div>    

                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-4">
                                                                        <label >Percentage *</label>
                                                                        <input type="text" class="form-control"  name="Percentage" value="<?php echo $view['resturant_percentage'];?>"  placeholder="Enter Percentage" required>
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid Percentage.
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group mb-4">
                                                                        <label >Sales Person Name *</label>
                                                                        <input type="text" class="form-control arabic_feild"  name="person_name_a" placeholder="أدخل مندوب المبيعات" value="<?php echo $view['resturant_sales_person_a'];?>" required />
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid Sales Person Name Arabic.
                                                                        </div>
                                                                        <input type="text" class="form-control"  name="person_name" placeholder="Enter Sales Person Name" value="<?php echo $view['resturant_sales_person'];?>" required />
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid Sales Person Name.
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                          </div>                                         
                                      </div>                                   
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="ml-4">
                                                <button type="submit" value="Submit" name="submit" class="btn btn-dark">Save Changes</button>
                                                <a  class="btn btn-primary" href="<?php echo base_url().'Rayt-Admin/Resturant'; ?>">Return Back</a>
                                            </div>
                                        </div>
                                    </div> 
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  END CONTENT AREA  -->    
           
         </div>
      </div>
   </div>
</div>
