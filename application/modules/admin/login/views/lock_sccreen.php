<div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <div class="d-flex user-meta">
                             <h1 class="">Log In to <a href="<?php echo base_url();?>"><span class="brand-name"><?php echo sitedata("site_name");?></span></a></h1>
                           
                        </div>
                       <?php $this->load->view('admin/success_error');?>
                        <form class="text-left" method="post">
                            <div class="form">
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password">
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>                               
                            
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit">Unlock</button>
                                    </div>                                    
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