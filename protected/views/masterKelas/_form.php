<?php
/* @var $this MasterkelasController */
/* @var $model Masterkelas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masterkelas-form',
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
		<?php echo $form->labelEx($model,'kd_kelas'); ?>
		<?php echo $form->textField($model,'kd_kelas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kd_kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_kelas'); ?>
		<?php echo $form->textField($model,'nama_kelas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nama_kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kuota'); ?>
		<?php echo $form->textField($model,'kuota',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kuota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->