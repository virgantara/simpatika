<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */

$this->breadcrumbs=array(
	'Datakrs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Datakrs', 'url'=>array('index')),
	array('label'=>'Create Datakrs', 'url'=>array('create')),
	array('label'=>'View Datakrs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Datakrs', 'url'=>array('admin')),
);
?>

<h1>Update Datakrs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>