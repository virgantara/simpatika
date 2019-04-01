<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */

$this->breadcrumbs=array(
	'Datakrs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Datakrs', 'url'=>array('index')),
	array('label'=>'Manage Datakrs', 'url'=>array('admin')),
);
?>

<h1>Create Datakrs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>