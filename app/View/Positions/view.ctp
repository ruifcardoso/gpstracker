<?php echo $this->element('bottomheader'); 
?>
<div class="view-container">
	<div class="row">
		<div class="col-md-3">
			<h2 id="view-description-title"><i class="fa fa-cube"></i>
			 Position </h2>
			<dl class="view-description-list">
				<dt>Id: </dt>
				<dd><?php echo h($position['Position']['id']); ?></dd>
				<dt>Element Name: </dt>
				<dd> <?php echo $this->Html->link($position['Element']['description'],
					 array('controller' => 'elements', 'action' => 'view', $position['Position']['element_id'])); ?></dd>
				<dt>Measure Time: </dt>
				<dd><?php echo h($position['Position']['time']); ?></dd>
				<dt>Speed: </dt>
				<dd><?php echo h($position['Position']['speed']); ?></dd>
				<dt>Latitude: </dt>
				<dd><?php echo h($position['Position']['lat']); ?></dd>
				<dt>Longitude: </dt>
				<dd><?php echo h($position['Position']['long']); ?></dd>
				<dt>Address</dt>
				<dd><?php echo h($position['Position']['address']); ?></dd>
				<dt>Created</dt>
				<dd><?php echo h($position['Position']['created']); ?></dd>
				<dt>Modified</dt>
				<dd><?php echo h($position['Position']['modified']); ?></dd>
			</dl>
		</div>
		<div class="col-md-9">
		<h2 id="view-description-title"><i class="fa fa-globe"></i>
			 Map </h2>
			 	<?php echo $this->element ( 'position_gmap' );?>
		</div>
	</div>
</div>
<script>

</script>