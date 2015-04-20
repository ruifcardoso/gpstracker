<?php
echo $this->Form->create ( 'Position', array (
		'class' => 'form-horizontal',
		'role' => 'form',
		'inputDefaults' => array (
				'format' => array (
						'before',
						'label',
						'between',
						'input',
						'error',
						'after' 
				),
				'div' => array (
						'class' => 'form-group' 
				),
				'class' => array (
						'form-control' 
				),
				'label' => array (
						'class' => 'col-lg-3 control-label' 
				),
				'between' => '<div class="col-lg-9">',
				'after' => '</div>',
				'error' => array (
						'attributes' => array (
								'wrap' => 'span',
								'class' => 'help-inline' 
						) 
				) 
		) 
) );

?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<fieldset>
			<legend><?php echo __('Add Position'); ?></legend>
	<?php
		echo $this->Form->input('element_id');
		//echo $this->Form->input('time');
		echo $this->Form->input('time', array(
				'label' => array (
						'class' => 'col-lg-3 control-label' 
				),
				'id' => 'datetimepicker',
				'type' => 'text',
				'class' => 'form-control',
				'type' => 'text',
				'after' => '<span class="add-on datetime"><span class="icon-calendar"></span></span></div>'
		));

		echo $this->Form->input('lat');
		echo $this->Form->input('long');
		echo $this->Form->input('address');
	?>
	</fieldset>
		<div class="no-margin col-md-12">
<?php
echo $this->Form->end ( array (
		'label' => __ ( 'Submit' ),
		'class' => 'btn btn-block',
		'div' => array (
				'class' => 'control-group ' 
		),
		'before' => '<div class="controls" style="margin-top:20px;">',
		'after' => '</div>' 
) );
?>
		</div>
	</div>
</div>
  
<script>
$(document).ready(function(){
	
jQuery('#datetimepicker').datetimepicker({
  format:'Y-m-s H:i:s'});
});

</script>