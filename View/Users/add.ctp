<div class="register-login">
	<h2><?php echo __d('users', 'Project Estimations'); ?></h2>
		<?php
			echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action'=>'add')));
			echo $this->Form->input('User.name');
			echo $this->Form->input('User.email', array(
				'label' => __d('users', 'E-mail (used as login)',true),
				'error' => array('isValid' => __d('users', 'Must be a valid email address', true),
				'isUnique' => __d('users', 'An account with that email already exists', true))));
			echo $this->Form->input('User.password', array(
				'label' => __d('users', 'Password',true),
				'type' => 'password',
				'error' => __d('users', 'Must be at least 5 characters long', true),
				'class' => 'register-field'));
			echo $this->Form->input('User.temppassword', array(
				'label' => __d('users', 'Password (confirm)', true),
				'type' => 'password',
				'error' => __d('users', 'Passwords must match', true)));
			echo $this->Form->end(__d('users', 'Request Access',true)	);
			echo __('If you already have an account %s to login.', $this->Html->link(__('click here'), array('controller' => 'users', 'action' => 'login')));
	?>
</div>