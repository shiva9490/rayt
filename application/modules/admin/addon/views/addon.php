<?php
$cr     =   $this->session->userdata("create-addon");
$ur     =   $this->session->userdata("update-addon");
$dr     =   $this->session->userdata("delete-addon");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Addon</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post"  enctype="multipart/form-data">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Addon Name<span class="required text-danger">*</span></label>
                            <input name="addon_name" type="text" class="form-control text-capitalize" placeholder="Addon Name" value="<?php echo set_value('addon_name');?>" required=""/>
                            <?php echo form_error("addon_name");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Addon Description<span class="required text-danger">*</span></label>
                            <textarea name="addon_description" type="text" class="form-control text-capitalize" placeholder="Addon Description" required><?php echo set_value('addon_description');?></textarea>
                            <?php echo form_error("addon_description");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Addon Image (optional)</label>
                            <input name="image" type="file" class="form-control text-capitalize" value="<?php echo set_value('image');?>"/>
                            <?php echo form_error("image");?> <br>
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
          <div class="card-header">View Addons</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>