<div class="container-fluid">
    <div class="row pt-2 pb-2">
       <div class="col-sm-12">
          <h4 class="page-title">Change Password</h4>
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page">Change Password</li>
          </ol>
       </div>
    </div>
    <div class="row">
       <div class="col-lg-6">
          <div class="card">
             <div class="card-body">
                 <?php $this->load->view('admin/success_error');?>
                 <form class="validform" method="post" action="" novalidate="">
                    <div class="form-group">
                        <label>New Password <span class="required text-danger">*</span></label>
                        <input name="new_password" type="password" class="form-control" placeholder="New Password" required="" minlength="1" maxlength="50"/>
                        <?php echo form_error('new_password');?> 
                    </div>
                    <div class="form-group">
                        <label>Confirm Password <span class="required text-danger">*</span></label>
                        <input name="con_password" type="password" class="form-control" placeholder="Confirm Password" required="" minlength="1" maxlength="50"/>
                        <?php echo form_error('con_password');?> 
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