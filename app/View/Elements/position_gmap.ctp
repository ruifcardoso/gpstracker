
<div id="map-canvas" class="map-container"></div>

<script type="text/javascript">
	function initialize() {
		var pos = new google.maps.LatLng(<?php echo $position['Position']['lat']; ?>, <?php echo $position['Position']['long']; ?>);
		var mapOptions = {
		  zoom: 12,
		  center: pos
		};

		map = new google.maps.Map(document.getElementById('map-canvas'),
	      mapOptions);

  		var marker = new google.maps.Marker({
		    position: pos,
		    map: map
		});

		var infowindow = new google.maps.InfoWindow({
		      content: "<h5>Location details</h5> \
			      <b>Element:</b> <?php echo $position['Element']['description']; ?> <br> \
			      <b>Time:</b> <?php echo $position['Position']['time']; ?> <br> \
		    	  <b>Latitude: </b><?php echo $position['Position']['lat']; ?><br> \
		    	<b>Longetidude:</b> <?php echo $position['Position']['long']; ?> <br>"						      
		  });

		google.maps.event.addListener(marker, 'click', function() {
		    infowindow.open(map,marker);
		  });
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
