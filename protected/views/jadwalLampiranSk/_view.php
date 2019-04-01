<?php
/* @var $this JadwalLampiranSkController */
/* @var $data JadwalLampiranSk */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomor_sk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nomor_sk), array('view', 'id'=>$data->nomor_sk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_sk')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_sk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tentang')); ?>:</b>
	<?php echo CHtml::encode($data->tentang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_penetapan')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_penetapan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bunyi_lampiran')); ?>:</b>
	<?php echo CHtml::encode($data->bunyi_lampiran); ?>
	<br />


</div>