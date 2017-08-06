<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */

$this->breadcrumbs=array(
	'Mastermatakuliahs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mastermatakuliah', 'url'=>array('index')),
	array('label'=>'Manage Mastermatakuliah', 'url'=>array('admin')),
);
?>

<h1>Create Mastermatakuliah</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>