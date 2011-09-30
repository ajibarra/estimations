<div class="estimations form">
<?php echo $this->Form->create('Estimation');?>
	<fieldset>
		<legend><?php echo __('Add Estimation to project') . ' "' . h($project['Project']['name']) . '"'; ?></legend>
	<?php
		echo $this->Form->hidden('user_id',  array('value' => $userId));
		echo $this->Form->hidden('project_id',  array('value' => $project['Project']['id']));
		echo $this->Form->input('optimistic', array('label' => __('What is your optimistic estimate?')));
		echo $this->Form->input('likely', array('label' => __('What is your most likely estimate?')));
		echo $this->Form->input('pessimistic', array('label' => __('What is your pessimistic estimate?')));
		echo $this->Form->input('notes', array('type' => 'textarea', 'label' => 'Any concerns'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'dashboards', 'action' => 'index')); ?> </li>
	</ul>
</div>
