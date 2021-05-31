<div class="row layout-top-spacing">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="needs-validation text-left" novalidate>
				<div class="container-fluid py-3 pt-4 bb-grey sticky">
					<div class="row">
						<div class="col-md-2">
							<a href="<?php echo adminurl('Drivers');?>">
							<i class="fa fa-arrow-left" aria-hidden="true"></i></a>
						</div>
						<div class="col-md-6">
							<h4><?php echo $title;?></h4>
						</div>
						<div class="col-md-3 d-flex justify-content-between ml-3">
							<a href="<?php echo adminurl('Drivers');?>" class="btn btn-danger"> Cancel</a>
							<button type="submit" class="btn btn-primary" name="publish" value="Publish">publish</button>
						</div>
					</div>
				</div>
				<div class="container-fluid py-3 pt-4">
				<?php $this->load->view('admin/success_error');?>
					<div class="row">
						<div class="col-md-8 mx-auto box-shaow">
							<!--<h5>English</h5>-->
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
								<div class="row">
										<div class="col-md-12 mb-3">
											<div class="form-group b-grey">											
												<div class="row">												
													<div class="col-md-6">
														<label for="Deiversname" >Driver First Name in Arabic</label>
														<input type="text" class="form-control arabic_feild width-100"  name="driver_name_a" value="<?php echo set_value('driver_name_a')?>" placeholder="أدخل الاسم الأول">													
													</div>													
													<div class="col-md-6">
													<label for="Deiversname" >Driver Last Name in Arabic</label>
														<input type="text" class="form-control arabic_feild width-100"  name="driver_name_a_last" value="<?php echo set_value('driver_name_a_last')?>" placeholder="إدخال اسم آخر">		
													</div>
												</div>											
											</div>								
										</div>	
										<div class="col-md-12">
											<div class="form-group b-grey">
												<div class="row">
													<div class="col-md-6">
														<label for="Deiversname" >Driver First Name *</label>
														<input type="text" class="form-control width-100"  id="Driver_name" name="driver_name" value="<?php echo set_value('driver_name')?>" placeholder="Enter Driver First Name" required>
														<div class="invalid-feedback">
															Please provide a valid Driver First Name.
														</div>
														<span class="text-danger"><?php echo form_error('driver_name'); ?></span>
													</div>
													<div class="col-md-6">
														<label for="Deiversname" >Driver Last Name *</label>
														<input type="text" class="form-control width-100"  id="driver_name_last" name="driver_name_last" value="<?php echo set_value('driver_name_last')?>" placeholder="Enter Deiver Last Name" required>
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
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">
											<div class="col-md-12">
												<label >Driver Id *</label>
												<input type="text" class="form-control" name="given_id" value="<?php echo (set_value('given_id') !="")?set_value('given_id'):$id?>" readonly />
												<div class="invalid-feedback">
													Please provide a valid Mobile Number.
												</div>
												<span class="text-danger"><?php echo form_error('given_id'); ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">
											<div class="col-md-6">
												<label >Phone Number *</label>
												<input type="text" class="form-control"  name="driver_phone" placeholder="Enter Phone Number" value="<?php echo set_value('driver_phone')?>" required />
												<div class="invalid-feedback">
													Please provide a valid Mobile Number.
												</div>
												<span class="text-danger"><?php echo form_error('driver_phone'); ?></span>
											</div>
											<div class="col-md-6">
												<label >email </label>
												<input type="text" class="form-control"  name="driver_email" placeholder="Enter E-mail address" value="<?php echo set_value('driver_email')?>"  />
											
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-6">
												<label >Company*</label>
												<input type="text" class="form-control"  name="company" placeholder="Enter Company" value="<?php echo set_value('company')?>" required />
												<div class="invalid-feedback">
													Please provide Company.
												</div>
												<span class="text-danger"><?php echo form_error('company'); ?></span>
											</div>
											<div class="col-md-6">
											    
												<label >Password *</label>
												<!--<input type="password" class="form-control"  name="pass" placeholder="Enter E-mail address" value="<?php echo set_value('pass')?>" required />
												<div class="invalid-feedback">
													Please provide Password.
												</div>-->
												<div class="input-group mb-4" id="show_hide_password">                               
                                                    <input type="password" class="form-control" name="pass" value="<?php echo set_value('pass');?>" required >
                                                    <div class="input-group-prepend">
                                                     <span class="input-group-text"><i class="far fa-eye-slash" aria-hidden="true"></i></span>
                                                    </div>
                                                    
                                                </div>
                                                <div class="invalid-feedback">
													Please provide Password.
												</div>
												<span class="text-danger"><?php echo form_error('pass'); ?></span>
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
													<option value="<?php echo $z['zone_id'];?>" <?php if(set_value('zone')==$z['zone_id']){echo 'selected';}?>><?php echo $z['zone_name'];?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide Zone.
												</div>
												<span class="text-danger"><?php echo form_error('zone'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Sub Zone </label>
												<select name="sub_zone" class="form-control subzone_dat"  onchange="getRes()">
													<option value="">Select Zone</option>
													<?php foreach($zone as $z){
														$z=(array) $z;?>
													<option value="<?php echo $z['zone_id'];?>" <?php if(set_value('sub_zone')==$z['zone_id']){echo 'selected';}?>><?php echo $z['zone_name'];?></option>	
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
												<label >Category *</label>
												<select name="category" class="form-control" required>
													<option value="">Select Category</option>
													<?php foreach($this->config->item('category') as $z){?>
														<option value="<?php echo $z;?>" <?php if(set_value('category')==$z){echo 'selected';}?>><?php echo $z;?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide Category.
												</div>
												<span class="text-danger"><?php echo form_error('category'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Vehicle Type *</label>
												<select name="vehicle_type" class="form-control" required>
													<option value="">Select Vehicle Type</option>
													<?php foreach($this->config->item('vehicle_type') as $z){?>
													<option value="<?php echo $z;?>" <?php if(set_value('vehicle_type')==$z){echo 'selected';}?>><?php echo $z;?></option>	
													<?php }?>
												</select>
												<div class="invalid-feedback">
													Please provide vehicle type.
												</div>
												<span class="text-danger"><?php echo form_error('vehicle_type'); ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-6">
												<label >Nationality*</label>
												<input type="text" class="form-control"  name="nationality" placeholder="Enter Nationality" value="<?php echo set_value('nationality')?>" required />
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
														<option value="<?php echo $z;?>" <?php if(set_value('gender')==$z){echo 'selected';}?>><?php echo $z;?></option>	
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
												<input  id="basicFlatpickr"  class="form-control flatpickr flatpickr-input active basicFlatpickr" type="text" name="driver_dob" value="<?php echo set_value('driver_dob')?>" required />
											
												<div class="invalid-feedback">
													Please provide DOB.
												</div>
												<span class="text-danger"><?php echo form_error('driver_dob'); ?></span>
											</div>
											<div class="col-md-6">
												<label >Vehicle Number *</label>
												<input type="text" class="form-control"  name="driver_vehicle_number" placeholder="Enter vehicle number" value="<?php echo set_value('driver_vehicle_number')?>" required />
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
														<textarea  class="form-control"  name="driver_address" placeholder="Enter Your Address" value="" required><?php echo set_value('driver_address')?></textarea>
													    <div class="invalid-feedback">
															Please provide Address.
														</div>
														<span class="text-danger"><?php echo form_error('driver_address'); ?></span>
													</div>
													<div class="col-md-6">
														<textarea  class="form-control"  name="driver_address_a" placeholder="أدخل عنوانك" value="" ><?php echo set_value('driver_address_a')?></textarea>
														
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
														<input type="text" class="form-control"  name="civil_id" placeholder="Enter Civil ID number" value="<?php echo set_value('civil_id')?>" required />
														<div class="invalid-feedback">
															Please provide Civil Id Number.
														</div>
														<span class="text-danger"><?php echo form_error('civil_id'); ?></span>
													</div>
													<div class="col-md-6">		
														<label for="Deiversname" >Date of expiry *</label>											
														<input type="text" id="basicFlatpickr1"  class="form-control flatpickr flatpickr-input active"  name="civil_expiry" placeholder="Date of expiry" value="<?php echo set_value('civil_expiry')?>" required />
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
														<input type="text" class="form-control"  name="licence_no" placeholder="Enter Licence number" value="<?php echo set_value('licence_no')?>" required />
														<div class="invalid-feedback">
															Please provide Licence Number.
														</div>
														<span class="text-danger"><?php echo form_error('licence_no'); ?></span>
													</div>
													<div class="col-md-4">		
														<label for="Deiversname" >Date of expiry *</label>											
														<input type="text" id="basicFlatpickr2"  class="form-control flatpickr flatpickr-input active"   name="licence_expiry" placeholder="Date of expiry" value="<?php echo set_value('licence_expiry')?>" required/>
														<div class="invalid-feedback">
															Please provide Licence Number Expiry Date.
														</div>
														<span class="text-danger"><?php echo form_error('licence_expiry'); ?></span>
													</div>
													<div class="col-md-4">		
														<label for="Deiversname" >Defther expiry *</label>											
														<input type="text" id="basicFlatpickr3"  class="form-control flatpickr flatpickr-input active basicFlatpickr"   name="defther_expiry" placeholder="Date of expiry" value="<?php echo set_value('defther_expiry')?>" required/>
													
														<div class="invalid-feedback">
															Please provide DeftherExpiry Date.
														</div>
														<span class="text-danger"><?php echo form_error('driver_defther_expiry'); ?></span>														
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
													<option value="">Select Country</option>
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
													<option value="<?php echo $c->country_name;?>"><img src="<?php echo $imsg;?>" width="20px"/> <?php echo $c->country_name;?>(<?php echo $c->country_isd;?>)</option>
													<?php } ?>
												</select>
												
												<div class="invalid-feedback">
													Please provide Country Code.
												</div>
												<span class="text-danger"><?php echo form_error('driver_countrycode'); ?></span>
											</div>											
											<div class="col-md-4">
												<label >Joining date *</label>
												<input id="basicFlatpickr4" value="" class="form-control flatpickr flatpickr-input active basicFlatpickr" type="text" name="driver_joining_date" value="<?php echo set_value('driver_joining_date')?>" required />
												<div class="invalid-feedback">
													Please provide Joining date.
												</div>
												<span class="text-danger"><?php echo form_error('driver_joining_date'); ?></span>
											</div>
											<div class="col-md-4">
													<label >Experience (Optional)</label>
													<input type="text" class="form-control"  name="driver_experience" placeholder="Enter Your Experience"  value="<?php echo set_value('driver_experience')?>" />												
													<span class="text-danger"><?php echo form_error('driver_experience'); ?></span>
											</div>											
												
										</div>
									</div>
								</div>
								
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<div class="row">											
											<div class="col-md-12">
												<label >Allocate Resturant</label>
												<select name="alloc_res[]" class="form-control alloc_res" multiple>
													<option value="">Select Zone</option>
													<?php foreach($rest as $r){
														$r=(array) $r;
													?>
													<option value="<?php echo $r['resturant_id'];?>" <?php if(set_value('zone')==$r['resturant_id']){echo 'selected';}?>><?php echo $r['resturant_name'];?></option>	
													<?php }?>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 m-3">
									<h5>Working Hours *</h5><br>
									<?php 
										$menu   =   $this->config->item("menu_hours");
										$i=0;$j=0;foreach($menu as $key=>$m){
									?>
									<div class="form-group b-grey">
										<div class="row">
											<div class="col-md-2">
												<label><?php echo $m;?> - </label>
												<input type="hidden"  name="driver_weekly[]" value="<?php echo $m;?>"  />
											</div>
											<div class="col-md-4">
												<input id="timepicker<?php echo $i;?>" name="strt_time[]" value="<?php echo set_value('strt_time".$i."');?>" required />
											</div>
											<div class="col-md-4">
												<input id="timepicker1<?php echo $i;?>" name="end_time[]" value="<?php echo set_value('end_time')?>"  class="form-control" required />
											</div>	
											<div class="col-md-2">										
												<label class="new-control new-checkbox new-checkbox-text checkbox-dark">
													<input type="checkbox" name="working_hours[<?php echo $key; ?>]" value="<?php echo $m;?>" id="<?php echo $m;?>" <?php if(set_value('working_hours')){echo 'check';} ?> class="new-control-input">
													<span class="new-control-indicator"></span><span class="new-chk-content">Holiday</span>
												</label>
											</div>									
										</div>
									</div>
									<?php 
										$i++;
										$j++;
										}
									?>
								</div>

								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="myFirstImage">
										<label>Profile Image (Single File) (300*300PX)  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input"  name="driver_profile_image" accept="image/*" value="<?php echo set_value('driver_profile_image')?>" >
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
										</label>
										<div class="custom-file-container__image-preview"></div>
									</div>
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="mySecondImage">
										<label>Address proof / Legal Documents (Allow Multiple) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input" name="driver_files[]" multiple value="<?php echo set_value('driver_files')?>" >
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
										
										</label>
										<div class="custom-file-container__image-preview"></div>
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