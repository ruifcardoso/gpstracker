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
				<?php if(AuthComponent::user()){?>
			
				<li><?php echo $this->Html->link('Home', array('controller' => 'homepages', 'action'=>'index'))?></li>
				<?php 
				$elements_url = ucfirst(
									substr(
										Router::url(array('controller' => 'elements','action' => 'index')),1));				
				$positions_url = ucfirst(
									substr(
										Router::url(array('controller' => 'positions','action' => 'index')),1));
				
				if( $Acl->check(array('model' => 'Group','foreign_key' =>$this->Session->read('Auth.User.group_id')),$elements_url)){?>
				<li><?php echo $this->Html->link('Elements', array('controller' => 'elements', 'action'=>'index'))?></li>
				<?php }
				if( $Acl->check(array('model' => 'Group','foreign_key' =>$this->Session->read('Auth.User.group_id')),$positions_url)){?>
				<li><?php echo $this->Html->link('Positions', array('controller' => 'positions', 'action'=>'index'))?></li>
				<?php }?>				
				<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action'=>'logout'))?></li>
				<?php }?>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
<script>
$(document).ready(function () {

	  var url = window.location;
	// Will only work if string in href matches with location
	  $('ul.nav a[href="' + url + '"]').parent().addClass('active');
		var controller = window.location.pathname.split( '/' )[1];
	// Will also work for relative and absolute hrefs
	  $('ul.nav a[href="/' + controller + '"]').filter(function () {
		  //console.log(url);
	      return ((url.href).indexOf("<?php echo $this->params['controller']?>") > 0);
	  }).parent().addClass('active');

		
	  $('ul.nav a').click(
	  		function(e) {
	  	        $('ul.nav li').removeClass('active');

	  	        var $this = $(this);
	  	        if (!$this.hasClass('active')) {
	  	            $this.addClass('active');
	  	        }
	  	        //e.preventDefault();
	  	    });
	});
</script>