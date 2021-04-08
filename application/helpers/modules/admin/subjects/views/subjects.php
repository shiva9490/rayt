<?php
$cr     =   $this->session->userdata("create-subject");
$ur     =   $this->session->userdata("update-subject");
$dr     =   $this->session->userdata("delete-subject");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Subjects</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Subjects</li>
      </ol>
   </div>
</div>
<div class="row">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Subject</div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Subject Name <span class="required text-danger">*</span></label>
                            <input name="subject_name" type="text" class="form-control subject_name text-capitalize" placeholder="Subject Name" value="<?php echo set_value('subject_name');?>" required="" minlength="3" maxlength="50"/>
                            <?php echo form_error("subject_name");?> 
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
    <div class="col-lg-8">
      <div class="card">
          <div class="card-header">View Subjects</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>