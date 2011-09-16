<div class="estimations index">
	<h2><?php echo __('Estimations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('project_id');?></th>
			<th><?php echo $this->Paginator->sort('optimistic');?></th>
			<th><?php echo $this->Paginator->sort('likely');?></th>
			<th><?php echo $this->Paginator->sort('pessimistic');?></th>
			<th><?php echo $this->Paginator->sort('notes');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($estimations as $estimation): ?>
	<tr>
		<td><?php echo h($estimation['Estimation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($estimation['User']['id'], array('controller' => 'users', 'action' => 'view', $estimation['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($estimation['Project']['name'], array('controller' => 'projects', 'action' => 'view', $estimation['Project']['id'])); ?>
		</td>
		<td><?php echo h($estimation['Estimation']['optimistic']); ?>&nbsp;</td>
		<td><?php echo h($estimation['Estimation']['likely']); ?>&nbsp;</td>
		<td><?php echo h($estimation['Estimation']['pessimistic']); ?>&nbsp;</td>
		<td><?php echo h($estimation['Estimation']['notes']); ?>&nbsp;</td>
		<td><?php echo h($estimation['Estimation']['created']); ?>&nbsp;</td>
		<td><?php echo h($estimation['Estimation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $estimation['Estimation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $estimation['Estimation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $estimation['Estimation']['id']), null, __('Are you sure you want to delete # %s?', $estimation['Estimation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Estimation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>
