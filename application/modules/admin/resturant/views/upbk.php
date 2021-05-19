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
              <input type="submit" class="btn b-success" name="update" value="Update"/>
            </div>
          </div>
        </div>
        <div class="container-fluid py-3 pt-4">
            <?php $this->load->view('admin/success_error');?>
          <div class="row">
            <div class="col-md-8 mx-auto">
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
                    <input type="text" class="form-control" name="id" value="<?php echo $view['resturant_id'];?>" disabled/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Password</label>
                    <input type="text" class="form-control"  name="password" value="<?php echo base64_decode ($view['resturant_password']);?>" placeholder="Enter Password"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label >Resturant Name</label>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group b-grey">
                            <input type="text" class="form-control width-100"  name="name" value="<?php echo $view['resturant_name'];?>" placeholder="Enter Resturant Name" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group b-grey">
                            <input type="text" class="form-control arabic_feild width-100"  name="name_a" value="<?php echo $view['resturant_name_a'];?>" placeholder="أدخل اسم المطعم" required>
                          </div>
                            
                        </div>
                    </div>
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
                      <input type="text" class="form-control  arabic_feild" name="contact_person_a" value="<?php echo $view['resturant_contact_a'];?>" placeholder="أدخأدخل اسم جهة الاتصال"/>
                      <input type="text" class="form-control" name="contact_person" value="<?php echo $view['resturant_contact'];?>" placeholder="Enter Contact Person Name"/>
                    </div>
                  </div>
                  <div class="col-md-12 m-3">
                      <label>Position</label>
                    <div class="form-group b-grey">
                      <input type="text" class="form-control arabic_feild"  name="position_a" value="<?php echo $view['resturant_position_a'];?>" placeholder="أدخل الوظيفة"   />
                      <input type="text" class="form-control"  name="position" value="<?php echo $view['resturant_position'];?>" placeholder="Enter Position"/>
                    </div>
                  </div>
                  <div class="col-md-12 m-3">
                    <div class="form-group b-grey">
                      <label>Contact No</label>
                      <input type="text" class="form-control"  name="contact_no" value="<?php echo $view['resturant_contact_no'];?>" placeholder="Enter Contact number"/>
                    </div>
                  </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                    <label>Area</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild" value="<?php echo $view['resturant_area_a'];?>"  name="area_a" placeholder="أدخل المنطقة"   />
                    <input type="text" class="form-control"  name="area" value="<?php echo $view['resturant_area'];?>" placeholder="Enter Area"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Block No</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild" value="<?php echo $view['resturant_block_a'];?>"  name="block_a" placeholder="أدخل الكتلة"  />
                    <input type="text" class="form-control"  name="block" value="<?php echo $view['resturant_block'];?>" placeholder="Enter block"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Street</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild" value="<?php echo $view['resturant_street_a'];?>"  name="street_a"  placeholder="أدخل الشارع"  />
                    <input type="text" class="form-control"  name="street" value="<?php echo $view['resturant_street'];?>"  placeholder="Enter street"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Jaada</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild" value="<?php echo $view['resturant_jaada_a'];?>"  name="jaada_a"  placeholder="أدخل الجادة"  />
                    <input type="text" class="form-control"  name="jaada" value="<?php echo $view['resturant_jaada'];?>"  placeholder="Enter jaada"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>House No</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="house_a" value="<?php echo $view['resturant_house_a'];?>" placeholder="ادخل المنزل"  />
                    <input type="text" class="form-control"  name="house" value="<?php echo $view['resturant_house'];?>" placeholder="Enter house"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Building No</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild" value="<?php echo $view['resturant_building_a'];?>"  name="building_a"  placeholder="أدخل المبنى"  />
                    <input type="text" class="form-control"  name="building" value="<?php echo $view['resturant_building'];?>"  placeholder="Enter building"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Lattitude</label>
                    <input type="text" class="form-control"  name="latitude" value="<?php echo $view['resturant_latitude'];?>"  placeholder="Enter latitude"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Longitude</label>
                    <input type="text" class="form-control"  name="longitude" value="<?php echo $view['resturant_longitude'];?>"  placeholder="Enter longitude"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                    <label>Landmark</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild" value="<?php echo $view['resturant_landmark_a'];?>"  name="landmark_a"  placeholder="أدخل المَعلم" />
                    <input type="text" class="form-control"  name="landmark" value="<?php echo $view['resturant_landmark'];?>"  placeholder="Enter landmark"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                  <h5>Menu hours</h5>
                  <?php $menu   =   $this->config->item("menu_hours");
                  $mm   = explode(',',$view['resturant_menu_hours']);
                  foreach($menu as $m){?>
                    <div class="form-group b-grey">
                        <label><?php echo $m;?> - </label>
                        <input type="checkbox" class="" name="menu_hours[]" value="<?php echo $m;?>" id="<?php echo $m;?>" 
                        <?php if(in_array($m, $mm)){echo 'checked';}?>/>
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
                    <input type="text" class="form-control"  name="preparation_time" value="<?php echo $view['resturant_preparation'];?>"  placeholder="Enter Preparation Time">
                  </div>
                  <span class="text-danger"><?php echo form_error('preparation_time'); ?></span>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Delivery Fee</label>
                    <input type="text" class="form-control"  name="delivery_fee" value="<?php echo $view['resturant_delivery'];?>" placeholder="Enter Delivery Fee"/>
                  </div>
                </div>
                
                <div class="col-md-6 m-3">
                  <div class="form-group b-grey">
                    <label >Discount</label>
                    <input type="text" class="form-control"  name="discount" value="<?php echo $view['resturant__discount'];?>" placeholder="Enter Discount"/>
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
                    <input type="date" class="form-control"  name="contact_date" value="<?php echo $view['resturant_contract'];?>"/>
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
                    <input type="number" class="form-control"  name="license_no" value="<?php echo $view['resturant_commertial_license'];?>" placeholder="Enter License Number"/>
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
                    <input type="text" class="form-control" placeholder="owner civil id" value="<?php echo $view['resturant_civil_id'];?>"  name="civil_id"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Percentage</label>
                    <input type="text" class="form-control"  name="Percentage" value="<?php echo $view['resturant_percentage'];?>"  placeholder="Enter Percentage">
                  </div>
                  <span class="text-danger"><?php echo form_error('Percentage'); ?></span>
                </div>
                <div class="col-md-12 m-3">
                    <label >Sales Person Name</label>
                  <div class="form-group b-grey">
                    <input type="text" class="form-control arabic_feild"  name="person_name_a" value="<?php echo $view['resturant_sales_person_a'];?>" placeholder="أدخل مندوب المبيعات"  />
                    <input type="text" class="form-control"  name="person_name" value="<?php echo $view['resturant_sales_person'];?>" placeholder="Enter Sales Person Name"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                       
                <div class="tab">
                  <button class="tablinks active" onclick="openCity(event, 'today')">Images</button>
                  <button class="tablinks" onclick="openCity(event, 'una')">Menu</button>
                  <button class="tablinks" onclick="openCity(event, 'pen')">Items</button>
                  
                </div>
                <div id="today" class="tabcontent" style="display:block;">
                  <div class="col-md-12 mt-3">
                     <div class="row">
                         <div class="col-md-6">
                             <h4>Images</h4>
                         </div>
                         <!--<div class="col-md-6">-->
                         <!--<a href="<?php echo base_url('Admin/Create-Orders');?>" class="btn b-success mx-2 ">+ New</a>-->
                         <!--<input type="text" class="form-control sear" placeholder="Search"><input type="submit" value="Search" class="btn b-dark py-1">-->
                         <!--</div>-->
                     </div>
                     <table class="table b-g">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php $n=1; foreach($images as $i){?>
                            <tr>
                               <td><?php echo $n;?></td> 
                               <td><img src="<?php echo base_url($i->resturant_images_path);?>" width="200px"/></td>
                               <td><a href="<?php echo adminurl('Delete-Res-Image/'.$i->resturant_images_id);?>"><i class="fa fa-trash text-danger"></i></a></td>
                              </tr>
                            <?php $n++; }?>
                        </tbody>
                        </table>
                 </div>
                    
                
                </div>
                
                <div id="una" class="tabcontent">
                  <div class="col-md-12 mt-3">
                     <div class="row">
                         <div class="col-md-6">
                             <h4>Menus</h4>
                         </div>
                         <div class="col-md-6">
                         <a href="<?php echo base_url('Admin/Create-Orders');?>" class="btn b-success mx-2 ">+ New</a>
                         <input type="text" class="form-control sear" placeholder="Search"><input type="submit" value="Search" class="btn b-dark py-1">
                         </div>
                     </div>
                 </div>
                </div>
                
                <div id="pen" class="tabcontent">
                     <div class="col-md-12 mt-3">
                     <div class="row">
                         <div class="col-md-6">
                             <h4>Items</h4>
                         </div>
                         <div class="col-md-6">
                         <a href="<?php echo base_url('Admin/Create-Orders');?>" class="btn b-success mx-2 ">+ New</a>
                         <input type="text" class="form-control sear" placeholder="Search"><input type="submit" value="Search" class="btn b-dark py-1">
                         </div>
                     </div>
                 </div> 
                </div>
                
                <script>
                function openCity(evt, cityName) {
                  var i, tabcontent, tablinks;
                  tabcontent = document.getElementsByClassName("tabcontent");
                  for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                  }
                  tablinks = document.getElementsByClassName("tablinks");
                  for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                  }
                  document.getElementById(cityName).style.display = "block";
                  evt.currentTarget.className += " active";
                  evt.preventDefault();
                }
                </script>
                        
            </div>
          </div>

        </div>
</form>