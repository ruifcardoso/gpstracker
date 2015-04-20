<div class="elements form">
<?php echo $this->Form->create('Element'); ?>
	<fieldset>
		<legend><?php echo __('Edit Element'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
		echo $this->Form->input('IMEI');
		echo $this->Form->input('phonenumber');
		echo $this->Form->input('color');
		echo $this->Form->input('symbol');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Element.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Element.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Elements'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Positions'), array('controller' => 'positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Position'), array('controller' => 'positions', 'action' => 'add')); ?> </li>
	</ul>
</div>
