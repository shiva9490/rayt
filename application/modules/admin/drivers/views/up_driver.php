<?php
$sr     =   $this->session->userdata("active-deactive-driver");
$cr     =   $this->session->userdata("create-driver");
$ur     =   $this->session->userdata("update-driver");
$dr     =   $this->session->userdata("delete-driver");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>

<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Driver</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Update Driver</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                <div class="row">
						<div class="col-md-8 mx-auto box-shaow">
							<!--<h5>English</h5>-->
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<label for="Deiversname" >Driver Name *</label>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">

												<div class="row">
													<div class="col-md-12 mb-3">
														<div class="form-group b-grey">											
															<div class="row">												
																<div class="col-md-6">
																	<label for="Deiversname" >Driver First Name in Arabic</label>
																	<input type="text" class="form-control arabic_feild width-100"  name="driver_name_a" value="<?php echo $view['driver_name_a'];?>" placeholder="أدخل الاسم الأول">													
																</div>													
																<div class="col-md-6">
																<label for="Deiversname" >Driver Last Name in Arabic </label>
																	<input type="text" class="form-control arabic_feild width-100"  name="driver_name_a_last" value="<?php echo $view['driver_name_a_last'];?>" placeholder="إدخال اسم آخر">		
																</div>
															</div>											
														</div>								
													</div>	
													<div class="col-md-12">
														<div class="form-group b-grey">
															<div class="row">
																<div class="col-md-6">
																	<label for="Deiversname" >Driver First Name </label>
																	<input type="text" class="form-control width-100"  id="Driver_name" name="driver_name" value="<?php echo $view['driver_name'];?>" placeholder="Enter Driver First Name" required>
																	<div class="invalid-feedback">
																		Please provide a valid Driver First Name.
																	</div>
																	<span class="text-danger"><?php echo form_error('driver_name'); ?></span>
																</div>
																<div class="col-md-6">
																	<label for="Deiversname" >Driver Last Name  </label>
																	<input type="text" class="form-control width-100"  id="driver_name_last" name="driver_name_last" value="<?php echo $view['driver_name_last'];?>" placeholder="Enter Deiver Last Name" required>
																	<div class="invalid-feedback">
																		Please provide a valid  Driver Last Name.
																	</div>
																	<span class="text-danger"><?php echo form_error('driver_name_last'); ?></span>
																</div>
															</div>											
														</div>								
													</div>											
												</div>																							
											</div>								
										</div>											
									</div>								
								
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">
											<div class="col-md-6">
												<label >Phone Number *</label>
												<input type="text" class="form-control"  name="driver_phone" placeholder="Enter Phone Number" value="<?php echo $view['driver_phone'];?>" required />
												<div class="invalid-feedback">
													Please provide a valid Mobile Number.
												</div>
												<span class="text-danger"><?php echo form_error('driver_phone'); ?></span>
											</div>
											<div class="col-md-6">
												<label >email *</label>
												<input type="text" class="form-control"  name="driver_email" placeholder="Enter E-mail address" value="<?php echo $view['driver_email'];?>"  />
											
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-6">
												<label >Company*</label>
												<input type="text" class="form-control"  name="company" placeholder="Enter Company" value="<?php echo $view['driver_company'];?>" required />
												<div class="invalid-feedback">
													Please provide Company.
												</div>
												<span class="text-danger"><?php echo form_error('company'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Category *</label>
												<select name="category" class="form-control" required>
													<option value="">Select Category</option>
													<?php foreach($this->config->item('category') as $z){?>
														<option value="<?php echo $z;?>" <?php if($view['driver_category']==$z){echo 'selected';}?>><?php echo $z;?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide Category.
												</div>
												<span class="text-danger"><?php echo form_error('category'); ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-6">
												<label >Zone *</label>
												<select name="zone" class="form-control zone_dat" required onchange="getRes()">
													<option value="">Select Zone</option>
													<?php foreach($zone as $z){
														$z=(array) $z;?>
													<option value="<?php echo $z['zone_id'];?>" <?php if($view['driver_zone']==$z['zone_id']){echo 'selected';}?>><?php echo $z['zone_name'];?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide Zone.
												</div>
												<span class="text-danger"><?php echo form_error('zone'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Sub Zone *</label>
												<select name="sub_zone" class="form-control subzone_dat"  onchange="getRes()">
													<option value="">Select Zone</option>
													<?php foreach($zone as $z){
														$z=(array) $z;?>
													<option value="<?php echo $z['zone_id'];?>" <?php if($view['driver_sub_zone']==$z['zone_id']){echo 'selected';}?>><?php echo $z['zone_name'];?></option>	
													<?php }?>
												</select>
											
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">
											<div class="col-md-6">
												<label >Vehicle Type *</label>
												<select name="vehicle_type" class="form-control" required>
													<option value="">Select Vehicle Type</option>
													<?php foreach($this->config->item('vehicle_type') as $z){?>
													<option value="<?php echo $z;?>" <?php if($view['driver_vehicle_type']==$z){echo 'selected';}?>><?php echo $z;?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide vehicle type.
												</div>
												<span class="text-danger"><?php echo form_error('vehicle_type'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Joining date *</label>
												<input id="basicFlatpickr1" class="form-control flatpickr flatpickr-input active" type="text" name="driver_joining_date" value="<?php echo $view['driver_joining_date'];?>" required />
												<div class="invalid-feedback">
													Please provide Joining date.
												</div>
												<span class="text-danger"><?php echo form_error('driver_joining_date'); ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-6">
												<label >Nationality*</label>
												<input type="text" class="form-control"  name="nationality" placeholder="Enter Nationality" value="<?php echo $view['driver_nationality']?>" required />
												<div class="invalid-feedback">
													Please provide Nationality.
												</div>
												<span class="text-danger"><?php echo form_error('nationality'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Gender *</label>
												<select name="gender" class="form-control" required>
													<option value="">Select Gender</option>
													<?php foreach($this->config->item('gender') as $z){?>
														<option value="<?php echo $z;?>" <?php if($view['driver_gender']==$z){echo 'selected';}?>><?php echo $z;?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide Gender.
												</div>
												<span class="text-danger"><?php echo form_error('gender'); ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-6">
												<label >Date of Birth *</label>
												<input id="basicFlatpickr"  class="form-control flatpickr flatpickr-input active" type="text" name="driver_dob" value="<?php echo $view['driver_dob'];?>" required />
											
												<div class="invalid-feedback">
													Please provide DOB.
												</div>
												<span class="text-danger"><?php echo form_error('driver_dob'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Vehicle Number *</label>
												<input type="text" class="form-control"  name="driver_vehicle_number" placeholder="Enter vehicle number" value="<?php echo $view['driver_vehicle_number'];?>" required />
												<div class="invalid-feedback">
													Please provide vehicle number.
												</div>
												<span class="text-danger"><?php echo form_error('driver_vehicle_number'); ?></span>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12 m-3">
									<label for="Deiversname" >Address *</label>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">
												<div class="row">
													<div class="col-md-6">
														<textarea  class="form-control"  name="driver_address" placeholder="Enter Your Address" value="" required><?php echo $view['driver_address'];?></textarea>
													
														<div class="invalid-feedback">
															Please provide Address.
														</div>
														<span class="text-danger"><?php echo form_error('driver_address'); ?></span>
													</div>
													<div class="col-md-6">													
														<textarea  class="form-control"  name="driver_address_a" placeholder="أدخل عنوانك" value="" ><?php echo $view['driver_address_a'];?></textarea>
														
													</div>
													
												</div>											
											</div>								
										</div>											
									</div>								
								
								</div>

								<div class="col-md-12 m-3">								
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">
												<div class="row">
													<div class="col-md-6">
													<label for="Deiversname" >Civil I'd number *</label>
														<input type="text" class="form-control"  name="civil_id" placeholder="Enter Civil ID number" value=" <?php echo $view['driver_civil_id'];?>" required />
														<div class="invalid-feedback">
															Please provide Civil Id Number.
														</div>
														<span class="text-danger"><?php echo form_error('civil_id'); ?></span>
													</div>
													<div class="col-md-6">		
														<label for="Deiversname" >Date of expiry *</label>											
														<input id="basicFlatpickr1"  class="form-control flatpickr flatpickr-input active"  name="civil_expiry" placeholder="Date of expiry" value="<?php echo $view['driver_civil_expiry'];?>" />
														<div class="invalid-feedback">
															Please provide Civil Id Number Expiry Date.
														</div>
														<span class="text-danger"><?php echo form_error('civil_expiry'); ?></span>
													</div>
													
												</div>											
											</div>								
										</div>											
									</div>						
								</div>

								<div class="col-md-12 m-3">								
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">
												<div class="row">
													<div class="col-md-4">
													<label for="Deiversname" >Licence number *</label>
														<input type="text" class="form-control"  name="licence_no" placeholder="Enter Licence number" value="<?php echo $view['driver_licence_no'];?>" required />
														<div class="invalid-feedback">
															Please provide Licence Number.
														</div>
														<span class="text-danger"><?php echo form_error('civil_id'); ?></span>
													</div>
													<div class="col-md-4">		
														<label for="Deiversname" >Date of expiry *</label>											
														<input id="basicFlatpickr2"  class="form-control flatpickr flatpickr-input active"   name="licence_expiry" placeholder="Date of expiry" value="<?php echo $view['driver_licence_expiry'];?>" />
														<div class="invalid-feedback">
															Please provide Licence Number Expiry Date.
														</div>
														<span class="text-danger"><?php echo form_error('licence_expiry'); ?></span>
													</div>
													<div class="col-md-4">
														<div class="form-group b-grey">
															<div class="row">													
																<div class="col-md-12">		
																	<label for="Deiversname" >Defther expiry *</label>											
																	<input id="basicFlatpickr3"  class="form-control flatpickr flatpickr-input active"   name="defther_expiry" placeholder="Date of expiry" value="<?php echo $view['driver_defther_expiry'];?>" required/>
																
																	<div class="invalid-feedback">
																		Please provide DeftherExpiry Date.
																	</div>
																	<span class="text-danger"><?php echo form_error('defther_expiry'); ?></span>
																</div>																
															</div>											
														</div>								
													</div>														
												</div>											
											</div>								
										</div>											
									</div>						
								</div>
							
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">
										<div class="col-md-6">
												<label >Country Code *</label>
												<select class="form-control basic" name="driver_countrycode" id="exampleFormControlSelect1" required >
													<?php 													
														$country   =   $this->country_model->viewCountry();	
														$i=0;foreach($country as $c){
															$imgpth =   base_url().'assets/images/country/';
															$imsg   =  $c->country_flag;
															$target_dir =  $imgpth.$c->country_flag;
															if(@getimagesize($target_dir)){
																$imsg   =   $target_dir;
															}
													?>
													<option value="<?php echo $c->country_id;?>" <?php if($view['driver_countrycode'] == $c->country_id){echo 'selected';} ?> ><img src="<?php echo $imsg;?>" width="20px"/> <?php echo $c->country_name;?>(<?php echo $c->country_isd;?>)</option>
													<?php } ?>
												</select>
												
												<div class="invalid-feedback">
													Please provide Country Code.
												</div>
												<span class="text-danger"><?php echo form_error('driver_countrycode'); ?></span>
											</div>
											<div class="col-md-6">
													<label >Experience (Optional)</label>
													<input type="text" class="form-control"  name="driver_experience" placeholder="Enter Your Experience"  value="<?php echo $view['driver_experience'];?>" />												
													<span class="text-danger"><?php echo form_error('driver_experience'); ?></span>
											</div>											
												
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-12">
												<label >Allocate Resturant*</label>
												<select name="alloc_res[]" class="form-control alloc_res" multiple >
													<option value="">Select Zone</option>
													<?php $alloc= explode(',',$view['driver_resturant_alloc']);
													foreach($rest as $r){
													
														$r=(array) $r;?>
													<option value="<?php echo $r['resturant_id'];?>" <?php if(in_array($r['resturant_id'], $alloc)){echo 'selected';}?>><?php echo $r['resturant_name'];?></option>	
													<?php }?>
												</select>
												
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="myFirstImage">
										<label>Profile Image (Single File) (300*300PX) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input"  name="driver_profile_image" accept="image/*" value="<?php echo set_value('driver_profile_image')?>">
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
										
										</label>
										<span class="text-danger"><?php echo form_error('driver_profile_image'); ?></span>
										<div class="custom-file-container__image-preview"><img src="<?php echo base_url().'upload/drivers/'.$view['driver_profile_image']?>" width="200px"></div>
									</div>
								</div>				
							</div>
                            <div class="row bb-grey">
								<div class="col-md-2 m-3">
                                    <div class="form-group">
                                        <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success">Update</button>
                                    </div>
                                </div>
                                <div class="col-md-2 m-3">
                                    <div class="form-group">
                                        <a id="multiple-reset" href="<?php echo base_url().'Rayt-Admin/Drivers'; ?>" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
                            </div>    

						</div>
					</div>                  
                
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>