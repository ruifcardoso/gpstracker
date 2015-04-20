<div class="row">
	<div class="col-md-6 col-md-offset-3">
	
	<?php
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
?>
	   <?= $this->GoogleMap->map($map_options); ?>
	
	
	<?php //echo $this->element('gmap'); ?>

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
					<tr>
        <?php foreach($listPositions as $position){?>
          <th class="text-center" scope="row"><?php echo $position['Position']['id']?> </th>
						<td><?php echo $position['Position']['lat']?> </td>
						<td><?php echo $position['Position']['long']?> </td>
						<td><?php echo $position['Position']['time']?> </td>
					</tr>
					
			<?php   $marker_options = array(
				    'showWindow' => true,
				    'windowText' => "Time: " . $position['Position']['time'],
				    'markerTitle' => 'Id: ' . $position['Position']['id'] );
          		echo $this->GoogleMap->addMarker("map_canvas", 1,
         		 array('latitude'=> $position['Position']['lat'], 'longitude' => $position['Position']['long']), $marker_options);
		         
          }?>
      </tbody>
			</table>
		</div>

	</div>
</div>