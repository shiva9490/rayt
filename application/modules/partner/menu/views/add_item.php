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
						<div class="col-md-10 mx-auto box-shaow">
							<!--<h5>English</h5>-->
							<div class="row bb-grey">
							    <div class="col-md-12 mt-3">
								    <label for="Resturantname" >Item Type *</label>
									<div class="form-group b-grey">
									    <div class="row">
										    <?php 
										        $veg   =   $this->config->item("veg");
											    foreach($veg as $key=>$veg){
											?>
											<div class="col-md-3">
												<div class="n-chk">
                                                    <label class="new-control new-radio square-radio new-radio-text">
                                                      <input type="radio" class="new-control-input" name="custom-radio-6" value="<?php echo $veg;?>" <?php if($key=="0"){echo 'checked';}?>>
                                                      <span class="new-control-indicator"></span><span class="new-radio-content"><?php echo $veg;?></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
										</div>						
									</div>
								    <span class="text-danger"><?php echo form_error('itemname_a'); ?></span>
							    </div>
								<div class="col-md-12 m-3">
									<label for="Resturantname" >Item Name *</label>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">
												<input type="text" class="form-control arabic_feild width-100"  name="itemname_a" value="<?php set_value('itemname_a')?>" placeholder="أدخل اسم المطعم" required>
												<div class="invalid-feedback">
													Please provide a valid Item Arabic Name.
												</div>
												<input type="text" class="form-control width-100"  id="Resturantname" name="itemname" value="<?php set_value('itemname')?>" placeholder="Enter Item Name" required>
												<div class="invalid-feedback">
													Please provide a valid Item Name.
												</div>
											</div>								
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('itemname_a'); ?></span>
									<span class="text-danger"><?php echo form_error('itemname'); ?></span>
								</div>
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Basic Details * </label>
										<textarea id="textarea" class="form-control textarea" maxlength="225" rows="3" name="details" placeholder="Basic Details...">
										    <?php echo set_value('details');?>
										</textarea>
                                        <div class="invalid-feedback">
												Please provide a valid Basic Details.
											</div>
                                        <?php echo form_error('details');?>
									</div>
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
							</div>
							<div class="row bb-grey">
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label >Item Price *</label> 
										<input type="number" class="form-control prince" name="item_price" value="<?php set_value('preparation_time')?>"  onkeyup="itemamount()" placeholder="Enter Item Price" required />
										<div class="invalid-feedback">
											Please provide a valid Item Price.
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('preparation_time'); ?></span>
								</div>
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label>Packaging *</label>
										<input type="number" class="form-control packing"  name="delivery_fee" value="<?php set_value('delivery_fee')?>" onkeyup="itemamount()" placeholder="Enter Packaging" required />
										<div class="invalid-feedback">
											Please provide a valid Packaging.
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label >Vat *</label>
										<select class="form-control vat" name="zone_time" id="exampleFormControlSelect1" onchange="itemamount()" required="" />
											<option value="">Select Vat</option>
											<?php 
												$vat = $this->vat_model->viewvat();
												if(is_array($vat) && count($vat) >0){
													foreach($vat as $vat){
											?>
											<option value="<?php echo $vat->vat_id?>"><?php echo $vat->vat?>%</option>
											<?php
													}
												}
											?>
										</select>
										<div class="invalid-feedback">
											Please provide a valid Vat.
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label>Final Price *</label>
										<input type="text" class="form-control total"  name="delivery_fee" placeholder="Final Price" required />
									</div>
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12">
									<div class="form-group b-grey">
										<label >Item timings *</label> 
										<div class="n-chk">
											<label class="new-control new-radio square-radio new-radio-text">
												<input type="radio" class="new-control-input" name="custom-radio-6" data-value="alltime" onclick="timmes('alltime')" value="" >
												<span class="new-control-indicator"></span><span class="new-radio-content">all times when kitchen / restaurant is open on Rayt</span>
											</label>
										</div>
										<div class="n-chk">
											<label class="new-control new-radio square-radio new-radio-text">
												<input type="radio" class="new-control-input" name="custom-radio-6" data-value="alldays" onclick="timmes('alldays')" value="">
												<span class="new-control-indicator"></span><span class="new-radio-content">Item is available at same time for all days of the week</span>
											</label>
											<div class="jumbotron" id="alldays" style="display:none;">
												<div class="row">
													<div class="col-md-3">Days</div>
													<div class="col-md-3">Start Time</div>
													<div class="col-md-3">End Time</div>
													<div class="col-md-3"></div>
												</div>
												<div class="row">
													<div class="col-md-3">All Day 1/3</div>
													<div class="col-md-3">
														<input id="timepicker1" class="form-control flatpickr flatpickr-input alltime" type="text" data-value="1" placeholder="Select Date.." >
													</div>
													<div class="col-md-3">
														<input id="timepicker10" class="form-control flatpickr flatpickr-input" type="text" placeholder="Select Date.." >
													</div>
													<div class="col-md-3">
														<a href="javascript:void(0);" id="add" onclick="myevent(this)">Add</a>
													</div>
												</div>
												<div class="alldays" id="AddDel"></div>
											</div>
										</div>
										<div class="n-chk">
											<label class="new-control new-radio square-radio new-radio-text">
												<input type="radio" class="new-control-input" name="custom-radio-6" data-value="differentdays" onclick="timmes('differentdays')" value="">
												<span class="new-control-indicator"></span><span class="new-radio-content">Item is available at different times during different days of the week</span>
											</label>
											<div class="differentdays" style="display:none;">
												<?php 
													$menu   =   $this->config->item("menu_hours");
													$i=0;foreach($menu as $m){
												?>
												<div class="form-group b-grey">
													<div class="row">
														<div class="col-md-2">
															<label><?php echo $m;?> - </label>
														</div>
														<div class="col-md-4">
															<input id="timepicker<?php echo $i;?>" name="strt_time[]" class="form-control" value="<?php echo set_value('strt_time".$i."');?>" />
														</div>
														<div class="col-md-4">
															<input id="timepicker1<?php echo $i;?>" name="end_time[]" value=""  class="form-control"/>
														</div>
													</div>
												</div>
												<?php 
													$i++;
													}
												?>
											</div>
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('preparation_time'); ?></span>
								</div>
							</div>								
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>