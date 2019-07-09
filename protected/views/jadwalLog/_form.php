<?php
/* @var $this JadwalLogController */
/* @var $model JadwalLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hari'); ?>
		<?php echo $form->textField($model,'hari',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'hari'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_ke'); ?>
		<?php echo $form->textField($model,'jam_ke'); ?>
		<?php echo $form->error($model,'jam_ke'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam'); ?>
		<?php echo $form->textField($model,'jam',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_mulai'); ?>
		<?php echo $form->textField($model,'jam_mulai'); ?>
		<?php echo $form->error($model,'jam_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_selesai'); ?>
		<?php echo $form->textField($model,'jam_selesai'); ?>
		<?php echo $form->error($model,'jam_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_mk'); ?>
		<?php echo $form->textField($model,'kode_mk',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kode_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_mk'); ?>
		<?php echo $form->textField($model,'nama_mk',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nama_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_dosen'); ?>
		<?php echo $form->textField($model,'kode_dosen',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kode_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_dosen'); ?>
		<?php echo $form->textField($model,'nama_dosen',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nama_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fakultas'); ?>
		<?php echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'fakultas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_fakultas'); ?>
		<?php echo $form->textField($model,'nama_fakultas',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nama_fakultas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prodi'); ?>
		<?php echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_prodi'); ?>
		<?php echo $form->textField($model,'nama_prodi',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nama_prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kd_ruangan'); ?>
		<?php echo $form->textField($model,'kd_ruangan',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kd_ruangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_akademik'); ?>
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kuota_kelas'); ?>
		<?php echo $form->textField($model,'kuota_kelas'); ?>
		<?php echo $form->error($model,'kuota_kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kampus'); ?>
		<?php echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'kampus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'presensi'); ?>
		<?php echo $form->textArea($model,'presensi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'presensi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'materi'); ?>
		<?php echo $form->textField($model,'materi',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'materi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bobot_formatif'); ?>
		<?php echo $form->textField($model,'bobot_formatif',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'bobot_formatif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bobot_uts'); ?>
		<?php echo $form->textField($model,'bobot_uts',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'bobot_uts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bobot_uas'); ?>
		<?php echo $form->textField($model,'bobot_uas',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'bobot_uas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bobot_harian1'); ?>
		<?php echo $form->textField($model,'bobot_harian1',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'bobot_harian1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bobot_harian'); ?>
		<?php echo $form->textField($model,'bobot_harian',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'bobot_harian'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bentrok'); ?>
		<?php echo $form->textField($model,'bentrok'); ?>
		<?php echo $form->error($model,'bentrok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bentrok_with'); ?>
		<?php echo $form->textField($model,'bentrok_with',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'bentrok_with'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->