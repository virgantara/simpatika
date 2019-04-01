<?php
/* @var $this TahunakademikController */
/* @var $model Tahunakademik */

$this->breadcrumbs=array(
	'Tahunakademiks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tahunakademik', 'url'=>array('index')),
	array('label'=>'Manage Tahunakademik', 'url'=>array('admin')),
);
?>

<h1>Create Tahunakademik</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>