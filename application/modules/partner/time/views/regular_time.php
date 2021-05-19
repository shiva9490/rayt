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
                                   <div class="col-md-12">
                                   <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="pl-3"> Regular Opening Times</h6>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                    <button type="submit" value="Submit" name="submit" class="btn btn-dark ">Save Changes</button>
                                            </div>
                                         </div>
                                       <div class="table-responsive  p-3 bg-white rounded">                                         
                                            <table class="table mb-3">    
                                                  <?php $this->load->view('admin/success_error');?>

                                                <tbody>
                                                    <?php $j=1; foreach($resttime as $key=>$i){ ?>
                                                    <tr>
                                                        <td class="text-left">
                                                            <?php echo $i->resturant_weekly;?>
                                                            <input type="hidden"  name="resturant_weekly[]" value="<?php echo $i->resturant_weekly;?>"  />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" id="timepicker<?php echo $j;?>" name="strt_time[]" value="<?php echo $i->resturant_start_time;?>" required />
                                                            <input class="form-control" type="hidden" name="resturanttime_id[]" value="<?php echo $i->resturanttime_id;?>" required />
                                                        </td> 
                                                        <td>
                                                            <input class="form-control" id="timepicker1<?php echo $j;?>" name="end_time[]" value="<?php echo $i->resturant_end_time;?>" required />
                                                          
                                                        </td>
                                                        <td><strong>+</strong></td>                                                  
                                                        <td>
                                                            <label class="switch s-primary  ">
                                                                <input type="checkbox" name="menu_hours[<?php echo $key; ?>]" value="0"  <?php if($i->resturant_close_time == '0'){echo 'checked';}?>>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                        $j++;
                                                        }                                                        
                                                        ?>                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                     </form>   
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