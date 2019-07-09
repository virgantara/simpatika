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
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
)); ?>
<?php 

echo CHtml::hiddenField('kampus',$kampus ?: '');
echo CHtml::hiddenField('kode_prodi',$kode_prodi ?: '');
echo CHtml::hiddenField('tahun_angkatan',$tahun_angkatan ?: '');
 ?> 
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,'<div class="alert alert-danger">','</div>'); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nim',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nim',array('size'=>20,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'nim'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hubungan',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'hubungan',['AYAH'=>'AYAH','IBU'=>'IBU','WALI'=>'WALI']); ?>
		<?php echo $form->error($model,'hubungan'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'agama',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'agama',$list_agama); ?>
		<?php echo $form->error($model,'agama'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pendidikan',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'pendidikan',$list_pendidikan); ?>
		<?php echo $form->error($model,'pendidikan'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pekerjaan',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'pekerjaan',$list_pekerjaan); ?>
		<?php echo $form->error($model,'pekerjaan'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'penghasilan',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'penghasilan',$list_penghasilan); ?>
		<?php echo $form->error($model,'penghasilan'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hidup',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->dropDownList($model,'hidup',$list_keadaan); ?>
		<?php echo $form->error($model,'hidup'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alamat',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alamat'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kota',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kota',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kota'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'propinsi',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'propinsi',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'propinsi'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'negara',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'negara',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'negara'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pos',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'pos',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pos'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telepon',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'telepon',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telepon'); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hp',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'hp',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hp'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'email',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Save
          </button>
	</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->