<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */
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
		<?php echo $form->label($model,'tahun_akademik'); ?>
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>5,'maxlength'=>5)); ?>
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
		<?php echo $form->label($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jenjang_studi'); ?>
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_mata_kuliah'); ?>
		<?php echo $form->textField($model,'kode_mata_kuliah',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_mata_kuliah'); ?>
		<?php echo $form->textField($model,'nama_mata_kuliah',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks'); ?>
		<?php echo $form->textField($model,'sks',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_tatap_muka'); ?>
		<?php echo $form->textField($model,'sks_tatap_muka',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_praktikum'); ?>
		<?php echo $form->textField($model,'sks_praktikum',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_praktek_lap'); ?>
		<?php echo $form->textField($model,'sks_praktek_lap',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_kelompok'); ?>
		<?php echo $form->textField($model,'kode_kelompok',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_kurikulum'); ?>
		<?php echo $form->textField($model,'kode_kurikulum',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_matkul'); ?>
		<?php echo $form->textField($model,'kode_matkul',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nidn'); ?>
		<?php echo $form->textField($model,'nidn',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenjang_prodi'); ?>
		<?php echo $form->textField($model,'jenjang_prodi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prodi_pengampu'); ?>
		<?php echo $form->textField($model,'prodi_pengampu',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_mata_kuliah'); ?>
		<?php echo $form->textField($model,'status_mata_kuliah',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'silabus'); ?>
		<?php echo $form->textField($model,'silabus',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sap'); ?>
		<?php echo $form->textField($model,'sap',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bahan_ajar'); ?>
		<?php echo $form->textField($model,'bahan_ajar',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diktat'); ?>
		<?php echo $form->textField($model,'diktat',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_wajib'); ?>
		<?php echo $form->textField($model,'status_wajib',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms'); ?>
		<?php echo $form->textField($model,'sms',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->