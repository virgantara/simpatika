<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mastermahasiswa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_pt'); ?>
		<?php echo $form->textField($model,'kode_pt',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_pt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_fakultas'); ?>
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_fakultas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_jenjang_studi'); ?>
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_jenjang_studi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nim_mhs'); ?>
		<?php echo $form->textField($model,'nim_mhs',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nim_mhs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_mahasiswa'); ?>
		<?php echo $form->textField($model,'nama_mahasiswa',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_mahasiswa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tempat_lahir'); ?>
		<?php echo $form->textField($model,'tempat_lahir',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tempat_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_lahir'); ?>
		<?php echo $form->textField($model,'tgl_lahir'); ?>
		<?php echo $form->error($model,'tgl_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis_kelamin'); ?>
		<?php echo $form->textField($model,'jenis_kelamin',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'jenis_kelamin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_masuk'); ?>
		<?php echo $form->textField($model,'tahun_masuk',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'tahun_masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester_awal'); ?>
		<?php echo $form->textField($model,'semester_awal',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester_awal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'batas_studi'); ?>
		<?php echo $form->textField($model,'batas_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'batas_studi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asal_propinsi'); ?>
		<?php echo $form->textField($model,'asal_propinsi',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'asal_propinsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_masuk'); ?>
		<?php echo $form->textField($model,'tgl_masuk'); ?>
		<?php echo $form->error($model,'tgl_masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_lulus'); ?>
		<?php echo $form->textField($model,'tgl_lulus'); ?>
		<?php echo $form->error($model,'tgl_lulus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_aktivitas'); ?>
		<?php echo $form->textField($model,'status_aktivitas',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'status_aktivitas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_awal'); ?>
		<?php echo $form->textField($model,'status_awal',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'status_awal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jml_sks_diakui'); ?>
		<?php echo $form->textField($model,'jml_sks_diakui',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'jml_sks_diakui'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nim_asal'); ?>
		<?php echo $form->textField($model,'nim_asal',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'nim_asal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asal_pt'); ?>
		<?php echo $form->textField($model,'asal_pt',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'asal_pt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_asal_pt'); ?>
		<?php echo $form->textField($model,'nama_asal_pt',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'nama_asal_pt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asal_jenjang_studi'); ?>
		<?php echo $form->textField($model,'asal_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'asal_jenjang_studi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asal_prodi'); ?>
		<?php echo $form->textField($model,'asal_prodi',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'asal_prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_biaya_studi'); ?>
		<?php echo $form->textField($model,'kode_biaya_studi',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'kode_biaya_studi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_pekerjaan'); ?>
		<?php echo $form->textField($model,'kode_pekerjaan',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'kode_pekerjaan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tempat_kerja'); ?>
		<?php echo $form->textField($model,'tempat_kerja',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'tempat_kerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_pt_kerja'); ?>
		<?php echo $form->textField($model,'kode_pt_kerja',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'kode_pt_kerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_ps_kerja'); ?>
		<?php echo $form->textField($model,'kode_ps_kerja',array('size'=>44,'maxlength'=>44)); ?>
		<?php echo $form->error($model,'kode_ps_kerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nip_promotor'); ?>
		<?php echo $form->textField($model,'nip_promotor',array('size'=>44,'maxlength'=>44)); ?>
		<?php echo $form->error($model,'nip_promotor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nip_co_promotor1'); ?>
		<?php echo $form->textField($model,'nip_co_promotor1',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'nip_co_promotor1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nip_co_promotor2'); ?>
		<?php echo $form->textField($model,'nip_co_promotor2',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'nip_co_promotor2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nip_co_promotor3'); ?>
		<?php echo $form->textField($model,'nip_co_promotor3',array('size'=>33,'maxlength'=>33)); ?>
		<?php echo $form->error($model,'nip_co_promotor3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nip_co_promotor4'); ?>
		<?php echo $form->textField($model,'nip_co_promotor4',array('size'=>44,'maxlength'=>44)); ?>
		<?php echo $form->error($model,'nip_co_promotor4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_mahasiswa'); ?>
		<?php echo $form->textField($model,'photo_mahasiswa',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_mahasiswa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_bayar'); ?>
		<?php echo $form->textField($model,'status_bayar'); ?>
		<?php echo $form->error($model,'status_bayar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telepon'); ?>
		<?php echo $form->textField($model,'telepon',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'telepon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hp'); ?>
		<?php echo $form->textField($model,'hp',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'hp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat'); ?>
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alamat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'berat'); ?>
		<?php echo $form->textField($model,'berat',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'berat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tinggi'); ?>
		<?php echo $form->textField($model,'tinggi',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'tinggi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ktp'); ?>
		<?php echo $form->textField($model,'ktp',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'ktp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rt'); ?>
		<?php echo $form->textField($model,'rt',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'rt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rw'); ?>
		<?php echo $form->textField($model,'rw',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'rw'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dusun'); ?>
		<?php echo $form->textField($model,'dusun',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'dusun'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_pos'); ?>
		<?php echo $form->textField($model,'kode_pos',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_pos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desa'); ?>
		<?php echo $form->textField($model,'desa',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'desa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kecamatan'); ?>
		<?php echo $form->textField($model,'kecamatan',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'kecamatan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis_tinggal'); ?>
		<?php echo $form->textField($model,'jenis_tinggal',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jenis_tinggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'penerima_kps'); ?>
		<?php echo $form->textField($model,'penerima_kps',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'penerima_kps'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_kps'); ?>
		<?php echo $form->textField($model,'no_kps',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'no_kps'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provinsi'); ?>
		<?php echo $form->textField($model,'provinsi',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'provinsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kabupaten'); ?>
		<?php echo $form->textField($model,'kabupaten',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kabupaten'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warga_negara'); ?>
		<?php echo $form->textField($model,'warga_negara',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'warga_negara'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_sipil'); ?>
		<?php echo $form->textField($model,'status_sipil',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'status_sipil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agama'); ?>
		<?php echo $form->textField($model,'agama',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'agama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gol_darah'); ?>
		<?php echo $form->textField($model,'gol_darah',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'gol_darah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'masuk_kelas'); ?>
		<?php echo $form->textField($model,'masuk_kelas',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'masuk_kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_sk_yudisium'); ?>
		<?php echo $form->textField($model,'tgl_sk_yudisium'); ?>
		<?php echo $form->error($model,'tgl_sk_yudisium'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_mahasiswa'); ?>
		<?php echo $form->textField($model,'status_mahasiswa'); ?>
		<?php echo $form->error($model,'status_mahasiswa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kampus'); ?>
		<?php echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'kampus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->