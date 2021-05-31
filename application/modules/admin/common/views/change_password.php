
<div class="row layout-top-spacing">
<div class="col-lg-3"></div>
    <div class="col-lg-6">
      <div class="card">
            <div class="card-header">Change Password</div>
                <div class="card-body">
                    <form action="" method="post" class="validform" id="change_password" novalidate="">
                        <?php $this->load->view("admin/success_error");?>
                        <div class="form-group mb-3">
                            <label>Old Password <span class="required text-danger">*</span></label>
                            <input id="password" name="old_password" type="password" class="form-control old_password" placeholder="Old Password" value="" required="" minlength="5" maxlength="50"/>
                            <?php echo form_error('old_password');?>
                        </div>
                        <div class="form-group mb-3">
                            <label>New Password <span class="required text-danger">*</span></label>
                            <input id="password" name="new_password" type="password" class="form-control new_password" placeholder="New Password" value="" required="" minlength="5" maxlength="50"/>
                            <?php echo form_error('new_password');?>
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Password <span class="required text-danger">*</span></label>
                            <input id="password" type="password" name="con_password" class="form-control cpwd" placeholder="Confirm Password" value="" required=""  minlength="5" maxlength="50"/>
                            <?php echo form_error('con_password');?>
                        </div>
                       
                        <div class="d-sm-flex justify-content-between">
                            <!-- <div class="field-wrapper toggle-pass">
                                <p class="d-inline-block">Show Password</p>
                                <label class="switch s-primary">
                                    <input type="checkbox" id="toggle-password" class="d-none">
                                    <span class="slider round"></span>
                                </label>
                            </div> -->
                            <div class="field-wrapper">
                            <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"><i class="fa fa-check edu-checked-pro" aria-hidden="true"></i> Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


