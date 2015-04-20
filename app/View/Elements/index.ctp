<div class="elements index">
	<h2><?php echo __('Elements'); ?></h2>
  	<table class="table table-hover text-center">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('IMEI'); ?></th>
			<th><?php echo $this->Paginator->sort('phonenumber'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('symbol'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($elements as $element): ?>
	<tr>
		<td><?php echo h($element['Element']['id']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['description']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['IMEI']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['phonenumber']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['color']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['symbol']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['created']); ?>&nbsp;</td>
		<td><?php echo h($element['Element']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $element['Element']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $element['Element']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $element['Element']['id']), array(), __('Are you sure you want to delete # %s?', $element['Element']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Element'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Positions'), array('controller' => 'positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Position'), array('controller' => 'positions', 'action' => 'add')); ?> </li>
	</ul>
</div>
