<?php
/* @var $this MasterprogramstudiController */
/* @var $model Masterprogramstudi */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masterprogramstudi-form',
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
		<?php echo $form->labelEx($model,'kode_fakultas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_fakultas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_jurusan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_jurusan',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jurusan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_prodi',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_jenjang_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jenjang_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gelar_lulusan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'gelar_lulusan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'gelar_lulusan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gelar_lulusan_en', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'gelar_lulusan_en',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'gelar_lulusan_en'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gelar_lulusan_short', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'8')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'gelar_lulusan_short',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'gelar_lulusan_short'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'9')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_prodi',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_prodi_en', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'10')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_prodi_en',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nama_prodi_en'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester_awal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'11')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'semester_awal',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester_awal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'no_sk_dikti', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'12')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'no_sk_dikti',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'no_sk_dikti'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_sk_dikti', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'13')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_sk_dikti'); ?>
		<?php echo $form->error($model,'tgl_sk_dikti'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_akhir_sk_dikti', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'14')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_akhir_sk_dikti'); ?>
		<?php echo $form->error($model,'tgl_akhir_sk_dikti'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jml_sks_lulus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'15')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jml_sks_lulus',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'jml_sks_lulus'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_status', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'16')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'kode_status'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun_semester_mulai', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'17')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahun_semester_mulai',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'tahun_semester_mulai'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'18')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'email_prodi',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_pendirian_program_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'19')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_pendirian_program_studi'); ?>
		<?php echo $form->error($model,'tgl_pendirian_program_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'no_sk_akreditasi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'20')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'no_sk_akreditasi',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'no_sk_akreditasi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_sk_akreditasi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'21')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_sk_akreditasi'); ?>
		<?php echo $form->error($model,'tgl_sk_akreditasi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_akhir_sk_akreditasi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'22')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_akhir_sk_akreditasi'); ?>
		<?php echo $form->error($model,'tgl_akhir_sk_akreditasi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_status_akreditasi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'23')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_status_akreditasi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_status_akreditasi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'frekuensi_kurikulum', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'24')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'frekuensi_kurikulum',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'frekuensi_kurikulum'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pelaksanaan_kurikulum', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'25')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'pelaksanaan_kurikulum',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pelaksanaan_kurikulum'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nidn_ketua_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'26')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nidn_ketua_prodi',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nidn_ketua_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telp_ketua_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'27')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'telp_ketua_prodi',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'telp_ketua_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fax_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'28')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'fax_prodi',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'fax_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_operator', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'29')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_operator',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_operator'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hp_operator', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'30')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'hp_operator',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'hp_operator'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telepon_program_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'31')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'telepon_program_studi',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'telepon_program_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'singkatan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'32')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'singkatan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'singkatan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_feeder', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'33')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_feeder',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kode_feeder'); ?>
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
