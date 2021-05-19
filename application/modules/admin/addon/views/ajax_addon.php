<?php
$sr     =   $this->session->userdata("active-deactive-addon");
$cr     =   $this->session->userdata("create-addon");
$ur     =   $this->session->userdata("update-addon");
$dr     =   $this->session->userdata("delete-addon");
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
                <th><a href="javascript:void(0);" data-type="order" data-field="addon_name" urlvalue="<?php echo adminurl('viewAddon/');?>" onclick="getdatafiled($(this))">Addon Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="addon_acde" urlvalue="<?php echo adminurl('viewAddon/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <?php if($ct == '1'){?>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->addon_acde);
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
                <td><?php echo $ve->addon_name;?></td>
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                    <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Addon-Active')" fields="<?php echo $ve->addon_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </a>
                    <?php }  if($ur == '1'){?>
                        <a href='<?php echo adminurl("Update-Addon/".$ve->addon_id);?>' data-toggle='tooltip' data-original-title="Update Role" class="text-success tip-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Addons')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Addon/".$ve->addon_id);?>" data-original-title="Delete country" class="text-danger">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
					</a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Addons are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div> 
<?php echo $this->ajax_pagination->create_links();?>