<div class="elements view">
<h2><?php echo __('Element'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($element['Element']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($element['Element']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IMEI'); ?></dt>
		<dd>
			<?php echo h($element['Element']['IMEI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phonenumber'); ?></dt>
		<dd>
			<?php echo h($element['Element']['phonenumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($element['Element']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Symbol'); ?></dt>
		<dd>
			<?php echo h($element['Element']['symbol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($element['Element']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($element['Element']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Element'), array('action' => 'edit', $element['Element']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Element'), array('action' => 'delete', $element['Element']['id']), array(), __('Are you sure you want to delete # %s?', $element['Element']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Elements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Element'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Positions'), array('controller' => 'positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Position'), array('controller' => 'positions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Positions'); ?></h3>
	<?php if (!empty($element['Position'])): ?>
  	<table class="table table-hover text-center">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Element Id'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th><?php echo __('Lat'); ?></th>
		<th><?php echo __('Long'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<tbody>
	<?php foreach ($element['Position'] as $position): ?>
		<tr>
			<td><?php echo $position['id']; ?></td>
			<td><?php echo $position['element_id']; ?></td>
			<td><?php echo $position['time']; ?></td>
			<td><?php echo $position['lat']; ?></td>
			<td><?php echo $position['long']; ?></td>
			<td><?php echo $position['address']; ?></td>
			<td><?php echo $position['created']; ?></td>
			<td><?php echo $position['modified']; ?></td>
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

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Position'), array('controller' => 'positions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
