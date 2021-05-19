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
													<div class="col-md-6">
														<input type="text" class="form-control arabic_feild width-100"  name="driver_name_a" value="<?php echo $view['driver_name_a'];?>" placeholder="أدخل اسم المطعم" required>
														<div class="invalid-feedback">
															Please provide a valid Driver Arabic Name.
														</div>
														<span class="text-danger"><?php echo form_error('driver_name_a'); ?></span>
													</div>
													<div class="col-md-6">
															<input type="text" class="form-control width-100"  id="Driver_name" name="driver_name" value="<?php echo $view['driver_name'];?>" placeholder="Enter Deivers Name" required>
															<div class="invalid-feedback">
																Please provide a valid Driver Name.
															</div>
															<span class="text-danger"><?php echo form_error('driver_name'); ?></span>
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
												<input type="text" class="form-control"  name="driver_email" placeholder="Enter E-mail address" value="<?php echo $view['driver_email'];?>" required />
												<div class="invalid-feedback">
													Please provide a valid E-mail address.
												</div>
												<span class="text-danger"><?php echo form_error('driver_email'); ?></span>
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
														<textarea  class="form-control"  name="driver_address_a" placeholder="أدخل عنوانك" value="" required><?php echo $view['driver_address_a'];?></textarea>
														<div class="invalid-feedback">
															Please provide Address.
														</div>
														<span class="text-danger"><?php echo form_error('driver_address_a'); ?></span>
													</div>
													<div class="col-md-6">													
														<textarea  class="form-control"  name="driver_address" placeholder="Enter Your Address" value="" required><?php echo $view['driver_address'];?></textarea>
														<div class="invalid-feedback">
														Please provide a valid Driver Arabic Address. .
														</div>
														<span class="text-danger"><?php echo form_error('driver_address'); ?></span>
													</div>
													
												</div>											
											</div>								
										</div>											
									</div>								
								
								</div>
							
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">
										<div class="col-md-4">
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
											<div class="col-md-4">
												<label >Joining date *</label>
												<input id="basicFlatpickr1" class="form-control flatpickr flatpickr-input active" type="text" name="driver_joining_date" value="<?php echo $view['driver_joining_date'];?>" required />
												<div class="invalid-feedback">
													Please provide Joining date.
												</div>
												<span class="text-danger"><?php echo form_error('driver_joining_date'); ?></span>
											</div>
											<div class="col-md-4">
													<label >Experience (Optional)</label>
													<input type="text" class="form-control"  name="driver_experience" placeholder="Enter Your Experience"  value="<?php echo $view['driver_experience'];?>" />												
													<span class="text-danger"><?php echo form_error('driver_experience'); ?></span>
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
											<div class="invalid-feedback">
												Please provide a valid Resturant Main Image.
											</div>
										</label>
										<span class="text-danger"><?php echo form_error('driver_profile_image'); ?></span>
										<div class="custom-file-container__image-preview"><img src="<?php echo base_url().'upload/drivers/'.$view['driver_profile_image']?>"></div>
									</div>
								</div>				
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="mySecondImage">
										<label>Address proof / Legal Documents (Allow Multiple) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input" name="driver_files[]" multiple value="<?php echo set_value('driver_files')?>">
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
											<div class="invalid-feedback">
												Please provide a valid Address proof Images.
											</div>
											<span class="text-danger"><?php echo form_error('driver_files'); ?></span>
										</label>
										<div class="custom-file-container__image-preview"></div>
									</div>						  
								</div>
							</div>	
                            <div class="row bb-grey">
								<div class="col-md-2 m-3">
                                    <div class="form-group">
                                        <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success">Save</button>
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