<div class="projects form">
<?php echo $this->Form->create('Project');?>
	<fieldset>
		<legend><?php echo __('Please indicate final time spent for this project'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('time_spent');
		echo $this->Form->hidden('status', array('value' => Project::DELIVERED));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index'));?></li>
	</ul>
</div>
