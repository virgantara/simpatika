<?php
/* @var $this MasterdosenController */
/* @var $data Masterdosen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pt')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->kode_fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jurusan')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jurusan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jenjang_studi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jenjang_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_ktp_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->no_ktp_dosen); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nidn')); ?>:</b>
	<?php echo CHtml::encode($data->nidn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('niy')); ?>:</b>
	<?php echo CHtml::encode($data->niy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->nama_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gelar_depan')); ?>:</b>
	<?php echo CHtml::encode($data->gelar_depan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gelar_akademik')); ?>:</b>
	<?php echo CHtml::encode($data->gelar_akademik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tempat_lahir_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->tempat_lahir_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_kelamin')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_kelamin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jabatan_akademik')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jabatan_akademik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pendidikan_tertinggi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pendidikan_tertinggi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_status_kerja_pts')); ?>:</b>
	<?php echo CHtml::encode($data->kode_status_kerja_pts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_status_aktivitas_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->kode_status_aktivitas_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_semester')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip_pns')); ?>:</b>
	<?php echo CHtml::encode($data->nip_pns); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_base')); ?>:</b>
	<?php echo CHtml::encode($data->home_base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->photo_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_telp_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->no_telp_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_hp_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->no_hp_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->email_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->alamat_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat_domisili')); ?>:</b>
	<?php echo CHtml::encode($data->alamat_domisili); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabupaten_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->kabupaten_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->provinsi_dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agama_dosen')); ?>:</b>
	<?php echo CHtml::encode($data->agama_dosen); ?>
	<br />

	*/ ?>

</div>