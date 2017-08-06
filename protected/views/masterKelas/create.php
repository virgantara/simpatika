<?php
/* @var $this MasterKelasController */
/* @var $model MasterKelas */

$this->breadcrumbs=array(
	'Master Kelases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MasterKelas', 'url'=>array('index')),
	array('label'=>'Manage MasterKelas', 'url'=>array('admin')),
);
?>

<h1>Create MasterKelas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>