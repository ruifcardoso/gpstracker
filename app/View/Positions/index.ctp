<?php echo $this->element('bottomheader'); ?>


<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="form-group">
		    <label>Element name search</label>
		    <input type="text" class="form-control" id="searchTxt" placeholder="Search by element name...">
	  	</div>
  
		<h2><?php echo __('Positions'); ?></h2>
		<table class="table table-hover text-center">
			<thead>
				<tr>
					<th class="text-center"><?php echo $this->Paginator->sort('id',
							'Id &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('element_id',
							'Element &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('time',
							'Time &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('speed',
							'Speed &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('lat',
							'Lat &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('long',
							'Lng &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('address',
							'Address &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('created',
							'Created &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="text-center"><?php echo $this->Paginator->sort('modified',
							'Modified &nbsp;<i class="fa fa-sort"></i>', array('escape'=>false));?> </th>
					<th class="actions text-center"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody id="table-body">
	<?php foreach ($positions as $position): ?>
	<tr data-href="#rowposition" data-id="<?php echo $position['Position']['id']; ?>">
					<td><?php echo h($position['Position']['id']); ?>&nbsp;</td>
					<td>
			<?php echo $this->Html->link($position['Element']['description'], array('controller' => 'elements', 'action' => 'view', $position['Position']['element_id'])); ?>
		</td>
					<td><?php echo h($position['Position']['time']); ?>&nbsp;</td>
					<td><?php echo h($position['Position']['speed']); ?>&nbsp;</td>
					<td><?php echo h($position['Position']['lat']); ?>&nbsp;</td>
					<td><?php echo h($position['Position']['long']); ?>&nbsp;</td>
					<td><?php echo h($position['Position']['address']); ?>&nbsp;</td>
					<td><?php echo h($position['Position']['created']); ?>&nbsp;</td>
					<td><?php echo h($position['Position']['modified']); ?>&nbsp;</td>
					<td class="actions">
			<?php echo $this->Html->link('<i class="fa fa-search"></i>', array('action' => 'view', $position['Position']['id']), array('title'=>'View detailed information','id' => 'table-actions','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>', array('action' => 'edit', $position['Position']['id']), array('title'=>'Edit element','id' => 'table-actions','escape'=>false)); ?>
			<?php echo $this->Form->postLink('<i class="fa fa-times"></i>', array('action' => 'delete', $position['Position']['id']), array('title'=>'Delete element','id' => 'table-actions','escape'=>false), __('Are you sure you want to delete # %s?', $position['Position']['id'])); ?>
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
    $('#searchTxt').keyup(function () {
        //console.log($(this).val());
    	searchElement($(this).val());
    });

	function searchElement (txt){
		//console.log(txt);
		//console.log("<?php echo Router::url(array('controller' => 'positions', 'action' => 'searchElement')); ?>");
		$.ajax({
		    url: "<?php echo Router::url(array('controller' => 'positions', 'action' => 'searchElement')); ?>",
		    //dataType: "jsonp",
	        //contentType:    'application/json',
	        data: {
	            name: txt
	        },
	        success: function( data ) {
		        var json = JSON.parse(data);
		        $('#table-body').html("");
		        
		        //$('#table-body').para().replaceWith(
		        json.forEach(function (entry){
			        addPosition(entry)});
		        //data.position
		     },error: function (jqxhr,textStatus,errorThrown) {
		    	 console.log(jqxhr);
                 console.log(textStatus);
                 console.log(errorThrown);    
		       }
		});
	}

	function addPosition(position){
        //$('#table-body').html("<tr><td id='someid'>I am here</td><td>asdsad</td></tr>");
		
		$('tr:first').after("<tr><td id='someid'>I am here</td><td>asdsad</td></tr>");
	}
	
});
</script>
