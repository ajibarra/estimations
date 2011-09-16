<div class="estimations view">
<h2><?php  echo __('Estimation');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($estimation['User']['id'], array('controller' => 'users', 'action' => 'view', $estimation['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($estimation['Project']['name'], array('controller' => 'projects', 'action' => 'view', $estimation['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Optimistic'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['optimistic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Likely'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['likely']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pessimistic'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['pessimistic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($estimation['Estimation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Estimation'), array('action' => 'edit', $estimation['Estimation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Estimation'), array('action' => 'delete', $estimation['Estimation']['id']), null, __('Are you sure you want to delete # %s?', $estimation['Estimation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Estimations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estimation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>
