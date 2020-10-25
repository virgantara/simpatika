<?php
/* @var $this JamController */
/* @var $model Jam */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
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
		<?php echo $form->labelEx($model,'nama_jam', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'1')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_jam',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_jam'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jam_mulai', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jam_mulai'); ?>
		<?php echo $form->error($model,'jam_mulai'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jam_selesai', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jam_selesai'); ?>
		<?php echo $form->error($model,'jam_selesai'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'prefix', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'prefix',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prefix'); ?>
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
