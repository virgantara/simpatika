<?php
/* @var $this PencekalanController */
/* @var $model Pencekalan */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pencekalan-form',
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
		<?php echo $form->labelEx($model,'tahun_id', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahun_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_id'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nim', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nim',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nim'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahfidz', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahfidz'); ?>
		<?php echo $form->error($model,'tahfidz'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'adm', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'adm'); ?>
		<?php echo $form->error($model,'adm'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'akpam', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'akpam'); ?>
		<?php echo $form->error($model,'akpam'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'akademik', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'akademik'); ?>
		<?php echo $form->error($model,'akademik'); ?>
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
