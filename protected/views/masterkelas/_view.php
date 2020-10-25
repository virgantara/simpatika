<?php
/* @var $this MasterkelasController */
/* @var $data Masterkelas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_akademik')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_akademik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kd_kelas')); ?>:</b>
	<?php echo CHtml::encode($data->kd_kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kelas')); ?>:</b>
	<?php echo CHtml::encode($data->nama_kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kuota')); ?>:</b>
	<?php echo CHtml::encode($data->kuota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kampus')); ?>:</b>
	<?php echo CHtml::encode($data->id_kampus); ?>
	<br />


</div>