<?php
/* @var $this LogsController */
/* @var $model Logs */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Logs', 'url'=>array('index')),
	array('label'=>'Manage Logs', 'url'=>array('admin')),
);
?>

<h1>Create Logs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>