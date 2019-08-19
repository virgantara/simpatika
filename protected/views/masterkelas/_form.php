<?php
/* @var $this MasterkelasController */
/* @var $model Masterkelas */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masterkelas-form',
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
		<?php echo $form->labelEx($model,'tahun_akademik', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kd_kelas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kd_kelas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kd_kelas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_kelas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_kelas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nama_kelas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kuota', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kuota',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kuota'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'keterangan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'keterangan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'id_kampus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'id_kampus'); ?>
		<?php echo $form->error($model,'id_kampus'); ?>
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
