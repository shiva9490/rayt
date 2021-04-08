<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" title="Return to home">Home</a>
                            </div>
                        </li>
                        <li>/ <?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="single-aside pb-20">
                    <div class="aside-inner-wrapper">
                        <div class="aside-title aside-underline posr">
                            <h5>Post Requirement</h5>
                        </div>
                        <div class="aside-text">
                            <form method="post" class="lognnforue" id="myForm" enctype="multipart/form-data" novalidate="" action="">
                                <div class=""><?php $this->load->view("admin/success_error");?></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Details of Requirements <span class="text-danger">*</span></label>
                                            <textarea name="student_requirements" placeholder="Details of Requirements" required="" class="form-control"><?php echo set_value("student_requirements");?></textarea>
                                            <?php echo form_error("student_requirements");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="showusbject"></div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" onclick="validateefomr()" class="btn-info buttonvs btnbal" name="submit" on value="submit"> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>