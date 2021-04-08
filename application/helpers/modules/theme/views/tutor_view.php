<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" target="_blank" title="Return to home">Home</a>
                            </div>
                        </li>
                        <li>/ <?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="events-grid">
    <div class="container mb-10">
        <div class="row">
            <div class="col-md-9">
                <div class="singleteacherdata">
                <?php 
                if(count($view) > 0){
                    $regid  =   $view["register_id"];
                    $urlv   =   $view["register_unique"];
                    $pic    =   $view["register_picture"];
                    $imh    =   $this->common_config->getvalueImagesize($pic);
                    ?>
                    <div class="row">
                        <div class="col-md-5">
                            <img src="<?php echo $imh;?>" class="img img-responsive" height="300px" width="300px"/>
                            <div class="contactform">
                                <ul>
                                    <li><i class="fa fa-car"></i><span><b>Travel:</b> <?php echo ($view["tutor_willing"] != "")?$view["tutor_willing"]:"No";?></span></li>
                                    <li><i class="fa fa-globe"></i> <span><b>Teaching Experience:</b> <?php echo ($view["tutor_teaching_experience"] != "")?$view["tutor_teaching_experience"]:"No";?></span></li>
                                    <li><i class="fa fa-wifi"></i> <span><b>Online Teaching Experience:</b> <?php echo ($view["tutor_online_experience"] != "")?$view["tutor_online_experience"]:"No";?></span></li>
                                </ul>
                            </div>
                            <input type="hidden" name="studentid" class="studentid" value="<?php echo $view["tutor_id"];?>"/>
                            <ul class="valueul">
                                <li>
                                    <a href="javascript:void(0);" class="btn-xs btn-danger" onclick="checkstotpvalue('Message')"><i class="fa fa-envelope"></i> Message</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="btn-xs btn-25D366" onclick="checkstotpvalue('Whatsapp')"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="btn-xs btn-info" onclick="checkstotpvalue('Contact')"><i class="fa fa-phone"></i> Phone</a>
                                </li>
                            </ul>
                            <div class="modalview"></div>
                            <div class="contact-form">
                                <h4>Review </h4>
                                <input type="text" id="address" name="s" placeholder="Add a headline" value="">
                                <textarea id="message" class="message" name="message" placeholder="Write your review"></textarea>
                                <button class="buttoncs" type="submit" value="rate" name="ratereview">Review</button>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="right-info">
                                <div class="name">
                                    <h2><?php echo $view["register_name"];?></h2>
                                    <span><?php echo $view['tutor_state'].", ".$view["tutor_pincode"];?></span>
                                    <span><?php echo $view['tutor_minimum_fee']."".$view["tutor_fee_charge"];?></span>
                                </div>
                                <div class="description">
                                    <p><?php echo $view['tutor_description'];?></p>
                                    <h4 class=""><i class="fa fa-book"></i> Subjects</h4>
                                    <ul class="subjectTagsvalue tagsv2  mb-10">
                                        <?php 
                                            $osm["columns"]         =   "subject_alias_name,subject_name,fdr.level_name as tolevel,fr.level_name as fromlevel";
                                            $osm["whereCondition"]  =   "register_id = '".$regid."'";
                                            $sub    =   $this->tutor_model->viewtutorSubjects($osm);
                                            if(count($sub) > 0){
                                                foreach ($sub as $ver){
                                                    $vspl   =   base_url().$ver->subject_alias_name."-Tutors";
                                                    ?>
                                            <li>
                                                <a href="<?php echo $vspl;?>"><?php echo $ver->subject_name;?></a>
                                                <span>(<?php echo $ver->fromlevel." - ".$ver->tolevel;?>)</span>
                                            </li>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                            <li>No subjects has been mentioned yet</li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                    <h4><i class="fa fa-graduation-cap"></i> Education</h4>
                                    <ul class="subjectTagsvalue tagsv2  mb-10">
                                        <?php 
                                            $osm["columns"]         =   "degree_name,experince_degree_name,experince_end_year,experince_start_year";
                                            $osm["whereCondition"]  =   "register_id = '".$regid."'";
                                            $esub    = $this->tutor_model->viewtutorEducation($osm);
                                            if(count($esub) > 0){
                                                foreach ($esub as $ver){
//                                                    $vspl   =   base_url().$ver->degree_name."-Tutors";
                                                    ?>
                                            <li>
                                                <?php echo $ver->degree_name;?>
                                                <span>(<?php echo date("F, Y",strtotime($ver->experince_start_year))." - ".date("F, Y",strtotime($ver->experince_end_year));?>)</span>
                                            </li>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                            <li>No education details has been mentioned yet</li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                    <h4><i class="fa fa-globe"></i> Experience</h4>
                                    <ul class="subjectTags tags-v2  mb-10">
                                        <?php 
                                            $osm["columns"]         =   "teaching_organization,teaching_start_year,teaching_end_year,teaching_description";
                                            $osm["whereCondition"]  =   "register_id = '".$regid."'";
                                            $esub    = $this->tutor_model->viewtutorTeachexperience($osm);
                                            if(count($esub) > 0){
                                                foreach ($esub as $ver){
                                                    $vspl   =   base_url().$ver->experince_degree_name."-Tutors";
                                                    ?>
                                            <li>
                                                <a href="<?php echo $vspl;?>"><?php echo $ver->experince_degree_name;?></a>
                                                <span>(<?php echo date("F, Y",strtotime($ver->experince_start_month))." - ".date("F,Y",strtotime($ver->experince_end_month));?>)</span>
                                                <p><?php echo $ver->teaching_description;?>
                                            </li>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                            <li>No experience details has been mentioned yet</li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else{
                ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            No tutor profile has been there to show.
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>  
            </div>
            <div class="col-md-3">
                <?php //include_widget("");?>
            </div>
        </div>
    </div>
</section>