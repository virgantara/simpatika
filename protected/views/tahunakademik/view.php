<?php
/* @var $this TahunakademikController */
/* @var $model Tahunakademik */

$this->breadcrumbs=array(
	'Tahunakademiks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tahunakademik', 'url'=>array('index')),
	array('label'=>'Create Tahunakademik', 'url'=>array('create')),
	array('label'=>'Update Tahunakademik', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tahunakademik', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tahunakademik', 'url'=>array('admin')),
);
?>

<h1>View Tahunakademik #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tahun_id',
		'tahun',
		'semester',
		'nama_tahun',
		'krs_mulai',
		'krs_selesai',
		'krs_online_mulai',
		'krs_online_selesai',
		'krs_ubah_mulai',
		'krs_ubah_selesai',
		'kss_cetak_mulai',
		'kss_cetak_selesai',
		'cuti',
		'mundur',
		'bayar_mulai',
		'bayar_selesai',
		'kuliah_mulai',
		'kuliah_selesai',
		'uts_mulai',
		'uts_selesai',
		'uas_mulai',
		'uas_selesai',
		'nilai',
		'akhir_kss',
		'proses_buka',
		'proses_ipk',
		'proses_tutup',
		'buka',
		'syarat_krs',
		'syarat_krs_ips',
		'cuti_selesai',
		'max_sks',
	),
)); ?>
