<?php
/* @var $this MasterdosenController */
/* @var $model Masterdosen */

$this->breadcrumbs=array(
	'Masterdosens'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Masterdosen', 'url'=>array('index')),
	array('label'=>'Create Masterdosen', 'url'=>array('create')),
	array('label'=>'View Masterdosen', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Masterdosen', 'url'=>array('admin')),
);
?>

<h1>Update Masterdosen <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>