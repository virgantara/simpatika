<?php
/* @var $this JamController */
/* @var $model Jam */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nama_jam'); ?>
		<?php echo $form->textField($model,'nama_jam',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->label($model,'id_jam'); ?>
		<?php echo $form->textField($model,'id_jam'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prefix'); ?>
		<?php echo $form->textField($model,'prefix',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->