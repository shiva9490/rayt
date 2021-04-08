<div class="row">
    <?php 
    if(count($view) > 0){
        foreach ($view as $ve){
            $regid  =   $ve->register_id;
            $urlv   =   $ve->register_unique;
            $pic    =   $ve->register_picture;
            $imh    =   $this->common_config->getvalueImagesize($pic);
            ?>
    <div class="col-md-4 mb-10 post">
        <div class="event-item">
            <div class="down-content">
                <div class="date">
                    <img src="<?php echo $imh;?>" class="img img-responsive"/>
                </div>
                <a href="<?php echo base_url("Tutor-Profile/".$urlv);?>"><h4><?php echo $ve->register_name;?> <br/> <?php echo $ve->tutor_speciality;?></h4></a>
                <ul class="subjectTags tags-v2  mb-10">
                <?php 
                    $osm["columns"]         =   "subject_alias_name,subject_name";
                    $osm["whereCondition"]  =   "register_id = '".$regid."'";
                    $sub    =   $this->tutor_model->viewTutorsubjects($osm);
                    if(count($sub) > 0){
                        foreach ($sub as $ver){
                            $vspl   =   base_url().$ver->subject_alias_name."-Tutors";
                            ?>
                    <li><a href="<?php echo $vspl;?>"><?php echo $ver->subject_name;?></a></li>
                            <?php
                        }
                    }else{
                        ?>
                    <li><a href="<?php echo base_url('All-Subjects-Tutors');?>">All Subjects</a></li>
                        <?php
                    }
                ?>
                </ul>
                <p class="pclass"><?php echo $ve->tutor_description;?></p>
                <ul class="casles">
                    <li><div><i class="fa fa-map-marker"></i><?php echo ($ve->tutor_pincode != "")?$ve->tutor_pincode:"-";?></span></div>
                    <li><i class="fa fa-inr"></i><?php echo ($ve->tutor_fee_charge != "")?$ve->tutor_fee_charge:"-";?></li>
                    <li><i class="fa fa-inr"></i><?php echo ($ve->tutor_fee_charge != "")?$ve->tutor_fee_charge:"-";?></li>
                    <li><i class="fa fa-inr"></i><?php echo ($ve->tutor_fee_charge != "")?$ve->tutor_fee_charge:"-";?></li>
                </ul>
            </div>
        </div>
    </div>
            <?php
        }
        ?>
    <div class="col-md-12">
        <?php $this->ajax_pagination->create_links();?>
    </div>
        <?php
    }else{
        ?>
    <div class="col-md-12 mb-23">
        <h4 class="text-danger text-center"><i class="fa fa-info-circle"></i> No tutor jobs are available</h4>
    </div>
        <?php
    }
    ?>
</div>