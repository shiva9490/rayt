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
                            <h5>My Profile</h5>
                        </div>
                        <div class="aside-text">
                            <form method="post" enctype="multipart/form-data" novalidate="" action="">
                                <div class=""><?php $this->load->view("admin/success_error");?></div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input name="register_name" value="<?php echo $view["register_name"];?>" class="form-control"/>
                                            <?php echo form_error("register_name");?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender <span class="text-danger">*</span></label>
                                            <div>
                                                <input name="register_gender" <?php echo ($view["register_gender"] == "Male")?"checked='checked'":"";?> type="radio" value="Male"/>Male
                                                <input name="register_gender" <?php echo ($view["register_gender"] == "Female")?"checked='checked'":"";?> type="radio" value="Female"/>Female
                                            </div>
                                            <?php echo form_error("register_mobile");?>
                                        </div>
                                    </div>
                                    <?php
                                    $dads   =   "";
                                    $reg_mobile_verified    =   $view["reg_mobile_verified"];
                                    if($reg_mobile_verified == "0") {
                                        $dads   =   "disabled='disabled'";
                                    }
                                    $eads   =   "";
                                    $reg_email_verified     =   $view["reg_email_verified"];
                                    if($reg_email_verified == "0") {
                                        $eads   =   "disabled='disabled'";
                                    }
                                    ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mobile No. <span class="text-danger">*</span></label>
                                            <input name="register_mobile" <?php echo $dads;?> value="<?php echo $view["register_mobile"];?>" class="form-control"/>
                                            <?php echo form_error("register_mobile");?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email Id <span class="text-danger">*</span></label>
                                            <input name="register_email" <?php echo $eads;?> value="<?php echo $view["register_email"];?>" class="form-control"/>
                                            <?php echo form_error("register_email");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-control" required=""  name="register_country">
                                                <option value="">Select Country</option>
                                                <?php
                                                    if(count($country) > 0){
                                                        foreach($country as $vee){
                                                            $sel    =   ($vee->countryid == $view["register_country"])?"selected='selected'":"";
                                                            ?>
                                                <option value="<?php echo $vee->countryid;?>" <?php echo $sel;?>><?php echo $vee->country_name;?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <?php echo form_error("register_country");?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Upload File</label>
                                            <?php
                                            $pic    =   $view["register_picture"];
                                            $imh    =   $this->common_config->getvalueImagesize($pic);
                                            ?>
                                            <input type="file" name="uploadfile" class="form-control"/>
                                            <br/>
                                            <img src="<?php echo $imh;?>" class="img img-responsive img-100"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn-info  btnbal" name="submit" value="submit"> Save</button>
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