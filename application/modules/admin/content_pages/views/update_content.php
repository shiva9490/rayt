<div class="single-pro-review-area mt3">
    <div class="container-fluid">
        <?php $this->load->view("admin/success_error");?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">                  
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" >
                            <div class="col-md-12 mt-3">  
                                <div class="form-group">
                                    <label>Page Title<span class="required text-danger">*</span></label>
                                    <input name="page_title" type="text" class="form-control" value="<?php echo $view['cpage_title'];?>" required="" autocomplete="off" />
                                    <?php echo form_error('page_title');?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">                              
                                <div class="form-group ">
                                    <label for="password">Page Description</label>
                                    <textarea id="page-description" name="page_description" class="form-control" rows="3"><?php echo $view['cpage_content'];?></textarea>
                                    <?php echo form_error('page_description', '<span class="error text-danger">', '</span>'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">  
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
