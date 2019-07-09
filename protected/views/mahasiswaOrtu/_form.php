<?php
/* @var $this MahasiswaOrtuController */
/* @var $model MahasiswaOrtu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-ortu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nim'); ?>
		<?php echo $form->textField($model,'nim',array('size'=>20,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'nim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hubungan'); ?>
		<?php echo $form->dropDownList($model,'hubungan',['AYAH'=>'AYAH','IBU'=>'IBU','WALI'=>'WALI']); ?>
		<?php echo $form->error($model,'hubungan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agama'); ?>
		<?php echo $form->dropDownList($model,'agama',$list_agama); ?>
		<?php echo $form->error($model,'agama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pendidikan'); ?>
		<?php echo $form->dropDownList($model,'pendidikan',$list_pendidikan); ?>
		<?php echo $form->error($model,'pendidikan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pekerjaan'); ?>
		<?php echo $form->dropDownList($model,'pekerjaan',$list_pekerjaan); ?>
		<?php echo $form->error($model,'pekerjaan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'penghasilan'); ?>
		<?php echo $form->dropDownList($model,'penghasilan',$list_penghasilan); ?>
		<?php echo $form->error($model,'penghasilan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hidup'); ?>
		<?php echo $form->dropDownList($model,'hidup',$list_keadaan); ?>
		<?php echo $form->error($model,'hidup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat'); ?>
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alamat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kota'); ?>
		<?php echo $form->textField($model,'kota',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'propinsi'); ?>
		<?php echo $form->textField($model,'propinsi',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'propinsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'negara'); ?>
		<?php echo $form->textField($model,'negara',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'negara'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pos'); ?>
		<?php echo $form->textField($model,'pos',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telepon'); ?>
		<?php echo $form->textField($model,'telepon',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telepon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hp'); ?>
		<?php echo $form->textField($model,'hp',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->