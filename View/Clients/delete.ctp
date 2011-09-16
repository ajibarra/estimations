<h2><?php echo sprintf(__('Delete Client "%s"?', true), $client['Client']['title']); ?></h2>
<p>	
	<?php __('Be aware that your Client and all associated data will be deleted if you confirm!'); ?>
</p>
<?php
	echo $this->Form->create('Client', array(
		'url' => array(
			'action' => 'delete',
			$client['Client']['id'])));
	echo $form->input('confirm', array(
		'label' => __('Confirm', true),
		'type' => 'checkbox',
		'error' => __('You have to confirm.', true)));
	echo $form->submit(__('Continue', true));
	echo $form->end();
?>