    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="mail-box-container">                                     
                    <div id="todo-inbox" class="accordion todo-inbox">
                        <div class="card">
                            <input type="hidden" id="inc" value="0"></input>
                            <form class="validform" method="post" enctype="multipart/form-data">
                                <div class="col-md-12 mt-5">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                							<a href="<?php echo adminurl('Zones');?>" class="btn btn-danger"> Cancel</a>
                							<button type="submit" class="btn btn-primary publish" name="publish" disabled value="publish">publish</button>
                						</div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <input  class="form-control zoneName" data-value="0" type="text" onkeyup="zonename()" name="zoneName" Placeholder="Zone Name..." style="margin-bottom: 15px;">
                                             <div class="invalid-feedback error-zone"></div>
                                            <div id="map"  style="width: 100%; height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <div class="row old-row">
                                                <div class="col-md-1">
                                                    <label></label><br>
                                                    <span>1</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Latitude</label>
                                                    <input type="text" data-value="1" class="form-control" id="lat0">
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Longitude</label>
                                                    <input type="text" class="form-control" id="lng0">
                                                </div>
                                                <div class="col-md-1">
                                                    <label></label><br>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                </div>
                                            </div>
                                            <div class="newlag"></div>
                                        </div>
                                    </div>
                                </div>
                            </form><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQVAY-NPqya0WVfPwhngHu98Lsrx8-xtk&callback=initMap"
      async
    ></script>
    <script type="text/javascript">
        window.onload = function () {
            var i = 0;
            var mapOptions = {
                center: new google.maps.LatLng(29.378586, 47.990341),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
                
                if(lag(e.latLng.lat(),e.latLng.lng()) == true){
                    i++;
                    document.getElementById('inc').value = i;
                    const image ="<?php echo base_url();?>assets/images/markers/"+document.getElementById('inc').value+".png";
                    const beachMarker = new google.maps.Marker({
                        position: { lat: e.latLng.lat(), lng: e.latLng.lng() },
                        map,
                        icon: image,
                    });
                }
            });
        }
    </script>
