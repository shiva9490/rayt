
<div class="row layout-top-spacing">   
    <div class="col-lg-12">
      <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">View Users</div>
                    <div class="col-md-6">
                        <a href="<?php echo adminurl('Create-Users')?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">Create Users</a>
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