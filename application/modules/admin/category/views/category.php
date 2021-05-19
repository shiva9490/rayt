<?php
$cr     =   $this->session->userdata("create-variant");
$ur     =   $this->session->userdata("update-variant");
$dr     =   $this->session->userdata("delete-variant");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Category</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post"  enctype="multipart/form-data">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Category Name <span class="required text-danger">*</span></label>
                            <input name="category_name" type="text" class="form-control text-capitalize" placeholder="Category Name" value="<?php echo set_value('category_name');?>" required=""/>
                            <?php echo form_error("category_name");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Category Name Arabic<span class="required text-danger">*</span></label>
                            <input name="category_name_a" type="text" class="form-control text-capitalize" placeholder="اسم التصنيف" value="<?php echo set_value('category_name_a');?>" required=""/>
                            <?php echo form_error("category_name_a");?> <br>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Category Image <span class="required text-danger">*</span> </label>
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
          <div class="card-header">View Category</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>