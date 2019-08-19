<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'datakrs-form',
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
		<?php echo $form->labelEx($model,'kode_pt', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'2')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_pt',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_pt'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_fak', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_fak',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_fak'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_jenjang', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_jenjang',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'kode_jenjang'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_jurusan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'5')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_jurusan',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_jurusan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_prodi',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_mk', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_mk',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kode_mk'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_mk', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'8')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_mk',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nama_mk'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sks', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'9')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sks',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sks'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'mahasiswa', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'10')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'mahasiswa',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'mahasiswa'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_dosen', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'11')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_dosen',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kode_dosen'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'namadosen', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'12')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'namadosen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'namadosen'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'13')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'semester'); ?>
		<?php echo $form->error($model,'semester'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_jadwal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'14')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_jadwal',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_jadwal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kelas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'15')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kelas',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kelas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'harian', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'16')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'harian',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'harian'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'normatif', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'17')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'normatif',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'normatif'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'uts', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'18')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'uts',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'uts'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'uas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'19')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'uas',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'uas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nilai_angka', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'20')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nilai_angka',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'nilai_angka'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nilai_huruf', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'21')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nilai_huruf',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'nilai_huruf'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'bobot_nilai', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'22')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'bobot_nilai',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'bobot_nilai'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'created_date', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'23')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun_akademik', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'24')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahun_akademik',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'25')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'status'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester_matakuliah', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'26')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'semester_matakuliah',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'semester_matakuliah'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_publis', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'27')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_publis'); ?>
		<?php echo $form->error($model,'status_publis'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jumlah_nilai', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'28')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jumlah_nilai',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'jumlah_nilai'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_krs', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'29')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_krs',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'status_krs'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'lulus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'30')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'lulus',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'lulus'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pindahan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'31')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'pindahan',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'pindahan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'created', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'32')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'is_approved', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'33')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'is_approved'); ?>
		<?php echo $form->error($model,'is_approved'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sudah_ekd', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'34')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'sudah_ekd'); ?>
		<?php echo $form->error($model,'sudah_ekd'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'score_ekd', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'35')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'score_ekd'); ?>
		<?php echo $form->error($model,'score_ekd'); ?>
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
