<form action="" method="get" class="formssample" id="role" novalidate="">
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-3"> 
            <div class="form-group">
                <select class="form-control limitvalue show-tick" name="limitvalue" onchange="searchFilter('','<?php echo $urlvalue;?>')">
                    <?php $climit    =   $this->config->item("limit_values");
                    foreach($climit as $ce){
                    ?>
                    <option value="<?php echo $ce;?>" <?php echo ($this->input->get('limitvalue') == $ce)?"selected='selected'":'';?>><?php echo $ce;?></option>
                    <?php
                    }
                    ?> 
                </select>  
            </div>
        </div> 
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p-3"> 
            <div class="form-group">
                <input id="rangeCalendarFlatpickr1" class="form-control" type="text"  value="<?php echo str_replace("+"," ",$this->input->get('date'));?>" placeholder="Select Date.." name="date">
            </div>
        </div> 
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p-3">
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="FilterTextBox" name="keywords" value="<?php echo $this->input->get('keywords');?>" class="form-control" placeholder="Search">
                    <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
                    <input type="hidden" id="category" name="category" value="<?php echo ($this->input->get('category')??'Today Orders');?>">
                    <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
                </div>
            </div>
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-3"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="submit" value="submit"> <i class="mdi mdi-search-web"></i> Search </button>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="pdf" value="submit"> <i class="mdi mdi-search-web"></i> PDF </button>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="excel" value="submit"> <i class="mdi mdi-search-web"></i> Excel </button>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-3">
            <span id="timer">
                <span id="time"></span>Seconds 
                <span onclick="OrderRefresh()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                </span>     
            </span>
        </div>
    </div>
    <div class="row">
        <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $this->load->view("admin/load");?>
            <div class="postList"></div>
        </div>
    </div>
</form>