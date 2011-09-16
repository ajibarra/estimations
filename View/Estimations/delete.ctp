<h2><?php echo sprintf(__('Delete Estimation "%s"?', true), $estimation['Estimation']['title']); ?></h2>
<p>	
	<?php __('Be aware that your Estimation and all associated data will be deleted if you confirm!'); ?>
</p>
<?php
	echo $this->Form->create('Estimation', array(
		'url' => array(
			'action' => 'delete',
			$estimation['Estimation']['id'])));
	echo $form->input('confirm', array(
		'label' => __('Confirm', true),
		'type' => 'checkbox',
		'error' => __('You have to confirm.', true)));
	echo $form->submit(__('Continue', true));
	echo $form->end();
?>