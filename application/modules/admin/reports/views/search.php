<form action="" method="get" class="formssample" id="role" novalidate="">
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-3"> 
            <div class="form-group mt-3">
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
        <div class="col-md-2 form-group">
            <label>From Date </label>
            <input type="date" id="fromDate" name="fromDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $this->input->get('fromDate');?>"/>
        </div> 
        <div class="col-md-2 form-group">
            <label>To Date </label>
            <input type="date" id="toDate" name="toDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $this->input->get('toDate');?>"/>
        </div> 
        <div class="col-md-2 form-group">
            <label>Restaurant Name </label>
            <select class="form-control" id="restaurant" name="restaurant"  onchange="searchFilter('','<?php echo $urlvalue;?>')">               
                <option value=''>select Restaurant name</option>               
                <?php
                	$res['whereCondition'] = 'resturant_status LIKE "Active" AND resturant_open LIKE "1"';
                    $rs   =   $this->resturant_model->viewResturant($res);
               
                foreach($rs as $r){?>
                    <option value="<?php echo $r->resturant_id;?>" ><?php echo $r->resturant_name;?></option>   
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2 form-group" style="<?php if($this->uri->segment('2')=="Reports"){ echo 'display:none;';}?>">
            <label>Pay Mode</label>
            <select class="form-control" id="pay_mode" name="pay_mode"  onchange="searchFilter('','<?php echo adminurl('viewsalesReports/');?>')">
                <option value=''>select Payment Mode</option>         
                <?php
                foreach($this->config->item('payment_mode') as $p){?>
                    <option value="<?php echo $p;?>" ><?php echo $p;?></option>   
                <?php } ?>
            </select>
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
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pt-3"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="submit" value="submit"> <i class="mdi mdi-search-web"></i> Search </button>
            </div>
        </div>
        <!--
        <div class="col-lg-1 col-md-1 pt-3"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-warning waves-effect" name="pdf" value="submit"> <i class="mdi mdi-search-web"></i> PDF </button>
            </div>
        </div>
        -->
        <div class="col-lg-1 col-md-1 pt-3"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-info waves-effect" name="excel" value="submit"> <i class="mdi mdi-search-web"></i> Excel </button>
            </div>
        </div> 
        <div class="col-lg-1 col-md-1 pt-3"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-info waves-effect" name="pdf" value="submit"> <i class="mdi mdi-search-web"></i> PDF</button>
            </div>
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