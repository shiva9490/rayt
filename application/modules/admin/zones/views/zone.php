
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
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        View Zones
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo adminurl('Add-Zones');?>" style="float: right;" class="btn btn-xs btn-raised btn-primary waves-effect">Create Zone</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <?php $this->load->view("admin/search");?>
            </div>
      </div>
   </div>
</div>
