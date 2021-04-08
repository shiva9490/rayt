<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_id" urlvalue="<?php echo base_url('Admin/Resturant/');?>" onclick="getdatafiled($(this))">Resturant Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_name" urlvalue="<?php echo base_url('Admin/Resturant/');?>" onclick="getdatafiled($(this))">Resturant Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Address </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_contact_no" urlvalue="<?php echo base_url('Admin/Resturant/');?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Menu Hours (closed)</th>
                <th>Total Branches</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_status" urlvalue="<?php echo base_url('Admin/Resturant/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
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
                <td>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Resturant-Active')" fields="<?php echo $ve->resturant_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                    <a href='<?php echo adminurl("Update-Resturant/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Update Role" class="text-success tip-left"><i class="fa fa-edit m-r-5"></i></a>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Class')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Resturant/".$ve->resturant_id);?>"   data-original-title="Delete Class" class="text-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Resturants are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>