<?php
/* @var $this JadwalLogController */
/* @var $model JadwalLog */
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
		<?php echo $form->label($model,'hari'); ?>
		<?php echo $form->textField($model,'hari',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jam_ke'); ?>
		<?php echo $form->textField($model,'jam_ke'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jam'); ?>
		<?php echo $form->textField($model,'jam',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jam_mulai'); ?>
		<?php echo $form->textField($model,'jam_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jam_selesai'); ?>
		<?php echo $form->textField($model,'jam_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_mk'); ?>
		<?php echo $form->textField($model,'kode_mk',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_mk'); ?>
		<?php echo $form->textField($model,'nama_mk',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_dosen'); ?>
		<?php echo $form->textField($model,'kode_dosen',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_dosen'); ?>
		<?php echo $form->textField($model,'nama_dosen',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fakultas'); ?>
		<?php echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_fakultas'); ?>
		<?php echo $form->textField($model,'nama_fakultas',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prodi'); ?>
		<?php echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_prodi'); ?>
		<?php echo $form->textField($model,'nama_prodi',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kd_ruangan'); ?>
		<?php echo $form->textField($model,'kd_ruangan',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_akademik'); ?>
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kuota_kelas'); ?>
		<?php echo $form->textField($model,'kuota_kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kampus'); ?>
		<?php echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'presensi'); ?>
		<?php echo $form->textArea($model,'presensi',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'materi'); ?>
		<?php echo $form->textField($model,'materi',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bobot_formatif'); ?>
		<?php echo $form->textField($model,'bobot_formatif',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bobot_uts'); ?>
		<?php echo $form->textField($model,'bobot_uts',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bobot_uas'); ?>
		<?php echo $form->textField($model,'bobot_uas',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bobot_harian1'); ?>
		<?php echo $form->textField($model,'bobot_harian1',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bobot_harian'); ?>
		<?php echo $form->textField($model,'bobot_harian',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bentrok'); ?>
		<?php echo $form->textField($model,'bentrok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bentrok_with'); ?>
		<?php echo $form->textField($model,'bentrok_with',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->