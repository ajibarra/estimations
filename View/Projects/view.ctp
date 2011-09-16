<div class="projects view">
<h2><?php  echo __('Project');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($project['Project']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($project['Project']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['Client']['name'], array('controller' => 'clients', 'action' => 'view', $project['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($project['Project']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Final Estimation'); ?></dt>
		<dd>
			<?php echo h($project['Project']['final_estimation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Spent'); ?></dt>
		<dd>
			<?php echo h($project['Project']['time_spent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($project['Project']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($project['Project']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<?php if ($project['Project']['status'] == Project::OPEN) echo $this->Html->link(__('Estimate'), array('controller' => 'estimations', 'action' => 'add', $project['Project']['id']));?>
	<?php if ($project['Project']['status'] == Project::CREATED) echo $this->Html->link(__('Open for estimations'), array('controller' => 'projects', 'action' => 'open', $project['Project']['id']));?>
	<?php if ($project['Project']['status'] == Project::OPEN) echo $this->Html->link(__('Sent to client'), array('controller' => 'projects', 'action' => 'send', $project['Project']['id']));?>
	<?php if ($project['Project']['status'] == Project::ESTIMATION_SENT) echo $this->Html->link(__('Delivered to client'), array('controller' => 'projects', 'action' => 'deliver', $project['Project']['id']));?>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Project'), array('action' => 'delete', $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estimations'), array('controller' => 'estimations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estimation'), array('controller' => 'estimations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Estimations');?></h3>
	<?php if (!empty($project['Estimation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Optimistic'); ?></th>
		<th><?php echo __('Likely'); ?></th>
		<th><?php echo __('Pessimistic'); ?></th>
		<th><?php echo __('Notes'); ?></th>
		<th><?php echo __('Created'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($project['Estimation'] as $estimation): ?>
		<tr>
			<td><?php echo $estimation['user_id'];?></td>
			<td><?php echo $estimation['optimistic'];?></td>
			<td><?php echo $estimation['likely'];?></td>
			<td><?php echo $estimation['pessimistic'];?></td>
			<td><?php echo $estimation['notes'];?></td>
			<td><?php echo $estimation['created'];?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
