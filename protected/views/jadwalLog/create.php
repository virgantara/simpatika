<?php
/* @var $this JadwalLogController */
/* @var $model JadwalLog */

$this->breadcrumbs=array(
	'Jadwal Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JadwalLog', 'url'=>array('index')),
	array('label'=>'Manage JadwalLog', 'url'=>array('admin')),
);
?>

<h1>Create JadwalLog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>