<form method="POST" enctype="multipart/form-data" onsubmit="novalidate" name="myForm">
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
              <a href="<?php echo adminurl('Resturant');?>" class="btn b-light"> Cancel</a>
              <input type="submit" class="btn b-success" name="publish" value="Publish"/>
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
						<label >Resturant Main Image</label>
						<div class="form-group">
							<input type="file" class="form-control width-100"  name="main_image" onchange="document.getElementById('main_image').src = window.URL.createObjectURL(this.files[0]);"/>
							<img id="main_image" width="50px"/>
						</div>
					</div>
					<div class="col-md-12 m-3">
						<div class="form-group b-grey">
							<label >Resturant ID</label>
							<input type="text" class="form-control" name="id" value="15202112" disabled/>
						</div>
					</div>
					<div class="col-md-12 m-3">
						<div class="form-group b-grey">
							<label >Password</label>
							<input type="text" class="form-control"  name="password" placeholder="Enter Password"/>
						</div>
					</div>
					<div class="col-md-12 m-3">
						<label >Resturant Name</label>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group b-grey">
									<input type="text" class="form-control width-100"  name="name" value="<?php set_value('name')?>" placeholder="Enter Resturant Name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group b-grey">
									<input type="text" class="form-control arabic_feild width-100"  name="name_a" value="<?php set_value('name_a')?>" placeholder="أدخل اسم المطعم" required>
								</div>								
							</div>
						</div>
						<span class="text-danger"><?php echo form_error('name_a'); ?></span>
						<span class="text-danger"><?php echo form_error('name'); ?></span>
					</div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                    <label >Resturant Images <span>( Select multiple images)</span></label>
                  <div class="form-group">
                    <input type="file" class="form-control width-100" name="files[]" id='files' multiple="" onchange="imagesShow()"/>
                    <output id='result' />
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                  <div class="col-md-12 m-3">
                      <label>Contact Person</label>
                    <div class="form-group b-grey">
                      <input type="text" class="form-control  arabic_feild" name="contact_person_a" placeholder="أدخأدخل اسم جهة الاتصال"/>
                      <input type="text" class="form-control" name="contact_person" placeholder="Enter Contact Person Name"/>
                    </div>
                  </div>
                  <div class="col-md-12 m-3">
                      <label>Position</label>
                    <div class="form-group b-grey">
                      <input type="text" class="form-control arabic_feild"  name="position_a" placeholder="أدخل الوظيفة"   />
                      <input type="text" class="form-control"  name="position" placeholder="Enter Position"/>
                    </div>
                  </div>
                  <div class="col-md-12 m-3">
                    <div class="form-group b-grey">
                      <label>Contact No</label>
                      <input type="text" class="form-control"  name="contact_no" placeholder="Enter Contact number"/>
                    </div>
                  </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                    <label>Area</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="area_a" placeholder="أدخل المنطقة"   />
                    <input type="text" class="form-control"  name="area" placeholder="Enter Area"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Block No</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="block_a" placeholder="أدخل الكتلة"  />
                    <input type="text" class="form-control"  name="block" placeholder="Enter block"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Street</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="street_a"  placeholder="أدخل الشارع"  />
                    <input type="text" class="form-control"  name="street"  placeholder="Enter street"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Jaada</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="jaada_a"  placeholder="أدخل الجادة"  />
                    <input type="text" class="form-control"  name="jaada"  placeholder="Enter jaada"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>House No</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="house_a" placeholder="ادخل المنزل"  />
                    <input type="text" class="form-control"  name="house" placeholder="Enter house"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Building No</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="building_a"  placeholder="أدخل المبنى"  />
                    <input type="text" class="form-control"  name="building"  placeholder="Enter building"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Lattitude</label>
                    <input type="text" class="form-control"  name="latitude"  placeholder="Enter latitude"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Longitude</label>
                    <input type="text" class="form-control"  name="longitude"  placeholder="Enter longitude"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Landmark</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="landmark_a"  placeholder="أدخل المَعلم" />
                    <input type="text" class="form-control"  name="landmark"  placeholder="Enter landmark"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                  <h5>Menu hours</h5>
                  <?php $menu   =   $this->config->item("menu_hours");
                  foreach($menu as $m){?>
                    <div class="form-group b-grey">
                        <label><?php echo $m;?> - </label>
                        <input type="checkbox" class="" name="menu_hours[]" value="<?php echo $m;?>" id="<?php echo $m;?>" />
                        <label for="<?php echo $m;?>">closed</label>
                      </div>
                 <?php }
                  ?>
                </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Preparation Time</label> 
                    <input type="text" class="form-control"  name="preparation_time"value="<?php set_value('preparation_time')?>"  placeholder="Enter Preparation Time">
                  </div>
                  <span class="text-danger"><?php echo form_error('preparation_time'); ?></span>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Delivery Fee</label>
                    <input type="text" class="form-control"  name="delivery_fee" placeholder="Enter Delivery Fee"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Discount</label>
                    <input type="text" class="form-control"  name="discount" placeholder="Enter Discount"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                  <h5>Cuisine</h5>
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
                  <div class="form-group b-grey">
                    <label>Zone</label>
                    <div class="custom-select form-control">
                        <select class="form-control" name="zone">
                            <option value=""> Select</option>
                            <option value="1"> 1</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Set delivery time for Zone</label>
                    <div class="custom-select form-control">
                        <select class="form-control" name="zone_time">
                            <option value=""> Select</option>
                            <option value="1"> 1</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Sub Zone</label>
                    <div class="custom-select form-control">
                        <select class="form-control"  name="sub_zone">
                            <option value=""> Select</option>
                            <option value="1"> 1</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Set delivery time for subzone</label>
                    <div class="custom-select form-control">
                        <select class=""  name="sub_zone_time">
                            <option value=""> Select</option>
                            <option value="1"> 1</option>
                        </select>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="row bb-grey py-2">
                  <h5>Legal Information</h5>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Contract Date</label>
                    <input type="date" class="form-control"  name="contact_date"/>
                  </div>
                </div>
                 <div class="col-md-12 m-3">
                  <div class="form-group">
                    <input type="file" class="form-control width-100"  name="legal_doc" onchange="document.getElementById('doc').src = window.URL.createObjectURL(this.files[0]);"/>
                    <img id="doc" width="50px"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Commercial License Number</label>
                    <input type="number" class="form-control"  name="license_no" placeholder="Enter License Number"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey py-2">
                  <h5>Signature Authority (Front/Back)</h5>
                 <div class="col-md-12 m-3">
                  <div class="form-group">
                    <input type="file" class="form-control width-100"  name="sign" onchange="document.getElementById('sign').src = window.URL.createObjectURL(this.files[0]);"/>
                    <img id="sign" width="50px"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Civil Id</label>
                    <input type="text" class="form-control" placeholder="owner civil id"  name="civil_id"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Percentage</label>
                    <input type="text" class="form-control"  name="Percentage" value="<?php set_value('Percentage')?>"  placeholder="Enter Percentage">
                  </div>
                  <span class="text-danger"><?php echo form_error('Percentage'); ?></span>
                </div>
                <div class="col-md-12 m-3">
                    <label >Sales Person Name</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="person_name_a" placeholder="أدخل مندوب المبيعات"  />
                    <input type="text" class="form-control"  name="person_name" placeholder="Enter Sales Person Name"/>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
</form>