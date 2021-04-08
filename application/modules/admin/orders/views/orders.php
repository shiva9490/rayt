       
<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'today')">Today Orders</button>
  <button class="tablinks" onclick="openCity(event, 'una')">Unassigned Orders</button>
  <button class="tablinks" onclick="openCity(event, 'pen')">Pending Orders</button>
  <button class="tablinks" onclick="openCity(event, 'pen')">Received Orders</button>
  <button class="tablinks" onclick="openCity(event, 'pen')">Ready for Pickup</button>
  <button class="tablinks" onclick="openCity(event, 'pen')">Completed Pickup</button>
  <button class="tablinks" onclick="openCity(event, 'pen')">Arraived at customer</button>
  <button class="tablinks" onclick="openCity(event, 'pen')">Delivered</button>
  
</div>
<div id="today" class="tabcontent" style="display:block;">
  <div class="col-md-12 mt-3">
     <div class="row">
         <div class="col-md-6">
             <h4>Orders</h4>
         </div>
         <div class="col-md-6">
         <a href="<?php echo base_url('Admin/Create-Orders');?>" class="btn b-success mx-2 ">+ New</a>
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
                <th class="fonn"><a href="#">00013 <i class="fa fa-clone" aria-hidden="true"></i></a></th>
                <td>online</td>
                <td>18/03/21</td>
                <td>Order Placed</td>
                <td>5.5</td>
                <td>Cash</td>
                <td>-</td>
                <td>Kuwait Resturant</td>
                <td>sharq</td>
                <td></td>
                <td>-</td>
                <td>-</td>
                <td>0</td>
        </tr>
                    
      </tbody>
    </table>
  </div>      

</div>

<div id="una" class="tabcontent">
      <div class="col-md-12 mt-3">
     <div class="row">
         <div class="col-md-6">
             <h4>Orders</h4>
         </div>
         <div class="col-md-6">
          <a href="<?php echo base_url('Admin/Create-Orders');?>" class="btn b-success mx-2 ">+ New</a>
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
                <th class="fonn"><a href="#">00013 <i class="fa fa-clone" aria-hidden="true"></i></a></th>
                <td>online</td>
                <td>18/03/21</td>
                <td>Order Placed</td>
                <td>5.5</td>
                <td>Cash</td>
                <td>-</td>
                <td>Kuwait Resturant</td>
                <td>sharq</td>
                <td></td>
                <td>-</td>
                <td>-</td>
                <td>0</td>
        </tr>
                    
      </tbody>
    </table>
  </div>     
</div>

<div id="pen" class="tabcontent">
      <div class="col-md-12 mt-3">
     <div class="row">
         <div class="col-md-6">
             <h4>Orders</h4>
         </div>
         <div class="col-md-6">
          <a href="<?php echo base_url('Admin/Create-Orders');?>" class="btn b-success mx-2 ">+ New</a>
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
                <th class="fonn"><a href="#">00013 <i class="fa fa-clone" aria-hidden="true"></i></a></th>
                <td>online</td>
                <td>18/03/21</td>
                <td>Order Placed</td>
                <td>5.5</td>
                <td>Cash</td>
                <td>-</td>
                <td>Kuwait Resturant</td>
                <td>sharq</td>
                <td></td>
                <td>-</td>
                <td>-</td>
                <td>0</td>
        </tr>
                    
      </tbody>
    </table>
  </div>     
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
        