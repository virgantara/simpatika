<?php
/* @var $this KampusController */
/* @var $model Kampus */

$this->breadcrumbs=array(
	'Kampuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kampus', 'url'=>array('index')),
	array('label'=>'Manage Kampus', 'url'=>array('admin')),
);
?>

<h1>Create Kampus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>