<?php
$cr     =   $this->session->userdata("create-content-page");
$ur     =   $this->session->userdata("update-content-page");
$dr     =   $this->session->userdata("delete-content-page");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="single-pro-review-area mt-3">
    <div class="container-fluid">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">View content pages</div>
                <div class="col-md-6">
                    <a href="<?php echo adminurl('Add-Content');?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">Create Page</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">                   
                    <div class="card-body">
                        <?php $this->load->view('admin/success_error');?>
                        <?php $this->load->view("admin/search");?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>