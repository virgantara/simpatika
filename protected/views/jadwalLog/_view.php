<?php
/* @var $this JadwalLogController */
/* @var $data JadwalLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hari')); ?>:</b>
	<?php echo CHtml::encode($data->hari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam_ke')); ?>:</b>
	<?php echo CHtml::encode($data->jam_ke); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam')); ?>:</b>
	<?php echo CHtml::encode($data->jam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->jam_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jam_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->jam_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_mk')); ?>:</b>
	<?php echo CHtml::encode($data->kode_mk); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_mk')); ?>:</b>
	<?php echo CHtml::encode($data->nama_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->kode_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->nama_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kelas')); ?>:</b>
	<?php echo CHtml::encode($data->kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->nama_fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prodi')); ?>:</b>
	<?php echo CHtml::encode($data->prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->nama_prodi); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('bentrok')); ?>:</b>
	<?php echo CHtml::encode($data->bentrok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bentrok_with')); ?>:</b>
	<?php echo CHtml::encode($data->bentrok_with); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>