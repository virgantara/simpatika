<?php
/* @var $this PencekalanController */
/* @var $model Pencekalan */
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
		<?php echo $form->label($model,'nim'); ?>
		<?php echo $form->textField($model,'nim',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahfidz'); ?>
		<?php echo $form->textField($model,'tahfidz'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adm'); ?>
		<?php echo $form->textField($model,'adm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'akpam'); ?>
		<?php echo $form->textField($model,'akpam'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'akademik'); ?>
		<?php echo $form->textField($model,'akademik'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
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