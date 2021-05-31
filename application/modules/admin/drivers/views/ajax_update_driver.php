    
    <div id="map" style="width: 100%; height: 350px;">
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe-HPCsy9e136sYKeO549pu3Zj8GytkXI&callback=initMap&libraries=&v=weekly"
      async
    ></script>
	<script>
		function initMap(){
		    const map = new google.maps.Map(document.getElementById("map"), {
		    	zoom: 12,
		    	center: {lat: 29.378586, lng: 47.990341},
		    });
		    const image =
		    	"<?php echo base_url().'assets/images/markers/bike_brown.png';?>";
		    const beachMarker = new google.maps.Marker({
		    	position: { lat: <?php echo $point['driver_address_latitude'];?>, lng: <?php echo $point['driver_address_longitude'];?> },
		    	map,
		    	icon: image,
		    });
		}
	</script>
    