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
                <th><a href="javascript:void(0);" data-type="orders" data-field="customer_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">customer Details <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="order_type" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Payment <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetail_restaurant_item_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Amount <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetails_rest_staus" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetails_rest_staus" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status Update <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetail_created_on" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Order Placed <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
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
            <tr class="<?php if(!empty($delay) && !empty($updated[0]['orderstatus_add_date']) && $updated[0]['orderstatus_add_date'] <= $datediff){ echo 'alert-danger';} ?>">
                <td id="orders<?php echo $ve->order_unique_id;?>" data-types<?php echo $ve->order_unique_id;?>="<?php echo $orders;?>" data-status<?php echo $ve->order_unique_id;?>="<?php echo $ve->orderdetails_rest_staus;?>">
                    <a class="orders<?php echo $ve->order_unique_id;?>" onclick="orderModel('<?php echo $ve->order_unique_id;?>','<?php echo $ve->orderdetail_restaurant_id;?>')" >
                        <?php echo $ve->order_unique_id;?>
                    </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy" onclick="copyId('<?php echo $ve->order_unique_id;?>')"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    
                    <span class="loader<?php echo $ve->order_unique_id;?>"></span>
                </td>
                <td><?php echo $ve->customer_name.'<br>'.$ve->customer_mobile;?></td>
                <td><?php echo ($ve->order_type!="")?$ve->order_type:'Online Payment';?></td>
                <td>
                    <?php  echo number_format((float)$ve->order_amount, 3, '.', '');?>
                </td>
                <td><?php echo $ve->orderdetails_rest_staus;?></td>
                <?php 
                 if(count($updated)>0){
                ?>
                    <td><?php echo $updated[0]['orderstatus_add_date'];?></td>
                <?php }else{ echo '<td></td>';} ?>
                <td><?php echo $ve->orderdetail_created_on;?></td>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="6"><i class="zmdi zmdi-info-outline"></i> Oders are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>