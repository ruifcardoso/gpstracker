<?php echo $this->element('bottomheader'); ?>


<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div id="search-index">
			<h2>Search</h2>
			<div class="col-md-6">
				<div class="form-group">
				    <label>By element name: </label>
				    <input type="text" class="form-control" id="searchTxt" placeholder="Search by element name...">
			  	</div>
		  	</div>
	  		<div class="col-md-6">
				<div class="form-group">
				    <label>By creation time: </label>
				    <input type="text" class="form-control" id="searchTime" placeholder="Search by creation date...">
			  	</div>
		  	</div>
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
    	searchElement("name",$(this).val());
    });

    	
    $('#searchTime').datetimepicker({
		format:'Y-m-d H:i:s',
    	lang:'en',
		onChangeDateTime:function(dp,$input){
			console.log($input.val());
			searchElement("time",$input.val());
		} 
    });

	function searchElement (type,txt){
		console.log(txt);
		$.ajax({
		    url: "<?php echo Router::url(array('controller' => 'positions', 'action' => 'searchElement')); ?>",
	        data: {
		        type: type,
	            txt: txt
	        },
	        success: function( data ) {
		        var json = JSON.parse(data);
		        var content = "";
		        json.forEach(function (entry){
			        content += addRow(entry)});
		        $('#table-body').html(content);
		     },error: function (jqxhr,textStatus,errorThrown) {
		    	 console.log(jqxhr);
                 console.log(textStatus);
                 console.log(errorThrown);    
		       }
		});
	}

	function addRow(position){
        var entry = "<tr data-href='#rowposition' data-id='+ position['Position']['id'] +'> \
            <td>" + position['Position']['id'] +"&nbsp;</td> \
            <td><a href='/positions/view/" + position['Position']['element_id'] + "' title='View element information'</a>" + position['Element']['description'] +"&nbsp;</td> \
            <td>" + position['Position']['time'] +"&nbsp;</td> \
			<td>" + position['Position']['speed'] + " &nbsp;</td> \
			<td>" + position['Position']['lat'] + "&nbsp;</td> \
			<td>" + position['Position']['long'] + "&nbsp;</td> \
			<td>" + position['Position']['address'] + "&nbsp;</td> \
			<td>" + position['Position']['created'] + "&nbsp;</td> \
			<td>" + position['Position']['modified'] + "&nbsp;</td> \
			<td><a href='/positions/view/" + position['Position']['id'] + "' title='View detailed information' id='table-actions'><i class='fa fa-search'></i></a> \
			<a href='/positions/edit/" + position['Position']['id'] + "' title='Edit element' id='table-actions'><i class='fa fa-pencil-square-o'></i></a> \
			<form action='/positions/delete/"+ position['Position']['id']+ "' name='post_" + position['Position']['id'] + "' id='post_" + position['Position']['id'] + "' style='display:none;' method='post'><input type='hidden' name='_method' value='POST'></form> \
			<a href='#' title='Delete element' id='table-actions' onclick='if (confirm(&quot;Are you sure you want to delete # " + position['Position']['id'] + "?&quot;)){ post_" + position['Position']['id'] +".submit(); } event.returnValue = false; return false;'<i class='fa fa-times'></i></a> \
			</td></tr>"; 

		return entry;

	}
	
});
</script>
