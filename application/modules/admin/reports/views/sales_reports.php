<div class="widget-content widget-content-area border-top-tab  mt-3">        
    <div class="tab-content" id="borderTopContent">
        <div class="tab-pane fade show active" id="border-top-home" role="tabpanel" aria-labelledby="border-top-home-tab">
            <?php $this->load->view("search");?>
            <input type="hidden" id="orders" name="orders" value="<?php echo 'orders';?>"> 
            <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
            <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
            <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
        </div>
    </div>
</div>