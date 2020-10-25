<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,'<div class="alert alert-danger">Silakan perbaiki beberapa kesalahan berikut:','</div>'); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'role_id', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'role_id'); ?>
		<?php echo $form->error($model,'role_id'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password_hash', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'password_hash',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'password_hash'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'reset_hash', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'reset_hash',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'reset_hash'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'last_login', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'last_login'); ?>
		<?php echo $form->error($model,'last_login'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'last_ip', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'8')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'last_ip',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'last_ip'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'created_on', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'9')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'deleted', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'10')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'reset_by', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'11')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'reset_by'); ?>
		<?php echo $form->error($model,'reset_by'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'banned', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'12')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'banned'); ?>
		<?php echo $form->error($model,'banned'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ban_message', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'13')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'ban_message',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ban_message'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'display_name', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'14')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'display_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'display_name'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'display_name_changed', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'15')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'display_name_changed'); ?>
		<?php echo $form->error($model,'display_name_changed'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'timezone', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'16')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'timezone',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'timezone'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'language', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'17')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'language',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'language'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'active', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'18')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'activate_hash', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'19')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'activate_hash',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'activate_hash'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password_iterations', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'20')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'password_iterations'); ?>
		<?php echo $form->error($model,'password_iterations'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'force_password_reset', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'21')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'force_password_reset'); ?>
		<?php echo $form->error($model,'force_password_reset'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nim', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'22')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nim',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'nim'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_data', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'23')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_data'); ?>
		<?php echo $form->error($model,'status_data'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kampus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'24')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kampus',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kampus'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fakultas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'25')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'fakultas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fakultas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'26')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'prodi'); ?>
		</div>
	</div>

	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Simpan
          </button>
	  </div>
      </div>
             

<?php $this->endWidget(); ?>
