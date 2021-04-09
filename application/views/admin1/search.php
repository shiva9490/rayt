<form action="" method="get" class="formssample" id="role" novalidate="">
    <div class="col-md-12 mt-3">
     <div class="row">
         <div class="col-md-4">
             <h4><?php echo $title;?></h4>
         </div>
         <div class="col-md-2"> 
         <?php if(!empty($create)){?>
           <a type="button" class="btn b-success mx-2 " href="<?php echo adminurl($create);?>">+ New</a>
           <?php } ?>
        </div> 
        <div class="col-md-2">
              <select class="form-control limitvalue" name="limitvalue" onchange="searchFilter('','<?php echo $urlvalue;?>')">
                <?php $climit    =   $this->config->item("limit_values");
                foreach($climit as $ce){
                ?>
                <option value="<?php echo $ce;?>" <?php echo ($this->input->get('limitvalue') == $ce)?"selected='selected'":'';?>><?php echo $ce;?></option>
                <?php
                }
                ?> 
            </select> 
        </div>
         <div class="col-md-4">
             
             <input type="text"  id="FilterTextBox" name="keywords" value="<?php echo $this->input->get('keywords');?>"  class="form-control sear" id="" placeholder="Search">
             <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
             <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
             <input type="submit" value="Search" class="btn b-dark py-1">
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