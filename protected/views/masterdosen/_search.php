<?php
/* @var $this MasterdosenController */
/* @var $model Masterdosen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pt'); ?>
		<?php echo $form->textField($model,'kode_pt',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_fakultas'); ?>
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jurusan'); ?>
		<?php echo $form->textField($model,'kode_jurusan',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jenjang_studi'); ?>
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_ktp_dosen'); ?>
		<?php echo $form->textField($model,'no_ktp_dosen',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nidn'); ?>
		<?php echo $form->textField($model,'nidn',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'niy'); ?>
		<?php echo $form->textField($model,'niy',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_dosen'); ?>
		<?php echo $form->textField($model,'nama_dosen',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gelar_depan'); ?>
		<?php echo $form->textField($model,'gelar_depan',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gelar_akademik'); ?>
		<?php echo $form->textField($model,'gelar_akademik',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tempat_lahir_dosen'); ?>
		<?php echo $form->textField($model,'tempat_lahir_dosen',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lahir_dosen'); ?>
		<?php echo $form->textField($model,'tgl_lahir_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenis_kelamin'); ?>
		<?php echo $form->textField($model,'jenis_kelamin',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jabatan_akademik'); ?>
		<?php echo $form->textField($model,'kode_jabatan_akademik',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pendidikan_tertinggi'); ?>
		<?php echo $form->textField($model,'kode_pendidikan_tertinggi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_status_kerja_pts'); ?>
		<?php echo $form->textField($model,'kode_status_kerja_pts',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_status_aktivitas_dosen'); ?>
		<?php echo $form->textField($model,'kode_status_aktivitas_dosen',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_semester'); ?>
		<?php echo $form->textField($model,'tahun_semester',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nip_pns'); ?>
		<?php echo $form->textField($model,'nip_pns',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_base'); ?>
		<?php echo $form->textField($model,'home_base',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_dosen'); ?>
		<?php echo $form->textField($model,'photo_dosen',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_telp_dosen'); ?>
		<?php echo $form->textField($model,'no_telp_dosen',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_hp_dosen'); ?>
		<?php echo $form->textField($model,'no_hp_dosen',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_dosen'); ?>
		<?php echo $form->textField($model,'email_dosen',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alamat_dosen'); ?>
		<?php echo $form->textArea($model,'alamat_dosen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alamat_domisili'); ?>
		<?php echo $form->textArea($model,'alamat_domisili',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kabupaten_dosen'); ?>
		<?php echo $form->textField($model,'kabupaten_dosen',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'provinsi_dosen'); ?>
		<?php echo $form->textField($model,'provinsi_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agama_dosen'); ?>
		<?php echo $form->textField($model,'agama_dosen',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->