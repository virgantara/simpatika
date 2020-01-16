<?php
/* @var $this JamController */
/* @var $data Jam */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jam')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_jam), array('view', 'id'=>$data->id_jam)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_jam')); ?>:</b>
	<?php echo CHtml::encode($data->nama_jam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->jam_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->jam_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	<?php echo CHtml::encode($data->prefix); ?>
	<br />


</div>