<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mastermatakuliah-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_akademik'); ?>
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'kode_mata_kuliah'); ?>
		<?php echo $form->textField($model,'kode_mata_kuliah',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'kode_mata_kuliah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_mata_kuliah'); ?>
		<?php echo $form->textField($model,'nama_mata_kuliah',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_mata_kuliah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sks'); ?>
		<?php echo $form->textField($model,'sks',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sks_tatap_muka'); ?>
		<?php echo $form->textField($model,'sks_tatap_muka',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks_tatap_muka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sks_praktikum'); ?>
		<?php echo $form->textField($model,'sks_praktikum',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks_praktikum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sks_praktek_lap'); ?>
		<?php echo $form->textField($model,'sks_praktek_lap',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks_praktek_lap'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_kelompok'); ?>
		<?php echo $form->textField($model,'kode_kelompok',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_kelompok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_kurikulum'); ?>
		<?php echo $form->textField($model,'kode_kurikulum',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'kode_kurikulum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_matkul'); ?>
		<?php echo $form->textField($model,'kode_matkul',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_matkul'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nidn'); ?>
		<?php echo $form->textField($model,'nidn',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nidn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenjang_prodi'); ?>
		<?php echo $form->textField($model,'jenjang_prodi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'jenjang_prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prodi_pengampu'); ?>
		<?php echo $form->textField($model,'prodi_pengampu',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prodi_pengampu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_mata_kuliah'); ?>
		<?php echo $form->textField($model,'status_mata_kuliah',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'status_mata_kuliah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'silabus'); ?>
		<?php echo $form->textField($model,'silabus',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'silabus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sap'); ?>
		<?php echo $form->textField($model,'sap',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sap'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bahan_ajar'); ?>
		<?php echo $form->textField($model,'bahan_ajar',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'bahan_ajar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diktat'); ?>
		<?php echo $form->textField($model,'diktat',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'diktat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_wajib'); ?>
		<?php echo $form->textField($model,'status_wajib',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'status_wajib'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms'); ?>
		<?php echo $form->textField($model,'sms',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sms'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->