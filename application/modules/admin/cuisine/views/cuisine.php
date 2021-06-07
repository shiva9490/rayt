<?php
$cr     =   $this->session->userdata("create-cuisine");
$ur     =   $this->session->userdata("update-cuisine");
$dr     =   $this->session->userdata("delete-cuisine");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Cuisine</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post"  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Cuisine Name<span class="required text-danger">*</span></label>
                            <input name="cuisine_name" type="text" class="form-control text-capitalize" placeholder="Cuisine Name" value="<?php echo set_value('cuisine_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("cuisine_name");?> <br>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Cuisine Arabic Name<span class="required text-danger">*</span></label>
                            <input name="cuisine_name_a" type="text" class="form-control text-capitalize" placeholder="اسم المطبخ" value="<?php echo set_value('cuisine_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("cuisine_name");?> <br>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                <label>Cuisine Image (Single File) (300*300PX)  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"  name="cuisine_image_path" accept="image/*" value="<?php echo set_value('cuisine_image')?>" >
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
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
          <div class="card-header">View Cuisines</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>