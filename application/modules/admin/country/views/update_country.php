<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title">Roles</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Country");?>">Country</a></li>
         <li class="breadcrumb-item active" aria-current="page">Update Country</li>
      </ol>
   </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Update Role</div>
            <div class="card-body">
                <form action="" method="post" class="validform formssample forms-sample" novalidate="">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
                            <div class="form-group">
                                <div class="form-line">
                                    <label>COUNTRY NAME<span class="required text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control rolename" placeholder="COUNTRY NAME" value="<?php echo $view['country_name'];?>" required/>
                                    <input name="id" type="hidden"  value="<?php ?>" />
                                </div>
                                <?php echo form_error('name');?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
                            <div class="form-group">
                                <div class="form-line">
                                    <label>FLAG  (svg only)<span class="required text-danger">*</span></label>
                                    <input name="flag" type="file" class="form-control" value="<?php ?>" required/>
                                </div>
                                <?php echo form_error('flag');?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
                            <div class="form-group">
                                <div class="form-line">
                                    <label>SYMBOL <span class="required text-danger">*</span></label>
                                    <input name="symbol" type="text" class="form-control" placeholder="Symbol" value="<?php echo $view['country_symbol']; ?>" required/>
                                </div>
                                <?php echo form_error('symbol');?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
                            <div class="form-group">
                                <div class="form-line">
                                    <label>CURRENCY <span class="required text-danger">*</span></label>
                                    <input name="currency" type="text" class="form-control" placeholder="Currency" value="<?php echo $view['country_currencie']; ?>" required/>
                                </div>
                                <?php echo form_error('currency');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
                            <div class="form-actions form-group">
                                <button type="submit" class="btn  btn-raised btn-success waves-effect" name="update" value="update"> Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>