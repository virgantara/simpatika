<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pt'); ?>
		<?php echo $form->textField($model,'kode_pt',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_fakultas'); ?>
		<?php echo $form->textField($model,'kode_fakultas',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_prodi'); ?>
		<?php echo $form->textField($model,'kode_prodi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jenjang_studi'); ?>
		<?php echo $form->textField($model,'kode_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nim_mhs'); ?>
		<?php echo $form->textField($model,'nim_mhs',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_mahasiswa'); ?>
		<?php echo $form->textField($model,'nama_mahasiswa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tempat_lahir'); ?>
		<?php echo $form->textField($model,'tempat_lahir',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lahir'); ?>
		<?php echo $form->textField($model,'tgl_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenis_kelamin'); ?>
		<?php echo $form->textField($model,'jenis_kelamin',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_masuk'); ?>
		<?php echo $form->textField($model,'tahun_masuk',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester_awal'); ?>
		<?php echo $form->textField($model,'semester_awal',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'batas_studi'); ?>
		<?php echo $form->textField($model,'batas_studi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asal_propinsi'); ?>
		<?php echo $form->textField($model,'asal_propinsi',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_masuk'); ?>
		<?php echo $form->textField($model,'tgl_masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lulus'); ?>
		<?php echo $form->textField($model,'tgl_lulus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_aktivitas'); ?>
		<?php echo $form->textField($model,'status_aktivitas',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_awal'); ?>
		<?php echo $form->textField($model,'status_awal',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jml_sks_diakui'); ?>
		<?php echo $form->textField($model,'jml_sks_diakui',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nim_asal'); ?>
		<?php echo $form->textField($model,'nim_asal',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asal_pt'); ?>
		<?php echo $form->textField($model,'asal_pt',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_asal_pt'); ?>
		<?php echo $form->textField($model,'nama_asal_pt',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asal_jenjang_studi'); ?>
		<?php echo $form->textField($model,'asal_jenjang_studi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asal_prodi'); ?>
		<?php echo $form->textField($model,'asal_prodi',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_biaya_studi'); ?>
		<?php echo $form->textField($model,'kode_biaya_studi',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pekerjaan'); ?>
		<?php echo $form->textField($model,'kode_pekerjaan',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tempat_kerja'); ?>
		<?php echo $form->textField($model,'tempat_kerja',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pt_kerja'); ?>
		<?php echo $form->textField($model,'kode_pt_kerja',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_ps_kerja'); ?>
		<?php echo $form->textField($model,'kode_ps_kerja',array('size'=>44,'maxlength'=>44)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nip_promotor'); ?>
		<?php echo $form->textField($model,'nip_promotor',array('size'=>44,'maxlength'=>44)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nip_co_promotor1'); ?>
		<?php echo $form->textField($model,'nip_co_promotor1',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nip_co_promotor2'); ?>
		<?php echo $form->textField($model,'nip_co_promotor2',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nip_co_promotor3'); ?>
		<?php echo $form->textField($model,'nip_co_promotor3',array('size'=>33,'maxlength'=>33)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nip_co_promotor4'); ?>
		<?php echo $form->textField($model,'nip_co_promotor4',array('size'=>44,'maxlength'=>44)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_mahasiswa'); ?>
		<?php echo $form->textField($model,'photo_mahasiswa',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keterangan'); ?>
		<?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_bayar'); ?>
		<?php echo $form->textField($model,'status_bayar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telepon'); ?>
		<?php echo $form->textField($model,'telepon',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hp'); ?>
		<?php echo $form->textField($model,'hp',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alamat'); ?>
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'berat'); ?>
		<?php echo $form->textField($model,'berat',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tinggi'); ?>
		<?php echo $form->textField($model,'tinggi',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ktp'); ?>
		<?php echo $form->textField($model,'ktp',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rt'); ?>
		<?php echo $form->textField($model,'rt',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rw'); ?>
		<?php echo $form->textField($model,'rw',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dusun'); ?>
		<?php echo $form->textField($model,'dusun',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pos'); ?>
		<?php echo $form->textField($model,'kode_pos',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desa'); ?>
		<?php echo $form->textField($model,'desa',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kecamatan'); ?>
		<?php echo $form->textField($model,'kecamatan',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenis_tinggal'); ?>
		<?php echo $form->textField($model,'jenis_tinggal',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'penerima_kps'); ?>
		<?php echo $form->textField($model,'penerima_kps',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_kps'); ?>
		<?php echo $form->textField($model,'no_kps',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'provinsi'); ?>
		<?php echo $form->textField($model,'provinsi',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kabupaten'); ?>
		<?php echo $form->textField($model,'kabupaten',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'warga_negara'); ?>
		<?php echo $form->textField($model,'warga_negara',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_sipil'); ?>
		<?php echo $form->textField($model,'status_sipil',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agama'); ?>
		<?php echo $form->textField($model,'agama',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gol_darah'); ?>
		<?php echo $form->textField($model,'gol_darah',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'masuk_kelas'); ?>
		<?php echo $form->textField($model,'masuk_kelas',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_sk_yudisium'); ?>
		<?php echo $form->textField($model,'tgl_sk_yudisium'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_mahasiswa'); ?>
		<?php echo $form->textField($model,'status_mahasiswa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kampus'); ?>
		<?php echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->