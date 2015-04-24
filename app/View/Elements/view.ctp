<?php echo $this->element('bottomheader'); 
?>
<div class="view-container">
	<div class="row">
		<div class="col-md-3">
			<h2 id="view-description-title"><i class="fa fa-cube"></i>
			 Element</h2>
			<dl class="view-description-list">
				<dt>Id</dt>
				<dd><?php echo h($element['Element']['id']); ?></dd>
				<dt>Description</dt>
				<dd><?php echo h($element['Element']['description']); ?></dd>
				<dt>IMEI</dt>
				<dd><?php echo h($element['Element']['IMEI']); ?></dd>
				<dt>Phonenumber</dt>
				<dd><?php echo h($element['Element']['phonenumber']); ?></dd>
				<dt>Color</dt>
				<dd><?php echo h($element['Element']['color']); ?></dd>
				<dt>Symbol</dt>
				<dd><?php echo h($element['Element']['symbol']); ?></dd>
				<dt>Created</dt>
				<dd><?php echo h($element['Element']['created']); ?></dd>
				<dt>Modified</dt>
				<dd><?php echo h($element['Element']['modified']); ?></dd>
			</dl>
		</div>
		<div class="col-md-9">
			<h2 id="view-description-title"><i class="fa fa-map-marker"></i>
			 Last Positions</h2>
<?php if (!empty($element['Position'])): ?>
<table class="table table-hover text-center view-table">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Address</th>
					<th class="text-center">Time</th>
					<th class="text-center">Speed</th>
					<th class="text-center">Lat</th>
					<th class="text-center">Long</th>
					<th class="actions text-center"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
	<?php foreach ($element['Position'] as $position): ?>
		<tr data-href="#rowposition" data-id="<?php echo $position['id']; ?>">
						<td><?php echo $position['id']; ?></td>
						<td><?php echo $position['address']; ?></td>
						<td><?php echo $position['time']; ?></td>
						<td><?php echo $position['speed']; ?></td>
						<td><?php echo $position['lat']; ?></td>
						<td><?php echo $position['long']; ?></td>
						<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'positions', 'action' => 'view', $position['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'positions', 'action' => 'edit', $position['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'positions', 'action' => 'delete', $position['id']), array(), __('Are you sure you want to delete # %s?', $position['id'])); ?>
			</td>
					</tr>
	<?php endforeach; ?>
	</tbody>
			</table>
<?php endif; ?>
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
            	window.location = "/positions/view/" + $(this).data("id");
            }
        );
    });
});
</script>