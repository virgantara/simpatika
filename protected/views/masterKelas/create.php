<?php
/* @var $this MasterkelasController */
/* @var $model Masterkelas */

$this->breadcrumbs=array(
	'Masterkelases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Masterkelas', 'url'=>array('index')),
	array('label'=>'Manage Masterkelas', 'url'=>array('admin')),
);
?>

<h1>Create Masterkelas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>