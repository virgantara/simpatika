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
		<?php echo $form->labelEx($model,'buka'); ?>
		<?php echo $form->dropDownList($model,'buka',array('Y'=>'Y','N'=>'N')); ?>
		<?php echo $form->error($model,'buka'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->