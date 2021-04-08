<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" title="Home">Home</a>
                            </div>
                        </li>
                        <li>/ My Posts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="events-grid eventsgrid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="get" class="" novalidate="">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2"> 
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
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-7">
                            <div class="form-group">
                                <input type="text" id="FilterTextBox" name="keywords" value="<?php echo $this->input->get('keywords');?>" class="form-control" placeholder="Search">
                                <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
                                <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                            <div class="form-group">
                                <button type="submit" class="btn-success  btnbal" name="submit" value="submit"> <i class="mdi mdi-search-web"></i> Search </button>
                            </div>
                        </div>
                    </div>
                </form>
                <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
                <?php $this->load->view("theme/loader");?>                        
                <div class="postList"></div>
            </div>
        </div>
    </div>
</section>