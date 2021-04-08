<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Levels</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Levels");?>">Levels</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update Level</li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Update Level</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Level Name <span class="required text-danger">*</span></label>
                            <input name="levelname" type="text" class="form-control levelname text-capitalize" placeholder="Level Name" value="<?php echo (count($view) > 0)?$view["level_name"]:set_value('levelname');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("levelname");?> 
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