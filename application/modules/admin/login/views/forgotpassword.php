<div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Forgot Password <a href="<?php echo base_url();?>"><span class="text-primary"><?php echo sitedata("site_name");?></span></a></h1>
						 <?php $this->load->view('admin/success_error');?>
                        <form class="text-left" method="post">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" type="text" name="email_user"  class="form-control" placeholder="Enter Email Id/User Name">
									<span class="text-danger"><?php echo form_error('email_user'); ?></span>
                                </div>
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"><i class="fa fa-check edu-checked-pro" aria-hidden="true"></i> Submit</button>
                                </div>
                            </div>
                        </form>                        
                        <p class="terms-conditions">© Copyright © 2021. <a href="<?php echo sitedata("site_name");?>"><?php echo sitedata("site_name");?></a> All Rights Reserved</p>
                     </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>