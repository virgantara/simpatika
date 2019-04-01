<?php
/* @var $this JadwalLampiranSkController */
/* @var $model JadwalLampiranSk */

$this->breadcrumbs=array(
	'Jadwal Lampiran Sks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JadwalLampiranSk', 'url'=>array('index')),
	array('label'=>'Manage JadwalLampiranSk', 'url'=>array('admin')),
);
?>

<h1>Create JadwalLampiranSk</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>