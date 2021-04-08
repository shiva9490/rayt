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
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Users");?>">Users</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update User</li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
          <div class="card-header">Update User</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>User Name <span class="required text-danger">*</span></label>
                            <input name="username" type="text" class="form-control username text-capitalize" placeholder="User Name" value="<?php echo (count($view) > 0)?$view['login_name']:set_value('username');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("username");?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Email <span class="required text-danger">*</span></label>
                            <input name="useremail" type="email" class="form-control useremail" placeholder="Email Id" value="<?php echo  (count($view) > 0)?$view['login_email']:set_value('useremail');?>" required=""/>
                            <?php echo form_error("useremail");?> 
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
                                            <option value="<?php echo $vssf;?>" <?php echo ($vssf == $view["ut_id"])?"selected='selected'":set_select("rolevalname",$vssf);?>><?php echo $xname;?></option>
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
                            <input name="password" type="text" class="form-control" placeholder="Password" value="<?php echo  (count($view) > 0)?base64_decode($view['login_password']):set_value('password');?>" required=""/>
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
</div>