<?php echo $this->element('bottomheader'); ?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h2><?php echo __('Elements'); ?></h2>
		<table class="table table-hover text-center">
			<thead>
				<tr>
					<th class='text-center'><?php echo $this->Paginator->sort('id',
							'Id &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('description',
							'Description &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('IMEI',
							'IMEI &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('phonenumber',
							'Phone Number &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('color',
							'Color &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('symbol',
							'Symbol &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('created',
							'Created &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class='text-center'><?php echo $this->Paginator->sort('modified',
							'Modified &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
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
	<p>
	<?php
	echo $this->Paginator->counter ( array (
			'format' => __ ( 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}' ) 
	) );
	?>	</p>
<?php if($this->Paginator->params['count'] > 1){?>
<nav>
  <ul class="pagination">
    <?php echo $this->Paginator->prev(__('<span aria-hidden="true">&laquo;</span>'), array('tag' => 'li', 'escape' => true),
    		 null,
    		 array('tag' => 'li','class' => 'disabled','disabledTag' => 'a', 'escape' => false));
    ?>
    <?php echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
    ?>
    <?php echo $this->Paginator->next(__('<span aria-hidden="true">&raquo;</span>'), array('tag' => 'li', 'escape' => false),
    		 null,
    		 array('tag' => 'li','class' => 'disabled','disabledTag' => 'a', 'escape' => false));
    ?>
  </ul>
</nav>
<?php }?>
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
