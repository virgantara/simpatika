<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'role_id'); ?>
		<?php echo $form->textField($model,'role_id'); ?>
		<?php echo $form->error($model,'role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_hash'); ?>
		<?php echo $form->textField($model,'password_hash',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reset_hash'); ?>
		<?php echo $form->textField($model,'reset_hash',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'reset_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_login'); ?>
		<?php echo $form->textField($model,'last_login'); ?>
		<?php echo $form->error($model,'last_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_ip'); ?>
		<?php echo $form->textField($model,'last_ip',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'last_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reset_by'); ?>
		<?php echo $form->textField($model,'reset_by'); ?>
		<?php echo $form->error($model,'reset_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'banned'); ?>
		<?php echo $form->textField($model,'banned'); ?>
		<?php echo $form->error($model,'banned'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ban_message'); ?>
		<?php echo $form->textField($model,'ban_message',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ban_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'display_name'); ?>
		<?php echo $form->textField($model,'display_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'display_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'display_name_changed'); ?>
		<?php echo $form->textField($model,'display_name_changed'); ?>
		<?php echo $form->error($model,'display_name_changed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timezone'); ?>
		<?php echo $form->textField($model,'timezone',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'timezone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activate_hash'); ?>
		<?php echo $form->textField($model,'activate_hash',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'activate_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_iterations'); ?>
		<?php echo $form->textField($model,'password_iterations'); ?>
		<?php echo $form->error($model,'password_iterations'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'force_password_reset'); ?>
		<?php echo $form->textField($model,'force_password_reset'); ?>
		<?php echo $form->error($model,'force_password_reset'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nim'); ?>
		<?php echo $form->textField($model,'nim',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'nim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_data'); ?>
		<?php echo $form->textField($model,'status_data'); ?>
		<?php echo $form->error($model,'status_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kampus'); ?>
		<?php echo $form->textField($model,'kampus',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kampus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fakultas'); ?>
		<?php echo $form->textField($model,'fakultas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fakultas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prodi'); ?>
		<?php echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'prodi'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->