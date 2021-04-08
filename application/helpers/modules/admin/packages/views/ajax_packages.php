<?php
$sr     =   $this->session->userdata("active-deactive-package");
$cr     =   $this->session->userdata("create-package");
$ur     =   $this->session->userdata("update-package");
$dr     =   $this->session->userdata("delete-package");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>
<div class="table-responsive"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_type" urlvalue="<?php echo adminurl('viewPackage/');?>" onclick="getdatafiled($(this))">Type <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_name" urlvalue="<?php echo adminurl('viewPackage/');?>" onclick="getdatafiled($(this))">Package Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_price" urlvalue="<?php echo adminurl('viewPackage/');?>" onclick="getdatafiled($(this))">Price <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_coins" urlvalue="<?php echo adminurl('viewPackage/');?>" onclick="getdatafiled($(this))">Coins <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_acde" urlvalue="<?php echo adminurl('viewPackage/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <?php if($ct == '1'){?>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->package_acde);
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
            <tr>
                <td><?php echo $limit++;?></td>
                <td><?php echo $ve->package_type;?></td>
                <td><?php echo $ve->package_name;?></td>
                <td><i class="fa fa-inr"></i>&nbsp;<?php echo $ve->package_price;?></td>
                <td><?php echo $ve->package_coins;?></td>
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Package-Active')" fields="<?php echo $ve->package_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                    <?php } if($ur == '1'){?>
                    <a href='<?php echo adminurl("Update-Package/".$ve->package_id);?>' data-toggle='tooltip' data-original-title="Update Package" class="text-success tip-left"><i class="fa fa-edit m-r-5"></i></a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Package')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Package/".$ve->package_id);?>"   data-original-title="Delete Package" class="text-danger"><i class="fa fa-trash"></i></a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="10"><i class="zmdi zmdi-info-outline"></i> Packages are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div> 
<?php echo $this->ajax_pagination->create_links();?>