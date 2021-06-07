<?php
$cr     =   $this->session->userdata("create-order");
$ur     =   $this->session->userdata("update-order");
$dr     =   $this->session->userdata("delete-order");
$sr     =   $this->session->userdata("active-deactive-order");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == '1'){
        $ct     =   1;
}
?>
<div class="col-md-12 table-responsive t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetails_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Order Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetails_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Order Time <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetail_restaurant_item_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Amount <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>             
                <th><a href="javascript:void(0);" data-type="orders" data-field="order_type" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Payment <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="customer_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Area name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="resturant_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Restaurant name<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
               </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->order_status);
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
                    $par['columns']="orderstatus_add_date";
                    $par['whereCondition'] = " orderdetail_restaurant_id ='".$ve->orderdetails_id."' AND orderdetail_status = '".$ve->orderdetails_rest_staus."'";
                 $updated= $this->order_model->getOrderStatus($par);
                 if($ve->orderdetails_rest_staus == "Pending"){
                     $delay =   preg_replace('/[^0-9.]+/', '', $ve->resturant_preparation);
                 }
                 if(!empty($delay)){
                    $time	=	"-".$delay." minutes";
                    $datediff = date("Y-m-d H:i:s", strtotime($time));
                 }

            ?>
            <tr class="<?php if(!empty($delay) && !empty($updated[0]['orderstatus_add_date']) && $updated[0]['orderstatus_add_date'] <= $datediff){ echo 'alrt-danger';} ?>" id="alert<?php echo $ve->order_unique_id;?>">
                <td id="orders<?php echo $ve->order_unique_id;?>" data-types<?php echo $ve->order_unique_id;?>="<?php echo $orders;?>" data-status<?php echo $ve->order_unique_id;?>="<?php echo $ve->orderdetails_rest_staus;?>">
                  
                        <?php echo $ve->order_unique_id;?>
                   
                </td>
                <td><?php echo date("d-m-Y h:i:sa",strtotime($ve->order_created_by));?></td>
                <td>
                    <?php  echo number_format((float)$ve->order_amount, 3, '.', '');?>
                </td>
                <td><?php echo ($ve->order_type!="")?$ve->order_type:'Online Payment';?></td>
                <td><?php echo $ve->customeraddress_area;?></td>
                <td><?php echo $ve->resturant_name;?></td>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="6"><i class="zmdi zmdi-info-outline"></i> Oders are  not available yet</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>