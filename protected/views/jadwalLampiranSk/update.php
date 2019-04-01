<?php
/* @var $this JadwalLampiranSkController */
/* @var $model JadwalLampiranSk */

$this->breadcrumbs=array(
	'Jadwal Lampiran Sks'=>array('index'),
	$model->nomor_sk=>array('view','id'=>$model->nomor_sk),
	'Update',
);

$this->menu=array(
	array('label'=>'List JadwalLampiranSk', 'url'=>array('index')),
	array('label'=>'Create JadwalLampiranSk', 'url'=>array('create')),
	array('label'=>'View JadwalLampiranSk', 'url'=>array('view', 'id'=>$model->nomor_sk)),
	array('label'=>'Manage JadwalLampiranSk', 'url'=>array('admin')),
);
?>

<h1>Update JadwalLampiranSk <?php echo $model->nomor_sk; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>