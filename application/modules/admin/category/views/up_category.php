<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Category</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="row">
                <div class="col-sm-12">                      
                    <div class="card-header">Update Category</div>
                         <div class="card-body">
                            <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                                <div class="row">                                
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Category Name<span class="required text-danger">*</span></label>
                                            <input name="category_name" type="text" class="form-control text-capitalize" placeholder="Category Name" value="<?php echo $view['category_name'];?>" required="" minlength="3" maxlength="50"/>
                                            <?php echo form_error("category_name");?> <br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Category Arabic Name <span class="required text-danger">*</span></label>
                                            <input name="category_name_a" type="text" class="form-control text-capitalize" placeholder="Category Arabic name" value="<?php echo $view['category_name_a'];?>" required />
                                            <?php echo form_error("category_name_a");?> <br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">                                           
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Category Image (optional) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"  name="image" accept="image/*" required>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid Resturant Main Image.
                                                    </div>
                                                </label>                                                                       
                                                <div class="custom-file-container__image-preview"> <img src="<?php echo base_url().'upload/category/'.$view['category_image']?>" class="img-fluid" />  </div>
                                            </div>
                                        </div>
                                    </div>
                                                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success mt-3">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>   
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>