<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<nav id="header" class="navbar navbar-fixed-top navbar-inverse">
	<div class="container">
		<div class="navbar-header">
		<?php echo $this->Html->link("<i class='fa fa-compass'></i> GPS Tracker",
				    array('controller' => 'homepages', 'action'=>'index'),
				    array('class' => 'navbar-brand', 'escape' => false)
				);?>
		</div>
		
		<div id="navbar" class="navbar-collapse collapse pull-right">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Home', array('controller' => 'homepages', 'action'=>'index'))?></li>
				<li><?php echo $this->Html->link('Elemento', array('controller' => 'elements', 'action'=>'index'))?></li>
				<li><?php echo $this->Html->link('Posição', array('controller' => 'positions', 'action'=>'index'))?></li>
				<?php if(AuthComponent::user()){?>
				<li><?php echo $this->Html->link('Sair', array('controller' => 'users', 'action'=>'logout'))?></li>
				<?php }?>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>