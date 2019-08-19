<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */
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
		<?php echo $form->textField($model,'kode_pt',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_fak'); ?>
		<?php echo $form->textField($model,'kode_fak',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jenjang'); ?>
		<?php echo $form->textField($model,'kode_jenjang',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jurusan'); ?>
		<?php echo $form->textField($model,'kode_jurusan',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_mk'); ?>
		<?php echo $form->textField($model,'kode_mk',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_mk'); ?>
		<?php echo $form->textField($model,'nama_mk',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks'); ?>
		<?php echo $form->textField($model,'sks',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mahasiswa'); ?>
		<?php echo $form->textField($model,'mahasiswa',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_dosen'); ?>
		<?php echo $form->textField($model,'kode_dosen',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'namadosen'); ?>
		<?php echo $form->textField($model,'namadosen',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester'); ?>
		<?php echo $form->textField($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jadwal'); ?>
		<?php echo $form->textField($model,'kode_jadwal',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'harian'); ?>
		<?php echo $form->textField($model,'harian',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'normatif'); ?>
		<?php echo $form->textField($model,'normatif',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uts'); ?>
		<?php echo $form->textField($model,'uts',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uas'); ?>
		<?php echo $form->textField($model,'uas',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nilai_angka'); ?>
		<?php echo $form->textField($model,'nilai_angka',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nilai_huruf'); ?>
		<?php echo $form->textField($model,'nilai_huruf',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bobot_nilai'); ?>
		<?php echo $form->textField($model,'bobot_nilai',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_akademik'); ?>
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester_matakuliah'); ?>
		<?php echo $form->textField($model,'semester_matakuliah',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_publis'); ?>
		<?php echo $form->textField($model,'status_publis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah_nilai'); ?>
		<?php echo $form->textField($model,'jumlah_nilai',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_krs'); ?>
		<?php echo $form->textField($model,'status_krs',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lulus'); ?>
		<?php echo $form->textField($model,'lulus',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pindahan'); ?>
		<?php echo $form->textField($model,'pindahan',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_approved'); ?>
		<?php echo $form->textField($model,'is_approved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sudah_ekd'); ?>
		<?php echo $form->textField($model,'sudah_ekd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'score_ekd'); ?>
		<?php echo $form->textField($model,'score_ekd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->