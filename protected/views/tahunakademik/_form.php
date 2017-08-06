<?php
/* @var $this TahunakademikController */
/* @var $model Tahunakademik */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tahunakademik-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_id'); ?>
		<?php echo $form->textField($model,'tahun_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun'); ?>
		<?php echo $form->textField($model,'tahun',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'tahun'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester'); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_tahun'); ?>
		<?php echo $form->textField($model,'nama_tahun',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_tahun'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'krs_mulai'); ?>
		<?php echo $form->textField($model,'krs_mulai'); ?>
		<?php echo $form->error($model,'krs_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'krs_selesai'); ?>
		<?php echo $form->textField($model,'krs_selesai'); ?>
		<?php echo $form->error($model,'krs_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'krs_online_mulai'); ?>
		<?php echo $form->textField($model,'krs_online_mulai'); ?>
		<?php echo $form->error($model,'krs_online_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'krs_online_selesai'); ?>
		<?php echo $form->textField($model,'krs_online_selesai'); ?>
		<?php echo $form->error($model,'krs_online_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'krs_ubah_mulai'); ?>
		<?php echo $form->textField($model,'krs_ubah_mulai'); ?>
		<?php echo $form->error($model,'krs_ubah_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'krs_ubah_selesai'); ?>
		<?php echo $form->textField($model,'krs_ubah_selesai'); ?>
		<?php echo $form->error($model,'krs_ubah_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kss_cetak_mulai'); ?>
		<?php echo $form->textField($model,'kss_cetak_mulai'); ?>
		<?php echo $form->error($model,'kss_cetak_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kss_cetak_selesai'); ?>
		<?php echo $form->textField($model,'kss_cetak_selesai'); ?>
		<?php echo $form->error($model,'kss_cetak_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cuti'); ?>
		<?php echo $form->textField($model,'cuti'); ?>
		<?php echo $form->error($model,'cuti'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mundur'); ?>
		<?php echo $form->textField($model,'mundur'); ?>
		<?php echo $form->error($model,'mundur'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bayar_mulai'); ?>
		<?php echo $form->textField($model,'bayar_mulai'); ?>
		<?php echo $form->error($model,'bayar_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bayar_selesai'); ?>
		<?php echo $form->textField($model,'bayar_selesai'); ?>
		<?php echo $form->error($model,'bayar_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kuliah_mulai'); ?>
		<?php echo $form->textField($model,'kuliah_mulai'); ?>
		<?php echo $form->error($model,'kuliah_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kuliah_selesai'); ?>
		<?php echo $form->textField($model,'kuliah_selesai'); ?>
		<?php echo $form->error($model,'kuliah_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uts_mulai'); ?>
		<?php echo $form->textField($model,'uts_mulai'); ?>
		<?php echo $form->error($model,'uts_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uts_selesai'); ?>
		<?php echo $form->textField($model,'uts_selesai'); ?>
		<?php echo $form->error($model,'uts_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uas_mulai'); ?>
		<?php echo $form->textField($model,'uas_mulai'); ?>
		<?php echo $form->error($model,'uas_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uas_selesai'); ?>
		<?php echo $form->textField($model,'uas_selesai'); ?>
		<?php echo $form->error($model,'uas_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nilai'); ?>
		<?php echo $form->textField($model,'nilai'); ?>
		<?php echo $form->error($model,'nilai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'akhir_kss'); ?>
		<?php echo $form->textField($model,'akhir_kss'); ?>
		<?php echo $form->error($model,'akhir_kss'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proses_buka'); ?>
		<?php echo $form->textField($model,'proses_buka'); ?>
		<?php echo $form->error($model,'proses_buka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proses_ipk'); ?>
		<?php echo $form->textField($model,'proses_ipk'); ?>
		<?php echo $form->error($model,'proses_ipk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proses_tutup'); ?>
		<?php echo $form->textField($model,'proses_tutup'); ?>
		<?php echo $form->error($model,'proses_tutup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'buka'); ?>
		<?php echo $form->textField($model,'buka',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'buka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'syarat_krs'); ?>
		<?php echo $form->textField($model,'syarat_krs',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'syarat_krs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'syarat_krs_ips'); ?>
		<?php echo $form->textField($model,'syarat_krs_ips',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'syarat_krs_ips'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cuti_selesai'); ?>
		<?php echo $form->textField($model,'cuti_selesai'); ?>
		<?php echo $form->error($model,'cuti_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_sks'); ?>
		<?php echo $form->textField($model,'max_sks'); ?>
		<?php echo $form->error($model,'max_sks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->