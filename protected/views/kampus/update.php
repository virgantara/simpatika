<?php
/* @var $this KampusController */
/* @var $model Kampus */

$this->breadcrumbs=array(
	'Kampuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kampus', 'url'=>array('index')),
	array('label'=>'Create Kampus', 'url'=>array('create')),
	array('label'=>'View Kampus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kampus', 'url'=>array('admin')),
);
?>

<h1>Update Kampus <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>