<div class="register-login">
	<h2><?php echo __d('users', 'Project Estimations'); ?></h2>

	<?php
		echo $this->Form->create('AppUser', array('url' => array('controller' => 'app_users', 'action'=>'login')));
		echo $this->Form->input('email', array(
			'label' => __d('users', 'Email', true)));
		echo $this->Form->input('password',  array(
			'label' => __d('users', 'Password', true)));
		//echo __d('users', 'Remember Me') . $this->Form->checkbox('remember_me');
		//echo $this->Form->hidden('Users.User.return_to', array('value' => $return_to));
		echo $this->Form->end(__d('users', 'Login', true));
		echo __('Don\'t have an account? %s to request one.', $this->Html->link(__('click here'), array('controller' => 'app_users', 'action' => 'add')));
	?>
</div>