<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::encode($data->role_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_hash')); ?>:</b>
	<?php echo CHtml::encode($data->password_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reset_hash')); ?>:</b>
	<?php echo CHtml::encode($data->reset_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login')); ?>:</b>
	<?php echo CHtml::encode($data->last_login); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('last_ip')); ?>:</b>
	<?php echo CHtml::encode($data->last_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reset_by')); ?>:</b>
	<?php echo CHtml::encode($data->reset_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banned')); ?>:</b>
	<?php echo CHtml::encode($data->banned); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ban_message')); ?>:</b>
	<?php echo CHtml::encode($data->ban_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_name')); ?>:</b>
	<?php echo CHtml::encode($data->display_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_name_changed')); ?>:</b>
	<?php echo CHtml::encode($data->display_name_changed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timezone')); ?>:</b>
	<?php echo CHtml::encode($data->timezone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activate_hash')); ?>:</b>
	<?php echo CHtml::encode($data->activate_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_iterations')); ?>:</b>
	<?php echo CHtml::encode($data->password_iterations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('force_password_reset')); ?>:</b>
	<?php echo CHtml::encode($data->force_password_reset); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nim')); ?>:</b>
	<?php echo CHtml::encode($data->nim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_data')); ?>:</b>
	<?php echo CHtml::encode($data->status_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus')); ?>:</b>
	<?php echo CHtml::encode($data->kampus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prodi')); ?>:</b>
	<?php echo CHtml::encode($data->prodi); ?>
	<br />

	*/ ?>

</div>