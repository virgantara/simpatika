<?php
/* @var $this MasterprogramstudiController */
/* @var $data Masterprogramstudi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('gelar_lulusan')); ?>:</b>
	<?php echo CHtml::encode($data->gelar_lulusan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gelar_lulusan_en')); ?>:</b>
	<?php echo CHtml::encode($data->gelar_lulusan_en); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gelar_lulusan_short')); ?>:</b>
	<?php echo CHtml::encode($data->gelar_lulusan_short); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->nama_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_prodi_en')); ?>:</b>
	<?php echo CHtml::encode($data->nama_prodi_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester_awal')); ?>:</b>
	<?php echo CHtml::encode($data->semester_awal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_sk_dikti')); ?>:</b>
	<?php echo CHtml::encode($data->no_sk_dikti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_sk_dikti')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_sk_dikti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_akhir_sk_dikti')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_akhir_sk_dikti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jml_sks_lulus')); ?>:</b>
	<?php echo CHtml::encode($data->jml_sks_lulus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_status')); ?>:</b>
	<?php echo CHtml::encode($data->kode_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_semester_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_semester_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->email_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_pendirian_program_studi')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_pendirian_program_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_sk_akreditasi')); ?>:</b>
	<?php echo CHtml::encode($data->no_sk_akreditasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_sk_akreditasi')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_sk_akreditasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_akhir_sk_akreditasi')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_akhir_sk_akreditasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_status_akreditasi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_status_akreditasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frekuensi_kurikulum')); ?>:</b>
	<?php echo CHtml::encode($data->frekuensi_kurikulum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pelaksanaan_kurikulum')); ?>:</b>
	<?php echo CHtml::encode($data->pelaksanaan_kurikulum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nidn_ketua_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->nidn_ketua_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telp_ketua_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->telp_ketua_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->fax_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_operator')); ?>:</b>
	<?php echo CHtml::encode($data->nama_operator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp_operator')); ?>:</b>
	<?php echo CHtml::encode($data->hp_operator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telepon_program_studi')); ?>:</b>
	<?php echo CHtml::encode($data->telepon_program_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('singkatan')); ?>:</b>
	<?php echo CHtml::encode($data->singkatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_feeder')); ?>:</b>
	<?php echo CHtml::encode($data->kode_feeder); ?>
	<br />

	*/ ?>

</div>