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
                        <li>/</li>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url('Tutor-Profile');?>" title="Dashboard">Dashboard</a>
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
            <form method="post" action="" class="lognnformvalue" novalidate="" enctype="multipart/form-data">
                <div class="col-lg-12 offset-lg-1 col-md-12 col-sm-12 col-12">
                    <?php $this->load->view("admin/success_error");?>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Teaching Details</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="pad-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input name="register_name" value="<?php echo $view["register_name"];?>" class="form-control"/>
                                            <?php echo form_error("register_name");?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile No. <span class="text-danger">*</span></label>
                                            <input name="register_mobile" <?php echo $dads;?> value="<?php echo $view["register_mobile"];?>" class="form-control"/>
                                            <?php echo form_error("register_mobile");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email Id <span class="text-danger">*</span></label>
                                            <input name="register_email" <?php echo $eads;?> value="<?php echo $view["register_email"];?>" class="form-control"/>
                                            <?php echo form_error("register_email");?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-control" required="" name="register_country">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Upload File</label>
                                            <?php
                                            $pic    =   $view["register_picture"];
                                            $imh    =   $this->common_config->getvalueImagesize($pic);
                                            ?>
                                            <input type="file" name="register_picture" class="form-control"/>
                                            <br/>
                                            <img src="<?php echo $imh;?>" class="img img-responsive img-thumbnail img-100"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input class="form-control" name="register_dob" type="date" value="<?php echo date("d/m/Y",strtotime($view["register_dob"]));?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <input class="form-control" placeholder="Experience" name="register_experience" type="text" value="<?php echo $view["register_experience"];?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input class="form-control" placeholder="Designation" name="register_designation" type="text" value="<?php echo $view["register_designation"];?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn-success  btnbal" name="saveregister" value="saveregister"> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="pad-10">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Street <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control require"  name="tutor_street" required="" placeholder="Street*" value="<?php echo $view['tutor_street'];?>"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>City/State <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control require" value="<?php echo $view['tutor_state'];?>" name="tutor_state" required="" placeholder="last Name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group ">
                                            <label>Postal Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control require" name="tutor_pincode" required="" placeholder="Pincode*" value="<?php echo $view['tutor_pincode'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Location <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control require" name="tutor_address" required="" placeholder="Address*" value='<?php echo $view['tutor_address'];?>'/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Profile Description </label>
                                            <textarea class="form-control require" name="tutor_description" rows="5" id="messageTen" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="tb_es_btn_div">
                                            <div class="response"></div>
                                            <div class="tb_es_btn_wrapper conatct_btn2 cont_bnt">
                                                <button type="submit" name="saveaddress" value="Submit" class="btnbal btn-info">Save Address</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="pad-10">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Fee Charge <span class="text-danger">*</span></label>
                                            <select class='form-control' name="tutor_fee_charge">
                                                <option value="">Fee Charge</option>
                                                <?php 
                                                    if(count($tutor_fee_charge) > 0){
                                                        foreach ($tutor_fee_charge as $vet){
                                                            $ve     =   $vet["budgets"];
                                                            ?>
                                                <option value="<?php echo $ve;?>" <?php echo ($ve == $view['tutor_fee_charge'])?"selected='selected'":"";?>><?php echo $ve;?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <?php echo form_error("tutor_fee_charge");?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Minimum Fee <span class="text-danger">*</span></label>
                                            <input type="text" name="tutor_minimum_fee" class="form-control" placeholder="Minimum Fee" value="<?php echo $view['tutor_minimum_fee'];?>"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Maximum Fee <span class="text-danger">*</span></label>
                                            <input type="text" name="tutor_maximum_fee" class="form-control" placeholder="Maximum Fee" value="<?php echo $view['tutor_maximum_fee'];?>"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Years of Total Experience (Teaching & Other)</label>
                                            <input type="text" class="form-control" placeholder="Years of Total Experience (Teaching & Other)" name="tutor_years_experience" value="<?php echo $view['tutor_years_experience'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Years of Total Experience (Teaching & Other)</label>
                                            <input type="text" class="form-control" placeholder="Years of Total Experience (Teaching & Other)" name="tutor_years_experience" value="<?php echo $view['tutor_years_experience'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Years of Total Experience (Offline & Online)</label>
                                            <input type="text" class="form-control" placeholder="Years of Total Experience (Offline & Online)" name="tutor_online_experience" value="<?php echo $view['tutor_online_experience'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Years of Teaching Experience</label>
                                            <input type="text" class="form-control" placeholder="Years of Teaching Experience" name="tutor_teaching_experience"  value="<?php echo $view['tutor_teaching_experience'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Are you willing to travel to Student</label>
                                            <div>
                                                <input name="tutor_willing" <?php echo ($view["tutor_willing"] == "Yes")?"checked='checked'":"";?> type="radio" value="Yes"/>Yes
                                                <input name="tutor_willing" <?php echo ($view["tutor_willing"] == "No")?"checked='checked'":"";?> type="radio" value="No"/>No
                                            </div>
                                            <?php echo form_error("tutor_willing");?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Available for Online Teaching</label>
                                            <div>
                                                <input name="tutor_online_teaching" <?php echo ($view["tutor_online_teaching"] == "Yes")?"checked='checked'":"";?> type="radio" value="Yes"/>Yes
                                                <input name="tutor_online_teaching" <?php echo ($view["tutor_online_teaching"] == "No")?"checked='checked'":"";?> type="radio" value="No"/>No
                                            </div>
                                            <?php echo form_error("tutor_online_teaching");?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Are you currently a full time teacher employed by a school / College ?</label>
                                            <div>
                                                <input name="tutor_employed" <?php echo ($view["tutor_employed"] == "Yes")?"checked='checked'":"";?> type="radio" value="Yes"/>Yes
                                                <input name="tutor_employed" <?php echo ($view["tutor_employed"] == "No")?"checked='checked'":"";?> type="radio" value="No"/>No
                                            </div>
                                            <?php echo form_error("tutor_employed");?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Distance to Travel</label>
                                            <input type="text" class="form-control" placeholder="Distance to Travel" name="tutor_travel_distance" value="<?php echo $view['tutor_travel_distance'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Opportunities</label>
                                            <select class="form-control" name="tutor_opportunities">
                                                <option value="">Select Opportunities</option>
                                                <?php 
                                                if(count($tutor_opportunities) > 0){
                                                    foreach ($tutor_opportunities as $ver){
                                                        $ve     =   $ver->opportunity_id;
                                                        ?>
                                                <option value="<?php echo $ve;?>" <?php echo set_select($ve,"tutor_opportunities");?>><?php echo $ve->opportunity_name;?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Fee Details <span class="text-danger">*</span></label>
                                            <textarea class="form-control require" name="tutor_fee_details" rows="5" id="messageTen" placeholder="Fee Details"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="tb_es_btn_div">
                                            <div class="response"></div>
                                            <div class="tb_es_btn_wrapper conatct_btn2 cont_bnt">
                                                <button type="submit" name="saveteaching" value="Save" class="btnbal btn-info">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>