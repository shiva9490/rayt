<div class="container-fluid">
    <div class="row pt-2 pb-2">
       <div class="col-sm-12">
          <h4 class="page-title">Create Profile</h4>
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page">Create Profile</li>
          </ol>
       </div>
    </div>
    <div class="row">
       <div class="col-lg-12">
            <?php $this->load->view('admin/success_error');?>
            <div class="card">
             <div class="card-body">
                <form class="validform" method="post" action="" autocomplete="off" novalidate="">
                    <div class="pb-3">Note : <span class='text-danger'>"123456"</span> is the password</div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Usertype <span class="required text-danger">*</span></label>
                            <div class="form-group">
                                <label><input type="radio" name="usertype" required="" value="Student" id="radio2" checked="checked"/> Student</label>
                                <label><input type="radio" required="" name="usertype" value="Teacher" id="radio2"/> Teacher</label>
                            </div>
                            <?php echo form_error('usertype');?>  
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div><input type="checkbox" value="1" checked="checked" name="reg_mobile_verified" /> Mobile Verified</div>
                                <div><input type="checkbox" value="1" checked="checked" name="reg_email_verified" /> Email Verified</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Name <span class="required text-danger">*</span></label>
                                <input name="fullname" type="tex" class="form-control input_char" placeholder="Name" required="" minlength="1" maxlength="50"/>
                                <?php echo form_error('fullname');?> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Mobile No. </label>
                                <input name="mobileno" type="text" class="form-control" placeholder="Mobile No." minlength="1" maxlength="50"/>
                                <?php echo form_error('mobileno');?> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Email Id </label>
                                <input name="emailid" type="email" class="form-control" placeholder="Email Id" minlength="1" maxlength="200"/>
                                <?php echo form_error('emailid');?> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Country <span class="required text-danger">*</span></label>
                                <input type="text" class="form-control" name="country" required="" id="country" placeholder="Type here for Country *" onkeyup="cusountry($(this))">
                                <input type="hidden" name="countryid" class="cutnryid"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success">Save</button>
                    </div>
                </form>
             </div>
          </div>
       </div>
    </div>
    <div class="overlay toggle-menu"></div>
 </div>