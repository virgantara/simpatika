<?php
/* @var $this JadwalLampiranSkController */
/* @var $model JadwalLampiranSk */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-lampiran-sk-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nomor_sk'); ?>
		<?php echo $form->textField($model,'nomor_sk',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nomor_sk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_sk'); ?>
		<?php echo $form->textField($model,'tanggal_sk',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tanggal_sk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tentang'); ?>
		<?php echo $form->textArea($model,'tentang',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tentang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_penetapan'); ?>
		<?php echo $form->textField($model,'tanggal_penetapan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tanggal_penetapan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bunyi_lampiran'); ?>
		<?php echo $form->textArea($model,'bunyi_lampiran',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'bunyi_lampiran'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->