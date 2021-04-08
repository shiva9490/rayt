<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Roles</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Roles");?>">Roles</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update Role</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Update Role</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate="">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Role Name <span class="required text-danger">*</span></label>
                                    <input name="rolename" type="text" class="form-control rolename" placeholder="Role Name" value="<?php echo $view['ut_name'];?>" required="" minlength="3" maxlength="50"/>
                                </div>
                                <?php echo form_error('rolename');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                            <div class="form-actions form-group">
                                <button type="submit" class="btn  btn-raised btn-success waves-effect" name="submit" value="submit"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>