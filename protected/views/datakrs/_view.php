<?php
/* @var $this DatakrsController */
/* @var $data Datakrs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pt')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_fak')); ?>:</b>
	<?php echo CHtml::encode($data->kode_fak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jenjang')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jenjang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jurusan')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jurusan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_mk')); ?>:</b>
	<?php echo CHtml::encode($data->kode_mk); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_mk')); ?>:</b>
	<?php echo CHtml::encode($data->nama_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks')); ?>:</b>
	<?php echo CHtml::encode($data->sks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mahasiswa')); ?>:</b>
	<?php echo CHtml::encode($data->mahasiswa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->kode_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('namadosen')); ?>:</b>
	<?php echo CHtml::encode($data->namadosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jadwal')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jadwal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kelas')); ?>:</b>
	<?php echo CHtml::encode($data->kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('harian')); ?>:</b>
	<?php echo CHtml::encode($data->harian); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('normatif')); ?>:</b>
	<?php echo CHtml::encode($data->normatif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uts')); ?>:</b>
	<?php echo CHtml::encode($data->uts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uas')); ?>:</b>
	<?php echo CHtml::encode($data->uas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nilai_angka')); ?>:</b>
	<?php echo CHtml::encode($data->nilai_angka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nilai_huruf')); ?>:</b>
	<?php echo CHtml::encode($data->nilai_huruf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bobot_nilai')); ?>:</b>
	<?php echo CHtml::encode($data->bobot_nilai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_akademik')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_akademik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester_matakuliah')); ?>:</b>
	<?php echo CHtml::encode($data->semester_matakuliah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_publis')); ?>:</b>
	<?php echo CHtml::encode($data->status_publis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah_nilai')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah_nilai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_krs')); ?>:</b>
	<?php echo CHtml::encode($data->status_krs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lulus')); ?>:</b>
	<?php echo CHtml::encode($data->lulus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pindahan')); ?>:</b>
	<?php echo CHtml::encode($data->pindahan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_approved')); ?>:</b>
	<?php echo CHtml::encode($data->is_approved); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sudah_ekd')); ?>:</b>
	<?php echo CHtml::encode($data->sudah_ekd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score_ekd')); ?>:</b>
	<?php echo CHtml::encode($data->score_ekd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>