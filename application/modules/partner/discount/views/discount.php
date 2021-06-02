<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">
                <?php $this->load->view('admin/success_error');?> 
            <div class="mail-box-container">                                    
                <div id="todo-inbox" class="accordion todo-inbox">
                     <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><h5><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Complete Discount(2) </h5> </div>
                                <div class="col-md-6">
                                    <a href="<?php echo partnerurl('Create-Discount')?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">+Create New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">                     
                            <?php $this->load->view("admin/search");?>
                        </div>
                    </div>      
                </div>
            </div> 
        </div>
    </div>
</div>