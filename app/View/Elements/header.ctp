<nav id="header" class="navbar navbar-fixed-top navbar-inverse">
	<div class="container">
		<div class="navbar-header">
		<?php echo $this->Html->link(
				    $this->Html->tag('i', '', array('class' => 'icon-star')) . " GPS Tracker",
				    array('controller' => 'homepages', 'action'=>'index'),
				    array('class' => 'navbar-brand', 'escape' => false)
				);?>
		</div>
		<div id="navbar" class="navbar-collapse collapse pull-right">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Elemento', array('controller' => 'elements', 'action'=>'index'))?></li>
				<li><?php echo $this->Html->link('Posição', array('controller' => 'positions', 'action'=>'index'))?></li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>