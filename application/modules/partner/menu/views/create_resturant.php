<div class="row layout-top-spacing">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="container-fluid py-3 pt-4 bb-grey sticky">
					<div class="row">
						<div class="col-md-2">
							<a href="<?php echo adminurl('Resturant');?>">
							<i class="fa fa-arrow-left" aria-hidden="true"></i></a>
						</div>
						<div class="col-md-6">
							<h4><?php echo $title;?></h4>
						</div>
						<div class="col-md-3 d-flex justify-content-between ml-3">
							<a href="<?php echo adminurl('Resturant');?>" class="btn btn-danger"> Cancel</a>
							<button type="submit" class="btn btn-primary" name="publish" value="Publish"/>publish</button>
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
									<label for="Resturantname" >Resturant Name *</label>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">
												<input type="text" class="form-control arabic_feild width-100"  name="name_a" value="<?php set_value('name_a')?>" placeholder="أدخل اسم المطعم" required>
												<div class="invalid-feedback">
													Please provide a valid Resturant Arabic Name.
												</div>
												<input type="text" class="form-control width-100"  id="Resturantname" name="name" value="<?php set_value('name')?>" placeholder="Enter Resturant Name" required>
												<div class="invalid-feedback">
													Please provide a valid Resturant Name.
												</div>
											</div>								
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('name_a'); ?></span>
									<span class="text-danger"><?php echo form_error('name'); ?></span>
								</div>
								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="myFirstImage">
										<label>Resturant Main Image (Single File) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input"  name="main_image" accept="image/*" required>
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
											<div class="invalid-feedback">
												Please provide a valid Resturant Main Image.
											</div>
										</label>
										<div class="custom-file-container__image-preview"></div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Resturant ID</label>
										<input type="text" class="form-control" name="id" value="<?php echo set_value($id !="")?$id:$id?>" disabled />
										<div class="invalid-feedback">
											Please provide a valid Resturant ID.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Password *</label>
										<input type="text" class="form-control"  name="password" placeholder="Enter Password" required />
										<div class="invalid-feedback">
											Please provide a valid Password.
										</div>
									</div>
								</div>							
							</div>
							<div class="row bb-grey">
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
										<div class="custom-file-container__image-preview"></div>
									</div>						  
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<label>Contact Person *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control  arabic_feild" name="contact_person_a" value="<?php echo set_value('contact_person_a');?>" placeholder="أدخأدخل اسم جهة الاتصال" required/>
										<div class="invalid-feedback">
											Please provide a valid Contact Person Arabic.
										</div>
										<input type="text" class="form-control" name="contact_person" placeholder="Enter Contact Person Name" value="<?php echo set_value('contact_person');?>" required/>
										<div class="invalid-feedback">
											Please provide a valid Contact Person.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>Position *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="position_a" value="<?php echo set_value('position_a');?>" placeholder="أدخل الوظيفة"  required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Position Arabic.
										</div>
										<input type="text" class="form-control"  name="position" value="<?php echo set_value('position');?>" placeholder="Enter Position" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Position.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Contact No *</label>
										<input type="text" class="form-control"  name="contact_no" value="<?php echo set_value('contact_no');?>" placeholder="Enter Contact number" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Contact No.
										</div>
									</div>
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<label>Area *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="area_a" value="<?php echo set_value('area_a');?>" placeholder="أدخل المنطقة"  required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Area Arabic.
										</div>
										<input type="text" class="form-control"  name="area" value="<?php echo set_value('area');?>" placeholder="Enter Area" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Area.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>Block No *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="block_a" value="<?php echo set_value('block_a');?>" placeholder="أدخل الكتلة"  required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Block No Arabic.
										</div>
										<input type="text" class="form-control"  name="block" value="<?php echo set_value('block');?>" placeholder="Enter block" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Block No.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>Street *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="street_a" value="<?php echo set_value('street_a');?>"  placeholder="أدخل الشارع" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Street Arabic.
										</div>
										<input type="text" class="form-control"  name="street"  value="<?php echo set_value('street');?>" placeholder="Enter street" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Street.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>Jaada *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="jaada_a" value="<?php echo set_value('jaada_a');?>" placeholder="أدخل الجادة" required />
										<div class="invalid-feedback">
											Please provide a valid Jaada Arabic.
										</div>
										<input type="text" class="form-control"  name="jaada" value="<?php echo set_value('jaada');?>" placeholder="Enter jaada" required />
										<div class="invalid-feedback">
											Please provide a valid Jaada.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>House No *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="house_a" value="<?php echo set_value('house_a');?>" placeholder="ادخل المنزل" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant House No Arabic.
										</div>
										<input type="text" class="form-control"  name="house" value="<?php echo set_value('house');?>" placeholder="Enter house" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant House No.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>Building No *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="building_a" value="<?php echo set_value('building_a');?>"  placeholder="أدخل المبنى" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Building No Arabic.
										</div>
										<input type="text" class="form-control"  name="building" value="<?php echo set_value('building');?>"  placeholder="Enter building" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Building No.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Lattitude *</label>
										<input type="text" class="form-control"  name="latitude" value="<?php echo set_value('latitude');?>"  placeholder="Enter latitude" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Lattitude.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Longitude *</label>
										<input type="text" class="form-control"  name="longitude" value="<?php echo set_value('longitude');?>" placeholder="Enter longitude" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Longitude.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<label>Landmark *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="landmark_a"  value="<?php echo set_value('landmark_a');?>" placeholder="أدخل المَعلم" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Landmark Arabic.
										</div>
										<input type="text" class="form-control"  name="landmark" value="<?php echo set_value('landmark');?>" placeholder="Enter landmark" required />
										<div class="invalid-feedback">
											Please provide a valid Resturant Landmark.
										</div>
									</div>
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<h5>Menu hours *</h5><br>
									<?php 
										$menu   =   $this->config->item("menu_hours");
										$i=0;$j=0;foreach($menu as $m){
									?>
									<div class="form-group b-grey">
										<div class="row">
											<div class="col-md-2">
												<label><?php echo $m;?> - </label>
											</div>
											<div class="col-md-4">
												<input id="timepicker<?php echo $i;?>" name="strt_time[]" value="<?php echo set_value('strt_time".$i."');?>" />
											</div>
											<div class="col-md-4">
												<input id="timepicker1<?php echo $i;?>" name="end_time[]" value=""  class="form-control"/>
											</div>
											<div class="col-md-2">										
												<label class="new-control new-checkbox new-checkbox-text checkbox-dark">
													<input type="checkbox" name="menu_hours[]" value="<?php echo $m;?>" id="<?php echo $m;?>" <?php if(set_value('menu_hours')){echo 'check';} ?> class="new-control-input">
													<span class="new-control-indicator"></span><span class="new-chk-content">closed</span>
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
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Preparation Time *</label> 
										<input type="text" class="form-control"  name="preparation_time" value="<?php set_value('preparation_time')?>"  placeholder="Enter Preparation Time" required >
										<div class="invalid-feedback">
											Please provide a valid Preparation Time.
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('preparation_time'); ?></span>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Delivery Fee *</label>
										<input type="text" class="form-control"  name="delivery_fee" value="<?php set_value('delivery_fee')?>" placeholder="Enter Delivery Fee" required />
										<div class="invalid-feedback">
											Please provide a valid Delivery Fee.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Discount</label>
										<input type="text" class="form-control"  name="discount" value="<?php set_value('discount')?>" placeholder="Enter Discount" required />
										<div class="invalid-feedback">
											Please provide a valid Discount.
										</div>
									</div>
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<h5>Cuisine *</h5><br>
									<div class="invalid-feedback">
										Please provide a valid Resturant Main Image.
									</div>
									<div class="form-group b-grey">
										<input type="checkbox" id="8" name="cusine[]" value="1"/>
										<label for="8">Kuwait</label>
									</div>
									<div class="form-group b-grey">
										<input type="checkbox" id="9" name="cusine[]" value="2"/>
										<label for="9">Indian</label>
									</div>
									<div class="form-group b-grey">
										<input type="checkbox" id="10" name="cusine[]" value="3"/>
										<label for="10">Arabian</label>
									</div>
									
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Zone *</label>
										<select class="form-control" name="zone" id="exampleFormControlSelect1"required >
											<option value="">Select Zone</option>
											<?php 
												$zone   =   $this->config->item("zone");
												$i=0;foreach($zone as $z){
											?>
											<option value="<?php echo $z;?>"><?php echo $z;?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											Please provide a valid Zone.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Set delivery time for Zone *</label>
										<select class="form-control" name="zone_time" id="exampleFormControlSelect1" required>
											<option value="">Select sub Zone</option>
											<?php 
												$zone   =   $this->config->item("subzone");
												$i=0;foreach($zone as $sz){
											?>
											<option value="<?php echo $sz;?>"><?php echo $sz;?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											Please provide a valid Set delivery time for Zone.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Sub Zone *</label>
										<select class="form-control" name="sub_zone" id="exampleFormControlSelect1" required >
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<div class="invalid-feedback">
											Please provide a valid Sub Zone.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Set delivery time for subzone *</label>
										<select class="form-control" name="sub_zone_time" id="exampleFormControlSelect1" required>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<div class="invalid-feedback">
											Please provide a valid Set delivery time for subzone.
										</div>
									</div>
								</div>
							</div>
							<div class="row bb-grey py-2">
								<h5>Legal Information </h5><br>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Contract Date *</label>
										<input id="basicFlatpickr" value="<?php echo date('Y-m-d')?>" class="form-control flatpickr flatpickr-input active" type="text" name="contact_date" required />
										<div class="invalid-feedback">
											Please provide a valid Contract Date.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group">
										<div class="custom-file-container" data-upload-id="mythreeImage">
											<label> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">Clear All</a></label>
											<label class="custom-file-container__custom-file" >
												<input type="file" class="custom-file-container__custom-file__custom-file-input" name="legal_doc[]" multiple required>
												<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
												<span class="custom-file-container__custom-file__custom-file-control"></span>
												<div class="invalid-feedback">
													Please provide a valid Legal Information Document.
												</div>
											</label>
											<div class="custom-file-container__image-preview"></div>
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Commercial License Number *</label>
										<input type="number" class="form-control"  name="license_no" value="<?php set_value('license_no')?>" placeholder="Enter License Number" required />
										<div class="invalid-feedback">
											Please provide a valid Commercial License Number .
										</div>
									</div>
								</div>
							</div>
							<div class="row bb-grey py-2">
								<h5>Signature Authority (Front/Back) *</h5>
								<div class="col-md-12 m-3">
									<div class="form-group">
										<input type="file" class="form-control width-100"  name="sign" onchange="document.getElementById('sign').src = window.URL.createObjectURL(this.files[0]);" required />
										<img id="sign" width="50px"/>
										<div class="invalid-feedback">
											Please provide a valid Signature Authority.
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Civil Id *</label>
										<input type="text" class="form-control" placeholder="owner civil id"  name="civil_id" value="<?php set_value('civil_id')?>" required />
										<div class="invalid-feedback">
											Please provide a valid Civil Id .
										</div>
									</div>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Percentage *</label>
										<input type="text" class="form-control"  name="Percentage" value="<?php set_value('Percentage')?>"  placeholder="Enter Percentage" required>
										<div class="invalid-feedback">
											Please provide a valid Percentage.
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('Percentage'); ?></span>
								</div>
								<div class="col-md-12 m-3">
									<label >Sales Person Name *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control arabic_feild"  name="person_name_a" placeholder="أدخل مندوب المبيعات" value="<?php set_value('person_name_a')?>" required />
										<div class="invalid-feedback">
											Please provide a valid Sales Person Name Arabic.
										</div>
										<input type="text" class="form-control"  name="person_name" placeholder="Enter Sales Person Name" value="<?php set_value('person_name')?>" required />
										<div class="invalid-feedback">
											Please provide a valid Sales Person Name.
										</div>
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