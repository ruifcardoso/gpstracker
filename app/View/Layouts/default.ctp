<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
    <?php echo "GPS Tracker";?>
  </title>
	
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<?php //echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', false); ?>


<script
	src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <?php
		echo $this->Html->meta ( 'icon' );
		
		echo $this->Html->css ( array (
				'styles.css',
				'bootstrap.min',
				'bootstrap-theme.min',
				'jquery.datetimepicker.css' 
		) );
		
		echo $this->Html->script ( array (
				'jquery.datetimepicker'
		) );
		echo $this->fetch ( 'meta' );
		echo $this->fetch ( 'css' );
		echo $this->fetch ( 'script' );
		?>

</head>
<body>
	<div id="container theme-showcase" role="main">	
    <?php echo $this->Session->flash(); 
   	 echo $this->Session->flash('auth');
    
    echo $this->element('header');
    echo $this->fetch('content'); ?>
  </div>
<?php //echo $this->element('sql_dump'); ?>
  <?php echo $this->element('sql_dump'); ?>
  
</body>
</html>