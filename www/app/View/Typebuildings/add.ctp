<div class="typebuildings form">
<?php echo $this->Form->create('Typebuilding'); ?>
	<fieldset>
		<legend><?php echo __('Add Typebuilding'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('desc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Typebuildings'), array('action' => 'index')); ?></li>
	</ul>
</div>
