<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<?php echo $this->element ( 'homepage_gmap' );?>
<div id="details-table" class="table-responsive table-container">
			<h4>Last localizations</h4>
			<table class="table table-hover text-center">
				<thead>
					<tr>
						<th class="text-center">Element</th>
						<th class="text-center">Speed</th>
						<th class="text-center">Latitude</th>
						<th class="text-center">Longetitude</th>
						<th class="text-center">Time</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($listPositions as $index=>$position){?>
				
					<tr data-href="#rowposition" data-id="<?php echo $index; ?>">
						<td><?php echo $position['tElement']['description']?></td>
						<td><?php echo $position['Position']['speed']?> </td>
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
                var pos = new google.maps.LatLng($(this).children("td#lat").html(),$(this).children("td#lng").html());
  		        map.panTo(pos);
	  		    $('html, body').animate({
	  		        scrollTop: $("#map-canvas").offset().top - 100
	  		    }, 500);
            }
        );
    });
});
</script>

