  <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header"> 
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4> <?php echo $title;?> </h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4 id="timer"> 00 </h4>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
    					<input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
    					<input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
    					<?php $this->load->view("admin/loader");?>
    					<div class="postList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>