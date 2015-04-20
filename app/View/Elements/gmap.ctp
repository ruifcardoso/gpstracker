
<div id="map-canvas" class="map-container"></div>

<?php 

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

header("Content-type: text/xml");

foreach ($listPositions as $position){
	// ADD TO XML DOCUMENT NODE
	$node = $dom->createElement("marker");
	$newnode = $parnode->appendChild($node);
	$newnode->setAttribute("name",$position['Position']['id']);
	$newnode->setAttribute("address", "");
	$newnode->setAttribute("lat", $position['Position']['lat']);
	$newnode->setAttribute("lng", $position['Position']['long']);
	$newnode->setAttribute("type", "");
	echo "ahoy";
}

$exemplo = $dom->saveXML();

?>
<script type="text/javascript">
function initialize() {
	  var mapOptions = {
	    zoom: 12,
	    //center: new google.maps.LatLng(-34.397, 150.644)
	  };

	  var map = new google.maps.Map(document.getElementById('map-canvas'),
	      mapOptions);

	  if(navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
		      var pos = new google.maps.LatLng(position.coords.latitude,
		                                       position.coords.longitude);

		      /*var infowindow = new google.maps.InfoWindow({
		        map: map,
		        position: pos,
		        content: 'Location found using HTML5.'
		      });*/

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

	function test(data) {
		  var xml = "<?php echo $exemplo; ?>";
		  console.log(xml);
		  var markers = xml.documentElement.getElementsByTagName("marker");
		  for (var i = 0; i < markers.length; i++) {
		    var name = markers[i].getAttribute("name");
		    var address = markers[i].getAttribute("address");
		    var type = markers[i].getAttribute("type");
		    var point = new google.maps.LatLng(
		        parseFloat(markers[i].getAttribute("lat")),
		        parseFloat(markers[i].getAttribute("lng")));
		    var html = "<b>" + name + "</b> <br/>" + address;
		    var icon = customIcons[type] || {};
		    var marker = new google.maps.Marker({
		      map: map,
		      position: point,
		      icon: icon.icon
		    });
		    bindInfoWindow(marker, map, infoWindow, html);
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
