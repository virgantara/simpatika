<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */

$this->breadcrumbs=array(
	'Mastermatakuliahs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mastermatakuliah', 'url'=>array('index')),
	array('label'=>'Create Mastermatakuliah', 'url'=>array('create')),
	array('label'=>'Update Mastermatakuliah', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mastermatakuliah', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mastermatakuliah', 'url'=>array('admin')),
);
?>

<h1>View Mastermatakuliah #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tahun_akademik',
		'kode_pt',
		'kode_fakultas',
		'kode_prodi',
		'kode_jenjang_studi',
		'kode_mata_kuliah',
		'nama_mata_kuliah',
		'sks',
		'sks_tatap_muka',
		'sks_praktikum',
		'sks_praktek_lap',
		'semester',
		'kode_kelompok',
		'kode_kurikulum',
		'kode_matkul',
		'nidn',
		'jenjang_prodi',
		'prodi_pengampu',
		'status_mata_kuliah',
		'silabus',
		'sap',
		'bahan_ajar',
		'diktat',
		'status_wajib',
		'sms',
	),
)); ?>
