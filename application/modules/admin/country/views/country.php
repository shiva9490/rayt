<?php
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="row layout-top-spacing">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-header">View Roles</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>