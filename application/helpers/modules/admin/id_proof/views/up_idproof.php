<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">ID Proof</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item"><a href="<?php echo adminurl("ID-Proof");?>">ID Proof</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update ID Proof</li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Update ID Proof</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>ID Proof Name <span class="required text-danger">*</span></label>
                            <input name="proof_name" type="text" class="form-control proof_name text-capitalize" placeholder="ID Proof Name" value="<?php echo (count($view) > 0)?$view["idproof_name"]:set_value('proof_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("proof_name");?> 
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