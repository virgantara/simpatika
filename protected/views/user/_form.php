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
		<?php echo $form->labelEx($model,'level'); ?>
		<?php 
		// echo $form->textField($model,'LEVEL'); 
 		echo $form->radioButtonList($model, 
 			'level', 
 			array('1'=> 'Super Admin','2'=>'BAAK', '3'=>'Prodi'),
 			array(
    'labelOptions'=>array('style'=>'display:inline'), // add this code
    'separator'=>'  ',

 			)); 
		?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php 
		 echo $form->labelEx($model,'kode_prodi'); 
		 $list = CHtml::listData(Masterprogramstudi::model()->findAll(),'kode_prodi','nama_prodi');

       echo $form->dropDownList($model, 'kode_prodi',$list,array('empty'=> 'Pilih Prodi'));
       echo $form->error($model,'kode_prodi'); 
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php
		echo $form->radioButtonList($model, 
 			'status', 
 			array('1'=> 'AKTIF','0'=>'NON-AKTIF'),
 			array(
    'labelOptions'=>array('style'=>'display:inline'), // add this code
    'separator'=>'  ',

 			));  
		// echo $form->textField($model,'STATUS'); 

		?>
		<?php echo $form->error($model,'STATUS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'repeat_password'); ?>
		<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->