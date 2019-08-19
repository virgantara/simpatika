<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mastermatakuliah-form',
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
		<?php echo $form->labelEx($model,'kode_feeder', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_feeder',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kode_feeder'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun_akademik', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_pt', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_pt',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_pt'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_fakultas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_fakultas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_prodi',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_jenjang_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jenjang_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_mata_kuliah', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'8')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_mata_kuliah',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'kode_mata_kuliah'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_mata_kuliah', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'9')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_mata_kuliah',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_mata_kuliah'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sks', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'10')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sks',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sks_tatap_muka', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'11')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sks_tatap_muka',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks_tatap_muka'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sks_praktikum', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'12')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sks_praktikum',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks_praktikum'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sks_praktek_lap', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'13')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sks_praktek_lap',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks_praktek_lap'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'14')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_kelompok', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'15')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_kelompok',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_kelompok'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_kurikulum', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'16')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_kurikulum',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'kode_kurikulum'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_matkul', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'17')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_matkul',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_matkul'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nidn', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'18')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nidn',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nidn'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jenjang_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'19')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jenjang_prodi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'jenjang_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'prodi_pengampu', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'20')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'prodi_pengampu',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prodi_pengampu'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_mata_kuliah', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'21')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_mata_kuliah',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'status_mata_kuliah'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'silabus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'22')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'silabus',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'silabus'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sap', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'23')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sap',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sap'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'bahan_ajar', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'24')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'bahan_ajar',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'bahan_ajar'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'diktat', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'25')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'diktat',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'diktat'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_wajib', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'26')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_wajib',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'status_wajib'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sms', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'27')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sms',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sms'); ?>
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
