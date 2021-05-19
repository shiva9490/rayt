<?php
$cr     =   $this->session->userdata("create-helpdesk-category");
$ur     =   $this->session->userdata("update-helpdesk-category");
$dr     =   $this->session->userdata("delete-helpdesk-category");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   <div class="col-lg-4">
      <div class="card">
          <div class="card-header">Create Enquire about  </div>
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post"  enctype="multipart/form-data">
                 <div class="row">
                    <div class="col-sm-12">
                        <label ><strong>I would Like to Enquire about </strong></label>
                        <select class="form-control" name="resturant_enquire_type" id="groups" required >
                            <option value="">Select Enquire about</option>
                            <?php 
                                $pars['whereCondition'] = "helpdesk_abc LIKE 'Active'";
                                $help   =   $this->helpdesk_model->viewHelpCategory($pars);
                                $i=0;foreach($help as $h){
                            ?>
                            <option value="<?php echo $h->helpquecat_id; ?>"><?php echo $h->helpdesk_ques_cat; ?></option>										
                          <?php } ?>                    
                        </select>
                    </div>   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Enquire about<span class="required text-danger">*</span></label>
                            <input name="helpdesk_ques_subcat" type="text" class="form-control text-capitalize" placeholder="Enquire about" value="<?php echo set_value('helpdesk_ques_subcat');?>" required=""/>
                            <?php echo form_error("helpdesk_ques_subcat");?> <br>
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
          <div class="card-header">View Enquire About</div>
         <div class="card-body">
            <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>