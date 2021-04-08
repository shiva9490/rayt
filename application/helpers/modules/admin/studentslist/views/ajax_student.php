<?php
$dr     =   $this->session->userdata("delete-student");
$sr     =   $this->session->userdata("active-deactive-student");
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
                <h5 class="card-title"><?php echo $ve->register_name;?></h5>
                <p class="card-text"><?php echo $ve->register_mobile;?></p>
                <?php echo $vdata;?>
            </div>
            <ul class="list-group list-group-flush list shadow-none">
                <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo ($ve->register_email != "")?$ve->register_email:"";?> <i class="zmdi zmdi-<?php echo $emico;?>"></i></li>
                <li class="list-group-item d-flex justify-content-between align-items-center">Mobile <span class="badge badge-<?php echo $mobicon;?> badge-pill"><i class="zmdi zmdi-<?php echo $icmo;?>"></i></span></li>
            </ul>
            <div class="card-body">
                <?php if($sr == '1'){?>
                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Student-Active')" fields="<?php echo $ve->register_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                <?php } if($dr == '1'){?>
                <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Student')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Student/".$ve->register_id);?>"   data-original-title="Delete Student" class="text-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="text-center text-danger"><i class="zmdi zmdi-info-outline"></i>&nbsp;&nbsp;No Students list are available.</h4>
    </div>
        <?php
    }
    ?>
</div>