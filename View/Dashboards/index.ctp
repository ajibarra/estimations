<div class="projects">
	<h2><?php echo __('Projects to estimate');?></h2>
	<table cellpadding="0" cellspacing="0" style="width: 30%">
	<tr>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Client');?></th>
			<th><?php echo __('Created');?></th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Client']['name'], array('controller' => 'clients', 'action' => 'view', $project['Client']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php if ($project['Project']['status'] == Project::OPEN) echo $this->Html->link(__('Estimate'), array('controller' => 'estimations', 'action' => 'add', $project['Project']['id']));?>		
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>
