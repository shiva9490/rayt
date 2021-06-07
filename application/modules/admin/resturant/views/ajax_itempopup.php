
    <div class="modal-header">
        <button type="button" class="close" onclick="closeitem<?php echo $title;?>" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ItemID : <?php echo $data[0]->resturant_items_id;?></h4>
        <p>
            <strong>Time: </strong><?php echo date("H:i a", strtotime($data[0]->resturant_items_add_date));?><br>
            <strong>Date: </strong><?php echo date("D-M-Y", strtotime($data[0]->resturant_items_add_date));?>
        </p>
        <svg id="Capa_1" enable-background="new 0 0 512 512" height="45" viewBox="0 0 512 512" width="45" xmlns="http://www.w3.org/2000/svg"><g><path d="m437 129h-14v-54c0-41.355-33.645-75-75-75h-184c-41.355 0-75 33.645-75 75v54h-14c-41.355 0-75 33.645-75 75v120c0 41.355 33.645 75 75 75h14v68c0 24.813 20.187 45 45 45h244c24.813 0 45-20.187 45-45v-68h14c41.355 0 75-33.645 75-75v-120c0-41.355-33.645-75-75-75zm-318-54c0-24.813 20.187-45 45-45h184c24.813 0 45 20.187 45 45v54h-274zm274 392c0 8.271-6.729 15-15 15h-244c-8.271 0-15-6.729-15-15v-148h274zm89-143c0 24.813-20.187 45-45 45h-14v-50h9c8.284 0 15-6.716 15-15s-6.716-15-15-15h-352c-8.284 0-15 6.716-15 15s6.716 15 15 15h9v50h-14c-24.813 0-45-20.187-45-45v-120c0-24.813 20.187-45 45-45h362c24.813 0 45 20.187 45 45z"/><path d="m296 353h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m296 417h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m128 193h-48c-8.284 0-15 6.716-15 15s6.716 15 15 15h48c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></g></svg>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <span class="msg"></span>
            </div>
            <div class="col-sm-12 mb-3">
                <div class="box-shw">
                    <div class="d-flex ml-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <?php 
                            $p['whereCondition'] = "resturant_id LIKE '".$data[0]->resturant_id."' ";
                            $r = $this->resturant_model->viewResturant($p); 
                             foreach($r as $d){
                        ?>
                        <h6 class="ml-2"><?php echo $d->resturant_name;?></h6>
                        <?php } ?>                   
                    </div>   
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                    $pic    =   $data[0]->resturant_items_image;
                                    $imh    =   $this->common_config->getvalueImagesize($pic);
                                ?>
                                <img class="img-fluid" src="<?php echo $imh;?>">
                            </div>
                            <div class="col-md-8">
                              
                                <div class="n-chk">
                                     <?php if($data[0]->resturant_items_type == "Non-veg"){ ?>
                                        <label class="new-control new-radio square-radio radio-danger">
                                        <input type="radio" class="new-control-input" name="custom-radio-3" checked>
                                        <span class="new-control-indicator"></span> <?php echo $data[0]->resturant_items_type;?>
                                        </label>
                                    <?php }elseif($data[0]->resturant_items_type == "Veg"){ ?>
                                        <label class="new-control new-radio square-radio radio-success">
                                        <input type="radio" class="new-control-input" name="custom-radio-3" checked>
                                        <span class="new-control-indicator"></span> <?php echo $data[0]->resturant_items_type;?>
                                        </label>
                                    <?php } else{?>
                                        <label class="new-control new-radio square-radio ">
                                        <input type="radio" class="new-control-input" name="custom-radio-3" checked>
                                        <span class="new-control-indicator"></span> <?php echo $data[0]->resturant_items_type;?>
                                        </label>

                                  <?php  } ?>
                                </div>  

                                 <div>
                                    <h4><?php echo $data[0]->resturant_items_name;?></h4>
                                    <h5><?php echo $data[0]->resturant_items_name_a;?></h5>
                                    <p><?php echo $data[0]->resturant_items_desc;?></p>
                                </div>
                            </div>                        
                        </div> 
                    </div>  
                </div>            
            </div>          
            <div class="col-sm-12 mb-3">
                <div class="box-shw">
                    <h4>Price Details</h4>
                    <div class="row">
                        <?php foreach($data as $d){?>
                        <div class="col-md-8">
                            <p>Packing Cost</p>
                            <p>VAT</p>
                            <p><b>Item price </b></p>
                        </div>
                        <div  class="col-md-4 text-right">
                            <p>KWD  <?php echo number_format((float)$d->resturant_items_vat, 3, '.', '');?> KWD</p>
                            <p>KWD  <?php echo number_format((float)$d->resturant_items_packing, 3, '.', '');?> KWD</p>
                            <p>KWD  <?php echo number_format((float)$d->resturant_items_price, 3, '.', '');?> KWD</p>
                        </div>
                        <?php } ?>
                    </div>
                    <hr>                                       
                 </div>
            </div>
        </div>
    </div>
             