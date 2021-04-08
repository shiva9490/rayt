<?php
$cr     =   $this->session->userdata("create-opportunity");
$ur     =   $this->session->userdata("update-opportunity");
$dr     =   $this->session->userdata("delete-opportunity");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Opportunity</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Opportunities");?>">Opportunities</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update Opportunity</li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Update Opportunity</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Opportunity <span class="required text-danger">*</span></label>
                            <input name="opportunityname" type="text" class="form-control opportunityname text-capitalize" placeholder="Opportunity" value="<?php echo (count($view) > 0)?$view["opportunity_name"]:set_value('opportunityname');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("opportunityname");?> 
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
</div>