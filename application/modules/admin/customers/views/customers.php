<?php
$cr     =   $this->session->userdata("create-customers");
$ur     =   $this->session->userdata("update-customers");
$dr     =   $this->session->userdata("delete-customers");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="row layout-top-spacing">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-header"><?php echo $title;?></div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>