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
                <th><a href="javascript:void(0);" data-type="orders" data-field="resturant_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Resturant Details <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="driver_given_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Driver Details <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="order_type" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Payment <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetail_restaurant_item_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Amount <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetails_rest_staus" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="orders" data-field="orderdetail_created_on" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Order Updated <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){
                foreach($view as $key=>$ve){
                   // echo '<pre>';print_r($ve);exit;
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
                    $par['columns']     =   "orderstatus_add_date";
                    $par['tipoOrderby'] =   "orderstatus_id";
                    $par['order_by']    =   "DESC";
                    
                    $par['whereCondition'] = " orderdetail_restaurant_id ='".$ve->orderdetails_id."' AND orderdetail_status = '".$ve->orderdetails_rest_staus."'";
                    $updated= $this->order_model->getOrderStatus($par);
                    
                    $driver='';
                    if($ve->driver_assion_order != ""){
                        $p['whereCondition'] = "drso.order_id LIKE '".$ve->order_id."' AND drso.custmore_id LIKE '".$ve->customer_id."' AND drso.custmore_adder_id LIKE '".$ve->customeraddress_id."' AND drso.restaurant_id LIKE '".$ve->resturant_id."'";
                        $driver = $this->order_model->getOrderDetails($p);
                    }
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
                    <a class="orders<?php echo $ve->order_unique_id;?>" onclick="orderModel('<?php echo $ve->order_unique_id;?>','<?php echo $ve->orderdetail_restaurant_id;?>')" >
                        <?php echo $ve->order_unique_id;?>
                    </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy" onclick="copyId('<?php echo $ve->order_unique_id;?>')"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    
                    <span class="loader<?php echo $ve->order_unique_id;?>"></span>
                </td>
                <td><?php echo $ve->customeraddress_fullname.
                        '<br>'.$ve->customeraddress_mobile.','.$ve->customeraddress_landline.
                        '<br>'.$ve->customeraddress_area.','.$ve->customeraddress_blockno.
                        '<br>'.$ve->customeraddress_streetno.','.$ve->customeraddress_jadda.
                        '<br>'.$ve->customeraddress_buildingno.','.$ve->customeraddress_floorno.
                        '<br>'.$ve->customeraddress_landmark.','.$ve->customeraddress_add_type
                        ;?></td>
                <td><?php echo $ve->resturant_name.
                        '<br>'.$ve->resturant_contact.
                        '<br>'.$ve->resturant_position.
                        '<br>'.$ve->resturant_area.','.$ve->resturant_block.','.$ve->resturant_street.
                        '<br>'.$ve->resturant_jaada.','.$ve->resturant_house.','.$ve->resturant_building.
                        '<br>'.$ve->resturant_contact_no;
                        ?></td>
                <td>
                    <?php
                        if(is_array($driver) && count($driver) >0){
                            echo $driver['driver_given_id'].'<br>'.
                            $driver['driver_name'].'<br>'.
                            $driver['driver_name_last'].'<br>'.
                            $driver['driver_gender'].'<br>'.
                            $driver['driver_vehicle_type'].'<br>'.
                            $driver['driver_company'].'<br>'.
                            $driver['driver_phone'];
                        }else{
                            echo '-';
                        }
                    ?>
                </td>
                <td><?php echo ($ve->order_type!="")?$ve->order_type:'Online Payment';?></td>
                <td>
                    <?php  echo number_format((float)$ve->order_amount, 3, '.', '');?>
                </td>
                <td><?php echo $ve->orderdetails_rest_staus;?></td>
                <?php 
                    if(count($updated) > 0){
                ?>
                <td><?php echo $updated[0]['orderstatus_add_date'];?></td>
                <?php }else{ echo '<td></td>';} ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="7"><i class="zmdi zmdi-info-outline"></i> Oders are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>