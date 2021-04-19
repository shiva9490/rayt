<form action="" method="get" class="formssample" id="role" novalidate="">
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> 
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
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="FilterTextBox" name="keywords" value="<?php echo $this->input->get('keywords');?>" class="form-control" placeholder="Search">
                    <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
                    <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="submit" value="submit"> <i class="mdi mdi-search-web"></i> Search </button>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $this->load->view("admin/loader");?>                        
            <div class="postList"></div>
        </div>
    </div>
</form>