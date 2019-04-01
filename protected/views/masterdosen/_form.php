<?php
/* @var $this MasterdosenController */
/* @var $model Masterdosen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masterdosen-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_pt'); ?>
		<?php echo $form->textField($model,'kode_pt',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_pt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_fakultas'); ?>
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_fakultas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jurusan'); ?>
		<?php echo $form->textField($model,'kode_jurusan',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jurusan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jenjang_studi'); ?>
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jenjang_studi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_ktp_dosen'); ?>
		<?php echo $form->textField($model,'no_ktp_dosen',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'no_ktp_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nidn'); ?>
		<?php echo $form->textField($model,'nidn',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nidn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'niy'); ?>
		<?php echo $form->textField($model,'niy',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'niy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_dosen'); ?>
		<?php echo $form->textField($model,'nama_dosen',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gelar_depan'); ?>
		<?php echo $form->textField($model,'gelar_depan',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'gelar_depan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gelar_akademik'); ?>
		<?php echo $form->textField($model,'gelar_akademik',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'gelar_akademik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tempat_lahir_dosen'); ?>
		<?php echo $form->textField($model,'tempat_lahir_dosen',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tempat_lahir_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_lahir_dosen'); ?>
		<?php echo $form->textField($model,'tgl_lahir_dosen'); ?>
		<?php echo $form->error($model,'tgl_lahir_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis_kelamin'); ?>
		<?php echo $form->textField($model,'jenis_kelamin',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'jenis_kelamin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jabatan_akademik'); ?>
		<?php echo $form->textField($model,'kode_jabatan_akademik',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jabatan_akademik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_pendidikan_tertinggi'); ?>
		<?php echo $form->textField($model,'kode_pendidikan_tertinggi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_pendidikan_tertinggi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_status_kerja_pts'); ?>
		<?php echo $form->textField($model,'kode_status_kerja_pts',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_status_kerja_pts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_status_aktivitas_dosen'); ?>
		<?php echo $form->textField($model,'kode_status_aktivitas_dosen',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_status_aktivitas_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_semester'); ?>
		<?php echo $form->textField($model,'tahun_semester',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nip_pns'); ?>
		<?php echo $form->textField($model,'nip_pns',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nip_pns'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_base'); ?>
		<?php echo $form->textField($model,'home_base',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'home_base'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_dosen'); ?>
		<?php echo $form->textField($model,'photo_dosen',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_telp_dosen'); ?>
		<?php echo $form->textField($model,'no_telp_dosen',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'no_telp_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_hp_dosen'); ?>
		<?php echo $form->textField($model,'no_hp_dosen',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'no_hp_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_dosen'); ?>
		<?php echo $form->textField($model,'email_dosen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat_dosen'); ?>
		<?php echo $form->textArea($model,'alamat_dosen',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'alamat_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat_domisili'); ?>
		<?php echo $form->textArea($model,'alamat_domisili',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'alamat_domisili'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kabupaten_dosen'); ?>
		<?php echo $form->textField($model,'kabupaten_dosen',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kabupaten_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provinsi_dosen'); ?>
		<?php echo $form->textField($model,'provinsi_dosen'); ?>
		<?php echo $form->error($model,'provinsi_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agama_dosen'); ?>
		<?php echo $form->textField($model,'agama_dosen',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'agama_dosen'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->