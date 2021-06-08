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

<!-- <div class="row layout-top-spacing">
    <div class="col-lg-12">
      <div class="card">           
         <div class="card-body">
            <form action="" method="get" class="formssample" id="role" novalidate="">
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 p-3"> 
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
                    <div class="col-md-3 form-group">
                        <label>From Date </label>
                        <input type="date" id="fromDate" name="fromDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $this->input->get('fromDate');?>"/>
                    </div> 
                    <div class="col-md-3 form-group">
                        <label>To Date </label>
                        <input type="date" id="toDate" name="toDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $this->input->get('toDate');?>"/>
                    </div> 
                   
                    <div class="col-lg-3 col-md-3 p-3">
                        <div class="form-group mt-3">
                            <div class="form-line">
                                <input type="text" id="FilterTextBox" name="keywords" value="<?php echo $this->input->get('keywords');?>" class="form-control" placeholder="Search">
                                <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
                                <input type="hidden" id="category" name="category" value="<?php echo ($this->input->get('category')??'Today Orders');?>">
                                <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 p-4 "> 
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="submit" value="submit"> <i class="mdi mdi-search-web"></i> Search </button>
                        </div>
                    </div>
                    <!--
                    <div class="col-lg-1 col-md-1 pt-3"> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-raised btn-warning waves-effect" name="pdf" value="submit"> <i class="mdi mdi-search-web"></i> PDF </button>
                        </div>
                    </div>---
                    <div class="col-lg-1 col-md-1 pt-3"> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-raised btn-info waves-effect" name="excel" value="submit"> <i class="mdi mdi-search-web"></i> Excel </button>
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
         </div>
      </div>
   </div>
</div> -->