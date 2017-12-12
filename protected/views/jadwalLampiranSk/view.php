<?php
/* @var $this JadwalLampiranSkController */
/* @var $model JadwalLampiranSk */

$this->breadcrumbs=array(
	'Jadwal Lampiran Sks'=>array('index'),
	$model->nomor_sk,
);

$this->menu=array(
	array('label'=>'List JadwalLampiranSk', 'url'=>array('index')),
	array('label'=>'Create JadwalLampiranSk', 'url'=>array('create')),
	array('label'=>'Update JadwalLampiranSk', 'url'=>array('update', 'id'=>$model->nomor_sk)),
	array('label'=>'Delete JadwalLampiranSk', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->nomor_sk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JadwalLampiranSk', 'url'=>array('admin')),
);
?>

<h1>View JadwalLampiranSk #<?php echo $model->nomor_sk; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nomor_sk',
		'tanggal_sk',
		'tentang',
		'tanggal_penetapan',
		'bunyi_lampiran',
	),
)); ?>
