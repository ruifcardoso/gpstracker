<div class="positions index">
	<h2><?php echo __('Positions'); ?></h2>
  	<table class="table table-hover text-center">
	<thead>
	<tr>	
			<th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('element_id'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('lat'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('long'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('address'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions text-center"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($positions as $position): ?>
	<tr>
		<td><?php echo h($position['Position']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($position['Position']['element_id'], array('controller' => 'elements', 'action' => 'view', $position['Position']['element_id'])); ?>
		</td>
		<td><?php echo h($position['Position']['time']); ?>&nbsp;</td>
		<td><?php echo h($position['Position']['lat']); ?>&nbsp;</td>
		<td><?php echo h($position['Position']['long']); ?>&nbsp;</td>
		<td><?php echo h($position['Position']['address']); ?>&nbsp;</td>
		<td><?php echo h($position['Position']['created']); ?>&nbsp;</td>
		<td><?php echo h($position['Position']['modified']); ?>&nbsp;</td>
	 	<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $position['Position']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $position['Position']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $position['Position']['id']), array(), __('Are you sure you want to delete # %s?', $position['Position']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Position'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Elements'), array('controller' => 'elements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Element'), array('controller' => 'elements', 'action' => 'add')); ?> </li>
	</ul>
</div>
