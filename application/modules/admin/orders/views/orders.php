        <div class="widget-content widget-content-area border-top-tab">
            <ul class="nav nav-tabs mb-3 mt-3" id="borderTop" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="border-top-home-tab" data-toggle="tab" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Today Orders')" href="#border-top-home" role="tab" aria-controls="border-top-home" aria-selected="true">Today Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="border-top-profile-tab" data-toggle="tab" href="#border-top-profile" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Unassigned')" role="tab" aria-controls="border-top-profile" aria-selected="false">Unassigned</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="border-top-contact-tab" data-toggle="tab" href="#border-top-contact" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Pending')" role="tab" aria-controls="border-top-contact" aria-selected="false">Pending</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" id="border-top-setting-tab" data-toggle="tab" href="#border-top-setting" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Received')" role="tab" aria-controls="border-top-setting" aria-selected="false">Received</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" id="border-top-setting-tab" data-toggle="tab" href="#border-top-setting" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Ready for Pickup')" role="tab" aria-controls="border-top-setting" aria-selected="false">Ready for Pickup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="border-top-setting-tab" data-toggle="tab" href="#border-top-setting" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Completed Pickup')" role="tab" aria-controls="border-top-setting" aria-selected="false">Completed Pickup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="border-top-setting-tab" data-toggle="tab" href="#border-top-setting" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Arraived at customes')" role="tab" aria-controls="border-top-setting" aria-selected="false">Arraived at customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="border-top-setting-tab" data-toggle="tab" href="#border-top-setting" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this),'Delivered')" role="tab" aria-controls="border-top-setting" aria-selected="false">Delivered</a>
                </li>
            </ul>
            <div class="tab-content" id="borderTopContent">
                <div class="tab-pane fade show active" id="border-top-home" role="tabpanel" aria-labelledby="border-top-home-tab">
                    <?php $this->load->view("admin/search");?>
                    <input type="hidden" id="orders" name="orders" value="<?php echo 'orders';?>"> 
                    <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
					<input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
					<input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
                </div>
            </div>
        </div>