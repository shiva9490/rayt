<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <!--  BEGIN CONTENT AREA  -->
<div  class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 d-flex" ><a href="<?php echo adminurl('Drivers');?>" class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></a><h5> Status : <strong class="text-success"><?php if($view['driver_login_statuss'] =="Active"){ echo "Available";}elseif($view['driver_login_statuss'] =="Deactive"){echo "Not available";}else{ echo "Offline";} ?> </strong></h5></div>
                            <div class="col-md-6">
                                <a href="<?php echo adminurl("Update-Driver/".$view['driver_id']);?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">Edit </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">              
                <div class="widget widget-chart-one">
                     <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget-heading">
                                <h5 class="">Personal information</h5>                        
                            </div>
                            <div class="widget-content">       
                                <div class="row">   
                                    <div class="col-xl-12 col-lg-12 col-md-12">                                      
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon7">Driver ID / User ID</span>
                                            </div>
                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="<?php echo $view['driver_given_id'];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-12 col-md-4">
                                        <div class="upload mt-4 pr-md-4">
                                            <input type="file" id="input-file-max-fs" class="dropify" data-default-file="<?php echo base_url().'upload/drivers/'.$view['driver_profile_image']?>" data-max-file-size="2M" />
                                            <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-12 col-md-4">
                                        <div class="upload mt-4 pr-md-4 d-flex justify-content-between">
                                        <button class="btn btn-primary mb-2"><a href="<?php echo base_url().'upload/drivers/'.$view['driver_profile_image']?>" target="_blank" class="text-white">Download</a> </button>
                                        <button class="btn btn-danger mb-2">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="widget widget-chart-two"> 
                                <div class="widget widget-chart-two maps-update"> 
                                    
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">    
                            <div>
                                <input type="hidden" class="driverid" value="<?php echo $this->uri->segment(3);?>">
                                <h5>Driver name : <span><?php echo $view['driver_name'].' '.$view['driver_name_last'];?></span> </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-12 col-md-8">                         
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon7">Phone Number</span>
                                </div>
                                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="<?php echo $view['driver_phone'];?>" readonly>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-8">
                            <div class="mb-4">
                                <h6 class="mb-0">Gender</h6>
                                <div class="n-chk">
                                 <?php foreach($this->config->item('gender') as $z){?>
                                    <label class="new-control new-checkbox new-checkbox-rounded checkbox-success">
                                    <input type="radio" name="gender" class="new-control-input" <?php if($view['driver_gender']==$z){echo 'checked';}?> readonly>
                                    <span class="new-control-indicator"></span><?php echo $z;?>
                                    </label>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-12 col-md-8">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                 <span class="input-group-text" id="basic-addon7">Nationality</span>
                                </div>
                                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="<?php echo $view['driver_nationality'];?>" readonly>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>Vehicle Type</h6>
                            <select class="form-control mb-4" readonly>                               
                                    <option value="<?php echo $z;?>" selected><?php echo $view['driver_vehicle_type'];?></option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>Zone</h6>
                            <select class="form-control  mb-4" readonly>                              
                               
                                <option value="<?php echo $view['driver_zone'];?>" ><?php echo $view['driver_zone'];?></option>	
                               
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>sub Zone</h6>
                            <select class="form-control mb-4" readonly>                                   
                                <option value="<?php $view['driver_sub_zone'];?>" selected><?php echo $view['driver_sub_zone'];?></option>	
                                   
                            </select>
                        </div>
                    </div>   
                    <div class="row mb-4">
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>Joining date</h6>                        									
                            <input type="text" id="basicFlatpickr"  class="form-control flatpickr flatpickr-input active"  placeholder="<?php echo $view['driver_joining_date'];?>" value="" readonly />
                       </div>
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>Category</h6>
                            <input type="text" class="form-control" placeholder="<?php echo $view['driver_category'];?>" readonly>                          
                        </div>  
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>Company</h6>                        									
                            <input type="text" class="form-control" placeholder="<?php echo $view['driver_company'];?>" readonly>
                       </div>                    
                    </div>  
                    <div class="row">                       
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <h6>Password</h6> 
                            <div class="input-group mb-4" id="show_hide_password">                               
                                <input type="password" class="form-control" value="<?php echo $view['driver_login_password'];?>" readonly>
                                <div class="input-group-prepend">
                                 <span class="input-group-text"><i class="far fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>  
                       </div>                    
                    </div>   
                    <div class="row">     
                                  
                        <div class="col-xl-6 col-lg-6 col-md-6">   
                        <h5>Allocate Restaurant</h5>                            
                            <div class="input-group mb-4" >                               
                                <input type="text" class="form-control" placeholder="<?php echo $view['driver_resturant_alloc'];?>" readonly>                                
                            </div>  
                       </div>  
                       <div class="col-xl-4 col-lg-4 col-md-4">                          
                            <div class="input-group mb-4 mt-4" >                               
                                <input type="submit" class="form-control btn btn-success" value="Allocate Driver" >                                
                            </div>  
                       </div>                   
                    </div>  
                    <div class="row">                       
                        <div class="col-xl-12 col-lg-12 col-md-4 mb-4">
                           <h5> Restaurant</h5>
                           <table class="table b-g">
                                <thead>
                                    <tr id="filters">
                                        <th>Restaurant Name</th>
                                        <th>Address </th>
                                        <th>Phone </th>                                    
                                        <th>Menu Hours </th>                                    
                                        <th>Remove</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>                                   
                                </tbody>
                            </table>
                       </div>                    
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
