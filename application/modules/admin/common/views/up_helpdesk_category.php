<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vtil;?>
         <li class="breadcrumb-item active" aria-current="page">Update Helpdesk Category</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="row">
                <div class="col-sm-12">                      
                    <div class="card-header">Update Helpdesk Category</div>
                         <div class="card-body">
                            <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                                <div class="row">                                
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Enquire About<span class="required text-danger">*</span></label>
                                            <input name="helpdesk_ques_cat" type="text" class="form-control text-capitalize" placeholder="Category Name" value="<?php echo $view['helpdesk_ques_cat'];?>" required="" minlength="3" maxlength="50"/>
                                            <?php echo form_error("helpdesk_ques_cat");?> <br>
                                        </div>
                                    </div>                                 
                                                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>   
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>