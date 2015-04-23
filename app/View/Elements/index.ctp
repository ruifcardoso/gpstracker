<?php echo $this->element('elementsheader'); ?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h2><?php echo __('Elements'); ?></h2>
		<table class="table table-hover text-center">
			<thead>
				<tr>
					<th class='text-center'><?php echo $this->Paginator->sort('id'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('description'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('IMEI'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('phonenumber'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('color'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('symbol'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('created'); ?></th>
					<th class='text-center'><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="text-center actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($elements as $element): ?>
	<tr data-href="#rowposition" data-id="<?php echo $element['Element']['id']; ?>">
					<td><?php echo h($element['Element']['id']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['description']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['IMEI']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['phonenumber']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['color']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['symbol']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['created']); ?>&nbsp;</td>
					<td><?php echo h($element['Element']['modified']); ?>&nbsp;</td>
					<td class="actions">
			<?php echo $this->Html->link('<i class="fa fa-search"></i>', array('action' => 'view', $element['Element']['id']), array('title'=>'View detailed information','id' => 'table-actions','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>', array('action' => 'edit', $element['Element']['id']), array('title'=>'Edit element','id' => 'table-actions','escape'=>false)); ?>
			<?php echo $this->Form->postLink('<i class="fa fa-times"></i>', array('action' => 'delete', $element['Element']['id']), array('title'=>'Delete element','id' => 'table-actions','escape'=>false), __('Are you sure you want to delete # %s?', $element['Element']['id'])); ?>
		</td>
				</tr>
<?php endforeach; ?>
	</tbody>
		</table>
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
            	window.location = "/elements/view/" + $(this).data("id");
            }
        );
    });
});
</script>
