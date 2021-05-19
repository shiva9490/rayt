<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Addon</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Update Addon</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Addon Name<span class="required text-danger">*</span></label>
                            <input name="addon_name" type="text" class="form-control text-capitalize" placeholder="Addon Name" value="<?php echo $view['addon_name'];?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("addon_name");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Addon Description<span class="required text-danger">*</span></label>
                            <textarea name="addon_description" type="text" class="form-control text-capitalize" placeholder="Addon Description" required><?php echo $view['addon_description'];?></textarea>
                            <?php echo form_error("addon_description");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Addon Image (optional)</label>
                            <input name="image" type="file" class="form-control text-capitalize" placeholder="Addon Name" value="<?php echo set_value('image');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("image");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Addon Image </label>
                            <img src="<?php echo base_url('upload/addon/'.$view['addon_image_path']);?>" width="100px"/>
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
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>