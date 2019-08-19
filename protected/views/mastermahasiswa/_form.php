<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mastermahasiswa-form',
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
		<?php echo $form->textField($model,'kode_pt',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_pt'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_fakultas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'3')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_fakultas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'4')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_prodi',array('size'=>5,'maxlength'=>5)); ?>
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
		<?php echo $form->labelEx($model,'nim_mhs', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'6')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nim_mhs',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nim_mhs'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_mahasiswa', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'7')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_mahasiswa',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nama_mahasiswa'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tempat_lahir', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'8')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tempat_lahir',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tempat_lahir'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_lahir', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'9')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_lahir'); ?>
		<?php echo $form->error($model,'tgl_lahir'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jenis_kelamin', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'10')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jenis_kelamin',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'jenis_kelamin'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun_masuk', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'11')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tahun_masuk',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'tahun_masuk'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester_awal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'12')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'semester_awal',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester_awal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'batas_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'13')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'batas_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'batas_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'asal_propinsi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'14')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'asal_propinsi',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'asal_propinsi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_masuk', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'15')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_masuk'); ?>
		<?php echo $form->error($model,'tgl_masuk'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_lulus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'16')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_lulus'); ?>
		<?php echo $form->error($model,'tgl_lulus'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_aktivitas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'17')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_aktivitas',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'status_aktivitas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_awal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'18')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_awal',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'status_awal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jml_sks_diakui', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'19')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jml_sks_diakui',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'jml_sks_diakui'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nim_asal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'20')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nim_asal',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'nim_asal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'asal_pt', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'21')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'asal_pt',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'asal_pt'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_asal_pt', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'22')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nama_asal_pt',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nama_asal_pt'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'asal_jenjang_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'23')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'asal_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'asal_jenjang_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'asal_prodi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'24')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'asal_prodi',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'asal_prodi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_biaya_studi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'25')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_biaya_studi',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'kode_biaya_studi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_pekerjaan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'26')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_pekerjaan',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'kode_pekerjaan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tempat_kerja', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'27')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tempat_kerja',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'tempat_kerja'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_pt_kerja', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'28')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_pt_kerja',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'kode_pt_kerja'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_ps_kerja', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'29')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_ps_kerja',array('size'=>44,'maxlength'=>44)); ?>
		<?php echo $form->error($model,'kode_ps_kerja'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nip_promotor', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'30')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nip_promotor',array('size'=>44,'maxlength'=>44)); ?>
		<?php echo $form->error($model,'nip_promotor'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nip_co_promotor1', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'31')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nip_co_promotor1',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'nip_co_promotor1'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nip_co_promotor2', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'32')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nip_co_promotor2',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'nip_co_promotor2'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nip_co_promotor3', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'33')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nip_co_promotor3',array('size'=>33,'maxlength'=>33)); ?>
		<?php echo $form->error($model,'nip_co_promotor3'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nip_co_promotor4', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'34')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nip_co_promotor4',array('size'=>44,'maxlength'=>44)); ?>
		<?php echo $form->error($model,'nip_co_promotor4'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'photo_mahasiswa', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'35')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'photo_mahasiswa',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_mahasiswa'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'36')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'keterangan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'37')); ?>
		<div class="col-sm-9">
		<?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_bayar', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'38')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_bayar'); ?>
		<?php echo $form->error($model,'status_bayar'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telepon', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'39')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'telepon',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'telepon'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hp', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'40')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'hp',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'hp'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'41')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alamat', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'42')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alamat'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'berat', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'43')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'berat',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'berat'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tinggi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'44')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tinggi',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'tinggi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ktp', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'45')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'ktp',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'ktp'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'rt', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'46')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'rt',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'rt'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'rw', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'47')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'rw',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'rw'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'dusun', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'48')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'dusun',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dusun'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_pos', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'49')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_pos',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_pos'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'desa', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'50')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'desa',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'desa'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kecamatan', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'51')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kecamatan',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'kecamatan'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kecamatan_feeder', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'52')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kecamatan_feeder',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kecamatan_feeder'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jenis_tinggal', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'53')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jenis_tinggal',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jenis_tinggal'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'penerima_kps', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'54')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'penerima_kps',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'penerima_kps'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'no_kps', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'55')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'no_kps',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'no_kps'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'provinsi', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'56')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'provinsi',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'provinsi'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kabupaten', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'57')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kabupaten',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kabupaten'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_warga', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'58')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_warga',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'status_warga'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'warga_negara', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'59')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'warga_negara',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'warga_negara'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'warga_negara_feeder', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'60')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'warga_negara_feeder',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'warga_negara_feeder'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_sipil', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'61')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_sipil',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'status_sipil'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'agama', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'62')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'agama',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'agama'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gol_darah', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'63')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'gol_darah',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'gol_darah'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'masuk_kelas', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'64')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'masuk_kelas',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'masuk_kelas'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_sk_yudisium', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'65')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'tgl_sk_yudisium'); ?>
		<?php echo $form->error($model,'tgl_sk_yudisium'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_mahasiswa', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'66')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'status_mahasiswa'); ?>
		<?php echo $form->error($model,'status_mahasiswa'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kampus', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'67')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'kampus'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jur_thn_smta', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'68')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'jur_thn_smta',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'jur_thn_smta'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'is_synced', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'69')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'is_synced'); ?>
		<?php echo $form->error($model,'is_synced'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_pd', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'70')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kode_pd',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'kode_pd'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'va_code', array ('class'=>'col-sm-3 control-label no-padding-right', 'tabindex'=>'71')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'va_code',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'va_code'); ?>
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
