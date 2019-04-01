<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'datakrs-form',
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
		<?php echo $form->textField($model,'kode_pt',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_pt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_fak'); ?>
		<?php echo $form->textField($model,'kode_fak',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_fak'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jenjang'); ?>
		<?php echo $form->textField($model,'kode_jenjang',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'kode_jenjang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jurusan'); ?>
		<?php echo $form->textField($model,'kode_jurusan',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_jurusan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_mk'); ?>
		<?php echo $form->textField($model,'kode_mk',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kode_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_mk'); ?>
		<?php echo $form->textField($model,'nama_mk',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nama_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sks'); ?>
		<?php echo $form->textField($model,'sks',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mahasiswa'); ?>
		<?php echo $form->textField($model,'mahasiswa',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'mahasiswa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_dosen'); ?>
		<?php echo $form->textField($model,'kode_dosen',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kode_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'namadosen'); ?>
		<?php echo $form->textField($model,'namadosen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'namadosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester'); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jadwal'); ?>
		<?php echo $form->textField($model,'kode_jadwal',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_jadwal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harian'); ?>
		<?php echo $form->textField($model,'harian',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'harian'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'normatif'); ?>
		<?php echo $form->textField($model,'normatif',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'normatif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uts'); ?>
		<?php echo $form->textField($model,'uts',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'uts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uas'); ?>
		<?php echo $form->textField($model,'uas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'uas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nilai_angka'); ?>
		<?php echo $form->textField($model,'nilai_angka',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'nilai_angka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nilai_huruf'); ?>
		<?php echo $form->textField($model,'nilai_huruf',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'nilai_huruf'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bobot_nilai'); ?>
		<?php echo $form->textField($model,'bobot_nilai',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'bobot_nilai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_akademik'); ?>
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester_matakuliah'); ?>
		<?php echo $form->textField($model,'semester_matakuliah',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'semester_matakuliah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_publis'); ?>
		<?php echo $form->textField($model,'status_publis'); ?>
		<?php echo $form->error($model,'status_publis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah_nilai'); ?>
		<?php echo $form->textField($model,'jumlah_nilai',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'jumlah_nilai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_krs'); ?>
		<?php echo $form->textField($model,'status_krs',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'status_krs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lulus'); ?>
		<?php echo $form->textField($model,'lulus',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'lulus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pindahan'); ?>
		<?php echo $form->textField($model,'pindahan',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'pindahan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->