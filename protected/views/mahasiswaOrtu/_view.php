<?php
/* @var $this MahasiswaOrtuController */
/* @var $data MahasiswaOrtu */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nim')); ?>:</b>
	<?php echo CHtml::encode($data->nim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hubungan')); ?>:</b>
	<?php echo CHtml::encode($data->hubungan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agama')); ?>:</b>
	<?php echo CHtml::encode($data->agama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pendidikan')); ?>:</b>
	<?php echo CHtml::encode($data->pendidikan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pekerjaan')); ?>:</b>
	<?php echo CHtml::encode($data->pekerjaan); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('penghasilan')); ?>:</b>
	<?php echo CHtml::encode($data->penghasilan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hidup')); ?>:</b>
	<?php echo CHtml::encode($data->hidup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat')); ?>:</b>
	<?php echo CHtml::encode($data->alamat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kota')); ?>:</b>
	<?php echo CHtml::encode($data->kota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('propinsi')); ?>:</b>
	<?php echo CHtml::encode($data->propinsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('negara')); ?>:</b>
	<?php echo CHtml::encode($data->negara); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pos')); ?>:</b>
	<?php echo CHtml::encode($data->pos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telepon')); ?>:</b>
	<?php echo CHtml::encode($data->telepon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp')); ?>:</b>
	<?php echo CHtml::encode($data->hp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	*/ ?>

</div>