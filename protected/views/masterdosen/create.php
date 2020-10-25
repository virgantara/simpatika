<?php
/* @var $this MasterdosenController */
/* @var $model Masterdosen */

$this->breadcrumbs=array(
	'Masterdosens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Masterdosen', 'url'=>array('index')),
	array('label'=>'Manage Masterdosen', 'url'=>array('admin')),
);
?>

<h1>Create Masterdosen</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>