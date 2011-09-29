<div class="projects view">
<h2><?php  echo __('Project');?></h2>
	<dl>
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
		<dt><?php echo __('Optimistic'); ?></dt>
		<dd>
			<?php echo h($project['Project']['optimistic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Most likely'); ?></dt>
		<dd>
			<?php echo h($project['Project']['most_likely']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pessimistic'); ?></dt>
		<dd>
			<?php echo h($project['Project']['pessimistic']); ?>
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
	</dl>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if ($project['Project']['status'] == Project::OPEN) echo $this->Html->link(__('Estimate'), array('controller' => 'estimations', 'action' => 'add', $project['Project']['id']));?></li>
		<li><?php if ($project['Project']['status'] == Project::CREATED) echo $this->Html->link(__('Open for estimations'), array('controller' => 'projects', 'action' => 'open', $project['Project']['id']));?></li>
		<li><?php if ($project['Project']['status'] == Project::OPEN) echo $this->Html->link(__('Close for estimations'), array('controller' => 'projects', 'action' => 'send', $project['Project']['id']));?></li>
		<li><?php if ($project['Project']['status'] == Project::ESTIMATION_SENT) echo $this->Html->link(__('Finish project'), array('controller' => 'projects', 'action' => 'deliver', $project['Project']['id']));?></li>
	</ul>
</div>
<?php if (in_array($project['Project']['status'], array(Project::ESTIMATION_SENT, Project::DELIVERED))):?>
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
<?php endif;?>
