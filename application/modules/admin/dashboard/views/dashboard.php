<form method="POST" enctype="multipart/form-data" onsubmit="novalidate" name="myForm">
 
        <div class="container-fluid py-3 pt-4 bb-grey sticky">
          <div class="row">
            <div class="col-md-2">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </div>
            <div class="col-md-7">
              <h4><?php echo $title;?></h4>
            </div>
            
          </div>
        </div>
        <div class="container-fluid py-3 pt-4">
          <div class="row">
              <div class="col-md-7">
                  <div class="row">
                      <div class="col-md-12">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55628.845954578464!2d47.94684722837268!3d29.376060625233347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf9c83ce455983%3A0xc3ebaef5af09b90e!2sKuwait%20City%2C%20Kuwait!5e0!3m2!1sen!2sin!4v1617164926252!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                      </div>
                      <div class="col-md-6 p-3">
                           <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/res_pink.png" width="26px"/>
                              &nbsp;&nbsp;Resturants
                            </a><br><br>
                            <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_purple.png" width="26px"/>
                              &nbsp;&nbsp;Arraived at customer
                            </a><br><br>
                            <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_red.png" width="26px"/>
                              &nbsp;&nbsp;Ready for pickup
                            </a><br><br>
                            <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_green.png" width="26px"/>
                              &nbsp;&nbsp;free
                            </a><br><br>
                      </div>
                      <div class="col-md-6 p-3">
                          <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_pink.png" width="26px"/>
                              &nbsp;&nbsp;Driver
                            </a><br><br>
                            <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_black.png" width="26px"/>
                              &nbsp;&nbsp;Late for Resturant
                            </a><br><br>
                            <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_blue.png" width="26px"/>
                              &nbsp;&nbsp;Completed Pickup
                            </a><br><br>
                            <a href="#">
                              <img src="<?php echo $this->config->item('admin_assets');?>images/markers/bike_yellow.png" width="26px"/>
                              &nbsp;&nbsp;Driver idle
                            </a><br><br>
                      </div>
                  </div>
              </div>
              <div class="col-md-5">
                  <div class="form-group home_check">
                    <input type="checkbox" id="1" />
                    <label for="1">Resurants</label>
                    <input type="checkbox" id="2" />
                    <label for="2">Drivers</label>
                    <input type="checkbox" id="3"/>
                    <label for="3">Recived By Resturant</label>
                    <input type="checkbox" id="4" />
                    <label for="4">Ready for Pickup</label>
                    <input type="checkbox" id="5" />
                    <label for="5">Completed Pickup</label>
                    <input type="checkbox" id="6" />
                    <label for="6">Arrieved to Customer</label>
                    <input type="checkbox" id="7" />
                    <label for="7">Late for the Resturant(10mins or more) </label>
                    <input type="checkbox" id="8" />
                    <label for="8">Late for the Resturant(7mins or more) </label>
                    <input type="checkbox" id="9" />
                    <label for="9">Free</label>
                    <input type="checkbox" id="10" />
                    <label for="10">Driver idle (Log-out)</label>
                </div>
                
                  <hr>
                  
                  <h5>Orders</h5>
                  <div class="row">
                      <div class="col-md-6 fonn">
                         <a href="#" class="text-success ">
                            Total Delivered :<b>3</b>
                          </a><br>
                          <a href="#" class="text-success">
                            Total Assigned :3
                          </a><br>
                          <a href="#" class="text-danger">
                            Total Not Assigned :3
                          </a><br>
                          <a href="#" class="text-dark">
                            Total Ready For Pickup :3
                          </a><br>
                          <a href="#" class="text-dark">
                            Total Completed Pickup :3
                          </a><br>
                          <a href="#" class="text-dark">
                            Total Arrived At Customer :3
                          </a><br>
                          <a href="#" class="text-dark">
                            Total Unverified Address :3
                          </a><br>
                         
                      </div>
                      <div class="col-md-6 fonn">
                         <a href="#" class="text-success">
                            Total Available Drivers :3
                          </a><br>
                          <a href="#" class="text-success">
                            Total Available 30 mins :3
                          </a><br>
                          <a href="#" class="text-dark ">
                            Total Logged-in Drivers :3
                          </a><br>
                          <a href="#" class="text-dark">
                            Total Logged-out Drivers :3
                          </a><br>
                          <a href="#" class="text-dark ">
                            Total Pre-orders :3
                          </a><br>
                          <a href="#" class="text-dark ">
                            Total Scheduled Orders :3
                          </a><br>
                      </div>
                  </div>
                  
                  
              </div>
              <div class="col-md-12">
                  <button type="button" class="btn b-dark m-2"> Pending Orders</button>
                  <button type="button" class="btn b-dark m-2"> 30 mins delivery</button>
                  <button type="button" class="btn b-dark m-2"> 15-20 mins delivery</button>
                  <button type="button" class="btn b-dark m-2"> 45 mins delivery</button>
                  <button type="button" class="btn b-dark m-2"> Delivered Orders</button>
                  <button type="button" class="btn b-dark m-2"> Unassigned Orders</button>
                  <button type="button" class="btn b-dark m-2"> Order report</button>
              </div>
              <div class="col-md-12 mt-3">
                  <div class="row">
                      <div class="col-md-6">
                          <h4>Orders</h4>
                      </div>
                      <div class="col-md-6">
                         <button type="button" class="btn b-success mx-2">+ New</button>
                         <input type="text" class="form-control sear" placeholder="Search"><input type="submit" value="Search" class="btn b-dark py-1">
                      </div>
                  </div>
              </div>
              <div class="col-md-12 mt-3 t_div">
                  <table class="table b-g">
                  <thead>
                    <tr>
                      <th >Order Id</th>
                      <th scope="col">Order Type</th>
                      <th scope="col">Date</th>
                      <th scope="col">Order Status</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Payment Type</th>
                      <th scope="col">Driver</th>
                      <th scope="col">Resturant</th>
                      <th scope="col">Branch</th>
                      <th scope="col">Customer Location</th>
                      <th scope="col">ETA to Resturant</th>
                      <th scope="col">ETA to Customer</th>
                      <th scope="col">ETA Countdown</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>test</td>
                      <td>test</td>
                      <td></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
          </div>

        </div>
</form>