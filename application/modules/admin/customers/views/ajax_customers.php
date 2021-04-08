<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_id" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Customers Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_name" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Customers Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_email_id" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Email<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_mobile" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_status" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->customer_status);
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
                <td class="fonn"><?php echo $ve->customer_id;?></td>
                <td><?php echo $ve->customer_name;?></td>
                <td><?php echo $ve->customer_email_id;?></td>
                <td><?php echo $ve->customer_mobile;?></td>
                <td><?php echo $vdata;?></td>
                <td>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Customers-Active')" fields="<?php echo $ve->customer_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Class')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Customers/".$ve->customer_id);?>"   data-original-title="Delete Class" class="text-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Customers are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>