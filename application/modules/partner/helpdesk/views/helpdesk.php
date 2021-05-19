<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="mail-box-container">                                     
                <div id="todo-inbox" class="accordion todo-inbox">
                     <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><h5><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Helpdesk </h5> </div>
                               
                            </div>
                        </div>
                        <div class="card-body">                     
                            <div class="col-md-12 mt-3 t_div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>How can we help You ?</h3>
                                        <p>If you have an inquiry or any kind of support, please fill form in the below and we will get back to you promptly</p>
                                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <?php $this->load->view('admin/success_error');?>
                                            <div class="mt-4">
                                                <label ><strong>I'm Enquiring Regarding my branch(es) * </strong></label>

                                                <select class="form-control" name="resturant_branch_name"  required >       
                                                     <option value="">Select Branch</option>                                                                                    
                                                    <option value="<?php echo $view['resturant_name'];?>" > <?php echo $view['resturant_name']; ?>	</option>                                           
                                                
                                                
                                                </select>
                                            </div>
                                            <div class="mt-4">
                                                <label ><strong>My Email address is </strong></label>
                                                <input type="email" class="form-control "  name="resturant_email"  value="<?php echo set_value('email')?>" required />
                                                <span class="text-danger"><?php echo form_error('preparation_time'); ?></span>
                                            </div>

                                            <div class="mt-4">
                                                <label ><strong>I would Like to Enquire about </strong></label>
                                                <select class="form-control helpdeskcat" name="resturant_enquire_type" onchange="helpdeskcats()" id="groups" required >
                                                    <option value="">I would Like to Enquire about</option>
                                                    <?php                                                    
                                                        $pars['whereCondition'] = "helpdesk_abc LIKE 'Active'";
                                                        $help   =   $this->helpdesk_model->viewHelpCategory($pars);
                                                        $i=0;foreach($help as $h){
                                                    ?>
                                                    <option value="<?php echo $h->helpquecat_id; ?>"><?php echo $h->helpdesk_ques_cat; ?></option>										
                                                    <?php } ?>                    
                                                </select>
                                                <select class="form-control mt-3 helpdesksubcat" name="resturant_enquire_for" id="sub_groups" required >
                                                
                                                    <!-- <option  value=""></option>										
                                                    <option data-group='my_account_information' value="Updating contact information" >Updating contact information</option>
                                                    <option data-group='my_account_information' value="" >Updating bank account information</option>
                                                    <option data-group='my_account_information' value="">Updating store address</option>
                                                    <option data-group='my_account_information' value="">Renewing my contract</option>
                                                    <option data-group='my_account_information' value="">Requesting Account Manager information</option>
                                                    <option data-group='my_account_information' value="">Updating store logo or cover image</option>

                                                    <option data-group='payments_and_invoices' value="">Payments and payment dates</option>
                                                    <option data-group='payments_and_invoices' value="">Statement of Accounts</option>
                                                    <option data-group='payments_and_invoices' value="">Invoices</option>
                                                    <option data-group='payments_and_invoices' value="">Payment discrepancy</option>
                                                    <option data-group='payments_and_invoices' value="">Proof of payment</option>
                                                    <option data-group='payments_and_invoices' value="">Compensation for cancelled orders</option>

                                                    <option data-group='reports' value="">Daily orders report</option>
                                                    <option data-group='reports' value="">Cancelled orders report</option>
                                                    <option data-group='reports' value="">Performance report</option>
                                                    <option data-group='reports' value="">Busy status report</option>
                                                    <option data-group='reports' value="">Area level report</option>
                                                    <option data-group='reports' value="">Product mix report</option>
                                                    <option data-group='reports' value="">Other reports</option>
                                                    <option data-group='reports' value="">Sales Report</option>

                                                    <option data-group='marketing' value="">Increasing restaurant visibility</option>
                                                    <option data-group='marketing' value="">Adding or removing discounts</option>
                                                    <option data-group='marketing' value="">GEMs</option>
                                                    <option data-group='marketing' value="">Marketing campaigns</option>
                                                    <option data-group='marketing' value="">Other - General marketing inquiry</option>
                                                    <option data-group='marketing' value="">Discounts not showing issue</option>
                                                    <option data-group='marketing' value="">Premium positions</option>
                                                    <option data-group='marketing' value="">Getting featured on talabat social media</option>

                                                    <option data-group='vendor_portal' value="">New access to my vendor portal</option>
                                                    <option data-group='vendor_portal' value="">Issue with my vendor portal</option>
                                                    <option data-group='vendor_portal' value="">Removing access to my vendor portal</option>
                                                    <option data-group='vendor_portal' value="">Question about my vendor portal</option>
                                                    
                                                    <option data-group='my_menu' value="">Other menu issues</option>
                                                    <option data-group='my_menu' value="">Support in updating my menu</option>
                                                    <option data-group='my_menu' value="">Updating my cuisine tags</option>
                                                    <option data-group='my_menu' value="">Follow up on pending approval</option>
                                                    <option data-group='my_menu' value="">Menu updates not showing</option>
                                                    <option data-group='my_menu' value="">Requesting a photoshoot</option>

                                                    <option data-group='delivery_settings' value="">Delivery area change (for Talabat Marketplace)</option>
                                                    <option data-group='delivery_settings' value="">Delivery area inquiry</option>
                                                    <option data-group='delivery_settings' value="">Delivery fee and MOV change </option>
                                                    <option data-group='delivery_settings' value="">Switching to Talabat delivery</option>
                                                    <option data-group='delivery_settings' value="">Inaccurate location issue</option>
                                                    <option data-group='delivery_settings' value="">Other delivery settings inquiries</option>

                                                    <option data-group='store_and_tablet_settings' value="">My GoWIN password</option>
                                                    <option data-group='store_and_tablet_settings' value="">GoDroid or tablet issue</option>
                                                    <option data-group='store_and_tablet_settings' value="">Printer not working</option>
                                                    <option data-group='store_and_tablet_settings' value="">Other store or tablet issues</option>
                                                    <option data-group='store_and_tablet_settings' value="">Restaurant showing closed or busy</option>
                                                    <option data-group='store_and_tablet_settings' value="">New simcard or tablet</option>
                                                    <option data-group='store_and_tablet_settings' value="">Store opening and closing times</option>
                                                    <option data-group='store_and_tablet_settings' value="">Store not showing on app</option>

                                                    <option data-group='feedback_and_complaints' value="">Complaint on a customer review</option>
                                                    <option data-group='feedback_and_complaints' value="">Account manager feedback</option> -->
                                                



                                                
                                                </select>
                                            </div>


                                            <div class="mt-4">
                                                <label ><strong>Please Make More Details </strong></label>
                                                <textarea  class="form-control " name="resturant_enquire_details" required ><?php echo set_value('resturant_enquire_details')?> </textarea>
                                                <span class="text-danger"><?php echo form_error('resturant_enquire_details'); ?></span>
                                            </div>

                                            <div class="mt-4">
                                            
                                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                                        <label><strong>Upload any file(s) that might help resolve your enquiry </strong> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                        <label class="custom-file-container__custom-file" >
                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="image" required>
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                        </label>
                                                        <div class="custom-file-container__image-preview"></div>
                                                    </div>
                                            
                                            </div>
                                            <div class="mt-4">
                                            
                                                <input type="submit" name="submit" class="form-control btn btn-primary" value="Submit"    /> 
                                            </div>
                                        </form>
                                     </div>
                                     <div class="col-md-6">
                                        <img  src="<?php echo $this->config->item('admin_assets');?>assets/img/partner/helpdesk.jpg" class="img-responsive" />
                                     </div>
                                </div>    
                               
                            </div> 
                        </div>
                    </div>      
                </div>
            </div> 
        </div>
    </div>
</div>