<div class="dtbuildings form">
<?php echo $this->Form->create('Dtbuilding'); ?>
	<fieldset>
		<legend><?php echo __('Add Dtbuilding'); ?></legend>
	<?php
		echo $this->Form->input('building_id');
		echo $this->Form->input('finish');
		echo $this->Form->input('begin');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dtbuildings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
