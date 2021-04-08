<?php
$dr     =   $this->session->userdata("delete-tutor");
$ar     =   $this->session->userdata("approve-tutor");
$sr     =   $this->session->userdata("active-deactive-tutor");
?>
<div class="row">
    <?php 
    if(count($view) > 0){
        foreach ($view as $ve){
            $reg_email_verified     =   $ve->reg_email_verified;
            $reg_mobile_verified    =   $ve->reg_mobile_verified;
            $mobicon    =   "success";
            $icmo       =   "check";
            if($reg_mobile_verified == "0"){
                $icmo       =   "close";
                $mobicon    =   "danger";
            }
            $emico    =   "check-circle text-success";
            if($reg_email_verified == "0"){
                $emico    =   "close-circle-o text-danger";
            }
            $vada   =   $ve->register_admin;
            if($vada == "1"){
                $vicon   =   "times";
                $vvadv   =   "Deactive";
                $vtextico    =   "text-warning";
                $vvdata  =   "<label class='badge abelsctive badge-success'>".$vada."</label>";
            }else{
                $vvdata  =   "<label class='badge abelsctive badge-danger'>".$vada."</label>";
                $vvadv   =   "Approved";
                $vtextico    =   "text-primary";
                $vicon   =   "check-circle-o";
            }
            $vad    =   ucwords($ve->register_acde);
            if($vad == "Active"){
                $icon   =   "times-circle";
                $vadv   =   "Deactive";
                $textico    =   "text-warning";
                $vdata  =   "<label class='badge abelsctive badge-success'>".$vad."</label>";
            }else{
                $vdata  =   "<label class='badge abelsctive badge-danger'>".$vad."</label>";
                $vadv   =   "Active";
                $textico    =   "text-primary";
                $icon   =   "check-circle";
            }
            ?>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <h5 class="card-title"><?php echo $ve->register_name;?></h5>
                        <p class="card-text"><?php echo $ve->register_mobile;?></p>
                        <?php echo $vdata;?> / <?php echo $vvdata;?>
                    </div>
                    <div class="col-lg-5">
                        <img src=""  class="img img-responsive"/>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush list shadow-none">
                <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo ($ve->register_email != "")?$ve->register_email:"";?> <i class="zmdi zmdi-<?php echo $emico;?>"></i></li>
                <li class="list-group-item d-flex justify-content-between align-items-center">Mobile <span class="badge badge-<?php echo $mobicon;?> badge-pill"><i class="zmdi zmdi-<?php echo $icmo;?>"></i></span></li>
            </ul>
            <div class="card-body">
                <?php if($ar == '1'){?>
                <a class="<?php echo $vtextico;?>" href="javascript:void(0);" onclick="activeform($(this),'Approve-Tutor')" fields="<?php echo $ve->register_id;?>" data-toggle='tooltip' title="<?php echo $vvadv;?>"><i class="fa fa-<?php echo $vicon;?> m-r-5"></i></a>
                <?php } if($sr == '1'){?>
                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Tutor-Active')" fields="<?php echo $ve->register_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                <?php } if($dr == '1'){?>
                <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Tutor')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Tutor/".$ve->register_id);?>"   data-original-title="Delete Tutor" class="text-danger"><i class="fa fa-trash"></i></a>
                <?php }  ?>
            </div>
       </div>
    </div>
            <?php
        }
        ?>
    <div class="col-md-12">
        <?php echo $this->ajax_pagination->create_links();?>
    </div>
        <?php
    }else{
        ?>
    <div class="col-lg-12">
        <h4 class="text-center text-danger"><i class="zmdi zmdi-info-outline"></i>&nbsp;&nbsp;No Tutors list are available.</h4>
    </div>
        <?php
    }
    ?>
</div>