<?php
/* @var $this KampusController */
/* @var $data Kampus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_kampus')); ?>:</b>
	<?php echo CHtml::encode($data->kode_kampus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kampus')); ?>:</b>
	<?php echo CHtml::encode($data->nama_kampus); ?>
	<br />


</div>