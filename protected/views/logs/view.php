<?php
/* @var $this LogsController */
/* @var $model Logs */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->id_log,
);

$this->menu=array(
	array('label'=>'List Logs', 'url'=>array('index')),
	array('label'=>'Create Logs', 'url'=>array('create')),
	array('label'=>'Update Logs', 'url'=>array('update', 'id'=>$model->id_log)),
	array('label'=>'Delete Logs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_log),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Logs', 'url'=>array('admin')),
);
?>

<h1>View Logs #<?php echo $model->id_log; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_log',
		'message',
		'created',
	),
)); ?>
