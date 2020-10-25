<?php
/* @var $this SkController */
/* @var $model Sk */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sk-form',
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
		<?php echo $form->labelEx($model,'kode_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'kode_prodi',CHtml::listData(Masterprogramstudi::model()->findAll(),'kode_prodi','nama_prodi'),['empty'=>'- Pilih Prodi -']); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'judul', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'judul',array('size'=>255,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'judul'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nomor_sk', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nomor_sk',array('size'=>255,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nomor_sk'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tanggal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tanggal',array('size'=>255,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tanggal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tentang', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tentang',array('size'=>255,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tentang'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'buka', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->checkBox($model,'buka'); ?>
		<?php echo $form->error($model,'buka'); ?>
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
