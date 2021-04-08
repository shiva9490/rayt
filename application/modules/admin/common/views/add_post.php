<div class="container-fluid">
    <div class="row pt-2 pb-2">
       <div class="col-sm-12">
          <h4 class="page-title">Add Post</h4>
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page">Add Post</li>
          </ol>
       </div>
    </div>
    <div class="row">
       <div class="col-lg-12">
            <?php $this->load->view('admin/success_error');?>
            <div class="card">
             <div class="card-body">
                <form class="validform" method="post" action="" autocomplete="off" novalidate="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student <span class="text-danger">*</span></label>
                                <select class="form-control selectset" name="register_unique" required="">
                                    <option value="">Select Student</option>
                                    <?php 
                                    $pms["whereCondition"]  =   "register_usertype = 'Student'";
                                    $vcu    =   $this->api_model->viewRegister($pms);
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve->register_unique;
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"register_unique");?>><?php echo $ve->register_name." - ".$ve->register_mobile;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error("register_unique");?>
                            </div>
                        </div>
                        <div class="sds" style="display:none;"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input id='city2' type="hidden" name="student_city"/>
                                <input id='cityLat' type="hidden" name="student_latitude"/>
                                <input id='cityLng' type="hidden" name="student_longitude"/>
                                <label>Location <span class="text-danger">*</textarea></span></label>
                                <!--<input type="text" id="pac-input" value="<?php echo set_value("student_location");?>" class="form-control" name="student_location" placeholder="Location" value=""/>-->
                                <input type="text" value="<?php echo set_value("student_location");?>" class="form-control" name="student_location" placeholder="Location" value=""/>
                                <?php //echo form_error("student_location");?>
                                <?php //echo form_error("student_city");?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Details of Requirements <span class="text-danger">*</span></label>
                                <textarea name="student_requirements" onkeyup="checktextarea()" placeholder="Details of Requirements" required="" class="form-control studentrequire"><?php echo set_value("student_requirements");?></textarea>
                                <?php echo form_error("student_requirements");?>
                                <span class="addaminu text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Subject <span class="text-danger">*</span></label>
                                <select class="form-control select3" name="student_subjects[]" multiple="" required="">
                                    <option value="">Select Select</option>
                                    <?php 
                                    $vcu    =   $this->api_model->subjects();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve->subject_id;
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_subjects[]");?>><?php echo $ve->subject_name;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error("student_subjects[]");?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Level <span class="text-danger">*</span></label>
                                <select class="form-control" name="student_from_level" required="">
                                    <option value="">Select From Level</option>
                                    <?php 
                                    $vcu    =   $this->api_model->levelsvalues();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            ?>
                                    <option value="<?php echo $ve->level_id;?>" <?php echo set_select($ve->level_id,"student_from_level");?>><?php echo $ve->level_name;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error("student_from_level");?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>I Want <span class="text-danger">*</span></label>
                                <select class="form-control" name="student_want" required="">
                                    <option value="">Select Tutor I Want</option>
                                    <?php 
                                    $vcu    =   $this->api_model->tutoring_i_want();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve["tutoring_i_want"];
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_want");?>><?php echo $cs;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error("student_want");?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div><input type="checkbox" class="studenine" name="student_online" value="1"/>&nbsp;Online</div>
                                <div><input type="checkbox" class="studenine" name="student_myplace" value="1"/>&nbsp;At My Place (Home/Institution)</div>
                                <div><input type="checkbox" class="studenine studentravel" onclick="travelthis()" name="student_tutor" value="1"/>&nbsp;Travel to Tutor</div>
                            </div>
                            <div class="text-danger studeninererr"></div>
                        </div>
                        <div class="col-md-4 studentrkm">
                            <div class="form-group">
                                <label>Travel in (kms)</label>
                                <input type="text" class="form-control input_num studentext" name="student_travelkms" placeholder="Travel in (kms)"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Budget type <span class="text-danger">*</span></label>
                                <select class="form-control " name="student_budgettype" required="">
                                    <option value="">Select Budget Type</option>
                                    <?php 
                                    $vcu    =   $this->api_model->budgets();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve["budgets"];
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_budgettype");?>><?php echo $cs;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('student_budgettype');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Budget Amount <span class="text-danger">*</span></label>
                                <input type="text" name="student_budget" class="form-control input_geo" placeholder="Budget Amount" required="" value="<?php echo set_value('student_budget');?>"/>
                                <?php echo form_error('student_budget');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender Preference <span class="text-danger">*</span></label>
                                <select class="form-control " name="student_preference" required="">
                                    <option value="">Select Gender Preference</option>
                                    <?php 
                                    $vcu    =   $this->api_model->gender_prefernce();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve["gender_prefernce"];
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_preference");?>><?php echo $cs;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('student_preference');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tutors Wanted <span class="text-danger">*</span></label>
                                <select class="form-control " name="student_wanted" required="">
                                    <option value="">Select Tutors Wanted</option>
                                    <?php 
                                    $vcu    =   $this->api_model->tutors_wanted();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve["tutors_wanted"];
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_wanted");?>><?php echo $cs;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('student_wanted');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>In Need Someone<span class="text-danger">*</span></label>
                                <select class="form-control " name="student_need_time" required="">
                                    <option value="">Select I Need Someone</option>
                                    <?php 
                                    $vcu    =   $this->api_model->time_preference();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve["time_preference"];
                                            ?>
                                    <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_need_time");?>><?php echo $cs;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('student_need_time');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Post Type <span class="text-danger">*</span></label>
                                <div>
                                    <?php 
                                    $vcu    =   $this->api_model->paytype();
                                    if(count($vcu) > 0){
                                        foreach ($vcu as $ve){
                                            $cs =   $ve->paytype_value;
                                            ?>
                                    <input type="radio" value="<?php echo $cs;?>" required="" name="student_paytype_time" <?php echo set_radio($cs,"student_paytype_time");?>/>&nbsp;<?php echo $cs;?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" value="Submit" name="submit" class="btn btn-xs btn-success">Save</button>
                    </div>
                </form>
             </div>
          </div>
       </div>
    </div>
    <div class="overlay toggle-menu"></div>
 </div>