<?php
/* @var $this MastermatakuliahController */
/* @var $data Mastermatakuliah */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_akademik')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_akademik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pt')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->kode_fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jenjang_studi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jenjang_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_mata_kuliah')); ?>:</b>
	<?php echo CHtml::encode($data->kode_mata_kuliah); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_mata_kuliah')); ?>:</b>
	<?php echo CHtml::encode($data->nama_mata_kuliah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks')); ?>:</b>
	<?php echo CHtml::encode($data->sks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_tatap_muka')); ?>:</b>
	<?php echo CHtml::encode($data->sks_tatap_muka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_praktikum')); ?>:</b>
	<?php echo CHtml::encode($data->sks_praktikum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_praktek_lap')); ?>:</b>
	<?php echo CHtml::encode($data->sks_praktek_lap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_kelompok')); ?>:</b>
	<?php echo CHtml::encode($data->kode_kelompok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_kurikulum')); ?>:</b>
	<?php echo CHtml::encode($data->kode_kurikulum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_matkul')); ?>:</b>
	<?php echo CHtml::encode($data->kode_matkul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nidn')); ?>:</b>
	<?php echo CHtml::encode($data->nidn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenjang_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->jenjang_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prodi_pengampu')); ?>:</b>
	<?php echo CHtml::encode($data->prodi_pengampu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_mata_kuliah')); ?>:</b>
	<?php echo CHtml::encode($data->status_mata_kuliah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('silabus')); ?>:</b>
	<?php echo CHtml::encode($data->silabus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sap')); ?>:</b>
	<?php echo CHtml::encode($data->sap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bahan_ajar')); ?>:</b>
	<?php echo CHtml::encode($data->bahan_ajar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diktat')); ?>:</b>
	<?php echo CHtml::encode($data->diktat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_wajib')); ?>:</b>
	<?php echo CHtml::encode($data->status_wajib); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms')); ?>:</b>
	<?php echo CHtml::encode($data->sms); ?>
	<br />

	*/ ?>

</div>