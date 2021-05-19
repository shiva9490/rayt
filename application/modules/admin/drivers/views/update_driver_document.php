       
<?php
$sr     =   $this->session->userdata("active-deactive-driver");
$cr     =   $this->session->userdata("create-driver");
$ur     =   $this->session->userdata("update-driver");
$dr     =   $this->session->userdata("delete-driver");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   
    <?php } ?>
    <div class="col-lg-12">
      <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">Driver Image update</div>
                
                    <div class="col-md-6">
                    <a href="<?php echo adminurl('Add-Dri-Image-Doc/'.$view['driver_id']);?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">Add Images</a>
                    </div>
                 
                   
                </div>
            </div>
         <div class="card-body">
                    <!--  BEGIN CONTENT AREA  -->
            <div  class="main-content">
                <div class="layout-px-spacing">                
                        
                    <div class="account-settings-container layout-top-spacing">

                        <div class="account-content">
                            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <form action="" method="post" class="validform formssample forms-sample" id="role" novalidate=""  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">                                   
                                        <div  class="section general-info mb-4">
                                          <div class="info">
                                              <h6 class="">Legal Documents</h6>
                                              <div class="row">                                              
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="form">
                                                            <div class="row">
                                                                 <div class="col-md-12 m-3">
                                                                 <?php $this->load->view('admin/success_error');?>
                                                                    <table class="table b-g">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>S.No</th>
                                                                                <th>Image</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $n=1; foreach($images as $i){?>
                                                                            
                                                                            <tr>
                                                                            <td><?php echo $n;?></td> 
                                                                            <td><img src="<?php echo base_url($i->driver_images_path);?>" width="200px"/></td>
                                                                            <td>                                                                              
                                                                               <!-- <a href="<?php echo adminurl('Delete-Dri-Image-Doc/'.$i->driver_images_id);?>">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                                </a>                                                                            -->
                                                                                <?php  if($ur == '1'){?>
                                                                                <a href="<?php echo adminurl('Update-Dri-Image-Doc/'.$i->driver_images_id);?>">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                                </a>
                                                                                <?php } if($dr == '1'){?>
                                                                                 <a onclick="confirmationDelete($(this),'Driver')" data-toggle='tooltip' attrvalue="<?php echo adminurl('Delete-Dri-Image-Doc/'.$i->driver_images_id);?>" data-original-title="Delete country" class="text-danger">                                                                         
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                                </a>    
                                                                               
                                                            					<?php } ?>
                                                                            </td>
                                                                            </tr>
                                                                            <?php $n++; }?>
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
                                   
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  END CONTENT AREA  -->    
           
         </div>
      </div>
   </div>
</div>
