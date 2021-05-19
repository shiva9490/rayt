<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Variant</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Update Variant</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Variant Name<span class="required text-danger">*</span></label>
                            <input name="variant_name" type="text" class="form-control text-capitalize" placeholder="Variant Name" value="<?php echo $view['variant_name'];?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("variant_name");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Variant Description<span class="required text-danger">*</span></label>
                            <textarea name="variant_description" type="text" class="form-control text-capitalize" placeholder="Variant Description" required><?php echo $view['variant_description'];?></textarea>
                            <?php echo form_error("variant_description");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Variant Image (optional)</label>
                            <input name="image" type="file" class="form-control text-capitalize" placeholder="Variant Name" value="<?php echo set_value('image');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("image");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Variant Image </label>
                            <img src="<?php echo base_url('upload/variant/'.$view['variant_image_path']);?>" width="100px"/>
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