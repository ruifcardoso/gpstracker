<nav id="newheader" class="navbar navbar-fixed-top">
	<ul class="nav navbar-nav">
		<li><?php echo $this->Html->link('<i class="fa fa-list"></i>&nbsp List ' . $this->name, array('action'=>'index'), array('escape'=>false))?></li>
		<li><?php echo $this->Html->link('<i class="fa fa-plus"></i>&nbsp Add ' . $this->name, array('action'=>'add'), array('escape'=>false))?></li>
		<?php if(($this->action) == "view"){?>
		<li><?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>&nbsp Edit ' . substr($this->name,0,-1), array('action'=>'edit', $this->params['pass'][0]), array('escape'=>false))?></li>
		<?php if(($this->name) == "Positions"){?>
				<li><?php echo $this->Form->postLink('<i class="fa fa-times"></i>&nbsp Remove Position', array('action' => 'delete', $position['Position']['id']),
						 array('escape'=>false), __('Are you sure you want to delete # %s?', $position['Position']['id'])); ?></li>
		<?php }else{?>
				<li><?php echo $this->Form->postLink('<i class="fa fa-times"></i>&nbsp Remove Element', array('action' => 'delete', $element['Element']['id']),
						 array('escape'=>false), __('Are you sure you want to delete # %s?', $element['Element']['id'])); ?></li>
		<?php }
			}?>
	</ul>
</nav>

<script>
var offset = $('#header').offset();
var height = $('#header').height();
var width = $('#header').width();
var headerbottom = offset.top + height + "px";
var right = offset.left + width + "px";

$('nav#newheader').css( {
    'position': 'absolute',
    'right': right,
    'top': headerbottom
});

</script>