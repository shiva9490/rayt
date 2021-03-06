<?php
$sr     =   $this->session->userdata("active-deactive-resturant");
$cr     =   $this->session->userdata("create-resturant");
$ur     =   $this->session->userdata("update-resturant");
$dr     =   $this->session->userdata("delete-resturant");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>

<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Resturant Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Resturant Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Address </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_contact_no" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Menu Hours (closed)</th>
                <th>Total Branches</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){
                foreach($view as $ve){
                    $vad    =   ucwords($ve->resturant_status);
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
                <td class="fonn"><?php echo $ve->resturant_id;?><i class="fa fa-clone" aria-hidden="true"></i></td>
                <td><a href="#"><?php echo $ve->resturant_name;?></a></td>
                <td><?php echo $ve->resturant_area.','.$ve->resturant_block.','.$ve->resturant_street.','.$ve->resturant_jaada.','.$ve->resturant_house.','.$ve->resturant_building;?></td>
                <td><?php echo $ve->resturant_contact_no;?></td>
                <td><?php echo $ve->resturant_menu_hours;?></td>
                <td>-</td>
                <td><?php echo $vdata;?></td>
				<?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Resturant-Active')" fields="<?php echo $ve->resturant_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                    <?php }  if($ur == '1'){?>
                    <a href='<?php echo adminurl("Update-Resturant/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Update Resturant" class="text-success tip-left">
					</a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Resturant')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Resturant/".$ve->resturant_id);?>" data-original-title="Delete country" class="text-danger">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
					</a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Resturants are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>