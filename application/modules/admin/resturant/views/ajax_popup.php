    <?php //echo '<pre>';print_r($data);exit;
        
        /*--status: Order Placed--*/
     ?>
            <div class="modal-header">
                <button type="button" class="close" onclick="closeorder<?php echo $title;?>" data-dismiss="modal">&times;</button>
                <div class="d-flex">
                    <img src="<?php echo base_url()."upload/resturants/".$data['resturant_logo_image']?>" width="40px" height="40px" /> 
                    <p class="mt-2 ml-1"> <?php echo $data['resturant_given_Id'];?></p>
                </div>
                <p>
                    <strong>Time: </strong><?php echo date("H:i a", strtotime($data['resturant_created_on']));?><br>
                    <strong>Date: </strong><?php echo date("D-M-Y", strtotime($data['resturant_created_on']));?>
                </p>
                <svg id="Capa_1" enable-background="new 0 0 512 512" height="45" viewBox="0 0 512 512" width="45" xmlns="http://www.w3.org/2000/svg"><g><path d="m437 129h-14v-54c0-41.355-33.645-75-75-75h-184c-41.355 0-75 33.645-75 75v54h-14c-41.355 0-75 33.645-75 75v120c0 41.355 33.645 75 75 75h14v68c0 24.813 20.187 45 45 45h244c24.813 0 45-20.187 45-45v-68h14c41.355 0 75-33.645 75-75v-120c0-41.355-33.645-75-75-75zm-318-54c0-24.813 20.187-45 45-45h184c24.813 0 45 20.187 45 45v54h-274zm274 392c0 8.271-6.729 15-15 15h-244c-8.271 0-15-6.729-15-15v-148h274zm89-143c0 24.813-20.187 45-45 45h-14v-50h9c8.284 0 15-6.716 15-15s-6.716-15-15-15h-352c-8.284 0-15 6.716-15 15s6.716 15 15 15h9v50h-14c-24.813 0-45-20.187-45-45v-120c0-24.813 20.187-45 45-45h362c24.813 0 45 20.187 45 45z"/><path d="m296 353h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m296 417h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m128 193h-48c-8.284 0-15 6.716-15 15s6.716 15 15 15h48c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></g></svg>
             </div> 
            <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class=" box-shw">  
                     <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo base_url()."upload/resturants/".$data['resturant_image']?>" width="100" height="100"  class="img-responsive"/>
                        </div>
                        <div class="col-md-10">
                        <p class="ml-3"><strong>Restaurant Name : </strong><?php echo $data['resturant_name'];?></p>
                            <p class="ml-3"><strong>Restaurant Rating : </strong><?php echo $data['resturant_rating'];?></p>
                            <p class="ml-3"><strong>Restaurant Discount :</strong><?php echo $data['resturant__discount'];?></p>
                        </div>         
                     </div>
                   </div>          
                </div>
                 <div class="col-sm-12 mb-3">
                    <div class=" box-shw">  
                         <div class="row">
                             <div class="col-md-12 d-flex mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <h5 class="ml-2">Restaurant Details :</h5>
                            </div> 
                            <div class="col-md-4">
                                 <h6 class="">Phone Number :<?php echo $data['resturant_contact_no'];?></h6>
                            </div>                       
                            <div class="col-md-4">
                                 <h6 class="">Restaurant Area :<?php echo $data['resturant_area'];?></h6>
                            </div>                       
                            <div class="col-md-4">
                                 <h6 class="">Restaurant Block :<?php echo $data['resturant_block'];?></h6>
                            </div>
                             <div class="col-md-4">
                                 <h6 class="">Restaurant Street :<?php echo $data['resturant_street'];?></h6>
                            </div>
                             <div class="col-md-4">
                                 <h6 class="">Restaurant Jaada :<?php echo $data['resturant_jaada'];?></h6>
                            </div>
                             <div class="col-md-4">
                                 <h6 class="">Restaurant House :<?php echo $data['resturant_house'];?></h6>
                            </div>
                             <div class="col-md-4">
                                 <h6 class="">Restaurant Building :<?php echo $data['resturant_building'];?></h6>
                            </div>
                             <div class="col-md-4">
                                 <h6 class="">Restaurant House :<?php echo $data['resturant_house'];?></h6>
                            </div>
                            <div class="col-md-4">
                                 <h6 class="">Restaurant Landmark :<?php echo $data['resturant_landmark'];?></h6>
                            </div>
                            
                        </div>                     
                       
                    </div>                 
                </div>
                 
              
               
               
    <?php  ?>
    