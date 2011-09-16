<div class="estimations form">
<?php echo $this->Form->create('Estimation');?>
	<fieldset>
		<legend><?php echo __('Edit Estimation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('project_id');
		echo $this->Form->input('optimistic');
		echo $this->Form->input('likely');
		echo $this->Form->input('pessimistic');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Estimation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Estimation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Estimations'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>
