<div class="row layout-top-spacing">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
									<label for="Deiversname" >Driver Name *</label>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">
												<div class="row">
													<div class="col-md-6">
														<input type="text" class="form-control arabic_feild width-100"  name="driver_name_a" value="<?php echo set_value('driver_name_a')?>" placeholder="أدخل اسم المطعم" required>
														<div class="invalid-feedback">
															Please provide a valid Driver Arabic Name.
														</div>
														<span class="text-danger"><?php echo form_error('driver_name_a'); ?></span>
													</div>
													<div class="col-md-6">
															<input type="text" class="form-control width-100"  id="Driver_name" name="driver_name" value="<?php echo set_value('driver_name')?>" placeholder="Enter Deivers Name" required>
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
												<input type="text" class="form-control"  name="driver_phone" placeholder="Enter Phone Number" value="<?php echo set_value('driver_phone')?>" required />
												<div class="invalid-feedback">
													Please provide a valid Mobile Number.
												</div>
												<span class="text-danger"><?php echo form_error('driver_phone'); ?></span>
											</div>
											<div class="col-md-6">
												<label >email *</label>
												<input type="text" class="form-control"  name="driver_email" placeholder="Enter E-mail address" value="<?php echo set_value('driver_email')?>" required />
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
												<input id="basicFlatpickr"  class="form-control flatpickr flatpickr-input active" type="text" name="driver_dob" value="<?php echo set_value('driver_dob')?>" required />
											
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
														<textarea  class="form-control"  name="driver_address_a" placeholder="أدخل عنوانك" value="" required><?php echo set_value('driver_address_a')?></textarea>
														<div class="invalid-feedback">
															Please provide Address.
														</div>
														<span class="text-danger"><?php echo form_error('driver_address_a'); ?></span>
													</div>
													<div class="col-md-6">													
														<textarea  class="form-control"  name="driver_address" placeholder="Enter Your Address" value="" required><?php echo set_value('driver_address')?></textarea>
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
												<input id="basicFlatpickr1" value="" class="form-control flatpickr flatpickr-input active" type="text" name="driver_joining_date" value="<?php echo set_value('driver_joining_date')?>" required />
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
									<div class="custom-file-container" data-upload-id="myFirstImage">
										<label>Profile Image (Single File) (300*300PX) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input"  name="driver_profile_image" accept="image/*" value="<?php echo set_value('driver_profile_image')?>" required>
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
											<div class="invalid-feedback">
												Please provide a valid Resturant Main Image.
											</div>
										</label>
										<span class="text-danger"><?php echo form_error('driver_profile_image'); ?></span>
										<div class="custom-file-container__image-preview"></div>
									</div>
								</div>
							
													
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="mySecondImage">
										<label>Address proof / Legal Documents (Allow Multiple) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input" name="driver_files[]" multiple value="<?php echo set_value('driver_files')?>" required>
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
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>