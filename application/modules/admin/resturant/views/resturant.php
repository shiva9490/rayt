<?php
$cr     =   $this->session->userdata("manage-resturant");
$ur     =   $this->session->userdata("update-resturant");
$dr     =   $this->session->userdata("delete-resturant");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   
    <?php } ?>
    <div class="col-lg-12">
      <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">View Restaurant</div>
                    <div class="col-md-6">
                        <a href="<?php echo adminurl('Create-Resturant')?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">Create Restaurant</a>
                    </div>
                </div>
            </div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>