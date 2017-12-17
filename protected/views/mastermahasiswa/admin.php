<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */

$this->breadcrumbs=array(
	'Mastermahasiswas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mastermahasiswa', 'url'=>array('index')),
	array('label'=>'Create Mastermahasiswa', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mastermahasiswa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mastermahasiswas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mastermahasiswa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'kode_pt',
		'kode_fakultas',
		'kode_prodi',
		'kode_jenjang_studi',
		'nim_mhs',
		/*
		'nama_mahasiswa',
		'tempat_lahir',
		'tgl_lahir',
		'jenis_kelamin',
		'tahun_masuk',
		'semester_awal',
		'batas_studi',
		'asal_propinsi',
		'tgl_masuk',
		'tgl_lulus',
		'status_aktivitas',
		'status_awal',
		'jml_sks_diakui',
		'nim_asal',
		'asal_pt',
		'nama_asal_pt',
		'asal_jenjang_studi',
		'asal_prodi',
		'kode_biaya_studi',
		'kode_pekerjaan',
		'tempat_kerja',
		'kode_pt_kerja',
		'kode_ps_kerja',
		'nip_promotor',
		'nip_co_promotor1',
		'nip_co_promotor2',
		'nip_co_promotor3',
		'nip_co_promotor4',
		'photo_mahasiswa',
		'semester',
		'keterangan',
		'status_bayar',
		'telepon',
		'hp',
		'email',
		'alamat',
		'berat',
		'tinggi',
		'ktp',
		'rt',
		'rw',
		'dusun',
		'kode_pos',
		'desa',
		'kecamatan',
		'jenis_tinggal',
		'penerima_kps',
		'no_kps',
		'provinsi',
		'kabupaten',
		'warga_negara',
		'status_sipil',
		'agama',
		'gol_darah',
		'masuk_kelas',
		'tgl_sk_yudisium',
		'status_mahasiswa',
		'kampus',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
