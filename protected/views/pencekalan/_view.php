<?php
/* @var $this PencekalanController */
/* @var $data Pencekalan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_id')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nim')); ?>:</b>
	<?php echo CHtml::encode($data->nim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahfidz')); ?>:</b>
	<?php echo CHtml::encode($data->tahfidz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adm')); ?>:</b>
	<?php echo CHtml::encode($data->adm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('akpam')); ?>:</b>
	<?php echo CHtml::encode($data->akpam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('akademik')); ?>:</b>
	<?php echo CHtml::encode($data->akademik); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>