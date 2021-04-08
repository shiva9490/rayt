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
                        <div class="col-md-4">
                            <img src="<?php echo $imh;?>" class="img img-responsive" height="100px" width="100px"/>
                            <div class="contactform">
                                <ul>
                                    <li><i class="fa fa-car"></i><span><b>Travel :</b> <?php echo ($view["student_myplace"] == "1")?"Yes":"No";?></span></li>
                                    <li><i class="fa fa-wifi"></i><span><b>Online :</b> <?php echo ($view["student_online"] == "1")?"Yes":"No";?></span></li>
                                    <li><i class="fa fa-home"></i> <span><b>Home :</b> <?php echo ($view["student_tutor"] == "1")?"Yes":"No";?></span></li>
                                </ul>
                            </div>
                            <input type="hidden" name="studentid" class="studentid" value="<?php echo $view["student_id"];?>"/>
                            <ul class="valueul">
                                <li>
                                    <a href="javascript:void(0);" class="btn-xs btn-danger" onclick="checkotpvalue('Message')"><i class="fa fa-envelope"></i> Message</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="btn-xs btn-25D366" onclick="checkotpvalue('Whatsapp')"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="btn-xs btn-info" onclick="checkotpvalue('Contact')"><i class="fa fa-phone"></i> Phone</a>
                                </li>
                            </ul>
                            <div class="modalview"></div>
                        </div>
                        <div class="col-md-7">
                            <div class="right-info">
                                <div class="name">
                                    <h2><?php echo $view["register_name"];?></h2>
                                    <span><?php echo $view['student_location'];?></span>
                                    <span><?php echo $view['student_budget']." ".$view["student_budgettype"];?></span>
                                </div>
                                <div class="description">
                                    <p><?php echo $view['student_requirements'];?></p>
                                    <h4 class=""><i class="fa fa-book"></i> Subjects</h4>
                                    <ul class="subjectTagsvalue tagsv2  mb-10">
                                        <?php 
                                        $usb     =   $view["student_subjects"];
                                        $lcpic   =   ($usb != "")?array_filter(explode(",",$usb)):array();
                                        if(count($lcpic) > 0){
                                            foreach($lcpic as $ev){
                                                $params["columns"]          =   "subject_name,subject_alias_name";
                                                $params["whereCondition"]   =   "subject_id = '".$ev."'";
                                                $vdp        =   $this->subject_model->getSubject($params);
                                                $mks        =   (is_array($vdp) && count($vdp) > 0)?$vdp["subject_name"]:"";
                                                $vspl   =   base_url().$mks."-Tutor-Jobs";
                                                ?>
                                        <li><a href="<?php echo $vspl;?>"><?php echo $mks;?></a></li>
                                                <?php
                                                }
                                            }else{
                                                ?>
                                            <li>No subjects has been mentioned yet</li>
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
                            No profile has been there to show.
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