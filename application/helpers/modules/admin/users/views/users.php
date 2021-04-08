<?php
$cr     =   $this->session->userdata("create-user");
$ur     =   $this->session->userdata("update-user");
$dr     =   $this->session->userdata("delete-user");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Users</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Users</li>
      </ol>
   </div>
</div>
<div class="row">
    <?php if($cr == "1") { ?>
   <div class="col-lg-12">
      <div class="card">
          <div class="card-header">Create User</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>User Name <span class="required text-danger">*</span></label>
                            <input name="user_name" type="text" class="form-control user_name text-capitalize" placeholder="User Name" value="<?php echo set_value('user_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("user_name");?> 
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Email <span class="required text-danger">*</span></label>
                            <input name="user_email" type="email" class="form-control user_email" placeholder="Email Id" value="<?php echo set_value('user_email');?>" required=""/>
                            <?php echo form_error("user_email");?> 
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Role <span class="required text-danger">*</span></label>
                            <select required="" title="Select Role" class="form-control rolevalname select2" name="rolevalname">
                                <option value="">Select Role</option>
                                <?php 
                                    if(count($roles) > 0){
                                        foreach($roles as $ce){
                                        $xname   =   $ce->ut_name; 
                                        $vssf    =   $ce->ut_id;  
                                                ?>
                                            <option value="<?php echo $vssf;?>" <?php echo set_select("rolevalname",$vssf);?>><?php echo $xname;?></option>
                                            <?php
                                        }
                                    }
                                ?> 
                            </select>
                            <?php echo form_error("rolevalname");?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Password <span class="required text-danger">*</span></label>
                            <input name="password" type="password" class="form-control user_name text-capitalize" placeholder="Password" value="<?php echo set_value('password');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("password");?> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
         </div>
      </div>
   </div>
    <?php } ?>
    <div class="col-lg-12">
      <div class="card">
          <div class="card-header">View Users</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>