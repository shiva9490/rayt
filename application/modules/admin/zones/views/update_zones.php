<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<div class="col-md-12 mt-5">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <input  class="form-control zoneName" type="text" name="" value="<?php echo $view['zone_name'];?>" Placeholder="Zone Name..."><br>
                <div id="map" data-value="0" style="width: 100%; height: 350px;">
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-5">
        <div class="row">
            <div class="col-md-11 mx-auto">
                
                <?php 
                    if(is_array($zone_list) && count($zone_list) >0){
                        $i=1;
                        foreach($zone_list as $key=>$ze){
                ?>
                <div class="row">
                    <div class="col-md-1">
                        <label></label><br>
                        <span><?php echo $i;?></span>
                    </div>
                    <div class="col-md-5">
                        <label>Latitude</label>
                        <input type="text" data-value="1" class="form-control" value="<?php echo $ze->zonelist_lat;?>" id="lat<?php echo $key;?>">
                    </div>
                    <div class="col-md-5">
                        <label>Longitude</label>
                        <input type="text" class="form-control" value="<?php echo $ze->zonelist_lng;?>" id="lng<?php echo $key;?>">
                    </div>
                    <div class="col-md-1">
                        <label></label><br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </div>
                </div>
                <?php $i++;}
                }
                ?>
                <div class="newlag"></div>
            </div>
        </div>
    </div>
    
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQVAY-NPqya0WVfPwhngHu98Lsrx8-xtk&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    
    <script>
        // This example creates a simple polygon representing the Bermuda Triangle.
        // When the user clicks on the polygon an info window opens, showing
        // information about the polygon's coordinates.
        let map;
        let infoWindow;
        
        function initMap() {
          map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: { lat: 29.378586, lng: 47.990341},
            mapTypeId: "terrain",
          });
          <?
          if(is_array($zone_list) && count($zone_list) >0){
            $da = array();$i=1;
            foreach($zone_list as $key=>$ze){
                $da[$key]['lat'] = $ze->zonelist_lat;
                $da[$key]['lng'] = $ze->zonelist_lng;
            }
            print_r($da[0]['lat']);
            $d = json_encode($da);
          }
          ?>
          // Define the LatLng coordinates for the polygon.
          const triangleCoords = [
           <?
          if(is_array($zone_list) && count($zone_list) >0){
            $da = array();$i=1;
            foreach($zone_list as $key=>$ze){
        ?>
            { lat: <?php echo $ze->zonelist_lat;?>, lng: <?php echo $ze->zonelist_lng;?>},
        <?php }
          }
            ?>
          ];
          // Construct the polygon.
          const bermudaTriangle = new google.maps.Polygon({
            paths: triangleCoords,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
          });
          bermudaTriangle.setMap(map);
          // Add a listener for the click event.
          bermudaTriangle.addListener("click", showArrays);
          infoWindow = new google.maps.InfoWindow();
        }
        
        function showArrays(event) {
          // Since this polygon has only one path, we can call getPath() to return the
          // MVCArray of LatLngs.
          const polygon = this;
          const vertices = polygon.getPath();
          let contentString =
            "<b>Bermuda Triangle polygon</b><br>" +
            "Clicked location: <br>" +
            event.latLng.lat() +
            "," +
            event.latLng.lng() +
            "<br>";
        
          // Iterate over the vertices.
          for (let i = 0; i < vertices.getLength(); i++) {
            const xy = vertices.getAt(i);
            contentString +=
              "<br>" + "Coordinate " + i + ":<br>" + xy.lat() + "," + xy.lng();
          }
          // Replace the info window's content and position.
          infoWindow.setContent(contentString);
          infoWindow.setPosition(event.latLng);
          infoWindow.open(map);
        }
    </script>
    <script type="text/javascript">
        /*window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(29.378586, 47.990341),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
                 lag(e.latLng.lat(),e.latLng.lng());
                //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
                //document.getElementById("lat").value = e.latLng.lat();
                //document.getElementById("lng").value = e.latLng.lng();
            });
        }*/
    </script>
    