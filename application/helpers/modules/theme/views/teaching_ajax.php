<div class="row">
    <?php 
    if(count($view) > 0){
        foreach ($view as $ve){
            $lo     =   array();
            $regid  =   $ve->register_id;
            $urlv   =   $ve->student_unique;
            $pic    =   $ve->register_picture;
            $usb    =   $ve->student_subjects;
            $tle    =   $ve->student_title;
            $imh    =   $this->common_config->getvalueImagesize($pic);
            $lcpic   =   ($usb != "")?array_filter(explode(",",$usb)):array();
            ?>
    <div class="col-md-6 mb-10 post">
        <div class="event-item">
            <div class="down-content">
                <div class="date">
                    <img src="<?php echo $imh;?>" class="img img-responsive"/>
                </div>
                <a href="<?php echo base_url("Teaching-Profile/".$urlv);?>">
                    <h4><?php echo $tle;?></h4></a>
                <ul class="subjectTags tags-v2  mb-10">
                <?php 
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
                    }
                ?>
                </ul>
                <p class="pclass">
                    <?php echo $ve->student_requirements;?>
                </p>
                <ul class="casles">
                    <li><i class="fa fa-globe"></i><?php echo ($ve->student_online == "1")?"Yes":"No";?></li>
                    <li><i class="fa fa-home"></i><?php echo ($ve->student_myplace == "1")?"Yes":"No";?></li>
                    <li><i class="fa fa-car"></i><?php echo ($ve->student_tutor == "1")?"Yes":"No";?></li>
                    <li><i class="fa fa-inr"></i><?php echo $ve->student_budget." ".$ve->student_budgettype;?></li>
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
        <h4 class="text-danger text-center"><i class="fa fa-info-circle"></i> No teaching jobs are available</h4>
    </div>
        <?php
    }
    ?>
</div>