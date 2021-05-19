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
							<button type="submit" class="btn btn-primary" name="publish" value="publish"/>publish</button>
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
                                                        <input type="radio" class="new-control-input" name="veg_type" value="<?php echo $veg;?>" <?php set_radio('veg_type', $veg); ?> <?php if($key == "0"){echo 'checked';} ?>>
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
											    <input type="hidden" name="tempid" id="tempid" value="<?php echo (set_value('tempid')!="")?set_value('tempid'):$tempid ?>">
											    <input type="hidden" name="categoty" id="tempid" value="<?php echo $this->uri->segment("3");?>">
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
										<textarea id="textarea" class="form-control textarea" maxlength="225" rows="3" name="details" placeholder="Basic Details..."><?php echo set_value('details');?></textarea>
                                        <div class="invalid-feedback">
											Please provide a valid Basic Details.
										</div>
                                        <?php echo form_error('details');?>
									</div>
								</div>	
								<div class="col-md-12 m-3">
									<div class="custom-file-container" data-upload-id="myFirstImage">
										<label>Item Image (Single File) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
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
									<?php echo form_error('main_image');?>
								</div>					
							</div>
							<div class="row bb-grey">
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label >Item Price *</label> 
										<input type="number" class="form-control prince" name="item_price" value="<?php set_value('item_price')?>"  onkeyup="itemamount()" placeholder="Enter Item Price" required />
										<div class="invalid-feedback">
											Please provide a valid Item Price.
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('item_price'); ?></span>
								</div>
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label>Packaging </label>
										<input type="number" class="form-control packing"  name="delivery_fee" value="<?php set_value('delivery_fee')?>" onkeyup="itemamount()" placeholder="Enter Packaging" />
										<div class="invalid-feedback">
											Please provide a valid Packaging.
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('delivery_fee'); ?></span>
								</div>
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label >Vat </label>
										<select class="form-control vat" name="vat" id="exampleFormControlSelect1" onchange="itemamount()" />
											<option value="">Select Vat</option>
											<?php 
												$vat = $this->vat_model->viewvat();
												if(is_array($vat) && count($vat) >0){
													foreach($vat as $vat){
											?>
											<option value="<?php echo $vat->vat?>"><?php echo $vat->vat?>%</option>
											<?php
													}
												}
											?>
										</select>
										<div class="invalid-feedback">
											Please provide a valid Vat.
										</div>
										<span class="text-danger"><?php echo form_error('vat'); ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group b-grey">
										<label>Final Price *</label>
										<input type="text" class="form-control total"  name="final_amount" placeholder="Final Price" required />
									</div>
								</div>
							</div><br>
							<div class="row bb-grey ">
							    <label>Add-on groups for this item </label>
							    <div class="row">
    							    <?php 
    							        $par['whereCondition']= "addon_acde LIKE 'Active' AND addon_id != '0'";
    							        $addon = $this->addon_model->view_addon($par);
    							        if(is_array($addon) && count($addon) > 0){
    							            foreach($addon as $ad){
    							            ?> 
    							            <div class="col-md-3">
    							                <a data-toggle="modal" class="addon<?php echo $ad->addon_id;?>" data-ids<?php echo $ad->addon_id;?>="<?php echo $ad->addon_id;?>"  onclick="addon('<?php echo $ad->addon_id;?>')" data-ids<?php echo $ad->addon_id;?>="<?php echo $ad->addon_id;?>" data-title<?php echo $ad->addon_id;?>="<?php echo $ad->addon_name;?>" ><!--data-target=".bd-example-modal-lgs"-->
        							                <blockquote class="blockquote media-object" style="height: 160px;">
                                                        <div class="media">
                                                            <div class="usr-img mr-2">
                                                                <img alt="avatar" src="<?php echo base_url().'upload/addon/'.$ad->addon_image_path;?>" class="br-30">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <b><?php echo $ad->addon_name;?></b><br>
                                                               <p class="d-inline"><?php echo $ad->addon_description;?></p>
                                                            </div>
                                                        </div>
                                                    </blockquote>
                                                </a>
    							            </div>
    							            <?php 
    							            }
    							            ?>
    							            <div class="col-md-3">
        							            <a data-toggle="modal" class="addon0" onclick="addon('0')" data-ids0="<?php echo $ad->addon_id;?>" data-ids0="" data-title0="" >
            							            <blockquote class="blockquote media-object">
                                                        <div class="media">
                                                            <div class="usr-img mr-2">
                                                                <img alt="avatar" src="<?php echo base_url().'upload/addon/'.$ad->addon_image_path;?>" class="br-30">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <b>Make your own</b><br>
                                                               <p class="d-inline">Build your own addon group if you didn’t find one above.</p>
                                                            </div>
                                                        </div>
                                                    </blockquote>
                                                </a>
                                            </div>
    							            <?php 
    							        }
    							    ?>
							    </div>
							</div>
							<div class="row bb-grey ">
							    <label>Variants of this item </label>
							    <div class="row">
    							    <?php 
    							        $par['whereCondition']= "variant_acde LIKE 'Active' AND variant_id !='0'";
    							        $variant = $this->variant_model->view_variant($par);
    							        if(is_array($variant) && count($variant) >0){
    							            foreach($variant as $var){
    							            ?> 
    							            <div class="col-md-4">
    							                <a class="variant<?php echo $var->variant_id;?>" onclick="variant('<?php echo $var->variant_id;?>')" data-title<?php echo $var->variant_id;?>="<?php echo $var->variant_name;?>">
        							                <blockquote class="blockquote media-object">
                                                        <div class="media">
                                                            <div class="usr-img mr-2">
                                                                <img alt="avatar" src="<?php echo base_url().'upload/variant/'.$var->variant_image_path;?>" class="br-30">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                               <b><?php echo $var->variant_name;?></b><br>
                                                               <p class="d-inline"><?php echo $var->variant_description;?></p>
                                                            </div>
                                                        </div>
                                                    </blockquote>
                                                </a>
    							            </div>
    							            <?php 
    							            }
    							            ?>
    							            <div class="col-md-4">
        							            <a class="variant0" onclick="variant('0')" data-title0="" data-ids0="0">
        							                <blockquote class="blockquote media-object">
                                                        <div class="media">
                                                            <div class="usr-img mr-2">
                                                                <img alt="avatar" src="<?php echo base_url().'upload/addon/'.$ad->addon_image_path;?>" class="br-30">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <b>Make your own</b><br>
                                                                <p class="d-inline">Build your own addon group if you didn’t find one above.</p>
                                                            </div>
                                                        </div>
                                                    </blockquote>
                                                </a>
                                            </div>
    							            <?php 
    							        }
    							    ?>
							    </div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12">
									<div class="form-group b-grey">
										<label >Item timings *</label> 
										<div class="n-chk">
											<label class="new-control new-radio square-radio new-radio-text">
												<input type="radio" class="new-control-input" name="timings" data-value="alltime" onclick="timmes('alltime')" value="alltime" checked required="">
												<span class="new-control-indicator"></span><span class="new-radio-content">all times when kitchen / restaurant is open on Rayt</span>
											</label>
										</div>
										<div class="n-chk">
											<label class="new-control new-radio square-radio new-radio-text">
												<input type="radio" class="new-control-input" name="timings" data-value="alldays" onclick="timmes('alldays')" value="alldays" required="">
												<span class="new-control-indicator"></span><span class="new-radio-content">Item is available at same time for all days of the week</span>
											</label>
											<div class="jumbotron" id="alldays" style="display:none;">
												<div id="alldays"></div>
											</div>
										</div>
										<div class="n-chk">
											<label class="new-control new-radio square-radio new-radio-text">
												<input type="radio" class="new-control-input" name="timings" data-value="differentdays" onclick="timmes('differentdays')" value="differentdays" required="">
												<span class="new-control-indicator"></span><span class="new-radio-content">Item is available at different times during different days of the week</span>
											</label>
											<div class="differentdays jumbotron" style="display:none;">
												<div id="differentdays"></div>
											</div>
										</div>
										<div class="invalid-feedback">
											Please provide a valid Item timings.
										</div>
									</div>
									<span class="text-danger"><?php echo form_error('timings'); ?></span>
								</div>
							</div>								
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>