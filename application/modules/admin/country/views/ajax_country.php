<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="country_id" urlvalue="<?php echo adminurl('viewCountry/');?>" onclick="getdatafiled($(this))">Country Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="country_name" urlvalue="<?php echo adminurl('viewCountry/');?>" onclick="getdatafiled($(this))">Country Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="country_flag" urlvalue="<?php echo adminurl('viewCountry/');?>" onclick="getdatafiled($(this))">Flag<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="country_symbol" urlvalue="<?php echo adminurl('viewCountry/');?>" onclick="getdatafiled($(this))">Symbol<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="country_currencie" urlvalue="<?php echo adminurl('viewCountry/');?>" onclick="getdatafiled($(this))">Currency<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="country_status" urlvalue="<?php echo adminurl('viewCountry/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->country_abc);
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
                <td class="fonn"><?php echo $ve->country_id;?></td>
                <td><?php echo $ve->country_name;?></td>
                <td><img src="<?php echo $ve->country_flag;?>" width="20px"/></td>
                <td><?php echo $ve->country_symbol;?></td>
                <td><?php echo $ve->country_currencie;?></td>
                <td><?php echo $vdata;?></td>
                <td>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Country-Active')" fields="<?php echo $ve->country_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Class')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Country/".$ve->country_id);?>"   data-original-title="Delete Class" class="text-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Country are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>