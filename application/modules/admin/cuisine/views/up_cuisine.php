
<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Cuisine</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Update Cuisine</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
               <?php foreach($view as $ve){ ?>
                <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cuisine Name<span class="required text-danger">*</span></label>
                            <input name="cuisine_name" type="text" class="form-control text-capitalize" placeholder="Cuisine Name" value="<?php echo $ve->cuisine_name;?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("cuisine_name");?> <br>
                        </div>
                     </div>
                </div>
                <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cuisine Arabic Name<span class="required text-danger">*</span></label>
                            <input name="cuisine_name_a" type="text" class="form-control text-capitalize" placeholder="اسم المطبخ" value="<?php echo $ve->cuisine_name_a;?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("cuisine_name_a");?> <br>
                        </div>
                    </div>  
                </div> 
                <div class="row">                 
                     <div class="col-sm-4">
                        <div class="custom-file-container" data-upload-id="myFirstImage">
                            <label>Cuisine Image (Single File) (300*300PX)  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file" >
                                <input type="file" class="custom-file-container__custom-file__custom-file-input"  name="cuisine_image_path" accept="image/*" value="<?php echo set_value('cuisine_image_path')?>" >
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>

                            <div class="custom-file-container__image-preview">  <img src="<?php echo base_url('upload/cuisine/'.$ve->cuisine_image_path) ?>" width="100px"/> </div>
                        </div>
                        <?php echo form_error("cuisine_image_path");?> <br>
                    </div>
                </div>
                <?php } ?>
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