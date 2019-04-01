<?php
/* @var $this TahunakademikController */
/* @var $data Tahunakademik */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_id')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun')); ?>:</b>
	<?php echo CHtml::encode($data->tahun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_tahun')); ?>:</b>
	<?php echo CHtml::encode($data->nama_tahun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('buka')); ?>:</b>
	<?php echo CHtml::encode($data->buka); ?>
	<br />


</div>