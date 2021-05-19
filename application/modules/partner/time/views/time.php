<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="mail-box-container">                                     
                <div id="todo-inbox" class="accordion todo-inbox">
                     <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><h6><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Regular Opening Times </h6> </div>
                               
                            </div>
                        </div>
                        <div class="card-body">                     
                            <div class="col-md-12 mt-3 t_div">
                                <div class="row">
                                   <div class="col-md-6">
                                   <div class="table-responsive p-3 bg-white rounded">
                                         <div class="row">
                                            <div class="col-md-6">
                                                <h6> Regular Opening Times</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="text-primary" style="float: right;" href="<?php echo partnerurl('Regular-Time')?>"><strong>Edit</strong> </a>
                                            </div>
                                        </div>
                                        <table class="table mb-3">                                          
                                            <tbody>
                                                <?php  foreach($resttime as $i){ ?>
                                                <tr>
                                                    <td class="text-left"><?php echo $i->resturant_weekly;?></td>
                                                    <td  class="text-right"><?php echo $i->resturant_start_time;?> - <?php echo $i->resturant_end_time;?></td>                                                   
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>    
                                   </div>                                        
                                </div>                                
                            </div> 
                        </div>
                    </div>      
                </div>
            </div> 
        </div>
    </div>
</div>