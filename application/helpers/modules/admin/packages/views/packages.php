<?php
$cr     =   $this->session->userdata("create-package");
$ur     =   $this->session->userdata("update-package");
$dr     =   $this->session->userdata("delete-package");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Package</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Package</li>
      </ol>
   </div>
</div>
<div class="row">
    <?php if($cr == "1") { ?>
   <div class="col-lg-12">
      <div class="card">
          <div class="card-header">Create Package</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Package Type <span class="required text-danger">*</span></label>
                            <div>
                            <?php 
                            foreach($vsp as $fe){
                                ?>
                            <input name="package_type" type="radio"  value="<?php echo $fe;?>" required=""/> <?php echo $fe;?>
                                <?php
                            }
                            ?>
                            </div>
                            <?php echo form_error("package_type");?> 
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Package Name <span class="required text-danger">*</span></label>
                            <input name="package_name" type="text" class="form-control package_name text-capitalize" placeholder="Package Name" value="<?php echo set_value('package_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("package_name");?> 
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Price <span class="required text-danger">*</span></label>
                            <input name="package_price" type="text" class="form-control input_geo text-capitalize" placeholder="Price" value="<?php echo set_value('package_price');?>" required="" minlength="1" maxlength="50"/>
                            <?php echo form_error("package_price");?> 
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Coins <span class="required text-danger">*</span></label>
                            <input name="package_coins" type="text" class="form-control input_geo text-capitalize" placeholder="Coins" value="<?php echo set_value('package_coins');?>" required=""/>
                            <?php echo form_error("package_coins");?> 
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">View Package</div>
            <div class="card-body">
                <?php $this->load->view('admin/search');?>
            </div>
        </div>
    </div>
</div>