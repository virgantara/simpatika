<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'USERNAME'); ?>
		<?php echo $form->textField($model,'USERNAME',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'USERNAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LEVEL'); ?>
		<?php 
		// echo $form->textField($model,'LEVEL'); 
 		echo $form->radioButtonList($model, 
 			'LEVEL', 
 			array('1'=> 'Super Admin','2'=>'BAAK', '3'=>'Prodi'),
 			array(
    'labelOptions'=>array('style'=>'display:inline'), // add this code
    'separator'=>'  ',

 			)); 
		?>
		<?php echo $form->error($model,'LEVEL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'STATUS'); ?>
		<?php
		echo $form->radioButtonList($model, 
 			'STATUS', 
 			array('1'=> 'AKTIF','0'=>'NON-AKTIF'),
 			array(
    'labelOptions'=>array('style'=>'display:inline'), // add this code
    'separator'=>'  ',

 			));  
		// echo $form->textField($model,'STATUS'); 

		?>
		<?php echo $form->error($model,'STATUS'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->