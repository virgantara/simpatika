<?php
/* @var $this JamController */
/* @var $model Jam */

$this->breadcrumbs=array(
	'Jams'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jam', 'url'=>array('index')),
	array('label'=>'Manage Jam', 'url'=>array('admin')),
);
?>

<h1>Create Jam</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>