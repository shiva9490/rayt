    <?php //echo '<pre>';print_r($data);exit;
        if($types =="orders"){
        /*--status: Order Placed--*/
        if($status !=""){ ?>
            <div class="modal-header">
                <button type="button" class="close" onclick="closeorder<?php echo $title;?>" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">OrderID : #<?php echo $title;?></h4><br>
                <p>
                    <strong>Time:</strong><?php echo date("H:i a", strtotime($data[0]->order_created_by));?><br>
                    <strong>Date:</strong><?php echo date("D-M-Y", strtotime($data[0]->order_created_by));?>
                </p>
                <svg id="Capa_1" enable-background="new 0 0 512 512" height="45" viewBox="0 0 512 512" width="45" xmlns="http://www.w3.org/2000/svg"><g><path d="m437 129h-14v-54c0-41.355-33.645-75-75-75h-184c-41.355 0-75 33.645-75 75v54h-14c-41.355 0-75 33.645-75 75v120c0 41.355 33.645 75 75 75h14v68c0 24.813 20.187 45 45 45h244c24.813 0 45-20.187 45-45v-68h14c41.355 0 75-33.645 75-75v-120c0-41.355-33.645-75-75-75zm-318-54c0-24.813 20.187-45 45-45h184c24.813 0 45 20.187 45 45v54h-274zm274 392c0 8.271-6.729 15-15 15h-244c-8.271 0-15-6.729-15-15v-148h274zm89-143c0 24.813-20.187 45-45 45h-14v-50h9c8.284 0 15-6.716 15-15s-6.716-15-15-15h-352c-8.284 0-15 6.716-15 15s6.716 15 15 15h9v50h-14c-24.813 0-45-20.187-45-45v-120c0-24.813 20.187-45 45-45h362c24.813 0 45 20.187 45 45z"/><path d="m296 353h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m296 417h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m128 193h-48c-8.284 0-15 6.716-15 15s6.716 15 15 15h48c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></g></svg>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <span class="msg"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php 
                        $orderstatus = $this->config->item('orderstatus');
                        if($status=="Order Placed"){ ?>
                        <button class="btn btn-lg btn-primary mb-4 mr-2 orders" data-title ="<?php echo $orderstatus[0];?>" onclick="accectorder('<?php echo $title;?>')">Accept</button>
                        <button class="btn btn-lg btn-secondary mb-4 mr-2">Reject</button>
                   
                        <?php }elseif($status=="Preparing"){ ?>
                            <button class="btn btn-lg btn-primary mb-4 mr-2 orders" data-value="<?php echo $this->session->userdata("restraint_id");?>" data-title ="<?php echo $orderstatus[1];?>" onclick="accectorder('<?php echo $title;?>')">Food Is Done</button>
                        <?php } ?>
                     </div>
                    <div class="col-sm-12 mb-3">
                        <div class="d-flex box-shw">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <h6 class="ml-3"><?php echo $data[0]->customeraddress_current_loc;?></h6>
                        </div>                 
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="d-flex box-shw">
                            <div id="timelineBasic" class="col-lg-12 layout-spacing">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4> Basic</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area pb-1">
                                    <div class="mx-auto">
                                        <div class="timeline-line row">
                                            <?php 
                                                $p['whereCondition'] = "order_id LIKE '".$data[0]->order_id."' AND orderdetail_restaurant_id LIKE '".$data[0]->orderdetails_id."'";
                                                $r = $this->order_model->viewOrderStatus($p);
                                                //echo '<pre>';print_r($r);exit;
                                            ?>
                                            <div class="col-md-4">
                                                <p class="t-time"><?php if(isset($r[0]->orderstatus_add_date)) {echo date("H:i a", strtotime($r[0]->orderstatus_add_date)); }else{ echo " "; }?></p>
                                                <div class="item-timeline">
                                                    <div class="t-dot t-dot-primary">
                                                    </div>
                                                </div>
                                                <div class="t-text">
                                                    <p><?php if(isset($r[0]->orderdetail_status)) {echo $r[0]->orderdetail_status; }?></p>
                                                    <p class="t-meta-time">25 mins ago</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="t-time">10:00</p>
                                                <div class="item-timeline">
                                                    <div class="t-dot t-dot-success">
                                                    </div>
                                                </div>
                                                <div class="t-text">
                                                    <p>Updated Server Logs</p>
                                                    <p class="t-meta-time">25 mins ago</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="t-time">10:00</p>
                                                <div class="item-timeline last-child">
                                                    <div class="t-dot">
                                                    </div>
                                                </div>
                                                <div class="t-text">
                                                    <p>Updated Server Logs</p>
                                                    <p class="t-meta-time">25 mins ago</p>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="box-shw">
                             <h4>Order Details</h4>
                            <div class="row">
                                <?php foreach($data as $d){?>
                                <div class="col-md-8">
                                    <p><b><?php echo $d->orderdetail_quantity;?> x <strong><?php echo $d->resturant_items_name;?></strong></b></p>
                                    <p>
                                        <?php 
                                            $add = explode(",",json_decode($d->orderdetail_addons));
                                            $addons = array();
                                            if(is_array($add) && count($add) > 0){
                                                foreach($add as $k=>$add){
                                                    $adds = $this->common_config->clean($add);
                                                    $par['whereCondition'] = "order_id Like '".$d->order_id."' AND order_details_id LIKE '".$d->orderdetails_id."' AND  orderassons_id LIKE '".$adds."'";
                                                    $res = $this->order_model->getOrderasson($par);
                                                    $addons['name'][$k] = $res['orderassons'];
                                                    $addons['amount'][$k] = $res['orderassons_amount'];
                                                }
                                            }
                                            echo 'Addons : '.implode(",",$addons['name']);
                                        ?>
                                    </p>
                                    <p>
                                        <?php 
                                            $variants = explode(",",json_decode($d->orderdetail_variants));
                                            $var = array();
                                            if(is_array($variants) && count($variants) > 0){
                                                foreach($variants as $variant){
                                                    $variantss = $this->common_config->clean($variant);
                                                    $par['whereCondition'] = "order_id Like '".$d->order_id."' AND order_details_id LIKE '".$d->orderdetails_id."' AND  orderassons_id LIKE '".$variantss."'";
                                                    $ress = $this->order_model->getOrderasson($par);
                                                    $var['name'][$k] = $ress['orderassons'];
                                                    $var['amount'][$k] = $ress['orderassons_amount'];
                                                }
                                            }
                                            echo 'Variants : '.implode(",",$var['name']);
                                        ?>
                                </div>
                                <div  class="col-md-4 text-right">
                                    <p>KWD <?php echo number_format((float)$d->orderdetail_price, 3, '.', '');?></p>
                                </div>
                                <?php } ?>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Subtotal</h5>
                                    <p>Delivery Fee</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p><strong>KWD <?php echo number_format((float)$data[0]->order_amount, 3, '.', '');?></strong></p>                                     
                                    <p>KWD <?php echo number_format((float)$data[0]->order_delivery_chage, 3, '.', '');?></p>
                                </div>                              
                            </div>                         
                         </div>
                    </div>
                   
                     <div class="col-sm-12 mb-3">
                         <div class="box-shw">
                             <h4>Billing Status <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></h4>
                             <p><?php echo ($data[0]->order_type!="")?$data[0]->order_type:'Online Payment';?></p>
                         </div>
                     </div>
                </div>
            </div>  <br>
    <?php } }else { ?>
    
        <div class="modal-header">
            <button type="button" class="close" onclick="closeorder<?php echo $title;?>" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">OrderID : #<?php echo $title;?></h4>
            <p><?php echo $data[0]->order_created_by;?></p>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="d-flex box-shw">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <h6 class="ml-3"><?php echo $data[0]->customeraddress_current_loc;?></h6>
                    </div>                 
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="box-shw">
                         <h4>Order Details</h4>
                        <div class="row">
                            <?php foreach($data as $d){?>
                            <div class="col-md-8">
                                <p><b><?php echo $d->orderdetail_quantity;?> x <strong><?php echo $d->resturant_items_name;?></strong></b></p>
                                <p>
                                    <?php 
                                        $add = explode(",",json_decode($d->orderdetail_addons));
                                        $addons = array();
                                        if(is_array($add) && count($add) > 0){
                                            foreach($add as $k=>$add){
                                                $adds = $this->common_config->clean($add);
                                                $par['whereCondition'] = "order_id Like '".$d->order_id."' AND order_details_id LIKE '".$d->orderdetails_id."' AND  orderassons_id LIKE '".$adds."'";
                                                $res = $this->order_model->getOrderasson($par);
                                                $addons['name'][$k] = $res['orderassons'];
                                                $addons['amount'][$k] = $res['orderassons_amount'];
                                            }
                                        }
                                        echo 'Addons : '.implode(",",$addons['name']);
                                    ?>
                                </p>
                                <p>
                                    <?php 
                                        $variants = explode(",",json_decode($d->orderdetail_variants));
                                        $var = array();
                                        if(is_array($variants) && count($variants) > 0){
                                            foreach($variants as $variant){
                                                $variantss = $this->common_config->clean($variant);
                                                $par['whereCondition'] = "order_id Like '".$d->order_id."' AND order_details_id LIKE '".$d->orderdetails_id."' AND  orderassons_id LIKE '".$variantss."'";
                                                $ress = $this->order_model->getOrderasson($par);
                                                $var['name'][$k] = $ress['orderassons'];
                                                $var['amount'][$k] = $ress['orderassons_amount'];
                                            }
                                        }
                                        echo 'Variants : '.implode(",",$var['name']);
                                    ?>
                            </div>
                            <div  class="col-md-4 text-right">
                                <p>KWD <?php echo number_format((float)$d->orderdetail_price, 3, '.', '');?></p>
                            </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Subtotal</h5>
                                <p>Delivery Fee</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p><strong>KWD <?php echo number_format((float)$data[0]->order_amount, 3, '.', '');?></strong></p>                                     
                                <p>KWD <?php echo number_format((float)$data[0]->order_delivery_chage, 3, '.', '');?></p>
                            </div>                              
                        </div>                         
                     </div>
                </div>
               
                 <div class="col-sm-12 mb-3">
                     <div class="box-shw">
                         <h4>Billing Status <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></h4>
                         <p><?php echo ($data[0]->order_type!="")?$data[0]->order_type:'Online Payment';?></p>
                     </div>
                 </div>
            </div>
        </div>  <br>
    <?php } ?>
    