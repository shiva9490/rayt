<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Permissions</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Permissions</li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
             <?php $this->load->view('admin/success_error');?>
             <form class="validform" method="post" action="" novalidate="">
                 <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role <span class="text-danger">*</span></label>   
                            <select class="form-control select2 user_roles" name="user_roles[]" required="" multiple="" onchange="user_role()">
                                <option value="">Select Role</option>
                                <?php 
                                if(count($user) > 0) {
                                    foreach($user as $us){
                                    ?>
                                    <option data-tokens="<?php echo $us->ut_name;?>" value="<?php echo $us->ut_id;?>"><?php echo $us->ut_name;?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error("user_roles[]");?> 
                        </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                            <label>Modules </label>  
                            <select class="form-control select2 user_modules" name="user_modules[]" multiple="" onchange="user_role()">
                                <option value="">Modules</option>
                                <?php 
                                if(count($modules) > 0) {
                                    foreach($modules as $uds){
                                    ?>
                                    <option data-tokens="<?php echo $uds->page_module;?>" value="<?php echo $uds->page_module;?>"><?php echo $uds->page_module;?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                         </div>
                     </div>
                </div>
                <div class="row form-group">
                    <input type="hidden" id="permiurlvalue" name="permiurlvalue" value="<?php echo adminurl('AjaxPermission/');?>"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php $this->load->view("admin/loader");?> 
                        <div class='ajaxListPer'></div>
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