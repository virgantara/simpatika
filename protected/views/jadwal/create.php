<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jadwal', 'url'=>array('index')),
	array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<h1>Create Jadwal</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>