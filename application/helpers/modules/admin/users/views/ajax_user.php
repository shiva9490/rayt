<?php
$cr     =   $this->session->userdata("create-user");
$ur     =   $this->session->userdata("update-user");
$dr     =   $this->session->userdata("delete-user");
$sr     =   $this->session->userdata("active-deactive-user");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == '1'){
        $ct     =   1;
}
?>
<div class="table-responsive"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="login_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Username <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="login_email" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Email Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="ut_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Role <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="login_password" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Password <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="login_acde" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <?php if($ct == '1'){?>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $fqid   =   $ve->login_id;
                    $vad    =   ucwords($ve->login_acde);
                    if($vad == "Active"){
                        $icon   =   "close-circle";
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
            <tr>
                <td><?php echo $limit++;?></td> 
                <td><?php echo $ve->login_name;?></td>  
                <td><?php echo $ve->login_email;?></td>  
                <td><?php echo $ve->ut_name;?></td>  
                <td><?php echo base64_decode($ve->login_password);?></td>   
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-User-Active')" fields="<?php echo $fqid;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="zmdi zmdi-<?php echo $icon;?> m-r-5"></i></a>
                    <?php }  if($ur == '1'){?>
                    <a href='<?php echo adminurl("Update-User/".$fqid);?>' data-toggle='tooltip' data-original-title="Update User" class="text-success tip-left"><i class="zmdi zmdi-edit m-r-5"></i></a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'User')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-User/".$fqid);?>"   data-original-title="Delete User" class="text-danger"><i class="zmdi zmdi-delete"></i></a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="10"><i class="zmdi zmdi-info-outline"></i> Users are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div> 
<?php echo $this->ajax_pagination->create_links();?>