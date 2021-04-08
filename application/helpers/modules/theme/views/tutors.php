<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" title="Return to home">Home</a>
                            </div>
                        </li>
                        <li>/ <?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
    </style>
     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAagIQ2S_BegRfAh8Dqm2DvV8RvRBaYzSk&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
              center: { lat: -33.8688, lng: 151.2195 },
              zoom: 13,
        });
        const card = document.getElementById("pac-card");
        const input = document.getElementById("pac-input");
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
        const autocomplete = new google.maps.places.Autocomplete(input);
        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo("bounds", map);
        // Set the data fields to return when the user selects a place.
        autocomplete.setFields([
              "address_components",
              "geometry",
              "icon",
              "name",
        ]);
        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById("infowindow-content");
        infowindow.setContent(infowindowContent);
        const marker = new google.maps.Marker({
          map,
          anchorPoint: new google.maps.Point(0, -29),
        });
        autocomplete.addListener("place_changed", () => {
          infowindow.close();
          marker.setVisible(false);
          const place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert(
              "No details available for input: '" + place.name + "'"
            );
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          let address = "";
          if (place.address_components) {
            address = [
              (place.address_components[0] &&
                place.address_components[0].short_name) ||
                "",
              (place.address_components[1] &&
                place.address_components[1].short_name) ||
                "",
              (place.address_components[2] &&
                place.address_components[2].short_name) ||
                "",
            ].join(" ");
          }
          infowindowContent.children["place-icon"].src = place.icon;
          infowindowContent.children["place-name"].textContent = place.name;
          infowindowContent.children["place-address"].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          const radioButton = document.getElementById(id);
          radioButton.addEventListener("click", () => {
                autocomplete.setTypes(types);
          });
        }
        setupClickListener("changetype-all", []);
        setupClickListener("changetype-address", ["address"]);
        setupClickListener("changetype-establishment", ["establishment"]);
        setupClickListener("changetype-geocode", ["geocode"]);
        document.getElementById("use-strict-bounds").addEventListener("click", function () {
            console.log("Checkbox clicked! New state=" + this.checked);
            autocomplete.setOptions({ strictBounds: this.checked });
        });
    }
</script>                       
<!--
<div class="pac-card" id="pac-card">
    <div id="type-selector" class="pac-controls">
        <input type="radio" name="type" id="changetype-address" checked="checked"/>
    </div>
    <div id="pac-container">
        <input id="pac-input" type="text" placeholder="Enter a location" />
    </div>
</div>
<div id="map"></div>
<div id="infowindow-content">
    <img src="" width="16" height="16" id="place-icon" />
    <span id="place-name" class="title"></span><br />
    <span id="place-address"></span>
</div>
-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="single-aside pb-20">
                    <div class="aside-inner-wrapper">
                        <div class="aside-title aside-underline posr">
                            <h5>Search</h5>
                        </div>
                        <div class="aside-text">
                            <form method="" action="">
                                <div class="aside-input posr">
                                    <input type="text" placeholder="Skills" value="<?php echo $this->input->get("skills");?>" onkeyup="searchsubjects($(this))"/>
                                    <input type="hidden" name="skills" placeholder="Skills" value="<?php echo $this->input->get("skills");?>" id="search-id"/>
                                    <input type="text" name="locations" onfocus="valuelocations()" placeholder="Location" value="<?php echo $this->input->get("locations");?>"/>
                                    <div class="input-button">
                                        <button type="submit"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
                                    </div>
                                </div>	
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<section class="events-grid">
    <input type="hidden" id="FilterTextBox" name="skills" value="<?php echo $this->input->get("skills");?>"> 
    <input type="hidden" id="locations" class="locations" name="locations" value="<?php echo $this->input->get("locations");?>"> 
    <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
    <?php $this->load->view("admin/loader");?>   
    <div class="container postList">
    </div>
</section>
<script>
    function valuelocations(){
        alert("HI");
    }
</script>