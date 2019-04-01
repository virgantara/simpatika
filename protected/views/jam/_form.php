<?php
/* @var $this JamController */
/* @var $model Jam */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui-timepicker-addon.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui-timepicker-addon.min.css"> 

<script type="text/javascript">
	$(document).ready(function(){
		$('#Jam_jam_mulai, #Jam_jam_selesai').timepicker({
			
			stepMinute: 5,
			controlType: 'select',
			oneLine: true,
		});
		
	});
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_jam'); ?>
		<?php echo $form->textField($model,'nama_jam',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_jam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_mulai'); ?>
		<?php echo $form->textField($model,'jam_mulai'); ?>
		<?php echo $form->error($model,'jam_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_selesai'); ?>
		<?php echo $form->textField($model,'jam_selesai'); ?>
		<?php echo $form->error($model,'jam_selesai'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

