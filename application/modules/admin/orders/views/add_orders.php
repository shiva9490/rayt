
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Add Orders</div>  
                <div class="col-md-3 text-right d-flex justify-content-between ">
                    <a href="<?php echo adminurl('Orders');?>" class="btn btn-danger"> Cancel</a>
                    <button type="submit" class="btn btn-primary" name="publish" value="Publish">publish</button>
                </div>                 
            </div>
        </div>
        <div class="card-body">
         <?php $this->load->view('admin/success_error');?>
            <div class="row layout-top-spacing">
                <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                 
                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>                            
                            <div class="container-fluid py-3 pt-4">                    
                                <div class="row">
                                    <div class="col-md-12 mx-auto box-shaow">
                                        <!--<h5>English</h5>-->
                                        <div class="row bb-grey">
                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">											
                                                    <div class="row">												
                                                        <div class="col-md-6">
                                                            <label for="Deiversname" >Order Type</label>
                                                            <div class="n-chk">
                                                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-success">
                                                                    <input type="radio" name="status" class="new-control-input" checked>
                                                                    <span class="new-control-indicator"></span><span class="new-chk-content">Online</span>
                                                                </label>
                                                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-success">
                                                                    <input type="radio" name="status" class="new-control-input">
                                                                    <span class="new-control-indicator"></span><span class="new-chk-content">Offline</span>
                                                                </label>
                                                            </div>
                                                        </div>													
                                                        <div class="col-md-6">
                                                        <label for="Deiversname" >Date & Time</label>
                                                            <div class="form-group mb-0">
                                                            <input id="dateTimeFlatpickr" value="2020-09-19 12:00" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12">	
                                                <div class="form-group b-grey">		
                                                     <h5 >Order Status</h5>									
                                                    <div class="row">												
                                                        <div class="col-md-6">
                                                            <label for="Deiversname" >Amount</label>
                                                            <div class="input-group mb-4">
                                                                <input type="text" class="form-control" placeholder="Notification" aria-label="notification" aria-describedby="basic-addon2">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">KWD</span>
                                                                </div>
                                                            </div>
                                                        </div>													
                                                        <div class="col-md-6">
                                                        <label for="Deiversname" >Payment Type</label>
                                                            <div class="form-group mb-0">
                                                                <select class="selectpicker form-control">
                                                                    <option>Cash on Delivery</option>
                                                                    <option>Online Payment</option>                                                                  
                                                                    <option>Credit Points</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>

                                            <div class="col-md-12">	
                                                <div class="form-group b-grey">	
                                                    <div class="row">												
                                                        <div class="col-md-12">
                                                            <label for="Deiversname" >Driver</label>
                                                            <div class="input-group mb-4">
                                                                <input type="text" class="form-control" placeholder="Driver Name" name="driver_name" >                                                               
                                                            </div>
                                                        </div>	
                                                    </div>	
                                                </div>				
                                            </div>


                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">												
                                                        <div class="col-md-6">
                                                            <label for="Deiversname" >Restaurant</label>
                                                            <div class="input-group mb-4">
                                                                <input type="text" class="form-control" placeholder="Restaurant" >                                                               
                                                            </div>
                                                        </div>													
                                                        <div class="col-md-6">
                                                        <label for="Deiversname" >Branch</label>
                                                            <div class="form-group mb-4">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Branch" >                                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">												
                                                        <div class="col-md-12">                                                          
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Full Name</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Full Name" aria-label="Full Name">
                                                            </div>
                                                        </div>	
                                                    </div>	
                                                </div>				
                                            </div>

                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">												
                                                        <div class="col-md-12">                                                        
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Area</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Area" aria-label="Area">                                                       
                                                            </div>
                                                        </div>													
                                                      
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                             <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Block No</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Block No" aria-label="Block No">                                                       
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-6">                                                        
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Street</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Street" aria-label="Street">                                                       
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Building No.</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Building No." aria-label="Building No.">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">                                                        
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Room No.</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Room No." aria-label="Room No.">                                                       
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Floor No.</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Floor No." aria-label="Floor No.">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">                                                        
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">House No.</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="House No." aria-label="House No.">                                                       
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Landmark(Optional)</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Landmark" aria-label="Landmark">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">                                                        
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Phone</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Phone" aria-label="Phone">                                                       
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>

                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="form-group mb-4">
                                                                 <input type="submit" name="txt" class="btn btn-primary mb-4 mr-2 btn-lg" value="Copy Address">
                                                            </div>
                                                        </div>
                                                      
                                                    </div>	
                                                </div>				
                                            </div>

                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Latitude</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Latitude" aria-label="Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">                                                        
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Longitude</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Longitude" aria-label="Longitude">                                                       
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>				
                                            </div>

                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="form-group mb-4">
                                                                 <input type="submit" name="txt" class="btn btn-primary mb-4 mr-2 btn-lg" value="Copy Location">
                                                            </div>
                                                        </div>
                                                      
                                                    </div>	
                                                </div>				
                                            </div>

                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="form-group mb-4">
                                                                <label>ETA to Restaurant:Null </label>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>	
                                                </div>				
                                            </div>
                                            <div class="col-md-12 ">	
                                                <div class="form-group b-grey">	                                                  							
                                                    <div class="row">									
                                                        <div class="col-md-6">                                                      
                                                            <div class="form-group mb-4">
                                                                <label>ETA to Customers:Null </label>
                                                            </div>
                                                        </div>
                                                      
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
      </div>
   </div>
</div>
