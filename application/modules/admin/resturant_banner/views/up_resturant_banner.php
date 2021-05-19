<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Resturant_banner</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Update Resturant_banner</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                <div class="row">
                     <div class="col-sm-8">
                        <div class="custom-file-container" data-upload-id="myFirstImage">
							<label>Resturant_banner Image <span class="required text-danger">*</span> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
							<label class="custom-file-container__custom-file" >
								<input type="file" class="custom-file-container__custom-file__custom-file-input"  name="image" accept="image/*" required>
								<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
								<span class="custom-file-container__custom-file__custom-file-control"></span>
								<div class="invalid-feedback">
									Please provide a valid Resturant Main Image.
								</div>
							</label>
							<div class="custom-file-container__image-preview"></div>
						</div>                     
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Resturant_banner Image </label>
                            <img src="<?php echo base_url('upload/resturant_banner/'.$view['resturant_banner_image_path']);?>" width="100px"/>
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