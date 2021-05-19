<div class="row layout-top-spacing">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="container-fluid py-3 pt-4 bb-grey sticky">
					<div class="row">	
                        <div class="col-md-10 mx-auto box-shaow">	
                         <div class="row">					
                            <div class="col-md-6">
                                <h4><?php echo $title;?></h4>
                            </div>
                            <div class="col-md-6 d-flex">
                                <a href="<?php echo partnerurl('Discount');?>" class="btn btn-danger"> Cancel</a>
                                <button type="submit" class="btn btn-primary" name="publish" value="Publish">publish</button>
                            </div>
                            </div>
                        </div>    
					</div>
				</div>
				<div class="container-fluid py-3 pt-4">
					<?php $this->load->view('admin/success_error');?>
					<div class="row">
						<div class="col-md-10 mx-auto box-shaow">			
					         <div class="col-md-12 m-3">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                         <label >Type of Discount *</label>
                                         <select class="form-control" name="discount_type" id="exampleFormControlSelect1"required >
											<option value="">Select Discount Type</option>										
											<option value="" >Percentage</option>
                                            <option value="" >Amount</option>
										
										</select>
                                    </div>
                                    <div class="col-md-4">
                                        <label > Discount *</label>
                                        <div class="form-group b-grey">
                                            <input type="text" class="form-control arabic_feild"  name="discount"  value="<?php echo set_value('discount')?>" required />
                                            <div class="invalid-feedback">
                                                    Please provide a valid discount.
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <label >MIN Discount Value *</label>
                                        <div class="form-group b-grey">
                                            <div class="d-flex">
                                               <h5 class="mt-3 mr-3"> &#8377;</h5>
                                                <input type="text" class="form-control arabic_feild"  name="discount"  value="<?php echo set_value('discount')?>" required />
                                            </div>
                                            <div class="invalid-feedback">
                                                    Please provide a valid discount.
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Validity Period *</label>
                                     </div>
                                    
                                    <div class="col-md-4">
                                         <div class="form-group b-grey">
                                            <input id="rangeCalendarFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                            <div class="invalid-feedback">
                                                Please provide a valid  Date.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group b-grey">
                                            <input id="" value="<?php echo date('Y-m-d')?>" class="form-control " type="text" name="to_date" required />
                                            <div class="invalid-feedback">
                                                Please provide a valid  Date.
                                            </div>
                                        </div>
                                    </div>
                                </div>    

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Daily Time Slot *</label>
                                        <p><strong>Warning : </strong>Your Discount is valid for this time slot only </p>
                                     </div>
                                    
                                    <div class="col-md-4">
                                         <div class="form-group b-grey">
                                         <input class="form-control" id="timepicker2" name="strt_time" value="<?php echo set_value('strt_time');?>" required />
                                            <div class="invalid-feedback">
                                                Please provide a valid Time.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group b-grey">
                                         <input id="timepicker1" name="end_time" value="<?php echo set_value('end_time');?>"  class="form-control" required/>
                                            <div class="invalid-feedback">
                                                Please provide a valid Time.
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Type Of Customer *</label>                                       
                                     </div>                                    
                                    <div class="col-md-4">                                        
                                         <div class="form-group b-grey">
                                                
        										<input type="radio"  name="all" value="<?php echo set_value('all');?>"/>
        										<label >All</label>        									
                                        </div>
                                    </div>
                                    <div class="col-md-4">                                      
                                        <div class="form-group b-grey">
        										<input type="radio"  name="all" value="<?php echo set_value('first_time_customer');?>"/>
        										<label >First Time Customer &#8505;</label>        									
                                        </div>                                       
                                    </div>
                                </div>  
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Applicable Outlets *</label>                                       
                                     </div>                                    
                                    <div class="col-md-4">                                        
                                         <select class="form-control" name="applicable_outlet" id="exampleFormControlSelect1"required >
											<option value="">2000</option>
										</select>
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
