       
<?php
$sr     =   $this->session->userdata("active-deactive-driver");
$cr     =   $this->session->userdata("create-driver");
$ur     =   $this->session->userdata("update-driver");
$dr     =   $this->session->userdata("delete-driver");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">   
    <div class="col-lg-12">
      <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">Driver update</div>
                   
                </div>
            </div>
         <div class="card-body">
            <!--  BEGIN CONTENT AREA  -->
            <div  class="main-content">
                <div class="layout-px-spacing">           
                    <div class="account-settings-container layout-top-spacing">
                        <div class="account-content">
                            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                                <div class="row">
                                        <div class="col-sm-8">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label> Image </label>
                                                    <img src="<?php echo base_url($view['driver_images_path']);?>" class="img-fluid" />                                              
                                                </div>
                                            </div><br><br>
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
                                                <button type="submit" value="Submit" name="submit" class="btn btn-dark">Save Changes</button>
                                                <a  class="btn btn-primary" href="<?php current_url() ?>">Return Back</a>
                                            </div>
                                        </div>
                                    </div> 
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  END CONTENT AREA  -->
        </div>
      </div>
   </div>
</div>
