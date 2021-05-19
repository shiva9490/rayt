<form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                <div class="row">
                <div class="col-sm-12">
                        <div class="form-group">
                            <label> Image </label>
                            <img src="<?php echo base_url($images['driver_images_path']);?>" />
                            <?php echo form_error("image");?> <br>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="custom-file-container" data-upload-id="myFirstImage">
                            <label> Image <span class="required text-danger">*</span> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file" >
                                <input type="file" class="custom-file-container__custom-file__custom-file-input"  name="files[]" accept="image/*" required>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                <div class="invalid-feedback">
                                    Please provide a valid Driver Main Image.
                                </div>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>                     
                    </div>
                   
                </div>                                                                 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="ml-4">
                            <button type="submit" value="Submit" name="submit" class="btn btn-dark">Update</button>
                            <a  class="btn btn-primary" href="">Cancel</a>
                        </div>
                    </div>
                </div> 
            </form>  