<?php
/* @var $this TahunakademikController */
/* @var $model Tahunakademik */
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
		<?php echo $form->label($model,'tahun_id'); ?>
		<?php echo $form->textField($model,'tahun_id',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun'); ?>
		<?php echo $form->textField($model,'tahun',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester'); ?>
		<?php echo $form->textField($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_tahun'); ?>
		<?php echo $form->textField($model,'nama_tahun',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'krs_mulai'); ?>
		<?php echo $form->textField($model,'krs_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'krs_selesai'); ?>
		<?php echo $form->textField($model,'krs_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'krs_online_mulai'); ?>
		<?php echo $form->textField($model,'krs_online_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'krs_online_selesai'); ?>
		<?php echo $form->textField($model,'krs_online_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'krs_ubah_mulai'); ?>
		<?php echo $form->textField($model,'krs_ubah_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'krs_ubah_selesai'); ?>
		<?php echo $form->textField($model,'krs_ubah_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kss_cetak_mulai'); ?>
		<?php echo $form->textField($model,'kss_cetak_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kss_cetak_selesai'); ?>
		<?php echo $form->textField($model,'kss_cetak_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuti'); ?>
		<?php echo $form->textField($model,'cuti'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mundur'); ?>
		<?php echo $form->textField($model,'mundur'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bayar_mulai'); ?>
		<?php echo $form->textField($model,'bayar_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bayar_selesai'); ?>
		<?php echo $form->textField($model,'bayar_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kuliah_mulai'); ?>
		<?php echo $form->textField($model,'kuliah_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kuliah_selesai'); ?>
		<?php echo $form->textField($model,'kuliah_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uts_mulai'); ?>
		<?php echo $form->textField($model,'uts_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uts_selesai'); ?>
		<?php echo $form->textField($model,'uts_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uas_mulai'); ?>
		<?php echo $form->textField($model,'uas_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uas_selesai'); ?>
		<?php echo $form->textField($model,'uas_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nilai'); ?>
		<?php echo $form->textField($model,'nilai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'akhir_kss'); ?>
		<?php echo $form->textField($model,'akhir_kss'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proses_buka'); ?>
		<?php echo $form->textField($model,'proses_buka'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proses_ipk'); ?>
		<?php echo $form->textField($model,'proses_ipk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proses_tutup'); ?>
		<?php echo $form->textField($model,'proses_tutup'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'buka'); ?>
		<?php echo $form->textField($model,'buka',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'syarat_krs'); ?>
		<?php echo $form->textField($model,'syarat_krs',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'syarat_krs_ips'); ?>
		<?php echo $form->textField($model,'syarat_krs_ips',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuti_selesai'); ?>
		<?php echo $form->textField($model,'cuti_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_sks'); ?>
		<?php echo $form->textField($model,'max_sks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->