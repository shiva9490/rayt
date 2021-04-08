<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Organization</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Institutions");?>">Institutions</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update Institution</li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Update Institution</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Institution Name<span class="required text-danger">*</span></label>
                            <input name="institutionname" type="text" class="form-control institutionname text-capitalize" placeholder="Institution Name" value="<?php echo (count($view) > 0)?$view["institution_name"]:set_value('institution_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("institutionname");?> 
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