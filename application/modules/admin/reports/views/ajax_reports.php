<div class="row">
    <div class="col-sm-12 mb-3">
        <?php  //echo '<pre>';print_r($view);exit;
        if(count($view) > 0){     
            $cods =array();         
            foreach($view as $key=>$ve){ 
        //print_r($ve);exit;
        ?>
            <div class="mb-4">
                <h5 class="mb-2"><?php echo $ve->resturant_name;?></h5>
                <div class="box-shw">
                    <h5><b>Income</b></h5>
                    <div class="row">                         
                        <div class="col-md-6">
                            <p>Income Source</p>
                            <p><b>Cash Payment</b></p>
                            <p><b>Online Payment</b></p>
                        </div>
                        <div class="col-md-3 text-right">
                            <p>Quantity</p>
                            <p>
                                <b>
                                    <?php /*
                                        $par['whereCondition'] ="orderdetail_restaurant_id LIKE '".$ve->orderdetail_restaurant_id."' AND or.order_type LIKE 'COD' AND order_status LIKE 'Active'";
                                        $cod = $this->order_model->viewOrders($par);
                                        $cods[$key] = 0;
                                        //print_r($cods[$key]);exit;
                                        if(is_array($cod) && count($cod) >0){
                                            foreach($cod as $c){
                                                $cods[$key] = ($cods[$key])+$c->order_amount; 
                                            }
                                        }
                                       echo count($cod);*/
                                    ?>
                                </b>
                            </p>
                            <p>
                                <b>
                                 <?php /*
                                        $par['whereCondition'] ="orderdetail_restaurant_id LIKE '".$ve->orderdetail_restaurant_id."' AND or.order_type LIKE 'Online Payment' AND order_status LIKE 'Active'";
                                        $codo = $this->order_model->viewOrders($par);
                                        $codso[$key] = 0;
                                        //print_r($cods[$key]);exit;
                                        if(is_array($codo) && count($codo) >0){
                                            foreach($codo as $co){
                                                $codso[$key] = ($codso[$key])+$co->order_amount; 
                                            }
                                        }
                                       echo count($codo);*/
                                    ?>
                                </b>
                            </p>
                        </div>
                        <div  class="col-md-3 text-right">
                            <p>Amount</p>
                            <p><b>KWD <?php echo number_format((float)$ve->cod, 3, '.', '');?></b></p>
                            <p><b>KWD <?php echo number_format((float)$ve->online, 3, '.', '');?></b></p>
                        </div>
                    </div>
                    <hr>     
                    <div class="row">   
                        <div  class="col-md-6">   
                            <h5><b>Subtotal</b></h5>
                        </div>
                        <div class="col-md-6 text-right">  
                            <h5><b>KWD <?php echo number_format((float)($ve->cod+$ve->online), 3, '.', '');?></b></h5> 
                        </div>
                    </div>                          
                </div>
            </div>
            <?php }
        }
        else {
            echo '<tr class="text-center text-danger"><td colspan="6"><i class="zmdi zmdi-info-outline"></i>oders are  not available yet </td></tr>';
        }
        ?>
    </div>              
</div>
  <?php echo $this->ajax_pagination->create_links();?>