<div class="dashboard_section">
	<h2><?php echo __('Projects to estimate');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Client');?></th>
			<th><?php echo __('Created');?></th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($openProjects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Client']['name'], array('controller' => 'clients', 'action' => 'view', $project['Client']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo ($project['Project']['estimated'] ? __('Estimated') : $this->Html->link(__('Estimate'), array('controller' => 'estimations', 'action' => 'add', $project['Project']['id'])));?>		
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>

<div class="dashboard_section">
	<h2><?php echo __('Projects sent to clients');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Client');?></th>
			<th><?php echo __('Created');?></th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sentProjects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Client']['name'], array('controller' => 'clients', 'action' => 'view', $project['Client']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id']));?>		
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>

<div class="dashboard_section">
	<h2><?php echo __('Projects delivered to clients');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Client');?></th>
			<th><?php echo __('Created');?></th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($deliveredProjects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Client']['name'], array('controller' => 'clients', 'action' => 'view', $project['Client']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id']));?>		
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>