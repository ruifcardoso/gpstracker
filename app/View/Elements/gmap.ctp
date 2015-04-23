
<div id="map-canvas" class="map-container"></div>

<script type="text/javascript">
	function initialize() {
	  var mapOptions = {
	    zoom: 12,
	    //center: new google.maps.LatLng(-34.397, 150.644)
	  };

	  map = new google.maps.Map(document.getElementById('map-canvas'),
	      mapOptions);



      //add databse locations
		<?php foreach($listPositions as $position){ ?>
		var location = new google.maps.LatLng(<?php echo $position['Position']['lat']; ?>, <?php echo $position['Position']['long']; ?>);
	
		var marker = new google.maps.Marker({
		    position: location,
		    map: map
		});
			
	<?php } ?>
	  if(navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
		      var pos = new google.maps.LatLng(position.coords.latitude,
		                                       position.coords.longitude);

		      var infowindow = new google.maps.InfoWindow({
		        map: map,
		        position: pos,
		        content: 'Your current location.'
		      });

		      var marker = new google.maps.Marker({
				    position: pos,
				    title:"My position",
				    map: map,
				});

		      map.setCenter(pos);

		    }, function() {
		      handleNoGeolocation(true);
		    });
		} else {
		    // Browser doesn't support Geolocation
		    handleNoGeolocation(false);
		 }

	  function handleNoGeolocation(errorFlag) {
		  if (errorFlag) {
		    var content = 'Error: The Geolocation service failed.';
		  } else {
		    var content = 'Error: Your browser doesn\'t support geolocation.';
		  }

		  var options = {
		    map: map,
		    position: new google.maps.LatLng(38.73694, -9.14268),
		    //content: content
		  };

		  //var infowindow = new google.maps.InfoWindow(options);
		  map.setCenter(options.position);
		}
	}
	
	function loadScript() {
	  var script = document.createElement('script');
	  script.type = 'text/javascript';
	  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
	      '&signed_in=true&callback=initialize&key=AIzaSyA2qRHzucl2AdPl1LaPh100e9IlDOvlZjE';
      
	  document.body.appendChild(script);

	}

	window.onload = loadScript;
</script>
