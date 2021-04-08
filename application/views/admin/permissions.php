<div class="container pd-x-0 tx-13">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
            <li class="breadcrumb-item"><a href="<?php echo base_url('/');?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
        </ol>
    </nav>
    <h4 class="mg-b-25">Permissions</h4>
    <form method="post" action="" novalidate="" data-parsley-validate=""> 
        <div class="row"> 
            <div class='col-lg-12 col-md-12'>
                <?php $this->load->view("success_error");?>
            </div> 
            <div class="col-md-6">
                <div class="form-group ">
                    <label>Role <span class="text-danger">*</span></label>   
                    <select class="form-control  user_roles" name="user_roles[]" required="" multiple="" onchange="user_role(this,'user_role')">
                        <option value="">Select User Role</option>
                        <?php 
                        if(count($user) > 0) {
                            foreach($user as $us){
                            ?>
                            <option value="<?php echo $us->ut_id;?>"><?php echo $us->ut_name;?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error("user_roles[]");?> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Modules </label>  
                    <select  class="form-control user_modules" name="user_modules[]" multiple="" onchange="user_role(this,'user_module')"> 
                        <option value="">Select Module </option>
                        <?php 
                        if(count($modules) > 0) {
                            foreach($modules as $uds){
                            ?>
                            <option value="<?php echo $uds->page_module;?>"><?php echo $uds->page_module;?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>  
                </div>
            </div> 
        </div>
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php $this->load->view("loader");?>
                <div class='ajaxListPer'>
                    <?php 
                    $data 	=	array( 
	                    "role_val"  => ''
	                );
                    $this->load->view("ajaxPermission",$data);?>
                </div>
            </div>   
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                <div class="form-actions">
                    <div class="form-actions mg-t-10">
                        <button type="submit" class="btn btn-md btn-primary" name="submit" value="submit">
                            <i class="fa fa-check-circle"></i> &nbsp;&nbsp;Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>  
</div>