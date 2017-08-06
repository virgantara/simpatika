<?php
/* @var $this JadwalController */
/* @var $data Jadwal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hari')); ?>:</b>
	<?php echo CHtml::encode($data->hari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam')); ?>:</b>
	<?php echo CHtml::encode($data->jam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_mk')); ?>:</b>
	<?php echo CHtml::encode($data->kode_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->kode_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kelas')); ?>:</b>
	<?php echo CHtml::encode($data->kelas); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prodi')); ?>:</b>
	<?php echo CHtml::encode($data->prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kd_ruangan')); ?>:</b>
	<?php echo CHtml::encode($data->kd_ruangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_akademik')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_akademik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kuota_kelas')); ?>:</b>
	<?php echo CHtml::encode($data->kuota_kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus')); ?>:</b>
	<?php echo CHtml::encode($data->kampus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presensi')); ?>:</b>
	<?php echo CHtml::encode($data->presensi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materi')); ?>:</b>
	<?php echo CHtml::encode($data->materi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bobot_formatif')); ?>:</b>
	<?php echo CHtml::encode($data->bobot_formatif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bobot_uts')); ?>:</b>
	<?php echo CHtml::encode($data->bobot_uts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bobot_uas')); ?>:</b>
	<?php echo CHtml::encode($data->bobot_uas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bobot_harian1')); ?>:</b>
	<?php echo CHtml::encode($data->bobot_harian1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bobot_harian')); ?>:</b>
	<?php echo CHtml::encode($data->bobot_harian); ?>
	<br />

	*/ ?>

</div>