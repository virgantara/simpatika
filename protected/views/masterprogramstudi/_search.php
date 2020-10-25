<?php
/* @var $this MasterprogramstudiController */
/* @var $model Masterprogramstudi */
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
		<?php echo $form->label($model,'gelar_lulusan'); ?>
		<?php echo $form->textField($model,'gelar_lulusan',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gelar_lulusan_en'); ?>
		<?php echo $form->textField($model,'gelar_lulusan_en',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gelar_lulusan_short'); ?>
		<?php echo $form->textField($model,'gelar_lulusan_short',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_prodi'); ?>
		<?php echo $form->textField($model,'nama_prodi',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_prodi_en'); ?>
		<?php echo $form->textField($model,'nama_prodi_en',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester_awal'); ?>
		<?php echo $form->textField($model,'semester_awal',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_sk_dikti'); ?>
		<?php echo $form->textField($model,'no_sk_dikti',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_sk_dikti'); ?>
		<?php echo $form->textField($model,'tgl_sk_dikti'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_akhir_sk_dikti'); ?>
		<?php echo $form->textField($model,'tgl_akhir_sk_dikti'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jml_sks_lulus'); ?>
		<?php echo $form->textField($model,'jml_sks_lulus',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_status'); ?>
		<?php echo $form->textField($model,'kode_status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_semester_mulai'); ?>
		<?php echo $form->textField($model,'tahun_semester_mulai',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_prodi'); ?>
		<?php echo $form->textField($model,'email_prodi',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_pendirian_program_studi'); ?>
		<?php echo $form->textField($model,'tgl_pendirian_program_studi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_sk_akreditasi'); ?>
		<?php echo $form->textField($model,'no_sk_akreditasi',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_sk_akreditasi'); ?>
		<?php echo $form->textField($model,'tgl_sk_akreditasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_akhir_sk_akreditasi'); ?>
		<?php echo $form->textField($model,'tgl_akhir_sk_akreditasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_status_akreditasi'); ?>
		<?php echo $form->textField($model,'kode_status_akreditasi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frekuensi_kurikulum'); ?>
		<?php echo $form->textField($model,'frekuensi_kurikulum',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pelaksanaan_kurikulum'); ?>
		<?php echo $form->textField($model,'pelaksanaan_kurikulum',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nidn_ketua_prodi'); ?>
		<?php echo $form->textField($model,'nidn_ketua_prodi',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telp_ketua_prodi'); ?>
		<?php echo $form->textField($model,'telp_ketua_prodi',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fax_prodi'); ?>
		<?php echo $form->textField($model,'fax_prodi',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_operator'); ?>
		<?php echo $form->textField($model,'nama_operator',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hp_operator'); ?>
		<?php echo $form->textField($model,'hp_operator',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telepon_program_studi'); ?>
		<?php echo $form->textField($model,'telepon_program_studi',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'singkatan'); ?>
		<?php echo $form->textField($model,'singkatan',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_feeder'); ?>
		<?php echo $form->textField($model,'kode_feeder',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->