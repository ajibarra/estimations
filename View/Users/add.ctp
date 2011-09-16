<div class="register-login">
	<h2><?php echo __d('users', 'Project Estimations'); ?></h2>
		<?php
			echo $this->Form->create('AppUser', array('url' => array('controller' => 'app_users', 'action'=>'add')));
			echo $this->Form->input('Profile.name');
			echo $this->Form->input('AppUser.email', array(
				'label' => __d('users', 'E-mail (used as login)',true),
				'error' => array('isValid' => __d('users', 'Must be a valid email address', true),
				'isUnique' => __d('users', 'An account with that email already exists', true))));
			echo $this->Form->input('AppUser.password', array(
				'label' => __d('users', 'Password',true),
				'type' => 'password',
				'error' => __d('users', 'Must be at least 5 characters long', true),
				'class' => 'register-field'));
			echo $this->Form->input('AppUser.temppassword', array(
				'label' => __d('users', 'Password (confirm)', true),
				'type' => 'password',
				'error' => __d('users', 'Passwords must match', true)));
			echo $this->Form->end(__d('users', 'Request Access',true)	);
			echo __('If you already have an account %s to login.', $this->Html->link(__('click here'), array('controller' => 'app_users', 'action' => 'login')));
	?>
</div>