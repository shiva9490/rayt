<?php
$cr     =   $this->session->userdata("create-banner");
$ur     =   $this->session->userdata("update-banner");
$dr     =   $this->session->userdata("delete-banner");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Banner</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="needs-validation" method="post"  enctype="multipart/form-data">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="custom-file-container" data-upload-id="myFirstImage">
							<label>Banner Image <span class="required text-danger">*</span> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
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
          <div class="card-header">View Banners</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>