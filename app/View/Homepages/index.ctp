<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<?php 
	echo $this->element('gmap');
	
	/*
  // Override any of the following default options to customize your map
  $map_options = array(
    'id' => 'map_canvas',
    'height' => '600px',
    'style' => '',
    'zoom' => 10,
  	'localize' => true,
    'type' => 'HYBRID',
    'draggableMarker' => false
  );

	   echo $this->GoogleMap->map($map_options); */?>
	
	

<div class="table-responsive table-container">
			<h4>Detailed localization</h4>
			<table class="table table-hover text-center">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Latitude</th>
						<th class="text-center">Longetitude</th>
						<th class="text-center">Time</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($listPositions as $index=>$position){?>
				
					<tr data-href="#rowposition" data-id="<?php echo $index; ?>">
          				<td id="id"><?php echo $position['Position']['id']?></td>
						<td id="lat"><?php echo $position['Position']['lat']?> </td>
						<td id="lng"><?php echo $position['Position']['long']?> </td>
						<td><?php echo $position['Position']['time']?> </td>
					</tr>
          <?php }?>
          
          
      </tbody>
			</table>
		</div>

	</div>
</div>

<script>
$(function(){
    $('.table tr[data-href]').each(function(){
        $(this).css('cursor','pointer').hover(
            function(){ 
                $(this).addClass('active'); 
            },  
            function(){ 
                $(this).removeClass('active'); 
            }).click( function(){ 
                
                console.log($(this).children("td#lat").html());
                var pos = new google.maps.LatLng($(this).children("td#lat").html(),$(this).children("td#lng").html());
  		        map.setCenter(pos);
	  		    $('html, body').animate({
	  		        scrollTop: $("#map-canvas").offset().top - 100
	  		    }, 500);
            }
        );
    });
});
</script>