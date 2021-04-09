<?php
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Role</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Role Name <span class="required text-danger">*</span></label>
                            <input name="role_name" type="text" class="form-control role_name text-capitalize" placeholder="Role Name" value="<?php echo set_value('role_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("role_name");?> 
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
    <div class="col-lg-8">
      <div class="card">
          <div class="card-header">View Roles</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>