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
          <div class="card-header">View Resturant</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>