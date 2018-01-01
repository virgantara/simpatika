<?php
/* @var $this LogsController */
/* @var $model Logs */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->id_log=>array('view','id'=>$model->id_log),
	'Update',
);

$this->menu=array(
	array('label'=>'List Logs', 'url'=>array('index')),
	array('label'=>'Create Logs', 'url'=>array('create')),
	array('label'=>'View Logs', 'url'=>array('view', 'id'=>$model->id_log)),
	array('label'=>'Manage Logs', 'url'=>array('admin')),
);
?>

<h1>Update Logs <?php echo $model->id_log; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>